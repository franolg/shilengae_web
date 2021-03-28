<?php

/**
 * UserView 
 */
class UserView extends User {

	public function CheckUser($code,$mobile) {
		if (!$this->Exist($code,$mobile)) {
			return array('success' => 1,'statuscode' => 200,"msg" => "Good to go"); // setting success
		}else {
			return array('success' => 0,'statuscode' => 400,"msg" => "Mobile number already exists"); // setting error 1
		}
	}
	public function isPasswordValid($password) {
		if (strlen($password) < 6 && strlen($password) > 15) {
			return false;
		}else {
			return true;
		}
	}
	public function AddFacebook($firstname,$lastname,$email,$img) {
		$userid = uniqid()."/".time();
		$timer = time();

		if ($this->Facebook($userid,$firstname,$lastname,$email,urldecode($img),$timer)) {
			return array('success' => 1,'statuscode' => 200,"msg" => "Your facebook account have been linked successfully.");
		} else {
			return array('success' => 0,'statuscode' => 400,"msg" => "Unable to link you facebook account");
		}
	}

	public function MobileExists($code,$mobile) {
		return $this->Exist($code,$mobile);
	}
}