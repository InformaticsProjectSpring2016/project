<?php
	$menuHighlight = 0;
	$pageTitle="Report Hours";
	include_once("header.php");
?>


<div class = "col-xs-2"></div> <!-- Used to push jumbotron smaller and to the right -->
<div class = "col-xs-8">
<div class="text-center">
	<!-- jumbotron-->
	<div class="jumbotron">

		<div class="text-center">
			<h1>Enter My Hours</h1>
			<p class="lead">Please enter your hours worked below.</p>
			
		<form action="sendHoursdata.php" method="post">
			<div class="form-group">
				<div class="input-group">	
					<div class="input-group-addon">Start Date</div>
					<input type="date" class="form-control" name="StartDate"><br>
					
					<div class="input-group-addon">End Date</div>
					<input type="date" class="form-control" name="EndDate"><br>
				</div>
			</div>
			
			<div class="form-group">
				<div class="input-group">	
					<div class="input-group-addon">Hours Worked</div>
					<input type="number" class="form-control" placeholder="Hours Worked" name="hoursworked"/>
				</div>
			</div>
			
			<div class="form-group">
				<div class="input-group">	
					<div class="input-group-addon">Employer</div>
					<input type="text" class="form-control" placeholder="Enter Your Employer" name="employer"/>
				</div>
			</div>
			
			<button type="submit" class="btn btn-success btn-lg" name="submit">Report</button>
		</form>
		</div>
	</div> <!-- Jumbotron -->
</div>
</div>

<?php
	include_once("footer.php");
?>
