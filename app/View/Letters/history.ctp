<h1 id="header_text">IRBNet Letter Requests</h1>
<p>&nbsp;</p>
<div id="letters_search">
	<h2>Letter Requests by Member Institution:</h2>
	<div class="letter_history_table">
		<?php echo $this->Form->create('Letter', array('type' => 'get', 'action' => 'history')); ?>
			<div id="letter_search_top_row">
				<div id="organization_select">
						<?php echo $this->Form->input('member_id', array('label' => 'Member: ', 'empty' => 'All', 'id' => 'org_name_test')); ?>
				</div>
				<div id="owner_table">
				</div>
			</div>
			<div id="letter_search_bottom_row">
				<div id="date_received">
					<div class="from_date_field">
					</div>
					<div class="to_date_field">
					</div>
				</div>
			</div>
			<?php echo $this->Form->end('Search'); ?>
	</div>
</div>

<p>&nbsp;</p>

<div id="request_search_results">
	<?php 
		if ($letters) {
			$total_new = 0;
			$total_revised = 0;
			$total_enrollment = 0;
	?>
	<table>
		<tr>
			<th>Date Received</th>
			<th>Date Completed</th>
			<?php echo ($_GET['member_id'] == null ? '<th>Member</th>' : '<th>Submitter</th>'); ?>
			<th>New Letters</th>
			<th>Revised Letters</th>
			<th>Enrollment?</th>
			<th>Owner</th>
		</tr>
	<?php foreach ($letters as $letter): ?>
		<tr>
			<td><?php echo $letter['Letter']['date_received']; ?></td>
			<td><?php echo ($letter['Letter']['completed_date'] ? $letter['Letter']['completed_date'] : '<em>Active</em>'); ?></td>
			<td><?php echo ($_GET['member_id'] == null ? $letter['Member']['short_name'] : $letter['Letter']['submitter']); ?></td>
			<td><?php echo $letter['Letter']['new_templates']; ?></td>
			<td><?php echo $letter['Letter']['revised_templates']; ?></td>
			<td><?php echo ($letter['Letter']['enrollment'] ? 'Yes' : 'No'); ?></td>
			<td><?php echo ($letter['Letter']['request_owner'] ? $letter['User']['first_name'] : '<em>None</em>'); ?></td>
			<td><?php echo $this->Html->link($this->Html->image('btn_color_search.png', array('height' => '16', 'width' => '16')), array('controller' => 'letters', 'action' => 'view', $letter['Letter']['id']), array('escapeTitle' => false)); ?></td>
			<td><?php echo $this->Form->postLink($this->Html->image('deleteX.gif'), array('controller' => 'letters', 'action' => 'delete', $letter['Letter']['id']), array('escapeTitle' => false, 'confirm' => 'Are you sure?')); ?></td>
		</tr>
		<?php
			$total_new += $letter['Letter']['new_templates'];
			$total_revised += $letter['Letter']['revised_templates'];
			$total_enrollment += ($letter['Letter']['enrollment'] ? $letter['Letter']['new_templates'] : 0);
			endforeach;
			unset($letter);
		?>	
	</table>
	<p>&nbsp;</p>
	<p>Total Letter Requests (since 10/11/13):</p>
	<p>New Letters: <?php echo $total_new . ' (' . $total_enrollment; ?> enrollment)</p>
	<p>Revised Letters: <?php echo $total_revised; ?></p>
	
	<?php } else { ?>
	
	<p class="message_feedback">No letter requests to display.</p>
	
	<?php } ?> 
</div>
<p>&nbsp;</p>
<p>&nbsp;</p>
