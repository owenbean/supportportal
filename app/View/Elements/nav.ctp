<div class="navbar-header">
  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
    <span class="sr-only">Toggle Navigation</span>
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
  </button>
</div>

<ul class="nav nav-tabs collapse navbar-collapse">
  <li role="presentation" <?php echo ($this->params['controller'] == 'users' && $this->action == 'index') ? "class='active'" : null ?>><?php echo $this->Html->link('Home', array('controller' => 'users', 'action' => 'index')); ?></li>

  <li role="presentation" <?php echo ($this->params['controller'] == 'letters') ? "class='active dropdown'" : "class='dropdown'" ?>>
    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">
      Wizards <span class="caret"></span>
    </a>
    <ul class="dropdown-menu" role="menu">
      <li role="presentation" class="dropdown-header">Letters</li>
			<li><?php echo $this->Html->link('Letter Queue', array('controller' => 'letters', 'action' => 'active')); ?></li>
      <li><?php echo $this->Html->link('New Letter Request', array('controller' => 'letters', 'action' => 'add')); ?></li>
      <li><?php echo $this->Html->link('Letter Request History', array('controller' => 'letters', 'action' => 'history')); ?></li>
      <li role="presentation" class="dropdown-header">Smart Forms</li>
      <li><?php echo $this->Html->link('Active Smart Form Projects', array('controller' => 'smartFormProjects', 'action' => 'active')); ?></li>
      <li><?php echo $this->Html->link('New Smart Form Project', array('controller' => 'smartFormProjects', 'action' => 'add')); ?></li>
      <li><?php echo $this->Html->link('Smart Form Project History', array('controller' => 'smartFormProjects', 'action' => 'history')); ?></li>
    </ul>
  </li>

  <?php
    //checks if view is displaying sub-lists of members or admins (or smart form) - used mainly to set Lists tab 'active'
    $make_active = false;
    $list_params = array('citi_integration', 'wirb_integration', 'sso', 'file_access', 'contract_lead', 'feature_announcement_list', 'support_outreach_list');
    $list_view = false;
    if (isset($this->params['pass'][0])) {
      for ($i = 0; $i < count($list_params); $i++) {
        if ($this->params['pass'][0] == $list_params[$i]) {
          $list_view = true;
        }
      }
    }

    $members_lists = $this->params['controller'] == 'members' && $list_view;
    $admins_lists = $this->params['controller'] == 'admins' && $list_view;
    if ($members_lists || $admins_lists || $this->params['controller'] == 'smartForms') {
      $make_active = true;
    }
  ?>

  <li role="presentation" <?php echo ($this->params['controller'] == 'members' && !$list_view) ? "class='active dropdown'" : "class='dropdown'" ?>>
    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">
      Members <span class="caret"></span>
    </a>
    <ul class="dropdown-menu" role="menu">
			<li id="orgSearchLink"><a href="#">Search</a></li>
			<li><?php echo $this->Html->link('Full List', array('controller' => 'members', 'action' => 'all')); ?></li>
			<li><?php echo $this->Html->link('Add New', array('controller' => 'members', 'action' => 'add')); ?></li>
    </ul>
  </li>

  <li role="presentation" <?php echo ($this->params['controller'] == 'admins' && !$list_view) ? "class='active dropdown'" : "class='dropdown'" ?>>
    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">
      Administrators <span class="caret"></span>
    </a>
    <ul class="dropdown-menu" role="menu">
			<li id="adminSearchLink"><a href="#">Search</a></li>
			<li><?php echo $this->Html->link('Full List', array('controller' => 'admins', 'action' => 'all')); ?></li>
			<li><?php echo $this->Html->link('Add New', array('controller' => 'admins', 'action' => 'add')); ?></li>
    </ul>
  </li>

  <li role="presentation" <?php echo ($make_active) ? "class='dropdown active'" : "class='dropdown'" ?>>
    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">
      Lists <span class="caret"></span>
    </a>
    <ul class="dropdown-menu" role="menu">
			<li><?php echo $this->Html->link('CITI Integration', array('controller' => 'members', 'action' => 'all', 'citi_integration')); ?></li>
			<li><?php echo $this->Html->link('WIRB Integration', array('controller' => 'members', 'action' => 'all', 'wirb_integration')); ?></li>
			<li><?php echo $this->Html->link('Single Sign-On', array('controller' => 'members', 'action' => 'all', 'sso')); ?></li>
			<li><?php echo $this->Html->link('File Access', array('controller' => 'members', 'action' => 'all', 'file_access')); ?></li>
			<li><?php echo $this->Html->link('Contract Leads', array('controller' => 'admins', 'action' => 'all', 'contract_lead')); ?></li>
			<li><?php echo $this->Html->link('Feature Announcements', array('controller' => 'admins', 'action' => 'all', 'feature_announcement_list')); ?></li>
			<li><?php echo $this->Html->link('Support Outreach', array('controller' => 'admins', 'action' => 'all', 'support_outreach_list')); ?></li>
			<li><?php echo $this->Html->link('Smart Forms', array('controller' => 'smartForms', 'action' => 'index')); ?></li>
    </ul>
  </li>

	<?php if ($this->Session->read('Auth.User.faq_editor') == 1) { ?>
  <li role="presentation" <?php echo ($this->params['controller'] == 'faqSections' || $this->params['controller'] == 'faqQuestions') ? "class='active'" : null ?>><?php echo $this->Html->link('FAQ', array('controller' => 'faqSections', 'action' => 'index')); ?></li>
	<?php } ?>
  
  <?php
    //sets below variables 'true' if user is viewing their own profile - this allows below nav-tab to be 'active'
    $viewing_profile = $this->params['controller'] == 'users' && $this->action == 'view';
    $viewing_this_user_profile = false;
    if (isset($user)) {
      $viewing_this_user_profile = $user['User']['id'] == $this->Session->read('Auth.User.id');
    }
  ?>

	<?php if ($this->Session->read('Auth.User.role') == 'site_admin') { ?>
  <li role="presentation" <?php echo ($this->params['controller'] == 'users' && !$viewing_this_user_profile) ? "class='active'" : null ?>><?php echo $this->Html->link('Site Admin', array('controller' => 'users', 'action' => 'all')); ?></li>
	<?php } ?>
  
  <li role="presentation" <?php echo ($viewing_profile && $viewing_this_user_profile) ? "class='active dropdown navbar-right'" : "class='dropdown navbar-right'" ?>>
    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">
      <?php echo $this->Session->read('Auth.User.first_name'); ?> <span class="caret"></span>
    </a>
    <ul class="dropdown-menu" role="menu">
		<li><?php echo $this->Form->postLink('Profile', array('controller' => 'users', 'action' => 'view', $this->Session->read('Auth.User.id'))); ?></li>
		<li><?php echo $this->Html->link('Logout', array('controller' => 'users', 'action' => 'logout')); ?></li>
    </ul>
  </li>
</ul>
