<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");
include '../private/connect.php'; // including every class from the root/private/connect.php.

$error_1 = "First Name is required"; // error text 1  
$error_2 = "Last Name is required"; // error text 2
$error_3 = "Email address is required"; // error text 3 
$error_4 = "Mobile is required"; // error text 4
$error_5 = "Password is required"; // error text 5
$error_6 = "Country is required"; // error text 6
$error_7 = "Calling code is required"; // error text 7 
$error_8 = "Language is required"; // error text 8
$error_9 = "Unable to add user"; // error text 9

$cog = new Cog(); // getting instance of the cog class to filter texts
// $firstname,$lastname,$email,$mobile,$password,$country,$callingcode,$language
if (isset($_GET['fn'])){ // Checking if the first name.
	if(isset($_GET['ln'])){ // Checking if the last name. 
		if(isset($_GET['email'])) { // Checking if the email. 
			if(isset($_GET['mobile'])) { // Checking if the mobile.
				if(isset($_GET['password'])) { // Checking if the password.
					if(isset($_GET['country'])) { // Checking if the country.
						if(isset($_GET['ccode'])) { // Checking if the calling code.
							if(isset($_GET['lan'])) { // Checking if the language
								$fn = $cog->u($_GET['fn']); // getting first name
								$ln = $cog->u($_GET['ln']); // getting last name
								$email = $cog->u($_GET['email']); // getting email 
								$mobile = $cog->u($_GET['mobile']); // getting mobile 
								$password = $cog->u($_GET['password']); // getting password 
								$country = $cog->u($_GET['country']); // getting country 
								$ccode = $cog->u($_GET['ccode']); // getting calling code
								$lan = $cog->u($_GET['lan']); // getting language 
								$reg = new Users();
								$msg = $reg->addUser($fn,$ln,$email,$mobile,$password,$country,$ccode,$lan);
							}
							else {
								$msg = array('success' => 0,'statuscode' => 400,"msg" => $error_8); // setting error 8
							}
						}
						else {
							$msg = array('success' => 0,'statuscode' => 400,"msg" => $error_7); // setting error 7
						}
					}
					else {
						$msg = array('success' => 0,'statuscode' => 400,"msg" => $error_6); // setting error 6
					}
				}
				else {
					$msg = array('success' => 0,'statuscode' => 400,"msg" => $error_5); // setting error 5
				}	
			}
			else {
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
