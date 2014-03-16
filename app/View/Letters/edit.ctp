<h1>Edit Letter Request</h1>

<p>&nbsp;</p>

<div id="form_table">

<?php echo $this->Form->create('Letter'); ?>
	<fieldset>
		<legend><?php echo __('Edit Request'); ?></legend>
		<table>
		<tbody>
			<tr><td>
				<?php echo $this->Form->input('member_placeHolder', array('label' => 'Member Name: ', 'default' => $letter['Member']['full_name'], 'disabled' => 'disabled')); ?>
			</td></tr>
			
			<tr><td>
				<?php echo $this->Form->input('submitter_placeHolder', array('label' => 'Request Submitted By: ', 'default' => (is_numeric($letter['Letter']['submitter']) ? ($letter['Admin']['first_name'] . ' ' . $letter['Admin']['last_name']) : h($letter['Letter']['submitter'])), 'disabled' => 'disabled')); ?>
			</td></tr>
			
			<tr><td>
				<?php echo $this->Form->input('new_templates', array('label' => 'Number of New Templates: ')); ?>
			</td></tr>
			
			<tr><td>
				<?php echo $this->Form->input('revised_templates', array('label' => 'Number of Revised Templates: ')); ?>
			</td></tr>
			
			<tr><td>
				<?php echo $this->Form->input('enrollment', array('type' => 'checkbox', 'label' => 'Request part of enrollment? ', 'format' => array('before', 'label', 'between', 'input', 'after', 'error'))); ?>
			</td></tr>
			
			<tr><td>
				<?php echo $this->Form->input('date_received', array('label' => 'Date of Request: ', 'class' => 'date_picker')); ?>
			</td></tr>
			
			<tr><td>
				<?php echo $this->Form->input('target_date', array('label' => 'Target Date: ', 'class' => 'date_picker')); ?>
			</td></tr>
			
			<tr><td>
				<?php echo $this->Form->input('comments', array('label' => 'Request Comments: ', 'rows' => '5', 'cols' => '50', 'id' => 'comments_field')); ?>
			</td></tr>			
		</tbody>
		</table>
		<?php echo $this->Form->input('id', array('type' => 'hidden'));	?>
	<p><?php echo $this->Form->end('Update Request'); ?></p>
	</fieldset>
</div>