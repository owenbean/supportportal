<?php
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class User extends AppModel {
	public $hasMany = array(
		'SmartForm' => array(
			'className' => 'SmartForm',
			'foreignKey' => 'developer'
		)
	);
	
	public $hasAndBelongsToMany = array(
		'Committee' => array(
			'className' => 'Committee',
            'joinTable' => 'committees_users',
            'foreignKey' => 'user_id',
            'associationForeignKey' => 'committee_id',
            'unique' => true,
			'conditions' => array('Committee.status' => 'Enrolling'),
			'order' => 'Committee.go_live_date'
		)
	);
	
	public $validate = array(
		'first_name' => array(
			'rule' => 'notEmpty'
		),
		'last_name' => array(
			'rule' => 'notEmpty'
		),
		'username' => array(
			'required' => array(
				'rule' => 'isUnique',
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
		),
		'password_confirm' => array(
			'identical' => array(
				'rule' => array('identicalFieldValues', 'password'),
				'message' => 'Password confirmation does not match password.'
			)
		)
	);
	
	function identicalFieldValues($data, $compareField) {
		$value = array_values($data);
		$comparewithvalue = $value[0];
		return ($this->data[$this->name][$compareField] == $comparewithvalue);
	}
	
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