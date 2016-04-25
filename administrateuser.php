<?php
	$menuHighlight = 0;
	$pageTitle="Administrator Dashboard";
	include_once("header.php");
	ob_start();
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
			<li class="active"><a href="http://webdev.divms.uiowa.edu/~ngramer/project/admindash.php" data-toggle="pill">Go Back</a></li>
		</ul>
	</div>
	
	<?php
		// get a handle to the database
		$db = connectDB($DBHost,$DBUser,$DBPasswd,$DBName);
		// prep query
		$UserID = $_GET["user"];
		$query = "Select UserID, Username, FirstName, LastName, AccountType, Email from Users where UserID = '$UserID';";
			
		// execute sql statement
		$result = queryDB($query, $db);
		$row = mysqli_fetch_row($result);
		$assocrow = mysqli_fetch_array($result, MYSQLI_ASSOC);
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
				}
		}
	
	?>
	<!-- User Adminstrate Area -->
	<div class="col-md-10">
		<form id="register" action="<?php echo $_SERVER['PHP_SELF'];?>" class="form-horizontal" method="post">
			<div class="row">
				<div class="form-group">
					<label class="col-sm-2 control-label">First Name</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" placeholder="<?php echo $assocrow['FirstName'];?>" name="Firstname">
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="form-group">
					<label class="col-sm-2 control-label">Last Name</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" placeholder="<?php echo $assocrow['LastName'];?>" name="Lastname">
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="form-group">
					<label class="col-sm-2 control-label">Account Type</label>
					<div class="col-sm-8">
						<select name="AccountType">
							<option value ="2">User</option>
							<option value ="1">Non-Profit</option>
							<option value ="0">Administrator</option>
						</select>
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="form-group">
					<label class="col-sm-2 control-label">Email</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" placeholder="<?php echo $assocrow['Email'];?>" name="Email">
					</div>
				</div>
			</div>
			<button type="submit" class="btn btn-success btn-lg" name="submit">Update</button>
			<button type="warning" class="btn btn-success btn-lg" name="cancel" href="webdev.divms.uiowa.edu/~ngramer/project/admindash.php">Cancel</button>
		</form>
	</div>
</div>

<?php
	if(isset($_POST['Firstname'])){
		$Firstname = mysqli_real_escape_string($db, $_POST['Firstname']);
		$query = "UPDATE Users SET FirstName = '$Firstname' where UserID = '$UserID';";
			
		// execute sql statement
		$result = queryDB($query, $db);
	}
	if(isset($_POST['Lastname'])){
		$Lastname = mysqli_real_escape_string($db, $_POST['Lastname']);
		$query = "UPDATE Users SET LastName = '$Lastname' where UserID = '$UserID';";
			
		// execute sql statement
		$result = queryDB($query, $db);	
	}
	if(isset($_POST['AccountType'])){
		$AccountType = mysqli_real_escape_string($db, $_POST['AccountType']);
		$query = "UPDATE Users SET AccountType = '$AccountType' where UserID = '$UserID';";
			
		// execute sql statement
		$result = queryDB($query, $db);	
	}
	if(isset($_POST['Email'])){
		$Email = mysqli_real_escape_string($db, $_POST['Email']);
		$query = "UPDATE Users SET Email = '$Email' where UserID = '$UserID';";
			
		// execute sql statement
		$result = queryDB($query, $db);		
	}
	//header("Location: http://webdev.divms.uiowa.edu/~ngramer/project/admindash.php");
	
?>

<?php
	include_once("footer.php");
	ob_flush()
?>