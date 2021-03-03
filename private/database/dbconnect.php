<?php
class Database {
	private $_connection;

	private static $_instance;
	public static function getInstance()
	{
		if (!self::$_instance) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	public function __construct()
	{
		/*
		host = localhost
		user = root
		password = 
		database =  shilengae
		*/
		$this->_connection  = new mysqli('localhost','root','','shilengae');  // conncting database 

		if (mysqli_connect_error()) {
			trigger_error('Failed to connect to MySQL: '. mysqli_connect_error(), E_USER_ERROR);
		}
	}
	private function __clone(){}
	public function getc()
	{
		return $this->_connection;
	}
}

?>