<h2 class="title">Edit Letter Request</h2>

<p>&nbsp;</p>

<div class="col-sm-10 col-sm-offset-1">
	<?php echo $this->Form->create('Letter', array('class' => 'form-horizontal')); ?>
		<div class="form-group">
			<label class="col-sm-4 control-label">Member Name:</label>
			<div class="col-sm-5">
				<?php echo $this->Form->input('member_placeHolder', array('label' => false, 'default' => $letter['Member']['full_name'], 'disabled' => 'disabled', 'class' => 'form-control')); ?>
			</div>
		</div>
		<div class="form-group" id="submitter_name_holder">
			<label class="col-sm-4 control-label">Request Submitted By:</label>
			<div class="col-sm-5" id="submitter_name">
				<?php echo $this->Form->input('submitter_placeHolder', array('label' => false, 'default' => (is_numeric($letter['Letter']['submitter']) ? ($letter['Admin']['first_name'] . ' ' . $letter['Admin']['last_name']) : h($letter['Letter']['submitter'])), 'disabled' => 'disabled', 'class' => 'form-control')); ?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-4 control-label">Number of New Templates:</label>
			<div class="col-sm-5">
				<?php echo $this->Form->input('new_templates', array('label' => false, 'class' => 'form-control')); ?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-4 control-label">Number of Revised Templates:</label>
			<div class="col-sm-5">
				<?php echo $this->Form->input('revised_templates', array('label' => false, 'class' => 'form-control')); ?>
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
				<?php echo $this->Form->input('id', array('type' => 'hidden'));	?>
				<?php echo $this->Form->button('Update Request', array('type' => 'submit', 'class' => 'btn btn-default')); ?>
			</div>
		</div>
</div>





