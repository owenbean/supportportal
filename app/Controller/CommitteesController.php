<?php
class CommitteesController extends AppController {
/**
 * 2016-01-25 OB: this controller contains functions that were once used to track committees within a member. 
 * Committees, however, were not frequently updated, and Zack and I decided to remove committees from the system altogether.
 */ 
	public function index() {
		$this->set('committees', $this->Committee->find('all'));
	}
	public function view($id = null) {
		if (!$id) {
			throw new NotFoundException(__('Invalid committee'));
		}
		
		$committee = $this->Committee->findById($id);
		if (!$committee) {
			throw new NotFoundException(__('Invalid committee'));
		}
		$this->set('committee', $committee);
	}
	
	public function add($member_id) {
		$this->loadModel('User');
		$users = $this->User->find('list', array('fields' => array('User.id', 'User.first_name'), 'order' => 'User.first_name', 'conditions' => array('User.role' => array('site_admin', 'admin'))));
		$this->set(compact('users'));
		
		$members = $member_id;
		$this->set(compact('members'));
		if ($this->request->is('post')) {
			$this->Committee->create();
			if ($this->Committee->saveAll($this->request->data)) {
				$this->Session->setFlash(__('Committee successfully added'));
				return $this->redirect(array('controller' => 'members', 'action' => 'view', $member_id));
			}
			$this->Session->setFlash(__('Unable to add committee'));
		}
	}
	
	public function edit($member_id, $id = null) {
		if (!$id) {
			throw new NotFoundException(__('Invalid committee'));
		}
		
		$committee = $this->Committee->findById($id);
		if (!$committee) {
			throw new NotFoundException(__('Invalid committee'));
		}
		
		if ($this->request->is(array('post', 'put'))) {
			$this->Committee->id = $id;
			$user_id = CakeSession::read('Auth.User.id');
			if ($this->Committee->saveAll($this->request->data)) {
				$this->Session->setFlash(__('Committee successfully updated'));
				return $this->redirect(array('controller' => 'members', 'action' => 'view', $member_id));
			}
			$this->Session->setFlash(__('Unable to update committee'));
		}
		
		if (!$this->request->data) {
			$this->loadModel('User');
			$users = $this->User->find('list', array('fields' => array('User.id', 'User.first_name'), 'order' => 'User.first_name', 'conditions' => array('User.role' => array('site_admin', 'admin'))));
			$this->set(compact('users'));
			
			$this->request->data = $committee;
		}
	}
	
	public function delete($member_id, $id) {
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}
		
		if ($this->Committee->delete($id)) {
			$this->Session->setFlash(__('Committee successfully deleted'));
			return $this->redirect(array('controller' => 'members', 'action' => 'view', $member_id));
		}
	}
}