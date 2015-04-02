<h2 class="title">Support Portal Users</h2>

<p>&nbsp;</p>

<div class="col-sm-8 col-sm-offset-2">
	<table class="table table-condensed table-bordered table-hover">
	<thead>
		<tr>
			<th>Name</th>
			<th>Role</th>
			<th>FAQ Editor</th>
			<th>Status</th>
			<th>Last Logged In</th>
		<tr>
	</thead>

	<tbody>
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
			<tr class="list-item">
				<td><?php echo $this->Html->link(h($user['User']['first_name']) . ' ' . h($user['User']['last_name']), array('controller' => 'users', 'action' => 'view', $user['User']['id']), array('class' => 'user_name_link')); ?></td>
				<td><?php echo $user_role; ?></td>
				<td><?php echo ($user['User']['faq_editor'] ? 'Yes' : 'No'); ?></td>
				<td <?php echo $user['User']['active'] ? "class='success'" : "class='danger'" ?>><?php echo ($user['User']['active'] ? 'Active' : 'Inactive'); ?></td>
				<td><?php echo ($user['User']['last_login'] ? $user['User']['last_login'] : "Never"); ?></td>
			</tr>
			<?php
				endforeach;
				unset($user);
			?>
		</tbody>
	</table>
</div>

<div class="col-sm-8 col-sm-offset-2">
	<p>&nbsp;</p>
	<p><?php echo $this->Html->link('Add New', array('controller' => 'users', 'action' => 'add')); ?></p>
</div>