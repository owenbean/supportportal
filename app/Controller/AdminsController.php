<?php
class AdminsController extends AppController {
  	public $helpers = array('Markdown.Markdown');

/**
 * ALL ADMINISTRATORS LIST
 * This creates a list of all NRN or GovCloud admins to be listed in /admins
 */ 
	public function all($options = null) {
		if (!$options) {
			$this->set('admins', $this->Admin->find('all', array('conditions' => array('Admin.active' => true), 'order' => array('Member.full_name'))));
			$this->set('filter_added', false);
		} else {
			if (isset($this->request->query['member_class'])) {
				$member_class = $this->request->query['member_class'];
				$this->set('admins', $this->Admin->find('all', array('conditions' => array('Admin.active' => true, "Admin.$options" => true, "Member.class" => $member_class), 'order' => array('Member.full_name'))));
			} else {
				$this->set('admins', $this->Admin->find('all', array('conditions' => array('Admin.active' => true, "Admin.$options" => true), 'order' => array('Member.full_name'))));
			}
			$this->set('filter_added', true);
			$this->set('filter', $options);
		}
	}
/**
 * SEARCH ADMINISTRATOR
 * When a user clicks the Administrators > Search button in the navbar
 * (view/elements/nav.ctp), then that triggers the adminSearch function in
 * irbnet_admin.js. The javascript opens a search console with a plain-text
 * field.
 *
 * This controller function retrieves the content of that search console and
 * queries the db for first names and last names like that keyword.
 */ 
	public function search($keyword = null) {
		// uses implode to return string from array elements
		$keyword = implode($this->request->data);
		// queries database for names like the keyword, then passes results into $admins variable
		$admins = $this->Admin->find('all', array('conditions' => array('OR' => array(array('Admin.first_name LIKE' => '%' . $keyword . '%'), array('Admin.last_name LIKE' => '%' . $keyword . '%')))));
		// if only one search result found, take the user to the "view" view for that specific admin.
		if (count($admins) == 1) {
			$admin = $this->Admin->find('first', array('conditions' => array('OR' => array(array('Admin.first_name LIKE' => '%' . $keyword . '%'), array('Admin.last_name LIKE' => '%' . $keyword . '%')))));
			return $this->redirect(array('action' => 'view', $admin['Admin']['id']));
		} else {
			$this->set('admins', $admins);
		}
	}
/**
 * VIEW ADMINISTRATOR
 * Allows user to view the admin based on the admin's ID.
 */ 
	public function view($id = null) {
		if (!$id) {
			throw new NotFoundException(__('Invalid administrator'));
		}
		
		$admin = $this->Admin->findById($id);
		if (!$admin) {
			throw new NotFoundException(__('Invalid administrator'));
		}
		$this->set('admin', $admin);
	}
/**
 * ADD ADMINISTRATOR
 * Produces a "New Administrator" form that allows user to add a new
 * administrator.
 * 
 * When the form is submitted, then it passes submission into the database
 * and brings the user to the view page for that created admin.
 */ 
	public function add($member = null) {
		// Uses Member model so that we can populate the Organization dropdown menu
		$this->loadModel('Member');
		if (!$member) {
			$members = $this->Member->find('list', array('fields' => array('Member.id', 'Member.full_name'), 'conditions' => array('Member.active' => 1)));
			$this->set(compact('members'));
		} else {
			$members = $this->Member->find('list', array('fields' => array('Member.id', 'Member.full_name'), 'conditions' => array('Member.id' => $member)));
			$this->set(compact('members'));
		}
		
		if ($this->request->is('post')) {
			$this->Admin->create();
			if ($this->Admin->save($this->request->data)) {
				$this->Session->setFlash('Administrator successfully created', 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'view', $this->Admin->id));
			}
			$this->Session->setFlash('Unable to save administrator', 'default', array('class' => 'alert alert-danger'));
		}
	}
/**
 * EDIT ADMINISTRATOR
 * Produces a "New Administrator" form that allows user to add a new
 * administrator. This form functions in similar fashion to "add,"
 * except that it pre-populates and submits based on the admin's id.
 */ 
	public function edit($id = null) {
		$this->loadModel('Member');
		$members = $this->Member->find('list', array('fields' => array('Member.id', 'Member.full_name')));
		$this->set(compact('members'));
		
		if (!$id) {
			throw new NotFoundException(__('Invalid administrator'));
		}
		
		$admin = $this->Admin->findById($id);
		if (!$admin) {
			throw new NotFoundException(__('Invalid administrator'));
		}
		
		if ($this->request->is(array('post', 'put'))) {
			$this->Admin->id = $id;
			if ($this->Admin->save($this->request->data)) {
				$this->Session->setFlash('Administrator saved', 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'view', $id));
			}
			$this->Session->setFlash('Unable to save administrator', 'default', array('class' => 'alert alert-danger'));
		}
		
		if (!$this->request->data) {
			$this->request->data = $admin;
		}
	}
/**
 * RETIRE OR DELETE ADMINISTRATOR
 * When a user clicks the retire or delete button on the "view" page for a
 * specific admin, then that triggers the deleteRetire function in
 * irbnet_admin.js. The javascript opens a div box that asks "are you sure?"
 * with option to delete or retire the admin.
 *
 * The HTML for the div box is described on the "view" View.
 *
 * Depending on the link clicked in that div, one of the below functions is
 * performed.
 */ 
 
 // RETIRE ADMINISTRATOR - marks as inactive
	public function retire($id) {
		if($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}
		
		$this->Admin->id = $id;
		if ($this->Admin->save($this->Admin->set(array('active' => 0)))) {
			$this->Session->setFlash('Administrator retired', 'default', array('class' => 'alert alert-success'));
			return $this->redirect(array('action' => 'view', $id));
		}
		$this->Session->setFlash('Unable to retire administrator', 'default', array('class' => 'alert alert-danger'));
	}
 // DELETE ADMINISTRATOR - drops from database
	public function delete($id) {
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}
		
		if ($this->Admin->delete($id)) {
			$this->Session->setFlash('Administrator successfully deleted', 'default', array('class' => 'alert alert-success'));
			return $this->redirect(array('action' => 'all'));
		}
	}
/**
 * UN-RETIRE ADMINISTRATOR
 * When a user clicks the retire or delete button on the "view" page for a
 * specific admin, then that triggers the unRetire function in
 * irbnet_admin.js. The javascript opens a div box that asks "are you sure?"
 *
 * The HTML for the div box is described on the "view" View.
 */ 
 
  // RETIRE ADMINISTRATOR - marks as active
	public function unretire($id) {
		if($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}
		
		$this->Admin->id = $id;
		if ($this->Admin->save($this->Admin->set(array('active' => 1)))) {
			$this->Session->setFlash('Administrator un-retired', 'default', array('class' => 'alert alert-success'));
			return $this->redirect(array('action' => 'view', $id));
		}
		$this->Session->setFlash('Unable to un-retire administrator', 'default', array('class' => 'alert alert-danger'));
	}
}