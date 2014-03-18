<h1>NRN Administrator</h1>
<p>&nbsp;</p>
<div id="new_admin_table">
	<h2>Administrator Details:</h2>
	<p>Name: <strong><?php echo h($admin['Admin']['first_name']) . ' ' . h($admin['Admin']['last_name']) ?></strong></p>
	<p>Organization: <strong><?php echo $admin['Member']['full_name'] ?></strong></p>
	<p>Email Address: <?php echo $this->Text->autoLinkEmails(h($admin['Admin']['email_address'])); ?></p>
	<p>Comments: <?php echo (!$admin['Admin']['comments'] ? "<em>None</em>" : h($admin['Admin']['comments'])); ?></p>
	<p>&nbsp;</p>
	<h2>Lists:</h2>
	<?php
		$contract = ($admin['Admin']['contract_lead'] == 1 ? 'Contract Lead' : null);
		$feature = ($admin['Admin']['feature_announcement_list'] == 1 ? 'Feature Announcement List' : null);
		$support = ($admin['Admin']['support_outreach_list'] == 1 ? 'Support Outreach List' : null);
		$billing = ($admin['Admin']['billing_coord'] == 1 ? 'Billing Coordinator' : null);
		$lists = array($contract, $feature, $support, $billing);
		$lists_display = '';
		for ($i = 0; $i < count($lists); $i++) {
			if ($lists[$i]) {
				if (strlen($lists_display) > 1) {
					$lists_display .= ', ';
				}
				$lists_display .= $lists[$i];
			}
		}
	?>
	<p><?php echo (strlen($lists_display) > 1 ? $lists_display : '<em>None</em>'); ?></p>
	<p>&nbsp;</p>
	<div id="actions_table">
		<table>
		<tbody>
			<tr>
				<th colspan="3"><h2>Actions:</h2></th>
			</tr>
			<tr>
				<td>
					<?php echo $this->Html->link('Edit', array('controller' => 'admins', 'action' => 'edit', $admin['Admin']['id'])); ?>, 
					<?php echo $this->Form->postLink('Retire', array('controller' => 'admins', 'action' => 'retire', $admin['Admin']['id']), array('confirm' => 'Are you sure you want to retire this administrator?'));?>, 
					<?php echo $this->Form->postLink('Delete', array('controller' => 'admins', 'action' => 'delete', $admin['Admin']['id']), array('confirm' => 'Are you sure you want to delete this administrator?'));?>
				</td>
			</tr>
		</tbody>
		</table>
	</div>
	<p>&nbsp;</p>
</div>