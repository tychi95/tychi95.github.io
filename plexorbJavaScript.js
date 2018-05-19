/*
 * Authors: Tyler Chi, Liam Connor, David Isaksen, Nicholas Sukhu, Huy Vu
 * Last Modified:05-09-2018
 * 
 * JavaScript file for the PlexOrb site for IS448 GroupProject.
 */
 
/*
 * Function to validate the user inputs on the account html page.
 * Returns false whenever there is an issue with the user input, 
 * requesting the user to re-input the value.
 */
function checkAcc() {
	// get values of elements from account page and store in variables to be used later
	var fname = document.getElementById("cfName").value;
	var lname = document.getElementById("clName").value;
	var phone = document.getElementById("cPhone").value;
	var email = document.getElementById("cEmail").value;
	var confirmEmail = document.getElementById("cConfirmEmail").value;
	var pass = document.getElementById("cPassword").value;
	var confirmPassword = document.getElementById("cConfirmPassword").value;
	
	// check if first name field is empty
	if (fname == "") {		
		alert("First name cannot be blank. Please enter your first name.");
		document.getElementById("cfName").focus();
		document.getElementById("cfName").select();
		return false;
	}

	// check if first name contains numbers, spaces, or special characters
	if (/^([a-zA-Z]+)$/.test(fname) == false) {
		alert("First name should not contain numbers, spaces, or special characters.");
		document.getElementById("cfName").focus();
		document.getElementById("cfName").select();
		return false;
	}
	
	// check if last name field is empty
	if (lname == "") {
		alert("Last name cannot be blank. Please enter your last name.");
		document.getElementById("clName").focus();
		document.getElementById("clName").select();
		return false;
	}
	
	// check if last name contains numbers, spaces, or special characters
	if (/^([a-zA-Z]+)$/.test(lname) == false) {
		alert("Last name should not contain numbers, spaces, or special characters.");
		document.getElementById("clName").focus();
		document.getElementById("clName").select();
		return false;
	}
	
	// check if phone number field is empty
	if (phone == "") {
		alert("Phone number cannot be blank. Please enter your phone number.");
		document.getElementById("cPhone").focus();
		document.getElementById("cPhone").select();
		return false;
	}
	
	// check if phone number follows ten digits, with no spaces, letters, or other characters
	if (/^\d{10}$/.test(phone) == false) {
		alert("Phone number should contain ten digits with no spaces, letters or other characters.");
		document.getElementById("cPhone").focus();
		document.getElementById("cPhone").select();
		return false;
	}
	
	// check if email address field is empty
	if (email == "") {
		alert("Email address cannot be blank. Please enter your email address.");
		document.getElementById("cEmail").focus();
		document.getElementById("cEmail").select();
		return false;
	}
	
	// check if email is in proper format
	if (/\S+@\S+\.\S+/.test(email) == false) {
		alert("Not a valid e-mail address. Please enter a valid email address.");
		document.getElementById("cEmail").focus();
		document.getElementById("cEmail").select();
		return false;
	}
	
	// check if confirm email matches original email
	if((confirmEmail !== email)) {
		alert("Confirm email does not match email address. Please re-confirm your email.");
		document.getElementById("cConfirmEmail").focus();
		document.getElementById("cConfirmEmail").select();
		return false;
	}
	
	// check if password field is blank
	if (pass == "") {
		alert("Password cannot be blank. Please create your password.");
		document.getElementById("cPassword").focus();
		document.getElementById("cPassword").select();
		return false;
	}
	
	// check if password has length of at least four.
	if (/^[a-zA-Z0-9!@#$%^&*]{4,}$/.test(pass) == false) {
		alert("Password must have a length greater than four. Only numbers, letters, and !@#$%^&* are allowed.");
		document.getElementById("cPassword").focus();
		document.getElementById("cPassword").select();
		return false;
	}	
	
	// check if confirm password matches original password
	if (confirmPassword !== pass ){
		alert("Confirm Password does not match the inputted password. Please re-confirm your password");
		document.getElementById("cConfirmPassword").focus();
		document.getElementById("cConfirmPassword").select();
		return false;
	}
}			

/*
 * Function to validate the login information that the user inputs into the login html page.
 * Returns false and requests user to re-input information if there is an issue.
 */
function checkLogin() {
	
	// get values of elements from login page and store in variables to be used later
	var email = document.getElementById("email").value;
	var lPass = document.getElementById("password").value;
	
	// create variables to be used later
	var emailMatch = 0;
	var passMatch = 0;
	var emailPass;
	
	// check if email is in proper format
	if (/\S+@\S+\.\S+/.test(email) == false) {
		alert("Not a valid email address. Please enter a valid email address.");
		document.getElementById("email").focus();
		document.getElementById("email").select();
		return false;
	}
	
	// check if user inputted email exists in create accounts by looping though array gotten from php
	for (var i=0; i<emailArray.length; i++) {
		if (email == emailArray[i]) {
			emailMatch = 1;
			emailPass = i;
			break;
		}
	}
	
	// if no match was found, inform the user to re-enter the email address or create a new account
	if (emailMatch == 0) {
		alert("Email address is not registered. Please try again or create a new account.");
		document.getElementById("email").focus();
		document.getElementById("email").select();
		return false;
	}
	
	// check if password field is blank
	if (lPass == "") {
		alert("Password cannot be blank. Please enter your password.");
		document.getElementById("password").focus();
		document.getElementById("password").select();
		return false;
	}
	
	// check if user inputted password matches password for that email address
	if (lPass !== passArray[emailPass]) {
		alert("Incorrect password, please try again.");
		document.getElementById("password").focus();
		document.getElementById("password").select();
		return false;
	}
}

/*
 * Function to check user input against array of predefined values in php file, 
 * and auto-fill a field if there is a match.
 */
function suggeststate(inputString) {
  if (inputString.length==0) { 
     $("state_box").innerHTML="";
     return;
  }
  
  new Ajax.Request("state.php", { 
    method: "get", 
    parameters: {state:inputString},
    onSuccess: ajaxSuccess
  });
}

//function to execute when ajax request is successful.
function ajaxSuccess(ajax) {
	$("state_box").value=ajax.responseText;
}

/*
 * Function to validate the user inputs on the account html page.
 * Returns false whenever there is an issue with the user input, 
 * requesting the user to re-input the value.
 */
function suggestroom(inputString) {
  if (inputString.length==0) { 
     $("room_box").innerHTML="";
     return;
  }
  
  new Ajax.Request("room.php", { 
    method: "get", 
    parameters: {room:inputString},
    onSuccess: ajaxSuccessRoom
  });
}

// Function to execute when ajax request is successful.
function ajaxSuccessRoom(ajax) {
	$("room_box").value=ajax.responseText;
}

// Function to execute when ajax request is unsuccessful.
function ajaxFailure() {
	alert("Ajax request failed.");
}

function checkRes() {
	// get values of elements from makeRes page and store in variables to be used later
	var startDate = document.getElementById("startDate").value;
	var endDate = document.getElementById("endDate").value;
	var street = document.getElementById("street").value;
	var city = document.getElementById("city").value;
	var state = document.getElementById("state").value.toLowerCase();
	var zipcode = document.getElementById("zipcode").value;
	var name = document.getElementById("name").value;
	var cardNum = document.getElementById("cardNum").value;
	var expDate = document.getElementById("expDate").value;
	
	// create variables to be used later
	var stateMatch = 0;
	var stateArray = 
		['alabama','alaska','arizona','arkansas','california','colorado','connecticut','delaware','district of columbia','florida','georgia','guam','hawaii','idaho','illinois','indiana','iowa','kansas','kentucky','louisiana','maine','marshall islands','maryland','massachusetts','mmichigan','minnesota','mississippi','missouri','montana','nebraska','nevada','new hampshire','new jersey','new mexico','new york','north carolina','north dakota','northern mariana islands','ohio','oklahoma','oregon','palau','pennsylvania','puerto Rico','rhode island','south carolina','south dakota','tennessee','texas','utah','vermont','virgin island','virginia','washington','west virginia','wisconsin','wyoming'];
	
	// check if end date is the same as start date
	if (startDate == endDate) {
		alert("Start and end date can not be the same. Please select an end date at least one day after the selected start date.");
		document.getElementById("endDate").focus();
		document.getElementById("endDate").select();
		return false;
	}
	
	// check if street field is blank
	if (street == "") {
		alert("Street cannot be empty. Please enter the street associated with your billing address.");
		document.getElementById("street").focus();
		document.getElementById("street").select();
		return false;
	}
	
	// check if city field is blank
	if (city == "") {
		alert("City cannot be empty. Please enter the city associated with your billing address.");
		document.getElementById("city").focus();
		document.getElementById("city").select();
		return false;
	}
	
	// check if state field is blank
	if (state == "") {
		alert("State cannot be empty. Please enter the state associated with your billing address.");
		document.getElementById("state").focus();
		document.getElementById("state").select();
		return false;
	}
	
	// check if user inputted valid state
	for (var i=0; i<stateArray.length; i++) {
		if (state == stateArray[i]) {
			stateMatch = 1;
			break;
		}
	}
	
	// if invalid state was entered, ask user to re-enter
	if (stateMatch == 0) {
		alert("State entered was invalid. Please re-enter the state or choose from the menu.");
		document.getElementById("state").focus();
		document.getElementById("state").select();
		return false;
	}
	
	// check if zipcode field is blank
	if (zipcode == "") {
		alert("Zipcode cannot be empty. Please enter the zipcode associated with your billing address.");
		document.getElementById("zipcode").focus();
		document.getElementById("zipcode").select();
		return false;
	}
	
	// check if zipcode is in proper format
	if (/^\d{5}(-\d{4})?(?!-)$/.test(zipcode) == false) {
		alert("Not a valid zipcode. Please enter a valid zipcode with 5 or 9 digits.");
		document.getElementById("zipcode").focus();
		document.getElementById("zipcode").select();
		return false;
	}
	
	// check if name field is blank
	if (name == "") {
		alert("Name cannot be empty. Please enter the name associated with the credit card being used.");
		document.getElementById("name").focus();
		document.getElementById("name").select();
		return false;
	}
	
	// check if credit card number is blank
	if (cardNum == "") {
		alert("Credit Card number cannot be blank. Please enter the card number.");
		document.getElementById("cardNum").focus();
		document.getElementById("cardNum").select();
		return false;
	}
	
	// check if credit card number consists of 13-19 digits
	if (/^\d{13,19}$/.test(cardNum) == false) {
		alert("Valid credit card numbers must be between 13 and 19 digits. Please re-enter the card number.");
		document.getElementById("cardNum").focus();
		document.getElementById("cardNum").select();
		return false;
	}
	
	// check if expiration date is set
	if (expDate == "") {
		alert("Expiration date must be filled out. Please fill out the expiration date listed on your card.");
		document.getElementById("expDate").focus();
		document.getElementById("expDate").select();
		return false;
	}
}

function changeDate(){
	var startDate = document.getElementById("startDate").value;
	var endDate = document.getElementById("endDate").value;
	var list = document.getElementById("reservation");
	var selected = list.options[list.selectedIndex].text;
	alert(selected);
	
	document.getElementById("startDate").value = ;
	document.getElementById("expDate").value = ;
}