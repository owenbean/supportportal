<h1>NRN Organization - Edit</h1>
<p>&nbsp;</p>
<div id="organization_information_table">

<?php echo $this->Form->create('Organization'); ?>
	<fieldset>
		<legend><?php echo __('Add Organization'); ?></legend>
		<?php
			echo $this->Form->input('full_name');
			echo $this->Form->input('short_name');
			echo $this->Form->input('op_num');
			echo $this->Form->input('class', array('options' => array('university' => 'University', 'hospital' => 'Hospital', 'va' => 'VA', 'other' => 'Other')));
			echo $this->Form->input('city');
			echo $this->Form->input('state');
			echo $this->Form->input('specialist', array('options' => array('zack' => 'Zack', 'deena' => 'Deena')));
			echo $this->Form->input('enrollment_team');
			echo $this->Form->input('pings_email');
			echo $this->Form->input('resources_username');
			echo $this->Form->input('resources_password');
			echo $this->Form->checkbox('citi_integration');
			echo $this->Form->checkbox('wirb_integration');
			echo $this->Form->checkbox('sso');
			echo $this->Form->checkbox('file_service');
			echo $this->Form->textarea('comments', array('rows' => '5', 'cols' => '50'));
		?>
	</fieldset>
<?php echo $this->Form->end('Add Organization'); ?>

</div>