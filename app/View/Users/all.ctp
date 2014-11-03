<h1 id="header_text">Support Portal Users</h1>

<div id="user_list_table">
	<table>
	<tbody>
		<tr>
			<th>Name</th>
			<th>Role</th>
			<th>FAQ Editor</th>
			<th>Status</th>
			<th>Last Logged In</th>
		<tr>
	<?php foreach ($users as $user): ?>
		<?php
			//make user role more reader-freindly
			$user_role = $user['User']['role'];
			switch($user_role){
				case 'site_admin':
					$user_role = 'Site Admin';
					break;
				case 'admin':
					$user_role = 'Admin';
					break;
				case 'contractor':
					$user_role = 'Contractor';
					break;
				default:
					$user_role = $user['User']['role'];
			}
		?>
		<tr>
			<td><?php echo $this->Form->postLink(h($user['User']['first_name']) . ' ' . h($user['User']['last_name']), array('controller' => 'users', 'action' => 'view', $user['User']['id']), array('class' => 'user_name_link')); ?></td>
			<td><?php echo $user_role; ?></td>
			<td><?php echo ($user['User']['faq_editor'] ? 'Yes' : 'No'); ?></td>
			<td><?php echo ($user['User']['active'] ? $this->Form->postLink('Active', array('action' => 'inactivate', $user['User']['id']), array('confirm' => 'Are you sure you want to deactivate this user?', 'class' => 'inactivate_user_link')) : $this->Form->postLink('Inactive', array('action' => 'activate', $user['User']['id']), array('confirm' => 'Are you sure you want to activate this user?', 'class' => 'activate_user_link'))); ?></td>
			<td><?php echo ($user['User']['last_login'] ? $user['User']['last_login'] : "Never"); ?></td>
		</tr>
		<?php
			endforeach;
			unset($user);
		?>
	</tbody>
	</table>
	
	<p>&nbsp;</p>
		
	<?php echo $this->Html->link('Add New', array('controller' => 'users', 'action' => 'add')); ?>

</div>


<p>&nbsp;</p>
