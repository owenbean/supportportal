<h1>Update FAQ Question</h1>

<p>&nbsp;</p>

<div id="form_table">
	
<?php echo $this->Form->create('FaqQuestion'); ?>
	<fieldset>
		<legend>Update FAQ Question</legend>
		<table>
		<tbody>
			<tr><td>
				<?php	echo $this->Form->input('faq_section_id', array('label' => 'Section: ', 'empty' => '')); ?>
			</tr></td>
			<tr><td>
				<?php echo $this->Form->input('reference_name', array('label' => 'Reference Name: ', 'size' => '30')); ?>
			</td></tr>	
			<tr><td>
				<?php echo $this->Form->input('question', array('label' => 'Question: ', 'type' => 'text', 'size' => '100', 'style' => 'display:block')); ?>
			</td></tr>
			<tr><td>
				<?php echo $this->Form->input('answer', array('label' => 'Answer: ', 'style' => 'display:block', 'rows' => '8', 'cols' => '72')); ?>
			</td></tr>	
		</tbody>
		</table>
		<p><?php echo $this->Form->end('Update Question'); ?></p>
	</fieldset>
</div>

<p>&nbsp;</p>
<p>&nbsp;</p>
