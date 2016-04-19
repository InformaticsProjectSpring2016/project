<?php
	$menuHighlight = 0;
	$pageTitle="Non-Profit Dashboard";
	include_once("header.php");
	include_once("UTILITIES/config.php");
	include_once("UTILITIES/dbutils.php");
?>

<div class = "container">
	<div class="text-center">
		<div class="jumbotron">
			<h1>Non-Profit Dashboard</h1>
			<div class = "row">
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
									<th>". $row[0] . "</th>
									<th>" . $row[1] . "</th> 
									<th>" . $row[2] . "</th>
									<th>" . $row[3] . "</th>
									<th>" . $row[4] . "</th>
									<th>" . $row[5] . "</th>
									<th>" . $row[6] . "</th>
								</tr>";
							}
						} else {
							echo "0 results";
						}

					?>
					</tbody>
				</table>
			</div>
		</div> <!-- Jumbotron -->
	</div>
</div> <!-- Container -->

<?php
	include_once("footer.php");
?>
