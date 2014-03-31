<?php
class SmartForm extends AppModel {
	public $belongsTo = array(
		'Member' => array(
			'className' => 'Member'
		),
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'developer'
		)
	);
	
	public $validate = array(
		'name' => array(
			'rule' => 'notEmpty',
		),
		'sf_domain' => array(
			'rule' => 'notEmpty'
		),
		'status' => array(
			'rule' => 'notEmpty'
		),
		'launch_date' => array(
			'rule' => 'notEmpty'
		)
	);
	
	public function beforeSave($options = array()) {
		$user_id = CakeSession::read('Auth.User.id');
		if (!strlen($this->id)) {
			$this->data[$this->alias]['last_updated_by'] = $user_id;
			$this->data[$this->alias]['added_by'] = $user_id;
		} else {
			$this->data[$this->alias]['last_updated_by'] = $user_id;
		}
	}
}