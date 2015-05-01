<h2 class='title'>Edit Smart Form</h2>

<p>&nbsp;</p>

<div class="col-sm-10 col-sm-offset-1">	
<?php echo $this->Form->create('SmartForm', array('class' => 'form-horizontal')); ?>
        <div class="form-group">
            <label class="col-sm-4 control-label">Smart Form Name:</label>
            <div class="col-sm-5">
                <?php echo $this->Form->input('name', array('label' => false, 'maxLength' => '100', 'class' => 'form-control')); ?>
				<?php echo $this->Form->input('id', array('type' => 'hidden')); ?>
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-sm-4 control-label">Domain:</label>
            <div class="col-sm-5">
                <?php echo $this->Form->input('sf_domain', array(
                        'label' => false,
                        'class' => 'form-control',
                        'options' => array(
                            'Administrator' => 'Administrator',
                            'COI - General' => 'COI - General',
                            'COI - Project' => 'COI - Project',
                            'Researcher' => 'Researcher',
                            'Reviewer' => 'Reviewer',
                            'Other' => 'Other'
                        ),
                        'empty' => ''
                    )); ?>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-4 control-label">Smart Form Status:</label>
            <div class="col-sm-5">
                <?php echo $this->Form->input('status', array(
                        'label' => false,
                        'class' => 'form-control',
                        'options' => array(
                            'Contracted' => 'Contracted',
                            'In Development' => 'In Development',
                            'Live' => 'Live',
                            'Retired' => 'Retired'
                        ),
                        'empty' => ''
                    )); ?>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-4 control-label">Launch Date:</label>
            <div class="col-sm-5">
                <?php echo $this->Form->input('launch_date', array(
                        'label' => false,
                        'id' => 'go_live_date',
                        'class' => 'date_picker form-control',
                        'size' => '20'
                    )) . $this->Form->button('TBD', array('id' => 'tbd_button', 'class' => 'btn btn-default'))
                    ; ?>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-4 control-label">Smart Form Developer:</label>
            <div class="col-sm-5">
                <?php echo $this->Form->input('developer', array(
                    'label' => false,
                    'class' => 'form-control',
                    'options' => $users,
                    'empty' => 'Unknown'
                )); ?>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-5 col-sm-offset-4">
                <?php echo $this->Form->button('Update Smart Form', array('type' => 'submit', 'class' => 'btn btn-default')); ?>
            </div>
        </div>
</div>







