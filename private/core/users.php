<?php

class Users {
	
	public function getNamefromID($id,$fullname) {

		$db = Database::getInstance(); // getting instance of the database.
		$c = $db->getc();
		$cog = new Cog(); // getting instance of cog class. 	
		$id = $cog->sql_prep($id);
		$adc = $c->query("SELECT * FROM tableusers WHERE user_id = '$id'"); // getting user with the same id
		$exe = $adc->fetch_array();
        $result = $fullname ? $exe['first_name']." ".$exe['last_name'] : $exe['first_name'];
        return $result;
	}
	public function emailExist($email) {

		$db = Database::getInstance(); // getting instance of the database.
		$c = $db->getc();
		$cog = new Cog(); // getting instance of cog class. 	
		$email = $cog->sql_prep($email);
		$adc = $c->query("SELECT * FROM tableusers WHERE email = '$email'"); // getting user with the same id
		$exe = $adc->num_rows;
        $result = $exe == 0 ? false : true;
        return $result;
	}
	public function mobileExist($mobile) {

		$db = Database::getInstance(); // getting instance of the database.
		$c = $db->getc();
		$cog = new Cog(); // getting instance of cog class. 	
		$mobile = $cog->sql_prep($mobile);
		$adc = $c->query("SELECT * FROM tableusers WHERE mobile = '$mobile'"); // getting user with the same id
		$exe = $adc->num_rows;
        $result = $exe == 0 ? false : true;
        return $result;
	}
	public function addUser($firstname = "",$lastname = "",$email = "",$mobile = "",$password = "",$country = "",$callingcode = "",$language = "",$facebook = false,$img = "") {
		$db = Database::getInstance(); // getting instance of the database.
		$c = $db->getc();
		$cog = new Cog(); // getting instance of cog class. 
		if(!$facebook) {
				$userid = uniqid()."/".time();
				$firstname = $cog->sql_prep($firstname);
				$lastname = $cog->sql_prep($lastname);
				$email = $cog->sql_prep(urldecode($email));
				$mobile = $cog->sql_prep($mobile);
				$password = $cog->sql_prep($password);
				$country = $cog->sql_prep($country);
				$callingcode = $cog->sql_prep($callingcode);
				$language = $cog->sql_prep($language);
				$timer = time();
				if(!$this->mobileExist($mobile)) {
					if(!$this->emailExist($email)) {
						if($c->query("INSERT INTO tableusers (user_id,first_name,last_name,email,mobile,password,country,calling_code,language,joined) VALUES ('$userid','$firstname','$lastname','$email','$mobile','$password','$country','$callingcode','$language','$timer')")){
							return array('success' => 1,'statuscode' => 200,"msg" => "Registered Successfully");
						}else {
							return array('success' => 0,'statuscode' => 400,"msg" => "Unable to register");
						}
					}else {
						return array('success' => 0,'statuscode' => 400,"msg" => "Email address already exists");
					}
				}else {
					return array('success' => 0,'statuscode' => 400,"msg" => "Mobile number already exists");
				}
		}else {
			$userid = uniqid()."/".time();	
			$firstname = $cog->sql_prep($firstname);	
			$lastname = $cog->sql_prep($lastname);	
			$email = $cog->sql_prep(urldecode($email));	
			$img = $cog->sql_prep(urldecode($img));
			$timer = time();
			if(!$this->emailExist($email)) {
				if($c->query("INSERT INTO tableusers (user_id,first_name,last_name,email,joined) VALUES ('$userid','$firstname','$lastname','$email','$timer')")){
					return array('success' => 1,'statuscode' => 200,"msg" => "Registered Successfully");
				}else {
					return array('success' => 0,'statuscode' => 400,"msg" => "Unable to register");
				}
			}else {
				if($c->query("UPDATE tableusers SET first_name = '$firstname',last_name = '$lastname',social_profile_image = '$img',modified_at = '$timer' WHERE email = '$email'")){
					return array('success' => 1,'statuscode' => 200,"msg" => "Your facebook account have been linked successfully.");
				}else {
					return array('success' => 0,'statuscode' => 400,"msg" => "Unable to link you facebook account");
				}
			}
		} 
	}

	public function verifyMobile($code,$mobile) {
		$db = Database::getInstance(); // getting instance of the database.
		$c = $db->getc();
		$cog = new Cog(); // getting instance of cog class.
		$code = $cog->sql_prep($code);
		$mobile = $cog->sql_prep($mobile);
		$timer = time();
		if($c->query("UPDATE tableusers SET mverified = 1,modified_at = '$timer' WHERE email = '$email'")){
			return array('success' => 1,'statuscode' => 200,"msg" => "Mobile number verified successfully.");
		}else {
			return array('success' => 0,'statuscode' => 400,"msg" => "Unable to verified you're Mobile number");
		}
	}
}