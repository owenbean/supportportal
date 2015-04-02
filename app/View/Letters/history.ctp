<h2 class="title">IRBNet Letter Requests</h2>
<p>&nbsp;</p>
<div class="col-sm-4 col-sm-offset-4 text-center">
	<h4>Requests by Member:</h4>
	<div>
		<?php echo $this->Form->create('Letter', array('type' => 'get', 'action' => 'history')); ?>
		<div class="form-group">
			<?php echo $this->Form->input('member_id', array('label' => false, 'empty' => 'All', 'class' => 'form-control')); ?>
		</div>
		<?php echo $this->Form->button('Search', array('type' => 'submit', 'class' => 'btn btn-default')); ?>
	</div>
</div>

<p>&nbsp;</p>

<div class="col-sm-10 col-sm-offset-1">
	<?php if(isset($_GET['member_id'])){ ?>
	<h4><?php echo ($_GET['member_id'] == null ? 'All Requests' : $member['Member']['full_name']) ?></h4>
	<?php 
		if ($letters) {
			$total_new = 0;
			$total_revised = 0;
			$total_enrollment = 0;
	?>
	<table class="table table-striped">
		<tr>
			<th>Date Received</th>
			<th>Date Completed</th>
			<?php echo ($_GET['member_id'] == null ? '<th>Member</th>' : '<th>Submitter</th>'); ?>
			<th>New Letters</th>
			<th>Revised Letters</th>
			<th>Enrollment?</th>
			<th>Owner</th>
			<th colspan="2">Actions</th>
		</tr>
	<?php foreach ($letters as $letter): ?>
		<tr>
			<td><?php echo $letter['Letter']['date_received']; ?></td>
			<td><?php echo ($letter['Letter']['completed_date'] ? date("Y-m-d", strtotime($letter['Letter']['completed_date'])) : '<em>Active</em>'); ?></td>
			<td><?php echo ($_GET['member_id'] == null ? $letter['Member']['short_name'] : ((is_numeric($letter['Letter']['submitter']) ? ($letter['Admin']['first_name'] . ' ' . $letter['Admin']['last_name']) : h($letter['Letter']['submitter'])))); ?></td>
			<td><?php echo $letter['Letter']['new_templates']; ?></td>
			<td><?php echo $letter['Letter']['revised_templates']; ?></td>
			<td><?php echo ($letter['Letter']['enrollment'] ? 'Yes' : 'No'); ?></td>
			<td><?php echo ($letter['Letter']['request_owner'] ? $letter['User']['first_name'] : '<em>None</em>'); ?></td>
			<td><?php echo $this->Html->link("<span class='glyphicon glyphicon-search action-image' aria-hidden='true'></span>", array('controller' => 'letters', 'action' => 'view', $letter['Letter']['id']), array('escapeTitle' => false)); ?></td>
			<td><?php echo $this->Form->postLink("<span class='glyphicon glyphicon-remove action-image' aria-hidden='true'></span>", array('controller' => 'letters', 'action' => 'delete', $letter['Letter']['id']), array('escapeTitle' => false, 'confirm' => 'Are you sure you want to Delete this letter request? If needed, you can edit it by clicking the View icon.')); ?></td>
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
	
	<p>No letter requests to display.</p>
	
	<?php } ?> 
	<?php } else { ?>
	<?php } ?>
</div>
<p>&nbsp;</p>
<p>&nbsp;</p>
