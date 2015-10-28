<h2 class="title">IRBNet Support Portal</h2>
<p>&nbsp;</p>
<section>
	<h3><?php echo 'Welcome ' . $this->Session->read('Auth.User.first_name') . '!<br />'; ?></h3>
	<p>&nbsp;</p>
	<?php	
		/****************************************************************************
		 * 2015-10-28 OB: Commenting out My Member Institutions section (in V and C).
		 * "Go-Live" tracking is no longer implemented in Support Portal, and the 
		 * "My Member Institutions" list just gets longer and longer. I'm removing
		 * it for the new release.
		 **************************************************************************** 
			if ($members) { ?>
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
			</aside>
		
		***************************************************************************
		*/
	?>

	<?php 
	// Populate list of active letter requests that user is working on.
	if($letters): ?>
		<h3>My Active Letter Requests:</h3>
		<ul>
			<?php foreach($letters as $letter): ?>
				<li><?php echo $this->Html->link($letter['Member']['full_name'] . ' (New: ' . $letter['Letter']['new_templates'] . ', Revised: ' . $letter['Letter']['revised_templates'] . '), Target Date: ' . $letter['Letter']['target_date'], array('controller' => 'Letters', 'action' => 'view', $letter['Letter']['id'])); ?></li>
			<?php
				endforeach;
				unset($letter);
			?>
		</ul>
		<p><?php echo $this->Html->link("**(See All Letters in Queue)**",array('controller' => 'Letters', 'action' => 'active')); ?></p>
	<?php
		endif;
	?>
	<?php
	// Populate list of active smart form projects that user is working on.
	if($smartFormProjects): ?>
		<h3>My Active Smart Form Projects:</h3>
		<ul>
			<?php foreach($smartFormProjects as $smartFormProject): ?>
				<li><?php echo $this->Html->link($smartFormProject['Member']['full_name'] . ' - ' . $smartFormProject['SmartForm']['name'], array('controller' => 'SmartFormProjects', 'action' => 'view', $smartFormProject['SmartFormProject']['id'])); ?></li>
			<?php
				endforeach;
				unset($smartFormProject);
			?>
		</ul>
		<p><?php echo $this->Html->link("**(See All Projects in Queue)**",array('controller' => 'SmartFormProjects', 'action' => 'active')); ?></p>
	<?php
		endif;
	?>
</section>