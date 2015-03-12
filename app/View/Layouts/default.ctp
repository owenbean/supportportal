<?php
$cakeDescription = __d('cake_dev', 'IRBNet Support Portal');
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('favicon.ico', '/favicon.ico', array('type' => 'icon'));

		echo $this->Html->css(array('irbnet-crm', 'bootstrap', 'jquery-ui.min'));
		echo $this->Html->script(array('jquery', 'jquery-ui-1.10.4.custom.min.js', "Markdown_Converter.js", 'irbnet_admin'));

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
		
		echo $this->Js->writeBuffer();
	?>
</head>
<body>
	<div class="container navbar navbar-default">
		<div class="navbar-brand">
			<?php echo $this->Html->image('irbnet.gif', array('alt' => 'IRBNet', 'url' => array('controller' => 'users', 'action' => 'login'))); ?>
		</div>
	
	<?php
		if ($this->Session->read('Auth.User.first_name')) {
			echo $this->Element('nav');
		}
	?>
	</div>

	<div class="container">
		<?php echo $this->Session->flash(); ?>
		<?php echo $this->fetch('content'); ?>
		<p>&nbsp;</p>
		<div class="footer">
			<p>Copyright &copy; 2002-2015 Research Dataware, LLC.&nbsp;&nbsp;&nbsp;All Rights Reserved.</p>
		</div>
	</div>
</body>
</html>
