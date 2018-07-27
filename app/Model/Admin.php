<?php
class Admin extends AppModel {
    public $hasMany = array('SmartFormProject');
	public $belongsTo = 'Member';
	
	public $validate = array(
		'first_name' => array(
			'rule' => 'notBlank'
		),
		'last_name' => array(
			'rule' => 'notBlank'
		),
		'email_address' => array(
			'rule' => 'email',
			'message' => 'Please supply a valid email address.'
		),
		'member_id' => array(
			'rule' => 'notBlank'
		)
	);
	
	public function beforeSave($options = array()) {
		$user_id = CakeSession::read('Auth.User.id');
		if (!strlen($this->id)) {
			$this->data[$this->alias]['added_by'] = $user_id;
			$this->data[$this->alias]['last_updated_by'] = $user_id;
		} else {
			$this->data[$this->alias]['last_updated_by'] = $user_id;
		}
	}
}