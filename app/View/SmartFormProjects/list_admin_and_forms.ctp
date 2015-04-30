<?php
    $html_container = null;
    
	if($member_id == null) {
    	$html_container =
                    "<div class='form-group' id='smart_form_holder'>
                        <label class='col-sm-4 control-label'>Smart Form:</label>
                        <div class='col-sm-5' id='smart_form_name'>
                            <div class='input select'>
                                <select name='data[SmartFormProject][smart_form_id]' disabled='disabled' class='form-control' id='SmartFormProjectSmartFormId'></select>
                            </div>
                        </div>
                    </div>
                    <div class='form-group' id='submitter_name_holder'>
                        <label class='col-sm-4 control-label'>Request Submitted By:</label>
                        <div class='col-sm-5' id='submitter_name'>
                            <div class='input select'>
                                <select name='data[SmartFormProject][admin_id]' disabled='disabled' class='form-control' id='SmartFormProjectAdminId'></select>
                            </div>
                        </div>
                    </div>";
		echo $html_container;
	} else {
		$smart_form_ids = array();
		$smart_form_names = array();
		$admin_ids = array();
		$admin_names = array();
		
		foreach ($submitter_names as $admin) {
			array_push($admin_ids, $admin['Admin']['id']);
			array_push($admin_names, $admin['Admin']['first_name'] . ' ' . $admin['Admin']['last_name']);
        }
		unset($admin);
		$submitter_full_names = (count($admin_names) < 1 ? array() : array_combine($admin_ids, $admin_names));
		
		foreach ($smart_forms as $smart_form) {
    		array_push($smart_form_ids, $smart_form['SmartForm']['id']);
			array_push($smart_form_names, $smart_form['SmartForm']['name'] . ' (' . $smart_form['SmartForm']['sf_domain'] . ')');
		}
		unset($smart_form);
		$smart_forms_dropdown_text = (count($smart_form_names) < 1 ? array() : array_combine($smart_form_ids, $smart_form_names));
		
		$html_container = 
                    "<div class='form-group' id='smart_form_holder'>
                        <label class='col-sm-4 control-label'>Smart Form:</label>
                        <div class='col-sm-5' id='smart_form_name'>".
                		$this->Form->input(
                			'SmartFormProject.smart_form_id',
                			array(
                				'label' => false,
                				'empty' => '',
                				'class' => 'form-control',
                				'options' => array(
                					$smart_forms_dropdown_text, 'Other' => 'Other'
                				),
                				'onchange' => 'otherEntry(this);'
                			)
                		)
                        ."</div>
                    </div>
                    <div class='form-group' id='submitter_name_holder'>
                        <label class='col-sm-4 control-label'>Request Submitted By:</label>
                        <div class='col-sm-5' id='submitter_name'>".
                		$this->Form->input(
                			'SmartFormProject.submitter',
                			array(
                				'label' => false,
                				'empty' => '',
                				'class' => 'form-control',
                				'options' => array(
                					$submitter_full_names, 'Other' => 'Other'
                				),
                				'onchange' => 'otherEntry(this);'
                			)
                		)
                        ."</div>
                    </div>";
        
        echo $html_container;
	}