<?php
App::uses('DboSource', 'Model/DataSource');

class UsersController extends AppController {
	
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('logout', 'login');
	}
/****************************************************************************
 * USER LOG IN
 * Allows the user to log in and begin a session
 ****************************************************************************
 */ 
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
/****************************************************************************
 * THE LOG IN PAGE
 * Allows the user to log out and end session
 ****************************************************************************
 */ 
	public function logout() {
		return $this->redirect($this->Auth->logout());
	}
/****************************************************************************
 * THE INDEX (HOME PAGE) FUNCTION
 * This function grabs data from the model and passes it to the Index in
 * app\View\Users\Index.ctp.
 *
 * 2015-10-28 OB: Commenting out My Member Institutions, My Smart Forms,
 * and My Enrolling Committees sections (in V and C). "Go-Live" tracking
 * is no longer implemented in Support Portal, and Wizards are now tracked as
 * templates (Smart Forms) and requests (Wizard Projects)
 ****************************************************************************
 */ 
	public function index() {
		// This page is called Home
		$this->set('title_for_layout', 'Home');
		// This user's account 
		if (CakeSession::read('Auth.User.active') == 0) {
			$this->Session->setFlash('Your account is inactive', 'default', array('class' => 'alert alert-danger'));
			$this->redirect(array('action' => 'logout'));
		}
		// Get the user's name and user ID from the session information, and populate page accordingly.
		$user_id = CakeSession::read('Auth.User.id');
		$user = $this->User->findById($user_id);
		$this->set('user', $user);
		// Create a list of active letter requests that this user is working on.
		$this->loadModel('Letter');
		$this->set('letters', $this->Letter->find('all', array('conditions' => array('Letter.request_owner'=> $user_id, 'Letter.active' => true, 'Letter.type' => 'Letter'))));
		$this->set('stamps', $this->Letter->find('all', array('conditions' => array('Letter.request_owner'=> $user_id, 'Letter.active' => true, 'Letter.type' => 'Stamp'))));
		// Create a list of active smart form projects that this user is working on.
		$this->loadModel('SmartFormProject');
		$this->set('smartFormProjects',$this->SmartFormProject->find('all',array('conditions' => array('SmartFormProject.user_id'=> $user_id, 'SmartFormProject.active' => true))));

		// Create a list of members where this user is listed as the member specialist (REMOVED)
		// $this->loadModel('Member');
		// this->set('members', $this->Member->find('all', array('conditions' => array('Member.specialist' => $user_id))));
		// Create a list of Smart Forms in which user is listed as Wizard Developer (REMOVED)
		// $this->loadModel('SmartForm');
		// $this->set('smartForms', $this->SmartForm->find('all', array('conditions' => array('SmartForm.developer' => $user_id, 'SmartForm.status' => 'In Development'), 'order' => 'SmartForm.launch_date')));
		// Create a list of Enrolling Committees in which user is listed as Enrollment Specialist (REMOVED)
		// $enrolling_committees = array();
		// for($i = 0; $i < count($user['Committee']); $i++) {
		// 	if($user['Committee'][$i]['status'] == 'Enrolling') {
		// 		array_push($enrolling_committees, $this->Member->find('all', array('conditions' => array('Member.id' => $user['Committee'][$i]['member_id']))));
		// 	}
		// }
		// $this->set('enrolling_committees', $enrolling_committees);

	}
	
/****************************************************************************
 * THE MASTER USERS LIST
 * This users list provides info on the user's role, privileges, status, and
 * last log-in. It is available to site admins ONLY.
 ****************************************************************************
 */ 
	public function all() {
		$user_role = CakeSession::read('Auth.User.role');
		if ($user_role != 'site_admin') {
			throw new MethodNotAllowedException(__('Unable to access this page'));
		}
		$this->set('users', $this->User->find('all'));
	}

/****************************************************************************
 * THE USER PROFILE
 * Allows the user to view their own specific account info.
 ****************************************************************************
 */ 
	public function view($id = null) {
		// Grab this user's information from Session.
		$user_role = CakeSession::read('Auth.User.role');
		$user_id = CakeSession::read('Auth.User.id');
		// This page is called the User Profile
		$this->set('title_for_layout', 'User Profile');
		// Check for permissions.
		if (($user_role != 'site_admin') && ($user_id != $id)) {
			throw new ForbiddenException(__('Unable to access this page'));
		}
		// Check if User exists.
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user.'));
		}
		// Send user data to User Profile page.
		$this->set('user', $this->User->read(null, $id));
	}
/****************************************************************************
 * ADD NEW USER
 * Allows SITE ADMINS ONLY to add new users to the Support Portal
 ****************************************************************************
 */ 
	public function add() {
		// Grab this user's information from Session.
		$user_role = CakeSession::read('Auth.User.role');
		// Check for permissions.
		if ($user_role != 'site_admin') {
			throw new ForbiddenException(__('Unable to access this page'));
		}
		// When user submits form via POST, take form and add to db
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash('New user added', 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash('Unable to save new user', 'default', array('class' => 'alert alert-danger'));
		}
	}
/****************************************************************************
 * EDIT USER INFO
 * Allows user details to be edited by SITE ADMINS (all) and USERS (specific)
 ****************************************************************************
 */ 
	public function edit($id = null) {
		// Grab this user's information from Session.
		$this->User->id = $id;
		$user_id = CakeSession::read('Auth.User.id');
		$user_role = CakeSession::read('Auth.User.role');
		// This page is called the Edit Profile
		$this->set('title_for_layout', 'Edit Profile');
		// Check for permissions
		if (($user_role != 'site_admin') && ($user_id != $id)) {
			throw new ForbiddenException(__('Unable to access this page'));
		}
		// If user details not found, throw error
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user.'));
		}
		// When user submits form via POST or PUT, take form and add to db
		if ($this->request->is('post') || $this->request->is('put')) {
			// Check if successful.
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
/****************************************************************************
 * EDIT USER PASSWORD
 * Allows user password to be edited by SITE ADMINS (all) and USERS (specific)
 ****************************************************************************
 */ 
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
/****************************************************************************
 * ACTIVATE USER
 * Allows users to be reactivated if they have been deactivated.
 ****************************************************************************
 */ 
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
/****************************************************************************
 * ACTIVATE USER
 * Allows users to be deactivated if they are active.
 ****************************************************************************
 */ 
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
/****************************************************************************
 * DELETE USER
 * Allows users to be deleted if they have been deactivated. Has not been
 * implemented in view.
 ****************************************************************************
 */ 
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