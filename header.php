<html>
<title><?php echo $pageTitle;?></title>
<head>
<!-- my css file to change up the container width -->
<link rel="stylesheet" href= "/webdev/hw1/mycss.css">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
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
	<nav class="navbar navbar-light" style="background-color: #e3f2fd">
	  <div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
				<span class="icon-bar"></span>
        			<span class="icon-bar"></span>
        			<span class="icon-bar"></span> 
      			</button>
		  <a class="navbar-brand" href="index.php">Anti Wage Theft</a>
		</div>
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

	<!-- Beginning of bootstrap -->
	
	<!-- <div class = "container">
		<!-- header -->
		<!--<div class = "page-header">
			<ul class="nav nav-pills pull-right">
				<li role="presentation" <?php if($menuHighlight == 0) { echo 'class="active"';} ?>><a href=<?php echo '"'.$BaseUrl.'"';?>">Home</a></li>
				
				// <?php 
					//if(!$loggedIn){
						// echo '
						// <a href="' . $BaseUrl . '/login.php" class="btn btn-success" role="button">Login</a>
						// <a href="' . $BaseUrl . '/register.php" class="btn btn-info" role="button">Register</a>';
					// }
					// else {
						// echo '<a href="' . $BaseUrl . '/logout.php" class="btn btn-warning" role="button">Logout</a>';
					// }
				// ?>
			</ul>
			<h2>Anti Wage Theft</h2>
		</div> <!-- Closing Header-->
