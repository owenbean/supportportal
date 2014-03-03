<h1>Blog posts</h1>

<?php echo $this->Html->link('Add Post', array('controller' => 'posts', 'action' => 'add')); ?>, 
<?php echo $this->Html->link('Users', array('controller' => 'users', 'action' => 'index')); ?>, 
<?php 
	$session_user_name = $this->Session->read('Auth.User.first_name') . ' ' . $this->Session->read('Auth.User.last_name');
	echo $this->Html->link("$session_user_name", array('controller' => 'users', 'action' => 'view', $this->Session->read('Auth.User.id')));
?>, 
<?php echo $this->Html->link('Log Out', array('controller' => 'users', 'action' => 'logout')); ?>

<table>
    <tr>
        <th>Id</th>
        <th>Title</th>
		<th>Action</th>
        <th>Created</th>
		<th>Updated</th>
    </tr>

    <!-- Here is where we loop through our $posts array, printing out post info -->

    <?php foreach ($posts as $post): ?>
    <tr>
        <td><?php echo $post['Post']['id']; ?></td>
        <td>
            <?php echo $this->Html->link($post['Post']['title'], array('action' => 'view', $post['Post']['id'])); ?>
        </td>
		<td>
			<?php echo $this->Html->link('Edit', array('action' => 'edit', $post['Post']['id'])); ?>, 
			<?php echo $this->Form->postLink('Delete', array('action' => 'delete', $post['Post']['id']), array('confirm' => 'Are you sure?')); ?>
		</td>	
		<td>
			<?php echo $post['Post']['created']; ?>
		</td>
		<td>
			<?php echo $post['Post']['modified']; ?>
		</td>
    </tr>
    <?php endforeach; ?>
    <?php unset($post); ?>
</table>