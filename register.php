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
			
		<form id="register" action="UTILITIES/storeRegistration.php" method="post">
			<div class="form-group">
				<div class="input-group">	
					<div class="input-group-addon">First Name</div>
					<input type="text" class="form-control" placeholder="First Name" name="Firstname" required>
				</div>
			</div>
			
			<div class="form-group">
				<div class="input-group">	
					<div class="input-group-addon">Last Name</div>
					<input type="text" class="form-control" placeholder="Last Name" name="Lastname" required>
				</div>
			</div>
			
			<div class="form-group">
				<div class="input-group">	
					<div class="input-group-addon">Age</div>
					<input type="number" class="form-control" placeholder="Age" name="Age" required>
				</div>
			</div>
			
			<div class="form-group">
				<div class="input-group">	
					<div class="input-group-addon">Email</div>
					<input type="email" class="form-control" placeholder="Email" name="Email" required>
				</div>
			</div>
			
			<div class="form-group">
				<div class="input-group">	
					<div class="input-group-addon">Cellphone Number</div>
					<input type="number" class="form-control" placeholder="Enter 10-digit Cellphone Number" name="Cell" required>
				</div>
			</div>
			
			<div class="form-group">
				<div class="input-group">	
					<div class="input-group-addon">Employer (Will be php'd to include google)</div>
					<input type="text" class="form-control" placeholder="Employer" name="Employer" required>
				</div>
			</div>
			
			<div class="form-group">
				<!--<label for="username">Username</label>-->
				<div class="input-group">	
					<div class="input-group-addon">Username</div>
					<input type="text" class="form-control" placeholder="Username" name="Username" required>
				</div>
			</div>
				
			<div class="form-group">
				<!--<label for="password">Password</label>-->
				<div class="input-group">
					<div class="input-group-addon">Password</div>
					<input type="password" class="form-control" placeholder="Password" name="Password1" required>
				</div>
			</div>
			
			<div class="form-group">
				<!--<label for="password">Confirm Password</label>-->
				<div class="input-group">
					<div class="input-group-addon">Confirm Password</div>
					<input type="password" class="form-control" placeholder="Confirm Password" name="Password2" required>
				</div>
			</div>
			
			<button type="submit" class="btn btn-success btn-lg" name="submit">Register</button>
		</form>
		<script>
		$(document).ready(function() {
			$('#register').validate({
				rules: {
					Username: {
						// Send { username: 'its value', type: 'username' } to the back-end
						remote: {
							message: 'The username is already taken',
							url: 'UTILITES/checkRegistrationData.php',
							type: 'POST',
							data: {
								type: 'Username'
							},
						}
						
					}
				}
				messages:{
					Username:{
						remote: "Email in use"
					}
				}
			});
		});
		</script>
		</div>
	</div> <!-- Jumbotron -->
</div>
</div>

<?php
	include_once("footer.php");
?>
