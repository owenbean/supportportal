<?php
//declare variables for later use.
$smart_form_count = null;
//this is used to see if the member has any extras. if not, will display 'none'
$extras_count = null;
$citi = ($member['Member']['citi_integration'] == 1 ? 'CITI Integration' : null);
$wirb = ($member['Member']['wirb_integration'] == 1 ? 'WIRB Integration' : null);
$sso = ($member['Member']['sso'] == 1 ? 'Single Sign-On' : null);
$file_access = ($member['Member']['file_access'] == 1 ? 'File Access' : null);

if($smartForms) {
	foreach ($smartForms as $smartForm) {
		$smart_form_count++;
		$extras_count++;
	}
}

$add_ons_array = array($citi, $wirb, $sso, $file_access);


//check if any active administrators
$active_admins = null;
$retired_admins = 0;
if($admins) {
	foreach($admins as $admin) {
		if($admin['Admin']['active']) {
			$active_admins++;
		} else {
			$retired_admins++;
		}
	}
}

?>

<div>
	<h2><?php echo h($member['Member']['full_name']) . ($member['Member']['active'] ? null : ' - RETIRED'); ?></h2>
	<h4><?php echo $this->Html->link("<span class='glyphicon glyphicon-pencil action-image' aria-hidden='true'></span>", array('action' => 'edit', $member['Member']['id']), array('escapeTitle' => false)); ?>&nbsp;&nbsp;&nbsp;<a href="#" id="deleteRetireLink"><span class='glyphicon glyphicon-remove action-image' aria-hidden='true'></span></a></h4>
	
	<p>&nbsp;</p>
	
	<!-- basic details section -->
	<div class="col-sm-4">
		<h4>Basic Information:</h4>
		<p>Short Name: <strong><?php echo h($member['Member']['short_name']); ?></strong></p>
		<p>Member Class: <strong><?php echo h($member['Member']['class']); ?></strong></p>
		<p>Member Specialist: <strong><?php echo (!$member['Member']['specialist'] ? 'None' : h($member['User']['first_name'])); ?></strong></p>
		<p>ID: <strong><?php echo h($member['Member']['op_num']); ?></strong></p>
		<p>Location: <strong><?php echo h($member['Member']['city']) . ', ' . h($member['Member']['state']); ?></strong></p>
		<p>Pings Email: <?php echo (!strlen($member['Member']['pings_email']) ? 'N/A' : $this->Text->autoLinkEmails($member['Member']['pings_email'])); ?></p>
		<p>IRBNet Resources: <?php echo (!strlen($member['Member']['resources_username']) ? 'N/A' : '<strong>' . h($member['Member']['resources_username']) . ' / ' . h($member['Member']['resources_password']) . '</strong>'); ?></p>
	</div>

	<!-- extras section -->
	<div class="col-sm-4">
		<h4>Extras:</h4>
		<?php
			echo $member['Member']['multi_workspace_setup'] ? "<p>Multi-workspace setup with no master board.</p>" : null;
			$member['Member']['multi_workspace_setup'] ? $extras_count++ : null;
			echo $member['Member']['master_board_setup'] ? "<p>Multi-workspace setup with a master board.</p>" : null;
			$member['Member']['master_board_setup'] ? $extras_count++ : null;
			echo $smart_form_count ? "<p>$smart_form_count Smart Form(s)</p>" : null;
			for ($i = 0; $i < count($add_ons_array); $i++) {
				if ($add_ons_array[$i]) {
					echo "<p>" . $add_ons_array[$i] . "</p>\n";
					$extras_count++;
				}
			}
			echo $extras_count ? null : "<p><em>None</em></p>";
		?>
	</div>

	<!-- active admin section -->
	<div class="col-sm-4">
		<h4>Administrators:</h4>
		<?php if (!$admins || !$active_admins): ?>
			<p>No administrators.</p>
		<?php else: ?>
			<table class="table table-condensed table-bordered table-hover">
				<thead>
					<th>Name</th>
					<th>Email</th>
				</thead>

				<tbody>
					<?php
						foreach ($admins as $admin):
							if ($admin['Admin']['active']):
					?>
					<tr class="list-item">
						<td><?php echo $this->Html->link(h($admin['Admin']['first_name']) . ' ' . h($admin['Admin']['last_name']), array('controller' => 'admins', 'action' => 'view', $admin['Admin']['id'])); ?></td>
						<td><?php echo $admin['Admin']['email_address']; ?></td>
					</tr>
				<?php
							endif;
						endforeach;
				?>
				</tbody>
			</table>
			<p>Retired administrators: <?php echo $retired_admins ?>
			<?php echo ($retired_admins > 0) ? "<p><a href='#' id='retiredAdminsLink'>Click here</a> to see the list.</p>" : null; ?></p>
			<?php
					unset($admin);
				endif;
			?>
			<p><?php echo $this->Html->link('Add Administrator', array('controller' => 'admins', 'action' => 'add', $member['Member']['id'])); ?></p>
	</div>

	<!-- buffer div -->
	<div class="col-sm-12">
		<p>&nbsp;</p>
	</div>

	<!-- comments section -->
	<div class="col-sm-12">
		<h4>Comments:</h4>
		<p><?php $org_comments = h($member['Member']['comments']); echo ($org_comments == null ? "<em>None</em>" : $this->Markdown->transform(nl2br($org_comments))) ?></p>
	</div>

    <!-- buffer div -->
    <div class="col-sm-12">
        <p>&nbsp;</p>
    </div>

    <!-- smart forms section -->
    <div class='col-sm-12'>
        <h4>Smart Form(s):</h4>
        <?php if ($smartForms): ?>
            <?php foreach ($smartForms as $smartForm): ?>
            <p><strong><?php echo $smartForm['SmartForm']['name']; ?></strong></p>
            <div class='container'>
                <p>Type: <strong><?php echo $smartForm['SmartForm']['sf_domain']; ?></strong></p>
                <p>Status: <strong><?php echo $smartForm['SmartForm']['status']; ?></strong></p>
                <p>Developer: <strong><?php echo ($smartForm['User']['id'] ? $smartForm['User']['first_name'] : 'Unknown'); ?></strong></p>
                <p>Launch Date: <strong><?php echo $smartForm['SmartForm']['launch_date']; ?></strong></p>
                <div>
                    <div class='inline-divs'>
                        <?php echo $this->Html->link("<span class='glyphicon glyphicon-pencil action-image' aria-hidden='true'></span>", array('controller' => 'smartForms', 'action' => 'edit', $member['Member']['id'], $smartForm['SmartForm']['id']), array('escapeTitle' => false)); ?>
                    </div>
                    &nbsp;&nbsp;
                    <div class='inline-divs'>
                        <?php echo $this->Form->postLink("<span class='glyphicon glyphicon-remove action-image' aria-hidden='true'></span>", array('controller' => 'smartForms', 'action' => 'delete', $member['Member']['id'], $smartForm['SmartForm']['id']), array('escapeTitle' => false, 'confirm' => 'Are you sure you want to delete this smart form?')); ?>
                    </div>
                </div>
                <p>&nbsp;</p>
            </div>
            <?php endforeach; ?>
        <?php endif; ?>
        <p><?php echo $this->Html->link('Add Smart Form', array('controller' => 'smartForms', 'action' => 'add', $member['Member']['id'])); ?></p>
    </div>

	<!-- Member interaction -->
	<div class="collapse">
		<h2>Last 5 Member Interactions:</h2>
		
		<table>
			<thead>
				<tr>
					<th>Interaction Between</th>
					<th>Date</th>
					<th>Type</th>
					<th>Purpose</th>
					<th colspan="3">Action</th>
				</tr>
			</thead>

			<tbody>
				<?php if (!$interactions) { ?>
				<tr>
					<td colspan="7" class"message_feedback">No interactions to display</td>
				</tr>
				<?php } else { foreach ($interactions as $interaction): ?>
				<tr>
					<td><?php echo $interaction['User']['first_name'] . ' / ' . $interaction['Admin']['first_name'] . ' ' . $interaction['Admin']['last_name']; ?></td>
					<td><?php echo $interaction['Interaction']['date']; ?></td>
					<td><?php echo $interaction['Interaction']['interaction_type']; ?></td>
					<td><?php echo $interaction['Interaction']['purpose']; ?></td>
					<td><?php echo $this->Html->link($this->Html->image('editPencil.gif'), array('controller' => 'interactions', 'action' => 'edit', $interaction['Interaction']['id']), array('escapeTitle' => false)); ?></td>
					<td><?php echo $this->Html->link($this->Html->image('btn_color_search.png', array('height' => '16', 'width' => '16')), array('controller' => 'interactions', 'action' => 'view', $interaction['Interaction']['id']), array('escapeTitle' => false)); ?></td>
					<td><?php echo $this->Form->postLink($this->Html->image('deleteX.gif'), array('controller' => 'interactions', 'action' => 'delete', $member['Member']['id'], $interaction['Interaction']['id']), array('escapeTitle' => false, 'confirm' => 'Are you sure you want to Delete this interaction?')); ?></td>
				</tr>
				<?php
					endforeach;
					unset($interaction);
					}
				?>
			</tbody>
		</table>
		<p><?php echo $this->Html->link('Add an interaction', array('controller' => 'interactions', 'action' => 'add', $member['Member']['id'])); ?> <?php echo $this->Html->link('View all interactions', array('controller' => 'interactions', 'action' => 'all', $member['Member']['id'])); ?></p>
	</div>

