<?php
class Member extends AppModel {
	public $hasMany = array(
		'Admin' => array(
			'dependent'=>true
		), 
		'Committee' => array(
			'dependent'=>true
		),
		'Letter' => array(
			'dependent'=>true
		), 
		'SmartForm' => array(
			'dependent'=>true
		),
		'Interaction' => array(
			'dependent'=>true
		),
		'SmartFormProject' => array(
			'dependent'=>true
		)
	);
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'specialist'
		)
	);
	
	public $validate = array(
		'op_num' => array(
			'rule' => 'isUnique',
			'notEmpty' => true,
			'message' => 'Please choose a unique ID.'
		),
		'short_name' => array(
			'rule' => 'isUnique',
			'notEmpty' => true,
			'message' => 'Please choose a unique Short Name.'
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
		'class' => array(
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