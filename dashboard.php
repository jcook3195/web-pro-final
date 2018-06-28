<?php

	session_start();
	$title = "Employee Dashboard";
	$bdyClass = "dash";
	require_once('includes/header.php');
	require_once('includes/db_functions.php');

?>

<?php

if(isset($_POST['email']) && isset($_POST['pass'])) {
	$validLogin = login($_POST['email'], $_POST['pass']);
} else {
	$validLogin = false;
}

?>

<div class="tool-bar">
	<div class="message-container one-half first">
<?php

if ($validLogin || isset($_SESSION['login'])) {
	echo '<p class="welcome-msg">Welcome, '.$_SESSION['fname'].' '.$_SESSION['lname'].'.</p>';
	$isLoggedIn = true;
} else {
	$_SESSION['error'] = "Login information provided was incorrect.";
	header("Location: login.php");
	exit();
}

?>

<?php

	if(isset($_SESSION['error'])) {
		echo $_SESSION['error'];
		unset($_SESSION['error']);
	}
?>
	</div>
	<div class="logout-container one-half right">
		<form method="post" action="login.php">
			<input type="submit" value="Logout" id="logout" name="logout" class="button logout-button">
		</form>
	</div>
	<div class="clear"></div>
</div>

<div class="content-container">
	<div class="one-third first">
		<div class="dash-dept-container">
			<h3 class="center">All Departments</h3>
			<p class="center"><em>Click Department to edit</em></p>
			<div class="dept-list-container">
				<?php getDepartments(); ?>
			</div>
		</div>
	</div>
	<div class="two-thirds">
		<div class="dash-pers-container">
			<h3 class="center">Employee Information</h3>
			<?php getEmployees(); ?>
		</div>
	</div>
	<div class="clear"></div>
</div>

<?php

	require_once('includes/footer.php');

?>