<h1 id="header_text">National Research Network Admnistrators</h1>
<div id="admin_list_table">
	<table>
		<tr>
			<th>First Name</th>
			<th>Email Address</th>
			<th>Organization</th>
		</tr>
		
		<?php if ($admins == null) { ?>
		<tr><td colspan="3">No administrators to display</td></tr>
		<?php } else {
			foreach ($admins as $admin): ?>
		<tr>
			<td><?php echo $this->Html->link($admin['Admin']['first_name'] . ' ' . $admin['Admin']['last_name'], array('action' => 'view', $admin['Admin']['id'])); ?></td>
			<td><?php echo $admin['Admin']['email_address']; ?></td>
			<td><?php echo $admin['Member']['full_name']; ?></td>
		</tr>
		<?php endforeach; ?>
		<?php unset($admin); 
		} ?>
	</table>
</div>
<p>&nbsp;</p>
