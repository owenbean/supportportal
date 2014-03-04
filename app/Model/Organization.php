<?php
class Organization extends AppModel {
	public $validate = array(
		'op_num' => array(
			'rule' => 'notEmpty'
		),
		'short_name' => array(
			'rule' => 'notEmpty'
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
		'specialist' => array(
			'valid' => array(
				'rule' => array('inList', array('Zack', 'Deena'))
			)
		),
		'enrollment_team' => array(
			'rule' => 'notEmpty'
		),
		'class' => array(
			'valid' => array(
				'rule' => array('inList', array('University', 'Hospital', 'VA', 'Other'))
			)
		)
	);
}