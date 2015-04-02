<h2 class="title">National Research Network Members</h2>
<h4 class="sub-title">
	<?php
		if($filter_added) {
			switch($filter) {
				case 'citi_integration':
					echo 'CITI Integration';
					break;
				case 'sso':
					echo 'Single Sign-On';
					break;
				case 'wirb_integration':
					echo 'WIRB Integration';
					break;
				case 'file_access':
					echo 'File Access';
					break;
				default:
					echo 'All Members';
			}
		} else {
			echo 'All Members';
		}
	?>
</h4>

<p>&nbsp;</p>

<div class="col-sm-8 col-sm-offset-2">
	<table class="table table-condensed table-bordered table-hover">
		<thead>
			<tr>
			<?php if($filter_added) { ?>
				<th>Member Name</th>
				<th>Short Name</th>
				<th>ID</th>
			<? } else { ?>
				<th><?php echo $this->Html->link('Member Name', array('action' => 'all', '?' => array('order' => 'full_name'))); ?></th>
				<th><?php echo $this->Html->link('Short Name', array('action' => 'all', '?' => array('order' => 'short_name'))); ?></th>
				<th><?php echo $this->Html->link('ID', array('action' => 'all', '?' => array('order' => 'op_num'))) ?></th>
			<? } ?>
			</tr>
		</thead>
		
		<tbody>
			<?php if ($members == null) { ?>
			<tr><td colspan="3">No members to display</td></tr>
			<?php } else {
				foreach ($members as $member): ?>
			<tr class="list-item">
				<td><?php echo $this->Html->link($member['Member']['full_name'], array('action' => 'view', $member['Member']['id'])); ?></td>
				<td><?php echo $member['Member']['short_name']; ?></td>
				<td><?php echo $member['Member']['op_num']; ?></td>
			</tr>
			<?php endforeach; ?>
			<?php unset($member); 
			} ?>
		</tbody>
	</table>
</div>
