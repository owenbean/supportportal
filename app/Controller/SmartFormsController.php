<?php
class SmartFormsController extends AppController {
	public function index() {
		$this->set('smartForms', $this->SmartForm->find('all'));
	}
	
	public function view($id = null) {
		if (!$id) {
			throw new NotFoundException(__('Invalid Smart Form'));
		}
		
		$smartForm = $this->SmartForm->findById($id);
		if (!$smartForm) {
			throw new NotFoundException(__('Invalid Smart Form'));
		}
		$this->set('smartForm', $smartForm);
	}
	
	public function add($member_id) {
		$this->loadModel('User');
		$users = $this->User->find('list', array('fields' => array('User.id', 'User.first_name'), 'order' => 'User.first_name', 'conditions' => array('User.role' => array('site_admin', 'admin'))));
		$this->set(compact('users'));
		
		$members = $member_id;
		$this->set(compact('members'));
		if ($this->request->is('post')) {
			$this->SmartForm->create();
			if ($this->SmartForm->save($this->request->data)) {
				$this->Session->setFlash(__('Smart Form successfully added'));
				return $this->redirect(array('controller' => 'members', 'action' => 'view', $member_id));
			}
			$this->Session->setFlash(__('Unable to add Smart Form'));
		}
	}
	
	public function edit($member_id, $id = null) {
		if (!$id) {
			throw new NotFoundException(__('Invalid Smart Form'));
		}
		
		$smartForm = $this->SmartForm->findById($id);
		if (!$smartForm) {
			throw new NotFoundException(__('Invalid Smart Form'));
		}
		
		if ($this->request->is(array('post', 'put'))) {
			$this->SmartForm->id = $id;
			if ($this->SmartForm->save($this->request->data)) {
				$this->Session->setFlash(__('Smart Form successfully updated'));
				return $this->redirect(array('controller' => 'members', 'action' => 'view', $member_id));
			}
			$this->Session->setFlash(__('Unable to update Smart Form'));
		}
		
		if (!$this->request->data) {
			$this->loadModel('User');
			$users = $this->User->find('list', array('fields' => array('User.id', 'User.first_name'), 'order' => 'User.first_name', 'conditions' => array('User.role' => array('site_admin', 'admin'))));
			$this->set(compact('users'));
		
			$this->request->data = $smartForm;
		}
	}
	
	public function delete($member_id, $id) {
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}
		
		if ($this->SmartForm->delete($id)) {
			$this->Session->setFlash(__('Smart Form deleted'));
			return $this->redirect(array('controller' => 'members', 'action' => 'view', $member_id));
		}
	}
}