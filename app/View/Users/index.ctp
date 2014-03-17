<h1 id="header_text">IRBNet Support Admin Portal</h1>
<p>&nbsp;</p>
<section>
	<h2><?php echo 'Welcome ' . $this->Session->read('Auth.User.first_name') . '!<br />'; ?></h2>
	<p>&nbsp;</p>
	<?php if ($members) { ?>
	<aside id="my_org_section">
	<?php
		foreach ($members as $member): 
			echo '<p>' . $this->Html->link($member['Member']['full_name'], array('controller' => 'members', 'action' => 'view', $member['Member']['id'])) . '</p>';
		endforeach;
		unset($user);
		} ?>
	</aside>
</section>