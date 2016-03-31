<?php
// Contains some common PHP db functions. Here, we always check the  
// return object/value for errors.  Uses the mysqli functional interface
// as opposed to the mysqli object interface.
include_once("config.php");
// Connect to DB: config.php contains DB configuration.
function connectDB($DBHost,$DBUser,$DBPasswd,$DBName) {
  $db = mysqli_connect($DBHost,$DBUser,$DBPasswd,$DBName);
  if (mysqli_connect_errno() != 0)
    punt("Can't connect to MySQL server $DBHost db $DBName as user $DBUser");
  return($db);
}

// Submit a query and return a result object. This is just syntactic 
// sugar and error trapping.
function queryDB($query, $db) {
  $result = mysqli_query($db, $query);
  if (!$result)
    punt ('Error in queryDB()', $query, $db);
  return ($result);
}

// How many tuples in the result? Syntactic sugar.
function nTuples($result) {
  return(mysqli_num_rows($result));
}

// Get next record as an associative array. Syntactic sugar.
function nextTuple($result) {
  return (mysqli_fetch_assoc($result));
}


//connect to db and verify passwords. Returns True or False
function VerifyPassword($username, $password){
	$db = connectDB("dbdev.cs.uiowa.edu","ngramer","U5GMzDSTchGY","db_ngramer");
	// prep query
	$query = "SELECT UserPassword FROM Users WHERE Username = '$username';";
	
	// execute sql statement
	$result = queryDB($query, $db);

	if(nTuples($result) > 0){
		$row = mysqli_fetch_row($result);
		return(crypt($password,$row[0]) == $row[0]);
	}
	return(False);
}

// This is used to verify a user's mobile registration code
/* function VerifyMobileRegistration($username, $registrationCode){
	$db = connectDB($DBHost,$DBUser,$DBPassword,$DBName);
	// prep query
	$query = "select code FROM MobileCodes WHERE UserName = '$username';";
	
	// execute sql statement
	$result = queryDB($query, $db);

	if(nTuples($result) > 0){
		$row = mysqli_fetch_row($result);
		if ($row[0] == $registrationCode){
			return(True);
		}
	}
	return(False);
} */

// Used for debugging. If invoked with a SQL query string
// as the optional second argument, will also retrieve and
// display MySQL error information. Otherwise, if invoked
// only with one argument, will print that argument.
function punt($message, $query = '', $db = '') {
  $lastPart = '';
  // Check to see if error resulted from a bad query
  if ($query != '')
    $lastPart = "<br><i>$query</i>\n" . '<br>[' . mysqli_errno($db) . '] ' . mysqli_error($db) . "\n";
  die("\n<br><br><b>Error: $message</b>\n" . $lastPart);
}
?>
