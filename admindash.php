<?php
	$menuHighlight = 0;
	$pageTitle="Administrator Dashboard";
	include_once("header.php");

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
	<div class="col-md-10">
		<div class="tab-content">
			<div class="tab-pane active" id="Users">
				<div class="panel-body">
				<table class="table table-bordered table-striped">
				<h3>All Users</h3>
					<!--columns-->
					<thead>
					  <tr>
						<th>UserID</th>
						<th>Username</th>
						<th>First Name</th>
						<th>Last Name</th>
						<th>Account Type</th>
						<th>Email</th>
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
						
						// check if it worked
						
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
								
								echo "
								<tr>
									<th>". $row[0] . "</th>
									<th>" . $row[1] . "</th> 
									<th>" . $row[2] . "</th>
									<th>" . $row[3] . "</th>
									<th>" . $AccountType . "</th>
									<th>" . $row[5] . "</th>
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
									<th>". $row[0] . "</th>
									<th>" . $row[1] . "</th> 
									<th>" . $row[2] . "</th>
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
function staticDataSource(options, callback) {

  // define the columns for the grid
  var columns = [
    {
      'label': 'Username',      // column header label
      'property': 'username',   // the JSON property you are binding to
      'sortable': true      // is the column sortable?
    },
    {
      'label': 'First Name',
      'property': 'First Name',
      'sortable': true
    },
    {
      'label': 'UserID',
      'property': 'UserID',
      'sortable': true
    },
    {
      'label': 'Account Type',
      'property': 'Account Type',
      'sortable': true
    }
	{
      'label': 'Email',
      'property': 'Email',
      'sortable': true
    }
	
  // transform array
  var pageIndex = options.pageIndex;
  var pageSize = options.pageSize;
  var totalItems = items.length;
  var totalPages = Math.ceil(totalItems / pageSize);
  var startIndex = (pageIndex * pageSize) + 1;
  var endIndex = (startIndex + pageSize) - 1;
  if (endIndex > items.length) {
    endIndex = items.length;
  }

  var rows = items.slice(startIndex - 1, endIndex);
  ];
</script>
<?php
	include_once("footer.php");
?>
