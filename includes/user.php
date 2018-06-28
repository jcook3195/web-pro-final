<?php

class User {
	private $userid;
	private $email;
	private $pass;
	private $fname;
	private $lname;
	private $phone;
	private $office;
	private $deptid;

	// Constructor
	public function __construct($uArray) {
		if(isset($uArray[$userid])) {
			$this->userid = $uArray["userid"];
		}
		$this->email 		= $uArray["email"];
		$this->pass 		= $uArray["pass"];
		$this->fname 		= $uArray["fname"];
		$this->lname 		= $uArray["lname"];
		$this->phone 		= $uArray["phone"];
		$this->office 		= $uArray["office"];
		$this->deptid 		= $uArray["deptid"];
	}

	// Get the values for the user
	public function getValues() {
		$uArray = array(
			"userid"		=> $this->userid,
			"email"			=> $this->email,
			"pass"			=> $this->pass,
			"fname"			=> $this->fname,
			"lname"			=> $this->lname,
			"phone"			=> $this->phone,
			"office"		=> $this->office,
			"deptid"		=> $this->deptid
		);
		return $uArray;
	}

	// Login existing user
	/*public function loginUser($email="", $pass="") {
		include "connection.php";
		$sql = "SELECT * FROM persons ";
		$sql .= "WHERE email = ? ";
		$sql .= "AND password = ? ";
		$sql .= "LIMIT 1";
		$statement = $con->prepare($sql);
		$statement->bind_param("ss", '{email}', '{pass}');
		$statement->execute();
		if (mysqli_connect_errno()) {
			echo "User login failed";
		} else {
			redirect_to('dashboard.php');
		}
		mysqli_close($con);
	}

	// Register new user
	public function registerUser() {

	}

	$user = new User();*/
}

?>