<?php
	include_once('UTILITIES/configtz.php');
	include_once('UTILITIES/dbutils.php');
	include_once("header.php");
	$pageTitle = "My Data";
?>

<?php
	session_start();
	//connect to db
	if(isset($_POST['EntryDate'])){
		$db = connectDB($DBHost,$DBUser,$DBPasswd,$DBName);
		
		$EntryDate = mysqli_real_escape_string($db, $_POST['EntryDate']);
		$HoursWorked = mysqli_real_escape_string($db, $_POST['HoursWorked']);
		$EmployerID = mysqli_real_escape_string($db, $_POST['EmployerID']);
		$Username = $_SESSION['Username'];
		
		/* Get UserID */
		$query = "Select UserID from Users where Username = '$Username';";
		$result = queryDB($query, $db);
		$row = mysqli_fetch_row($result);
		$UserID = $row[0];
		//set up my query
		$query = "Insert INTO WageDataEntries (EntryDate,HoursWorked,UserID,EmployerID) VALUES ('$EntryDate','$HoursWorked','$UserID','$EmployerID');";
		//run the query
		$result = queryDB($query, $db);
		
		header("Location: http://webdev.divms.uiowa.edu/~ngramer/project/?Hours=1");
	
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
	$EntryDate = $_POST['EntryDate'];
	$HoursWorked = $_POST['HoursWorked'];
	$EmployerID = $_POST['EmployerID'];
	
	// check to make sure we have start date
	if (!$startDate) {
		punt("Please enter a Start Date");
	}
	
	// connect to database
	$db = connectDB($DBHost,$DBUser,$DBPasswd,$DBName);
	
	// set up my query, id is not insert but created in the database
	$query = "Insert INTO WageDataEntries (EntryDate,HoursWorked,UserID,EmployerID) VALUES ('$EntryDate','$HoursWorked','$UserID','$EmployerID');";
	// run the query
	$result = queryDB($query, $db);
	
	// check if it worked (not really necessary given the utilities we have)
	if ($result) {
		echo "<p>your hours was added</p>";
	} else {
		punt("<p>Unable to insert your hours </p>");
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
	<th>Hours Worked</th>
	<th>Your Employer</th>
</tr>
</thead>

<tbody>
<?php
	// connect to database
	$db = connectDB($DBHost,$DBUser,$DBPasswd,$DBName);
	
	// set up my query
	$query = "SELECT * FROM WageDataEntries ORDER BY UserID;";
	
	// run the query
	$result = queryDB($query, $db);
	
	while($row = nextTuple($result)) {
		echo "\n <tr>";
		echo "<td><a href='".$row['UserID']."'>".$row['EntryDate']."</a></td>";
		echo "<td>" . $row['HoursWorked'] . "</td>";
		echo "<td>" . $row['EmployerID'] . "</td>";	
		echo "</tr>";
	}
?>

</div> <!-- closing bootstrap container -->
</body>
</html>
