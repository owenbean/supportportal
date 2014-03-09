<div id="add_committee" title="Committee Information">
	<?php echo $this->Form->create('Committee'); ?>
	<fieldset>
		<legend><em>New Committee</em></legend>
		<p class="errorTip">All information must be entered</p>
		<table>
		<tbody>
			<tr><td>
				<?php 
				echo $this->Form->input('member_id', array('type' => 'text', 'label' => 'Organization: ', 'default' => $members)); ?>
			</td></tr>
			
			<tr><td>
				<?php echo $this->Form->input('name', array('label' => 'Committee Name: ')); ?>
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
				<br />
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
				<br />
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
				<br />
			</td></tr>
			
			<tr><td>
				<?php echo $this->Form->input('go_live_date', array(
						'label' => 'Go-Live Date: ',
						'id' => 'go_live_date',
						'class' => 'date_picker',
						'size' => '20'
					)); ?>
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
		</tbody>
		</table>
	</fieldset>
	<?php echo $this->Form->end('Add Committee'); ?>
</div>