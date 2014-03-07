<h1>New Administrator</h1>
<p>&nbsp;</p>
<div id="new_admin_table">
	<?php echo $this->Element('admin_form'); ?>
</div>

<p><?php print_r($members); ?></p>
<p><?php $new_members = array_flip($members); ?>
<p><?php echo implode(array_flip($members)); ?></p>