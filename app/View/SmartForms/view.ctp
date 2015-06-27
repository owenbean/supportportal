<h2><?php echo $smartForm['SmartForm']['name']; ?></h2>
<h4><?php echo $this->Html->link("<span class='glyphicon glyphicon-pencil action-image' aria-hidden='true'></span>", array('action' => 'edit', $smartForm['SmartForm']['id']), array('escapeTitle' => false)); ?>&nbsp;&nbsp;&nbsp;<a href="#" id="deleteRetireLink"><span class='glyphicon glyphicon-remove action-image' aria-hidden='true'></span></a></h4>
<p>&nbsp;</p>
<div>
	<h4>Details:</h4>
	<p class="no_underline">Member: <?php echo $this->Html->link($smartForm['Member']['full_name'], array('controller' => 'members', 'action' => 'view', $smartForm['Member']['id'])); ?></p>
	<p>Type: <?php echo $smartForm['SmartForm']['sf_domain']; ?></p>
	<p>Status: <?echo $smartForm['SmartForm']['status']; ?></p>
	<p>&nbsp;</p>
</div>


<div class="col-sm-10">
    <h4>Smart Form Activity:</h4>
    <table class="table table-striped">
    	<tr>
    		<th>Project Type</th>
    		<th>Scope</th>
    		<th>Date Received</th>
    		<th>Date Completed</th>
    		<th>Submitter</th>
    		<th>Output Change?</th>
    		<th>Owner</th>
    		<th colspan="2">Actions</th>
    	</tr>
    	<?php
        	if (!$smartFormProjects):
        ?>
        <tr>
            <td colspan="9"><i>No smart form activity.</i></td>
        </tr>
        <?php
            else:
                foreach ($smartFormProjects as $smartFormProject):
        ?>
    	<tr>
    		<td><?php echo $smartFormProject['SmartFormProject']['type']; ?></td>
    		<td><?php echo $smartFormProject['SmartFormProject']['scope']; ?></td>
    		<td><?php echo $smartFormProject['SmartFormProject']['date_received']; ?></td>
    		<td><?php echo ($smartFormProject['SmartFormProject']['completed_date'] ? date("Y-m-d", strtotime($smartFormProject['SmartFormProject']['completed_date'])) : '<em>Active</em>'); ?></td>
    		<td><?php echo $smartFormProject['Admin']['first_name'] . ' ' . $smartFormProject['Admin']['last_name']; ?></td>
    		<td><?php echo ($smartFormProject['SmartFormProject']['output_change'] ? 'Yes' : 'No'); ?></td>
    		<td><?php echo ($smartFormProject['SmartFormProject']['user_id'] ? $smartFormProject['User']['first_name'] : '<em>None</em>'); ?></td>
    		<td><?php echo $this->Html->link("<span class='glyphicon glyphicon-search action-image' aria-hidden='true'></span>", array('controller' => 'smartFormProjects', 'action' => 'view', $smartFormProject['SmartFormProject']['id']), array('escapeTitle' => false)); ?></td>
    		<td><?php echo $this->Form->postLink("<span class='glyphicon glyphicon-remove action-image' aria-hidden='true'></span>", array('controller' => 'smartFormProjects', 'action' => 'delete', $smartFormProject['SmartFormProject']['id']), array('escapeTitle' => false, 'confirm' => 'Are you sure you want to Delete this project? If needed, you can edit it by clicking the View icon.')); ?></td>
    	</tr>
    	<?php
        		endforeach;
        		unset($smartFormProject);
            endif;
    	?>	
    </table>
</div>


<!-- Delete / Retire Member Popup -->
<div id="deleteRetirePopup" title="Delete / Retire Member">
	<p>Are you sure you want to delete this smart form? If the form is simply no longer in user, please update the status instead.</p>
	<h6>Please note that deleting a smart form cannot be undone.</h6>
	<p>&nbsp;</p>
	<p><?php echo $this->Form->postLink('Delete', array('action' => 'delete', $smartForm['SmartForm']['id'])); ?></p>
</div>
