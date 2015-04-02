<h2 class="title">National Research Network Smart Forms</h2>
<h4 class='sub-title'>All Smart Forms</h4>

<p>&nbsp;</p>

<div class="col-sm-8 col-sm-offset-2">
	<table class="table table-condensed table-bordered table-hover">
		<thead>
			<tr>
				<th>Type</th>
				<th>Member Name</th>
				<th>Developer</th>
				<th>Status</th>
			</tr>
		</thead>

		<tbody>
			<?php if ($smartForms == null) { ?>
			<tr><td colspan="3">No smart forms to display</td></tr>
			<?php } else {
				foreach ($smartForms as $smartForms): ?>
			<tr class="list-item">
				<td><?php echo $this->Html->link($smartForms['SmartForm']['sf_domain'], array('controller' => 'members', 'action' => 'view', $smartForms['Member']['id'])); ?></td>
				<td><?php echo $smartForms['Member']['full_name']; ?></td>
				<td><?php echo $smartForms['User']['first_name']; ?></td>
				<td><?php echo $smartForms['SmartForm']['status']; ?></td>
			</tr>
			<?php endforeach; ?>
			<?php unset($smartForms); 
			} ?>
		</tbody>
	</table>
</div>
<p>&nbsp;</p>
