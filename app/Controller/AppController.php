<?php
App::uses('Controller', 'Controller');

class AppController extends Controller {
	public $helpers = array('Html', 'Form', 'Js');
	
	public $components = array(
		'DebugKit.Toolbar',
		'Session',
		'Auth' => array(
			'loginRedirect' => array('controller' => 'users', 'action' => 'index'),
			'logoutRedirect' => array('controller' => 'users', 'action' => 'login')
		)
	);
	
    public function beforeFilter() {
        //Set custom authError message if user tries to access a controller when not logged in
        $this->Auth->authError = __('You must be logged in to view this page.'); 
        $this->Auth->flash['params']['class'] = 'alert alert-danger'; 
    }

}

