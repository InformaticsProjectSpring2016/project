<?php
	$menuHighlight = 0;
	$pageTitle="User Dashboard";
	include_once("header.php");
	/* Check if user is logged in */
	if(!$loggedIn){
		header("Location: http://webdev.divms.uiowa.edu/~ngramer/project/login.php?authorized=0");
	}
	include_once("UTILITIES/config.php");
	include_once("UTILITIES/dbutils.php");
?>

<div class = "container">

	<div class="col-md-12">
	<div class="text-center">
		<h1>User Dashboard</h1>
	</div>
	</div>
	<!-- Navigation Buttons -->
	<div class="col-md-2">
		<ul class="nav nav-pills nav-stacked marginTop" id="myTabs">
			<li class="active"><a href="#mydata" data-toggle="pill">My Data</a></li>
<!-- Echo out users active employers to navbar-->
<?php
	$Username = $_SESSION['Username'];
	$db = connectDB($DBHost,$DBUser,$DBPasswd,$DBName);
	// prep query
	$query = "Select Name,EmployerID from Employers where EmployerID = ANY (Select EmployerID from UsersEmployment where UserID = (Select UserID from Users where Username = '$Username'));";
		
	// execute sql statement
	$result = queryDB($query, $db);
	
	// check if we have employers and echo nav tabs
	if (nTuples($result)> 0){
		while($row = mysqli_fetch_row($result)) {
			echo '<li><a href="#'.$row[1].'" data-toggle="pill">'. $row[0].'</a></li>';
		}
		
	
	echo '
		<form method="link" action="addemployment.php"> 
			<input type="submit" class="btn btn-danger" value="Add Another Job">
		</form>
		</ul>
	</div><!-- end Nav -->
	<!-- Begin content container -->
	<div class="col-md-10">
	<div class="tab-content">';
	
	$result = queryDB($query, $db);
	// For each employer, echo out a tab container and table
	while($row = mysqli_fetch_row($result)) {
		echo'
			<div class="tab-pane" id="'. $row[1].'">
				<div class="panel-body">
				<table class="table table-bordered table-striped">
				<h3>Paycheck entries for '. $row[0] .'</h3>
					<!--columns-->
					<thead>
					  <tr>
						<td>PaycheckID</td>
						<td>Pay Period Start</td>
						<td>Pay Period End</td>
						<td>Hours Paid</td>
						<td>Hours Worked</td>
						<td>Amount Paid</td>
					  </tr>
					</thead>
					<!--rows-->
				<tbody>';
	
		// Now, for each paycheck associated with an employer, echo out the corresponding table rows.
		// prep query
		$EmployerID = $row[1];
		//check for hourly entries
		$UserID = $_SESSION['UserID'];
		if(nTuples(queryDB("select h.EntryID from WageDataEntries h where h.UserID = '$UserID' and h.EmployerID ='$EmployerID'",$db)) >0){
			$query = "Select p.PaycheckID, p.PayPeriodStart, p.PayPeriodEnd, p.HoursPaid, p.AmountPaid, SUM(h.HoursWorked), COUNT(h.EntryID) from PaycheckData p INNER JOIN Employers e ON (p.EmployerID = e.EmployerID) INNER JOIN Users u ON (p.UserID = u.UserID) INNER JOIN WageDataEntries h ON (h.UserID = p.UserID) AND (h.EmployerID = p.EmployerID) AND (h.EntryDate >= p.PayPeriodStart) AND (h.EntryDate <= p.PayPeriodEnd) WHERE u.Username = '$Username' and e.EmployerID = '$EmployerID';";
			// execute sql statement
			$result2 = queryDB($query, $db);
			// check for hourly entries within pay range
			//if(mysqli_fetch_row($result2)[6] != 0){
				//output data of each row
				while($row = mysqli_fetch_row($result2)) {
					echo "
					<tr>
						<td>". $row[0] . "</td>
						<td>" . $row[1] . "</td> 
						<td>" . $row[2] . "</td>
						<td>" . $row[3] . "</td>
						<td>" . $row[5] . "</td>
						<td>" . $row[4] . "</td>
					</tr>";
				
				} //Close up table inside outer while loop
				echo'	</tbody>
						</table>
						</div>
					</div>';
					
				}/* else{
					echo "Please add your hours for your entered Pay Periods for $row[0].
					
						</tbody>
						</table>
						</div>
					</div>";
			} */
		/* } */else{
			echo "Please add your hours for $row[0].
			
				</tbody>
				</table>
				</div>
			</div>";
		}
	} // Close employer while loop
	} //Close if statement checking if we have employers and open what to do if we dont have employers
	else{
		echo'
		<form method="link" action="addemployment.php"> 
			<input type="submit" class="btn btn-danger" value="Add Another Job">
		</form>
		</ul>
	</div><!-- end Nav -->
	<!-- Begin content container -->
	<div class="col-md-10">
	<div class="tab-content">';
	}
	
	?>
	<!-- put in mydata container last, make it active -->

	<div class="tab-pane active" id="mydata">
		<div class="panel-body">
			<table class="table table-bordered table-striped">
				<h3>My Hourly Entries</h3>
					<!--columns-->
					<thead>
					  <tr>
						<td>User Name</td>
						<td>Entry Date</td>
						<td>Hours Worked</td>
						<td>Employer</td>
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
									<td>". $row[0] . "</td>
									<td>" . $row[1] . "</td> 
									<td>" . $row[2] . "</td>
									<td>" . $row[3] . "</td>
								</tr>";
							}
						} else {
							echo "0 results";
						}

					?>
					</tbody>
				</table>
		</div> <!-- Panel Body -->
	</div> <!--tab pane -->
				
</div> <!-- End content container -->				

	
</div> <!-- End container -->






<?php
	ob_end_flush( );
	include_once("footer.php");
?>
