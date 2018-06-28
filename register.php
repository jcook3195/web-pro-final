<?php

	session_start();
	$title = "Register";
	$bdyClass = "register";
	require_once('includes/header.php');
	require_once('includes/db_functions.php');

?>

<div class="tool-bar">
	<div class="message-container one-half first">
		<p class="welcome-msg">Welcome to the SuperCompany Intranet.</p>
	</div>
	<div class="login-button-container one-half right">
		<form method="post" action="login.php">
			<input type="submit" value="Login" id="login-pg" name="login-pg" class="button login-button">
		</form>
	</div>
	<div class="clear"></div>
</div>

<?php

if(isset($_POST["register"])) {
	$persEmail = $_POST['persemail'];
	$persPassword = $_POST['perspassword'];
	$persFName = $_POST['persfname'];
	$persLName = $_POST['perslname'];
	$persPhone = $_POST['persphone'];
	$persOffice = $_POST['persoffice'];
	$persDept = $_POST['persdept'];
	addPerson($persEmail, $persPassword, $persFName, $persLName, $persPhone, $persOffice, $persDept);
}

?>

<div class="register-container">
	<form method="post" id="register-form">
		<fieldset>
			<div class="field-container one-half first">
				<label for="persemail">Email</label><br>
				<input type="email" id="persemail" name="persemail">
				<p id="err1" class="error"></p>
			</div>
			<div class="field-container one-half">
				<label for="perspassword">Password</label><br>
				<input type="password" id="perspassword" name="perspassword">
				<p id="err2" class="error"></p>
			</div>
			<div class="field-container one-half first">
				<label for="persfname">First Name</label><br>
				<input type="Text" id="persfname" name="persfname">
				<p id="err3" class="error"></p>
			</div>
			<div class="field-container one-half">
				<label for="perslname">Last Name</label><br>
				<input type="text" id="perslname" name="perslname">
				<p id="err4" class="error"></p>
			</div>
			<div class="field-container one-half first">
				<label for="persphone">Phone - <em>format (111) 222-333</em></label><br>
				<input type="text" id="persphone" name="persphone">
				<p id="err5" class="error"></p>
			</div>
			<div class="field-container one-half">
				<label for="persoffice">Office Address</label><br>
				<input type="text" id="persoffice" name="persoffice">
				<p id="err6" class="error"></p>
			</div>
			<div class="field-container one-half first">
				<label for="persdept">Department</label><br>
				<?php getDeptOptions(); ?>
				<p id="err7" class="error"></p>
			</div>
			<div class="submit-container clear">
				<button type="submit" id="register" name="register" class="button" onclick="return rValidate()">Register</button>
			</div>
		</fieldset>
	</form>
</div>

<?php

	require_once('includes/footer.php');

?>