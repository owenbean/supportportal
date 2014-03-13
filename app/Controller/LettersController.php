<?php
App::uses('DboSource', 'Model/DataSource');

class LettersController extends AppController {
	public $components = array('RequestHandler');
	
	public function active() {
		$this->set('letters', $this->Letter->find('all', array('conditions' => array('Letter.active' => true))));
	}
	
	public function history($search = null) {
		if ($search) {
			$this->set('letters', $this->Letter->find('all'));
		} else {
			$this->set('letters', null);
		}
		//$this->set('letters', $this->Letter->find('all', array('conditions' => array('Letter.member_id' => $id))));
	}
	
	public function view($id = null) {
		if (!$id) {
			throw new NotFoundException(__('Invalid letter request'));
		}
		
		$letter = $this->Letter->findById($id);
		if (!$letter) {
			throw new NotFoundException(__('Invalid letter request'));
		}
		$this->set('letter', $letter);
	}
	
	public function add() {
		$this->loadModel('Member');
		$members = $this->Member->find('list', array('fields' => array('Member.id', 'Member.full_name')));
		$this->set(compact('members'));
		
		if ($this->RequestHandler->isAjax()) {
			$this->render('list_admin', 'ajax');
		}
		
		if ($this->request->is('post')) {
			$this->Letter->create();
			if ($this->Letter->save($this->request->data)) {
				$this->Session->setFlash(__('Letter request successfully added'));
				return $this->redirect(array('action' => 'active'));
			}
			$this->Session->setFlash(__('Unable to add letter request'));
		}
	}
	
	public function list_admin($member_id) {
		$this->loadModel('Admin');
		$admins = $this->Admin->find('list', array('fields' => array('Admin.id', 'Admin.first_name'), 'conditions' => array('Admin.member_id' => $member_id)));
		$this->set(compact('admins'));
	}
	
	public function edit($id = null) {
		if (!$id) {
			throw new NotFoundException(__('Invalid letter request'));
		}
		
		$letter = $this->Letter->findById($id);
		if (!$letter) {
			throw new NotFoundException(__('Invalid letter request'));
		}
		
		if ($this->request->is(array('post', 'put'))) {
			$this->Letter->id = $id;
			if ($this->Letter->save($this->request->data)) {
				$this->Session->setFlash(__('Letter request successfully updated'));
				return $this->redirect(array('action' => 'view', $id));
			}
			$this->Session->setFlash(__('Unable to update letter request'));
		}
		
		if (!$this->request->data) {
			$this->request->data = $letter;
			$this->set('letter', $letter);
		}
	}
	
	public function claim($id) {
		if (!$id) {
			throw new NotFoundException(__('Invalid letter request'));
		}
		
		$user_id = CakeSession::read('Auth.User.id');
		$this->Letter->id = $id;
		if ($this->Letter->save($this->Letter->set(array('request_owner' => $user_id)))) {
			$this->Session->setFlash(__('Letter request claimed'));
			return $this->redirect(array('action' => 'active'));
		}
		$this->Session->setFlash(__('Unable to claim letter request'));
	}
	
	public function complete($id) {
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}
		
		$this->Letter->id = $id;
		if ($this->Letter->save($this->Letter->set(array('active' => 0, 'completed_date' => DboSource::expression('NOW()'))))) {
			$this->Session->setFlash(__('Letter request completed'));
			return $this->redirect(array('action' => 'active'));
		}
		$this->Session->setFlash(__('Unable to complete letter request'));
	}
	
	public function delete($id) {
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}
		
		if ($this->Letter->delete($id)) {
			$this->Session->setFlash(__('Letter request successfully deleted'));
			return $this->redirect(array('action' => 'active'));
		}
	}
}