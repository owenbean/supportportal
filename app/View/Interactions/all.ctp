<h1 id="header_text">All Member Interactions - <?php echo $this->Html->link($member['Member']['full_name'], array('controller' => 'members', 'action' => 'view', $member['Member']['id'])); ?></h1>
<div id="admin_list_table">
	<table id="org_interactions_table">
	<tbody>
		<tr>
			<th>Interaction Between</th>
			<th>Date</th>
			<th>Type</th>
			<th>Purpose</th>
			<th colspan="3">Action</th>
		</tr>
		<?php 
			if (!$interactions) { 
		?>
		<tr>
			<td colspan="7" class"message_feedback">No interactions to display</td>
		</tr>
		<?php } else { foreach ($interactions as $interaction): ?>
		<tr>
			<td><?php echo $interaction['User']['first_name'] . ' / ' . $interaction['Admin']['first_name'] . ' ' . $interaction['Admin']['last_name']; ?></td>
			<td><?php echo $interaction['Interaction']['date']; ?></td>
			<td><?php echo $interaction['Interaction']['interaction_type']; ?></td>
			<td><?php echo $interaction['Interaction']['purpose']; ?></td>
			<td><?php echo $this->Html->link($this->Html->image('editPencil.gif'), array('controller' => 'interactions', 'action' => 'edit', $interaction['Interaction']['id']), array('escapeTitle' => false)); ?></td>
			<td><?php echo $this->Html->link($this->Html->image('btn_color_search.png', array('height' => '16', 'width' => '16')), array('controller' => 'interactions', 'action' => 'view', $interaction['Interaction']['id']), array('escapeTitle' => false)); ?></td>
			<td><?php echo $this->Form->postLink($this->Html->image('deleteX.gif'), array('controller' => 'interactions', 'action' => 'delete', $interaction['Member']['id'], $interaction['Interaction']['id']), array('escapeTitle' => false, 'confirm' => 'Are you sure you want to Delete this interaction?')); ?></td>
		</tr>
		<?php
			endforeach;
			unset($interaction);
			}
		?>
	</tbody>
	</table>
</div>
<p id="all_interactions_actions"><?php echo $this->Html->link('Add an interaction', array('controller' => 'interactions', 'action' => 'add', $member['Member']['id'])); ?> <?php echo $this->Html->link('Back', array('controller' => 'members', 'action' => 'view', $member['Member']['id'])); ?></p>
<p>&nbsp;</p>
