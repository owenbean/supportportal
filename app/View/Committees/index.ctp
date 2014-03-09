<h1 id="header_text">National Research Network Committees</h1>
<div id="org_list_table">
	<table>
		<tr>
			<th>Committee Name</th>
			<th>Member Name</th>
			<th>Committee Status</th>
		</tr>
		
		<?php if ($committees == null) { ?>
		<tr><td colspan="3">No committees to display</td></tr>
		<?php } else {
			foreach ($committees as $committee): ?>
		<tr>
			<td><?php echo $this->Html->link($committee['Committee']['name'], array('controller' => 'members', 'action' => 'view', $committee['Committee']['member_id'])); ?></td>
			<td><?php echo $this->Html->link($committee['Committee']['member_id'], array('controller' => 'members', 'action' => 'view', $committee['Committee']['member_id'])); ?></td>
			<td><?php echo $committee['Committee']['status']; ?></td>
		</tr>
		<?php endforeach; ?>
		<?php unset($committee); 
		} ?>
	</table>
</div>
<p>&nbsp;</p>
