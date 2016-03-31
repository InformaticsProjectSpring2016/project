<?php
	include_once('config.php');
	include_once('dbutils.php');
	// get a handle to the database
	$db = connectDB($DBHost,$DBUser,$DBPasswd,$DBName);

	$Username = mysqli_real_escape_string($db, $_POST['Username']);
	$Firstname = mysqli_real_escape_string($db, $_POST['Firstname']);
	$Lastname = mysqli_real_escape_string($db, $_POST['Lastname']);
	$Password = mysqli_real_escape_string($db, $_POST['Password1']);
	$Cell = mysqli_real_escape_string($db, $_POST['Cell']);
	$Age = mysqli_real_escape_string($db, $_POST['Age']);
	$Employer = mysqli_real_escape_string($db, $_POST['Employer']);
	$Email = mysqli_real_escape_string($db, $_POST['Email']);
	$Password = crypt($Password);
	// WILL NEED TO ADD EMPLOYER INTO EMPLOYERS TABLE IF DOESNT EXIST
	$query = "insert into Users (Username, FirstName, LastName, UserPassword, Phone, Age,Email) VALUES ('$Username','$Firstname','$Lastname','$Password','$Cell','$Age','$Email');";
	$result = queryDB($query, $db);
	if ($result) {
		echo "You were successfully registered! Please login now.";
		header('Refresh: 2; url=../login.php');
	} else {
		echo "something went wrong";
		die();
	}
?>
<?php

?>
