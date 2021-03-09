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
		$cog = new Cog(); //getting instance of the cog class to filter texts.
		$box = new Country(); // getting instance of the country class.
		$msg = $box->ListCountry(); // calling listcountry method from the country class to show list of countries.
		printf($cog->j($msg)); // show the result.

	}else {
		header("WWW-Authenticate: Basic realm='Private Area'");
		header("HTTP/1.0 401  Unauthorized");
		print("Sorry, you need proper credentials");
		exit;
	}
}

?>