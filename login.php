<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">

<!--Authors: Tyler Chi, Liam Connor, David Isaksen, Nicholas Sukhu, Huy Vu
	Last Modified:05-09-2018
	
	This is the HTML page for the login page for the IS448 Group project for team Groot.-->

<html xmlns = "http://www.w3.org/1999/xhtml">

	<!-- Title -->
	<head>
		<title> Log In </title>
		<link rel="stylesheet" href="plexorbStyle.css" type="text/css"/>
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/prototype/1.6.0.3/prototype.js"></script>
		<script type="text/javascript" src="plexorbJavaScript.js"></script>
	</head>

	<!-- php section to connect to database and pull existing emails and passwords into arrays for login checking -->
	<?php

		/* connect to the mysql database */
		$sqlDatabase = mysqli_connect("studentdb-maria.gl.umbc.edu","tychi1","tychi1","tychi1");
		
		/* if no connection or error, exit connection and display message */
		if (mysqli_connect_errno()) {
			exit("Error - could not connect to MySql");
		}
		
		/* create query to select all emails from customer table in database */
		$query2 = "SELECT cust_email FROM CUSTOMERS";
		
		/* execute the query */
		$emResult = mysqli_query($sqlDatabase, $query2);
		
		/* create array to hold emails */
		$colVal = Array();
		
		/* place selected emails into the create array */
		while ($row = mysqli_fetch_array($emResult)) {
			$colVal[] = $row['cust_email'];
		}
		
		/* create query to select all passwords from customer table in database */
		$query3 = "SELECT cust_password FROM CUSTOMERS";
		
		/* execute the query */
		$passResult = mysqli_query($sqlDatabase, $query3);
		
		/* create array to hold passwords */
		$colVal2 = Array();
		
		/* place selected passwords into the create array */
		while ($row = mysqli_fetch_array($passResult)) {
			$colVal2[] = $row['cust_password'];
		}
	?>
	
	<!-- Passing arrays to javascript -->
	<script type="text/javascript">var emailArray = <?php echo json_encode($colVal); ?></script>
	<script type="text/javascript">var passArray = <?php echo json_encode($colVal2); ?></script>
	
	<!-- Body -->
	<body>

		<!-- This is the beginning of the top banner -->
		<div class="top">
			<img class="imgFloatLeft" src="https://swe.umbc.edu/~cliam1/is448/del3/orb2.jpg" alt="the plex orb"/>
			<h1 class="left">&nbsp;&nbsp;PlexOrb Hotels</h1>
			<a class="topButtons" href="login.php">Log In</a> 
			<a class="topButtons" href="account.html">Create Account</a>
			<a class="topButtons" href="about.html">About Us</a>
			<a class="topButtons" href="home.html">Home</a>
		</div>
		<!-- This is the end of the top banner -->
	
		<!-- Spacer -->
		<p>
			<br />
		</p>

		<!-- Div to contain form for login -->
		<div class="shade">
			<h1 class="mainTitle"> Log In </h1>

			<!-- Spacer -->
			<p>
				<br />
			</p>

			<!-- Login form with two user inputs: email address and password -->
			<form name = "loginForm" action = "https://swe.umbc.edu/~nsukhu1/is448/groupProject2/user2.php" method="post">
				<p class="fillOut">
					<input type = "text" name = "email" id = "email" size = "50" />
					<br />
					Email
				</p>
				
				<p class="fillOut">
					<input type = "password" name = "password" id = "password" size = "50" />
					<br />
					Password
					<br />
					<br />
				</p>
				
				<!-- On submit call checkLogin function -->
				<p>
					<input type = "submit" value="Submit" onclick="return checkLogin()"/>
					<input type = "reset" value="Reset"/>
				</p>
			</form>
		</div>
	</body>
</html>
