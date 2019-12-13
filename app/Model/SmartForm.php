<?php
class SmartForm extends AppModel {
    public $hasMany = array('SmartFormProject');
    
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
			'rule' => 'notBlank',
		),
		'sf_domain' => array(
			'rule' => 'notBlank'
		),
		'status' => array(
			'rule' => 'notBlank'
		),
		'launch_date' => array(
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