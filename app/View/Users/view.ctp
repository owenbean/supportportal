<h3>User Profile</h3>

<p>&nbsp;</p>

<h4><?php echo h($user['User']['first_name']) . ' ' . h($user['User']['last_name']); ?></h4>
<p>Username: <?php echo h($user['User']['username']); ?></p>
<p>Email Address: <?php echo $user['User']['email_address']; ?></p>

<p>&nbsp;</p>

<h4>Edit:</h4>
<p><?php echo $this->Html->link('Profile', array('controller' => 'users', 'action' => 'edit', $user['User']['id'])); ?>, <?php echo $this->Html->link('Password', array('controller' => 'users', 'action' => 'password', $user['User']['id'])); ?></p>
<?php if ($this->Session->read('Auth.User.role') == 'site_admin') ?>
<p><?php echo ($user['User']['active'] ? $this->Form->postLink('Deactivate', array('action' => 'inactivate', $user['User']['id']), array('confirm' => 'Are you sure you want to deactivate this user?', 'class' => 'inactivate_user_link')) : $this->Form->postLink('Activate', array('action' => 'activate', $user['User']['id']), array('confirm' => 'Are you sure you want to activate this user?', 'class' => 'activate_user_link'))); ?></p>
<p>&nbsp;</p>