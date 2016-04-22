<?php
	$menuHighlight = 0;
	$pageTitle="User Dashboard";
	include_once("header.php");
	include_once("UTILITIES/config.php");
	include_once("UTILITIES/dbutils.php");
?>

<div class = "container">
	<div class="text-center">
		<div class="jumbotron">
			<h1>User Dashboard</h1>
			<div class = "row">
				<div class="panel-body">
				<table class="table table-bordered table-striped">
				<h3>My Data Entries</h3>
					<!--columns-->
					<thead>
					  <tr>
						<th>User Name</th>
						<th>Entry Date</th>
						<th>Hours Worked</th>
						<th>Employer</th>
					  </tr>
					</thead>
					<!--rows-->
					<tbody>
					<?php

						// get a handle to the database
						$db = connectDB($DBHost,$DBUser,$DBPasswd,$DBName);
						// prep query
						$query = "Select u.FirstName, p.EntryDate, p.HoursWorked, e.Name from WageDataEntries p INNER JOIN Employers e ON (p.EmployerID = e.EmployerID) INNER JOIN Users u ON (p.UserID = u.UserID);";
							
						// execute sql statement
						$result = queryDB($query, $db);
						
						// check if it worked
						
						if (nTuples($result)> 0) {
						//output data of each row
							while($row = mysqli_fetch_row($result)) {
								echo "
								<tr>
									<th>". $row[0] . "</th>
									<th>" . $row[1] . "</th> 
									<th>" . $row[2] . "</th>
									<th>" . $row[3] . "</th>
								</tr>";
							}
						} else {
							echo "0 results";
						}

					?>
					</tbody>
				</table>
				
				<!--Add another job section-->
				<div class="text-center">
					<h2>Add Another Employer</h2>
					<p class="lead">Please enter employment your information below.</p>
					
				<form id="New Employment" action="<?php echo $_SERVER['PHP_SELF'];?>" class="form-horizontal" method="post">
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
			</div>
		</div> <!-- Jumbotron -->
	</div>
</div> <!-- Container -->

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
