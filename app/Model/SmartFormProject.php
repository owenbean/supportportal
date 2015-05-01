<?php
class SmartFormProject extends AppModel {
    public $belongsTo = array('Member', 'Admin', 'User', 'SmartForm');
    
	public $validate = array(
		'type' => array(
    		'rule' => 'notEmpty'
		),
		'member_id' => array(
			'rule' => 'notEmpty'
		),
		'admin_id' => array(
			'rule' => 'notEmpty'
		),
		'date_received' => array(
			'rule' => 'notEmpty'
		),
		'target_date' => array(
			'rule' => 'notEmpty'
		),
		'scope' => array(
    		'rule' => 'notEmpty'
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
