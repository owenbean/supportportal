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
		$members = $member_id;
		$this->set(compact('members'));
		if ($this->request->is('post')) {
			$this->SmartForm->create();
			if ($this->SmartForm->save($this->request->data)) {
				$this->Session->setFlash(__('Your Smart Form has been saved'));
				return $this->redirect(array('controller' => 'members', 'action' => 'view', $member_id));
			}
			$this->Session->setFlash(__('Unable to add your Smart Form'));
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
				$this->Session->setFlash(__('Your Smart Form has been updated'));
				return $this->redirect(array('controller' => 'members', 'action' => 'view', $member_id));
			}
			$this->Session->setFlash(__('Unable to save your Smart Form'));
		}
		
		if (!$this->request->data) {
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