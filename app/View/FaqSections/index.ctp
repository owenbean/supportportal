<h1 id="header_text">Frequently Asked Questions</h1>
<p>&nbsp;</p>
<div id="faq_section">
	<div id="faq_content">
 		<h1>General IRBNet FAQs</h1>
  	<p>&nbsp;</p>
<?php if ($faqSections == null) { ?>
		</p>No sections to display</p>
<?php } else { ?>
	<?php foreach ($faqSections as $faqSection): ?>
		<h2><?php echo $faqSection['FaqSection']['name']; ?> <?php echo $this->Html->link('edit', array('action' => 'edit', $faqSection['FaqSection']['id']), array('class' => 'faq_action_link')); ?></h2>
			<ul>
		<?php if ($faqSection['FaqQuestion']) { ?>
			<?php for($i = 0; $i < count($faqSection['FaqQuestion']); $i++){ ?>
				<li><a <?php echo "href='#" . $faqSection['FaqQuestion'][$i]['reference_name'] . "'"; ?>><?php echo $faqSection['FaqQuestion'][$i]['question']; ?></a></li>
			<?php } ?>
		<?php } else { ?>
				<li><?php echo $this->Html->link('No Questions', array('controller' => 'faqQuestions', 'action' => 'add')); ?></li>
		<?php } ?>
			</ul>
	<?php endforeach; ?>
	<?php unset($faqSection); ?>
<?php } ?>

		<p>&nbsp;</p>
		<p><?php echo $this->Html->link('Add New Section', array('action' => 'add')); ?> | <?php echo $this->Html->link('Add New Question', array('controller' => 'faqQuestions', 'action' => 'add')); ?></p>

		<div id="faq_main_body">

<?php if ($faqSections != null) { ?>
	<?php foreach ($faqSections as $faqSection): ?>
		<?php if ($faqSection['FaqQuestion']) { ?>
			<h2 class="faq_section_header"><?php echo $faqSection['FaqSection']['name']; ?><a class="faq_top_link" href="#">top</a></h2>
			<?php for($i = 0; $i < count($faqSection['FaqQuestion']); $i++){ ?>
			<h3><a <?php echo "name='" . $faqSection['FaqQuestion'][$i]['reference_name'] . "'"; ?>></a><?php echo $faqSection['FaqQuestion'][$i]['question']; ?> <?php echo $this->Html->link('edit', array('controller' => 'faqQuestions', 'action' => 'edit', $faqSection['FaqQuestion'][$i]['id']), array('class' => 'faq_action_link')); ?><span class="faq_action_link"> | </span><?php echo $this->Form->postLink('delete', array('controller' => 'faqQuestions', 'action' => 'delete', $faqSection['FaqQuestion'][$i]['id']), array('class' => 'faq_action_link', 'confirm' => 'Are you sure you want to delete this question?')); ?></h3>
			<div class="faq_answer"><?php echo $this->Markdown->transform($faqSection['FaqQuestion'][$i]['answer']); ?></div>
			<?php } ?>
		<?php } ?>
	<?php endforeach; ?>
	<?php unset($faqSection); ?>
<?php } ?>


</div>
</div>
</div>
<p>&nbsp;</p>
<p>&nbsp;</p>
