<h2 class="title">National Research Network Administrators</h2>
<h4 class='sub-title'>
	<?php
		if($filter_added) {
			switch($filter) {
				case 'contract_lead':
					echo 'Contract Leads';
					break;
				case 'feature_announcement_list':
					echo 'Feature Announcement List';
					break;
				case 'support_outreach_list':
					echo 'Support Outreach List';
					break;
				default:
					echo 'All Administrators';
			}
		} else {
			echo 'All Administrators';
		}
	?>
</h4>

<p>&nbsp;</p>

<div class="col-sm-10 col-sm-offset-1">
	<table class="table table-condensed table-bordered table-hover">
		<thead>
			<tr>
				<th>First Name</th>
				<th>Email Address</th>
				<th>Organization</th>
			</tr>
		</thead>
		
		<tbody>
			<?php if ($admins == null) { ?>
			<tr><td colspan="3">No administrators to display</td></tr>
			<?php } else {
				foreach ($admins as $admin): ?>
			<tr class="list-item">
				<td><?php echo $this->Html->link($admin['Admin']['first_name'] . ' ' . $admin['Admin']['last_name'], array('action' => 'view', $admin['Admin']['id'])); ?></td>
				<td><?php echo $admin['Admin']['email_address']; ?></td>
				<td><?php echo $this->Html->link($admin['Member']['full_name'], array('controller' => 'members', 'action' => 'view', $admin['Member']['id'])); ?></td>
			</tr>
			<?php endforeach; ?>
			<?php unset($admin); 
			} ?>
		</tbody>
	</table>
</div>
