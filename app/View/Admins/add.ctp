<h1>New Administrator</h1>
<p>&nbsp;</p>
<div id="new_admin_table">

<?php echo $this->Form->create('Admin'); ?>
	<fieldset>
		<legend><?php echo __('Add Admin'); ?></legend>
		<?php
			echo $this->Element('admin_form');
		?>
	</fieldset>
<?php echo $this->Form->end('Add Administrator'); ?>

</div>