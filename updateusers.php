<?php
	include_once("UTILITIES/config.php");
	include_once("UTILITIES/dbutils.php");
	
	foreach($_POST as $key => $value){
		if($value){
		//echo $key . "	" . $value . "<br>";
		$db = connectDB($DBHost,$DBUser,$DBPasswd,$DBName);
		$query = "UPDATE Users SET AccountType = $value WHERE UserID = $key;";
		queryDB($query, $db);
		}
	}
	header("Location: http://webdev.divms.uiowa.edu/~ngramer/project/admindash.php?update=1")
?>
