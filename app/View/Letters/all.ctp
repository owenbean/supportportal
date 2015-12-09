<h2 class="title">National Research Network Members</h2>
<h4 class="sub-title">Stamping Tools</h4>


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
			<?php if ($letters == null) { ?>
			<tr><td colspan="3">No members to display</td></tr>
			<?php } else {
				foreach ($letters as $letter): ?>
			<tr class="list-item">
				<td><?php echo $this->Html->link($letter['Member']['full_name'], array('action' => 'view', $letter['Member']['id'])); ?></td>
				<td><?php echo $letter['Member']['short_name']; ?></td>
				<td><?php echo $letter['Member']['op_num']; ?></td>
			</tr>
			<?php endforeach; ?>
			<?php unset($letter); 
			} ?>
		</tbody>
	</table>
</div>
