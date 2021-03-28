<?php
require_once realpath(APP_ROOT . "/private/core/vendor/autoload.php");

use Dotenv\Dotenv;

class Envs {

	protected $host;
	protected $user;
	protected $password;
	protected $dbName;

	public $auth_user;
	public $auth_pass;

	function __construct() {
		$dotenv = Dotenv::createImmutable(APP_ROOT);
		$dotenv->load();

		$this->host =  $_ENV['DB_HOST'];
		$this->user = $_ENV['DB_USER'];
		$this->password = $_ENV['DB_PASSWORD'];
		$this->dbName = $_ENV['DB_NAME'];

		$this->auth_user = $_ENV['AUTH_USER'];
		$this->auth_pass = $_ENV['AUTH_PW'];
	}



}