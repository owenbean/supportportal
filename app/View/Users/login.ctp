<?php echo $this->Session->flash('auth'); ?>

<h2 class="title">IRBNet Support Portal</h2>

<p>&nbsp;</p>

<div class="col-sm-4 col-sm-offset-4">
<?php echo $this->Form->create('User'); ?>
	<div class="form-group">
		<?php echo $this->Form->input('username', array('label' => "Username: ", 'class' => 'form-control', 'placeholder' => 'Username')); ?>
	</div>
	<div class="form-group">
		<?php echo $this->Form->input('password', array('label' => "Password: ", 'class' => 'form-control', 'placeholder' => 'Password')); ?>
	</div>
	<?php echo $this->Form->button('Sign in', array('type' => 'submit', 'class' => 'btn btn-default')); ?>
</div>

<div class="col-sm-12">
	<p>&nbsp;</p>
</div>