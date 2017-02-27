<h2 class="title">IRBNet Smart Form Projects</h2>
<p>&nbsp;</p>
<div class="col-sm-4 col-sm-offset-4 text-center">
	<h4>Smart Form Projects by Member:</h4>
	<div>
		<?php echo $this->Form->create('SmartFormProject', array('type' => 'get', 'action' => 'history')); ?>
		<div class="form-group">
			<?php echo $this->Form->input('member_id', array('label' => false, 'empty' => 'All', 'default' => isset($member) ? $_GET['member_id'] : 'All', 'class' => 'form-control')); ?>
		</div>
	</div>
	<h4>Smart Form Projects by Owner:</h4>
	<div>
		<?php echo $this->Form->create('SmartFormProject', array('type' => 'get', 'action' => 'history')); ?>
		<div class="form-group">
			<?php echo $this->Form->input('user_id', array('label' => false, 'empty' => 'All', 'default' => isset($user) ? $_GET['user_id'] : 'All', 'class' => 'form-control')); ?>
		</div>
	</div>
	<?php echo $this->Form->button('Search', array('type' => 'submit', 'class' => 'btn btn-default')); ?>
</div>

<p>&nbsp;</p>

<div class="col-sm-12">
	<?php if ( (isset($_GET['member_id'])) && (isset($_GET['user_id'])) ): ?>
	<h4>
	<?php
		if ( $_GET['member_id'] == null && $_GET['user_id'] == null )
		{
			echo 'All Requests' . ' ' . 'By' . ' ' . 'All Owners';
		}
		elseif ( $_GET['member_id'] != null && $_GET['user_id'] == null )
		{
			echo $member['Member']['full_name'] . ' ' . 'By' . ' ' . 'All Owners';
		}
		elseif ( $_GET['member_id'] != null && $_GET['user_id'] != null )
		{
			echo $member['Member']['full_name'] . ' ' . 'By' . ' ' . $user['User']['first_name'];
		}
		else
		{
			echo 'All Requests' . ' ' . 'By' . ' ' . $user['User']['first_name'];
		}
	?>
	</h4>
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
				if ( $_GET['member_id'] == null && $_GET['user_id'] == null )
				{
					echo 'Member';
				}
				elseif ( $_GET['member_id'] != null && $_GET['user_id'] == null )
				{
					echo $this->Html->link('Submitter', array('action' => 'history', '?' => array('member_id' => $_GET['member_id'], 's' => 'admin_id')));
				}
				elseif ( $_GET['member_id'] != null && $_GET['user_id'] != null )
				{
					echo $this->Html->link('Submitter', array('action' => 'history', '?' => array('member_id' => $_GET['member_id'], 's' => 'admin_id')));
				}
				else
				{
					echo 'Member';
				}
			?>
			</th>
			<th>Output Change?</th>
			<th>
				<?php
					if ( $_GET['user_id'] == null )
					{
						echo $this->Html->link('Owner', array('action' => 'history', '?' => array('user_id' => $_GET['user_id'], 's' => 'user_id')));	
					}
					else
					{
						echo '';
					}
				?>
			</th>
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
			<td>
			<?php
				if ( $_GET['member_id'] == null && $_GET['user_id'] == null )
				{
					echo $smartFormProject['Member']['short_name'];
				}
				elseif ( $_GET['member_id'] != null && $_GET['user_id'] == null )
				{
					echo $smartFormProject['Admin']['first_name'] . ' ' . $smartFormProject['Admin']['last_name'];
				}
				elseif ( $_GET['member_id'] != null && $_GET['user_id'] != null )
				{
					echo $smartFormProject['Admin']['first_name'] . ' ' . $smartFormProject['Admin']['last_name'];
				}
				else
				{
					echo $smartFormProject['Member']['short_name'];
				}
			?>
			</td>
			<td><?php echo ($smartFormProject['SmartFormProject']['output_change'] ? 'Yes' : 'No'); ?></td>
			<td>
			<?php 
				if ( $_GET['user_id'] != null )
				{
					echo '';
				}
				elseif ($smartFormProject['SmartFormProject']['user_id'] == null)
				{
					echo '<em>None</em>'; 
				}
				else
				{
					echo $smartFormProject['User']['first_name'];
				} 
			?>
			</td>
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
