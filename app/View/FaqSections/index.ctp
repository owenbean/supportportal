<h1 id="header_text">Frequently Asked Questions Sections</h1>
<div>
	<table>
		<tr>
			<th>Section Name</th>
			<th>Number of Questions</th>
			<th>Actions</th>
		</tr>
		
		<?php if ($faqSections == null) { ?>
		<tr><td colspan="3">No sections to display</td></tr>
		<?php } else {
			foreach ($faqSections as $faqSection): ?>
		<tr>
			<td><?php echo $faqSection['FaqSection']['name'] ?></td>
			<td><?php echo "placeholder" ?></td>
			<td><?php echo $this->Html->link('Edit', array('action' => 'edit', $faqSection['FaqSection']['id'])); ?> <?php echo $this->Form->postLink('Delete', array('action' => 'delete', $faqSection['FaqSection']['id'])); ?></td>
		</tr>
		<?php endforeach; ?>
		<?php unset($faqSection); 
		} ?>
	</table>
</div>
<p>&nbsp;</p>
<p><?php echo $this->Html->link('Add New', array('action' => 'add')); ?></p>