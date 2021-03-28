<?php

/**
 * 
 */
class UserController extends User {
	
	public function ChangePass($code,$mobile,$password) {
		return $this->ChangePassword($code,$mobile,$password);
	}
	public function addUser($firstname,$lastname,$mobile,$password,$country,$callingcode,$language,$business,$company) {
		if(!$this->Exist($callingcode,$mobile)) {
				if($this->Add($firstname,$lastname,$mobile,$password,$country,$callingcode,$language,$business,$company)){
					return array('success' => 1,'statuscode' => 200,"msg" => "Registered Successfully");
				}else {
					return array('success' => 0,'statuscode' => 400,"msg" => "Unable to register");
				}
		}else {
			return array('success' => 0,'statuscode' => 400,"msg" => "Mobile number already exists");
		}
	}

}