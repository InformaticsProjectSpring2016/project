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
						<input type="number" class="form-control" placeholder="Age" name="Age" required>
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
			
			<!-- I think we should prompt them to add employment after they've registered and logged in
			

			-->
			
			
			<input id="pac-input" class="controls" type="text"
			placeholder="Enter a location">
			<div id="map"></div>

			
			<script>
			  // This sample uses the Place Autocomplete widget to allow the user to search
			  // for and select a place. The sample then displays an info window containing
			  // the place ID and other information about the place that the user has
			  // selected.

			  // This example requires the Places library. Include the libraries=places
			  // parameter when you first load the API. For example:
			  // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

			  function initMap() {
				var map = new google.maps.Map(document.getElementById('map'), {
				  center: {lat: -41.661, lng: -91.5302},
				  zoom: 13
				});

				var input = document.getElementById('pac-input');

				var autocomplete = new google.maps.places.Autocomplete(input);
				autocomplete.bindTo('bounds', map);

				map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

				var infowindow = new google.maps.InfoWindow();
				var marker = new google.maps.Marker({
				  map: map
				});
				marker.addListener('click', function() {
				  infowindow.open(map, marker);
				});

				autocomplete.addListener('place_changed', function() {
				  infowindow.close();
				  var place = autocomplete.getPlace();
				  if (!place.geometry) {
					return;
				  }

				  if (place.geometry.viewport) {
					map.fitBounds(place.geometry.viewport);
				  } else {
					map.setCenter(place.geometry.location);
					map.setZoom(17);
				  }

				  // Set the position of the marker using the place ID and location.
				  marker.setPlace({
					placeId: place.place_id,
					location: place.geometry.location
				  });
				  marker.setVisible(true);

				  infowindow.setContent('<div><strong>' + place.name + '</strong><br>' +
					  'Place ID: ' + place.place_id + '<br>' +
					  place.formatted_address);
				  infowindow.open(map, marker);
				});
			  }
			</script>
			<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBUJpVVIMGYMFzK_6qEi_PjDJyh5BGbJ00&libraries=places&callback=initMap"
				async defer></script>
			
			
			
			<div class="row">
				<div class="form-group">
					<label class="col-sm-2 control-label">Username</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" placeholder="Username" name="Username" required>
					</div>
				</div>
			</div>
				
			<div class="row">
				<div class="form-group">
					<label class="col-sm-2 control-label">Password</label>
					<div class="col-sm-8">
						<input type="password" class="form-control" placeholder="Password" name="Password1" required>
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="form-group">
					<label class="col-sm-2 control-label">Confirm Password</label>
					<div class="col-sm-8">
						<input type="password" class="form-control" placeholder="Confirm Password" name="Password2" required>
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
