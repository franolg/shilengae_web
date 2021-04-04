<?php
class Database extends Envs {

	protected function c() {
		try {
			parent::__construct();
			$dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbName;
			$pdo = new PDO($dsn,$this->user,$this->password);
			$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

			return $pdo;
		}catch(PDOException $e) { die("Database can't connect : ".$this->host); }
	}
}

?>
