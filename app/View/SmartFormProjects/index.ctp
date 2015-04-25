<h2 class="title">National Research Network Smart Forms</h2>
<h4 class='sub-title'>All Smart Form Projects</h4>

<p>&nbsp;</p>

<div class="col-sm-8 col-sm-offset-2">
	<table class="table table-condensed table-bordered table-hover">
		<thead>
			<tr>
				<th>Member</th>
				<th>Smart Form</th>
				<th>Type</th>
				<th>Status</th>
			</tr>
		</thead>

		<tbody>
			<?php if ($smartFormProjects == null) { ?>
			<tr><td colspan="3">No smart forms projects to display</td></tr>
			<?php } else {
				foreach ($smartFormProjects as $smartFormProject): ?>
			<tr class="list-item">
				<td><?php echo $this->Html->link($smartFormProject['Member']['full_name'], array('controller' => 'members', 'action' => 'view', $smartFormProject['Member']['id'])); ?></td>
				<td><?php echo $smartForms['SmartForm']['name']; ?></td>
				<td><?php echo $smartForms['SmartForm']['sf_domain']; ?></td>
				<td><?php echo $smartForms['SmartFormProject']['status']; ?></td>
			</tr>
			<?php endforeach; ?>
			<?php unset($smartForms); 
			} ?>
		</tbody>
	</table>
</div>
<p>&nbsp;</p>

