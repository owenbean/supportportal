<h1>User Profile</h1>

<p>&nbsp;</p>
<h2><?php echo h($user['User']['first_name']) . ' ' . h($user['User']['last_name']); ?></h2>
<p>Username: <?php echo h($user['User']['username']); ?></p>
<p>Email Address: <?php echo $user['User']['email_address']; ?></p>
<p>&nbsp;</p>
<h2>Edit:</h2>
<p><?php echo $this->Html->link('Profile', array('controller' => 'users', 'action' => 'edit', $user['User']['id'])); ?>, <?php echo $this->Html->link('Password', array('controller' => 'users', 'action' => 'password', $user['User']['id'])); ?></p>
<p>&nbsp;</p>