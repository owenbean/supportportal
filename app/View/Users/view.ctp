<h1>User Profile</h1>

<p>&nbsp;</p>
<h2><?php echo h($user['User']['first_name']) . ' ' . h($user['User']['last_name']); ?></h2>
<p>Username: <?php echo h($user['User']['username']); ?></p>
<p>Email Address: <?php echo $user['User']['email_address']; ?></p>
<p><?php echo $this->Html->link('Edit', array('controller' => 'users', 'action' => 'edit', $user['User']['id'])); ?></p>
<p>&nbsp;</p>