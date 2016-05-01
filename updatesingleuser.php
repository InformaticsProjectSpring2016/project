<?php
	include_once("UTILITIES/config.php");
	include_once("UTILITIES/dbutils.php");
	
	$db = connectDB($DBHost,$DBUser,$DBPasswd,$DBName);
	$UserID = mysqli_real_escape_string($db, $_POST["UserID"]);
	if($_POST['Firstname']){
		echo $UserID;
		$Firstname = mysqli_real_escape_string($db, $_POST['Firstname']);
		$query = "UPDATE Users SET FirstName = '$Firstname' where UserID = '$UserID';";
			
		// execute sql statement
		$result = queryDB($query, $db);
		$updated=true;

	}
	if($_POST['Lastname']){
		$Lastname = mysqli_real_escape_string($db, $_POST['Lastname']);
		$query = "UPDATE Users SET LastName = '$Lastname' where UserID = '$UserID';";
			
		// execute sql statement
		$result = queryDB($query, $db);	
		$updated=true;
	}
	if($_POST['AccountType']){
		$AccountType = mysqli_real_escape_string($db, $_POST['AccountType']);
		$query = "UPDATE Users SET AccountType = '$AccountType' where UserID = '$UserID';";
			
		// execute sql statement
		$result = queryDB($query, $db);	
		$updated=true;
	}
	if($_POST['Email']){
		$Email = mysqli_real_escape_string($db, $_POST['Email']);
		$query = "UPDATE Users SET Email = '$Email' where UserID = '$UserID';";
			
		// execute sql statement
		$result = queryDB($query, $db);
		$updated=true;
	}
	if($updated){
		header("Location: http://webdev.divms.uiowa.edu/~ngramer/project/admindash.php?update=1");
	}
	
	
?>