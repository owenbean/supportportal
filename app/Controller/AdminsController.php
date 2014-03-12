<?php
class AdminsController extends AppController {
	public function all($options = null) {
		if (!$options) {
			$this->set('admins', $this->Admin->find('all', array('conditions' => array('Admin.active' => true))));
		} else {
			$this->set('admins', $this->Admin->find('all', array('conditions' => array('Admin.active' => true, "Admin.$options" => true))));
		}
	}
	
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
	
	public function add($member = null) {
		$this->loadModel('Member');
		if (!$member) {
			$members = $this->Member->find('list', array('fields' => array('Member.id', 'Member.full_name')));
			$this->set(compact('members'));
		} else {
			$members = $this->Member->find('list', array('fields' => array('Member.id', 'Member.full_name'), 'conditions' => array('Member.id' => $member)));
			$this->set(compact('members'));
		}
		
		if ($this->request->is('post')) {
			$this->Admin->create();
			if ($this->Admin->save($this->request->data)) {
				$this->Session->setFlash(__('Administrator successfully created'));
				return $this->redirect(array('action' => 'all'));
			}
			$this->Session->setFlash(__('Unable to save administrator'));
		}
	}
	
	public function edit($id = null) {
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
				$this->Session->setFlash(__('Administrator saved'));
				return $this->redirect(array('action' => 'view', $id));
			}
			$this->Session->setFlash(__('Unable to save administrator'));
		}
		
		if (!$this->request->data) {
			$this->request->data = $admin;
		}
	}
	
	public function retire($id) {
		if($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}
		
		$this->Admin->id = $id;
		if ($this->Admin->save($this->Admin->set(array('active' => 0)))) {
			$this->Session->setFlash(__('Administrator retired'));
			return $this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Unable to retire administrator'));
	}
	
	public function delete($id) {
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}
		
		if ($this->Admin->delete($id)) {
			$this->Session->setFlash(__('Administrator successfully deleted'));
			return $this->redirect(array('action' => 'all'));
		}
	}
}