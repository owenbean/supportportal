<?php echo $this->Form->create('Admin', array('url' => array('controller' => 'admins', 'action' => 'add'))); ?>
	<fieldset>
		<legend>New Admin</legend>
		<p class="errorTip">All information must be entered</p>
		<table>
		<tbody>
			<tr><td>
				<?php echo $this->Form->input('first_name', array('label' => 'First Name: ')); ?>
			</td></tr>
			
			<tr><td>
				<?php echo $this->Form->input('last_name', array('label' => 'Last Name: ')); ?>
			</td></tr>
			
			<tr><td>
				<?php echo $this->Form->input('email_address', array('label' => 'Email Address: ')); ?>
			</td></tr>
			
			<?php if (sizeof($members) > 1) { ?>
			<tr><td>
				<?php echo $this->Form->input('member_id', array('label' => 'Organization: ', 'empty' => 'None')); ?>
			</td></tr>
				<?php
				} else {
					$member = implode(array_flip($members));
					echo $this->Form->input('member_id', array('label' => 'Organization: ', 'default' => $member, 'type' => 'hidden'));
				} ?>
			
			<tr><td>
				<?php echo $this->Form->input('contract_lead', array('type' => 'checkbox', 'label' => 'Contract Lead? ', 'format' => array('before', 'label', 'between', 'input', 'after', 'error'))); ?>
			</td></tr>
			
			<tr><td>
				<?php echo $this->Form->input('feature_announcement_list', array('type' => 'checkbox', 'label' => 'Feature Announcement List? ', 'format' => array('before', 'label', 'between', 'input', 'after', 'error'))); ?>
			</td></tr>
			
			<tr><td>
				<?php echo $this->Form->input('support_outreach_list', array('type' => 'checkbox', 'label' => 'Support Outreach List? ', 'format' => array('before', 'label', 'between', 'input', 'after', 'error'))); ?>
			</td></tr>
			
			<tr><td>
				<?php echo $this->Form->input('billing_coord', array('type' => 'checkbox', 'label' => 'Billing Coord? ', 'format' => array('before', 'label', 'between', 'input', 'after', 'error'))); ?>
			</td></tr>
			
			<tr><td>
				<?php echo $this->Form->input('comments', array('label' => 'Comments: ', 'rows' => '5', 'cols' => '50', 'id' => 'comments_field')); ?>
			</td></tr>
			
		</tbody>
		</table>
		<p><?php echo $this->Form->end('Add Admin'); ?></p>
	</fieldset>
