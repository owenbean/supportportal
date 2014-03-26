<h1 id="header_text">Letter Request Queue</h1>
<div id="letters_queue_table">
<p>&nbsp;</p>
<p>&nbsp;</p>
	<table>
		<tr>
			<th>Target Date</th>
			<th>Member</th>
			<th>New</th>
			<th>Revised</th>
			<th>Enrollment</th>
			<th>Owner</th>
		</tr>
		
		<?php if ($letters == null) { ?>
		<tr><td colspan="3">No active letters</td></tr>
		<?php } else {
			foreach ($letters as $letter): ?>
		<tr>
			<td><?php echo $letter['Letter']['target_date']; ?></td>
			<td><?php echo $letter['Member']['short_name']; ?></td>
			<td><?php echo $letter['Letter']['new_templates']; ?></td>
			<td><?php echo $letter['Letter']['revised_templates']; ?></td>
			<td><?php echo ($letter['Letter']['enrollment'] == 1 ? 'Yes' : 'No'); ?></td>
			<td><?php echo (!$letter['Letter']['request_owner'] ? $this->Html->link('[claim]', array('controller' => 'letters', 'action' => 'claim', $letter['Letter']['id'])) : $letter['User']['first_name']); ?></td>
			<td><?php echo $this->Form->postLink($this->Html->image('completeCheck.gif'), array('controller' => 'letters', 'action' => 'complete', $letter['Letter']['id']), array('escapeTitle' => false)); ?></td>
			<td><?php echo $this->Html->link($this->Html->image('btn_color_search.png', array('height' => '16', 'width' => '16')), array('controller' => 'letters', 'action' => 'view', $letter['Letter']['id']), array('escapeTitle' => false)); ?></td>
			<td><?php echo $this->Form->postLink($this->Html->image('deleteX.gif'), array('controller' => 'letters', 'action' => 'delete', $letter['Letter']['id']), array('escapeTitle' => false, 'confirm' => 'Are you sure you want to Delete this letter request?  If needed, you can edit it by clicking the View icon.')); ?></td>
		</tr>
		<?php endforeach; ?>
		<?php unset($letter); 
		} ?>
	</table>
</div>
<p>&nbsp;</p>
