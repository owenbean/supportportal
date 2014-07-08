<h1 id="header_text">IRBNet Support Portal</h1>
<p>&nbsp;</p>
<section>
	<h2><?php echo 'Welcome ' . $this->Session->read('Auth.User.first_name') . '!<br />'; ?></h2>
	<p>&nbsp;</p>
	<p><?php echo $this->Form->Postlink('View our new FAQ section here.', 'http://www.irbnetresources.org/tresources/admin-training.php', array('target' => '_blank')); ?> (username / password = irbnet / demo1)</p>
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
	<?php if($user['Committee']): ?>
	<aside id="my_org_section">	
	<h2>My Enrolling Committees:</h2>
	<?php for($i = 0; $i < count($enrolling_committees); $i++): ?>
		<p><?php echo $this->Html->link($enrolling_committees[$i][0]['Member']['full_name'] . ': ' . $user['Committee'][$i]['board_type'] . ' - Go Live Date: ' . $user['Committee'][$i]['go_live_date'], array('controller' => 'members', 'action' => 'view', $user['Committee'][$i]['member_id'])); ?></p>
	<?php
		endfor;
		endif;
	?>
	</aside>
	<?php if($smartForms): ?>
	<aside id="my_org_section">
	<h2>My Smart Forms:</h2>
	<?php foreach($smartForms as $smartForm): ?>
		<p><?php echo $this->Html->link($smartForm['SmartForm']['sf_domain'] . ', ' . $smartForm['Member']['full_name'] . ': Launch Date: ' . $smartForm['SmartForm']['launch_date'], array('controller' => 'members', 'action' => 'view', $smartForm['Member']['id'])); ?></p>
	<?php
		endforeach;
		unset($smartForm);
		endif;
	?>
	</aside>
</section>