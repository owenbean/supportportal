<?php echo $this->Session->flash('auth'); ?>

<h1>IRBNet Support Portal</h1>

<div class="col-sm-8">
<?php echo $this->Form->create('User'); ?>
	<div class="form-group">
		<?php echo $this->Form->input('username', array('label' => "Username:\n", 'class' => 'form-control', 'placeholder' => 'Username')); ?>
	</div>
	<div class="form-group">
		<?php echo $this->Form->input('password', array('label' => "Password:\n", 'class' => 'form-control', 'placeholder' => 'Password')); ?>
	</div>
	<?php echo $this->Form->button('Login', array('type' => 'submit', 'class' => 'btn btn-default')); ?>
</div>