<?php

	$menuHighlight = 0;
	$pageTitle="Register";
	include_once("header.php");
	
if (isset($_POST['submit'])) {

    /* check if phone number is valid */
    $phone_number = $_POST['cell'];

    if (empty($phone_number)) {
        exit("Phone number cannot be blank.");
    }

    if (strlen($phone_number) != 10) {
        exit("Invalid phone number. Phone number length should be 10 digits.");
    }

    if (!is_numeric($phone_number)) {
        exit("Invalid phone number. Phone number should contain only digits.");
    }
	
	// Generate random integer, will need to be added to the database and cleaned
	$token = rand(10000,99999); 
	
    $message = "Welcome to our platform, please enter this registration code: $token";

    if (empty($subject) && empty($message)) {
        exit("Message cannot be blank.");
    }


    /* prepare data for sending */
    $data = array(
        "User"          => "ngramer", /* change to your EZ Texting username */
        "Password"      => "finalproject", /* change to your EZ Texting password */
        "PhoneNumbers"  => array($phone_number),
        "Message"       => $message,
        "MessageTypeID" => "1"
    );

    /* send message */
    $curl = curl_init("https://app.eztexting.com/sending/messages?format=json");
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec($curl);
    curl_close($curl);

    /* parse result of API call */
    $json = json_decode($response);

    switch ($json->Response->Code) {
        case 401:
            exit("Invalid user or password");
        case 403:
            $errors = $json->Response->Errors;
            exit("The following errors occurred: " . implode('; ', $errors));
        case 500:
            exit("Service Temporarily Unavailable");
    }
}
?>
	<div class="jumbotron">
		<div class="text-center">
			<div class="form-group">
				<div class="input-group">	
					<div class="input-group-addon">Registration Code</div>
					<input type="number" class="form-control" placeholder="Enter the registration code sent to your phone." name="code"/>
				</div>
			</div>
			<button type="submit" class="btn btn-default" name="submit">Verify</button>
		</div>
	</div>
 
<?php
	include_once("footer.php");
?>