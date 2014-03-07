<h1>NRN Administrator</h1>
<p>&nbsp;</p>
<div id="new_admin_table">
	<h2>Administrator Details:</h2>
	<p>Name: <strong><?php echo h($admin['Admin']['first_name']) . ' ' . h($admin['Admin']['last_name']) ?></strong></p>
	<p>Organization: <strong><?php echo $admin['Admin']['member_id'] ?></strong></p>
	<p>Email Address: <strong><?php echo h($admin['Admin']['email_address']); ?></strong></p>
	<p>Contract Lead: <strong><?php echo h($admin['Admin']['contract_lead']); ?></strong></p>
	<p>Feature Announcement List: <strong><?php echo h($admin['Admin']['feature_announcement_list']); ?></strong></p>
	<p>Support Outreach List: <strong><?php echo h($admin['Admin']['support_outreach_list']); ?></strong></p>
	<p>Billing Coordinator: <strong><?php echo h($admin['Admin']['billing_coord']); ?></strong></p>
	<p>Comments: <em><?php echo h($admin['Admin']['comments']); ?></em></p>
	<p>&nbsp;</p>
	<p>
	<?php
		echo $this->Html->link('Edit', array('controller' => 'admins', 'action' => 'edit', $admin['Admin']['id']));
		echo $this->Form->postLink('Delete', array('controller' => 'admins', 'action' => 'delete', $admin['Admin']['id']), array('confirm' => 'Are you sure?'));
	?>
	</p>
	<p>&nbsp;</p>
</div>