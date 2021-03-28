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
		$cog = new Cog(); // getting instance of the cog class to filter texts
		if (isset($_GET['lang'])){ // Checking if the language is Provided
			$app = new AppView();
			$msg = $app->showTerm($cog->u($_GET['lang']));
		}
		else {
			$app = new AppView();
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