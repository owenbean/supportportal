<h1 id="header_text">IRBNet Support Portal</h1>
<p>&nbsp;</p>
<section>
	<h2><?php echo 'Welcome ' . $this->Session->read('Auth.User.first_name') . '!<br />'; ?></h2>
	<p>&nbsp;</p>
	<?php if ($members) { ?>
	<aside id="my_org_section">
	<h2>My Member Institutions:</h2>
	<?php
		foreach ($members as $member): 
			echo '<p>' . $this->Html->link($member['Member']['full_name'], array('controller' => 'members', 'action' => 'view', $member['Member']['id'])) . '</p>';
		endforeach;
		unset($member);
		} ?>
	</aside>
	<?php if($committees): ?>
	<aside id="my_org_section">	
	<h2>My Enrolling Members:</h2>
	<?php foreach($committees as $committee): ?>
		<p><?php echo 'text...' ?></p>
	<?php
		endforeach;
		unset($committee);
		endif;
	?>
	</aside>
	<?php if($smartForms): ?>
	<aside id="my_org_section">
	<h2>My Smart Forms:</h2>
	<?php foreach($smartForms as $smartForm): ?>
		<p><?php echo $this->Html->link($smartForm['SmartForm']['sf_domain'] . ', ' . $smartForm['Member']['full_name'], array('controller' => 'members', 'action' => 'view', $smartForm['Member']['id'])) . ' - Launch Date: ' . $smartForm['SmartForm']['launch_date']; ?></p>
	<?php
		endforeach;
		unset($smartForm);
		endif;
	?>
	</aside>
</section>