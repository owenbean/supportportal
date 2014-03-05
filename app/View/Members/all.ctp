<h1 id="header_text">National Research Network Members</h1>
<div id="org_list_table">
	<table>
		<tr>
			<th>Member Name</th>
			<th>Short Name</th>
			<th>ID</th>
		</tr>
		
		<?php if ($members == null) { ?>
		<tr><td colspan="3">No members to display</td></tr>
		<?php } else {
			foreach ($members as $member): ?>
		<tr>
			<td><?php echo $this->Html->link($member['Member']['full_name'], array('action' => 'view', $member['Member']['id'])); ?></td>
			<td><?php echo $this->Html->link($member['Member']['short_name'], array('action' => 'view', $member['Member']['id'])); ?></td>
			<td><?php echo $member['Member']['op_num']; ?></td>
		</tr>
		<?php endforeach; ?>
		<?php unset($member); 
		} ?>
	</table>
</div>
<p>&nbsp;</p>
