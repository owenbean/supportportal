<?php
class Member extends AppModel {
	public $hasMany = 'Admin';
	
	public $validate = array(
		'op_num' => array(
			'rule' => 'notEmpty'
		),
		'short_name' => array(
			'rule' => 'notEmpty'
		),
		'full_name' => array(
			'rule' => 'notEmpty'
		),
		'city' => array(
			'rule' => 'notEmpty'
		),
		'state' => array(
			'rule' => 'notEmpty'
		),
		'enrollment_team' => array(
			'rule' => 'notEmpty'
		),
		'class' => array(
			'valid' => array(
				'rule' => array('inList', array('university', 'hospital', 'va', 'other'))
			)
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