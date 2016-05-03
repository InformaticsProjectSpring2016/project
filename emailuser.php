<?php
SESSION_START();
/* Check for a logged in administrator or nonprofit */
if($_SESSION['AccountType'] != 0 AND $_SESSION['AccountType'] != 1  && isset($_SESSION['Username'])){	
	header("Location: http://webdev.divms.uiowa.edu/~ngramer/project/index.php?authorized=0");
}
if(!isset($_SESSION['Username'])){
	header("Location: http://webdev.divms.uiowa.edu/~ngramer/project/login.php?authorized=0");
}

if(isset($_POST)){
	if(mail($_POST['Email'], $_POST['Subject'], $_POST['Message'])){
		header("Location: http://webdev.divms.uiowa.edu/~ngramer/project/nonprofitdash.php?Email=0");
	}else{
		header("Location: http://webdev.divms.uiowa.edu/~ngramer/project/nonprofitdash.php?Email=1");
	}
	}else{
		echo "NOOOO";
}
?>