<?php
class CommitteesController extends AppController {
	public function index() {
		$this->set('committees', $this->Committee->find('all');
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
	
	public function add() {
		if ($this->request->is('post')) {
			$this->Committee->create();
			if ($this->Committee->save($this->request->data)) {
				$this->Session->setFlash(__('Your committee has been saved'));
				return $this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('Unable to add your committee'));
		}
	}
	
	public function edit($id = null) {
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
				return $this->redirect(array('action' => 'view', $id));
			}
			$this->Session->setFlash(__('Unable to save your committee'));
		}
		
		if (!$this->request->data) {
			$this->request->data = $post;
		}
	}
	
	public function delete($id) {
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}
		
		if ($this->Committee->delete($id)) {
			$this->Session->setFlash(__('The committee with id: %s has been deleted.', h($id)));
			return $this->redirect(array('action' => 'index'));
		}
	}
}