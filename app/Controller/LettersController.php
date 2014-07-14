<?php
App::uses('DboSource', 'Model/DataSource');

class LettersController extends AppController {
	public $components = array('RequestHandler');
	
	public function active() {
		$this->set('letters', $this->Letter->find('all', array('conditions' => array('Letter.active' => true), 'order' => 'Letter.target_date')));
	}
	
	public function history($search = null) {
		$this->Letter->validate = null;
		$this->loadModel('Member');
		$members = $this->Member->find('list', array('fields' => array('Member.id', 'Member.full_name'), 'order' => 'Member.full_name'));
		$this->set(compact('members'));
		if (isset($_GET['member_id']) && $_GET['member_id'] == null) {
			$this->set('letters', $this->Letter->find('all', array('order' => array('Letter.date_received' => 'asc'))));
		} else if (isset($_GET['member_id'])) {
			$this->set('letters', $this->Letter->find('all', array('conditions' => array('Letter.member_id' => $_GET['member_id']), 'order' => array('Letter.date_received' => 'asc'))));
		} else {
			$this->set('letters', null);
		}
	}
	
	public function view($id = null) {
		if (!$id) {
			throw new NotFoundException(__('Invalid letter request'));
		}
		
		$letter = $this->Letter->findById($id);
		if (!$letter) {
			throw new NotFoundException(__('Invalid letter request'));
		}
		$this->set('letter', $letter);
	}
	
	public function add() {
		$this->loadModel('Member');
		$members = $this->Member->find('list', array('fields' => array('Member.id', 'Member.full_name'), 'conditions' => array('Member.active' => true), 'order' => 'Member.full_name'));
		$this->set(compact('members'));
		
		if ($this->request->is('post')) {
			$this->Letter->create();
			if ($this->Letter->save($this->request->data)) {
				$this->Session->setFlash(__('Letter request successfully added'));
				return $this->redirect(array('action' => 'active'));
			}
			$this->Session->setFlash(__('Unable to add letter request'));
		}
	}
	
	public function list_admin() {
		if($this->RequestHandler->isAjax()) {
			$this->loadModel('Admin');
			$member_id = $_GET['member_id'];
			$this->set('member_id', $member_id);
			$submitters = $this->Admin->find('all', array('conditions' => array('Admin.member_id' => $member_id, 'Admin.active' => true)));
			$this->set('submitter_names', $submitters);
		} else {
			$this->redirect(array('action' => 'add'));
		}
	}
	
	public function edit($id = null) {
		if (!$id) {
			throw new NotFoundException(__('Invalid letter request'));
		}
		
		$letter = $this->Letter->findById($id);
		if (!$letter) {
			throw new NotFoundException(__('Invalid letter request'));
		}
		
		if ($this->request->is(array('post', 'put'))) {
			$this->Letter->id = $id;
			if ($this->Letter->save($this->request->data)) {
				$this->Session->setFlash(__('Letter request successfully updated'));
				return $this->redirect(array('action' => 'view', $id));
			}
			$this->Session->setFlash(__('Unable to update letter request'));
		}
		
		if (!$this->request->data) {
			$this->request->data = $letter;
			$this->set('letter', $letter);
		}
	}
	
	public function claim($id) {
		if (!$id) {
			throw new NotFoundException(__('Invalid letter request'));
		}
		
		$user_id = CakeSession::read('Auth.User.id');
		$this->Letter->id = $id;
		if ($this->Letter->save($this->Letter->set(array('request_owner' => $user_id, 'claimed_date' => DboSource::expression('NOW()'))))) {
			$this->Session->setFlash(__('Letter request claimed'));
			return $this->redirect(array('action' => 'active'));
		}
		$this->Session->setFlash(__('Unable to claim letter request'));
	}
	
	public function complete($id) {
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}
		
		$this->Letter->id = $id;
		if ($this->Letter->save($this->Letter->set(array('active' => 0, 'completed_date' => DboSource::expression('NOW()'))))) {
			$this->lettersCompleteEmail($id);
			$this->Session->setFlash(__('Letter request completed'));
			return $this->redirect(array('action' => 'active'));
		}
		$this->Session->setFlash(__('Unable to complete letter request'));
	}
	
	public function delete($id) {
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}
		
		if ($this->Letter->delete($id)) {
			$this->Session->setFlash(__('Letter request successfully deleted'));
			return $this->redirect(array('action' => 'active'));
		}
	}
	
	public function lettersCompleteEmail($letter_id) {
		App::uses('CakeEmail', 'Network/Email');
        $letter = $this->Letter->find('first', array('conditions' => array('Letter.id' => $letter_id)));
        if ($letter === false) {
            debug(__METHOD__." failed to retrieve User data for user.id: {$user_id}");
            return false;
        }
		
        $user_name = $letter['User']['first_name'];
		$member_name = $letter['Member']['full_name'];
		$member_short_name = $letter['Member']['short_name'];
		$date_received = $letter['Letter']['date_received'];
		$target_date = $letter['Letter']['target_date'];

		$Email = new CakeEmail('gmail');
		$Email->from(array('letters@irbnet.org' => 'IRBNet Letter Team'));
		$Email->to('support@irbnet.org');
		$Email->subject('Letter Request Completed - ' . $member_short_name);
		$Email->template('letters_complete');
		$Email->emailFormat('html');
		$Email->viewVars(array('user_name' => $user_name, 'member_name' => $member_name, 'date_received' => $date_received, 'target_date' => $target_date));
		$Email->send();
	}

	public function lettersDueToday() {
		App::uses('CakeEmail', 'Network/Email');
		$letters = $this->Letter->find('all', array('conditions' => array('Letter.target_date' => date('Y-m-d'))));
		foreach($letters as $letter):
	        $user_name = $letter['User']['first_name'];
	    	$user_email = $letter['User']['email_address'];
			$member_name = $letter['Member']['full_name'];
			$member_short_name = $letter['Member']['short_name'];
			$date_received = $letter['Letter']['date_received'];
			$target_date = $letter['Letter']['target_date'];

			$Email = new CakeEmail('gmail');
			$Email->from(array('letters@irbnet.org' => 'IRBNet Letter Team'));
			$Email->to($user_email);
			$Email->cc('support@irbnet.org');
			$Email->subject('Letter Request Due - ' . $member_short_name);
			$Email->template('letters_due');
			$Email->emailFormat('html');
			$Email->viewVars(array('user_name' => $user_name, 'member_name' => $member_name, 'date_received' => $date_received, 'target_date' => $target_date));
			$Email->send();			
		endforeach;
		unset($letter);
	}
}