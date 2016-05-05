<?php 
	//include_once("header.php");
	$menuHighlight = 0;
	$pageTitle="Enter Hours";
	include_once("UTILITIES/config.php");
	include_once("UTILITIES/dbutils.php");
	session_start();
	if(isset($_POST)){
		$db = connectDB($DBHost,$DBUser,$DBPasswd,$DBName);
		$EntryDate = mysqli_real_escape_string($db, $_POST['EntryDate']);
		$HoursWorked = mysqli_real_escape_string($db, $_POST['HoursWorked']);
		$EmployerID = mysqli_real_escape_string($db, $_POST['EmployerID']);
		$UserID = $_SESSION["UserID"];
		$Type = mysqli_real_escape_string($db, $_POST['type']);
/* 		if(isset($_POST['EntryID'])){
			foreach($_POST['EntryID'] as $Entry){
			echo $Entry ."<br>";
		}
			if($Type == 'replace' && isset($_POST['EntryID'])){echo "true";}
			$EntryID = mysqli_real_escape_string($db, $_POST['EntryID']);
			echo $EntryID[0];
		} 
		/*  */
		
		if($Type == "addition"){
			$query = "Insert INTO WageDataEntries (EntryDate,HoursWorked,UserID,EmployerID) VALUES ('$EntryDate','$HoursWorked','$UserID','$EmployerID');";
			$result = queryDB($query, $db);
			
			header("Location: http://webdev.divms.uiowa.edu/~ngramer/project/?Hours=1");
		}
		if($Type == "replace" && isset($_POST['EntryID'])){
			foreach($_POST['EntryID'] as $Entry){
				$query = "DELETE FROM WageDataEntries where EntryID = '$Entry';";
				$result = queryDB($query, $db);
			}
			
			$query = "Insert INTO WageDataEntries (EntryDate,HoursWorked,UserID,EmployerID) VALUES ('$EntryDate','$HoursWorked','$UserID','$EmployerID');";
			$result = queryDB($query, $db);
			header("Location: http://webdev.divms.uiowa.edu/~ngramer/project/?Hours=1");
		}
		if($Type == "replace" && !isset($_POST['EntryID'])){
			header("Location: http://webdev.divms.uiowa.edu/~ngramer/project/enterhoursdata.php?checked=0");
		}
		//echo"$Type"; */
	}Else{
		echo"no";
	}
?>