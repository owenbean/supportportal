<?php
App::uses('DboSource', 'Model/DataSource');

class LettersController extends AppController {
	public function active() {
		$this->set('letters', $this->Letter->find('all', array('conditions' => array('Letter.active' => true))));
	}
	
	public function history($id = null) {
		if (!$id) {
			throw new NotFoundException(__('Please indicate an organization'));
		}
		$this->set('letters', $this->Letter->find('all', array('conditions' => array('Letter.member_id' => $id))));
	}
	
	public function view($id = null) {
		if (!$id) {
			throw new NotFoundException(__('Invalid letter'));
		}
		
		$letter = $this->Letter->findById($id);
		if (!$letter) {
			throw new NotFoundException(__('Invalid letter'));
		}
		$this->set('letter', $letter);
	}
	
	public function add() {
		$this->loadModel('Member');
		$members = $this->Member->find('list', array('fields' => array('Member.id', 'Member.full_name')));
		$this->set(compact('members'));
		if ($this->request->is('post')) {
			$this->Letter->create();
			if ($this->Letter->save($this->request->data)) {
				$this->Session->setFlash(__('Your letter has been saved'));
				return $this->redirect(array('action' => 'active'));
			}
			$this->Session->setFlash(__('Unable to add your letter'));
		}
	}
	
	public function edit($id = null) {
		if (!$id) {
			throw new NotFoundException(__('Invalid letter'));
		}
		
		$letter = $this->Letter->findById($id);
		if (!$letter) {
			throw new NotFoundException(__('Invalid letter'));
		}
		
		if ($this->request->is(array('post', 'put'))) {
			$this->Letter->id = $id;
			if ($this->Letter->save($this->request->data)) {
				$this->Session->setFlash(__('Your letter has been updated'));
				return $this->redirect(array('action' => 'view', $id));
			}
			$this->Session->setFlash(__('Unable to save your letter'));
		}
		
		if (!$this->request->data) {
			$this->request->data = $letter;
		}
	}
	
	public function claim($id) {
		if (!$id) {
			throw new NotFoundException(__('Invalid request'));
		}
		
		$user_id = CakeSession::read('Auth.User.id');
		$this->Letter->id = $id;
		if ($this->Letter->save($this->Letter->set(array('request_owner' => $user_id)))) {
			$this->Session->setFlash(__('Request claimed'));
			return $this->redirect(array('action' => 'active'));
		}
		$this->Session->setFlash(__('Unable to claim request'));
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
		$this->Session->setFlash(__('Unable to complete request'));
	}
	
	public function delete($id) {
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}
		
		if ($this->Letter->delete($id)) {
			$this->Session->setFlash(__('The letter with id: %s has been deleted.', h($id)));
			return $this->redirect(array('action' => 'active'));
		}
	}
}