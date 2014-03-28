<h1>NRN Interaction</h1>
<p>&nbsp;</p>
<div id="display_admin">
	<h2>Interaction Details:</h2>
	<p>Interaction Between: <strong><?php echo $interaction['User']['first_name'] . ' / ' . $interaction['Admin']['first_name'] . ' ' . $interaction['Admin']['last_name']; ?></strong></p>
	<p class="no_underline">Organization: <strong><?php echo $this->Html->link($interaction['Member']['full_name'], array('controller' => 'members', 'action' => 'view', $interaction['Member']['id'])); ?></strong></p>
	<p>Date: <?php echo $interaction['Interaction']['date']; ?></p>
	<p>Type: <?php echo $interaction['Interaction']['interaction_type']; ?></p>
	<p>Purpose: <?php echo $interaction['Interaction']['purpose']; ?></p>
	<p>Comments: <?php echo ($interaction['Interaction']['comments'] ? $interaction['Interaction']['comments'] : '<em>None</em>'); ?></p>
	<p>&nbsp;</p>
	<div id="actions_table">
		<table>
		<tbody>
			<tr>
				<th colspan="3"><h2>Actions:</h2></th>
			</tr>
			<tr>
				<td>
					<?php echo $this->Html->link('Edit', array('action' => 'edit', $interaction['Interaction']['id'])); ?>, 
					<?php echo $this->Form->postLink('Delete', array('action' => 'delete', $interaction['Interaction']['id']), array('confirm' => "Are you sure you want to Delete this interaction?"));?>
				</td>
			</tr>
		</tbody>
		</table>
	</div>
	<p>&nbsp;</p>
</div>