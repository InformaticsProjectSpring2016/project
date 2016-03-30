<?php
	include_once('config.php');
	include_once('dbutils.php');
	// get a handle to the database
	$db = connectDB($DBHost,$DBUser,$DBPasswd,$DBName);

	$Username = mysqli_real_escape_string($db, $_POST['Username']);
	$Firstname = mysqli_real_escape_string($db, $_POST['Firstname']);
	$Lastname = mysqli_real_escape_string($db, $_POST['Lastname']);
	$Password = mysqli_real_escape_string($db, $_POST['Password']);
	$Cell = mysqli_real_escape_string($db, $_POST['Cell']);
	$Age = mysqli_real_escape_string($db, $_POST['Age']);
	$Employer = mysqli_real_escape_string($db, $_POST['Employer']);

	$Password = crypt($Password);
	// WILL NEED TO ADD EMPLOYER INTO EMPLOYERS TABLE IF DOESNT EXIST
	$query = "insert into Users (Username, Firstname, Lastname, UserPassword, Phone, Age) VALUES ('$Username','$Firstname','$Lastname','$Password','$Cell','$Age');";
	$result = queryDB($query, $db);
	if ($result) {
		echo "You were added to the database. Please login now.";
		include_once("login.php");
	} else {
		echo "something went wrong";
		die();
	}
?>
<?php

?>
