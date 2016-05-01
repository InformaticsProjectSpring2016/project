<?php
	$menuHighlight = 0;
	$pageTitle="Login";
	include_once("header.php");
	include_once("UTILITIES/config.php");
	include_once("UTILITIES/dbutils.php");
?>



<div class ="container">
<div class = "col-xs-12">
	<!-- jumbotron--> 
	<div class="jumbotron">
		<div class="text-center">
			<h1>Login</h1>
			<p class="lead">Please enter your Username and Password below.</p>
			<?php
				if($_GET["register"] == "1"){
					echo '<div class="alert alert-success" role="alert">Welcome! Please login now.</div>';
				}
				if($_GET["authorized"] == "0"){
					echo '<div class="alert alert-danger animated fadeIn" role="alert">You are not authorized to view this page. Please log in and try again.</div>';
				}
			?>
			
			<form action="<?php echo $_SERVER['PHP_SELF'];?>" class="form-horizontal" method="post">
			
				<?php
					if(isset($_POST['Username']) && isset($_POST['Password'])){
						
						$db = connectDB($DBHost,$DBUser,$DBPasswd,$DBName);
						$Username = mysqli_real_escape_string($db, $_POST['Username']);
						$Password = mysqli_real_escape_string($db, $_POST['Password']);
						
						if(VerifyPassword($Username, $Password)){
							session_start();
							
							/* Set Username, Name, AccountType,, and UserID in Session variables */
							$_SESSION['Username'] = $Username;
							
							$query = "Select UserID from Users where Username = '$Username';";
							$_SESSION['UserID'] = mysqli_fetch_row(queryDB($query, $db))[0];
							
							$query = "Select AccountType from Users where Username = '$Username';";
							$_SESSION['AccountType'] = mysqli_fetch_row(queryDB($query, $db))[0];
							
							$query = "Select FirstName from Users where Username = '$Username';";
							$_SESSION['FirstName'] = mysqli_fetch_row(queryDB($query, $db))[0];
							
							/* Check for active employers */
							$query = "SELECT * FROM UsersEmployment WHERE UserID = (SELECT UserID from Users where Username = '$Username');";
							$result = queryDB($query, $db);	
							if(nTuples($result) == 0 && $_SESSION['AccountType'] != 0){
								header("Location: http://webdev.divms.uiowa.edu/~ngramer/project/addemployment.php");
							}else{
								header("Location: http://webdev.divms.uiowa.edu/~ngramer/project/");	
							}
							
						} else {
							echo '<div class="alert alert-danger" role="alert">Username and Password do not match</div>';
						}
					}
				?>
				<div class="row">
					<div class="form-group">
						<label class="col-sm-2 control-label">Username</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" placeholder="Username" name="Username"/>
						</div>
					</div>
				</div>
					
				<div class="row">
					<div class="form-group">
						<label class="col-sm-2 control-label">Password</label>
						<div class="col-sm-8">
							<input type="Password" class="form-control" placeholder="Password" name="Password"/>
						</div>
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
		</div>
	</div><!-- Jumbotron -->
	</div>
</div> <!-- container -->



<?php
	include_once("footer.php");
?>


