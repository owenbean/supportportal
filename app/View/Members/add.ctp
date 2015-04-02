<h2 class="title">New Member</h2>

<p>&nbsp;</p>

<div class="col-sm-10 col-sm-offset-1">
<?php echo $this->Form->create('Member', array('class' => 'form-horizontal')); ?>
		<div class="form-group">
			<label class="col-sm-4 control-label">Member Name:</label>
			<div class="col-sm-5">
				<?php echo $this->Form->input('full_name', array('label' => false, 'class' => 'form-control')); ?>
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-sm-4 control-label">Member Short Name:</label>
			<div class="col-sm-5">
				<?php echo $this->Form->input('short_name', array('label' => false, 'class' => 'form-control')); ?>
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-4 control-label">Member ID:</label>
			<div class="col-sm-5">
				<?php echo $this->Form->input('op_num', array('label' => false, 'class' => 'form-control')); ?>
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-4 control-label">Member Class:</label>
			<div class="col-sm-5">
				<?php echo $this->Form->input('class', array(
						'label' => false,
						'class' => 'form-control',
						'options' => array(
							'University' => 'University',
							'Hospital' => 'Hospital', 
							'VA' => 'VA', 
							'Other' => 'Other'
						),
						'empty' => '')); 
				?>
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-4 control-label">Member City:</label>
			<div class="col-sm-5">
				<?php echo $this->Form->input('city', array('label' => false, 'class' => 'form-control')); ?>
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-4 control-label">Member State:</label>
			<div class="col-sm-5">
				<?php echo $this->Form->input('state', array('label' => false, 'class' => 'form-control')); ?>
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-4 control-label">Member Specialist:</label>
			<div class="col-sm-5">
				<?php echo $this->Form->input('specialist', array('label' => false, 'empty' => 'None', 'class' => 'form-control')); ?>
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-4 control-label">Pings Email Address:</label>
			<div class="col-sm-5">
				<?php echo $this->Form->input('pings_email', array('label' => false, 'class' => 'form-control')); ?>
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-4 control-label">IRBNet Resources Username:</label>
			<div class="col-sm-5">
				<?php echo $this->Form->input('resources_username', array('label' => false, 'class' => 'form-control')); ?>
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-4 control-label">IRBNet Resources Password:</label>
			<div class="col-sm-5">
				<?php echo $this->Form->input('resources_password', array('label' => false, 'class' => 'form-control')); ?>
			</div>
		</div>

		<div class="form-group">
	    <div class="col-sm-offset-4 col-sm-5">
				<?php echo $this->Form->input('citi_integration', array('type' => 'checkbox', 'label' => 'CITI Integration? ', 'format' => array('before', 'label', 'between', 'input', 'after', 'error'))); ?>
				<?php echo $this->Form->input('wirb_integration', array('type' => 'checkbox', 'label' => 'WIRB Integration? ', 'format' => array('before', 'label', 'between', 'input', 'after', 'error'))); ?>
				<?php echo $this->Form->input('sso', array('type' => 'checkbox', 'label' => 'Single Sign-On? ', 'format' => array('before', 'label', 'between', 'input', 'after', 'error'))); ?>
				<?php echo $this->Form->input('file_access', array('type' => 'checkbox', 'label' => 'File Access? ', 'format' => array('before', 'label', 'between', 'input', 'after', 'error'))); ?>
				<?php echo $this->Form->input('multi_workspace_setup', array('type' => 'checkbox', 'label' => 'Any multi-workspace setups (no master board)? ', 'format' => array('before', 'label', 'between', 'input', 'after', 'error'))); ?>
				<?php echo $this->Form->input('master_board_setup', array('type' => 'checkbox', 'label' => 'Any multi-workspace setups with a master board? ', 'format' => array('before', 'label', 'between', 'input', 'after', 'error'))); ?>
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-4 control-label">Comments:</label>
			<div class="col-sm-5">
				<?php echo $this->Form->input('comments', array('label' => false, 'id' => 'comments_field', 'class' => 'form-control')); ?>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-5 col-sm-offset-4">
				<?php echo $this->Form->button('Add Member', array('type' => 'submit', 'class' => 'btn btn-default')); ?>
			</div>
		</div>
</div>
