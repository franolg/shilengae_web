<?php
session_start();
ob_start();

spl_autoload_register('AutoLoader');

define("APP_ROOT", dirname(dirname(__FILE__)));
define("PRIVATE_PATH", APP_ROOT . "/private");
define('LOCAL', APP_ROOT . "/localization/lang.json");

function AutoLoader($classname) {
	$dir = PRIVATE_PATH . "/core/views/";
	$extention = ".php";
	$path = $dir . $classname . $extention;
	if (!file_exists($path)) {
		$dir = PRIVATE_PATH . "/core/controllers/";
		$path = $dir . $classname . $extention;
		if (!file_exists($path)) {
			$dir = PRIVATE_PATH . "/core/model/";
			$path = $dir . $classname . $extention;
			if (!file_exists($path)) {
				if (!file_exists($path)) {
					$dir = PRIVATE_PATH . "/database/";
					$path = $dir . $classname . $extention;
					if (!file_exists($path)) {
						echo "Internal Error";
						exit();
					}
				}
			}
		}
	}

	require_once $path;
}

?>