<h2 class="title">New Letter or Stamp Request</h2>

<p>&nbsp;</p>

<div id="adminAddPopUp">
	<div id="new_admin_popup">
		<?php echo $this->Element('add_admin_form'); ?>	
	</div>
</div>

<div class="col-sm-10 col-sm-offset-1">
	<?php echo $this->Form->create('Letter', array('class' => 'form-horizontal')); ?>
		<div class="form-group">
			<label class="col-sm-4 control-label">Member Name:</label>
			<div class="col-sm-5">
				<?php echo $this->Form->input('member_id', array('label' => false, 'empty' => '', 'id' => 'member_name', 'class' => 'form-control', 'onchange' => 'activateSubmittedByDropdown()')); ?>
			</div>
		</div>
		
		<div class="form-group" id="submitter_name_holder">
			<label class="col-sm-4 control-label">Request Submitted By:</label>
			<div class="col-sm-5" id="submitter_name">
				<?php echo $this->Form->input('submitter', array('label' => false, 'disabled' => 'disabled', 'class' => 'form-control')); ?>
			</div>
		</div>
		
		<div class="form-group" id="submitter_name_holder">
			<label class="col-sm-4 control-label">Request Type:</label>
			<div class="col-sm-5" id="submitter_name">
				<?php echo $this->Form->input('type', array(
					'label' => false,
					'class' => 'form-control',
					'options' => array(
						'Letter' => 'Letter',
						'Stamp' => 'Stamp',
					),
					'empty' => ''
				)); ?>
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-sm-4 control-label">Number of New Templates:</label>
			<div class="col-sm-5">
				<?php echo $this->Form->input('new_templates', array('label' => false, 'default' => '0', 'class' => 'form-control')); ?>
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-sm-4 control-label">Number of Revised Templates:</label>
			<div class="col-sm-5">
				<?php echo $this->Form->input('revised_templates', array('label' => false, 'default' => '0', 'class' => 'form-control')); ?>
			</div>
		</div>
		
		<div class="form-group">
	    <div class="col-sm-offset-4 col-sm-5">
				<?php echo $this->Form->input('enrollment', array('type' => 'checkbox', 'label' => 'Request part of enrollment? ', 'format' => array('before', 'label', 'between', 'input', 'after', 'error'))); ?>
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-sm-4 control-label">Date of Request:</label>
			<div class="col-sm-5">
				<?php echo $this->Form->input('date_received', array('label' => false, 'class' => 'date_picker form-control')); ?>
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-sm-4 control-label">Target Date:</label>
			<div class="col-sm-5">
				<?php echo $this->Form->input('target_date', array('label' => false, 'class' => 'date_picker form-control')); ?>
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-sm-4 control-label">Request Comments:</label>
			<div class="col-sm-5">
				<?php echo $this->Form->input('comments', array('label' => false, 'id' => 'comments_field', 'class' => 'form-control')); ?>
			</div>
		</div>
		
		<div class="form-group">
			<div class="col-sm-5 col-sm-offset-4">
				<?php echo $this->Form->button('Submit Request', array('type' => 'submit', 'class' => 'btn btn-default')); ?>
			</div>
		</div>
</div>



