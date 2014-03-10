<?php
class Committee extends AppModel {
	public $belongsTo = 'Member';
	
	public $validate = array(
		'name' => array(
			'rule' => 'notEmpty',
		),
		'board_type' => array(
			'rule' => 'notEmpty'
		),
		'setup' => array(
			'rule' => 'notEmpty'
		),
		'status' => array(
			'rule' => 'notEmpty'
		),
		'go_live_date' => array(
			'rule' => 'notEmpty'
		),
		'funding_model' => array(
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