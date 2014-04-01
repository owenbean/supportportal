<h1>NRN Member - Edit</h1>

<p>&nbsp;</p>

<div id="form_table">

<?php echo $this->Form->create('Member'); ?>
	<fieldset>
		<legend><?php echo __('Update Member'); ?></legend>
		<table>
		<tbody>
			<tr><td>
				<?php echo $this->Form->input('full_name', array('label' => 'Member Name: ')); ?>
			</td></tr>
			
			<tr><td>
				<?php echo $this->Form->input('short_name', array('label' => 'Member Short Name: ')); ?>
			</td></tr>
			
			<tr><td>
				<?php echo $this->Form->input('op_num', array('label' => 'Member ID: ')); ?>
			</td></tr>
			
			<tr><td>
				<?php echo $this->Form->input('class', array(
						'label' => 'Member Class: ',
						'options' => array(
							'University' => 'University',
							'Hospital' => 'Hospital', 
							'VA' => 'VA', 
							'Other' => 'Other'
						),
						'empty' => '')); 
				?>
			</td></tr>
			
			<tr><td>
				<?php echo $this->Form->input('city', array('label' => 'Member City: ')); ?>
			</td></tr>
			
			<tr><td>
				<?php echo $this->Form->input('state', array('label' => 'Member State: ')); ?>
			</td></tr>
			
			<tr><td>
				<?php echo $this->Form->input('specialist', array('label' => 'Member Specialist: ', 'empty' => 'None')); ?>
			</td></tr>
						
			<tr><td>
				<?php echo $this->Form->input('pings_email', array('label' => 'Pings Email Address: ')); ?>
			</td></tr>
			
			<tr><td>
				<?php echo $this->Form->input('resources_username', array('label' => 'IRBNet Resources Username: ')); ?>
			</td></tr>

			<tr><td>
				<?php echo $this->Form->input('resources_password', array('label' => 'IRBNet Resources Password: ')); ?>
			</td></tr>

			<tr><td>
				<?php echo $this->Form->input('citi_integration', array('type' => 'checkbox', 'label' => 'CITI Integration? ', 'format' => array('before', 'label', 'between', 'input', 'after', 'error'))); ?>
			</td></tr>

			<tr><td>
				<?php echo $this->Form->input('wirb_integration', array('type' => 'checkbox', 'label' => 'WIRB Integration? ', 'format' => array('before', 'label', 'between', 'input', 'after', 'error'))); ?>
			</td></tr>

			<tr><td>
				<?php echo $this->Form->input('sso', array('type' => 'checkbox', 'label' => 'Single Sign-On? ', 'format' => array('before', 'label', 'between', 'input', 'after', 'error'))); ?>
			</td></tr>

			<tr><td>
				<?php echo $this->Form->input('file_access', array('type' => 'checkbox', 'label' => 'File Access? ', 'format' => array('before', 'label', 'between', 'input', 'after', 'error'))); ?>
			</td></tr>

			<tr><td>
				<?php echo $this->Form->input('comments', array('label' => 'Comments: ', 'rows' => '5', 'cols' => '50', 'id' => 'comments_field')); ?>
			</td></tr>
		</tbody>
		</table>
		<?php echo $this->Form->input('id', array('type' => 'hidden')); ?>
		<p><?php echo $this->Form->end('Update Member'); ?></p>
	</fieldset>
</div>