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
		header("Access-Control-Allow-Methods: POST");
		header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");
		$error_1 = "First Name is required"; // error text 1  
		$error_2 = "Last Name is required"; // error text 2
		$error_3 = "Mobile is required"; // error text 4
		$error_4 = "Country is required"; // error text 6
		$error_5 = "Calling code is required"; // error text 7 
		$error_6 = "Business account is required"; // error text 7 
		$error_7 = "Company Name is required"; // error text 7 
		$error_8 = "Language is required"; // error text 8

		$cog = new Cog(); // getting instance of the cog class to filter texts
		if (isset($_POST['fn'])){ // Checking if the first name.
			if(isset($_POST['ln'])){ // Checking if the last name. 
					if(isset($_POST['mobile'])) { // Checking if the mobile.
							if(isset($_POST['country'])) { // Checking if the country.
								if(isset($_POST['ccode'])) { // Checking if the calling code.
									if(isset($_POST['business'])) { // Checking if the account is for business .
										if(isset($_POST['company'])) { // Checking if the company.
											if(isset($_POST['lan'])) { // Checking if the language
												$fn = ucwords($cog->u($_POST['fn'])); // getting first name
												$ln = ucwords($cog->u($_POST['ln'])); // getting last name
												$mobile = $cog->u($_POST['mobile']); // getting mobile 
												$password = uniqid(); // getting password 
												$country = $cog->u($_POST['country']); // getting country 
												$ccode = $cog->u($_POST['ccode']); // getting calling code
												$lan = $cog->u($_POST['lan']); // getting language 
												$business = $cog->u($_POST['business']);
												$company = ucwords($cog->u($_POST['company']));
												$reg = new UserController();
												$msg = $reg->AddUser($fn,$ln,$mobile,$password,$country,$ccode,$lan,$business,$company);
											}
											else {
												$msg = array('success' => 0,'statuscode' => 400,"msg" => $error_8); // setting error 8
											}
										}else {
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

}else {
		header("WWW-Authenticate: Basic realm='Private Area'");
		header("HTTP/1.0 401  Unauthorized");
		print("Sorry, you need proper credentials");
		exit;
	}
}

?>