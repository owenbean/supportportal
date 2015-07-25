<h2 class="title">IRBNet Smart Form Projects</h2>
<p>&nbsp;</p>
<div class="col-sm-4 col-sm-offset-4 text-center">
	<h4>Smart Form Projects by Member:</h4>
	<div>
		<?php echo $this->Form->create('SmartFormProject', array('type' => 'get', 'action' => 'history')); ?>
		<div class="form-group">
			<?php echo $this->Form->input('member_id', array('label' => false, 'empty' => 'All', 'class' => 'form-control')); ?>
		</div>
		<?php echo $this->Form->button('Search', array('type' => 'submit', 'class' => 'btn btn-default')); ?>
	</div>
</div>

<p>&nbsp;</p>

<div class="col-sm-12">
	<?php if (isset($_GET['member_id'])): ?>
	<h4><?php echo ($_GET['member_id'] == null ? 'All Requests' : $member['Member']['full_name']) ?></h4>
	<?php 
		if ($smartFormProjects):
			$total_new = 0;
			$total_revised = 0;
			$total = 0;
	?>
	<table class="table table-striped">
		<tr>
			<th><?php echo $this->Html->link('Project Type', array('action' => 'history', '?' => array('member_id' => $_GET['member_id'], 's' => 'type'))); ?></th>
			<th><?php echo $this->Html->link('Scope', array('action' => 'history', '?' => array('member_id' => $_GET['member_id'], 's' => 'scope'))); ?></th>
			<th><?php echo $this->Html->link('Date Received', array('action' => 'history', '?' => array('member_id' => $_GET['member_id'], 's' => 'date_received'))); ?></th>
			<th><?php echo $this->Html->link('Date Completed', array('action' => 'history', '?' => array('member_id' => $_GET['member_id'], 's' => 'completed_date'))); ?></th>
			<th>Form Name</th>
			<th>
			<?php
				if ( $_GET['member_id'] == null )
				{
					echo 'Member';
				}
				else
				{
					echo $this->Html->link('Submitter', array('action' => 'history', '?' => array('member_id' => $_GET['member_id'], 's' => 'admin_id')));
				}
			?>
			<th>Output Change?</th>
			<th><?php echo $this->Html->link('Owner', array('action' => 'history', '?' => array('member_id' => $_GET['member_id'], 's' => 'user_id'))); ?></th>
			<th colspan="2">Actions</th>
		</tr>
        <?php
            foreach ($smartFormProjects as $smartFormProject):
        ?>
		<tr>
			<td><?php echo $smartFormProject['SmartFormProject']['type']; ?></td>
			<td><?php echo $smartFormProject['SmartFormProject']['scope']; ?></td>
			<td><?php echo $smartFormProject['SmartFormProject']['date_received']; ?></td>
			<td><?php echo ($smartFormProject['SmartFormProject']['completed_date'] ? date("Y-m-d", strtotime($smartFormProject['SmartFormProject']['completed_date'])) : '<em>Active</em>'); ?></td>
			<td><?php echo $smartFormProject['SmartForm']['name']; ?></td>
			<td><?php echo ($_GET['member_id'] == null ? $smartFormProject['Member']['short_name'] : $smartFormProject['Admin']['first_name'] . ' ' . $smartFormProject['Admin']['last_name']); ?></td>
			<td><?php echo ($smartFormProject['SmartFormProject']['output_change'] ? 'Yes' : 'No'); ?></td>
			<td><?php echo ($smartFormProject['SmartFormProject']['user_id'] ? $smartFormProject['User']['first_name'] : '<em>None</em>'); ?></td>
			<td><?php echo $this->Html->link("<span class='glyphicon glyphicon-search action-image' aria-hidden='true'></span>", array('action' => 'view', $smartFormProject['SmartFormProject']['id']), array('escapeTitle' => false)); ?></td>
			<td><?php echo $this->Form->postLink("<span class='glyphicon glyphicon-remove action-image' aria-hidden='true'></span>", array('action' => 'delete', $smartFormProject['SmartFormProject']['id']), array('escapeTitle' => false, 'confirm' => 'Are you sure you want to Delete this project? If needed, you can edit it by clicking the View icon.')); ?></td>
		</tr>
		<?php
    			$smartFormProject['SmartFormProject']['type'] == 'New' ? $total_new++ : $total_revised++;
    			$total++;
			endforeach;
			unset($smartFormProject);
		?>	
	</table>
	<p>&nbsp;</p>
	<p>Total Smart Form Projects: <?php echo $total ?></p>
	<p>New Smart Form Projects: <?php echo $total_new ?> </p>
	<p>Revised Smart Form Projects: <?php echo $total_revised; ?></p>
	
	<?php else: ?>
	
	<p><i>No smart form projects to display.</i></p>
	
	<?php endif; ?> 
	<?php else: ?>
	<?php endif; ?>
</div>
<p>&nbsp;</p>
<p>&nbsp;</p>
