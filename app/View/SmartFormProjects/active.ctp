<h2 class="title">Active Smart Form Projects</h1>

<p></span>&nbsp;</p>

<div class="col-sm-8 col-sm-offset-2">
	<table class="table table-striped">
		<tr>
			<th>Project Type</th>
			<th>Scope</th>
			<th>Member</th>
			<th>Target Date</th>
			<th>Output Change</th>
			<th>Owner</th>
			<th colspan="3">Actions</th>
		</tr>
		
		<?php if ($smartFormProjects == null) { ?>
		<tr><td colspan="9"><i>No active projects</i></td></tr>
		<?php } else {
			foreach ($smartFormProjects as $smartFormProject): ?>
		<tr>
			<td><?php echo $smartFormProject['SmartFormProject']['type']; ?></td>
			<td><?php echo $smartFormProject['SmartFormProject']['scope']; ?></td>
			<td><?php echo $smartFormProject['Member']['short_name']; ?></td>
			<td><?php echo $smartFormProject['SmartFormProject']['target_date']; ?></td>
			<td><?php echo ($smartFormProject['SmartFormProject']['output_change'] == 1 ? 'Yes' : 'No'); ?></td>
			<td><?php echo (!$smartFormProject['SmartFormProject']['user_id'] ? $this->Html->link('[claim]', array('action' => 'claim', $smartFormProject['SmartFormProject']['id']), array('confirm' => 'Are you sure you want to claim this project?')) : $smartFormProject['User']['first_name']); ?></td>
			<td><?php echo $this->Form->postLink("<span class='glyphicon glyphicon-ok action-image' aria-hidden='true'></span>", array('action' => 'complete', $smartFormProject['SmartFormProject']['id']), array('escapeTitle' => false, 'confirm' => 'Are you sure you want to complete this project?')); ?></td>
			<td><?php echo $this->Html->link("<span class='glyphicon glyphicon-search action-image' aria-hidden='true'></span>", array('action' => 'view', $smartFormProject['SmartFormProject']['id']), array('escapeTitle' => false)); ?></td>
			<td><?php echo $this->Form->postLink("<span class='glyphicon glyphicon-remove action-image' aria-hidden='true'></span>", array('action' => 'delete', $smartFormProject['SmartFormProject']['id']), array('escapeTitle' => false, 'confirm' => 'Are you sure you want to Delete this project? If needed, you can edit it by clicking the View icon.')); ?></td>
		</tr>
		<?php endforeach; ?>
		<?php unset($smartFormProject); 
		} ?>
	</table>
</div>
<p>&nbsp;</p>