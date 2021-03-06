<?php
	$menuHighlight = 0;
	$pageTitle="Project Landing Page";
	include_once("header.php");
?>


<!-- Content row -->
<div class = "container animated slideInUp">
	<div class = "col-xs-12">
		<!-- jumbotron-->
		<div class="jumbotron">
			<div class="text-center">
				<h1>Welcome</h1>
				<?php
					if(!$loggedIn){
						echo '<p class="lead">Please login or register to begin.</p>
						<a href ="login.php" class="btn btn-success btn-lg" role="button" >Login</a>
						<a href ="register.php" class="btn btn-info btn-lg" role="button" >Register</a>';
						
					}else{	
						if($_GET["paycheck"] == "1"){
							echo '<div class="alert alert-success animated fadeIn" role="alert">Thanks for adding your paycheck.</div>';
						}
						if($_GET["Hours"] == "1"){
							echo '<div class="alert alert-success animated fadeIn" role="alert">Thanks for adding your hours worked.</div>';
						}
						if($_GET["authorized"] == "0"){
							echo '<div class="alert alert-danger animated fadeIn" role="alert">You are not authorized to view this page.</div>';
						}
						echo '
						<p class="lead">You are logged in!</p>
						<div class="row">
							<h2>Quick Report: </h2>
						</div>
						<div class="row">';
						// Get employers to echo buttons out for
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
								echo '<a href="http://webdev.divms.uiowa.edu/~ngramer/project/enterhoursdata.php?employer='. $row[1] . '"><button type="button" class="btn btn-info btn-lg margin">'. $row[0] .'</button></a>';
							}
						}
						else{
							echo '<a href="http://webdev.divms.uiowa.edu/~ngramer/project/addemployment.php"><button type="button" class="btn btn-warning btn-lg">Add Employer</button></a>';
						}
						echo '</div>';
					}
				?>
			</div>
	</div> <!-- Jumbotron -->
</div>
</div>

<div> <p></p> </div>

<div class="container info animated slow fadeIn">
  <div class="text-center">
    <h2>What is wage theft?</h2>
    <p>Wage theft is defined as what is happening when workers "are paid less than the minimum 
       wage, denied overtime pay, forced to work off the clock, and those whose paycheck does not 
       reflect the hours worked." Our website is designed to let employees report their hours worked
   	   and their paychecks received. The site will then calculate whether or not the recieved pay
   	   totals what is should be. Our site is monitored by not-for-profit companies that are interested
   	   in tracking and reporting instances of wage theft.</p>
  </div>
  <div class="text-center">
  	<p> Check out <a href="http://www.wagetheft.org/"> WageTheft.org</a> for more information. </p>
</div>
</div>

<?php
	include_once("footer.php");
?>

