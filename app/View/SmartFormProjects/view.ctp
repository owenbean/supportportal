<h3>Smart Form Project</h3>

<p>&nbsp;</p>

<h4><?php echo h($smartFormProject['Member']['full_name']); ?></h4>
<p>Project Type: <strong><?php echo $smartFormProject['SmartFormProject']['type'] . ' request'; ?></strong></p>
<p>Project Scope: <strong><?php echo $smartFormProject['SmartFormProject']['scope']; ?></strong></p>
<p>Output Change? <strong><?php echo ($smartFormProject['SmartFormProject']['output_change'] ? 'Yes' : 'No'); ?></strong></p>
<p>Submitted By: <strong><?php echo $smartFormProject['Admin']['first_name'] . ' ' . $smartFormProject['Admin']['last_name']; ?></strong></p>
<p>Date of Request: <strong><?php echo $smartFormProject['SmartFormProject']['date_received']; ?></strong></p>
<p>Target Date: <strong><?php echo $smartFormProject['SmartFormProject']['target_date']; ?></strong></p>
<p>Date Completed: <strong><?php echo ($smartFormProject['SmartFormProject']['completed_date'] ? date("Y-m-d", strtotime($smartFormProject['SmartFormProject']['completed_date'])) : '<em>Active</em>'); ?></strong></p>
<p class="claim_link">Project Owned By: <?php echo (!$smartFormProject['SmartFormProject']['user_id'] ? $this->Html->link('[claim]', array('action' => 'claim', $smartFormProject['SmartFormProject']['id'])) : '<strong>' . $smartFormProject['User']['first_name'] . '</strong>'); ?> <?php echo ($smartFormProject['SmartFormProject']['user_id'] == $user_id ? $this->Html->link('[unclaim]', array('action' => 'unclaim', $smartFormProject['SmartFormProject']['id'])) : null ); ?></p>
<p>Project Comments: <strong><?php echo (!$smartFormProject['SmartFormProject']['comments'] ? 'None' : $smartFormProject['SmartFormProject']['comments']); ?></strong></p>
<p>&nbsp;</p>
<p><?php echo $this->Html->link('Edit', array('action' => 'edit', $smartFormProject['SmartFormProject']['id'])) . ' | ' . $this->Html->link('Invoice', array('action' => 'invoice', $smartFormProject['SmartFormProject']['id'])) . ' | ' . $this->Html->link('Back', array('action' => 'active')); ?></p>

<!-- SMART FORM PROJECT DEPLOYMENTS -->

<div class="col-sm-10">
    <h4>Smart Form Project Activity:</h4>
    <table class="table table-striped">
    	<tr>
    		<th>Date Received</th>
			<th>Target Date</th>
    		<th>Date Completed</th>
    		<th colspan="2">Actions</th>
    	</tr>
    	<?php
        	if (!$smartFormProjectDeployments):
        ?>
        <tr>
            <td colspan="9"><i>No smart form project activity. The member may have not confirmed the changes yet.</i></td>
        </tr>
        <?php
            else:
                foreach ($smartFormProjectDeployments as $smartFormProjectDeployment):
        ?>
    	<tr>
    		<td><?php echo $smartFormProjectDeployment['date_received']; ?></td>
			<td><?php echo $smartFormProjectDeployment['date_received']; ?></td>
    		<td><?php echo ($smartFormProjectDeployment['completed_date'] ? date("Y-m-d", strtotime($smartFormProjectDeployment['completed_date'])) : '<em>Active</em>'); ?></td>
    		<td><?php echo $this->Html->link("<span class='glyphicon glyphicon-search action-image' aria-hidden='true'></span>", array('controller' => 'smartFormProjectDeployments', 'action' => 'view', $smartFormProjectDeployment['id']), array('escapeTitle' => false)); ?></td>
    		<td><?php echo $this->Form->postLink("<span class='glyphicon glyphicon-remove action-image' aria-hidden='true'></span>", array('controller' => 'smartFormProjectDeployments', 'action' => 'delete', $smartFormProjectDeployment['id']), array('escapeTitle' => false, 'confirm' => 'Are you sure you want to Delete this deployment? If needed, you can edit it by clicking the View icon.')); ?></td>
    	</tr>
    	<?php
        		endforeach;
        		unset($smartFormProjectDeployment);
            endif;
    	?>	
    </table>
</div>


<p><?php echo $this->Html->link('Add New Deployment', array('controller' => 'smartFormProjectDeployments', 'action' => 'add', $smartFormProject['SmartFormProject']['id'])) . ' | ' ?></p>
<p>&nbsp;</p>