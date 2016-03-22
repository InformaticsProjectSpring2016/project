<?php
	$menuHighlight = 0;
	$pageTitle="Login";
	include_once("header.php");
?>


<div class = "col-xs-2"></div> <!-- Used to push jumbotron smaller and to the right -->
<div class = "col-xs-8">
<div class="text-center">
	<!-- jumbotron-->
	<div class="jumbotron">

		<div class="text-center">
			<h1>Login</h1>
			<p class="lead">Please enter your username and password below.</p>
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
		<button type="submit" class="btn btn-success btn-lg" name="submit">Login</button>
		</div>
	</div> <!-- Jumbotron -->
</div>
</div>

<?php
	include_once("footer.php");
?>
