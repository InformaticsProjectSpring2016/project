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
if(isset($_SESSION['username'])){
	$loggedIn = True;
}
else {
	$loggedIn = False;
}
include_once("UTILITIES/config.php");
?>


<body>
	<h2> &nbsp&nbsp Anti Wage Theft </h2>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		  <ul class="nav navbar-nav">
			<li class="active"><a href="#">Home <span class="sr-only">(current)</span></a></li>
			<li><a href="#">My Data</a></li>
			<li class="dropdown">
			  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
			  <ul class="dropdown-menu">
				<li><a href="#">Action</a></li>
				<li><a href="#">Another action</a></li>
				<li><a href="#">Something else here</a></li>
				<li role="separator" class="divider"></li>
				<li><a href="#">Separated link</a></li>
				<li role="separator" class="divider"></li>
				<li><a href="#">One more separated link</a></li>
			  </ul>
			</li>
		  </ul>
		  
		  <ul class="nav navbar-nav navbar-right">
			<li><a href="#">Link</a></li>
			<li class="dropdown">
			  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
			  <ul class="dropdown-menu">
				<li><a href="#">Action</a></li>
				<li><a href="#">Another action</a></li>
				<li><a href="#">Something else here</a></li>
				<li role="separator" class="divider"></li>
				<li><a href="#">Separated link</a></li>
			  </ul>
			</li>
		  </ul>
		</div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
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
