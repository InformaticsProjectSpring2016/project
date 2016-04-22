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
						$query = "Select p.EntryDate, p.HoursWorked, e.Name, u.FirstName from WageDataEntries p INNER JOIN Employers e ON (p.EmployerID = e.EmployerID) INNER JOIN Users u ON (p.UserID = u.UserID);";
							
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
		</div> <!-- Jumbotron -->
	</div>
</div> <!-- Container -->

<?php
	include_once("footer.php");
?>