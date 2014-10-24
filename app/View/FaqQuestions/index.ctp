<h1 id="header_text">Frequently Asked Questions Sections</h1>
<div>
	<table>
		<tr>
			<th>Question</th>
			<th>Answer</th>
			<th>Section</th>
			<th>Actions</th>
		</tr>
		
		<?php if ($faqQuestions == null) { ?>
		<tr><td colspan="4">No questions to display</td></tr>
		<?php } else {
			foreach ($faqQuestions as $faqQuestion): ?>
		<tr>
			<td><?php echo $faqQuestion['FaqQuestion']['question'] ?></td>
			<td><?php echo $faqQuestion['FaqQuestion']['answer'] ?></td>
			<td><?php echo $faqQuestion['FaqSection']['name'] ?></td>
			<td><?php echo $this->Html->link('Edit', array('action' => 'edit', $faqQuestion['FaqQuestion']['id'])); ?> <?php echo $this->Form->postLink('Delete', array('action' => 'delete', $faqQuestion['FaqQuestion']['id'])); ?></td>
		</tr>
		<?php endforeach; ?>
		<?php unset($faqQuestion); 
		} ?>
	</table>
</div>
<p>&nbsp;</p>
<p><?php echo $this->Html->link('Add New', array('action' => 'add')); ?></p>