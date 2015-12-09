<?php
class Letter extends AppModel {
	public $belongsTo = array(
		'Member' => array(
			'className' => 'Member'
		),
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'request_owner'
		),
		'Admin' => array(
			'className' => 'Admin',
			'foreignKey' => 'submitter'
		)
	);
	
	public $validate = array(
		'member_id' => array(
			'rule' => 'notEmpty'
		),
		'submitter' => array(
			'rule' => 'notEmpty'
		),
		'type' => array(
    		'rule' => 'notEmpty'
		),
		'new_templates' => array(
			'rule' => 'numeric',
			'notEmpty' => true,
			'message' => 'Please enter a valid number'
		),
		'revised_templates' => array(
			'rule' => 'numeric',
			'notEmpty' => true,
			'message' => 'Please enter a valid number'
		),
		'date_received' => array(
			'rule' => 'notEmpty'
		),
		'target_date' => array(
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