<?php
	session_start();
    if(isset($_SESSION['Username'])) {
        session_unset();
    }
    session_destroy(); 
    
    // redirect user to login page
    header("Location: http://webdev.divms.uiowa.edu/~ngramer/project/");
?>