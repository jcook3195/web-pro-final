
// Regex for email
var valEmail = /^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/;
// Regex for phone
var valPhone = /^(\()?\d{3}(\))?(-|\s)?\d{3}(-|\s)\d{4}$/;

// Login form validation functionality
function lValidate() {
	// Set validation variable
	isValid = true;

	// If it is valid clear all error messages
	if(isValid) {
		$('[id^=err]').text("");
	}

	// Get form values
	var email = $('#email').val();
	var pass = $('#pass').val();

	// Check for email
	if(valEmail.test(email) == false) {
		$('#err1').text("Please enter a valid email address.");
		isValid = false;
	}

	// Check for password
	if(pass == "") {
		$('#err2').text("Please enter a password.");
		isValid = false;
	}

	// If it is valid, submit
	if(isValid == false) {
		return false;
	} else {
		return true;
	}
}

// Register form validation functionality
function rValidate() {
	// Set validation variable
	isValid = true;

	// If it is valid clear all error messages
	if(isValid) {
		$('[id^=err]').text("");
	}

	// Get form values
	var email = $('#persemail').val();
	var pass = $('#perspassword').val();
	var fname = $('#persfname').val();
	var lname = $('#perslname').val();
	var phone = $('#persphone').val();
	var office = $('#persoffice').val();
	var dept = $('#persdept').val();

	// Check for email
	if(valEmail.test(email) == false) {
		$('#err1').text("Please enter a valid email address.");
		isValid = false;
	}

	// Check for password
	if(pass == "" || pass.length < 8) {
		$('#err2').text("Please enter a password of at least 8 characters.");
		isValid = false;
	}

	// Check for first name
	if(fname == "") {
		$('#err3').text("Please enter your first name.");
		isValid = false;
	}

	// Check for last name
	if(lname == "") {
		$('#err4').text("Please enter your last name.");
		isValid = false;
	}

	// Check phone number
	if(valPhone.test(phone) == false) {
		$('#err5').text("Please enter a valid phone number.");
		isValid = false;
	}

	// Check office address
	if(office == "") {
		$('#err6').text("Please enter office address.");
		isValid = false;
	}

	// Check department
	if(dept == "") {
		$('#err7').text("Please choose your department.");
		isValid = false;
	}

	// If it is valid, submit
	if(isValid == false) {
		return false;
	} else {
		return true;
	}
}