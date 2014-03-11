<h1 id="header_text">National Research Network Smart Forms</h1>
<div id="org_list_table">
	<table>
		<tr>
			<th>Smart Form Name</th>
			<th>Type</th>
			<th>Member Name</th>
			<th>Developer</th>
			<th>Smart Form Status</th>
		</tr>
		
		<?php if ($smartForms == null) { ?>
		<tr><td colspan="3">No smart forms to display</td></tr>
		<?php } else {
			foreach ($smartForms as $smartForms): ?>
		<tr>
			<td><?php echo $this->Html->link($smartForms['SmartForm']['name'], array('controller' => 'members', 'action' => 'view', $smartForms['Member']['id'])); ?></td>
			<td><?php echo $smartForms['SmartForm']['sf_domain']; ?></td>
			<td><?php echo $this->Html->link($smartForms['Member']['short_name'], array('controller' => 'members', 'action' => 'view', $smartForms['Member']['id'])); ?></td>
			<td><?php echo $smartForms['SmartForm']['developer']; ?></td>
			<td><?php echo $smartForms['SmartForm']['status']; ?></td>
		</tr>
		<?php endforeach; ?>
		<?php unset($smartForms); 
		} ?>
	</table>
</div>
<p>&nbsp;</p>
