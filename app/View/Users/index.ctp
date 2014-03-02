<h1>Users</h1>

<?php echo $this->Html->link('Add User', array('controller' => 'users', 'action' => 'add')); ?>, 
<?php echo $this->Html->link('Posts', array('controller' => 'posts', 'action' => 'index')); ?>

<table>
    <tr>
        <th>Name</th>
		<th>Username</th>
		<th>Email Address</th>
        <th>Added</th>
    </tr>
	
	<?php if ($users == null ) { ?>
	<tr>
		<td colspan="4">
		<?php echo 'No users to display' ?>
		</td>
	</tr>
	
	<?php } else { 
		foreach ($users as $user): ?>
    <tr>
        <td>
            <?php echo $this->Html->link($user['User']['first_name'], array('action' => 'view', $user['User']['id'])); ?>
        </td>
		<td>
			<?php echo $user['User']['username']; ?>
		</td>	
		<td>
			<?php echo $user['User']['email_address']; ?>
		</td>
		<td>
			<?php echo $user['User']['created']; ?>
		</td>
    </tr>
    <?php endforeach; ?>
    <?php unset($user);
	}
	?>
</table>