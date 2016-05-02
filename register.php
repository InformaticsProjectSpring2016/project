<?php
	$menuHighlight = 0;
	$pageTitle="Register";
	include_once("header.php");
?>


<div class ="container">
<div class = "col-xs-12">
	<!-- jumbotron--> 
	<div class="jumbotron">

		<div class="text-center">
			<h1>Register</h1>
			<p class="lead">Please enter your information below.</p>
			
		<form id="register" action="UTILITIES/storeRegistration.php" class="form-horizontal" method="post">
			<div class="row">
				<div class="form-group">
					<label class="col-sm-2 control-label">First Name</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" placeholder="First Name" name="Firstname" required>
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="form-group">
					<label class="col-sm-2 control-label">Last Name</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" placeholder="Last Name" name="Lastname" required>
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="form-group">
					<label class="col-sm-2 control-label">Age</label>
					<div class="col-sm-8">
						<input type="number" class="form-control" placeholder="Age" name="Age" required maxlength="3">
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="form-group">
					<label class="col-sm-2 control-label">Email</label>
					<div class="col-sm-8">
						<input type="email" class="form-control" placeholder="Email" name="Email" required>
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="form-group">
					<label class="col-sm-2 control-label">Cellphone Number</label>
					<div class="col-sm-8">
						<input type="number" class="form-control" placeholder="Enter 10-digit Cellphone Number" name="Cell" required>
					</div>
				</div>
			</div>
						
			<div class="row">
				<div class="form-group">
					<label class="col-sm-2 control-label">Username</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" placeholder="Username" name="Username" required maxlength="15">
					</div>
				</div>
			</div>
				
			<div class="row">
				<div class="form-group">
					<label class="col-sm-2 control-label">Password</label>
					<div class="col-sm-8">
						<input type="password" class="form-control" placeholder="Password" name="Password1" required maxlength="15">
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="form-group">
					<label class="col-sm-2 control-label">Confirm Password</label>
					<div class="col-sm-8">
						<input type="password" class="form-control" placeholder="Confirm Password" name="Password2" required maxlength="15">
					</div>
				</div>
			</div>
			
			<button type="submit" class="btn btn-success btn-lg" name="submit">Register</button>
		</form>
		</div>
	</div> <!-- Jumbotron -->
	</div> <!-- Container -->
</div>


<?php
	include_once("footer.php");
?>
