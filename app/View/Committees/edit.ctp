<h1>Edit Committee</h1>

<p>&nbsp;</p>

<div id="form_table">
	
<?php echo $this->Form->create('Committee'); ?>
	<fieldset>
		<legend>Update Committee</legend>
		<p class="errorTip">All information must be entered</p>
		<table>
		<tbody>
			<tr><td>
				<?php echo $this->Form->input('name', array('label' => 'Committee Name: ', 'maxLength' => '100'));
					echo $this->Form->input('id', array('type' => 'hidden'));
				?>
			</td></tr>
			
			<tr><td>
				<?php echo $this->Form->input('board_type', array(
						'label' => 'Committee Type: ',
						'options' => array(
							'IRB' => 'IRB',
							'IACUC' => 'IACUC',
							'IBC' => 'IBC',
							'COI' => 'COI',
							'Grants' => 'Grants',
							'Safety' => 'Safety (VA)',
							'RD' => 'R&D',
							'Other' => 'Other'
						),
						'empty' => ''
					)); ?>
			</td></tr>
			
			<tr><td>
				<?php echo $this->Form->input('setup', array(
						'label' => 'Setup: ',
						'options' => array(
							'TBD' => 'TBD',
							'Single Board' => 'Single Board',
							'Multi-Board; Master' => 'Multi-Board; Master',
							'Multi-Board; No Master' => 'Multi-Board; No Master',
							'VA Setup' => 'VA Setup',
							'Other' => 'Other'
						),
						'empty' => ''
					)); ?>
			</td></tr>
			
			<tr><td>
				<?php echo $this->Form->input('status', array(
						'label' => 'Status: ',
						'options' => array(
							'Contracted' => 'Contracted',
							'Enrolling' => 'Enrolling',
							'Live' => 'Live',
							'Retired' => 'Retired'
						),
						'empty' => ''
					)); ?>
			</td></tr>
			
			<tr><td>
				<?php echo $this->Form->input('go_live_date', array(
						'label' => 'Go-Live Date: ',
						'id' => 'go_live_date',
						'class' => 'date_picker',
						'size' => '20'
					)) . $this->Form->button('TBD', array('id' => 'tbd_button'))
					; ?>
			</td></tr>
			
			<tr><td>
				<?php echo $this->Form->input('funding_model', array(
					'label' => 'Funding Type: ',
					'options' => array(
						'Flat' => 'Flat',
						'Funded' => 'Per Funded Study'
					),
					'empty' => ''
				)); ?>
			</td></tr>
			
			<tr><td>
				<?php echo $this->Form->input('User', array(
					'label' => 'Enrollment Team: ',
					'type' => 'select',
					'multiple' => 'checkbox',
					'options' => $users
				)); ?>
			</td></tr>			
		</tbody>
		</table>
		<p><?php echo $this->Form->end('Update Committee'); ?></p>
	</fieldset>
</div>