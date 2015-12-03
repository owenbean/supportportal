<?php
class MembersController extends AppController {
  public $helpers = array('Markdown.Markdown');
  
	public function all($options = null)
	{
		if (!$options) {
			if (isset($_GET['order'])) {
				$order = $_GET['order'];
				$this->set('members', $this->Member->find('all', array('conditions' => array('Member.active' => true), 'order' => array("Member.$order"))));
			} else {
				$this->set('members', $this->Member->find('all', array('conditions' => array('Member.active' => true), 'order' => array('Member.full_name'))));
			}
			$this->set('filter_added', false);
		} else {
			$this->set('members', $this->Member->find('all', array('conditions' => array("Member.$options" => true, 'Member.active' => true), 'order' => array('Member.full_name'))));
			//this disables sortable column headers
			$this->set('filter_added', true);
			$this->set('filter', $options);
		}
	}
	
	public function search($keyword = null)
	{
		$keyword = implode($this->request->data);
		$members = $this->Member->find('all', array('conditions' => array('OR' => array(array('Member.full_name LIKE' => '%' . $keyword . '%'), array('Member.short_name LIKE' => '%' . $keyword . '%'))), 'order' => array('Member.full_name')));
		//this redirects the page to the View page for the member returned by the search
		if (count($members) == 1) {
			$member = $this->Member->find('first', array('conditions' => array('OR' => array(array('Member.full_name LIKE' => '%' . $keyword . '%'), array('Member.short_name LIKE' => '%' . $keyword . '%')))));
			return $this->redirect(array('action' => 'view', $member['Member']['id']));
		} else {
			$this->set('members', $members);
		}
	}
	
	public function view($id = null)
	{
		if (!$id) {
			throw new NotFoundException(__('Invalid member'));
		}
		
		$member = $this->Member->findById($id);
		if (!$member) {
			throw new NotFoundException(__('Invalid member'));
		}
		$this->set('member', $member);
		$this->set('title_for_layout', $member['Member']['short_name']);
		$this->set('committees', $this->Member->Committee->find('all', array('conditions' => array('Committee.member_id' => $id))));
		$this->set('smartForms', $this->Member->SmartForm->find('all', array('conditions' => array('SmartForm.member_id' => $id))));
		$this->set('admins', $this->Member->Admin->find('all', array('conditions' => array('Admin.member_id' => $id))));
		$this->set('interactions', $this->Member->Interaction->find('all', array('conditions' => array('Interaction.member_id' => $id), 'order' => array('Interaction.date DESC'), 'limit' => '5')));
	}
	
	public function add()
	{
		$this->loadModel('User');
		$specialists = $this->User->find('list', array('fields' => array('User.id', 'User.first_name'), 'conditions' => array('User.active' => true, 'User.role' => array('site_admin', 'admin'))));
		$this->set(compact('specialists'));
		$this->set('title_for_layout', 'Add Member');
		
		if ($this->request->is('post')) {
			$this->Member->create();
			if ($this->Member->save($this->request->data)) {
				$this->Session->setFlash('Member successfully added', 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'view', $this->Member->id));
			}
			$this->Session->setFlash('Unable to add new member', 'default', array('class' => 'alert alert-danger'));
		}
	}
	
	public function edit($id = null)
	{
		$this->loadModel('User');
		$specialists = $this->User->find('list', array('fields' => array('User.id', 'User.first_name'), 'conditions' => array('User.active' => true, 'User.role' => array('site_admin', 'admin'))));
		$this->set(compact('specialists'));
		if (!$id) {
			throw new NotFoundException(__('Invalid member'));
		}
		
		$member = $this->Member->findById($id);
		if (!$member) {
			throw new NotFoundException(__('Invalid member'));
		}
		
		$this->set('title_for_layout', 'Edit Member');
		if ($this->request->is(array('post', 'put'))) {
			$this->Member->id = $id;
			if ($this->Member->save($this->request->data)) {
				$this->Session->setFlash('Member successfully updated', 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'view', $id));
			}
			$this->Session->setFlash('Unable to update member', 'default', array('class' => 'alert alert-danger'));
		}
		
		if (!$this->request->data) {
			$this->request->data = $member;
		}
	}
