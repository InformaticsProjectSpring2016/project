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
			<li class="active"><a href="#Theft" data-toggle="pill">Theft Dashboard</a></li>
			<li><a href="#AllUsers" data-toggle="pill">All Users</a></li>
			<li><a href="#Paycheck" data-toggle="pill">Paycheck Data</a></li>
			<li><a href="#Hourly" data-toggle="pill">Hourly Data</a></li>
			<li><a href="#Employers" data-toggle="pill">Employers</a></li>
		</ul>
	</div>
	<!-- Begin content container -->
	<div class="col-md-10">
		<!-- Alert for sent Email -->
		<?php
			if(isset($_GET['Email'])){
				if($_GET['Email'] == 0){
					echo '<div class="alert alert-success animated fadeIn" role="alert">Your email has been sent.</div>';
				}else{
					echo '<div class="alert alert-warning animated fadeIn" role="alert">There has been a problem sending your email.</div>';
				}
			}
		?>
		<div class="tab-content">
			<!-- Problem Users Tab --> 
			<div class="tab-pane active" id="Theft">
				<div class="panel-body">
				<table class="table table-bordered table-striped">
				<h3>Users with potential problems</h3>
					<!--columns-->
					<thead>
					  <tr>
						<th>UserID</th>
						<th>First Name</th>
						<th>Email</th>
					  </tr>
					</thead>
					<!--rows-->
					<tbody>
					<?php
						// get a handle to the database
						$db = connectDB($DBHost,$DBUser,$DBPasswd,$DBName);
						// get users who have issues
						$query = "SELECT u.UserID, u.FirstName, u.Email, p.HoursPaid, Employment.HourlyWage, p.AmountPaid
									FROM Users u
									INNER JOIN PaycheckData p ON (u.UserID = p.UserID)
									INNER JOIN WageDataEntries h ON (h.UserID = p.UserID) AND (h.EmployerID = p.EmployerID) AND (h.EntryDate >= p.PayPeriodStart) AND (h.EntryDate <= p.PayPeriodEnd)
									INNER JOIN UsersEmployment Employment ON (h.UserID = Employment.UserID) AND (h.EmployerID = Employment.EmployerID)
									INNER JOIN Employers ON p.EmployerID = Employers.EmployerID
									GROUP BY p.UserID
									HAVING (SUM(h.HoursWorked) > p.HoursPaid) OR (SUM(h.HoursWorked) * Employment.HourlyWage) > p.AmountPaid;";
						$result = queryDB($query, $db);
						
						if (nTuples($result)> 0) {
						//output data of each row
							while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
							echo "
								<tr class='danger'>
									<td class='clickable-row' data-href='http://webdev.divms.uiowa.edu/~ngramer/project/viewuserdata.php?UserID=". $row['UserID'] ."'>". $row['UserID'] . "</td>
									<td class='clickable-row' data-href='http://webdev.divms.uiowa.edu/~ngramer/project/viewuserdata.php?UserID=". $row['UserID'] ."'>" . $row['FirstName'] . "</td> 
									<td class='clickable-row' data-href='http://webdev.divms.uiowa.edu/~ngramer/project/viewuserdata.php?UserID=". $row['UserID'] ."'>" . $row['Email'] . "</td>
								</tr>";}
						}else{
							echo "<h1>No Problem Users Found</h1>";
						}
					?>
					</tbody>
				</table>
				</div>
			</div>
					
			<!-- All Users Tab --> 
			<div class="tab-pane" id="AllUsers">
				<div class="panel-body">
				<table class="table table-bordered table-striped">
				<h3>All Users</h3>
					<!--columns-->
					<thead>
					  <tr>
						<th>UserID</th>
						<th>First Name</th>
						<th>Email</th>
					  </tr>
					</thead>
					<!--rows-->
					<tbody>
					<?php
						// get a handle to the database
						$db = connectDB($DBHost,$DBUser,$DBPasswd,$DBName);
						// prep query
						$query = "Select UserID, Username, FirstName, LastName, Email from Users;";
							
						// execute sql statement
						$result = queryDB($query, $db);
						
											
						if (nTuples($result)> 0) {
						//output data of each row
							while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
								$UserID = $row[0];
								echo "
								<tr>
									<td class='clickable-row' data-href='http://webdev.divms.uiowa.edu/~ngramer/project/viewuserdata.php?UserID=". $row['UserID'] ."'>". $row['UserID'] . "</td>
									<td class='clickable-row' data-href='http://webdev.divms.uiowa.edu/~ngramer/project/viewuserdata.php?UserID=". $row['UserID'] ."'>" . $row['FirstName'] . "</td> 
									<td class='clickable-row' data-href='http://webdev.divms.uiowa.edu/~ngramer/project/viewuserdata.php?UserID=". $row['UserID'] ."'>" . $row['Email'] . "</td>
								</tr>";
							}
						} else {
							echo "0 results";
						}

						?>
						</tbody>
					</table>
				</div>
			</div>
		<!-- END HOME USER TAB -->
		  
		  
		 <!-- PAYCHECK TAB -->
		  <div class="tab-pane" id="Paycheck">
			<div class="panel-body">
			<table class="table table-bordered table-striped">
			<h3>Paycheck entries from all users</h3>
				<!--columns-->
				<thead>
				  <tr>
					<th>PaycheckID</th>
					<th>Pay Period Start</th>
					<th>Pay Period End</th>
					<th>Hours</th>
					<th>Amount Paid</th>
					<th>Employer Name</th>
					<th>User's Name</th>
				  </tr>
				</thead>
				<!--rows-->
				<tbody>
				<?php
					// get a handle to the database
					$db = connectDB($DBHost,$DBUser,$DBPasswd,$DBName);
					// prep query
					$query = "Select p.PaycheckID, p.PayPeriodStart, p.PayPeriodEnd, p.HoursPaid, p.AmountPaid, e.Name, u.Username from PaycheckData p INNER JOIN Employers e ON (p.EmployerID = e.EmployerID) INNER JOIN Users u ON (p.UserID = u.UserID);";
						
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
								<td>" . $row[6] . "</td>
							</tr>";
						}
					} else {
						echo "0 results";
					}

					?>
				</tbody>
			</table>
			</div>
		</div>
		<!-- END PAYCHECK TAB -->
		
		<!-- HOURLY TAB -->
		<div class="tab-pane" id="Hourly">
			<div class="panel-body">
			<table class="table table-bordered table-striped">
			<h3>Working hour entries from all users</h3>
				<!--columns-->
				<thead>
				  <tr>
					<th>EntryID</th>
					<th>Entry Date</th>
					<th>Hours Worked</th>
					<th>Employer Name</th>
					<th>Amount Paid</th>
					<th>First Name</th>
					<th>UserID</th>
				  </tr>
				</thead>
				<!--rows-->
				<tbody>
				<?php			
					// get a handle to the database
					$db = connectDB($DBHost,$DBUser,$DBPasswd,$DBName);
					// prep query
					$query = "Select w.EntryID, w.EntryDate, w.HoursWorked, e.Name, u.Username, u.FirstName, w.UserID  from WageDataEntries w INNER JOIN Employers e ON (w.EmployerID = e.EmployerID) INNER JOIN Users u ON (w.UserID = u.UserID);";
						
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
								<td>" . $row[6] . "</td>
							</tr>";
						}
					} else {
						echo "0 results";
					}

					?>
				</tbody>
			</table>
			</div>
		</div><!-- Hourly Entry Panel End -->
		
			<!-- EMPLOYERS TAB -->
			<div class="tab-pane" id="Employers">
				<div class="panel-body">
				<table class="table table-bordered table-striped">
				<h3>All submitted Employers</h3>
					<!--columns-->
					<thead>
					  <tr>
						<th>EmployerID</th>
						<th>Name</th>
						<th>Location</th>
					  </tr>
					</thead>
					<!--rows-->
					<tbody>
					<?php			
						// get a handle to the database
						$db = connectDB($DBHost,$DBUser,$DBPasswd,$DBName);
						// prep query
						$query = "Select * From Employers;";
							
						// execute sql statement
						$result = queryDB($query, $db);
						
						// check if it worked
						
						if (nTuples($result)> 0) {
						//output data of each row
							while($row = mysqli_fetch_row($result)) {
								echo "
								<tr>
									<td>". $row[2] . "</td>
									<td>" . $row[0] . "</td> 
									<td>" . $row[1] . "</td>
								</tr>";
							}
						} else {
							echo "0 results";
						}

						?>
					</tbody>
				</table>
				</div>
			</div><!-- Employer List Panel End -->
		</div> <!-- Tab Content -->


<script>
jQuery(document).ready(function($) {
    $(".clickable-row").click(function() {
        window.document.location = $(this).data("href");
    });
});
</script>




<?php
	include_once("footer.php");
?>
