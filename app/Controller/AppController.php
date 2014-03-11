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
	
}
