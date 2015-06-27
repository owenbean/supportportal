<h2 class="title">New Smart Form Request</h2>

<p>&nbsp;</p>

<div id="adminAddPopUp">
    <div id="new_admin_popup">
        <?php echo $this->Element('add_admin_form'); ?> 
    </div>
</div>

<div class="col-sm-10 col-sm-offset-1">
    <?php echo $this->Form->create('SmartFormProject', array('class' => 'form-horizontal')); ?>
        <div class="form-group">
            <label class="col-sm-4 control-label">Request Type:</label>
            <div class="col-sm-5">
				<?php echo $this->Form->input('type_placeHolder', array('label' => false, 'default' => $smartFormProject['SmartFormProject']['type'], 'disabled' => 'disabled', 'class' => 'form-control')); ?>
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-sm-4 control-label">Member Name:</label>
            <div class="col-sm-5">
				<?php echo $this->Form->input('member_placeHolder', array('label' => false, 'default' => $smartFormProject['Member']['full_name'], 'disabled' => 'disabled', 'class' => 'form-control')); ?>
            </div>
        </div>
        
        <div id="ajax-dropdown-container">
            <div class="form-group" id="smart_form_holder">
                <label class="col-sm-4 control-label">Smart Form:</label>
                <div class="col-sm-5" id="smart_form_name">
                    <?php echo $this->Form->input('smart_form_placeHolder', array('label' => false, 'default' => ($smartFormProject['SmartForm']['id'] ? $smartFormProject['SmartForm']['name'] . ' (' . $smartFormProject['SmartForm']['sf_domain'] . ')' : null), 'disabled' => 'disabled', 'class' => 'form-control')); ?>
                </div>
            </div>
            
            <div class="form-group" id="submitter_name_holder">
                <label class="col-sm-4 control-label">Request Submitted By:</label>
                <div class="col-sm-5" id="submitter_name">
                    <?php echo $this->Form->input('admin_placeHolder', array('label' => false, 'default' => $smartFormProject['Admin']['first_name'] . ' ' . $smartFormProject['Admin']['last_name'], 'disabled' => 'disabled', 'class' => 'form-control')); ?>
                </div>
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-sm-4 control-label">Request Owner:</label>
            <div class="col-sm-5">
                <?php echo $this->Form->input('user_id', array(
                    'label' => false,
                    'class' => 'form-control',
                    'options' => $users,
                    'empty' => 'Unknown'
                )); ?>
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
                <?php echo $this->Form->input('target_date', array('label' => false, 'class' => 'date_picker form-control')) . $this->Form->button('TBD', array('id' => 'tbd_button', 'class' => 'btn btn-default')); ?>
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-sm-4 control-label">Scope of Request:</label>
            <div class="col-sm-5">
                <?php echo $this->Form->input('scope', array(
                        'label' => false,
                        'class' => 'form-control',
                        'options' => array(
                            'New Form' => 'New Form',
                            'Major Change' => 'Major',
                            'Minor Change' => 'Minor',
                            'Trivial Change' => 'Trivial'
                        ),
                        'empty' => ''
                    )); ?>
            </div>
        </div>
        
        <div class="form-group">
        <div class="col-sm-offset-4 col-sm-5">
                <?php echo $this->Form->input('output_change', array('type' => 'checkbox', 'label' => 'Output Change? ', 'format' => array('before', 'label', 'between', 'input', 'after', 'error'))); ?>
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
                <?php echo $this->Form->button('Update Request', array('type' => 'submit', 'class' => 'btn btn-default')); ?>
            </div>
        </div>
</div>
