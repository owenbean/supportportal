<h2 class="title">IRBNet Support Portal</h2>
<p>&nbsp;</p>
<section>
	<h3><?php echo 'Welcome ' . $this->Session->read('Auth.User.first_name') . '!<br />'; ?></h3>
	<p>&nbsp;</p>
	<?php if ($members) { ?>
	<aside>
	<h3>My Member Institutions:</h3>
	<?php
		foreach ($members as $member): 
			echo '<p>' . $this->Html->link($member['Member']['full_name'], array('controller' => 'members', 'action' => 'view', $member['Member']['id'])) . '</p>';
		endforeach;
		unset($member);
		} ?>
	</aside>
	<?php if($user['Committee']): ?>
	<aside class="collapse">	
	<h3>My Enrolling Committees:</h3>
	<?php for($i = 0; $i < count($enrolling_committees); $i++): ?>
		<p><?php echo $this->Html->link($enrolling_committees[$i][0]['Member']['full_name'] . ': ' . $user['Committee'][$i]['board_type'] . ' - Go Live Date: ' . $user['Committee'][$i]['go_live_date'], array('controller' => 'members', 'action' => 'view', $user['Committee'][$i]['member_id'])); ?></p>
	<?php
		endfor;
		endif;
	?>
	</aside>
	<?php if($smartForms): ?>
	<aside class="collapse">
	<h3>My Smart Forms:</h3>
	<?php foreach($smartForms as $smartForm): ?>
		<p><?php echo $this->Html->link($smartForm['SmartForm']['sf_domain'] . ', ' . $smartForm['Member']['full_name'] . ': Launch Date: ' . $smartForm['SmartForm']['launch_date'], array('controller' => 'members', 'action' => 'view', $smartForm['Member']['id'])); ?></p>
	<?php
		endforeach;
		unset($smartForm);
		endif;
	?>
	</aside>
</section>