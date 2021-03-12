<?php
if (!isset($_SERVER['PHP_AUTH_USER'])) {
	header("WWW-Authenticate: Basic realm='Private Area'");
	header("HTTP/1.0 401  Unauthorized");
	print("Sorry, you need proper credentials");
	exit;
}else {
	if ($_SERVER['PHP_AUTH_USER'] == 'mike' && $_SERVER['PHP_AUTH_PW'] == '1234') {
		header("Access-Control-Allow-Origin: *");
		header("Content-Type: application/json");
		header("Access-Control-Allow-Methods: GET");
		header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");
		include '../private/connect.php'; // including every class from the root/private/connect.php.
		$error_1 = "Calling code is required"; // error text 1  
		$error_2 = "Mobile is required"; // error text 1  
		$error_3 = "Email address is required"; // error text 2
		$success = "Good to go"; // success message
		$cog = new Cog(); // getting instance of the cog class to filter texts
		if (isset($_GET['code'])){ // Checking if the mobile number is Provided
			if (isset($_GET['mobile'])){ // Checking if the mobile number is Provided
				if (isset($_GET['email'])){ // Checking if the mobile number is Provided
					$mobile = new Password($cog->u($_GET['mobile']),"",$cog->u($_GET['code']));
					$msg = $mobile->CheckME($cog->u($_GET['email']));
				}else {
					$msg = array('success' => 0,'statuscode' => 400,"msg" => $error_3); // setting error 1
				}
			}
			else {
				$msg = array('success' => 0,'statuscode' => 400,"msg" => $error_2); // setting error 1
			}
		}
		else {
				$msg = array('success' => 0,'statuscode' => 400,"msg" => $error_1); // setting error 1
			}
		printf($cog->j($msg)); // showing the message
}else {
		header("WWW-Authenticate: Basic realm='Private Area'");
		header("HTTP/1.0 401  Unauthorized");
		print("Sorry, you need proper credentials");
		exit;
	}
}

?>