<?php
	$menuHighlight = 0;
	$pageTitle="Enter Hours";
	include_once("UTILITIES/config.php");
	include_once("UTILITIES/dbutils.php");
	session_start();
	if(isset($_POST['HoursWorkedStart'])){
		$db = connectDB($DBHost,$DBUser,$DBPasswd,$DBName);
		
		$HoursWorkedStart = mysqli_real_escape_string($db, $_POST['HoursWorkedStart']);
		$HoursWorkedEnd = mysqli_real_escape_string($db, $_POST['HoursWorkedEnd']);
		$HoursWoked = mysqli_real_escape_string($db, $_POST['HoursWoked']);
		$EmployerID = mysqli_real_escape_string($db, $_POST['EmployerID']);
		$Username = $_SESSION['Username'];
		
		/* Get UserID */
		$query = "Select UserID from Users where Username = '$Username';";
		$result = queryDB($query, $db);
		$row = mysqli_fetch_row($result);
		$UserID = $row[0];
		
		$query = "Insert INTO HoursCheckData (HoursWorkedStart,HoursWorkedEnd,HoursWoked,UserID,EmployerID) VALUES ('$HoursWorkedStart','$HoursWorkedEnd','$HoursWoked','$UserID','$EmployerID');";
		$result = queryDB($query, $db);
		
		header("Location: http://webdev.divms.uiowa.edu/~ngramer/project/?Hours=1");
	}
?>
