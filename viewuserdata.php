<?php
	$menuHighlight = 0;
	$pageTitle="Non-Profit Dashboard";
	include_once("header.php");
	/* Check for a logged in nonprofit */
	if($_SESSION['AccountType'] != 1 && $loggedIn){
		header("Location: http://webdev.divms.uiowa.edu/~ngramer/project/index.php?authorized=0");
	}
	if(!$loggedIn){
		header("Location: http://webdev.divms.uiowa.edu/~ngramer/project/login.php?authorized=0");
	}
	include_once("UTILITIES/config.php");
	include_once("UTILITIES/dbutils.php");
?>

<div class = "container">

	<div class="col-md-12">
	<div class="text-center">
		<h1>Non-Profit Dashboard</h1>
	</div>
	</div>
	<!-- Navigation Buttons -->
	<div class="col-md-2">
		<ul class="nav nav-pills nav-stacked marginTop" id="myTabs">
			<li class="alert-warning" role="presentation"><a href="http://webdev.divms.uiowa.edu/~ngramer/project/nonprofitdash.php">Go Back</a></li>
			<li class="active"><a href="#Data" data-toggle="pill">User's Data</a></li>
			<li><a href="#Jobs" data-toggle="pill">User's Jobs</a></li>
			<li><a href="#Email" data-toggle="pill">Email this user</a></li>
		</ul>
	</div>
	<!-- Begin content container -->
	<div class="col-md-10">
		<div class="tab-content">
			<!-- View Users Data Tab --> 
			<div class="tab-pane active" id="Data">
				<!-- Problem Paychecks -->
				<div class="panel-body">
				<table class="table table-bordered table-striped">
				<h3>Paychecks with potential problems</h3>
					<!--columns-->
					<thead>
					  <tr>
						<th>PaycheckID</th>
						<th>Hours Worked</th>
						<th>Hours Paid</th>
						<th>Hourly Wage</th>
						<th>Amount Paid</th>
						<th>Pay Period Start</th>
						<th>Pay Period End</th>

					  </tr>
					</thead>
					<!--rows-->
					<tbody>
					<?php
						$UserID = $_GET['UserID'];
						// get a handle to the database
						$db = connectDB($DBHost,$DBUser,$DBPasswd,$DBName);
						// get users who have issues
						$query = "SELECT p.PaycheckID, Employment.UserID, h.HoursWorked, p.HoursPaid, Employment.HourlyWage, p.AmountPaid, Employers.Name, p.PayPeriodStart, p.PayPeriodEnd
									FROM PaycheckData AS p
									INNER JOIN WageDataEntries h ON (h.UserID = p.UserID) AND (h.EmployerID = p.EmployerID) AND (h.EntryDate >= p.PayPeriodStart) AND (h.EntryDate <= p.PayPeriodEnd)
									INNER JOIN UsersEmployment AS Employment ON (h.UserID = Employment.UserID) AND (h.EmployerID = Employment.EmployerID)
									INNER JOIN Employers ON p.EmployerID = Employers.EmployerID
									INNER JOIN Users u ON p.UserID = u.UserID
									WHERE u.UserID = $UserID
									GROUP BY p.PaycheckID
									HAVING (SUM(h.HoursWorked) > p.HoursPaid) OR (SUM(h.HoursWorked) * Employment.HourlyWage) > p.AmountPaid;";
						$result = queryDB($query, $db);
						
						if (nTuples($result)> 0) {
						//output data of each row
							while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
							echo "
								<tr class='danger'>
									<td class='clickable-row' data-href='http://webdev.divms.uiowa.edu/~ngramer/project/viewuserdata.php?UserID=". $row['UserID'] ."'>" . $row['PaycheckID'] . "</td> 
									<td class='clickable-row' data-href='http://webdev.divms.uiowa.edu/~ngramer/project/viewuserdata.php?UserID=". $row['UserID'] ."'>" . $row['HoursWorked'] . "</td>
									<td class='clickable-row' data-href='http://webdev.divms.uiowa.edu/~ngramer/project/viewuserdata.php?UserID=". $row['UserID'] ."'>" . $row['HoursPaid'] . "</td>
									<td class='clickable-row' data-href='http://webdev.divms.uiowa.edu/~ngramer/project/viewuserdata.php?UserID=". $row['UserID'] ."'>" . $row['HourlyWage'] . "</td>
									<td class='clickable-row' data-href='http://webdev.divms.uiowa.edu/~ngramer/project/viewuserdata.php?UserID=". $row['UserID'] ."'>" . $row['AmountPaid'] . "</td>
									<td class='clickable-row' data-href='http://webdev.divms.uiowa.edu/~ngramer/project/viewuserdata.php?UserID=". $row['UserID'] ."'>" . $row['PayPeriodStart'] . "</td>
									<td class='clickable-row' data-href='http://webdev.divms.uiowa.edu/~ngramer/project/viewuserdata.php?UserID=". $row['UserID'] ."'>" . $row['PayPeriodEnd'] . "</td>
								</tr>";}
						}else{
							echo "0 results";
						}
					?>
					</tbody>
				</table>
				</div> <!-- End Problem Paychecks -->
				
				<!-- Hours Entries -->
				<div class="panel-body">
				<table class="table table-bordered table-striped">
				<h3>Work day entries from User</h3>
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
						$UserID = $_GET['UserID'];
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
				</div>
				<!-- Paycheck Entries -->
				<div class="panel-body">
				<table class="table table-bordered table-striped">
				<h3>Paycheck entries from User</h3>
					<!--columns-->
					<thead>
					  <tr>
						<th>PaycheckID</th>
						<th>Pay Period Start</th>
						<th>Pay Period End</th>
						<th>Hours</th>
						<th>Amount Paid</th>
						<th>Employer Name</th>
					  </tr>
					</thead>
					<!--rows-->
					<tbody>
					<?php
						// get a handle to the database
						$db = connectDB($DBHost,$DBUser,$DBPasswd,$DBName);
						// prep query
						$query = "Select p.PaycheckID, p.PayPeriodStart, p.PayPeriodEnd, p.HoursPaid, p.AmountPaid, e.Name, u.Username from PaycheckData p INNER JOIN Employers e ON (p.EmployerID = e.EmployerID) INNER JOIN Users u ON (p.UserID = u.UserID) where u.UserID = '$UserID';";
							
						// execute sql statement
						$result = queryDB($query, $db);
						
						// check if it worked
						
						if (nTuples($result)> 0) {
						//output data of each row
							while($row = mysqli_fetch_row($result)) {
								echo "
								<tr>
									<td>". $row[0] . "</td>
									<td>" . $row[1] . "</td> 
									<td>" . $row[2] . "</td>
									<td>" . $row[3] . "</td>
									<td>" . $row[4] . "</td>
									<td>" . $row[5] . "</td>
								</tr>";
							}
						} else {
							echo "0 results";
						}

						?>
					</tbody>
				</table>
			</div>
		</div> <!-- End of Users Entered Data Tab -->
			
		<!-- View Users Job Tab --> 
		<div class="tab-pane" id="Jobs">
			<div class="panel-body">
				<table class="table table-bordered table-striped">
				<h3>User's Jobs</h3>
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
						$UserID = $_GET['UserID'];
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
			</div>
		</div> <!-- End Jobs Tab -->
		
		<!-- Begin Email User Tab -->
		<div class="tab-pane" id="Email">
			<div class="panel-body">
			<!-- Problem Paychecks -->
			<table class="table table-bordered table-striped">
			<h3>Paychecks with potential problems</h3>
				<!--columns-->
				<thead>
				  <tr>
					<th>PaycheckID</th>
					<th>Hours Worked</th>
					<th>Hours Paid</th>
					<th>Hourly Wage</th>
					<th>Amount Paid</th>
					<th>Pay Period Start</th>
					<th>Pay Period End</th>

				  </tr>
				</thead>
				<!--rows-->
				<tbody>
				<?php
					$UserID = $_GET['UserID'];
					// get a handle to the database
					$db = connectDB($DBHost,$DBUser,$DBPasswd,$DBName);
					// get users who have issues
					$query = "SELECT p.PaycheckID, Employment.UserID, h.HoursWorked, p.HoursPaid, Employment.HourlyWage, p.AmountPaid, Employers.Name, p.PayPeriodStart, p.PayPeriodEnd
								FROM PaycheckData AS p
								INNER JOIN WageDataEntries h ON (h.UserID = p.UserID) AND (h.EmployerID = p.EmployerID) AND (h.EntryDate >= p.PayPeriodStart) AND (h.EntryDate <= p.PayPeriodEnd)
								INNER JOIN UsersEmployment AS Employment ON (h.UserID = Employment.UserID) AND (h.EmployerID = Employment.EmployerID)
								INNER JOIN Employers ON p.EmployerID = Employers.EmployerID
								INNER JOIN Users u ON p.UserID = u.UserID
								WHERE u.UserID = $UserID
								GROUP BY p.PaycheckID
								HAVING (SUM(h.HoursWorked) > p.HoursPaid) OR (SUM(h.HoursWorked) * Employment.HourlyWage) > p.AmountPaid;";
					$result = queryDB($query, $db);
					
					if (nTuples($result)> 0) {
					//output data of each row
						while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
						echo "
							<tr class='danger'>
								<td class='clickable-row' data-href='http://webdev.divms.uiowa.edu/~ngramer/project/viewuserdata.php?UserID=". $row['UserID'] ."'>" . $row['PaycheckID'] . "</td> 
								<td class='clickable-row' data-href='http://webdev.divms.uiowa.edu/~ngramer/project/viewuserdata.php?UserID=". $row['UserID'] ."'>" . $row['HoursWorked'] . "</td>
								<td class='clickable-row' data-href='http://webdev.divms.uiowa.edu/~ngramer/project/viewuserdata.php?UserID=". $row['UserID'] ."'>" . $row['HoursPaid'] . "</td>
								<td class='clickable-row' data-href='http://webdev.divms.uiowa.edu/~ngramer/project/viewuserdata.php?UserID=". $row['UserID'] ."'>" . $row['HourlyWage'] . "</td>
								<td class='clickable-row' data-href='http://webdev.divms.uiowa.edu/~ngramer/project/viewuserdata.php?UserID=". $row['UserID'] ."'>" . $row['AmountPaid'] . "</td>
								<td class='clickable-row' data-href='http://webdev.divms.uiowa.edu/~ngramer/project/viewuserdata.php?UserID=". $row['UserID'] ."'>" . $row['PayPeriodStart'] . "</td>
								<td class='clickable-row' data-href='http://webdev.divms.uiowa.edu/~ngramer/project/viewuserdata.php?UserID=". $row['UserID'] ."'>" . $row['PayPeriodEnd'] . "</td>
							</tr>";}
					}else{
						echo "0 results";
					}
				?>
				</tbody>
			</table>
			 <!-- End Problem Paychecks -->
			<form action="emailuser.php" class="form-horizontal" method="post">
				<div class="row">
					<div class="form-group">
						<label class="col-sm-2 control-label" for="Email">Email Address</label>
						<div class="col-sm-8">
							<input type="email" class="form-control" placeholder="Email" name="Email" value="
							<?php $UserID = $_GET['UserID'];
									$db = connectDB($DBHost,$DBUser,$DBPasswd,$DBName);
									// get users who have issues
									$query ="SELECT Email from Users where UserID = $UserID;";
									$row = mysqli_fetch_array(queryDB($query,$db), MYSQLI_ASSOC);
									echo $row["Email"];
									?>" required>
									
						</div>
					</div>
				</div>
				<div class="row">
					<div class="form-group">
						<label class="col-sm-2 control-label" for="Subject">Subject</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" placeholder="Subject" name="Subject" value="We've located a discrepancy in your paycheck"required>
						</div>
					</div>
				</div>
				<div class="row">
					<div class = "form-group">
						<label class="col-sm-2 control-label" for="Message">Message</label>
						<div class="col-sm-8">
							<textarea class="form-control" rows = "5" name="Message"></textarea>
						</div>
					</div>
				</div>
				
			<div class="text-center"><button type="submit" class="btn btn-success btn-lg" name="submit">Send Email</button><div>
			</form>
			
			</div>
		</div><!-- End Email Tab --> 
		</div> <!-- End tab content -->
	</div>
<!-- Makes table rows Clickable -->
<script>
jQuery(document).ready(function($) {
    $(".clickable-row").click(function() {
        $('#Data').removeClass('active');
		$('#Email').addClass('active');
    });
});
</script>

<?php
include_once("footer.php")
?>