/****************************************************************************
 * RETIRE MEMBER
 * When a user clicks the retire button on the "view" page for a
 * specific member, then that triggers the deleteRetirePopup function in
 * irbnet_admin.js. The javascript opens a div box that asks "are you sure?"
 * with option to delete or retire the member.
 *
 * The HTML for the div box is described on the "view" View.
 *
 * Retiring a member will also retire the member's administrators and
 * smart forms.
 ****************************************************************************
 */ 
	public function retire($id)
	{
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}
		
		$this->Member->id = $id;
		if ($this->Member->save($this->Member->set(array('active' => 0)))) {
			// Retire all administrators for this member id
			$this->Member->Admin->updateAll(array('Admin.active' => 0), array('Admin.member_id' => $id));
			// Retire all smart forms for this member id
			$this->Member->SmartForm->updateAll(array('SmartForm.status' => "'Retired'"), array('SmartForm.member_id' => $id));
			// Send email to Support
			$this->memberRetiredEmail($id);
			// Display success message
			$this->Session->setFlash('Member retired', 'default', array('class' => 'alert alert-success'));
			return $this->redirect(array('action' => 'view', $id));
		}
		$this->Session->setFlash('Unable to retire member', 'default', array('class' => 'alert alert-danger'));
	}
	// Send email to Support notifying them of member retirement.
	public function memberRetiredEmail($member_id)
	{
		App::uses('CakeEmail', 'Network/Email');
        $member = $this->Member->find('first', array('conditions' => array('Member.id' => $member_id)));

		//load Users and find Support Desk account, for email purposes
		$this->loadModel('User');
        $support = $this->User->find('first', array('conditions' => array('User.username' => 'support')));
		
        if ($member === false) {
            debug(__METHOD__." failed to retrieve User data for user.id: {$user_id}");
            return false;
        }
		// Retrieve important variables
        $thisUser_first_name = $this->Session->read('Auth.User.first_name');
        $support_email_address = $support['User']['email_address'];
		$member_name = $member['Member']['full_name'];
		// Assemble email and send to Support
		$Email = new CakeEmail('gmail');
		$Email->from(array('letters@irbnet.org' => 'IRBNet Letter Team'));
		$Email->to($support_email_address);
		$Email->subject('Member Retired from Support Portal - ' . $member_name);
		$Email->template('member_retired');
		$Email->emailFormat('html');
		$Email->viewVars(array('thisUser' => $thisUser, 'member_name' => $member_name, 'member_id' => $member_id));
		$Email->send();
	}

/****************************************************************************
 * DELETE MEMBER
 * When a user clicks the delete button on the "view" page for a
 * specific member, then that triggers the deletePopup function in
 * irbnet_admin.js. The javascript opens a div box that asks "are you sure?"
 * with option to delete or retire the member.
 *
 * The HTML for the div box is described on the "view" View.
 *
 * Deleting a member will also delete all of the data associated with the
 * member (as described in the Member model).
 ****************************************************************************
 */ 
	public function delete($id)
	{
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}
		
		if ($this->Member->delete($id, true)) {
			$this->Session->setFlash('Member successfully deleted', 'default', array('class' => 'alert alert-danger'));
			return $this->redirect(array('action' => 'all'));
		}
	}
/****************************************************************************
 * UN-RETIRE MEMBER
 * When a user clicks the retire or delete button on the "view" page for a
 * specific member, then that triggers the unRetire function in
 * irbnet_admin.js. The javascript opens a div box that asks "are you sure?"
 *
 * The HTML for the div box is described on the "view" View.
 ****************************************************************************
 */ 

// UN-MEMBER - marks as active
	public function unretire($id)
	{
		if($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}
		
		$this->Member->id = $id;
		if ($this->Member->save($this->Member->set(array('active' => 1)))) {
			$this->Session->setFlash('Member reactivated', 'default', array('class' => 'alert alert-success'));
			return $this->redirect(array('action' => 'view', $id));
		}
		$this->Session->setFlash('Unable to reactivate member', 'default', array('class' => 'alert alert-danger'));
	}
}