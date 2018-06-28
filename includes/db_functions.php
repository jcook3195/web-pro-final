<?php

// Function for logging user in
function login($email, $pass) {
	include("connection.php");

	$sql = "SELECT * FROM persons ";
	$sql .= "WHERE persEmail = ? ";
	$sql .= "AND persPassword = ? ";
	$sql .= "LIMIT 1";

	if($statement = $con->prepare($sql)) {
		$statement->bind_param("ss", $email, $pass);
		$statement->execute();
		$statement->store_result();
		$num_row = $statement->num_rows;
		$statement->bind_result($userid, $email, $pass, $fname, $lname, $phone, $office, $deptid);
		$statement->fetch();
		$statement->close();
	} else die("Query failed.");

	if($num_row === 1) {
		$_SESSION['fname'] = $fname;
		$_SESSION['lname'] = $lname;
		$_SESSION['login'] = true;
		return true;
	}

	mysqli_close($con);
}

// Function to log user out
function logout() {
	unset($_SESSION['login']);
	$isLoggedIn = false;
}

// Returns list of department names
function getDepartments() {
	include("connection.php");

	$sql = "SELECT deptID, deptName FROM departments";
	$result = mysqli_query($con, $sql) or die(mysqli_errno());

	$string = "<ul class='dept-list'>";
	while($row = mysqli_fetch_array($result)) {
		$deptID = $row['deptID'];
		$deptName = $row['deptName'];
		$string .= "<li><a href='department.php?id=".$deptID."'>".$deptName."</a></li>";
	}
	$string .= "</ul>";

	echo $string;
	mysqli_close($con);
}

// Gets department options for register form
function getDeptOptions() {
	include("connection.php");

	$sql = "SELECT deptID, deptName FROM departments";
	$result = mysqli_query($con, $sql) or die(mysqli_errno());

	$string = "<select id='persdept' name='persdept'>";
	$string .= "<option value=''>Select</option>";
	while($row = mysqli_fetch_array($result)) {
		$deptID = $row['deptID'];
		$deptName = $row['deptName'];

		$string .= "<option value='".$deptID."'>".$deptName."</option>"; 
	}
	$string .= "</select>";

	echo $string;
	mysqli_close($con);
}

// Returns list of employees and their departments
function getEmployees() {
	include("connection.php");

	$sql = "SELECT p.persFName, p.persLName, p.persPhone, p.persDept, d.deptID, d.deptName ";
	$sql .= "FROM persons p ";
	$sql .= "INNER JOIN departments d ON ";
	$sql .= "p.persDept = d.deptID";

	$result = mysqli_query($con, $sql) or die(mysqli_errno());

	$string = "<table class='pers-table'><thead>";
	$string .= "<tr><th>Employee</th><th>Department</th><th>Phone #</th></tr></thead>";
	$string .= "<tbody>";
	while($row = mysqli_fetch_array($result)) {
		$persName = $row['persFName'] ." ". $row['persLName'];
		$dept = $row['deptName'];
		$phone = $row['persPhone'];

		$string .= "<tr>";
		$string .= "<td>".$persName."</td><td>".$dept."</td><td>".$phone."</td>";
		$string .= "</tr>";
	}
	$string .= "</tbody></table>";

	echo $string;
	mysqli_close($con);
}

// Update department record
function updateDepartment($deptID, $deptName, $deptPhone, $deptEmail, $deptOffice) {
	include("connection.php");
	$sql = "UPDATE departments SET deptName = ?, deptPhone = ?, deptEmail = ?, deptOffice = ? ";  
	$sql .= "WHERE deptID= ?";
	$statement = $con->prepare($sql);
	$statement->bind_param("ssssi",
		$deptName, $deptPhone, $deptEmail, $deptOffice, $deptID
	);
	$statement->execute();
	if(mysqli_affected_rows($con) == 1) {
		$_SESSION['error'] = "<p class='status-msg'><span class='success-msg'>Department successfully updated.</span></p>";
		header("Location: dashboard.php");
		exit();
	} else {
		echo "There was an error processing your request. Please try again.";
		echo mysqli_error($con);
	}
	mysqli_close($con);
}

// Add new person
function addPerson($persEmail, $persPassword, $persFName, $persLName, $persPhone, $persOffice, $persDept) {
	include "connection.php";
	$sql = "INSERT INTO persons (persEmail, persPassword, persFName, persLName, persPhone, persOffice, persDept) ";  
	$sql .= "VALUES (?, ?, ?, ?, ?, ?, ?)";
	$statement = $con->prepare($sql);
	$statement->bind_param("ssssssi",
		$persEmail, $persPassword, $persFName, $persLName, $persPhone, $persOffice, $persDept
	);
	$statement->execute();
	if(mysqli_affected_rows($con) == 1) {
		mysqli_insert_id($con);
		$_SESSION['error'] = "<span class='success-msg'>User successfully registered, please login here.</span>";
		header("Location: login.php");
		exit();
	} else {
		echo "There was an error processing your request. Please try again.";
		echo mysqli_error($con);
	}
	mysqli_close($con);
}

?>