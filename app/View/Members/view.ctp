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
		<p>Pings Email: </strong><?php echo h($member['Member']['pings_email']); ?></strong></p>
		<p>IRBNet Resources: <span class='resources_info'><?php echo h($member['Member']['resources_username']) . ' / ' . h($member['Member']['resources_password']); ?></p>
		<p>Comments: <?php echo h($member['Member']['comments']); ?></p>
	</div>
</div>
</div>