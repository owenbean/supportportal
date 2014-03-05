<div id="org_details">
<h1><?php echo h($member['Member']['full_name']); ?></h1>
<p><?php echo $this->Html->link('Edit', array('controller' => 'members', 'action' => 'edit', $member['Member']['id'])); ?></p>
<div id='org_details_section'>
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
		<p>Comments: <em><?php echo h($member['Member']['comments']); ?></em></p>
	</div>
</div>

	<div id="org_admin_section">
		<h2>Organization Administrators:</h2>
		
		<table id='org_admin_list'>
		<tbody>
			<tr>
				<th>Name</th>
				<th>Contract Lead</th>
				<th>Feature Announcement</th>
				<th>Support Outreach</th>
				<th>Billing Coordinator</th>
			</tr>
			<tr>
				<td colspan="5" class="message_feedback">No administrators added.</td>
			</tr>
		</tbody>
		</table>
		
		<p><a href="admin_details_edit.php?org=$org_index">Add new administrator</a>
	</div>

</div>

