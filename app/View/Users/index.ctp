<h1 id="header_text">IRBNet Support Admin Portal</h1>
<p>&nbsp;</p>
<section>
	<h2>
	<?php
	/*
			$this_user_index = $_SESSION['user_index'];
			$org_list = mysqli_query($database, "SELECT * FROM Organizations WHERE org_specialist = '$this_user_index'") or die(mysqli_error($database));
			if (mysqli_num_rows($org_list) != 0) {
				echo "<aside id='my_org_section'>
						<h2>My Organizations:</h2>
							<div id='my_org_list'>";
					while($my_org_row = mysqli_fetch_assoc($org_list)) {
						$org_name = $my_org_row['org_full_name'];
						$org_index = $my_org_row['org_index'];
						echo "<p><a href='organization_details.php?org=$org_index'>$org_name</a></p>";
					}
					echo "</div>
					</aside>";
			}
	*/
		echo 'Welcome ' . $this->Session->read('Auth.User.first_name') . '!';
	?>
	</h2>
	<p>&nbsp;</p>
</section>
