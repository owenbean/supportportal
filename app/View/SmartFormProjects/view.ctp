<h3>View Smart Form Project</h3>

<p>&nbsp;</p>

<h4><?php echo h($smartFormProject['Member']['full_name']); ?></h4>
<p>Submitted By: <strong><?php echo $smartFormProject['Admin']['first_name'] . ' ' . $smartFormProject['Admin']['last_name']; ?></strong></p>
<p>Project Type: <strong><?php echo $smartFormProject['SmartFormProject']['type'] . ' request'; ?></strong></p>
<p>Project Scope: <strong><?php echo $smartFormProject['SmartFormProject']['scope']; ?></strong></p>
<p>Output Change? <strong><?php echo ($smartFormProject['SmartFormProject']['output_change'] ? 'Yes' : 'No'); ?></strong></p>
<p>Date of Request: <strong><?php echo $smartFormProject['SmartFormProject']['date_received']; ?></strong></p>
<p>Target Date: <strong><?php echo $smartFormProject['SmartFormProject']['target_date']; ?></strong></p>
<p>Date Completed: <strong><?php echo ($smartFormProject['SmartFormProject']['completed_date'] ? date("Y-m-d", strtotime($smartFormProject['SmartFormProject']['completed_date'])) : '<em>Active</em>'); ?></strong></p>
<p class="claim_link">Project Owned By: <?php echo (!$smartFormProject['SmartFormProject']['user_id'] ? $this->Html->link('[claim]', array('action' => 'claim', $smartFormProject['SmartFormProject']['id'])) : '<strong>' . $smartFormProject['User']['first_name'] . '</strong>'); ?> <?php echo ($smartFormProject['SmartFormProject']['user_id'] == $user_id ? $this->Html->link('[unclaim]', array('action' => 'unclaim', $smartFormProject['SmartFormProject']['id'])) : null ); ?></p>
<p>Project Comments: <strong><?php echo (!$smartFormProject['SmartFormProject']['comments'] ? 'None' : $smartFormProject['SmartFormProject']['comments']); ?></strong></p>
<p>&nbsp;</p>
<p><?php echo $this->Html->link('Edit', array('action' => 'edit', $smartFormProject['SmartFormProject']['id'])) . ' | ' . $this->Html->link('Back', array('action' => 'active')); ?></p>
<p>&nbsp;</p>