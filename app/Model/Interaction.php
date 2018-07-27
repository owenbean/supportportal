<?php
class Interaction extends AppModel {
	public $belongsTo = array('User', 'Member', 'Admin');
	
	public $validate = array(
		'admin_id' => array(
			'rule' => 'notBlank'
		),
		'interaction_type' => array(
			'rule' => 'notBlank',
		),
		'date' => array(
			'rule' => 'notBlank'
		),
		'purpose' => array(
			'rule' => 'notBlank'
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