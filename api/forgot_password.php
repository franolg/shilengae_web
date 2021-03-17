<?php
if (!isset($_SERVER['PHP_AUTH_USER'])) {
	header("WWW-Authenticate: Basic realm='Private Area'");
	header("HTTP/1.0 401  Unauthorized");
	print("Sorry, you need proper credentials");
	exit;
}else {
	if ($_SERVER['PHP_AUTH_USER'] == 'SHAPIUSER' && $_SERVER['PHP_AUTH_PW'] == '02032198334276') {
		header("Access-Control-Allow-Origin: *");
		header("Content-Type: application/json");
		header("Access-Control-Allow-Methods: POST");
		header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");
		include '../private/connect.php'; // including every class from the root/private/connect.php.

		$error_1 = "Mobile is required."; // error text 1  
		$error_2 = "New Password is required."; // error text 2
		$error_3 = "Confirm Password is required."; // error text 3 
		$error_4 = "Calling code is required."; // error text 3 
		$error_5 = "Password doesn't match."; // error text 3 
		$error_6 = "Password length must be 6 more."; // error text 4
		$error_7 = "Can't change the password."; // error text 5
		$success = "Password changed successfully.";
		$cog = new Cog(); // getting instance of the cog class to filter texts
		if (isset($_POST['mobile'])) { // Checking if the mobile number is Provided
			if(isset($_POST['new'])) { // Checking if the current password is Provided
				if(isset($_POST['confirm'])){ // Checking if the new password is Provided
					if(isset($_POST['code'])) {
						$new_password = $cog->u($_POST['new']);
						$confirm_password = $cog->u($_POST['confirm']);
						$mobile = $cog->u($_POST['mobile']);
						$code = $cog->u($_POST['code']);
						if($new_password == $confirm_password){
							$password = new Password($mobile,$new_password,$code);
							if ($password->isPasswordValid()) {
								if($password->changePassword()){
									$msg = array('success' => 1,'statuscode' => 200,"msg" => $success,"su" => "Registered Successfully"); // setting success message
								}else {
									$msg = array('success' => 0,'statuscode' => 400,"msg" => $error_7); // setting error 3
								}
							}else {
								$msg = array('success' => 0,'statuscode' => 400,"msg" => $error_6); // setting error 4
							}
						}
						else {
							$msg = array('success' => 0,'statuscode' => 400,"msg" => $error_5); // setting error 3
						}
					} else {
						$msg = array('success' => 0,'statuscode' => 400,"msg" => $error_4); // setting error 3
					}
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