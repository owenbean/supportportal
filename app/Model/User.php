<?php
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class User extends AppModel {
	public $validate = array(
		'first_name' => array(
			'rule' => 'notEmpty'
		),
		'last_name' => array(
			'rule' => 'notEmpty'
		),
		'username' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'A username is required.'
			)
		),
		'email_address' => array(
			'rule' => 'notEmpty'
		),
		'password' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'A password is required.'
			)
		),
		'role' => array(
			'valid' => array(
				'rule' => array('inList', array('site_admin', 'admin')),
				'message' => 'Please enter a valid role.',
				'allowEmpty' => false
			)
		)
	);
	
	public function beforeSave($options = array()) {
		if (isset($this->data[$this->alias]['password'])) {
			$passwordHasher = new SimplePasswordHasher();
			$this->data[$this->alias]['password'] = $passwordHasher->hash(
				$this->data[$this->alias]['password']
			);
		}
		return true;
	}
}