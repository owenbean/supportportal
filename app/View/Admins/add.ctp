<h2 class="title">New Administrator</h2>

<p>&nbsp;</p>

<div class="col-sm-10 col-sm-offset-1">
<?php echo $this->Form->create('Admin', array('class' => 'form-horizontal')); ?>
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
			<label class="col-sm-4 control-label">Email Address:</label>
			<div class="col-sm-5">
				<?php echo $this->Form->input('email_address', array('label' => false, 'class' => 'form-control')); ?>
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-4 control-label">Organization:</label>
			<div class="col-sm-5">
				<?php 
					if (sizeof($members) > 1) {
						echo $this->Form->input('member_id', array('label' => false, 'empty' => 'None', 'class' => 'form-control'));
					} else {
						$member = implode(array_flip($members));
						echo $this->Form->input('member_id', array('label' => false, 'default' => $member, 'type' => 'hidden', 'class' => 'form-control'));
					} 
				?>
			</div>
		</div>

		<div class="form-group">
	    <div class="col-sm-offset-4 col-sm-5">
				<?php echo $this->Form->input('contract_lead', array('type' => 'checkbox', 'label' => 'Contract Lead? ', 'format' => array('before', 'label', 'between', 'input', 'after', 'error'))); ?>
				<?php echo $this->Form->input('feature_announcement_list', array('type' => 'checkbox', 'label' => 'Feature Announcement List? ', 'format' => array('before', 'label', 'between', 'input', 'after', 'error'))); ?>
				<?php echo $this->Form->input('support_outreach_list', array('type' => 'checkbox', 'label' => 'Support Outreach List? ', 'format' => array('before', 'label', 'between', 'input', 'after', 'error'))); ?>
				<?php echo $this->Form->input('billing_coord', array('type' => 'checkbox', 'label' => 'Billing Coord? ', 'format' => array('before', 'label', 'between', 'input', 'after', 'error'))); ?>
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
				<?php echo $this->Form->button('Add Admin', array('type' => 'submit', 'class' => 'btn btn-default')); ?>
			</div>
		</div>
</div>
