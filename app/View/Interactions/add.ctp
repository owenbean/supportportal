<h1>New Interaction</h1>

<p>&nbsp;</p>

<div id="form_table">

<?php echo $this->Form->create('Interaction'); ?>
	<fieldset>
		<legend>New Interaction</legend>
		<p class="errorTip">All information must be entered</p>
		<table>
		<tbody>
			<tr><td>
				<?php echo $this->Form->input('admin_id', array('label' => 'Administrator: ', 'empty' => ''));
					echo $this->Form->input('member_id', array('type' => 'hidden', 'default' => $members));
					echo $this->Form->input('user_id', array('type' => 'hidden', 'default' => $users));
				?>
			</td></tr>
			
			<tr><td>
				<?php echo $this->Form->input('interaction_type', array(
						'label' => 'Type: ',
						'options' => array(
							'Phone Call' => 'Phone Call',
							'Email' => 'Email',
							'In Person' => 'In Person',
							'Other' => 'Other'
						),
						'empty' => ''
					)); ?>
			</td></tr>
			
			<tr><td>
				<?php echo $this->Form->input('date', array(
						'label' => 'Date: ',
						'class' => 'date_picker',
						'size' => '20'
					));
				?>
			</td></tr>
			
			<tr><td>
				<?php echo $this->Form->input('purpose', array(
						'label' => 'Purpose: ',
						'options' => array(
							'Change Request' => 'Change Request',
							'General Question' => 'General Question',
							'Product Enhancement' => 'Product Enhancement',
							'System Issue' => 'System Issue',
							'Training Session' => 'Training Session',
							'Support Refresher' => 'Support Refresher',
							'General Check-in' => 'General Check-in',
							'Other' => 'Other'
						),
						'empty' => ''
					)); ?>
			</td></tr>
			
			<tr><td>
				<?php echo $this->Form->input('comments', array('label' => 'Comments: ', 'rows' => '5', 'cols' => '50', 'id' => 'comments_field')); ?>
			</td></tr>			
		</tbody>
		</table>
		<p><?php echo $this->Form->end('Add Interaction'); ?></p>
	</fieldset>
</div>