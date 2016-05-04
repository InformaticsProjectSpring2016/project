<?php
	$menuHighlight = 0;
	include_once("header.php");
	/* Check for a logged in administrator */
	if($_SESSION['AccountType'] != 0 && $loggedIn){	
		header("Location: http://webdev.divms.uiowa.edu/~ngramer/project/index.php?authorized=0");
	}
	if(!$loggedIn){
		header("Location: http://webdev.divms.uiowa.edu/~ngramer/project/login.php?authorized=0" .$AccountType);
	}
	$pageTitle="Administrator Dashboard";
	
?>

<div class = "container">

	<div class="col-md-12">
	<div class="text-center">
		<h1>Administrator Dashboard</h1>
	</div>
	</div>
	<!-- Navigation Buttons -->
	<div class="col-md-2">
		<ul class="nav nav-pills nav-stacked marginTop" id="myTabs">
			<li class="active"><a href="#Users" data-toggle="pill">Users</a></li>
			<li><a href="#Paycheck" data-toggle="pill">Paycheck Data</a></li>
			<li><a href="#Hourly" data-toggle="pill">Hourly Data</a></li>
			<li><a href="#Employers" data-toggle="pill">Employers</a></li>
		</ul>
	</div>
	<!-- Begin content container -->
	<div class="col-md-10">
		<div class="tab-content">
		<!-- Users Tab --> 
			<div class="tab-pane active" id="Users">
			<!-- Php for echoing out successful user update -->
			<?php
				if($_GET["update"] == "1"){
					echo '<div class="alert alert-success animated fadeIn" role="alert">Users Updated.</div>';
				}
			?>
				<div class="panel-body">
				<!-- Start hacky form  that will update all users at once-->
				<form action="updateusers.php" method='post'>
				<table class="table table-bordered table-striped">
				<h3>All Users</h3>
					<!--columns-->
					<thead>
					  <tr>
						<td>UserID</td>
						<td>Username</td>
						<td>First Name</td>
						<td>Last Name</td>
						<td>Current Account Type</td>
						<td>Update Account Type</td>
						<td>Email</td>
					  </tr>
					</thead>
					<!--rows-->
					<tbody>
					<?php
						// get a handle to the database
						$db = connectDB($DBHost,$DBUser,$DBPasswd,$DBName);
						// prep query
						$query = "Select UserID, Username, FirstName, LastName, AccountType, Email from Users;";
							
						// execute sql statement
						$result = queryDB($query, $db);
						
											
						if (nTuples($result)> 0) {
						//output data of each row
							while($row = mysqli_fetch_row($result)) {
								if($row[4] == 0){
									$AccountType = 'Administrator';
								}
								if($row[4] == 1){
									$AccountType = 'Non-Profit User';
								}
								if($row[4] == 2){
									$AccountType = 'User';
								}
								$UserID = $row[0];
								echo "
								<tr>
									<td class='clickable-row' data-href='http://webdev.divms.uiowa.edu/~ngramer/project/administrateuser.php?user=". $row[0] ."'>". $row[0] . "</td>
									<td class='clickable-row' data-href='http://webdev.divms.uiowa.edu/~ngramer/project/administrateuser.php?user=". $row[0] ."'>" . $row[1] . "</td> 
									<td class='clickable-row' data-href='http://webdev.divms.uiowa.edu/~ngramer/project/administrateuser.php?user=". $row[0] ."'>" . $row[2] . "</td>
									<td class='clickable-row' data-href='http://webdev.divms.uiowa.edu/~ngramer/project/administrateuser.php?user=". $row[0] ."'>" . $row[3] . "</td>
									<td class='clickable-row' data-href='http://webdev.divms.uiowa.edu/~ngramer/project/administrateuser.php?user=". $row[0] ."'>" . $AccountType . "</td>
									<td>
									    <select name='$UserID' id ='$UserID'>
											<option disabled selected value>Select an Account Type</option>
											<option value='00'>Administrator</option>
											<option value='1'>Non-Profit</option>
											<option value='2'>User</option>
										</select>
									</td>
									<td class='clickable-row' data-href='http://webdev.divms.uiowa.edu/~ngramer/project/administrateuser.php?user=". $row[0] ."'>" . $row[5] . "</td>
								</tr>";
							}
						} else {
							echo "0 results";
						}

						?>
						</tbody>
					</table>
					<div class="text-center"><button type="submit" class="btn btn-success btn-lg" name="submit">Update</button></div>
					</form>
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
					<td>PaycheckID</td>
					<td>Pay Period Start</td>
					<td>Pay Period End</td>
					<td>Hours</td>
					<td>Amount Paid</td>
					<td>Employer Name</td>
					<td>User's Name</td>
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
					<td>EntryID</td>
					<td>Entry Date</td>
					<td>Hours Worked</td>
					<td>Employer Name</td>
					<td>Amount Paid</td>
					<td>First Name</td>
					<td>UserID</td>
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
						<td>EmployerID</td>
						<td>Name</td>
						<td>Location</td>
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
	</div> <!-- Column -->
</div> 

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
