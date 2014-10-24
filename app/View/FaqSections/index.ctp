<h1 id="header_text">Frequently Asked Questions</h1>
<div id="faq_content">
	<p>&nbsp;</p>
<?php if ($faqSections == null) { ?>
	</p>No sections to display</p>
<?php } else { ?>
	<?php foreach ($faqSections as $faqSection): ?>
	<h2><?php echo $faqSection['FaqSection']['name']; ?></h2>
		<ul>
		<?php if ($faqSection['FaqQuestion']) { ?>
			<?php for($i = 0; $i < count($faqSection['FaqQuestion']); $i++){ ?>
			<li><a <?php echo "href='#question" . $faqSection['FaqQuestion'][$i]['id'] . "'"; ?>><?php echo $faqSection['FaqQuestion'][$i]['question']; ?></a></li>
			<?php } ?>
		<?php } else { ?>
			<li>No Questions</li>
		<?php } ?>
		</ul>
	<?php endforeach; ?>
	<?php unset($faqSection); ?>
<?php } ?>

	<p>&nbsp;</p>
	<p><?php echo $this->Html->link('Add New Section', array('action' => 'add')); ?></p>
	<p><?php echo ""; //$this->Html->link('Edit', array('action' => 'edit', $faqSection['FaqSection']['id'])); ?> <?php echo ""; //$this->Form->postLink('Delete', array('action' => 'delete', $faqSection['FaqSection']['id'])); ?></p>



<?php if ($faqSections != null) { ?>
	<?php foreach ($faqSections as $faqSection): ?>
		<?php if ($faqSection['FaqQuestion']) { ?>
	<h2 class="faq_section_header"><?php echo $faqSection['FaqSection']['name']; ?><a class="faq_top_link" href="#">top</a></h2>
			<?php for($i = 0; $i < count($faqSection['FaqQuestion']); $i++){ ?>
	<h3><a <?php echo "name='question" . $faqSection['FaqQuestion'][$i]['id'] . "'"; ?>></a><?php echo $faqSection['FaqQuestion'][$i]['question']; ?></h3>
	<p><?php echo $faqSection['FaqQuestion'][$i]['answer']; ?></p>
			<?php } ?>
		<?php } ?>
	<?php endforeach; ?>
	<?php unset($faqSection); ?>
<?php } ?>



</div>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
