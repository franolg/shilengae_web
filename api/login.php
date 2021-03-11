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
		$error_1 = "Mobile is required"; // error text 1  
		$error_2 = "Password is required"; // error text 2
		$error_3 = "Calling code is required"; // error text 3 
		$cog = new Cog(); // getting instance of the cog class to filter texts

		if (isset($_POST['mobile'])){ // Checking if the mobile number is Provided
			if(isset($_POST['password'])){ // Checking if the password is Provided
				if(isset($_POST['calling_code'])) { // Checking if calling code is Provided
						$mobile = $cog->u($_POST['mobile']); // getting mobile number
						$password = $cog->u($_POST['password']); // getting password
						$calling_code = $cog->u($_POST['calling_code']);	 // getting calling code
						$access = new Login($mobile,$password,$calling_code,'api'); // getting instance of the Login class and sending data
						$msg = $access->auth(); // calling auth method from the login class 
				}
				else {
					$msg = array('success' => 0,'statuscode' => 400,"msg" => $error_3); // setting error 3
				}
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