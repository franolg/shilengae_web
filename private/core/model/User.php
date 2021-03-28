<?php

/**
 * User Model
 */
class User extends Database {

	protected function Auth($mobile,$code) {
		$sql = "SELECT * FROM tableusers WHERE mobile = ? AND calling_code = ?";
		$stmt = $this->c()->prepare($sql);
		$stmt->execute([$mobile,$code]);
		if ($stmt->rowCount() > 0) {
			return $stmt->fetch();
		}else {
		 	return [];
		}
	}

	protected function AdminAuth($username) {
		$sql = "SELECT * FROM tableportalusers WHERE username = ?";
		$stmt = $this->c()->prepare($sql);
		$stmt->execute([$username]);
		if ($stmt->rowCount() > 0) {
			return $stmt->fetch();
		}else {
		 	return [];
		}
	}

	protected function Exist($code,$mobile) {
		$sql = "SELECT * FROM tableusers WHERE mobile = ? AND calling_code = ?";
		$stmt = $this->c()->prepare($sql);
		$stmt->execute([$mobile,$code]);
		return $stmt->rowCount() == 0 ? false : true;
	}

	protected function FindEmail($email) {
		$sql = "SELECT * FROM tableusers WHERE email = ?";
		$stmt = $this->c()->prepare($sql);
		$stmt->execute([urldecode($email)]);
        return $stmt->rowCount() == 0 ? false : true;
    }

	protected function Add($firstname,$lastname,$mobile,$password,$country,$callingcode,$language,$business,$company) {
		$userid = uniqid()."/".time();
		$timer = time();
		$sql = "INSERT INTO tableusers (user_id,first_name,last_name,mobile,password,country,calling_code,language,business,company,joined) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
		$stmt = $this->c()->prepare($sql);
		if($stmt->execute([$userid,$firstname,$lastname,$mobile,$password,$country,$callingcode,$language,$business,$company,$timer])){
			return true;
		}else {
			return false;
		}
	}

	protected function Facebook($userid,$firstname,$lastname,$email,$img,$timer) {
		if(!$this->FindEmail($email)) {
			$sql = "INSERT INTO tableusers (user_id,first_name,last_name,email,social_profile_image,joined) VALUES (?,?,?,?,?,?)";
			$stmt = $this->c()->prepare($sql);
			if($stmt->execute([$userid,$firstname,$lastname,urldecode($email),$img,$timer])){
				return true;
			}else {
				return false;
			}
		}else {
			$sql = "UPDATE tableusers SET first_name = ?,last_name = ?,social_profile_image = ?,modified_at = ? WHERE email = ?";
			$stmt = $this->c()->prepare($sql);
			if($stmt->execute([$firstname,$lastname,$img,$timer,urldecode($email)])){
				return true;
			}else {
				return false;
			}
		}
	}

	protected function ChangePassword($code,$mobile,$password) {
		$sql = "UPDATE tableusers SET password = ? WHERE mobile = ? AND calling_code = ?";
		$stmt = $this->c()->prepare($sql);
		if ($stmt->execute([password_hash($password, PASSWORD_BCRYPT),$mobile,$code])) {
			return true;
		}else {
			return false;
		}
	}

}