<div id="org_details">
<h1><?php echo h($organization['Organization']['full_name']); ?></h1>
<p><?php echo $this->Html->link('Edit', array('controller' => 'organizations', 'action' => 'edit', $organization['Organization']['id'])); ?></p>
<div id='org_details_section'>
	<div class='org_profile_details' id='org_stats_section'>
		<h2>Organization Details:</h2>
		<p>Short Name: <strong><?php echo h($organization['Organization']['short_name']); ?></strong></p>
		<p>Organization Class: <strong><?php echo h($organization['Organization']['class']); ?></strong></p>
		<p>Organization Specialist: <strong><?php echo h($organization['Organization']['specialist']); ?></strong></p>
		<p>Enrollment Team: <strong><?php echo h($organization['Organization']['enrollment_team']); ?></strong></p>
		<p>ID: <strong><?php echo h($organization['Organization']['op_num']); ?></strong></p>
		<p>Location: <strong><?php echo h($organization['Organization']['city']) . ', ' . h($organization['Organization']['state']); ?></strong></p>
		<p>Pings Email: </strong><?php echo h($organization['Organization']['pings_email']); ?></strong></p>
		<p>IRBNet Resources: <span class='resources_info'><?php echo h($organization['Organization']['resources_username']) . ' / ' . h($organization['Organization']['resources_password']); ?></p>
		<p>Comments: <?php echo h($organization['Organization']['comments']); ?></p>
	</div>
</div>
</div>