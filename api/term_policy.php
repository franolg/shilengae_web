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
		header("Access-Control-Allow-Methods: GET");
		header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");
		include '../private/connect.php'; // including every class from the root/private/connect.php.
		$cog = new Cog(); // getting instance of the cog class to filter texts

		if (isset($_GET['lang'])){ // Checking if the language is Provided
			$app = new App();
			$msg = $app->showTerm($cog->u($_GET['lang']));
		}
		else {
			$app = new App();
			$msg = $app->showTerm();
		}
		echo $cog->j($msg); // showing the message
}else {
		header("WWW-Authenticate: Basic realm='Private Area'");
		header("HTTP/1.0 401  Unauthorized");
		print("Sorry, you need proper credentials");
		exit;
	}
}

?>