<h1>User Profile</h1>

<p>&nbsp;</p>

<div id="form_table">
	
<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<legend>Edit Profile</legend>
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
		</tbody>
		</table>
		<p><?php echo $this->Form->input('id', array('type' => 'hidden')); ?></p>
		<p><?php echo $this->Form->end('Save'); ?></p>
	</fieldset>
</div>

</div>
<p>&nbsp;</p>
<p>&nbsp;</p>
