<?php
	$menuHighlight = 0;
	$pageTitle="Register";
	include_once("header.php");
	include_once("UTILITIES/config.php");
	include_once("UTILITIES/dbutils.php");
	ob_start( );
?>


<div class = "col-xs-2"></div> <!-- Used to push jumbotron smaller and to the right -->
<div class = "col-xs-8">
<div class="text-center">
	<div class="container">
	<!-- jumbotron-->
	<div class="jumbotron">

		<div class="text-center">
			<h1>Register Your Employment</h1>
			<p class="lead">Please enter employment your information below.</p>
			
		<form id="Employment" action="<?php echo $_SERVER['PHP_SELF'];?>" class="form-horizontal" method="post">
			<div class="row">
				<div class="form-group">
					<label class="col-sm-2 control-label">Employer</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" placeholder="Employer" name="Name" required>
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="form-group">
					<label class="col-sm-2 control-label">Employer Street Address</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" placeholder="Street Address" name="EmployerAddress" required>
					</div>
				</div>
			</div>
								
			<div class="row">
				<div class="form-group">
					<label class="col-sm-2 control-label">Hourly Wage</label>
					<div class="col-sm-8">
						<input type="number" class="form-control" placeholder="$x.xx" name="HourlyWage" required>
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="form-group">
					<label class="col-sm-2 control-label">Normal Hours Worked</label>
					<div class="col-sm-8">
						<input type="number" class="form-control" placeholder="Standard Number of Hours worked per day" name="StdHours" required>
					</div>
				</div>
			</div>
			
			<button type="submit" class="btn btn-success btn-lg" name="submit">Register</button>
		</form>
		</div>
	</div> <!-- Jumbotron -->
	</div> <!-- Container -->
</div>
</div>
<?php
if(isset($_POST['Name'])){
	$db = connectDB($DBHost,$DBUser,$DBPasswd,$DBName);
	$Name = mysqli_real_escape_string($db, $_POST['Name']);
	$EmployerAddress = mysqli_real_escape_string($db, $_POST['EmployerAddress']);
	$HourlyWage = mysqli_real_escape_string($db, $_POST['HourlyWage']);
	$StdHours = mysqli_real_escape_string($db, $_POST['StdHours']);
	
	
	$query = "Select * from Employers where Name = '$Name' and Location = '$EmployerAddress';";
	$result = queryDB($query, $db);	
	$UserName = $_SESSION['Username'];
	if(nTuples($result) == 0){
		$query = "insert into Employers (Name, Location) VALUES ('$Name','$EmployerAddress');";
		$result = queryDB($query, $db);
		$query = "Select UserID from Users where Username = '$UserName';";
		$result = queryDB($query, $db);
		$row = mysqli_fetch_row($result);
		$UserID = $row[0];
		$query = "Select EmployerID from Employers where Name = '$Name' and Location = '$EmployerAddress';";
		$result = queryDB($query, $db);	
		$row = mysqli_fetch_row($result);
		$EmployerID = $row[0];
		$query = "insert into UsersEmployment (EmployerID, HourlyWage, StandardHours, UserID) VALUES ('$EmployerID','$HourlyWage','$StdHours','$UserID');";
		$result = queryDB($query, $db);
	}else{
		$query = "Select UserID from Users where Username = '$UserName';";
		$result = queryDB($query, $db);
		$row = mysqli_fetch_row($result);
		$UserID = $row[0];
		$query = "Select EmployerID from Employers where Name = '$Name' and Location = '$EmployerAddress';";
		$result = queryDB($query, $db);	
		$row = mysqli_fetch_row($result);
		$EmployerID = $row[0];
		$query = "insert into UsersEmployment (EmployerID, HourlyWage, StandardHours, UserID) VALUES ('$EmployerID','$HourlyWage','$StdHours','$UserID');";
	}
	
	header("Refresh: 0 http://webdev.divms.uiowa.edu/~ngramer/project/");
}
?>

<?php
	ob_end_flush( );
	include_once("footer.php");
?>
