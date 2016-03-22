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

<body>
	<!-- Beginning of bootstrap -->
	<div class = "container">
		<!-- header -->
		<div class = "page-header">
			<ul class="nav nav-pills pull-right">
				<li role="presentation" <?php if($menuHighlight == 0) { echo 'class="active"';} ?>><a href="/~ngramer/project/">Home</a></li>
				<!--<li role="presentation" <?php if($menuHighlight == 1) { echo 'class="active"';} ?>><a href="/~ngramer/hw2/info/">About Keyboards</a></li>
				<li role="presentation" <?php if($menuHighlight == 2) { echo 'class="active"';} ?>><a href="/~ngramer/hw2/pricing/">Pricing</a></li> -->
			</ul>
			<h2>AntiWage THEFT</h2>
		</div> <!-- Closing Header-->