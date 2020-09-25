<h2><?php echo h($admin['Admin']['first_name']) . ' ' . h($admin['Admin']['last_name']) . ($admin['Admin']['active'] ? null : ' - RETIRED'); ?></h2>
<h4>
	<?php echo $this->Html->link("<span class='glyphicon glyphicon-pencil action-image' aria-hidden='true'></span>", array('action' => 'edit', $admin['Admin']['id']), array('escapeTitle' => false)); ?>
	&nbsp;&nbsp;&nbsp;
	<?php echo ($admin['Admin']['active'] ? "<a href='#' id='deleteRetireLink'><span class='glyphicon glyphicon-remove action-image' aria-hidden='true'></span></a>" : "<a href='#' id='unRetireLink'><span class='glyphicon glyphicon-repeat action-image' aria-hidden='true'></span></a>"); ?>
</h4>
<p>&nbsp;</p>
<div>
	<h4>Details:</h4>
	<p class="no_underline">Member: <?php echo $this->Html->link($admin['Member']['full_name'], array('controller' => 'members', 'action' => 'view', $admin['Member']['id'])); ?></p>
	<p>Email Address: <?php echo $this->Text->autoLinkEmails(h($admin['Admin']['email_address'])); ?></p>
	<p>Comments: <?php $admin_comments = h($admin['Admin']['comments']); echo (!$admin_comments ? "<em>None</em>" : $this->Markdown->transform(nl2br($admin_comments))); ?></p>
	<p>&nbsp;</p>
	<h4>Lists:</h4>
	<?php
		$contract = ($admin['Admin']['contract_lead'] == 1 ? 'Contract Lead' : null);
		$feature = ($admin['Admin']['feature_announcement_list'] == 1 ? 'Feature Announcement List' : null);
		$support = ($admin['Admin']['support_outreach_list'] == 1 ? 'Support Outreach List' : null);
		$billing = ($admin['Admin']['billing_coord'] == 1 ? 'Billing Coordinator' : null);
		$wirb_liaison = ($admin['Admin']['wirb_liaison'] == 1 ? 'WIRB Liaison' : null);
		$lists = array($contract, $feature, $support, $billing, $wirb_liaison);
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


<!-- Delete / Retire Administrator Popup -->
<div id="deleteRetirePopup" title="Retire / Delete Administrator">
	<p>Would you like to retire this administrator (because they have left their organization / role), or delete them altogether?</p>
	<h6>Please note that deleting an administrator cannot be undone.</h6>
	<p>&nbsp;</p>
	<p><?php echo $this->Form->postLink('Retire', array('action' => 'retire', $admin['Admin']['id']));?> | <?php echo $this->Form->postLink('Delete', array('action' => 'delete', $admin['Admin']['id']));?></p>
</div>

<!-- Un-Retire Administrator Popup -->
<div id="unRetirePopup" title="Reactivate Administrator">
	<p>Would you like to reactivate this administrator and return them to active status?</p>
	<p>This will place them back in the pool of active administrators for <?php echo $admin['Member']['full_name']; ?>.</p>
	<p>&nbsp;</p>
	<p><?php echo $this->Form->postLink('Reactivate', array('action' => 'unretire', $admin['Admin']['id']));?></p>
</div>