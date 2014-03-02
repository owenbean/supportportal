<h1><?php echo h($user['User']['first_name']); ?></h1>

<p><small>Created: <?php echo $user['User']['created']; ?></small></p>

<p><?php echo h($user['User']['username']); ?></p>

<p><?php echo $this->Html->link('Back', array('controller' => 'users', 'action' => 'index')); ?></p>