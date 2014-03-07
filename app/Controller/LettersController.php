<?php
class LettersController extends AppController {
	public function index() {
		$this->set('letters', $this->Letter->find('all');
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
		if ($this->request->is('post')) {
			$this->Letter->create();
			if ($this->Letter->save($this->request->data)) {
				$this->Session->setFlash(__('Your letter has been saved'));
				return $this->redirect(array('action' => 'index'));
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
			$this->request->data = $post;
		}
	}
	
	public function delete($id) {
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}
		
		if ($this->Letter->delete($id)) {
			$this->Session->setFlash(__('The letter with id: %s has been deleted.', h($id)));
			return $this->redirect(array('action' => 'index'));
		}
	}
}