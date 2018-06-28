<?php
	
	session_start();
	$title = "Update Department";
	$bdyClass = "dept";
	require_once('includes/header.php');
	require_once('includes/db_functions.php');

?>

<div class="tool-bar">
	<div class="message-container one-half first">
		<?php echo '<p class="welcome-msg">Welcome, '.$_SESSION['fname'].' '.$_SESSION['lname'].'.</p>'; ?>
	</div>
	<div class="logout-container one-half right">
		<form method="post" action="login.php">
			<input type="submit" value="Logout" id="logout" name="logout" class="button logout-button">
		</form>
	</div>
	<div class="clear"></div>
</div>
<div class="content-container">

<?php

if(isset($_POST["update"])) {
	$deptID = $_POST['deptid'];
	$deptName = $_POST['deptname'];
	$deptPhone = $_POST['deptphone'];
	$deptEmail = $_POST['deptemail'];
	$deptOffice = $_POST['deptoffice'];
	updateDepartment($deptID, $deptName, $deptPhone, $deptEmail, $deptOffice);
}

if(isset($_GET["id"])) {
		include "includes/connection.php";

		$sql = "SELECT * FROM departments WHERE deptID=?";
		$statement = $con->prepare($sql);
		$statement->bind_param("i", $_GET["id"]);
		$statement->execute();

		$result = $statement->get_result();
		while($row = $result->fetch_assoc()) {
			$deptID = $row["deptID"];
			$deptName = $row["deptName"];
			$deptPhone = $row["deptPhone"];
			$deptEmail = $row["deptEmail"];
			$deptOffice = $row["deptOffice"];
		}

		mysqli_close($con);

?>
	<form method="post" id="dept-form">
	<fieldset>
		<input type="hidden" id="deptid" name="deptid" value="<?php echo $deptID; ?>">
		<div class="field-container">
			<label for="deptname">Department Name</label><br>
			<input type="text" id="deptname" name="deptname" value="<?php echo $deptName; ?>">
		</div>
		<div class="field-container">
			<label for="deptphone">Phone Number</label><br>
			<input type="text" id="deptphone" name="deptphone" value="<?php echo $deptPhone; ?>">
		</div>
		<div class="field-container">
			<label for="deptemail">Email</label><br>
			<input type="email" id="deptemail" name="deptemail" value="<?php echo $deptEmail; ?>">
		</div>
		<div class="field-container">
			<label for="deptoffice">Office Address</label><br>
			<input type="text" id="deptoffice" name="deptoffice"  value="<?php echo $deptOffice; ?>">
		</div>
		<div class="submit-container clear">
			<input type="submit" value="Update" id="update" name="update" class="button">
		</div>
	</fieldset>
</form>

<?php

}

?>

<p><a href="dashboard.php" class="button">Back to Dash</a></p>
</div>

<?php

	require_once('includes/footer.php');

?>