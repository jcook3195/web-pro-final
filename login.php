<?php

	session_start();
	$title = "Employee Login";
	$bdyClass = "login";
	require_once('includes/header.php');
	require_once('includes/db_functions.php');

?>

<div class="tool-bar">
	<div class="message-container one-half first">
		<p class="welcome-msg">Welcome to the SuperCompany Intranet.</p>
		<p class="status-msg">

<?php

if(isset($_POST['logout'])) {
	logout();
	unset($_SESSION['error']);
	$_SESSION['error'] = "<span class='success-msg'>User was successfully logged out.</span>";
}

if(isset($_POST['submit'])) {
	$validLogin = login($_POST['email'], $_POST['pass']);

	if($validLogin) {
		header("Location: dashboard.php");
		exit();
	} else {
		echo "Incorrect username or password.";
	}
}

?>

<?php

	if(isset($_SESSION['error'])) {
		echo $_SESSION['error'];
		unset($_SESSION['error']);
	}
?>
	</p>
</div>
<div class="register-button-container one-half right">
		<form method="post" action="register.php">
			<input type="submit" value="Register" id="register-pg" name="register-pg" class="button register-button">
		</form>
	</div>
	<div class="clear"></div>
</div>

<div class="login-container">
	<div class="form-container">
		<form method="post" id="login" action="dashboard.php">
			<fieldset>
				<div class="field-container">
					<label for="email">Email</label><br>
					<input type="text" id="email" name="email">
					<p id="err1" class="error"></p>
				</div>
				<div class="field-container">
					<label for="pass">Password</label><br>
					<input type="password" id="pass" name="pass">
					<p id="err2" class="error"></p>
				</div>
				<div class="field-container">
					<button type="submit" id="login" name="login" class="button" onclick="return lValidate()">Submit</button>
				</div>
			</fieldset>
		</form>
	</div>
</div>

<?php

	require_once('includes/footer.php');

?>