</div>
<p>&nbsp;</p>


<!-- Retired Admin List Popup -->
<div id="retiredAdminsList" title="Retired Administrators">
	<table class="table table-condensed table-bordered table-hover">
		<thead>
			<th>Name</th>
			<th>Email</th>
		</thead>

		<tbody>
			<?php
				foreach ($admins as $admin):
					if (!$admin['Admin']['active']) {
			?>
			<tr class="list-item">
				<td><?php echo $this->Html->link(h($admin['Admin']['first_name']) . ' ' . h($admin['Admin']['last_name']), array('controller' => 'admins', 'action' => 'view', $admin['Admin']['id'])); ?></td>
				<td><?php echo $admin['Admin']['email_address']; ?></td>
			</tr>
		<?php
					}
				endforeach;
		?>
		</tbody>
	</table>
</div>

<!-- Delete / Retire Member Popup -->
<div id="deleteRetirePopup" title="Delete / Retire Member">
	<p>Would you like to retire this member (because they have left IRBNet), or delete them altogether?</p>
	<h6>Please note that deleting a member cannot be undone.</h6>
	<p>&nbsp;</p>
	<p><?php echo $this->Form->postLink('Retire', array('controller' => 'members', 'action' => 'retire', $member['Member']['id']), array('class' => 'postLink-link'));?> | <?php echo $this->Form->postLink('Delete', array('controller' => 'members', 'action' => 'delete', $member['Member']['id']));?></p>
</div>


