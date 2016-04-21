<?php
	$menuHighlight = 0;
	$pageTitle="Enter Hours";
	include_once("UTILITIES/config.php");
	include_once("UTILITIES/dbutils.php");
	session_start();
	if(isset($_POST['EntryDate'])){
		$db = connectDB($DBHost,$DBUser,$DBPasswd,$DBName);
		
		$EntryDate = mysqli_real_escape_string($db, $_POST['EntryDate']);
		$HoursWorked = mysqli_real_escape_string($db, $_POST['HoursWorked']);
		$EmployerID = mysqli_real_escape_string($db, $_POST['EmployerID']);
		$Username = $_SESSION['Username'];
		
		/* Get UserID */
		$UserID = $_SESSION["UserID"];
		
		$query = "Insert INTO WageDataEntries (EntryDate,HoursWorked,UserID,EmployerID) VALUES ('$EntryDate','$HoursWorked','$UserID','$EmployerID');";
		$result = queryDB($query, $db);
		
		header("Location: http://webdev.divms.uiowa.edu/~ngramer/project/?Hours=1");
	}else{
		echo "not set";
	}
?>

