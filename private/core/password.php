<?php
class Password {

	public $mobile;
	public $password;
	public $newpassword;

	public function __construct($mobile = "",$newpassword = "",$password = "") {
		$this->mobile = $mobile;
		$this->password = $password;
		$this->newpassword = $newpassword;
	}
	public function isPasswordValid() {
		if (strlen($this->newpassword) < 6 && strlen($this->newpassword) > 15) {
			return false;
		}else {
			return true;
		}
	}
	public function isMobileReg() {
		$db = Database::getInstance();
		$c = $db->getc();
		$cog = new Cog();
		$qur = $c->query("SELECT * FROM tableusers WHERE mobile = '".$cog->sql_prep($this->mobile)."'");
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
		if ($c->query("UPDATE tableusers SET password = '".$cog->sql_prep($this->password)."' WHERE mobile = '".$cog->sql_prep($this->mobile)."'")) {
			return true;
		}else {
			return false;
		}
	}

	public function CheckME($email) {
		$db = Database::getInstance();
		$c = $db->getc();
		$cog = new Cog();
		$qur = $c->query("SELECT * FROM tableusers WHERE mobile = '".$cog->sql_prep($this->mobile)."'");
		if ($qur->num_rows == 0) {
			$qur = $c->query("SELECT * FROM tableusers WHERE email = '".$cog->sql_prep($email)."'");
			if ($qur->num_rows == 0) {
				return array('success' => 1,'statuscode' => 200,"msg" => "Good to go"); // setting success
			}else {
				return array('success' => 0,'statuscode' => 400,"msg" => "Email address already exists"); // setting error 1
			}
		}else {
			return array('success' => 0,'statuscode' => 400,"msg" => "Mobile number already exists"); // setting error 1
		}
	}
	
}
?>