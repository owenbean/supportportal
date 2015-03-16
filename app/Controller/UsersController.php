<?php
App::uses('DboSource', 'Model/DataSource');

class UsersController extends AppController {
	
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('logout', 'login');
	}

	public function login() {
		if (CakeSession::read('Auth.User.id')) {
			$this->redirect($this->Auth->redirect());
		}
		
		$this->set('title_for_layout', 'Login');
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				$this->User->id = CakeSession::read('Auth.User.id');
				$this->User->save($this->User->set(array('last_login' => DboSource::expression('NOW()'), 'modified' => false)));
				return $this->redirect($this->Auth->redirect());
			}
			$this->Session->setFlash('Invalid username or password', 'default', array('class' => 'alert alert-danger'));
		}
	}
	
	public function logout() {
		return $this->redirect($this->Auth->logout());
	}
	
	public function index() {
		$this->set('title_for_layout', 'Home');
		if (CakeSession::read('Auth.User.active') == 0) {
			$this->Session->setFlash('Your account is inactive', 'default', array('class' => 'alert alert-danger'));
			$this->redirect(array('action' => 'logout'));
		}
		
		$user_id = CakeSession::read('Auth.User.id');
		$user = $this->User->findById($user_id);
		$this->set('user', $user);
		$this->loadModel('Member');
		$this->set('members', $this->Member->find('all', array('conditions' => array('Member.specialist' => $user_id))));
		$this->loadModel('SmartForm');
		$this->set('smartForms', $this->SmartForm->find('all', array('conditions' => array('SmartForm.developer' => $user_id, 'SmartForm.status' => 'In Development'), 'order' => 'SmartForm.launch_date')));
		$enrolling_committees = array();
		for($i = 0; $i < count($user['Committee']); $i++) {
			if($user['Committee'][$i]['status'] == 'Enrolling') {
				array_push($enrolling_committees, $this->Member->find('all', array('conditions' => array('Member.id' => $user['Committee'][$i]['member_id']))));
			}
		}
		$this->set('enrolling_committees', $enrolling_committees);
	}
	
	public function all() {
		$user_role = CakeSession::read('Auth.User.role');
		if ($user_role != 'site_admin') {
			throw new MethodNotAllowedException(__('Unable to access this page'));
		}
		$this->set('users', $this->User->find('all'));
	}
	
	public function view($id = null) {
		$user_role = CakeSession::read('Auth.User.role');
		$user_id = CakeSession::read('Auth.User.id');
		$this->set('title_for_layout', 'User Profile');
		if (($user_role != 'site_admin') && ($user_id != $id)) {
			throw new MethodNotAllowedException(__('Unable to access this page'));
		}
		
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user.'));
		}
		$this->set('user', $this->User->read(null, $id));
	}
	
	public function add() {
		$user_role = CakeSession::read('Auth.User.role');
		if ($user_role != 'site_admin') {
			throw new MethodNotAllowedException(__('Unable to access this page'));
		}
		
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash('New user added', 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash('Unable to save new user', 'default', array('class' => 'alert alert-danger'));
		}
	}
	
	public function edit($id = null) {
		$this->User->id = $id;
		$user_id = CakeSession::read('Auth.User.id');
		$user_role = CakeSession::read('Auth.User.role');
		$this->set('title_for_layout', 'Edit Profile');
		if (($user_role != 'site_admin') && ($user_id != $id)) {
			throw new MethodNotAllowedException(__('Unable to access this page'));
		}
		
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user.'));
		}
		
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash('Your profile has been updated', 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'view', $id));
			}
			$this->Session->setFlash('Your profile could not be updated', 'default', array('class' => 'alert alert-danger'));
		} else {
			$this->request->data = $this->User->read(null, $id);
			unset($this->request->data['User']['password']);
		}
	}
	
	public function password($id = null) {
		$this->User->id = $id;
		$user_id = CakeSession::read('Auth.User.id');
		$user_role = CakeSession::read('Auth.User.role');
		if (($user_role != 'site_admin') && ($user_id != $id)) {
			throw new MethodNotAllowedException(__('Unable to access this page'));
		}
		
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user.'));
		}
		
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash('Your password has been updated', 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'view', $id));
			}
			$this->Session->setFlash('Your password could not be updated', 'default', array('class' => 'alert alert-danger'));
		} else {
			$this->request->data = $this->User->read(null, $id);
			unset($this->request->data['User']['password']);
		}
	}
	
	public function activate($id) {
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}
		
		$this->User->id = $id;
		if ($this->User->save($this->User->set(array('active' => 1)))) {
			$this->Session->setFlash('User activated', 'default', array('class' => 'alert alert-success'));
			return $this->redirect(array('action' => 'all'));
		}
		$this->Session->setFlash(__('Unable to activate user'));
		$this->Session->setFlash('Invalid username or password', 'default', array('class' => 'alert alert-danger'));
	}
	
	public function inactivate($id) {
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}
		
		$this->User->id = $id;
		if ($this->User->save($this->User->set(array('active' => 0)))) {
			$this->Session->setFlash('User inactivated', 'default', array('class' => 'alert alert-success'));
			return $this->redirect(array('action' => 'all'));
		}
		$this->Session->setFlash('Unable to inactivate user', 'default', array('class' => 'alert alert-danger'));
	}
	
	public function delete($id = null) {
		$this->request->onlyAllow('post');
		
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->User->delete()) {
			$this->Session->setFlash('User deleted', 'default', array('class' => 'alert alert-success'));
			return $this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash('User was not deleted', 'default', array('class' => 'alert alert-danger'));
		return $this->redirect(array('action' => 'index'));
	}
}