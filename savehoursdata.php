<?php 
	include_once("header.php");
	$menuHighlight = 0;
	$pageTitle="Enter Hours";
	include_once("UTILITIES/config.php");
	include_once("UTILITIES/dbutils.php");
	session_start();
	if(isset($_POST['EntryDate'])){
		$db = connectDB($DBHost,$DBUser,$DBPasswd,$DBName);
		
		$EntryDate = mysqli_real_escape_string($db, $_POST['EntryDate']);
		$HoursWorked = mysqli_real_escape_string($db, $_POST['HoursWorked']);
		$EmployerID = mysqli_real_escape_string($db, $_POST['EmployerID']);
		$Username = $_SESSION['Username'];
		
		/* Get UserID */
		$UserID = $_SESSION["UserID"];
		
		/* Get EmployerName */
		$EmployerName = mysqli_fetch_row(queryDB("SELECT Name from Employers where EmployerID = '$EmployerID';",$db))[0];
		
		/* Check for existing entries on this day for this employer */
		$query = "Select EntryID, EntryDate,HoursWorked from WageDataEntries WHERE EntryDate = '$EntryDate' and UserID = '$UserID' and EmployerID = '$EmployerID'";
		$result = queryDB($query,$db);
		if(nTuples($result) >0 ){
			echo '
			<div class ="container">
				<div class = "col-xs-12">
					<!-- jumbotron--> 
					<div class="jumbotron">
						<div class="text-center">
							<h1>Enter My Hours</h1>
							<p class="lead">Are these hours in addition to your current hours for this employer or updating/replacing them?</p>
							<div class="alert alert-warning animated fadeIn" role="alert">Selecting multiple entries will eliminate both and replace with your entry. Selecting only one will update that entry.</div>
						<form action="confirmHoursEntry.php" class="form-horizontal" method="post">';
						while($row = mysqli_fetch_row($result)){
							echo '
							<div class="form-group">
							<input type="checkbox" name="EntryID[]" value="'.$row[0].'">
							<tr>
								<td>On Date: '. $row[1] .'</td><br>
								<td>Hours: '. $row[2] .'</td><br>
								<td>For: '. $EmployerName .'</td><br>
							</tr>
							</div>';
						}
						echo'
							<div class="form-group">
								<div class="row">
									<input type="hidden" name="UserID" id="UserID" value="'.$UserID.'"/>
									<input type="hidden" name="EntryDate" id="EntryDate" value="'.$EntryDate.'"/>
									<input type="hidden" name="HoursWorked" id="HoursWorked" value="'.$HoursWorked.'"/>
									<input type="hidden" name="EmployerID" id="EmployerID" value="'.$EmployerID.'"/>
									<button type="addition" class="btn btn-success btn-lg margin" name="type" value="addition">Addition</button>
									<button type="replace" class="btn btn-success btn-lg margin" name="type" value="replace">Update/Replace</button>
								</div>
							</div>
						</form>';
		}else{
			$query = "Insert INTO WageDataEntries (EntryDate,HoursWorked,UserID,EmployerID) VALUES ('$EntryDate','$HoursWorked','$UserID','$EmployerID');";
			$result = queryDB($query, $db);
			
			header("Location: http://webdev.divms.uiowa.edu/~ngramer/project/?Hours=1");
		}
	}else{
		echo "not set";
	}
?>

