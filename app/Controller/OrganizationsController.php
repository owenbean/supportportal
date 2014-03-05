<?php
class OrganizationsController extends AppController {
	public function all($options = null) {
		if (!$options) {
			$this->set('organizations', $this->Organization->find('all'));
		} else {
			$this->set('organizations', $this->Organization->find('all', array('conditions' => array("Organization.$options" => true))));
		}
	}
	
	public function view($id = null) {
		if (!$id) {
			throw new NotFoundException(__('Invalid organization'));
		}
		
		$organization = $this->Organization->findById($id);
		if (!$organization) {
			throw new NotFoundException(__('Invalid organization'));
		}
		$this->set('organization', $organization);
	}
	
	public function add() {
		$this->loadModel('User');
		$specialists = $this->User->find('list', array('fields' => array('User.id', 'User.first_name')));
		$this->set(compact('specialists'));
		if ($this->request->is('post')) {
			$this->Organization->create();
			if ($this->Organization->save($this->request->data)) {
				$this->Session->setFlash(__('Organization created'));
				return $this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('Unable to save organization'));
		}
	}
	
	public function edit($id = null) {
		$this->loadModel('User');
		$specialists = $this->User->find('list', array('fields' => array('User.id', 'User.first_name')));
		$this->set(compact('specialists'));
		if (!$id) {
			throw new NotFoundException(__('Invalid organization'));
		}
		
		$organization = $this->Organization->findById($id);
		if (!$organization) {
			throw new NotFoundException(__('Invalid organization'));
		}
		
		if ($this->request->is(array('post', 'put'))) {
			$this->Organization->id = $id;
			if ($this->Organization->save($this->request->data)) {
				$this->Session->setFlash(__('Organization saved'));
				return $this->redirect(array('action' => 'view', $id));
			}
			$this->Session->setFlash(__('Unable to save organization'));
		}
		
		if (!$this->request->data) {
			$this->request->data = $organization;
		}
	}
}