<h1>Edit Interaction</h1>

<p>&nbsp;</p>

<div id="form_table">

<?php echo $this->Form->create('Interaction'); ?>
	<fieldset>
		<legend>Edit Interaction</legend>
		<p class="errorTip">All information must be entered</p>
		<table>
		<tbody>
			<tr><td>
				<?php echo $this->Form->input('admin_placeHolder', array('label' => 'Administrator: ', 'default' => $interaction['Admin']['first_name'] . ' ' . $interaction['Admin']['last_name'], 'disabled' => 'disabled')); ?>
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
							'Checkup' => 'Checkup',
							'General Check-in' => 'General Check-in',
							'Re-Training Session' => 'Re-Training Session',
							'Support Session' => 'Support Session',
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
		<?php echo $this->Form->input('id', array('type' => 'hidden'));	?>
		<p><?php echo $this->Form->end('Update Interaction'); ?></p>
	</fieldset>
</div>