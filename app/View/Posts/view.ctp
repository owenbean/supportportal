<h1><?php echo h($post['Post']['title']); ?></h1>

<p><small>Created: <?php echo $post['Post']['created']; ?></small></p>

<p><?php echo h($post['Post']['body']); ?></p>

<p><?php echo $this->Html->link('Back', array('controller' => 'posts', 'action' => 'index')); ?></p>