<html>
<title><?php echo $pageTitle;?></title>
<head>
<!-- my css file to change up the container width -->
<link rel="stylesheet" href= "/webdev/hw1/mycss.css">

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="http://webdev.divms.uiowa.edu/~ngramer/project/bootstrap/css/bootstrap.min.css"

<!-- Optional theme -->

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>

<!-- Check if user is logged in and include PHP configuration -->
<?php
session_start();
if(isset($_SESSION['Username'])){
	$loggedIn = True;
}
else {
	$loggedIn = False;
}
include_once("UTILITIES/config.php");
?>


<body>
	<nav class="navbar navbar-default"> 
	  <div class="container-fluid">
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	      </button>
	      <a class="navbar-brand" href="index.php">Anti Wage Theft</a>
	    </div>
	    <div class="collapse navbar-collapse" id="myNavbar">
	      <ul class="nav navbar-nav">
		<?php
		if($loggedIn){
			echo '
				<li><a href="enterhoursdata.php">Report Hours Worked</a></li>
				<li><a href="enterpaycheckdata.php">Report Paycheck Data</a></li>
				<li><a href="userdash.php">My Data</a></li>
				<li><a href="nonprofitdash.php">Non-Profit</a></li>';
		}?>
		</ul>
		<ul class="nav navbar-nav navbar-right">
		<?php
		if(!$loggedIn){
			echo '
		  <li><a href="register.php"><span class="glyphicon glyphicon-user"></span> Register</a></li>';
		}else{
			echo '
		  <li><a href="logout.php"><span class="glyphicon glyphicon glyphicon-off"></span> Logout</a></li>';
		}
		?>
		  <li><a href="admindash.php"><span class="glyphicon glyphicon-log-in"></span> Administrator</a></li>
		</ul>
	  </div>
	</nav>
