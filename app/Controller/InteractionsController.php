<?php
class InteractionsController extends AppController {
	public function add($member_id) {
		$members = $member_id;
		$this->set(compact('members'));
		$users = CakeSession::read('Auth.User.id');
		$this->set(compact('users'));
		$this->loadModel('Admin');
		$admins = $this->Admin->find('all', array('conditions' => array('Admin.member_id' => $member_id, 'Admin.active' => true)));
		$this->set(compact('admins'));
		
		if ($this->request->is('post')) {
			$this->Interaction->create();
			if ($this->Interaction->save($this->request->data)) {
				$this->Session->setFlash(__('Interaction successfully added'));
				return $this->redirect(array('controller' => 'members', 'action' => 'view', $member_id));
			}
			$this->Session->setFlash(__('Unable to add interaction'));
		}
	}
	
	public function edit($id) {
		if (!$id) {
			throw new NotFoundException(__('Invalid interaction'));
		}
		
		$interaction = $this->Interaction->findById($id);
		if (!$interaction) {
			throw new NotFoundException(__('Invalid interaction'));
		}
		
		if ($this->request->is(array('post', 'put'))) {
			$this->Interaction->id = $id;
			if ($this->Interaction->save($this->request->data)) {
				$this->Session->setFlash(__('Interaction successfully updated'));
				return $this->redirect(array('action' => 'view', $id));
			}
			$this->Session->setFlash(__('Unable to update interaction'));
		}
		
		if (!$this->request->data) {
			$this->request->data = $interaction;
			$this->set('interaction', $interaction);
		}
	}
	
	public function view($id = null) {
		if (!$id) {
			throw new NotFoundException(__('Invalid interaction'));
		}
		
		$interaction = $this->Interaction->findById($id);
		if (!$interaction) {
			throw new NotFoundException(__('Invalid interaction'));
		}
		$this->set('interaction', $interaction);
	}
	
	public function delete($member_id, $id) {
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}
		
		if ($this->Interaction->delete($id)) {
			$this->Session->setFlash(__('Interaction successfully deleted'));
			return $this->redirect(array('controller' => 'members', 'action' => 'view', $member_id));
		}
	}	
}