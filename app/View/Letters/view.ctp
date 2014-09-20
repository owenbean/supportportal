<h1>Letter Request</h1>

<p>&nbsp;</p>
<h2><?php echo h($letter['Member']['full_name']); ?> - Letter Request</h2>
<p>Submitted By: <strong><?php echo (is_numeric($letter['Letter']['submitter']) ? ($letter['Admin']['first_name'] . ' ' . $letter['Admin']['last_name']) : h($letter['Letter']['submitter'])); ?></strong></p>
<p>New Templates: <strong><?php echo $letter['Letter']['new_templates']; ?></strong></p>
<p>Revised Templates: <strong><?php echo $letter['Letter']['revised_templates']; ?></strong></p>
<p>Enrollment? <strong><?php echo ($letter['Letter']['enrollment'] ? 'Yes' : 'No'); ?></strong></p>
<p>Date of Request: <strong><?php echo $letter['Letter']['date_received']; ?></strong></p>
<p>Target Date: <strong><?php echo $letter['Letter']['target_date']; ?></strong></p>
<p>Date Completed: <strong><?php echo ($letter['Letter']['completed_date'] ? date("Y-m-d", strtotime($letter['Letter']['completed_date'])) : '<em>Active</em>'); ?></strong></p>
<p class="claim_link">Request Owned By: <?php echo (!$letter['Letter']['request_owner'] ? $this->Html->link('[claim]', array('controller' => 'letters', 'action' => 'claim', $letter['Letter']['id'])) : '<strong>' . $letter['User']['first_name'] . '</strong>'); ?> <?php echo ($letter['Letter']['request_owner'] == $user_id ? $this->Html->link('[unclaim]', array('action' => 'unclaim', $letter['Letter']['id'])) : null ); ?></p>
<p>Request Comments: <strong><?php echo (!$letter['Letter']['comments'] ? 'None' : $letter['Letter']['comments']); ?></strong></p>
<p>&nbsp;</p>
<p><?php echo $this->Html->link('Edit', array('action' => 'edit', $letter['Letter']['id'])) . ' ' . $this->Html->link('Back', array('action' => 'active')); ?></p>
<p>&nbsp;</p>