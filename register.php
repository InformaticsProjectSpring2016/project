<?php
	$menuHighlight = 0;
	$pageTitle="Register";
	include_once("header.php");
?>


<div class = "col-xs-2"></div> <!-- Used to push jumbotron smaller and to the right -->
<div class = "col-xs-8">
<div class="text-center">
	<!-- jumbotron-->
	<div class="jumbotron">

		<div class="text-center">
			<h1>Register</h1>
			<p class="lead">Please enter your information below.</p>
			
		<form action="sendRegistration.php" method="post">
			<div class="form-group">
				<div class="input-group">	
					<div class="input-group-addon">First Name</div>
					<input type="text" class="form-control" placeholder="First Name" name="firstname"/>
				</div>
			</div>
			
			<div class="form-group">
				<div class="input-group">	
					<div class="input-group-addon">Last Name</div>
					<input type="text" class="form-control" placeholder="Last Name" name="lastname"/>
				</div>
			</div>
			
			<div class="form-group">
				<div class="input-group">	
					<div class="input-group-addon">Age</div>
					<input type="number" class="form-control" placeholder="Age" name="age"/>
				</div>
			</div>
			
			<div class="form-group">
				<div class="input-group">	
					<div class="input-group-addon">Email</div>
					<input type="email" class="form-control" placeholder="Email" name="email"/>
				</div>
			</div>
			
			<div class="form-group">
				<div class="input-group">	
					<div class="input-group-addon">Cellphone Number</div>
					<input type="number" class="form-control" placeholder="Enter 10-digit Cellphone Number" name="cell"/>
				</div>
			</div>
			
			<div class="form-group">
				<div class="input-group">	
					<div class="input-group-addon">Employer (Will be php'd to include google)</div>
					<input type="text" class="form-control" placeholder="Employer" name="employer"/>
				</div>
			</div>
			
			<div class="form-group">
				<!--<label for="username">Username</label>-->
				<div class="input-group">	
					<div class="input-group-addon">Username</div>
					<input type="text" class="form-control" placeholder="Username" name="username"/>
				</div>
			</div>
				
			<div class="form-group">
				<!--<label for="password">Password</label>-->
				<div class="input-group">
					<div class="input-group-addon">Password</div>
					<input type="password" class="form-control" placeholder="Password" name="password"/>
				</div>
			</div>
			
			<div class="form-group">
				<!--<label for="password">Confirm Password</label>-->
				<div class="input-group">
					<div class="input-group-addon">Confirm Password</div>
					<input type="password" class="form-control" placeholder="Confirm Password" name="confirm password"/>
				</div>
			</div>
			
			<button type="submit" class="btn btn-success btn-lg" name="submit">Register</button>
		</form>
		</div>
	</div> <!-- Jumbotron -->
</div>
</div>

<?php
	include_once("footer.php");
?>
