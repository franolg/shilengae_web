<?php
class ClassName {

	public $mobile;
	public $password;
	public $newpassword;

	public function __construct($mobile,$password,$newpassword) {
		$this->mobile = $mobile;
		$this->password = $password;
		$this->newpassword = $newpassword;
	}

	public function isPassword() {
		$db = Database::getInstance();
		$c = $db->getc();
		$cog = new Cog();
		$qur = $c->query("SELECT * FROM tableusers WHERE mobile = '".$cog->sql_prep($this->mobile)."' AND password = '".$cog->sql_prep($this->password)."'");
		if ($qur->num_rows != 0) {
			return true;
		}else {
			return false;
		}
	}
	public function changePassword() {
		$db = Database::getInstance();
		$c = $db->getc();
		$cog = new Cog();
		$qur = $c->query("UPDATE tableusers SET password = '".$cog->sql_prep($this->password)."', WHERE mobile = '".$cog->sql_prep($this->mobile)."'");
		if ($qur->num_rows != 0) {
			return true;
		}else {
			return false;
		}
	}
	
}
?>