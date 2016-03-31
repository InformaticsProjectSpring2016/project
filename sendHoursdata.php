<?php

	$menuHighlight = 0;
	$pageTitle="Report Hours";
	include_once("header.php");
	
if (isset($_POST['submit'])) {

    /* check if phone number is valid */
    $hours_worked = $_POST['cell'];

    if (empty($hours_worked)) {
        exit("Hours worked cannot be blank.");
    }

    if (empty($employer)) {
		exit("Employer cannot be blank.");
	}
	

?>
 
<?php
	include_once("footer.php");
?>
