<?php
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
	$db = connectDB($DBHost,$DBUser,$DBPasswd,$DBName);
	$EmployerID = $_GET['ID'];
	$query = "Select Name from Employers where EmployerID = '$EmployerID';";
							
	// execute sql statement
	$result = queryDB($query, $db);
	$EmployerName = mysqli_fetch_row($result)[0];
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
		<ul>
	</div>
	<!-- Paycheck Entries -->
	<div class="panel-body">
	
	<!-- Begin content container -->
	<div class="col-md-10">
		<div class="tab-content">
			<!-- View employer Data Tab --> 
			<div class="tab-pane active" id="Data">
				<h3>Paycheck entries for <?php echo $EmployerName;?></h3>
					<table class="table table-bordered table-striped"><!--columns-->
					<thead>
					  <tr>
						<th>PaycheckID</th>
						<th>Pay Period Start</th>
						<th>Pay Period End</th>
						<th>Hours</th>
						<th>Amount Paid</th>
						<th>Employer Name</th>
						<th>Username</th>
					  </tr>
					</thead>
					<!--rows-->
					<tbody>
					<?php
						// get a handle to the database
						$db = connectDB($DBHost,$DBUser,$DBPasswd,$DBName);
						// prep query
						$EmployerID = $_GET['ID'];
						$query = "Select p.PaycheckID, p.PayPeriodStart, p.PayPeriodEnd, p.HoursPaid, p.AmountPaid, e.Name, u.Username, u.UserID from PaycheckData p INNER JOIN Employers e ON (p.EmployerID = e.EmployerID) INNER JOIN Users u ON (p.UserID = u.UserID) where e.EmployerID = '$EmployerID';";
							
						// execute sql statement
						$result = queryDB($query, $db);
						
						// check if it worked
						
						if (nTuples($result)> 0) {
						//output data of each row
							while($row = mysqli_fetch_row($result)) {
								echo "
								<tr>
									<td class='clickable-row' data-href='http://webdev.divms.uiowa.edu/~ngramer/project/viewuserdata.php?UserID=". $row[7] ."'>". $row[0] . "</td>
									<td class='clickable-row' data-href='http://webdev.divms.uiowa.edu/~ngramer/project/viewuserdata.php?UserID=". $row[7] ."'>". $row[1] . "</td> 
									<td class='clickable-row' data-href='http://webdev.divms.uiowa.edu/~ngramer/project/viewuserdata.php?UserID=". $row[7] ."'>". $row[2] . "</td>
									<td class='clickable-row' data-href='http://webdev.divms.uiowa.edu/~ngramer/project/viewuserdata.php?UserID=". $row[7] ."'>". $row[3] . "</td>
									<td class='clickable-row' data-href='http://webdev.divms.uiowa.edu/~ngramer/project/viewuserdata.php?UserID=". $row[7] ."'>". $row[4] . "</td>
									<td class='clickable-row' data-href='http://webdev.divms.uiowa.edu/~ngramer/project/viewuserdata.php?UserID=". $row[7] ."'>". $row[5] . "</td>
									<td class='clickable-row' data-href='http://webdev.divms.uiowa.edu/~ngramer/project/viewuserdata.php?UserID=". $row[7] ."'>". $row[6] . "</td>
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
	</div>
	</div>
	
<!-- Makes table rows Clickable -->
<!-- Makes table rows Clickable -->
<script>
jQuery(document).ready(function($) {
    $(".clickable-row").click(function() {
        window.document.location = $(this).data("href");
    });
});
</script>
<?php
include_once('footer.php');
?>