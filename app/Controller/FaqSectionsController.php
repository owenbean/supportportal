<?php
class FaqSectionsController extends AppController {
  public $helpers = array('Markdown.Markdown');

  public function beforeFilter(){
    parent::beforeFilter();
    $faq_editor = CakeSession::read('Auth.User.faq_editor');
    if ($faq_editor != 1) {
      throw new MethodNotAllowedException(__('Unable to access this page'));
    }
  }

  public function index() {
		$this->set('faqSections', $this->FaqSection->find('all'));
	}

	public function add() {
		if ($this->request->is('post')) {
			$this->FaqSection->create();
			if ($this->FaqSection->save($this->request->data)) {
				$this->Session->setFlash(__('New FAQ section added.'));
				return $this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('Unable to save new FAQ section'));
		}
	}

	public function edit($id = null) {
    if (!$id) {
        throw new NotFoundException(__('Invalid section'));
    }

    $section = $this->FaqSection->findById($id);
    if (!$section) {
        throw new NotFoundException(__('Invalid section'));
    }

    if ($this->request->is(array('post', 'put'))) {
        $this->FaqSection->id = $id;
        if ($this->FaqSection->save($this->request->data)) {
            $this->Session->setFlash(__('The section has been updated.'));
            return $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Unable to update the section.'));
    }

    if (!$this->request->data) {
        $this->request->data = $section;
    }
	}

	public function delete($id) {
    if ($this->request->is('get')) {
        throw new MethodNotAllowedException();
    }

    if ($this->FaqSection->delete($id)) {
        $this->Session->setFlash(
            __('The section has been deleted.')
        );
        return $this->redirect(array('action' => 'index'));
    }
	}
}