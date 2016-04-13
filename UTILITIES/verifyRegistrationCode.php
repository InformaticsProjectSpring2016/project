<?php
	include_once('config.php');
	include_once('dbutils.php');
	$db = connectDB($DBHost,$DBUser,$DBPasswd,$DBName);
	//if(isset($_SESSION['Cell']) && isset($_POST['code'])){
		$Cell = $_SESSION['Cell'];
		$db = connectDB($DBHost,$DBUser,$DBPasswd,$DBName);
		$query = "select Token from SMSTokens where Cell = '$Cell';";
		$result = queryDB($query,$db);
		echo mysqli_fetch_row($result);
		if(nTuples($result) > 0){
			$row = mysqli_fetch_row($result);
			if($row = $_Post['code']){
				Echo "Congrats, You've registered! Please login now";
				session_destroy();
				header("Refresh: 3; url=http://webdev.divms.uiowa.edu/~ngramer/project/login.php");
		}
		}
/* 	}else{
		echo "no";
	} */
	
?>