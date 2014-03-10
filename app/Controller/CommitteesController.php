<?php
class CommitteesController extends AppController {
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
		$members = $member_id;
		$this->set(compact('members'));
		if ($this->request->is('post')) {
			$this->Committee->create();
			if ($this->Committee->save($this->request->data)) {
				$this->Session->setFlash(__('Your committee has been saved'));
				return $this->redirect(array('controller' => 'members', 'action' => 'view', $member_id));
			}
			$this->Session->setFlash(__('Unable to add your committee'));
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
			if ($this->Committee->save($this->request->data)) {
				$this->Session->setFlash(__('Your committee has been updated'));
				return $this->redirect(array('controller' => 'members', 'action' => 'view', $member_id));
			}
			$this->Session->setFlash(__('Unable to save your committee'));
		}
		
		if (!$this->request->data) {
			$this->request->data = $committee;
		}
	}
	
	public function delete($member_id, $id) {
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}
		
		if ($this->Committee->delete($id)) {
			$this->Session->setFlash(__('Committee deleted'));
			return $this->redirect(array('controller' => 'members', 'action' => 'view', $member_id));
		}
	}
}