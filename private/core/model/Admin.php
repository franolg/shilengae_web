<?php

/**
 * 
 */
class Admin extends Database {

	protected function Exist($id) {
		$sql = "SELECT * FROM tableportalusers WHERE admin_id = ?";
		$stmt = $this->c()->prepare($sql);
		$stmt->execute([$id]);
		return $stmt->rowCount() == 0 ? false : true;
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

	protected function Password($id,$password) {
		$sql = "UPDATE tableportalusers SET password = ? WHERE admin_id = ?";
		$stmt = $this->c()->prepare($sql);
		if($stmt->execute([password_hash($password, PASSWORD_BCRYPT),$id])){
			return true;
		}else {
			return false;
		}
	}

	protected function isPassword($id,$password) {
		$sql = "SELECT * FROM tableportalusers WHERE admin_id = ?";
		$stmt = $this->c()->prepare($sql);
		$stmt->execute([$id]);
		$exe = $stmt->fetch();
		if(password_verify(trim($password), $exe['password'])) {
			return true;
		}else {
			return false;
		}
	}


}
?>