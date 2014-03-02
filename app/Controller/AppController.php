<?php
App::uses('Controller', 'Controller');

class AppController extends Controller {
	public $components = array(
		'DebugKit.Toolbar',
		'Session',
		'Auth' => array(
			'loginRedirect' => array('controller' => 'posts', 'action' => 'index'),
			'logoutRedirect' => array('controller' => 'pages', 'action' => 'display', 'home')
		)
	);
	
	public function beforeFilter() {
		$this->Auth->allow('index', 'view');
	}
}
