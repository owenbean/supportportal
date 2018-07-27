<h3>Smart Form Scope</h3>

<p>
&nbsp;
</p>

<h4>Instructions</h4>

<p>
This page is intended to help you quickly create a template letter that you can send off to Andy for authorization. When you need to send a scope to Andy, please copy this template into your message and edit the message to include the tallies of new steps, revised steps, new fillins, and revised fillins.
</p>

<p>
Please note: when this page describes "previous requests," it is looking for requests in which the "Date Requested" field is the same as or earlier than the "Date Requested" field for this request.
</p>

<p>
&nbsp;
</p>

<h4>Scope Template</h4>

<p>
<em>The following text should be copied/pasted into your email to Andy</em>
</p>

<p>
&#42;&#42;&#42;&#42;&#42;&#42;&#42;
</p>

<p style="font-size: 10pt">
In response to the recent <?php echo $smartFormProject['SmartFormProject']['type']; ?> Request to <?php echo $smartFormProject['Member']['full_name'] ?>'s <strong><?php echo $smartFormProject['SmartForm']['name']; ?></strong>, please note the enclosed scope and revised fee schedule.
</p>

<p style="font-size: 10pt">
To approve this <?php echo $smartFormProject['SmartFormProject']['type']; ?> Request, please request that <?php echo $smartFormProject['Admin']['first_name']; ?> respond to this email with confirmation and any invoicing instructions for our team. Wizards are scheduled and processed in the order they are received. [(<em>Delete this section as needed</em>) Please note that fees have been waived for this request.]
</p>

<p style="font-size: 10pt">
Please contact me directly with any questions.
</p>

<p style="font-size: 10pt">
&#42;&#42;&#42;&#42;&#42;&#42;&#42;
</p>

<p style="font-size: 10pt">
<strong>Date Requested:</strong> <?php echo $smartFormProject['SmartFormProject']['date_received']; ?> <br />
<strong>Institution:</strong> <?php echo $smartFormProject['Member']['full_name'] ?> <br />
<strong>Requested By:</strong> <?php echo $smartFormProject['Admin']['first_name']; ?> <?php echo $smartFormProject['Admin']['last_name']; ?> (email: <a href="mailto:<?php echo $smartFormProject['Admin']['email_address']; ?>"><?php echo $smartFormProject['Admin']['email_address']; ?></a>)
</p>

<p style="font-size: 10pt">
<strong>Summary of Requested Changes:</strong><br />
<?php echo $smartFormProject['SmartFormProject']['comments']; ?>
</p>

<p style="font-size: 10pt">
<strong>Project Scope:</strong> <?php echo $smartFormProject['SmartFormProject']['scope']; ?><br />
</p>

<p style="font-size: 10pt">
<strong>Output Change:</strong> <?php echo ($smartFormProject['SmartFormProject']['output_change'] ? 'Yes' : 'No'); ?>
</p>

<p style="font-size: 10pt">
Number of New Steps: [<em><?php echo strtoupper($thisUser_first_name) ?>: TO DO</em>]<br />
Number of Revised Steps: [<em><?php echo strtoupper($thisUser_first_name) ?>: TO DO</em>]<br />
Number of New Fillins: [<em><?php echo strtoupper($thisUser_first_name) ?>: TO DO</em>]<br />
Number of Revised Fillins: [<em><?php echo strtoupper($thisUser_first_name) ?>: TO DO</em>]<br />
</p>

<p style="font-size: 10pt">
<strong>Total Cost of Requested Changes:</strong> [<em>ANDY: TO DO</em>]
</p>

<p style="font-size: 10pt">
* Due at time of acceptance: [<em>ANDY: TO DO</em>] <br />
* Due on anniversary of this date:[<em>ANDY: TO DO</em>]<br />
   ** Data maintenance fee:[<em>ANDY: TO DO</em>]
</p>

<p style="font-size: 10pt">
<strong>Previous Requests:</strong><br />
<?php echo $currentYear; ?>
	<ul style="font-size: 10pt">
        <?php 
		if (!$currentYearProjects) { ?>
			<li>There were no previous projects requested in <?php echo $currentYear; ?></li>
		<?php } ?>
		<?php foreach($currentYearProjects as $currentYearProject): ?>
						<li><?php echo $currentYearProject['SmartFormProject']['scope'] . ' request submitted by ' . $currentYearProject['Admin']['first_name'] . ' ' . $currentYearProject['Admin']['last_name'] . ' on ' . $currentYearProject['SmartFormProject']['date_received'] ?></li>
		<?php
			endforeach;
			unset($currentYearProject);
		?>
	</ul>	
</p>
	
<p style="font-size: 10pt">
<?php echo $previousYear; ?>
	<ul style="font-size: 10pt">
        <?php 
		if (!$previousYearProjects) { ?>
			<li>There were no projects requested in <?php echo $previousYear; ?></li>
		<?php } ?>
		<?php foreach($previousYearProjects as $previousYearProject): ?>
						<li><?php echo $previousYearProject['SmartFormProject']['scope'] . ' request submitted by ' . $previousYearProject['Admin']['first_name'] . ' ' . $previousYearProject['Admin']['last_name'] . ' on ' . $previousYearProject['SmartFormProject']['date_received'] ?></li>
		<?php
			endforeach;
			unset($previousYearProject);
		?>
	</ul>
</p>

<p style="font-size: 10pt">
&#42;&#42;&#42;&#42;&#42;&#42;&#42;
</p>

<p>&nbsp;</p>
<p><?php echo $this->Html->link('Back', array('action' => 'view', $smartFormProject['SmartFormProject']['id'])); ?></p>
