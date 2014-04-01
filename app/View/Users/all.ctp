<h1 id="header_text">System Administrators</h1>

<p>&nbsp;</p>

<div id="admin_list_table">
<table>
<tbody>
	<tr>
		<th>Name</th>
		<th>Role</th>
		<th>Status</th>
	<tr>
<?php foreach ($users as $user): ?>
	<tr>
		<td><?php echo $this->Form->postLink(h($user['User']['first_name']) . ' ' . h($user['User']['last_name']), array('controller' => 'users', 'action' => 'view', $user['User']['id'])); ?></td>
		<td><?php echo h($user['User']['role']); ?></td>
		<td><?php echo ($user['User']['active'] ? $this->Form->postLink('Active', array('action' => 'inactivate', $user['User']['id'])) : $this->Form->postLink('Inactive', array('action' => 'activate', $user['User']['id']))); ?></td>
	</tr>
	<?php
		endforeach;
		unset($user);
	?>
</tbody>
</table>
</div>

<p>&nbsp;</p>
	
<?php echo $this->Html->link('Add New', array('controller' => 'users', 'action' => 'add')); ?>

<p>&nbsp;</p>
