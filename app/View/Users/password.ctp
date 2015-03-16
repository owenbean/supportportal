<h2 class="title">User Profile</h2>

<p>&nbsp;</p>

<div class="col-sm-10 col-sm-offset-1">
<?php echo $this->Form->create('User', array('class' => 'form-horizontal')); ?>
		<div class="form-group">
			<label class="col-sm-4 control-label">New Password:</label>
			<div class="col-sm-5">
				<?php echo $this->Form->input('password', array('label' => false, 'type' => 'password', 'class' => 'form-control')); ?>
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-sm-4 control-label">Confirm Password:</label>
			<div class="col-sm-5">
				<?php echo $this->Form->input('password_confirm', array('label' => false, 'type' => 'password', 'class' => 'form-control')); ?>
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-5 col-sm-offset-4">
				<?php echo $this->Form->input('id', array('type' => 'hidden')); ?>
				<?php echo $this->Form->button('Save', array('type' => 'submit', 'class' => 'btn btn-default')); ?>
			</div>
		</div>
</div>
