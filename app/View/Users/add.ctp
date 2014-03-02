<h1>Add User</h1>

<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<legend><?php echo __('Add User'); ?></legend>
		<?php
			echo $this->Form->input('first_name');
			echo $this->Form->input('last_name');
			echo $this->Form->input('username');
			echo $this->Form->input('email_address');
			echo $this->Form->input('password');
			echo $this->Form->input('role', array('options' => array('site_admin' => 'Site Admin', 'admin' => 'Admin')));
		?>
	</fieldset>
<?php echo $this->Form->end('Add User'); ?>