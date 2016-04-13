<?php
	$menuHighlight = 0;
	$pageTitle="Enter Paycheck";
	include_once("UTILITIES/config.php");
	include_once("UTILITIES/dbutils.php");
	session_start();
	if(isset($_POST['PayPeriodStart'])){
		$db = connectDB($DBHost,$DBUser,$DBPasswd,$DBName);
		
		$PayPeriodStart = mysqli_real_escape_string($db, $_POST['PayPeriodStart']);
		$PayPeriodEnd = mysqli_real_escape_string($db, $_POST['PayPeriodEnd']);
		$HoursPaid = mysqli_real_escape_string($db, $_POST['HoursPaid']);
		$AmountPaid = mysqli_real_escape_string($db, $_POST['AmountPaid']);
		$EmployerID = mysqli_real_escape_string($db, $_POST['EmployerID']);
		$Username = $_SESSION['Username'];
		
		/* Get UserID */
		$query = "Select UserID from Users where Username = '$Username';";
		$result = queryDB($query, $db);
		$row = mysqli_fetch_row($result);
		$UserID = $row[0];
		
		$query = "Insert INTO PaycheckData (PayPeriodStart,PayPeriodEnd,HoursPaid,AmountPaid,UserID,EmployerID) VALUES ('$PayPeriodStart','$PayPeriodEnd','$HoursPaid','$AmountPaid','$UserID','$EmployerID');";
		$result = queryDB($query, $db);
		
		header("Location: http://webdev.divms.uiowa.edu/~ngramer/project/?paycheck=1");
	}
?>

