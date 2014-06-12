<h1 id="header_text">National Research Network Members</h1>
<div id="org_list_table">
	<table>
		<tr>
		<?php if($add_features) { ?>
			<th>Member Name</th>
			<th>Short Name</th>
			<th>ID</th>
		<? } else { ?>
			<th><?php echo $this->Html->link('Member Name', array('action' => 'all', '?' => array('order' => 'full_name'))); ?></th>
			<th><?php echo $this->Html->link('Short Name', array('action' => 'all', '?' => array('order' => 'short_name'))); ?></th>
			<th><?php echo $this->Html->link('ID', array('action' => 'all', '?' => array('order' => 'op_num'))) ?></th>
		<? } ?>
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
