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
			throw new NotFoundException(__('Invalid members'));
		}
		$this->set('member', $member);
	}
	
	public function add() {
		$this->loadModel('User');
		$specialists = $this->User->find('list', array('fields' => array('User.id', 'User.first_name')));
		$this->set(compact('specialists'));
		if ($this->request->is('post')) {
			$this->Member->create();
			if ($this->Member->save($this->request->data)) {
				$this->Session->setFlash(__('Member created'));
				return $this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('Unable to save member'));
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
				$this->Session->setFlash(__('Member saved'));
				return $this->redirect(array('action' => 'view', $id));
			}
			$this->Session->setFlash(__('Unable to save member'));
		}
		
		if (!$this->request->data) {
			$this->request->data = $member;
		}
	}
}