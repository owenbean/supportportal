<?php
	if($member_id == null) {
		echo $this->Form->input('submitter', array('label' => false, 'disabled' => 'disabled', 'class' => 'form-control'));
	} else {
		$ids = array();
		$names = array();
		foreach ($submitter_names as $admin):
			array_push($ids, $admin['Admin']['id']);
			array_push($names, $admin['Admin']['first_name'] . ' ' . $admin['Admin']['last_name']);
		endforeach;
		unset($admin);
		$submitter_full_names = (count($names) < 1 ? array() : array_combine($ids, $names));
		
		echo $this->Form->input(
			'Letter.submitter',
			array(
				'label' => false,
				'empty' => '',
				'class' => 'form-control',
				'options' => array(
					$submitter_full_names, 'Other' => 'Other'
				),
				'onchange' => 'otherEntry(this);'
			)
		);
	}
