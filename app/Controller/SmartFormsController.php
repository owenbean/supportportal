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
	
	public function edit($id = null) {
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
				return $this->redirect(array('action' => 'view', $id));
			}
			$this->Session->setFlash(__('Unable to save your Smart Form'));
		}
		
		if (!$this->request->data) {
			$this->request->data = $post;
		}
	}
	
	public function delete($id) {
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}
		
		if ($this->SmartForm->delete($id)) {
			$this->Session->setFlash(__('The Smart Form with id: %s has been deleted.', h($id)));
			return $this->redirect(array('action' => 'index'));
		}
	}
}