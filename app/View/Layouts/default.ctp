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

		echo $this->Html->css(array('irbnet_admin'));
		echo $this->Html->css('http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css');
		echo $this->Html->script('jquery');
		echo $this->Html->script('http://code.jquery.com/ui/1.10.3/jquery-ui.js');
		echo $this->Html->script(array('irbnet_admin'));

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
		
		echo $this->Js->writeBuffer();
	?>
</head>
<body>
<div id="wrapper">
	<div id="folio">
		<div id="site_wrapper">
			<div id="top_strip">
				<div class="logo">
					<?php echo $this->Html->image('irbnet.gif', array('alt' => 'IRBNet', 'url' => array('controller' => 'users', 'action' => 'login'))); ?>
				</div>
				<div class="tagline">
					<h1>Innovative Solutions for <br />Compliance and Research Management </h1><br />
				</div>
			</div>
			
			<div id="navigation">
			<?php
				if ($this->Session->read('Auth.User.first_name')) {
					echo $this->Element('nav');
				}
			?>
			</div>
		
			<div id="main_content">
				<div id="left_col">
					<div class="left_content">
						<?php echo $this->Session->flash(); ?>
						<?php echo $this->fetch('content'); ?>
					</div>
				</div>
			</div>
			
			<div id="footer">
				<p>Copyright &copy; 2002-2014 Research Dataware, LLC.&nbsp;&nbsp;&nbsp;All Rights Reserved.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
			</div>
		</div>
	</div>
</div>
</body>
</html>
