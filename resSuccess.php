<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">

<!--Authors: Tyler Chi, Liam Connor, David Isaksen, Nicholas Sukhu, Huy Vu
	Last Modified:05-09-2018
	
	This is the PHP page for the reservation success page for the IS448 Group project for team Groot.-->

<html xmlns = "http://www.w3.org/1999/xhtml">

	<!-- Title -->
	<head>
		<title> Reservation Success </title>
		<link rel="stylesheet" href="plexorbStyle.css" type="text/css"/>
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/prototype/1.6.0.3/prototype.js"></script>
		<script type="text/javascript" src="plexorbJavaScript.js"></script>
	</head>

	<!-- php section to connect to database and insert reservation into reservation table -->
	<?php

		/* connect to the mysql database */
		$sqlDatabase = mysqli_connect("studentdb-maria.gl.umbc.edu","tychi1","tychi1","tychi1");
		
		/* if no connection or error, exit connection and display message */
		if (mysqli_connect_errno()) {
			exit("Error - could not connect to MySql");
		}
		
		/* get information from makeRes using POST and store in variables */
		$startDate = $_POST["startDate"];
		$endDate = $_POST["endDate"];
		$street = $_POST["street"];
		$city = $_POST["city"];
		$state = $_POST["state"];
		$zipcode = $_POST["zipcode"];
		$name = $_POST["name"];
		$cardNum = $_POST["cardNum"];
		$expDate = $_POST["expDate"];
		
		/* Get amount of nights staying */
		$date1 = date_create($startDate);
		$date2 = date_create($endDate);
		$dateDiff = date_diff($date1,$date2);
		
		/* Get the days */
		$dateDiffUse = $dateDiff->format('%d');
		
		/* Calculate total cost */
		$totalCost = 100 * $dateDiffUse;
		
		/* create query to select all from Se table to get the current logged in user */
		$query = "SELECT custEmail FROM Se where sessionID = 1";
		
		/* execute the query */
		$result2 = mysqli_query($sqlDatabase, $query);
		
		/* get the result into string */
		while($row = mysqli_fetch_assoc($result2)) {
			$email = $row["custEmail"];
		}
		
		/* create query to insert new account into customers table in database */
		$query = "INSERT INTO RESERVATIONS(cust_email, room_id, res_cost, res_start, res_end) VALUES('$email', '1','$totalCost','$startDate', '$endDate')";
		
		/* execute the query */
		$result = mysqli_query($sqlDatabase, $query);
		
		$query2 = "UPDATE CUSTOMERS set cust_street = '$street', cust_city = '$city', cust_state = '$state', cust_zip = '$zipcode', cust_cardNum = '$cardNum' where cust_email = '$email'";
		
		/* execute the query */
		$result2 = mysqli_query($sqlDatabase, $query2);
	?>

	<!-- Body -->
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

		<div class="shade">
			<h1 class="mainTitle"> Reservation Successful! </h1>

			<!-- Spacer -->
			<p>
				<br />
			</p>

			<form name = "resSucForm" action = "https://swe.umbc.edu/~nsukhu1/is448/groupProject2/browse.php" method="post">
				<p>
					<input type = "submit" value="Browse"/>
				</p>
			</form>
		</div>
	</body>
</html>