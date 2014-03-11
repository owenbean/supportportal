<div id="nav_left_side">
	<div class="nav_text"><?php echo $this->Html->link('Home', array('controller' => 'users', 'action' => 'index')); ?></div>
	<div class="nav_division"><?php echo $this->Html->image('nav-div.gif') ?></div>
	<div class="nav_text"><a href="#">Letters</a>
		<ul class="sub_nav_menu">
			<li><?php echo $this->Html->link('Active', array('controller' => 'letters', 'action' => 'active')); ?></li>
			<li><?php echo $this->Html->link('New', array('controller' => 'letters', 'action' => 'add')); ?></li>
			<li><a href="letter_request_history.php">History</a></li>
		</ul>
	</div>
	<div class="nav_division"><?php echo $this->Html->image('nav-div.gif') ?></div>
	<div class="nav_text"><a href="#">Members</a>
		<ul class="sub_nav_menu">
			<li id="orgSearchLink"><a href="#">Search</li>
			<li><?php echo $this->Html->link('Full List', array('controller' => 'members', 'action' => 'all')); ?></li>
			<li><?php echo $this->Html->link('Add New', array('controller' => 'members', 'action' => 'add')); ?></li>
		</ul>
	</div>
	<div class="nav_division"><?php echo $this->Html->image('nav-div.gif') ?></div>
	<div class="nav_text"><a href="#">Administrators</a>
		<ul class="sub_nav_menu">
			<li id="adminSearchLink"><a href="#">Search</a></li>
			<li><?php echo $this->Html->link('Full List', array('controller' => 'admins', 'action' => 'all')); ?></li>
			<li><?php echo $this->Html->link('Add New', array('controller' => 'admins', 'action' => 'add')); ?></li>
		</ul>
	</div>
	<div class="nav_division"><?php echo $this->Html->image('nav-div.gif') ?></div>
	<div class="nav_text"><a href="#">Lists</a>
		<ul class="sub_nav_menu">
			<li><?php echo $this->Html->link('CITI Integration', array('controller' => 'members', 'action' => 'all', 'citi_integration')); ?></li>
			<li><?php echo $this->Html->link('WIRB Integration', array('controller' => 'members', 'action' => 'all', 'wirb_integration')); ?></li>
			<li><?php echo $this->Html->link('Single Sign-On', array('controller' => 'members', 'action' => 'all', 'sso')); ?></li>
			<li><?php echo $this->Html->link('File Access', array('controller' => 'members', 'action' => 'all', 'file_access')); ?></li>
			<li><?php echo $this->Html->link('Smart Forms', array('controller' => 'smartForms', 'action' => 'index')); ?></li>
		</ul>
	</div>
	<?php
		if ($this->Session->read('Auth.User.role') == 'site_admin') {
			echo "<div class='nav_division'>" . $this->Html->image('nav-div.gif') . "</div>
				<div class='nav_text'><a href='#'>Site Admin</a>
					<ul class='sub_nav_menu'>
						<li>" . $this->Html->link('System Admin List', array('controller' => 'users', 'action' => 'all')) . "</li>
						<li><a href='color_scheme.php'>Color Scheme</a></li>
					</ul>
				</div>";
		}
	?>
</div>
<div id="nav_right_side">
	<div class="nav_text" id="nav_username_text"><a href="#"><?php echo $this->Session->read('Auth.User.first_name'); ?></a></div>
	<ul class="sub_nav_menu" id="right_sub_nav_menu">
		<li><?php echo $this->Html->link('Profile', array('controller' => 'users', 'action' => 'view', $this->Session->read('Auth.User.id'))); ?></li>
		<li><?php echo $this->Html->link('Logout', array('controller' => 'users', 'action' => 'logout')); ?></li>
	</ul>
</div>


<div id="orgSearchBox" class="searchBox" title="Search for an Organization">
		<p>Enter short or full name:<p>
		<form method="post" action="organization_list.php?search=org">
				<input type="text" id="searchOrgName" name="searchOrgName" size="30">
				<p id="advancedOrgSearch"><a href="organization_search.php" onclick="return notYet()">Advanced Search</a></p>
		</form>
</div>

<div id="adminSearchBox" class="searchBox" title="Search for an Organization">
	<p>Enter first or last name:<p>
	<form method="post" action="admin_list.php?search=admin">
		<input type="text" id="searchAdminName" name="searchAdminName" size="30">
		<p id="advancedAdminSearch"><a href="admin_search.php" onclick="return notYet()">Advanced Search</a></p>
	</form>
</div>
