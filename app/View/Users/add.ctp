<h1>Add User</h1>

<p>&nbsp;</p>

<div id="form_table">
	
<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<legend>Add User</legend>
		<table>
		<tbody>
			<tr><td>
				<?php echo $this->Form->input('first_name', array('label' => 'First Name: ')); ?>
			</td></tr>
	
			<tr><td>
				<?php echo $this->Form->input('last_name', array('label' => 'Last Name: ')); ?>
			</td></tr>
	
			<tr><td>
				<?php echo $this->Form->input('username', array('label' => 'Username: ')); ?>
			</td></tr>
	
			<tr><td>
				<?php echo $this->Form->input('email_address', array('label' => 'Email Address: ')); ?>
			</td></tr>
			
			<tr><td>
				<?php echo $this->Form->input('password', array('label' => 'Password: ')); ?>
			</td></tr>
			
			<tr><td>
				<?php echo $this->Form->input('role', array('options' => array('site_admin' => 'Site Admin', 'admin' => 'Admin', 'contractor' => 'Contractor'), 'empty' => '', 'label' => 'Role: ')); ?>
			</td></tr>
		</tbody>
		</table>
		<p><?php echo $this->Form->end('Add User'); ?></p>
	</fieldset>
</div>

<p>&nbsp;</p>
<p>&nbsp;</p>
