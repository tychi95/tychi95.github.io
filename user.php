<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">

<!--Authors: Tyler Chi, Liam Connor, David Isaksen, Nicholas Sukhu, Huy Vu
	Last Modified:05-09-2018
	
	This is the HTML page for the manage user page for the IS448 Group project for team Groot.-->

<html xmlns = "http://www.w3.org/1999/xhtml">

	<!--Title-->
	<head>
		<title> Manage Account </title>
		<link rel="stylesheet" href="plexorbStyle.css" type="text/css"/>
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/prototype/1.6.0.3/prototype.js"></script>
		<script type="text/javascript" src="plexorbJavaScript.js"></script>
	</head>

	<!-- -->
	<?php

		/* connect to the mysql database */
		$sqlDatabase = mysqli_connect("studentdb-maria.gl.umbc.edu","tychi1","tychi1","tychi1");
		
		/* if no connection or error, exit connection and display message */
		if (mysqli_connect_errno()) {
			exit("Error - could not connect to MySql");
		}
		
		/* create query to select all from Se table to get the current logged in user */
		$query = "SELECT custEmail FROM Se where sessionID = 1";
		
		/* execute the query */
		$result2 = mysqli_query($sqlDatabase, $query);
		
		/* get the result into string */
		while($row = mysqli_fetch_assoc($result2)) {
			$email = $row["custEmail"];
		}
		
		/* create query to select all from the customers table for the logged in user */
		$query = "SELECT * FROM CUSTOMERS where cust_email = '$email'";
		
		/* execute the query */
		$result = mysqli_query($sqlDatabase, $query);
		
		/* store each field value from row into variable to be used to populate page */
		if (mysqli_num_rows($result) > 0) {
			while($row = mysqli_fetch_assoc($result)) {
				$custFName = $row["cust_fName"];
				$custLName = $row["cust_lName"];
				$custEmail = $row["cust_email"];
				$custPhone = $row["cust_number"];
				$custStreet = $row["cust_street"];
				$custCity = $row["cust_city"];
				$custState = $row["cust_state"];
				$custZip = $row["cust_zip"];
				$custCard = $row["cust_cardNum"];
			}
		}
		
		/* Display message if no address */
		if ($custStreet == null) {
			$custStreet = "No address on file";
		}
		
		/* Display message if no credit card */
		if ($custCard == null) {
			$custCard = "No credit card on file";
		}
		
		/* create query to select all from rooms table */
		$query = "SELECT * FROM RESERVATIONS where cust_email = '$email'";
		
		/* execute the query */
		$result = mysqli_query($sqlDatabase, $query);
		
		if (mysqli_num_rows($result) > 0) {
			while($row = mysqli_fetch_assoc($result)) {
				$res_id = $row["res_id"];
				$cust_email = $row["cust_email"];
				$room_id = $row["room_id"];
				$res_cost = $row["res_cost"];
				$res_start = $row["res_start"];
				$res_end = $row["res_end"];
				
			}
		}
		
		/* create array to hold array of reservations */
		$resArray = array();
		
		/* loop through result of query and add to array */
		$index = 0;
		while($row = mysqli_fetch_row($result)){
			$resArry[$index] = $row;
			$index++;
		}
	?>
	
	<!--Body-->
	<body>

		<!-- This is the beginning of the top banner -->
		<div class="top">
			<img class="imgFloatLeft" src="https://swe.umbc.edu/~cliam1/is448/del3/orb2.jpg" alt="the plex orb"/>
			<h1 class="left">&nbsp;&nbsp;PlexOrb Hotels</h1>
			<a class="topButtons" href="https://swe.umbc.edu/~nsukhu1/is448/groupProject2/user.php">Manage Account</a> 
			<a class="topButtons" href="https://swe.umbc.edu/~nsukhu1/is448/groupProject2/browse.php">Browse</a>
			<a class="topButtons" href="https://swe.umbc.edu/~nsukhu1/is448/groupProject2/about.html">About Us</a>
			<a class="topButtons" href="https://swe.umbc.edu/~nsukhu1/is448/groupProject2/home.html">Home</a>
		</div>
		<!-- This is the end of the top banner -->
		
		<!-- Spacer -->
		<p>
			<br />
		</p>
		
		<!-- Header-->
		<div class="centerForm">
			<h3> My Profile </h3>
		</div>

		<!-- Spacer -->
		<p>
			<br />
		</p>
		
		<div class="lowContain">
			<!-- Div for left side content -->
			<div class="containerLeft">
				<!-- My Info -->
				<div id="info">
					<h4> My Info </h4>
					<p>
						First Name: <?php echo $custFName; ?> <br /><br />
						Last Name: <?php echo $custLName; ?> <br /><br />
						Email Address: <?php echo $custEmail; ?> <br /><br />
						Phone Number: <?php echo $custPhone; ?>
					</p>
				
				<!-- My Payment Info -->
					<h4> My Payment Info </h4>
					<p>
						Billing Address: <?php echo $custStreet; ?>, <?php echo $custCity; ?>, <?php echo $custState; ?>, <?php echo $custZip; ?> <br /><br />
						Credit Card Info: <?php echo $custCard; ?> <br />
					</p>
				
				<!-- My Reservations -->
					<a class="topButtons" href="https://swe.umbc.edu/~nsukhu1/is448/groupProject2/cancel.php">Cancel Reservations</a>
					<a class="topButtons" href="https://swe.umbc.edu/~nsukhu1/is448/groupProject2/changeDate.php">Change Date</a>
					
					<h4> My Reservations </h4>
					<p>
						Reservation Info:
					</p>
				</div>
			</div>

			<!-- Divs for right side -->
			<!-- Privacy Settings -->
			<div id="privacy">
				<h4 class="centerText"> Privacy Settings </h4>
				<form action="">
					<p>
						<input type="checkbox" name="security1" value="setting5" checked="checked"/>&nbsp;&nbsp;Allow PlexOrb to use your information for advertisement purposes.<br /><br />
						<input type="checkbox" name="security2" value="setting6" checked="checked"/>&nbsp;&nbsp;Allow others to see where you have stayed.<br /><br />
						<input type="checkbox" name="security3" value="setting7" checked="checked"/>&nbsp;&nbsp;Allow reccomendations based on past stays.<br /><br />
						<input type="checkbox" name="security4" value="setting8" checked="checked"/>&nbsp;&nbsp;Recieve newsletters from us.<br /><br />
					</p>
					<p class="centerText">
						<input type = "submit" value="Submit"/>
						<input type = "reset" value="Reset"/>
					</p>
				</form>
			</div>
		</div>
	</body>
</html>