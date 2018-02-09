<h2 class="title">New Smart Form Deployment</h2>

<p>&nbsp;</p>

<div class="col-sm-10 col-sm-offset-1">
    <?php echo $this->Form->create('SmartFormProjectDeployment', array('class' => 'form-horizontal')); ?>	
        <div class="form-group">
            <label class="col-sm-4 control-label">Date of Request:</label>
            <div class="col-sm-5">
                <?php echo $this->Form->input('date_received', array('label' => false, 'class' => 'date_picker form-control')); ?>
				<?php echo $this->Form->input('smart_form_project_id', array('type' => 'hidden', 'label' => 'Smart Form Project: ', 'default' => $smartformprojects)); ?>
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-sm-4 control-label">Target Date:</label>
            <div class="col-sm-5">
                <?php echo $this->Form->input('target_date', array('label' => false, 'class' => 'date_picker form-control')) . $this->Form->button('TBD', array('id' => 'tbd_button', 'class' => 'btn btn-default')); ?>
            </div>
        </div>
        
        <div class="form-group">
            <div class="col-sm-5 col-sm-offset-4">
                <?php echo $this->Form->button('Submit Request', array('type' => 'submit', 'class' => 'btn btn-default')); ?>
            </div>
        </div>
</div>
