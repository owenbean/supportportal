<?php
App::uses('DboSource', 'Model/DataSource');

class LettersController extends AppController {
	public $components = array('RequestHandler');
	
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('lettersDueToday');
	}

	public function active() {
		$this->set('letters', $this->Letter->find('all', array('conditions' => array('Letter.active' => true), 'order' => 'Letter.target_date')));
	}
	
	public function history($search = null) {
		$this->Letter->validate = null;
		$this->loadModel('Member');

		//this loads member list into dropdown menu
		$members = $this->Member->find('list', array('fields' => array('Member.id', 'Member.full_name'), 'order' => 'Member.full_name'));
		$this->set(compact('members'));
		
		//if member_id not set at all, user hasn't searched. is member_id is null, user searched for all requests
		if (isset($_GET['member_id']) && $_GET['member_id'] == null) {
			$this->set('letters', $this->Letter->find('all', array('order' => array('Letter.date_received' => 'asc'))));
		} else if (isset($_GET['member_id'])) {
			//this sets the member for calling at top of list
			$member = $this->Member->findById($_GET['member_id']);
			$this->set('member', $member);
			
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

		$this->set('user_id', CakeSession::read('Auth.User.id'));
		$this->set('letter', $letter);
	}
	
	public function add() {
		$this->loadModel('Member');
		$members = $this->Member->find('list', array('fields' => array('Member.id', 'Member.full_name'), 'conditions' => array('Member.active' => true), 'order' => 'Member.full_name'));
		$this->set(compact('members'));
		
		if ($this->request->is('post')) {
			$this->Letter->create();
			if ($this->Letter->save($this->request->data)) {
				$this->Session->setFlash('Letter request successfully added', 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'active'));
			}
			$this->Session->setFlash('Unable to add letter request', 'default', array('class' => 'alert alert-danger'));
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
				$this->Session->setFlash('Letter request successfully updated', 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'view', $id));
			}
			$this->Session->setFlash('Unable to update letter request', 'default', array('class' => 'alert alert-danger'));
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
			$this->Session->setFlash('Letter request claimed', 'default', array('class' => 'alert alert-success'));
			return $this->redirect(array('action' => 'active'));
		}
		$this->Session->setFlash('Unable to claim letter request', 'default', array('class' => 'alert alert-danger'));
	}
	
	public function unclaim($id) {
		if (!$id) {
			throw new NotFoundException(__('Invalid letter request'));
		}
		
		$user_id = CakeSession::read('Auth.User.id');
		$this->Letter->id = $id;
		if ($this->Letter->save($this->Letter->set(array('request_owner' => null, 'claimed_date' => null)))) {
			$this->Session->setFlash('Letter request unclaimed', 'default', array('class' => 'alert alert-success'));
			return $this->redirect(array('action' => 'view', $id));
		}
		$this->Session->setFlash('Unable to unclaim letter request', 'default', array('class' => 'alert alert-danger'));
	}
	
	public function complete($id) {
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}
		
		$this->Letter->id = $id;
		if ($this->Letter->save($this->Letter->set(array('active' => 0, 'completed_date' => DboSource::expression('NOW()'))))) {
			$this->lettersCompleteEmail($id);
			$this->Session->setFlash('Letter request completed', 'default', array('class' => 'alert alert-success'));
			return $this->redirect(array('action' => 'active'));
		}
		$this->Session->setFlash('Unable to complete letter request', 'default', array('class' => 'alert alert-danger'));
	}
	
	public function delete($id) {
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}
		
		if ($this->Letter->delete($id)) {
			$this->Session->setFlash('Letter request successfully deleted', 'default', array('class' => 'alert alert-success'));
			return $this->redirect(array('action' => 'active'));
		}
	}
	
	public function lettersCompleteEmail($letter_id) {
		App::uses('CakeEmail', 'Network/Email');
        $letter = $this->Letter->find('first', array('conditions' => array('Letter.id' => $letter_id)));

		//load Users and find Support Desk account, for email purposes
		$this->loadModel('User');
        $support = $this->User->find('first', array('conditions' => array('User.username' => 'support')));
        
        if ($letter === false) {
            debug(__METHOD__." failed to retrieve User data for user.id: {$user_id}");
            return false;
        }
		
        $user_name = $letter['User']['first_name'];
        $support_email_address = $support['User']['email_address'];
		$member_name = $letter['Member']['full_name'];
		$member_short_name = $letter['Member']['short_name'];
		$date_received = $letter['Letter']['date_received'];
		$target_date = $letter['Letter']['target_date'];

		$Email = new CakeEmail('gmail');
		$Email->from(array('letters@irbnet.org' => 'IRBNet Letter Team'));
		$Email->to($support_email_address);
		$Email->subject('Letter Request Completed - ' . $member_short_name);
		$Email->template('letters_complete');
		$Email->emailFormat('html');
		$Email->viewVars(array('user_name' => $user_name, 'member_name' => $member_name, 'date_received' => $date_received, 'target_date' => $target_date));
		$Email->send();
	}

	//this function runs every day via a Cron Job and send an email for each active letter request due that day
	public function lettersDueToday() {
		App::uses('CakeEmail', 'Network/Email');
		
		$letters = $this->Letter->find('all', array('conditions' => array('Letter.target_date' => date('Y-m-d'), 'Letter.active' => true)));
		
		//load Users and find Support Desk account, for email purposes
		$this->loadModel('User');
        $support = $this->User->find('first', array('conditions' => array('User.username' => 'support')));
		
		$this->set('letters', $letters);

		if($this->request->is('post')) {
			foreach($letters as $letter):
		        $user_name = $letter['User']['first_name'];
        		$support_email_address = $support['User']['email_address'];
		    	$user_email = $letter['User']['email_address'];
				$member_name = $letter['Member']['full_name'];
				$member_short_name = $letter['Member']['short_name'];
				$date_received = $letter['Letter']['date_received'];
				$target_date = $letter['Letter']['target_date'];

				if($user_name) {
					$Email = new CakeEmail('gmail');
					$Email->from(array('letters@irbnet.org' => 'IRBNet Letter Team'));
					$Email->to($user_email);
					$Email->cc($support_email_address);
					$Email->subject('Letter Request Due - ' . $member_short_name);
					$Email->template('claimed_letters_due');
					$Email->emailFormat('html');
					$Email->viewVars(array('user_name' => $user_name, 'member_name' => $member_name, 'date_received' => $date_received, 'target_date' => $target_date));
					$Email->send();
				} else {
					$Email = new CakeEmail('gmail');
					$Email->from(array('letters@irbnet.org' => 'IRBNet Letter Team'));
					$Email->to($support_email_address);
					$Email->subject('Unclaimed Letter Request Due - ' . $member_short_name);
					$Email->template('unclaimed_letters_due');
					$Email->emailFormat('html');
					$Email->viewVars(array('user_name' => 'Support', 'member_name' => $member_name, 'date_received' => $date_received, 'target_date' => $target_date));
					$Email->send();				
				}
			endforeach;
			unset($letter);
		}
	}
}