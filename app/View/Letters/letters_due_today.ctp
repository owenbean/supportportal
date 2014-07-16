<table>
<tbody>
<th>Member</th>
<th>Target Date</th>

<? foreach($letters as $letter): ?>
<tr>
	<td><?php echo $letter['Member']['full_name']; ?></td>
	<td><?php echo $letter['Letter']['target_date']; ?></td>
</tr>
<?php
	endforeach;
	unset($letter);
?>
</tbody>
</table>