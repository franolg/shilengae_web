<?php
class Database extends Envs {
	
	// private $host = $this->getenv("DB_HOST");
	// private $user = $this->getenv("DB_USER");
	// private $password = $this->getenv("DB_PASSWORD");
	// private $dbName = $this->getenv("DB_NAME");

	protected function c() {
		try {
			$dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbName;
			$pdo = new PDO($dsn,$this->user,$this->password);
			$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

			return $pdo;
		}catch(PDOException $e) { die("host: ".$this->host); }
	}
}

?>