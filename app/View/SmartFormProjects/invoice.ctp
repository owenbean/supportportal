<h3>Smart Form Invoice</h3>

<p>
&nbsp;
</p>

<h4>Instructions</h4>

<p>
<?php echo $this->Session->read('Auth.User.first_name'); ?>, please copy this template into the Wizards inbox and complete as needed. Thanks!
</p>

<p>
&nbsp;
</p>

<h4>Invoice Template</h4>

<p>
In response to the recent <?php echo $smartFormProject['SmartFormProject']['type']; ?> Request to <?php echo $smartFormProject['Member']['full_name'] ?>'s <strong><?php echo $smartFormProject['SmartForm']['name']; ?></strong>, please note the enclosed scope and revised fee schedule.
</p>

<p>
To approve this <?php echo $smartFormProject['SmartFormProject']['type']; ?> Request, please request that <?php echo $smartFormProject['Admin']['first_name']; ?> respond to this email with confirmation and any invoicing instructions for our team. Wizards are scheduled and processed in the order they are received. [(<em>Delete this section as needed</em>) Please note that fees have been waived for this request.]
</p>

<p>
Please contact me directly with any questions.
</p>

<p>
&#42;&#42;&#42;&#42;&#42;&#42;&#42;
</p>

<p>
<strong>Date Requested:</strong> <?php echo $smartFormProject['SmartFormProject']['date_received']; ?>
</p>

<p>
<strong>Institution:</strong> <?php echo $smartFormProject['Member']['full_name'] ?>
</p>

<p>
<strong>Requested By:</strong> <?php echo $smartFormProject['Admin']['first_name']; ?> <?php echo $smartFormProject['Admin']['last_name']; ?> (email: <a href="mailto:<?php echo $smartFormProject['Admin']['email_address']; ?>"><?php echo $smartFormProject['Admin']['email_address']; ?></a>)
</p>

<p>
<strong>Summary of Requested Changes:</strong><br />
<?php echo $smartFormProject['SmartFormProject']['comments']; ?>
</p>

<p>
<strong>Project Scope:</strong> <?php echo $smartFormProject['SmartFormProject']['scope']; ?><br />
<strong>Output Change:</strong> <?php echo ($smartFormProject['SmartFormProject']['output_change'] ? 'Yes' : 'No'); ?>
<!-- For future release, include list of previous projects submitted for this form in previous two years -->
</p>


<p>
<strong>Total Cost of Requested Changes:</strong> [<em>TO DO</em>]<br />
* Due at time of acceptance:</strong> [<em>TO DO</em>]
</p>

<p>
* Due on anniversary of this date:</strong> [<em>TO DO</em>]<br />
   ** Data maintenance fee:</strong> [<em>TO DO</em>]<br />
</p>

<p>&nbsp;</p>
<p><?php echo $this->Html->link('Back', array('action' => 'view', $smartFormProject['SmartFormProject']['id'])); ?></p>
