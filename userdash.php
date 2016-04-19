<?php
	include_once('UTILITIES/configtz.php');
	include_once('UTILITIES/dbutils.php');
	include_once("header.php");
	$pageTitle = "Report Hours";
?>

<?php
	//connect to database
	$db = connectDB($DBHost,$DBUser,$DBPasswd,$DBName);
	
	// set up my query
	$query = "SELECT id, startDate, endDate, hoursWorked, yourEmployer FROM enterHours ORDER BY id;";
	
	// run the query
	$result = queryDB($query, $db);
?>

<div class = "col-xs-2"></div> <!-- Used to push jumbotron smaller and to the right -->
<div class = "col-xs-8">
<div class="text-center">
	<!-- jumbotron-->
	<div class="jumbotron">

		<div class="text-center">
			<h1>Enter My Hours</h1>
		</div>
	</div> <!-- Jumbotron -->
</div>
</div>
</div>
<?php
// Back to PHP to perform the search if one has been submitted. Note
// that $_POST['submit'] will be set only if you invoke this PHP code as
// the result of a POST action, presumably from having pressed Submit
// on the form we just displayed above.
if (isset($_POST['submit'])) {
//	echo '<p>we are processing form data</p>';
//	print_r($_POST);

	// get data from the input fields
	$startDate = $_POST['startDate'];
	$endDate = $_POST['endDate'];
	$hoursWorked = $_POST['hoursWorked'];
	$yourEmployer = $_POST['yourEmployer'];
	
	// check to make sure we have start date
	if (!$startDate) {
		punt("Please enter a start date");
	}
	
	// connect to database
	$db = connectDB($DBHost,$DBUser,$DBPasswd,$DBName);
	
	// set up my query, id is not insert but created in the database
	$query = "INSERT INTO enterHours(startDate, endDate, hoursWorked, yourEmployer) VALUES ('$startDate', '$endDate', '$hoursWorked', '$yourEmployer');";
	
	// run the query
	$result = queryDB($query, $db);
	
	// check if it worked (not really necessary given the utilities we have)
	if ($result) {
		echo "<p>your hours was added</p>";
	} else {
		punt("<p>Unable to insert your hours "</p>");
	}
}
?>

<!----------------->
<!---List yourHours--->
<!----------------->
<div class="row">
<div class="col-xs-12">
	<h2><?php echo $Title ?></h2>
</div>
</div>

<div class="row">
<div class="col-xs-12">
<table class="table table-hover">

<!-- Titles for table -->
<thead>
<tr>
	<th>Start Date</th>
	<th>End Date</th>
	<th>Hours Worked</th>
	<th>Your Employer</th>
</tr>
</thead>

<tbody>
<?php
	// connect to database
	$db = connectDB($DBHost,$DBUser,$DBPasswd,$DBName);
	
	// set up my query
	$query = "SELECT * FROM hoursWorked ORDER BY id;";
	
	// run the query
	$result = queryDB($query, $db);
	
	while($row = nextTuple($result)) {
		echo "\n <tr>";
		echo "<td><a href='".$row['yourEmployer']."'>".$row['startDate']."</a></td>";
		echo "<td>" . $row['endDate'] . "</td>";
		echo "<td>" . $row['hoursWorked'] . "</td>";	
		echo "</tr>";
	}
?>

</div> <!-- closing bootstrap container -->
</body>
</html>
