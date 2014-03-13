<h1 id="header_text">IRBNet Letter Requests</h1>
<p>&nbsp;</p>
<div id="letters_search">
	<h2>Search for a Letter Request</h2>
	<div class="letter_history_table">
		<form method="get" action="letter_request_history.php" name="searchDetailsForm">
			<div id="letter_search_top_row">
				<div id="organization_select">
						<label>Organization:</label>
						<select id="org_name" name="org_name">
							<option value="all">All</option>
							<option value="all">Kansas City University of Medicine and Biosciences</option>
						</select>
				</div>
				<div id="owner_table">
					<label>Request Owner:</label>
					<input type="text" id="request_owner" name="request_owner" value="<?php echo (isset($_GET['request_owner']) ? $request_owner : "") ?>">
				</div>
			</div>
			<div id="letter_search_bottom_row">
				<div id="date_received">
					<h2>Date Received: <span>(blank date = no limit)</span></h2>
					<div class="from_date_field">
						<label>From:</label>
						<input type="text" id="received_from_date" name="received_from_date" class="date_picker" size="20" value="<?php echo (isset($_GET['received_from_date']) ? $received_from_date : "") ?>">
					</div>
					<div class="to_date_field">
						<label>To:</label>
						<input type="text" id="received_to_date" name="received_to_date" class="date_picker" size="20" value="<?php echo (isset($_GET['received_to_date']) ? $received_to_date : "") ?>">
					</div>
				</div>
			</div>
			<input type="Submit" value="Search" onclick="return requestHistorySearch()">&nbsp;&nbsp;<input type="button" value="Clear" onclick="window.location='letter_request_history.php'">
		</form>
	</div>
</div>

<p>&nbsp;</p>

<div id="request_search_results">
	<?php 
		if ($letters) { 
			$total_new = 0;
			$total_revised = 0;
			$total_enrollment = 0;
	?>
	<table>
		<tr>
			<th>Date Received</th>
			<th>Date Completed</th>
			<th>Submitter</th>
			<th>New Letters</th>
			<th>Revised Letters</th>
			<th>Enrollment?</th>
			<th>Owner</th>
		</tr>
	<?php foreach ($letters as $letter): ?>
		<tr>
			<td><?php echo $letter['Letter']['date_received']; ?></td>
			<td><?php echo $letter['Letter']['completed_date']; ?></td>
			<td><?php echo $letter['Letter']['submitter']; ?></td>
			<td><?php echo $letter['Letter']['new_templates']; ?></td>
			<td><?php echo $letter['Letter']['revised_templates']; ?></td>
			<td><?php echo $letter['Letter']['enrollment']; ?></td>
			<td><?php echo $letter['User']['first_name']; ?></td>
			<td><?php echo $this->Html->link($this->Html->image('btn_color_search.png', array('height' => '16', 'width' => '16')), array('controller' => 'letters', 'action' => 'view', $letter['Letter']['id']), array('escapeTitle' => false)); ?></td>
			<td><?php echo $this->Form->postLink($this->Html->image('deleteX.gif'), array('controller' => 'letters', 'action' => 'delete', $letter['Letter']['id']), array('escapeTitle' => false, 'confirm' => 'Are you sure?')); ?></td>
		</tr>
		<?php
			$total_new += $letter['Letter']['new_templates'];
			$total_revised += $letter['Letter']['revised_templates'];
			$total_enrollment += ($letter['Letter']['enrollment'] ? $letter['Letter']['new_templates'] : 0);
			endforeach;
			unset($letter);
		?>	
	</table>
	<p>&nbsp;</p>
	<p>Total Letter Requests (since 10/11/13):</p>
	<p>New Letters: <?php echo $total_new . ' (' . $total_enrollment; ?> enrollment)</p>
	<p>Revised Letters: <?php echo $total_revised; ?></p>
	
	<?php } else { ?>
	
	<p class="message_feedback">No letter requests to display.</p>
	
	<?php } ?> 
</div>
<p>&nbsp;</p>
<p>&nbsp;</p>
