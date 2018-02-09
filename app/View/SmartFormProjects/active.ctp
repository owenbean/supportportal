<h2 class="title">Active Smart Form Projects</h1>

<p></span>&nbsp;</p>

<div class="col-sm-10 col-sm-offset-1">
	<table class="table table-striped">
		<tr>
			<th>Project Type</th>
			<th>Scope</th>
			<th>Member</th>
			<th>Form Name</th>
			<th>Target Date</th>
			<th>Output Change</th>
			<th>Owner</th>
			<th colspan="4">Actions</th>
		</tr>
		
		<?php
			if ($smartFormProjects == null):
		?>
		<tr><td colspan="9"><i>No active projects</i></td></tr>
		<?php
			else:
				foreach ($smartFormProjects as $smartFormProject):
					switch ( $smartFormProject['SmartFormProject']['scope'] )
					{
						case 'Major Change':
							$smartFormProjectScope = 'Major';
							break;
						case 'Minor Change':
							$smartFormProjectScope = 'Minor';
							break;
						case 'Trivial Change':
							$smartFormProjectScope = 'Trivial';
							break;
						default:
							$smartFormProjectScope = $smartFormProject['SmartFormProject']['scope'];
					}
		?>
		<tr>
			<td><?php echo $smartFormProject['SmartFormProject']['type']; ?></td>
			<td><?php echo $smartFormProjectScope; ?></td>
			<td><?php echo $smartFormProject['Member']['short_name']; ?></td>
			<td><?php echo $smartFormProject['SmartForm']['name']; ?></td>
			<td><?php echo $smartFormProject['SmartFormProject']['target_date']; ?></td>
			<td><?php echo ($smartFormProject['SmartFormProject']['output_change'] == 1 ? 'Yes' : 'No'); ?></td>
			<td><?php echo (!$smartFormProject['SmartFormProject']['user_id'] ? $this->Html->link('[claim]', array('action' => 'claim', $smartFormProject['SmartFormProject']['id']), array('confirm' => 'Are you sure you want to claim this project?')) : $smartFormProject['User']['first_name']); ?></td>
			<td><?php echo $this->Form->postLink("<span class='glyphicon glyphicon-ok action-image' aria-hidden='true'></span>", array('action' => 'complete', $smartFormProject['SmartFormProject']['id']), array('escapeTitle' => false, 'confirm' => 'Are you sure you want to complete this project?')); ?></td>
			<td><?php echo $this->Html->link("<span class='glyphicon glyphicon-search action-image' aria-hidden='true'></span>", array('action' => 'view', $smartFormProject['SmartFormProject']['id']), array('escapeTitle' => false)); ?></td>
			<td><?php echo $this->Html->link("<span class='glyphicon glyphicon-envelope action-image' aria-hidden='true'></span>", array('action' => 'scope', $smartFormProject['SmartFormProject']['id']), array('escapeTitle' => false)); ?></td>
			<td><?php echo $this->Form->postLink("<span class='glyphicon glyphicon-remove action-image' aria-hidden='true'></span>", array('action' => 'delete', $smartFormProject['SmartFormProject']['id']), array('escapeTitle' => false, 'confirm' => 'Are you sure you want to Delete this project? If needed, you can edit it by clicking the View icon.')); ?></td>
		</tr>
		
				<?php
					// If the smart form project has any activity, list it here
					$smartFormProjectDeployments = $smartFormProject['SmartFormProjectDeployment'];
					if ($smartFormProjectDeployments != null):
				?>
				
				<tr>
					<td colspan="2"><strong>Date Received</strong></td>
					<td colspan="7"><strong>Target Date</strong></td>
				</tr>
				
				<?php
						foreach ($smartFormProjectDeployments as $smartFormProjectDeployment):
				?>

				<tr>
					<td colspan="2"><?php echo $smartFormProjectDeployment['date_received']; ?></td>
					<td colspan="7"><?php echo $smartFormProjectDeployment['target_date']; ?></td>
				</tr>
				
				<?php
					endforeach;
					unset($smartFormProjectDeployment);
					endif;
				?>
		
		
		<?php
				endforeach;
				unset($smartFormProject); 
			endif; 
		?>
	</table>
</div>
<p>&nbsp;</p>