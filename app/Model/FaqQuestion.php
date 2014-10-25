<?php
class FaqQuestion extends AppModel {
	public $belongsTo = array(
		'FaqSection' => array(
			'className' => 'FaqSection'
		)
	);

	public $validate = array(
		'reference_name' => array(
			'rule' => 'alphaNumeric',
			'rule' => 'isUnique',
			'message' => 'The reference name must be unique and not contain any spaces or symbols.'
		),
		'question' => array(
			'rule' => 'notEmpty'
		),
		'answer' => array(
			'rule' => 'notEmpty'
		),
		'faq_section_id' => array(
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