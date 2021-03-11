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
		header("Access-Control-Allow-Methods: POST");
		header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");
		include '../private/connect.php'; // including every class from the root/private/connect.php.
		$error_1 = "First name is required"; // error text 1  
		$error_2 = "Lasy name address is required"; // error text 2
		$error_3 = "Email address is required"; // error text 3
		$error_4 = "Facebook image is required"; // error text 4
		$cog = new Cog(); // getting instance of the cog class to filter texts

		if (isset($_POST['fn'])){ // Checking if the mobile number is Provided
			if (isset($_POST['ln'])){ // Checking if the mobile number is Provided
				if (isset($_POST['email'])){ // Checking if the mobile number is Provided
					if (isset($_POST['img'])){ // Checking if the mobile number is Provided
						$firstname = $cog->u($_POST['fn']);
						$lastname = $cog->u($_POST['ln']);
						$email = $cog->u($_POST['email']);
						$img = $cog->u($_POST['img']);
						$fb = new Users();
						$msg = $fb->addUser($firstname,$lastname,$email,"","","","","",true,$img);
					}else {
						$msg = array('success' => 0,'statuscode' => 400,"msg" => $error_4); // setting error 4
					}
				}else {
					$msg = array('success' => 0,'statuscode' => 400,"msg" => $error_3); // setting error 3
				}
			}else {
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