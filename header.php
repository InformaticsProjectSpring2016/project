<html>
<title><?php echo $pageTitle;?></title>
<head>
<!-- my css file to change up the container width -->
<link rel="stylesheet" href= "http://webdev.divms.uiowa.edu/~ngramer/project/mycss.css">

<!-- Latest compiled and minified CSS replacement bootstrap.min.css from bootswatch -->
<link rel="stylesheet" href="http://webdev.divms.uiowa.edu/~ngramer/project/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet/less" type="text/css" href="http://webdev.divms.uiowa.edu/~ngramer/project/bootstrap/bootswatch.less"> 
<link rel="stylesheet/less" type="text/css" href="http://webdev.divms.uiowa.edu/~ngramer/project/bootstrap/variables.less"> 
<script src="http://webdev.divms.uiowa.edu/~ngramer/project/bootstrap/less.min.js"></script>

<!-- add animate -->
<link rel="stylesheet" href= "http://webdev.divms.uiowa.edu/~ngramer/project/animate.css">

<!-- date picking -->
<link rel="stylesheet" href="http://webdev.divms.uiowa.edu/~ngramer/project/datepicker/css/bootstrap-datepicker.css">

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.js"></script>
 
<!-- Latest compiled and minified JavaScript -->
<script src="http://webdev.divms.uiowa.edu/~ngramer/project/bootstrap/js/bootstrap.min.js"></script>

<script src="http://webdev.divms.uiowa.edu/~ngramer/project/datepicker/js/bootstrap-datepicker.js"></script>
<script src="http://webdev.divms.uiowa.edu/~ngramer/project/datepicker/locales/bootstrap-datepicker.en-GB.min.js" charset="UTF-8"></script>


<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<meta name="google-site-verification" content="2zYKJQnP6p47kekwBybCv97I3UcBso-qF7A3LJvnd44" />
</head>

<!-- Check if user is logged in and include PHP configuration -->
<?php
include_once("UTILITIES/config.php");
include_once("UTILITIES/dbutils.php");
session_start();
if(isset($_SESSION['Username'])){
	$loggedIn = True;
	$UserID = $_SESSION['UserID'];
	$db = connectDB($DBHost,$DBUser,$DBPasswd,$DBName);
	$query = "Select AccountType from Users where UserID = '$UserID';";
	$AccountType = mysqli_fetch_row(queryDB($query, $db))[0];
}
else {
	$loggedIn = False;
}
?>


<body>
	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-76341761-1', 'auto');
	  ga('send', 'pageview');

	</script>

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
				<li><a href="userdash.php">My Data</a></li>';
		}?>
		</ul>
		<ul class="nav navbar-nav navbar-right">
		<?php
		if(!$loggedIn){
			echo '
			<li><a href="login.php"><span class="glyphicon glyphicon-lock"></span> Login</a></li>
			<li><a href="register.php"><span class="glyphicon glyphicon-user"></span> Register</a></li>';
		}else{
			/* Non-Profit */	
			if($AccountType == 1){
				echo '<li><a href="nonprofitdash.php"><span class ="glyphicon glyphicon-home"></span>Non-Profit Dashboard</a></li>';
			}
			/* Admin */
			if($AccountType == 0){
				echo '
				<li><a href="admindash.php"><span class="glyphicon glyphicon-log-in"></span> Administrator</a></li>';
			}
			echo '<li><a href="logout.php"><span class="glyphicon glyphicon glyphicon-off"></span> Logout</a></li>';
		}
		?>
		</ul>
	  </div>
	</nav>
