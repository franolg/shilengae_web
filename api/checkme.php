<?php
if (!isset($_SERVER['PHP_AUTH_USER'])) {
	header("WWW-Authenticate: Basic realm='Private Area'");
	header("HTTP/1.0 401  Unauthorized");
	print("Sorry, you need proper credentials");
	exit;
}else {
	include '../private/connect.php'; // including every class from the root/private/connect.php.
	$env = new Envs();
	if ($_SERVER['PHP_AUTH_USER'] == $env->auth_user && $_SERVER['PHP_AUTH_PW'] == $env->auth_pass) {
		header("Access-Control-Allow-Origin: *");
		header("Content-Type: application/json");
		header("Access-Control-Allow-Methods: GET");
		header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");
		$error_1 = "Calling code is required"; // error text 1  
		$error_2 = "Mobile is required"; // error text 2
		$cog = new Cog(); // getting instance of the cog class to filter texts
		if (isset($_GET['code'])){ // Checking if the mobile number is Provided
			if (isset($_GET['mobile'])){ // Checking if the mobile number is Provided
				$mobile = new UserView();
				$msg = $mobile->CheckUser($_GET['code'],$_GET['mobile']);				
			}
			else {
				$msg = array('success' => 0,'statuscode' => 400,"msg" => $error_2); // setting error 2
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