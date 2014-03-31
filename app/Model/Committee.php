<?php
class Committee extends AppModel {
	public $belongsTo = 'Member';
	
	public $hasAndBelongsToMany = array(
		'User' => array(
			'className' => 'User',
            'joinTable' => 'committees_users',
            'foreignKey' => 'committee_id',
            'associationForeignKey' => 'user_id',
            'unique' => true
		)
	);
	
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
	
	public function addUser($cid, $uid) {
	        $this->data['User']['id'] = $cid;
	        $this->data['Committee']['id'] = $uid;

	        $this->save($this->data);
	}
	
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