<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");
include '../private/connect.php'; // including every class from the root/private/connect.php.

$error_1 = "Mobile is required."; // error text 1  
$error_2 = "Current Password is required."; // error text 2
$error_3 = "New Password is required."; // error text 3 
$error_4 = "Current Password is not correct."; // error text 4
$error_5 = "Can't change the password."; // error text 5
$success = "Password changed successfully."
$cog = new Cog(); // getting instance of the cog class to filter texts
$mobile = $cog->u($_GET['mobile']);
$current_password = $cog->u($_GET['current_p']);
$new_password = $cog->u($_GET['new_p']);
if (isset($mobile)){ // Checking if the mobile number is Provided
	if(isset($current_password)){ // Checking if the current password is Provided
		if(isset($new_password)){ // Checking if the new password is Provided
			$password = new password($mobile,$current_password,$new_password);
			if ($password->isPassword()) {
				if($password->changePassword()){
					$msg = array('success' => 1,'statuscode' => 200,"msg" => $success); // setting success message
				}else {
					$msg = array('success' => 0,'statuscode' => 400,"msg" => $error_5); // setting error 3
				}
			}else {
				$msg = array('success' => 0,'statuscode' => 400,"msg" => $error_4); // setting error 4
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
?>