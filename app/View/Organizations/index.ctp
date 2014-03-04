<h1 id="header_text">National Research Network Members</h1>
<div id="org_list_table">
	<table>
		<tr>
			<th>Organization Name</th>
			<th>Short Name</th>
			<th>ID</th>
		</tr>
		
		<?php if ($organizations == null) { ?>
		<tr><td colspan="3">No organizations to display</td></tr>
		<?php } else {
			foreach ($organizations as $organization): ?>
		<tr>
			<td><?php echo $this->Html->link($organization['Organization']['full_name'], array('action' => 'view', $organization['Organization']['id'])); ?></td>
			<td><?php echo $this->Html->link($organization['Organization']['short_name'], array('action' => 'view', $organization['Organization']['id'])); ?></td>
			<td><?php echo $organization['Organization']['op_num']; ?></td>
		</tr>
		<?php endforeach; ?>
		<?php unset($organization); 
		} ?>
	</table>
</div>
<p>&nbsp;</p>
