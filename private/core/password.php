<?php
class Password {

	public $mobile;
	public $password;
	public $code;
	public function __construct($mobile = "",$password = "",$code = "") {
		$this->mobile = $mobile;
		$this->password = $password;
		$this->code = $code;
	}
	public function isPasswordValid() {
		if (strlen($this->password) < 6 && strlen($this->password) > 15) {
			return false;
		}else {
			return true;
		}
	}
	public function isMobileReg() {
		$db = Database::getInstance();
		$c = $db->getc();
		$cog = new Cog();
		$qur = $c->query("SELECT * FROM tableusers WHERE mobile = '".$cog->sql_prep($this->mobile)."' AND calling_code = '".$cog->sql_prep($this->code)."'");
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
		if ($c->query("UPDATE tableusers SET password = '".$cog->sql_prep($this->password)."' WHERE mobile = '".$cog->sql_prep($this->mobile)."' AND calling_code = '".$cog->sql_prep($this->code)."'")) {
			return true;
		}else {
			return false;
		}
	}

	public function CheckME() {
		$db = Database::getInstance();
		$c = $db->getc();
		$cog = new Cog();
		$qur = $c->query("SELECT * FROM tableusers WHERE mobile = '".$cog->sql_prep($this->mobile)."' AND calling_code = '".$cog->sql_prep($this->code)."'");
		if ($qur->num_rows == 0) {
			return array('success' => 1,'statuscode' => 200,"msg" => "Good to go"); // setting success
		}else {
			return array('success' => 0,'statuscode' => 400,"msg" => "Mobile number already exists"); // setting error 1
		}
	}
	
}
?>