<?php
class InteractionsController extends AppController {
/**
 * 2016-01-25 OB: this controller contains functions that were once used to track interactions with a staff at a local IRB.
 * This was largely in response to the discovery that some institutions wouldn't contact Support for months/years. 
 * Interactions, however, were never updated by Support staff, and was a failed experiment in CRM-style interaction tracking and ticketing.
 * Zack and I decided to remove committees from the system altogether.
 */ 
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

	public function all($member_id = null) {
		if(!$member_id) {
			throw new NotFoundException(__('Invalid member'));
		}
		$this->loadModel('Member');
		$this->set('member', $this->Member->findById($member_id));
		$this->set('interactions', $this->Interaction->find('all', array('conditions' => array('Interaction.member_id' => $member_id), 'order' => 'Interaction.date')));
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