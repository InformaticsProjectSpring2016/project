<?php

	$menuHighlight = 0;
	$pageTitle="Register";
	include_once("../header.php");
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
		$Password = mysqli_real_escape_string($db, $_POST['Password1']);
		$Cell = mysqli_real_escape_string($db, $_POST['Cell']);
		$Age = mysqli_real_escape_string($db, $_POST['Age']);
		$Email = mysqli_real_escape_string($db, $_POST['Email']);
		$Password = crypt($Password);

		/* $token = SendSMS($Cell);
		$query = "insert into SMSTokens (Cell, Token) VALUES ('$Cell','$token');";
		$result = queryDB($query,$db); */

	} else {
		die();
	}
	
	$query = "insert into Users (Username, FirstName, LastName, UserPassword, Phone, Age,Email) VALUES ('$Username','$Firstname','$Lastname','$Password','$Cell','$Age','$Email');";
	$result = queryDB($query, $db);	
	
	header("Refresh: 3; url=http://webdev.divms.uiowa.edu/~ngramer/project/login.php?register=1")
?>

	<div class="jumbotron">
		<div class="text-center">
			<form action="verifyRegistrationCode.php" method="post">
				<div class="form-group">
					<div class="input-group">	
						<div class="input-group-addon">Registration Code</div>
						<input type="number" class="form-control" placeholder="Enter the registration code sent to your phone." name="code"/>
					</div>
				</div>
				<button type="submit" class="btn btn-default" name="submit">Verify</button>
			</form>
		</div>
	</div>
<?php
	include_once("../footer.php");
?>

