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
	public function addUser($firstname,$lastname,$email,$mobile,$password,$country,$callingcode,$language) {

		$db = Database::getInstance(); // getting instance of the database.
		$c = $db->getc();
		$cog = new Cog(); // getting instance of cog class. 
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
		if(!$this->mobileExist($email)) {
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
	}
}