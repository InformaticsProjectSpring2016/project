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
			<div>
				<form method="link" action="addemployment.php"> 
					<input type="submit" class="btn btn-danger btn-lg" value="Add Another Job">
				</form>
			</div>
			
			<!--list of user data-->
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
						$UserID = $_SESSION['UserID'];
						$query = "Select u.FirstName, p.EntryDate, p.HoursWorked, e.Name from WageDataEntries p INNER JOIN Employers e ON (p.EmployerID = e.EmployerID) INNER JOIN Users u ON (p.UserID = u.UserID) where p.UserID = '$UserID';";
							
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
		
		<!--See jobs user has registered-->
		<div class = "row">
				<div class="panel-body">
				<table class="table table-bordered table-striped">
				<h3>My Jobs</h3>
					<!--columns-->
					<thead>
					  <tr>
						<th>Name</th>
						<th>Location</th>
						<th>Hourly Wage</th>
						<th>Standard Hours</th>
					  </tr>
					</thead>
					<!--rows-->
					<tbody>
					<?php

						// get a handle to the database
						$db = connectDB($DBHost,$DBUser,$DBPasswd,$DBName);
						// prep query
						$UserID = $_SESSION['UserID'];
						$query = "Select e.Name, e.Location, u.HourlyWage, u.StandardHours from Employers e INNER JOIN UsersEmployment u ON (e.EmployerID = u.EmployerID) where u.UserID = '$UserID' ORDER BY u.UserID;";
							
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

<?php
	ob_end_flush( );
	include_once("footer.php");
?>
