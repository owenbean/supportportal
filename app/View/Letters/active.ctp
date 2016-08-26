<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
});
</script>

<h2 class="title">Letter and Stamp Request Queue</h1>

<p></span>&nbsp;</p>

<div class="col-sm-8 col-sm-offset-2">
	<table class="table table-striped">
		<tr>
			<th>Target Date</th>
			<th>Member</th>
			<th>Type</th>
			<th>New</th>
			<th>Revised</th>
			<th>Enrollment</th>
			<th>Owner</th>
			<th colspan="3">Actions</th>
		</tr>
		
		<?php if ($letters == null) { ?>
		<tr><td colspan="3">No active letters</td></tr>
		<?php } else {
			foreach ($letters as $letter): ?>
		<tr>
			<td><?php echo $letter['Letter']['target_date']; ?></td>
			<td><?php echo $letter['Member']['short_name']; ?></td>
			<td><?php echo $letter['Letter']['type']; ?></td>
			<td><?php echo $letter['Letter']['new_templates']; ?></td>
			<td><?php echo $letter['Letter']['revised_templates']; ?></td>
			<td><?php echo ($letter['Letter']['enrollment'] == 1 ? 'Yes' : 'No'); ?></td>
			<td><?php echo (!$letter['Letter']['request_owner'] ? $this->Html->link('[claim]', array('controller' => 'letters', 'action' => 'claim', $letter['Letter']['id']), array('confirm' => 'Are you sure you want to claim this letter request?')) : $letter['User']['first_name']); ?></td>
			<td><?php echo $this->Form->postLink("<span class='glyphicon glyphicon-ok action-image' aria-hidden='true'></span>", array('controller' => 'letters', 'action' => 'complete', $letter['Letter']['id']), array('escapeTitle' => false, 'confirm' => 'Are you sure you want to complete this letter or stamp request?')); ?></td>
			<td><?php echo $this->Html->link("<span class='glyphicon glyphicon-search action-image' aria-hidden='true'></span>", array('controller' => 'letters', 'action' => 'view', $letter['Letter']['id']), array('escapeTitle' => false, 'data-toggle' => 'tooltip', 'data-placement' => 'top', 'title' => $letter['Letter']['comments'])); ?></td>
			<td><?php echo $this->Form->postLink("<span class='glyphicon glyphicon-remove action-image' aria-hidden='true'></span>", array('controller' => 'letters', 'action' => 'delete', $letter['Letter']['id']), array('escapeTitle' => false, 'confirm' => 'Are you sure you want to delete this letter or stamp request? If needed, you can edit it by clicking the View icon.')); ?></td>
		</tr>
		<?php endforeach; ?>
		<?php unset($letter); 
		} ?>
	</table>
</div>
<p>&nbsp;</p>