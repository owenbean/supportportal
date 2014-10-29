<h1>Add FAQ Question</h1>

<p>&nbsp;</p>

<div id="form_table">
	
<?php echo $this->Form->create('FaqQuestion', array('onsubmit' => 'return confirm("Are you sure you want to add this question?")')); ?>
	<fieldset>
		<legend>Add FAQ Question</legend>
		<table>
		<tbody>
			<tr><td>
				<?php	echo $this->Form->input('faq_section_id', array('label' => 'Section: ', 'empty' => '')); ?>
			</tr></td>
			<tr><td>
				<?php echo $this->Form->input('reference_name', array('label' => 'Reference Name: ' . $this->Html->image('question-mini.png', array('id' => 'faq_reference_help_link', 'data-tooltip' => '#faq_reference_help_box', 'height' => '14', 'width' => '13')) . ' ', 'size' => '30')); ?>
			</td></tr>
			<tr><td>
				<?php echo $this->Form->input('question', array('label' => 'Question: ', 'type' => 'text', 'size' => '100', 'style' => 'display:block')); ?>
			</td></tr>
			<tr><td>
				<?php echo $this->Form->input('answer', array('label' => 'Answer: <span id="faq_formatting_help_link" data-tooltip="#faq_formatting_help_box">[formatting help]</span> ', 'style' => 'display:block', 'rows' => '8', 'cols' => '72')); ?>
			</td></tr>	
		</tbody>
		</table>
		<p><?php echo $this->Form->end('Add Question', array('confirm' => 'Are you sure?')); ?></p>
	</fieldset>
</div>

<p>&nbsp;</p>

<h2>Preview:</h2>

<div id="faq_section">
<div id="faq_content">
<div id="faq_main_body">

<h3 id="faq_question_preview"></h3>
<?php echo $this->Markdown->transform("<div id='faq_answer_preview' class='faq_answer'></div>"); ?>

</div>
</div>
</div>

<p>&nbsp;</p>
<p>&nbsp;</p>

<div id="faq_reference_help_box">
	<p>The "Reference Name" will appear in the question's URL.<br />Please use only numbers and lowercase letters. Words <br />should be separated with underscores.</p>
</div>

<div id="faq_formatting_help_box">
	<p>Basic Markdown Formatting:</p>
	<p>Italics: *italic words*</p>
	<p>Bold: **bold words**</p>
	<p>Indent: >indented words</p>
	<p>Bulleted List Item: * bulleted list words</p>
	<p>Numbered List Item: 1. numbered list words</p>
	<p>Link: [link text](link url)</p>
</div>
