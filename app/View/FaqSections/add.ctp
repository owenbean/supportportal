<h1>Add FAQ Section</h1>

<p>&nbsp;</p>

<div id="form_table">
	
<?php echo $this->Form->create('FaqSection'); ?>
	<fieldset>
		<legend>Add FAQ Section</legend>
		<table>
		<tbody>
			<tr><td>
				<?php echo $this->Form->input('name', array('label' => 'Section Name: ')); ?>
			</td></tr>	
		</tbody>
		</table>
		<p><?php echo $this->Form->end('Add Section'); ?></p>
	</fieldset>
</div>

<p>&nbsp;</p>
<p>&nbsp;</p>
