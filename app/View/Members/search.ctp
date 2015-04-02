<h2 class="title">National Research Network Members</h2>
<h4 class="sub-title">Search</h4>

<p>&nbsp;</p>

<div class="col-sm-8 col-sm-offset-2">
	<table class="table table-condensed table-bordered table-hover">
		<thead>
			<tr>
				<th>Member Name</th>
				<th>Short Name</th>
				<th>ID</th>
			</tr>
		</thead>
		
		<tbody>
			<?php if ($members == null): ?>
			<tr>
				<td colspan="3">No members to display</td>
			</tr>
			<?php else:
				foreach ($members as $member): ?>
			<tr class="list-item">
				<td><?php echo $this->Html->link($member['Member']['full_name'], array('action' => 'view', $member['Member']['id'])); ?></td>
				<td><?php echo $member['Member']['short_name']; ?></td>
				<td><?php echo $member['Member']['op_num']; ?></td>
			</tr>
			<?php
				endforeach;
				unset($member); 
				endif; 
			?>
		</tbody>
	</table>
</div>
