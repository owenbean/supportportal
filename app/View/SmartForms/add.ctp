<div id="add_smart_form" title="Smart Form Information">
	<?php echo $this->Form->create('SmartForm'); ?>
	<fieldset>
		<legend><em>New Smart Form</em></legend>
		<p class="errorTip">All information must be entered</p>
		<table>
		<tbody>
			<tr><td>
				<?php 
				echo $this->Form->input('member_id', array('type' => 'hidden', 'label' => 'Organization: ', 'default' => $members)); ?>
			</td></tr>
			
			<tr><td>
				<?php echo $this->Form->input('name', array('label' => 'Smart Form Name: ')); ?>
			</td></tr>
			
			<tr><td>
				<?php echo $this->Form->input('sf_domain', array(
						'label' => 'Domain: ',
						'options' => array(
							'Administrator' => 'Administrator',
							'COI - General' => 'COI - General',
							'COI - Project' => 'COI - Project',
							'Researcher' => 'Researcher',
							'Reviewer' => 'Reviewer',
							'Other' => 'Other'
						),
						'empty' => ''
					)); ?>
				<br />
			</td></tr>
			
			<tr><td>
				<?php echo $this->Form->input('status', array(
						'label' => 'Smart Form Status: ',
						'options' => array(
							'Contracted' => 'Contracted',
							'In Development' => 'In Development',
							'Live' => 'Live',
							'Retired' => 'Retired'
						),
						'empty' => ''
					)); ?>
				<br />
			</td></tr>
			
			<tr><td>
				<?php echo $this->Form->input('launch_date', array(
						'label' => 'Launch Date: ',
						'id' => 'go_live_date',
						'class' => 'date_picker',
						'size' => '20'
					)); ?>
			</td></tr>
			
			<tr><td>
				<?php echo $this->Form->input('developer', array(
					'label' => 'Smart Form Developer: ',
					'options' => array(
						'Unknown' => 'Unknown',
						'Colin' => 'Colin',
						'Kate' => 'Kate',
						'Melanie' => 'Melanie',
						'Toby' => 'Toby'
					),
					'empty' => ''
				)); ?>
			</td></tr>
		</tbody>
		</table>
	</fieldset>
	<?php echo $this->Form->end('Add Smart Form'); ?>
</div>