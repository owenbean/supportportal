<?php echo $this->Session->flash('auth'); ?>

<h1 id="header_text">IRBNet Support Portal</h1>

<div id="login_table">
<?php echo $this->Form->create('User'); ?>
	<div class="login_line">
		<?php echo $this->Form->input('username', array('label' => 'Username: ')); ?>
	</div>
	<div class="login_line">
		<?php echo $this->Form->input('password', array('label' => 'Password: ')); ?>
	</div>
	<div id="login_button"><?php echo $this->Form->end('Login'); ?></div>
</div>