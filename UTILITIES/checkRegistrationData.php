<?php

$isAvailable = true;
// get a handle to the database
$db = connectDB($DBHost,$DBUser,$DBPasswd,$DBName);

switch ($_POST['type']) {
	case 'Username':
		// prep query
		$query = "Select * from Users WHERE Username = '$_POST[Username]';";
			
		// execute sql statement
		$result = queryDB($query, $db);
		
		if(nTuples($result) != 0){
			$isAvailable = false;
		}
		break;
		
	case 'Email':
		// prep query
		$query = "Select * from Users WHERE Email = '$_POST[Email]';";
			
		// execute sql statement
		$result = queryDB($query, $db);
		
		if(nTuples($result) != 0){
			$isAvailable = false;
		}
		break;
		
	case 'Cell':
		// prep query
		$query = "Select * from Users WHERE Phone = '$_POST[Cell]';";
			
		// execute sql statement
		$result = queryDB($query, $db);
		
		if(nTuples($result) != 0){
			$isAvailable = false;
		}
		break;
echo json_encode(array(
    'valid' => $isAvailable,
));
?>