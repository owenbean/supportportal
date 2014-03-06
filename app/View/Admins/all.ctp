<h1 id="header_text">National Research Network Admnistrators</h1>
<div id="org_list_table">
	<table>
		<tr>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Organization</th>
		</tr>
		
		<?php if ($admins == null) { ?>
		<tr><td colspan="3">No administrators to display</td></tr>
		<?php } else {
			foreach ($admins as $admin): ?>
		<tr>
			<td><?php echo $this->Html->link($admin['Admin']['first_name'], array('action' => 'view', $admin['Admin']['id'])); ?></td>
			<td><?php echo $this->Html->link($admin['Admin']['last_name'], array('action' => 'view', $admin['Admin']['id'])); ?></td>
			<td><?php echo $admin['Admin']['member_id']; ?></td>
		</tr>
		<?php endforeach; ?>
		<?php unset($admin); 
		} ?>
	</table>
</div>
<p>&nbsp;</p>
