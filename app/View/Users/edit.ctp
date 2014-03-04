<h1>System Administrator Details</h1>
<p>&nbsp;</p>
<div id="new_admin_table">
	<h2><?php echo $this->Session->read('Auth.User.first_name') . ' ' . $this->Session->read('Auth.User.last_name'); ?></h2>
	<div id="form_input_fields">
	<?php
	echo $this->Form->create('User');
	echo $this->Form->input('first_name', array('label' => 'First Name: '));
	echo $this->Form->input('last_name', array('label' => 'Last Name: '));
	echo $this->Form->input('username', array('label' => 'Username: '));
	echo $this->Form->input('email_address', array('label' => 'Email Address: '));
	echo $this->Form->input('id', array('type' => 'hidden'));
	?>
	</div>
	<?php echo $this->Form->end('Save User'); ?>
</div>
<p>&nbsp;</p>
<p>&nbsp;</p>
