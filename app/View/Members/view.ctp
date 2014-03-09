<div id="org_details">
	<h1><?php echo h($member['Member']['full_name']) . ' ' . $this->Html->link('Edit', array('controller' => 'members', 'action' => 'edit', $member['Member']['id'])); ?></h1>
	
	<div id="org_details_section">
		<div class='org_profile_details' id='org_stats_section'>
			<h2>Member Details:</h2>
			<p>Short Name: <strong><?php echo h($member['Member']['short_name']); ?></strong></p>
			<p>Member Class: <strong><?php echo h($member['Member']['class']); ?></strong></p>
			<p>Member Specialist: <strong><?php echo h($member['Member']['specialist']); ?></strong></p>
			<p>Enrollment Team: <strong><?php echo h($member['Member']['enrollment_team']); ?></strong></p>
			<p>ID: <strong><?php echo h($member['Member']['op_num']); ?></strong></p>
			<p>Location: <strong><?php echo h($member['Member']['city']) . ', ' . h($member['Member']['state']); ?></strong></p>
			<p>Pings Email: <?php $pings_email = h($member['Member']['pings_email']); echo (!strlen($pings_email) ? '<em>pending</em>' : "<a href='mailto:$pings_email'>" . $pings_email . "</a>"); ?></p>
			<p>IRBNet Resources: <?php echo (!strlen($member['Member']['resources_username']) ? '<em>pending</em>' : '<strong>' . h($member['Member']['resources_username']) . ' / ' . h($member['Member']['resources_password']) . '</strong>'); ?></p>
		</div>
		
		<div class="org_profile_details" id="committee_details_section">
			<h2>Committees:</h2>
			<?php if (!$committees) { ?>
				<p><em>None</em></p>
				<!--<p><a href="#"><span class="add_committee_link">Add a committee.</span></a></p>-->
				<p><?php echo $this->Html->link('Add a committee', array('controller' => 'committees', 'action' => 'add', $member['Member']['id'])); ?></p>
			<?php } else {
				foreach ($committees as $committee): ?>
				<div class="section_details">
					<div class="section_details_head">
						<a href="#"><p><span class="arrow"><?php echo $this->Html->image('arrow.png', array('height' => '10', 'width' => '10')); ?></span><?php echo ' ' . $committee['Committee']['board_type']; ?>: <span class="<?php echo $committee['Committee']['status']; ?>"><?php echo $committee['Committee']['status']; ?></span></p></a>
					</div>
					
					<div class="hidden_row org_section_details">
						<ul>
							<li><?php echo 'Name: ' . $committee['Committee']['name']; ?></li>
							<li><?php echo 'Committee Setup: ' . $committee['Committee']['setup']; ?></li>
							<li><?php echo 'Go-Live Date: ' . $committee['Committee']['go_live_date']; ?></li>
							<li><?php echo 'Funding Type: ' . $committee['Committee']['funding_model']; ?></li>
						</ul>
						<p class="section_details_edit"><?php echo $this->Html->link('[edit]', array('controller' => 'committees', 'action' => 'edit', $committee['Committee']['id']), array('class' => 'committee_details_edit_link')) . ' ' . $this->Html->link('[delete]', array('controller' => 'committees', 'action' => 'delete', $committee['Committee']['id'])); ?></p>
					</div>
				</div>
				<?php endforeach; ?>
				<?php unset($committee); ?>
				
				<p><a href='#'><span class="add_committee_link">Add another committee.</span></a></p>
				<?php } ?>
				
		</div>
		
		<div class="org_profile_details" id="smart_form_details_section">
			<h2>Smart Forms:</h2>
			<?php if (!$smartForms) { ?>
				<p>
					<em>None</em>
				</p>
				<p>
					<a href="#"><span class="add_smart_form_link">Add a smart form.</span></a>
				</p>
			<?php } else { foreach ($smartForms as $smartForm):
					if ($smartForm['SmartForm']['status'] == "In Development") {
						$smart_form_status = "development";
					} else {
						$smart_form_status = $smartForm['SmartForm']['status'];
					} ?>
					<div class="section_details">
						<div class="section_details_head">
							<a href="#"><p><span class="arrow"><img src="images/arrow.png" height=10 width=10></span><?php echo $smartForm['SmartForm']['sf_domain'] . ": <span class='$smart_form_status'>$smart_form_status</span>"; ?></p></a>
						</div>
						<div class="hidden_row org_section_details">
							<ul>
								<li><?php echo 'Name: ' . $smartFroml['SmartForm']['name']; ?></li>
								<li><?php echo 'Developer: ' . $smartForm['SmartForm']['developer']; ?></li>
								<li><?php echo 'Launch Date: ' . $smartForm['SmartForm']['launch_date']; ?></li>
							</ul>
							<p class="section_details_edit">
								<a class="smart_form_details_edit_link" href='$smart_form_index'>[edit]</a>&nbsp;<a class='areyousure' href='database_update.php?delete_smart_form=$smart_form_index&org=$org_index' rel='delete' rev='smart form'>[delete]</a>
							</p>
						</div>
					</div>
					<?php
						endforeach;
						unset($smartForm);
					?>
					<p><a href="#"><span class="add_smart_form_link">Add another smart form.</span></a></p>
					
					<?php }	?>
		</div>

		<div class="org_profile_details" id="org_add_ons">
			<h2>Organization Add-Ons:</h2>
			<p><?php $add_ons = null; echo ($add_ons == null ? '<em>None</em>' : "$add_ons")?></p>
		</div>
			
		<div class="org_profile_details" id="org_comments_section">
			<h2>Organization Comments:</h2>
			<p><?php $org_comments = h($member['Member']['comments']); echo ($org_comments == null ? "<em>None</em>" : $org_comments) ?></p>
		</div>
	</div>

	<div id="org_admin_section">
		<h2>Organization Administrators:</h2>
		
		<table id="org_admin_list">
		<tbody>
			<tr>
				<th>Name</th>
				<th>Contract Lead</th>
				<th>Feature Announcement</th>
				<th>Support Outreach</th>
				<th>Billing Coordinator</th>
			</tr>
			<?php if (!$admins) { ?>
			<tr>
				<td colspan="5" class="message_feedback">No administrators to display</td>
			</tr>
			<?php } else { foreach ($admins as $admin): ?>
			<tr>
				<td><?php echo $this->Html->link(h($admin['Admin']['first_name']) . ' ' . h($admin['Admin']['last_name']), array('controller' => 'admins', 'action' => 'view', $admin['Admin']['id'])); ?></td>
				<td><?php echo ( $admin['Admin']['contract_lead'] ? "&#x2713;" : null ) ?></td>
				<td><?php echo ( $admin['Admin']['feature_announcement_list'] ? "&#x2713;" : null )  ?></td>
				<td><?php echo ( $admin['Admin']['support_outreach_list'] ? "&#x2713;" : null )  ?></td>
				<td><?php echo ( $admin['Admin']['billing_coord'] ? "&#x2713;" : null )  ?></td>
			</tr>
			<?php
				endforeach;
				unset($admin);
				}
			?>
		</tbody>
		</table>
		
		<p><?php echo $this->Html->link('Add new administrator', array('controller' => 'admins', 'action' => 'add', $member['Member']['id'])); ?></p>
	</div>

</div>