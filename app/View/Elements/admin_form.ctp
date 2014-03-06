<?php
	echo $this->Form->input('first_name', array('label' => 'First Name: '));
	echo $this->Form->input('last_name', array('label' => 'Last Name: '));
	echo $this->Form->input('email_address', array('label' => 'Email Address: '));
	echo $this->Form->input('member_id', array('label' => 'Organization: ', 'empty' => 'None'));
	echo $this->Form->input('contract_lead', array('type' => 'checkbox', 'label' => 'Contract Lead? ', 'format' => array('before', 'label', 'between', 'input', 'after', 'error')));
	echo $this->Form->input('billing_coord', array('type' => 'checkbox', 'label' => 'Billing Coord? ', 'format' => array('before', 'label', 'between', 'input', 'after', 'error')));
	echo $this->Form->input('feature_announcement_list', array('type' => 'checkbox', 'label' => 'Feature Announcement List? ', 'format' => array('before', 'label', 'between', 'input', 'after', 'error')));
	echo $this->Form->input('support_outreach_list', array('type' => 'checkbox', 'label' => 'Support Outreach List? ', 'format' => array('before', 'label', 'between', 'input', 'after', 'error')));
	echo $this->Form->input('comments', array('label' => 'Comments: ', 'rows' => '5', 'cols' => '50'));
