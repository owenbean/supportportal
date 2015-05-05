<?php
$cakeDescription = __d('cake_dev', 'IRBNet Support Portal');
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<meta name="viewport" content="width=device-width, initial-scale=1" >
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('favicon.ico', '/favicon.ico', array('type' => 'icon'));

		echo $this->Html->css(array('jquery-ui.min', 'bootstrap', 'irbnet-crm'));
		echo $this->Html->script(array('jquery', 'jquery-ui-1.10.4.custom.min', 'Markdown_Converter', 'irbnet_admin', 'bootstrap'));

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
		
		echo $this->Js->writeBuffer();
	?>
</head>
<body>
	<div id="wrap">
		<div id="header">
			<div class="container navbar navbar-default">
				<div class="navbar-brand">
					<?php echo $this->Html->image('irbnet.gif', array('alt' => 'IRBNet', 'url' => array('controller' => 'users', 'action' => 'login'))); ?> <?php echo substr($_SERVER['PHP_SELF'], 0, 22) === '/supportportal_staging' ? "<span style='color:red'>STAGING</span>" : null; ?>
				</div>
			</div>
			
			<div class='bottom-buffer-10'>&nbsp;</div>

			<div class="container navbar navbar-default">
				<?php
					if ($this->Session->read('Auth.User.first_name')) {
						echo $this->Element('nav');
					}
				?>
			</div>
		</div>

		<div id="content">
			<div class="container bottom-buffer-40">
				<?php echo $this->Session->flash(); ?>
				<?php echo $this->fetch('content'); ?>
				<p>&nbsp;</p>

				<div id="orgSearchBox" class="searchBox" title="Search for an Organization">
					<p>Enter short or full name:<p>
					<form method="post" action="<?php echo Router::url(array('controller' => 'members', 'action' => 'search')); ?>">
							<input type="text" id="searchOrgName" name="searchOrgName" size="30">
					</form>
				</div>

				<div id="adminSearchBox" class="searchBox" title="Search for an Organization">
					<p>Enter first or last name:<p>
					<form method="post" action="<?php echo Router::url(array('controller' => 'admins', 'action' => 'search')); ?>">
						<input type="text" id="searchAdminName" name="searchAdminName" size="30">
					</form>
				</div>

			</div>
		</div>

		<div id="footer" class="container">
			<div>
				<p>Copyright &copy; 2002-2015 Research Dataware, LLC.&nbsp;&nbsp;&nbsp;All Rights Reserved.</p>
			</div>
		</div>
	</div>
</body>
</html>
