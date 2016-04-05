<?php
	$menuHighlight = 0;
	$pageTitle="Login";
	include_once("header.php");
	include_once("UTILITIES/config.php");
	include_once("UTILITIES/dbutils.php");
?>


<div class = "col-xs-2"></div> <!-- Used to push jumbotron smaller and to the right -->
	<div class = "col-xs-8">
	<div class="text-center">
		<!-- jumbotron-->
		<div class="text-center">
			<div class="jumbotron">
				<h1>Login</h1>
				<p class="lead">Please enter your Username and Password below.</p>
				<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
					<div class="form-group">
						<!--<label for="Username">Username</label>-->
						<div class="input-group">	
							<div class="input-group-addon">Username</div>
							<input type="text" class="form-control" placeholder="Username" name="Username"/>
						</div>
					</div>
						
					<div class="form-group">
						<!--<label for="Password">Password</label>-->
						<div class="input-group">
							<div class="input-group-addon">Password</div>
							<input type="Password" class="form-control" placeholder="Password" name="Password"/>
						</div>
					</div>
					<!--
					<div class="form-group">
						<!--<label for="remember">remember</label>
						<span>
							<input type="checkbox" name="checkbox">
							<label for="checkbox">remember</label>
						</span>
					</div>
					-->
					<button type="submit" class="btn btn-success btn-lg" name="submit">Login</button>
				</form>
			</div><!-- Jumbotron -->
		</div> 
	</div>
</div>

<?php
	include_once("footer.php");
?>

<?php
	if(isset($_POST['Username']) && isset($_POST['Password'])){
		
		$Username = $_POST['Username'];
		$Password = $_POST['Password'];

		if(VerifyPassword($Username, $Password)){
			session_start();
			$_SESSION['Username'] = $Username;
			header("Location: http://webdev.divms.uiowa.edu/~ngramer/project/");
		} else {
			echo "Username and Password do not match";
			die();
		}
	}
?>
