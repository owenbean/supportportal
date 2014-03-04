<h1>NRN Organization - Edit</h1>
<p>&nbsp;</p>
<div id="organization_information_table">

<?php echo $this->Form->create('Organization'); ?>
	<fieldset>
		<legend><?php echo __('Add Organization'); ?></legend>
		<?php
			echo $this->Form->input('full_name', array('label' => 'Organization Name: '));
			echo $this->Form->input('short_name', array('label' => 'Organization Short Name: '));
			echo $this->Form->input('op_num', array('label' => 'Organization ID: '));
			echo $this->Form->input('class', array('label' => 'Organization Class: ', 'options' => array('university' => 'University', 'hospital' => 'Hospital', 'va' => 'VA', 'other' => 'Other'), 'empty' => ''));
			echo $this->Form->input('city', array('label' => 'Organization City: '));
			echo $this->Form->input('state', array('label' => 'Organization State: '));
			echo $this->Form->input('specialists_id', array('label' => 'Organization Specialist: ', 'empty' => 'None'));
			echo $this->Form->input('enrollment_team', array('label' => 'Enrollment Team: '));
			echo $this->Form->input('pings_email', array('label' => 'Pings Email Address: '));
			echo $this->Form->input('resources_username', array('label' => 'IRBNet Resources Username: '));
			echo $this->Form->input('resources_password', array('label' => 'IRBNet Resources Password: '));
			echo $this->Form->input('citi_integration', array('type' => 'checkbox', 'label' => 'CITI Integration? ', 'format' => array('before', 'label', 'between', 'input', 'after', 'error')));
			echo $this->Form->input('wirb_integration', array('type' => 'checkbox', 'label' => 'WIRB Integration? ', 'format' => array('before', 'label', 'between', 'input', 'after', 'error')));
			echo $this->Form->input('sso', array('type' => 'checkbox', 'label' => 'Single Sign-On? ', 'format' => array('before', 'label', 'between', 'input', 'after', 'error')));
			echo $this->Form->input('file_service', array('type' => 'checkbox', 'label' => 'File Access? ', 'format' => array('before', 'label', 'between', 'input', 'after', 'error')));
			echo $this->Form->input('comments', array('label' => 'Comments: ', 'rows' => '5', 'cols' => '50'));
		?>
	</fieldset>
<?php echo $this->Form->end('Add Organization'); ?>

</div>