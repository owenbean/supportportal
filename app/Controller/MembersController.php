<?php
class MembersController extends AppController {
	public function all($options = null) {
		if (!$options) {
			if (isset($_GET['order'])) {
				$order = $_GET['order'];
				$this->set('members', $this->Member->find('all', array('conditions' => array('Member.active' => true), 'order' => array("Member.$order"))));
			} else {
				$this->set('members', $this->Member->find('all', array('conditions' => array('Member.active' => true), 'order' => array('Member.full_name'))));
			}
			$this->set('add_features', false);
		} else {
			$this->set('members', $this->Member->find('all', array('conditions' => array("Member.$options" => true, 'Member.active' => true), 'order' => array('Member.full_name'))));
			//this disables sortable column headers
			$this->set('add_features', true);
		}
	}
	
	public function search($keyword = null) {
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
	
	public function view($id = null) {
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
	}
	
	public function add() {
		$this->loadModel('User');
		$specialists = $this->User->find('list', array('fields' => array('User.id', 'User.first_name'), 'conditions' => array('User.active' => true, 'User.role' => array('site_admin', 'admin'))));
		$this->set(compact('specialists'));
		$this->set('title_for_layout', 'Add Member');
		
		if ($this->request->is('post')) {
			$this->Member->create();
			if ($this->Member->save($this->request->data)) {
				$this->Session->setFlash(__('Member successfully added'));
				return $this->redirect(array('action' => 'view', $this->Member->id));
			}
			$this->Session->setFlash(__('Unable to add new member'));
		}
	}
	
	public function edit($id = null) {
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
				$this->Session->setFlash(__('Member successfully updated'));
				return $this->redirect(array('action' => 'view', $id));
			}
			$this->Session->setFlash(__('Unable to update member'));
		}
		
		if (!$this->request->data) {
			$this->request->data = $member;
		}
	}
	
	public function retire($id) {
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}
		
		$this->Member->id = $id;
		if ($this->Member->save($this->Member->set(array('active' => 0)))) {
			$this->Member->Admin->updateAll(array('Admin.active' => 0), array('Admin.member_id' => $id));
			$this->Session->setFlash(__('Member retired'));
			return $this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Unable to retire member'));		
	}
	
	public function delete($id) {
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}
		
		if ($this->Member->delete($id)) {
			$this->Session->setFlash(__('Member successfully deleted'));
			return $this->redirect(array('action' => 'all'));
		}
	}
}