<?php
class OrganizationsController extends AppController {
	
	public function index() {
		$this->set('organizations', $this->Organization->find('all'));
	}
	
	public function view($id = null) {
		if (!$id) {
			throw new NotFoundException(__('Invalid organization'));
		}
		
		$organization = $this->Organization->findById($id);
		if (!$organization) {
			throw new NotFoundException(__('Invalid organization'));
		}
		$this->set('organization', $organization);
	}
	
	public function add() {
		if ($this->request->is('post')) {
			$this->Organization->create();
			if ($this->Organization->save($this->request->data)) {
				$this->Session->setFlash(__('Your organization has been saved'));
				return $this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('Unable to save organization'));
		}
	}
}