<h1>NRN Member - Add</h1>
<p>&nbsp;</p>
<div id="organization_information_table">

<?php echo $this->Form->create('Member'); ?>
	<fieldset>
		<legend><?php echo __('Add Member'); ?></legend>
		<?php
			echo $this->Form->input('full_name', array('label' => 'Member Name: '));
			echo $this->Form->input('short_name', array('label' => 'Member Short Name: '));
			echo $this->Form->input('op_num', array('label' => 'Member ID: '));
			echo $this->Form->input('class', array('label' => 'Member Class: ', 'options' => array('university' => 'University', 'hospital' => 'Hospital', 'va' => 'VA', 'other' => 'Other'), 'empty' => ''));
			echo $this->Form->input('city', array('label' => 'Member City: '));
			echo $this->Form->input('state', array('label' => 'Member State: '));
			echo $this->Form->input('specialists_id', array('label' => 'Member Specialist: ', 'empty' => 'None'));
			echo $this->Form->input('enrollment_team', array('label' => 'Enrollment Team: '));
			echo $this->Form->input('pings_email', array('label' => 'Pings Email Address: '));
			echo $this->Form->input('resources_username', array('label' => 'IRBNet Resources Username: '));
			echo $this->Form->input('resources_password', array('label' => 'IRBNet Resources Password: '));
			echo $this->Form->input('citi_integration', array('type' => 'checkbox', 'label' => 'CITI Integration? ', 'format' => array('before', 'label', 'between', 'input', 'after', 'error')));
			echo $this->Form->input('wirb_integration', array('type' => 'checkbox', 'label' => 'WIRB Integration? ', 'format' => array('before', 'label', 'between', 'input', 'after', 'error')));
			echo $this->Form->input('sso', array('type' => 'checkbox', 'label' => 'Single Sign-On? ', 'format' => array('before', 'label', 'between', 'input', 'after', 'error')));
			echo $this->Form->input('file_access', array('type' => 'checkbox', 'label' => 'File Access? ', 'format' => array('before', 'label', 'between', 'input', 'after', 'error')));
			echo $this->Form->input('comments', array('label' => 'Comments: ', 'rows' => '5', 'cols' => '50'));
		?>
	</fieldset>
<?php echo $this->Form->end('Add Member'); ?>

</div>