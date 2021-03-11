<?php
define("APP_ROOT", dirname(dirname(__FILE__)));
define("PRIVATE_PATH", APP_ROOT . "/private");


require_once(PRIVATE_PATH . "/database/dbconnect.php");
require_once(PRIVATE_PATH . "/core/cog.php");
require_once(PRIVATE_PATH . "/core/login.php");
require_once(PRIVATE_PATH . "/core/country.php");
require_once(PRIVATE_PATH . "/core/password.php");
require_once(PRIVATE_PATH . "/core/users.php");
require_once(PRIVATE_PATH . "/core/app.php");

?>