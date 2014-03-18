<h1>User Profile</h1>

<p>&nbsp;</p>

<div id="form_table">
	
<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<legend>Change Password</legend>
		<table>
		<tbody>
			<tr><td>
				<?php echo $this->Form->input('password', array('label' => 'New Password: ', 'type' => 'password')); ?>
			</td></tr>
	
			<tr><td>
				<?php echo $this->Form->input('password_confirm', array('label' => 'Confirm Password: ', 'type' => 'password')); ?>
			</td></tr>
	
		</tbody>
		</table>
		<p><?php echo $this->Form->input('id', array('type' => 'hidden')); ?></p>
		<p><?php echo $this->Form->end('Save'); ?></p>
	</fieldset>
</div>

<p>&nbsp;</p>
<p>&nbsp;</p>
