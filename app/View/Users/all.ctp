<h1 id="header_text">System Administrators</h1>

<?php
	foreach ($users as $user): 
		echo $user['User']['first_name'] . ' ' . $user['User']['last_name'] . ' - ' . $user['User']['role'] . '<br />';
	endforeach;
	unset($user);
?>
<p>&nbsp;</p>
	
<?php echo $this->Html->link('Add New', array('controller' => 'users', 'action' => 'add')); ?>

<p>&nbsp;</p>
