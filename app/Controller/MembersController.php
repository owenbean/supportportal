<?php
class MembersController extends AppController {
	public function all($options = null) {
		if (!$options) {
			$this->set('members', $this->Member->find('all'));
		} else {
			$this->set('members', $this->Member->find('all', array('conditions' => array("Member.$options" => true))));
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
		$this->set('committees', $this->Member->Committee->find('all', array('conditions' => array('Committee.member_id' => $id))));
		$this->set('smartForms', $this->Member->SmartForm->find('all', array('conditions' => array('SmartForm.member_id' => $id))));
		$this->set('admins', $this->Member->Admin->find('all', array('conditions' => array('Admin.active' => true, 'Admin.member_id' => $id))));
	}
	
	public function add() {
		$this->loadModel('User');
		$specialists = $this->User->find('list', array('fields' => array('User.id', 'User.first_name')));
		$this->set(compact('specialists'));
		if ($this->request->is('post')) {
			$this->Member->create();
			if ($this->Member->save($this->request->data)) {
				$this->Session->setFlash(__('Member successfully added'));
				return $this->redirect(array('action' => 'all'));
			}
			$this->Session->setFlash(__('Unable to add new member'));
		}
	}
	
	public function edit($id = null) {
		$this->loadModel('User');
		$specialists = $this->User->find('list', array('fields' => array('User.id', 'User.first_name')));
		$this->set(compact('specialists'));
		if (!$id) {
			throw new NotFoundException(__('Invalid member'));
		}
		
		$member = $this->Member->findById($id);
		if (!$member) {
			throw new NotFoundException(__('Invalid member'));
		}
		
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