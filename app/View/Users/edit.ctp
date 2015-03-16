<h2 class="title">User Profile</h2>

<p>&nbsp;</p>

<div class="col-sm-10 col-sm-offset-1">
<?php echo $this->Form->create('User', array('class' => 'form-horizontal')); ?>
		<div class="form-group">
			<label class="col-sm-4 control-label">First Name:</label>
			<div class="col-sm-5">
				<?php echo $this->Form->input('first_name', array('label' => false, 'class' => 'form-control')); ?>
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-sm-4 control-label">Last Name:</label>
			<div class="col-sm-5">
				<?php echo $this->Form->input('last_name', array('label' => false, 'class' => 'form-control')); ?>
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-4 control-label">Username:</label>
			<div class="col-sm-5">
				<?php echo $this->Form->input('username', array('label' => false, 'class' => 'form-control')); ?>
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-4 control-label">Email Address:</label>
			<div class="col-sm-5">
				<?php echo $this->Form->input('email_address', array('label' => false, 'class' => 'form-control')); ?>
			</div>
		</div>

	<?php if ($this->Session->read('Auth.User.role') == 'site_admin') { ?>
		<div class="form-group">
			<label class="col-sm-4 control-label">Role:</label>
			<div class="col-sm-5">
				<?php echo $this->Form->input('role', array('options' => array('site_admin' => 'Site Admin', 'admin' => 'Admin', 'contractor' => 'Contractor'), 'empty' => '', 'label' => false)); ?>
			</div>
		</div>

		<div class="form-group">
	    <div class="col-sm-offset-4 col-sm-5">
				<?php echo $this->Form->input('faq_editor', array('type' => 'checkbox', 'label' => 'FAQ Editor: ', 'format' => array('before', 'label', 'between', 'input', 'after', 'error'))); ?>
			</div>
		</div>
		<?php } ?>

		<div class="form-group">
			<div class="col-sm-5 col-sm-offset-4">
				<?php echo $this->Form->input('id', array('type' => 'hidden')); ?>
				<?php echo $this->Form->button('Save', array('type' => 'submit', 'class' => 'btn btn-default')); ?>
			</div>
		</div>
</div>
