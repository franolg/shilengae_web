<?php

/**
 * 
 */
class UserController extends User {
	
	public function ChangePass($code,$mobile,$password) {
		return $this->ChangePassword($code,$mobile,$password);
	}
	public function AddUser($firstname,$lastname,$mobile,$password,$country,$callingcode,$language,$business,$company) {
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
	public function EditUser($id,$firstname,$lastname,$email,$mobile,$country,$state,$city,$gender,$birth,$career,$experience,$salary,$callingcode,$business) {
		if($this->IDExist($id)) {
			return $this->Edit($id,$firstname,$lastname,$email,$mobile,$country,$state,$city,$gender,$birth,$career,$experience,$salary,$callingcode,$business);
		}else {
			return false;
		}
	}
	public function DeleteUser($id) {
		return $this->Delete($id);
	}

}