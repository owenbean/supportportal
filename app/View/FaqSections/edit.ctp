<h1>Edit FAQ Section</h1>

<p>&nbsp;</p>

<div id="form_table">
	
<?php echo $this->Form->create('FaqSection'); ?>
	<fieldset>
		<legend>Update FAQ Section</legend>
		<table>
		<tbody>
			<tr><td>
				<?php echo $this->Form->input('name', array('label' => 'Section Name: ', 'style' => 'display:block', 'type' => 'text', 'size' => '50')); ?>
			</td></tr>	
		</tbody>
		</table>
		<p><?php echo $this->Form->end('Update Section'); ?></p>
	</fieldset>
</div>

<p>&nbsp;</p>
<p>&nbsp;</p>
