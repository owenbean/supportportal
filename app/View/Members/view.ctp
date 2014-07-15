<div id="org_details">
	<h1><?php echo h($member['Member']['full_name']) . ($member['Member']['active'] ? null : ' - <em>RETIRED</em>'); ?></h1>
	
	<p>&nbsp;</p>
	
	<div id="actions_table">
		<table><tbody>
			<tr><th colspan="3"><h2>Actions:</h2></th></tr>
			<tr><td>
					<?php echo $this->Html->link('Edit', array('controller' => 'members', 'action' => 'edit', $member['Member']['id'])); ?>, 
					<?php echo $this->Form->postLink('Retire', array('controller' => 'members', 'action' => 'retire', $member['Member']['id']), array('confirm' => 'Are you sure you want to Retire this member?'));?>, 
					<?php echo $this->Form->postLink('Delete', array('controller' => 'members', 'action' => 'delete', $member['Member']['id']), array('confirm' => "Are you sure you want to Delete this member?\n\nDoing so will remove them from the system entirely.  If this institution is no longer a member of the National Research Network, please Retire them instead."));?>
			</td></tr>
		</tbody></table>
	</div>

	<div id="org_details_section">
		<div class='org_profile_details' id='org_stats_section'>
			<h2>Member Details:</h2>
			<p>Short Name: <strong><?php echo h($member['Member']['short_name']); ?></strong></p>
			<p>Member Class: <strong><?php echo h($member['Member']['class']); ?></strong></p>
			<p>Member Specialist: <strong><?php echo (!$member['Member']['specialist'] ? 'None' : h($member['User']['first_name'])); ?></strong></p>
			<p>ID: <strong><?php echo h($member['Member']['op_num']); ?></strong></p>
			<p>Location: <strong><?php echo h($member['Member']['city']) . ', ' . h($member['Member']['state']); ?></strong></p>
			<p>Pings Email: <?php echo (!strlen($member['Member']['pings_email']) ? '<em>pending</em>' : $this->Text->autoLinkEmails($member['Member']['pings_email'])); ?></p>
			<p>IRBNet Resources: <?php echo (!strlen($member['Member']['resources_username']) ? '<em>pending</em>' : '<strong>' . h($member['Member']['resources_username']) . ' / ' . h($member['Member']['resources_password']) . '</strong>'); ?></p>
		</div>
		
		<div class="org_profile_details" id="committee_details_section">
			<h2>Committees:</h2>
			<?php if (!$committees) { ?>
				<p><em>None</em></p>
				<p><?php echo $this->Html->link('Add a committee', array('controller' => 'committees', 'action' => 'add', $member['Member']['id'])); ?></p>
			<?php } else {
					foreach ($committees as $committee): ?>
				<div class="section_details">
					<div class="section_details_head">
						<a href="#"><p><span class="arrow"><?php echo $this->Html->image('arrow.png', array('height' => '10', 'width' => '10')); ?></span><?php echo ' ' . $committee['Committee']['board_type']; ?>: <span class="<?php echo $committee['Committee']['status']; ?>"><?php echo $committee['Committee']['status']; ?></span></p></a>
					</div>
					<?php
					$enrollment_team = array();
					for($i = 0; $i < count($committee['User']); $i++) {
						array_push($enrollment_team, $committee['User'][$i]['first_name']);
					}
					?>
					<div class="hidden_row org_section_details">
						<ul>
							<li><?php echo 'Name: ' . $committee['Committee']['name']; ?></li>
							<li><?php echo 'Committee Setup: ' . $committee['Committee']['setup']; ?></li>
							<li><?php echo 'Go-Live Date: ' . $committee['Committee']['go_live_date']; ?></li>
							<li><?php echo 'Funding Type: ' . $committee['Committee']['funding_model']; ?></li>
							<?php echo ($enrollment_team ? '<li>Enrollment Team: ' . implode(', ', $enrollment_team) . '</li>' : null); ?>
						</ul>
						<p class="section_details_edit">
							<table class="edit_delete_table"><tbody><tr><td>
              <?php echo $this->Html->link('[edit]', array('controller' => 'committees', 'action' => 'edit', $member['Member']['id'], $committee['Committee']['id']), array('class' => 'committee_details_edit_link')) . ' ' . $this->Form->postLink('[delete]', array('controller' => 'committees', 'action' => 'delete', $member['Member']['id'], $committee['Committee']['id']), array('class' => 'section_details_delete_link', 'confirm' => 'Are you sure you want to delete this committee?')); ?>
              </td></td></tbody></table>
						</p>
					</div>
				</div>
				<?php endforeach; ?>
				<?php unset($committee); ?>
				
				<p><?php echo $this->Html->link('Add another committee', array('controller' => 'committees', 'action' => 'add', $member['Member']['id'])); ?></p>
				<?php } ?>
				
		</div>
		
		<div class="org_profile_details" id="smart_form_details_section">
			<h2>Smart Forms:</h2>
			<?php if (!$smartForms) { ?>
				<p>
					<em>None</em>
				</p>
				<p><?php echo $this->Html->link('Add a smart form', array('controller' => 'smartForms', 'action' => 'add', $member['Member']['id'])); ?></p>
			<?php } else { foreach ($smartForms as $smartForm):
					if ($smartForm['SmartForm']['status'] == "In Development") {
						$smart_form_status = "development";
					} else {
						$smart_form_status = $smartForm['SmartForm']['status'];
					} ?>
					<div class="section_details">
						<div class="section_details_head">
							<a href="#"><p><span class="arrow"><?php echo $this->Html->image('arrow.png', array('height' => '10', 'width' => '10')); ?></span><?php echo $smartForm['SmartForm']['sf_domain'] . ": <span class='$smart_form_status'>" . $smartForm['SmartForm']['status'] . "</span>"; ?></p></a>
						</div>
						<div class="hidden_row org_section_details">
							<ul>
								<li>Name: <?php echo $smartForm['SmartForm']['name']; ?></li>
								<li>Developer: <?php echo ($smartForm['User']['id'] ? $smartForm['User']['first_name'] : 'Unknown'); ?></li>
								<li>Launch Date: <?php echo $smartForm['SmartForm']['launch_date']; ?></li>
							</ul>
							<p class="section_details_edit">
                <table class="edit_delete_table"><tbody><tr><td>
								<?php echo $this->Html->link('[edit]', array('controller' => 'smartForms', 'action' => 'edit', $member['Member']['id'], $smartForm['SmartForm']['id']), array('class' => 'smart_form_details_edit_link')) . ' ' . $this->Form->postLink('[delete]', array('controller' => 'smartForms', 'action' => 'delete', $member['Member']['id'], $smartForm['SmartForm']['id']), array('class' => 'section_details_delete_link', 'confirm' => 'Are you sure you want to delete this smart form?')); ?>
                </td></td></tbody></table>
							</p>
						</div>
					</div>
					<?php
						endforeach;
						unset($smartForm);
					?>
					<p><?php echo $this->Html->link('Add another smart form', array('controller' => 'smartForms', 'action' => 'add', $member['Member']['id'])); ?></p>
					
					<?php }	?>
		</div>

		<div class="org_profile_details" id="org_add_ons">
		<?php
			$citi = ($member['Member']['citi_integration'] == 1 ? 'CITI Integration' : null);
			$wirb = ($member['Member']['wirb_integration'] == 1 ? 'WIRB Integration' : null);
			$sso = ($member['Member']['sso'] == 1 ? 'Single Sign-On' : null);
			$file_access = ($member['Member']['file_access'] == 1 ? 'File Access' : null);
			$add_ons_array = array($citi, $wirb, $sso, $file_access);
			$add_ons = '';
			for ($i = 0; $i < count($add_ons_array); $i++) {
				if ($add_ons_array[$i]) {
					if (strlen($add_ons) > 1) {
						$add_ons .= ', ';
					}
					$add_ons .= $add_ons_array[$i];
				}
			}
		?>
			<h2>Organization Add-Ons:</h2>
			<p><?php echo ($add_ons == '' ? '<em>None</em>' : "$add_ons")?></p>
		</div>
			
		<div class="org_profile_details" id="org_comments_section">
			<h2>Organization Comments:</h2>
			<p><?php $org_comments = h($member['Member']['comments']); echo ($org_comments == null ? "<em>None</em>" : $org_comments) ?></p>
		</div>
	</div>

	<div class="org_admin_section">
		<h2>Member Administrators:</h2>
		
		<table class="org_admin_list">
		<tbody>
			<tr>
				<th>Name</th>
				<th>Contract Lead</th>
				<th>Feature Announcement</th>
				<th>Support Outreach</th>
				<th>Billing Coordinator</th>
			</tr>
			<?php
				if (!$admins) {
			?>
			<tr>
				<td colspan="5" class="message_feedback">No administrators to display</td>
			</tr>
			<?php
				} else {
					$num_admin = 0;
					foreach ($admins as $admin):
						if ($admin['Admin']['active']) {
			?>
			<tr>
				<td><?php echo $this->Html->link(h($admin['Admin']['first_name']) . ' ' . h($admin['Admin']['last_name']), array('controller' => 'admins', 'action' => 'view', $admin['Admin']['id'])); ?></td>
				<td><?php echo ( $admin['Admin']['contract_lead'] ? "&#x2713;" : null ) ?></td>
				<td><?php echo ( $admin['Admin']['feature_announcement_list'] ? "&#x2713;" : null )  ?></td>
				<td><?php echo ( $admin['Admin']['support_outreach_list'] ? "&#x2713;" : null )  ?></td>
				<td><?php echo ( $admin['Admin']['billing_coord'] ? "&#x2713;" : null )  ?></td>
			</tr>
			<?php
							$num_admin += 1;
						}
					endforeach;
					if ($num_admin == 0) {
			?>
			<tr>
				<td colspan="5" class="message_feedback">No administrators to display</td>
			</tr>
			<?php

					}
					unset($admin);
				}
			?>
		</tbody>
		</table>
		
		<p><?php echo $this->Html->link('Add new administrator', array('controller' => 'admins', 'action' => 'add', $member['Member']['id'])); ?> <?php echo $this->Html->link('Show/Hide Retired Administrators', '#', array('id' => 'retired_admin_link')); ?></p>
		
	</div>
	<div class="org_admin_section" id="retired_admin_section">

		<h2>Retired Member Administrators:</h2>
		
		<table class="org_admin_list">
		<tbody>
			<tr>
				<th>Name</th>
				<th>Contract Lead</th>
				<th>Feature Announcement</th>
				<th>Support Outreach</th>
				<th>Billing Coordinator</th>
			</tr>
			<?php
				if (!$admins) {
			?>
			<tr>
				<td colspan="5" class="message_feedback">No administrators to display</td>
			</tr>
			<?php
				} else {
					$num_retired_admin = 0;
					foreach ($admins as $admin):
						if (!$admin['Admin']['active']) {
			?>
			<tr>
				<td><?php echo $this->Html->link(h($admin['Admin']['first_name']) . ' ' . h($admin['Admin']['last_name']), array('controller' => 'admins', 'action' => 'view', $admin['Admin']['id'])); ?></td>
				<td><?php echo ( $admin['Admin']['contract_lead'] ? "&#x2713;" : null ) ?></td>
				<td><?php echo ( $admin['Admin']['feature_announcement_list'] ? "&#x2713;" : null )  ?></td>
				<td><?php echo ( $admin['Admin']['support_outreach_list'] ? "&#x2713;" : null )  ?></td>
				<td><?php echo ( $admin['Admin']['billing_coord'] ? "&#x2713;" : null )  ?></td>
			</tr>
			<?php
							$num_retired_admin += 1;
						}
					endforeach;
					if ($num_retired_admin == 0) {
			?>
			<tr>
				<td colspan="5" class="message_feedback">No administrators to display</td>
			</tr>
			<?php

					}
					unset($admin);
				}
			?>
		</tbody>
		</table>
		
	</div>
	
	<div id="org_interactions_section">
		<h2>Last 5 Member Interactions:</h2>
		
		<table id="org_interactions_table">
		<tbody>
			<tr>
				<th>Interaction Between</th>
				<th>Date</th>
				<th>Type</th>
				<th>Purpose</th>
				<th colspan="3">Action</th>
			</tr>
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
