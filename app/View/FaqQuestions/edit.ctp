<h1>Update FAQ Question</h1>

<p>&nbsp;</p>

<div id="form_table">
	
<?php echo $this->Form->create('FaqQuestion'); ?>
	<fieldset>
		<legend>Update FAQ Question</legend>
		<table>
		<tbody>
			<tr><td>
				<?php	echo $this->Form->input('faq_section_id', array('label' => 'Section: ')); ?>
			</tr></td>
			<tr><td>
				<?php echo $this->Form->input('question', array('label' => 'Question: ')); ?>
			</td></tr>	
			<tr><td>
				<?php echo $this->Form->input('answer', array('label' => 'Answer: ')); ?>
			</td></tr>	
		</tbody>
		</table>
		<p><?php echo $this->Form->end('Update Question'); ?></p>
	</fieldset>
</div>

<p>&nbsp;</p>
<p>&nbsp;</p>
