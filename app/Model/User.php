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
				'rule' => array('isUnique'),
				'notEmpty' => true,
				'message' => 'Your username must be unique'
			)
		),
		'email_address' => array(
			'rule' => 'isUnique',
			'notEmpty' => true,
			'message' => 'Your email address must be unique'
		),
		'password' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'A password is required.'
			)
		),
		'role' => array(
			'rule' => 'notEmpty'
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