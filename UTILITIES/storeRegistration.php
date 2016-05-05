<?php
ob_start();
	$menuHighlight = 0;
	$pageTitle="Register";
	include_once('config.php');
	include_once('dbutils.php');
	// This loads the SendSMS Function
	include_once('../sendRegistration.php');
	// get a handle to the database
	$db = connectDB($DBHost,$DBUser,$DBPasswd,$DBName);
	if(isset($_POST['Cell'])){
		$Username = mysqli_real_escape_string($db, $_POST['Username']);
		$Firstname = mysqli_real_escape_string($db, $_POST['Firstname']);
		$Lastname = mysqli_real_escape_string($db, $_POST['Lastname']);
		$Password1 = mysqli_real_escape_string($db, $_POST['Password1']);
		$Password2 = mysqli_real_escape_string($db, $_POST['Password2']);
		$Cell = mysqli_real_escape_string($db, $_POST['Cell']);
		$Age = mysqli_real_escape_string($db, $_POST['Age']);
		$Email = mysqli_real_escape_string($db, $_POST['Email']);
		$Password = crypt($Password1);
		$query = "SELECT COUNT(UserID) FROM Users WHERE Username = '$Username';";
		if(mysql_fetch_row(queryDB($query,$db))[0]>0){
			header("Location: http://webdev.divms.uiowa.edu/~ngramer/project/register.php?username=1");
		}else{
			if($Password1 == $Password2){
				$token = SendSMS($Cell);
				$query = "insert into SMSTokens (Cell, Token) VALUES ('$Cell','$token');";
				$result = queryDB($query,$db);
				$query = "insert into Users (Username, FirstName, LastName, UserPassword, Phone, Age,Email) VALUES ('$Username','$Firstname','$Lastname','$Password','$Cell','$Age','$Email');";
				$result = queryDB($query, $db);	
				header('Location: http://webdev.divms.uiowa.edu/~ngramer/project/verifySMS.php?number='.$Cell);
			}else{
				header("Location: http://webdev.divms.uiowa.edu/~ngramer/project/register.php?password=1");
			}
		}
		

	} else {
		die();
	}
	
ob_flush();
 
?>

