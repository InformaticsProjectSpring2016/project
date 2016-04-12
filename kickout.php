<?php
// check if user logged in, if not, kick them to login.php
	session_start();
	if(!isset($_SESSION['Username'])) {
		// if this is not set, it means they are not logged in
		header("Location: http://webdev.divms.uiowa.edu/~ngramer/project/");
	}

?>

<?php
	include_once("UTILITES/config.php");
	include_once("UTILITES/dbutils.php");
?>
