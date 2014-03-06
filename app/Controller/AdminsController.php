<?php
class AdminsController extends AppController {
	public function all($options = null) {
		if (!$options) {
			$this->set('admins', $this->Admin->find('all'));
		} else {
			$this->set('admins', $this->Admin->find('all', array('conditions' => array("Admin.$options" => true))));
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
		if (!$member) {
			$this->loadModel('Member');
			$members = $this->Member->find('list', array('fields' => array('Member.id', 'Member.full_name')));
			$this->set(compact('members'));
		}
		
		if ($this->request->is('post')) {
			$this->Admin->create();
			if ($this->Admin->save($this->request->data)) {
				$this->Session->setFlash(__('Administrator created'));
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
}