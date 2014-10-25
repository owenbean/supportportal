<?php
class FaqQuestionsController extends AppController {
	public function add() {
		$this->loadModel('FaqSection');
		$faqSections = $this->FaqSection->find('list', array('fields' => array('FaqSection.id', 'FaqSection.name')));
		$this->set(compact('faqSections'));
		if ($this->request->is('post')) {
			$this->FaqQuestion->create();
			if ($this->FaqQuestion->save($this->request->data)) {
				$this->Session->setFlash(__("Question successfully added"));
				return $this->redirect(array('controller' => 'faqSections', 'action' => 'index'));
			}
			$this->Session->setFlash(__("Unable to add question"));
		}
	}

	public function edit($id = null) {
    if (!$id) {
        throw new NotFoundException(__('Invalid question'));
    }

    $this->loadModel('FaqSection');
    $faqSections = $this->FaqSection->find('list', array('fields' => array('FaqSection.id', 'FaqSection.name')));
    $this->set(compact('faqSections'));
    
    $question = $this->FaqQuestion->findById($id);
    if (!$question) {
        throw new NotFoundException(__('Invalid question'));
    }

    if ($this->request->is(array('post', 'put'))) {
        $this->FaqQuestion->id = $id;
        if ($this->FaqQuestion->save($this->request->data)) {
            $this->Session->setFlash(__('The question has been updated.'));
            return $this->redirect(array('controller' => 'faqSections', 'action' => 'index'));
        }
        $this->Session->setFlash(__('Unable to update the question.'));
    }

    if (!$this->request->data) {
        $this->request->data = $question;
    }
	}

	public function delete($id) {
    if ($this->request->is('get')) {
        throw new MethodNotAllowedException();
    }

    if ($this->FaqQuestion->delete($id)) {
        $this->Session->setFlash(
            __('The question has been deleted.')
        );
        return $this->redirect(array('controller' => 'faqSections', 'action' => 'index'));
    }
	}
}