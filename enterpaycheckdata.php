<?php
	$menuHighlight = 0;
	$pageTitle="Enter Paycheck";
	include_once("header.php");
	/* Check if user is logged in */
	if(!$loggedIn){
		header("Location: http://webdev.divms.uiowa.edu/~ngramer/project/login.php?authorized=0");
	}
	include_once("UTILITIES/config.php");
	include_once("UTILITIES/dbutils.php");
?>


<div class ="container">
<div class = "col-xs-12">
	<!-- jumbotron--> 
	<div class="jumbotron">
		<div class="text-center">
			<h1>Enter My Paycheck</h1>
			<p class="lead">Please enter you paycheck information</p>

		<form action="savePaycheck.php" class="form-horizontal" method="post">
			<div class="form-group">
				<div class="row">
					<label class="col-sm-2 control-label">Start Date</label>				
					<div id="datepickerContainer" class="col-sm-8">
					
						<!-- DATE PICKER -->
						    <div class="input-daterange input-group" id="datepicker">
								<input type="text" class="input-sm form-control" placeholder="MM/DD/YYYY" name="PayPeriodStart" />
								<span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
								
								<span class="input-group-addon">to</span>
								
								<input type="text" class="input-sm form-control" placeholder="MM/DD/YYYY" name="PayPeriodEnd" />
								<span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
							</div>
						<!-- END DATE PICKER-->
					</div>
				</div>
			</div>
			
			<!-- not in db, ignored for now
			
			<div class="row">
				<div class="form-group">
					<label class="col-sm-2 control-label">Issue Date</label>
					<div id="IssueDateContainer" class="col-sm-8">
						<div class="input-group date">
						  <input type="text" class="form-control" placeholder="MM/DD/YYYY" name="IssueDate"><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
						</div>
					</div>
					<!-- Padding 
					<div class="col-sm-2"></div>
				</div>
			</div>
			-->
			
			<div class="row">
				<div class="form-group">
					<label class="col-sm-2 control-label">Total Hours</label>
					<div class="col-sm-8">
						<input type="number" class="form-control" placeholder="Hours Worked" name="HoursPaid"/>
					</div>
					<!-- Padding -->
					<div class="col-sm-2"></div>
				</div>
			</div>
			
			<div class="row">
				<div class="form-group">
					<label class="col-sm-2 control-label">Employer</label>
					<div class="col-sm-8" style="color:black">
						<select name="EmployerID">
							<!-- Echo out users active employers -->
							<?php
								$Username = $_SESSION['Username'];
								$db = connectDB($DBHost,$DBUser,$DBPasswd,$DBName);
								// prep query
								$query = "Select Name,EmployerID from Employers where EmployerID = ANY (Select EmployerID from UsersEmployment where UserID = (Select UserID from Users where Username = '$Username'));";
									
								// execute sql statement
								$result = queryDB($query, $db);
								
								// check if it worked
								if (nTuples($result)> 0) {
									//output data of each row, 1 is the actual employer id
									while($row = mysqli_fetch_row($result)) {
										echo '<option value ="'. $row[1] . '">'. $row[0] .'</option>';
									}
								}
								else{
									echo "No employers found";
								}
							?>	
						</select>
					</div>
					<!-- Padding -->
					<div class="col-sm-2"></div>
				</div>
			</div>
			
			<div class="row">
				<div class="form-group">
					<label class="col-sm-2 control-label">Amount Paid</label>
					<div class="col-sm-8">
						<input type="number" min="1" step="any" placeholder="$x.xx" name="AmountPaid" class="form-control"/>
					</div>
					<!-- Padding -->
					<div class="col-sm-2"></div>
				</div>
			</div>
			
			<button type="submit" class="btn btn-success btn-lg" name="submit">Report</button>
		</form>
		</div>
		</div>
	</div> <!-- Jumbotron -->
</div>


<script>
// This initializes my datepickers based on div id's
	$('#datepickerContainer .input-daterange').datepicker ({
    format: "mm/dd/yyyy",
    todayBtn: "linked",
    todayHighlight: true
});

	$('#IssueDateContainer .input-group.date').datepicker ({
    format: "mm/dd/yyyy",
    todayBtn: "linked",
    todayHighlight: true
});

</script>

<?php
	include_once("footer.php");
?>
