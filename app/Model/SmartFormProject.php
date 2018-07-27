<?php
class SmartFormProject extends AppModel {
    public $belongsTo = array('Member', 'Admin', 'User', 'SmartForm');
    
	public $validate = array(
		'type' => array(
    		'rule' => 'notBlank'
		),
		'member_id' => array(
			'rule' => 'notBlank'
		),
		'smart_form_id' => array(
    		'rule' => 'notBlank'
		),
		'admin_id' => array(
			'rule' => 'notBlank'
		),
		'date_received' => array(
			'rule' => 'notBlank'
		),
		'target_date' => array(
			'rule' => 'notBlank'
		),
		'scope' => array(
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
