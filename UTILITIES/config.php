<?php
// Get current user
$User = get_current_user();

// Server information.
$Proto = "http://";
$Host = $_SERVER['SERVER_NAME'];
$BaseUrl = "/~" .$User. "/project";



// DB connection (from  mysql_db_info file).
$DBUser = "ngramer";
$DBName = "db_" . $User;
$DBHost = "dbdev.cs.uiowa.edu";
$DBPassword = "U5GMzDSTchGY";
?>
