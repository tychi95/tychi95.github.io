<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">

<!--Authors: Tyler Chi, Liam Connor, David Isaksen, Nicholas Sukhu, Huy Vu
	Last Modified:05-09-2018
	
	This is the HTML page for the make reservation page for the IS448 Group project for team Groot.-->

<html xmlns = "http://www.w3.org/1999/xhtml">

	<!--Title-->
	<head>
		<title> Make Reservation </title>
		<link rel="stylesheet" href="plexorbStyle.css" type="text/css"/>
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/prototype/1.6.0.3/prototype.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
		<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
		<script type="text/javascript" src="plexorbJavaScript.js"></script>
	</head>

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
			<h3> Make Reservation </h3>
		</div>
		
		<!-- Spacer -->
		<p>
			<br />
		</p>
		
		<div class="shade">
			<!-- Div for date and number of people in room -->
			<div>
				<form name="resForm" action="https://swe.umbc.edu/~nsukhu1/is448/groupProject2/resSuccess.php" method="post">
					<p>
						<span class="subtitle">Start Date</span> 
						<br />
						
						<!-- Start Date input, using datepicker -->
						<input type="text" id="startDate" name="startDate" size="10" class="centerText">
						
						<br /><br />
									
						<span class="subtitle">End Date</span> 
						
						<br /><br />
							
						<!-- End Date input, using datepicker -->
						<input type="text" id="endDate" name="endDate" size="10" class="centerText">
						
						<!-- Script to get current date, tomorrow's date, and implement datepicker-->
						<script>
							
							/* Get today's and tomorrow's date */
							var date = new Date();

							var day = date.getDate();
							var tomDay = day + 1;
							var month = date.getMonth() + 1;
							var year = date.getFullYear();

							if (month < 10) month = "0" + month;
							if (day < 10) day = "0" + day;

							var today = month + "/" + day + "/" + year;
							var tomorrow = month + "/" + tomDay + "/" + year;

							/* Set today and tomorrow's date in input fields */
							document.getElementById('startDate').value = today;
							document.getElementById('endDate').value = tomorrow;
							
							/* Use datepicker to pick start and end dates that make sense */
							$('#startDate').datepicker({
								minDate: 'today',
								onSelect: function(dateText, inst){
									$('#endDate').datepicker('option', 'minDate', new Date(dateText));
								},
							});

							$('#endDate').datepicker({
								minDate: '#startDate + 1',
								onSelect: function(dateText, inst){
									$('#startDate').datepicker('option', 'maxDate', new Date(dateText));
								}
							});
							
						</script>
						
						<br /><br /><br />
				
						<span class="subtitle">Billing Address:</span><br /><br />
						
						<!-- Street input -->
						<input type="text" id="street" name="street" size="25"/><br />
						Street
						<br />
						
						<!-- City input -->
						<input type="text" id="city" name="city" size="25"/><br />
						City
						<br />
						
						<!-- State input with datalist -->
						<input type="text" id="state" name="state" list="stateList" size="25"/><br />
						State
						<br />
						
						<!-- Datalist of states -->
						<datalist id="stateList">
							<option value="Alabama"></option>
							<option value="Alaska"></option>
							<option value="Arizona"></option>
							<option value="Arkansas"></option>
							<option value="California"></option>
							<option value="Colorado"></option>
							<option value="Connecticut"></option>
							<option value="Delaware"></option>
							<option value="District of Columbia"></option>
							<option value="Florida"></option>
							<option value="Georgia"></option>
							<option value="Hawaii"></option>
							<option value="Idaho"></option>
							<option value="Illinois"></option>
							<option value="Indiana"></option>
							<option value="Iowa"></option>
							<option value="Kansas"></option>
							<option value="Kentucky"></option>
							<option value="Louisiana"></option>
							<option value="Maine"></option>
							<option value="Maryland"></option>
							<option value="Massachusetts"></option>
							<option value="Michigan"></option>
							<option value="Minnesota"></option>
							<option value="Mississippi"></option>
							<option value="Missouri"></option>
							<option value="Montana"></option>
							<option value="Nebraska"></option>
							<option value="Nevada"></option>
							<option value="New Hampshire"></option>
							<option value="New Jersey"></option>
							<option value="New Mexico"></option>
							<option value="New York"></option>
							<option value="North Carolina"></option>
							<option value="North Dakota"></option>
							<option value="Ohio"></option>
							<option value="Oklahoma"></option>
							<option value="Oregon"></option>
							<option value="Pennsylvania"></option>
							<option value="Rhode Island"></option>
							<option value="South Carolina"></option>
							<option value="South Dakota"></option>
							<option value="Tennessee"></option>
							<option value="Texas"></option>
							<option value="Utah"></option>
							<option value="Vermont"></option>
							<option value="Virginia"></option>
							<option value="Washington"></option>
							<option value="West Virginia"></option>
							<option value="Wisconsin"></option>
							<option value="Wyoming"></option>
						</datalist>
						
						<input type="text" id="zipcode" name="zipcode" size="25"/><br />
						Zipcode
						<br /><br />
					
						<!-- Name input for credit card. Default value pulled from database -->
						<input type="text" id="name" name="name" size="50" value="<?php echo $custFName; ?> <?php echo $custLName; ?>"/><br />
						Full Name
						
						<br /><br />
						
						<!-- Card input here -->
						<input type="text" id="cardNum" name="cardNum" size="50"/><br />
						Credit Card Number<br /><br />
						
						<!-- Expiration date input, using date type -->
						<input type="date" id="expDate" name="expDate" size="10" class="centerText">
						
						<br />
						Exp Date
						
						<br /><br />
						
						<!-- Call checkRes function on submit -->
						<input type = "submit" value="Submit" onclick="return checkRes()"/>
						<input type = "reset" value="Reset"/>
					</p>
				</form>
			</div>
		</div>
		<p>
			<br />
		</p>
	</body>
</html>