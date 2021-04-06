<?php

/**
 * 
 */
class Admin extends Database {

	protected function ListAll($id) {
		$sql = "SELECT * FROM tableportalusers WHERE admin_id != ? AND status = ?";
		$stmt = $this->c()->prepare($sql); // getting admin list
		$stmt->execute([$id,1]);
		if($stmt->rowCount() > 0) { // checking if the table is not empty
			return $stmt->fetchAll();
		}else {
			return [];
		}
	}
	protected function Remove($id) {
		if ($this->Exist($id)) {
			$sql = "UPDATE tableportalusers SET status = ? WHERE admin_id = ?";
			$stmt = $this->c()->prepare($sql);
			if($stmt->execute([0,$id])){
				return true;
			}else {
				return false;
			}
		}else {
			return false;
		}
	}
	protected function Add($by,$username,$role,$password) {
		if (!$this->CheckUser($username)) {
			$id = uniqid()."-".time();
			$sql = "INSERT INTO tableportalusers(admin_id,username,password,type,added_by) VALUES (?,?,?,?,?)";
			$stmt = $this->c()->prepare($sql);
			if($stmt->execute([$id,$username,password_hash($password, PASSWORD_BCRYPT),$role,$by])){
				return true;
			}else {
				return false;
			}
		}else {
			return false;
		}
	}
	protected function Edit($by,$username,$role,$id) {
		if ($this->Exist($id)) {
			if(!$this->CheckUsers($username,$id))
			$sql = "UPDATE tableportalusers SET username = ?,type = ?,added_by = ? WHERE admin_id = ?";
			$stmt = $this->c()->prepare($sql);
			if($stmt->execute([$username,$role,$by,$id])){
				return true;
			}else {
				return false;
			}
		}else {
			return false;
		}
	}

	protected function CheckUser($username) {
		$sql = "SELECT * FROM tableportalusers WHERE username = ? AND status = ?";
		$stmt = $this->c()->prepare($sql);
		$stmt->execute([$username,1]);
		if ($stmt->rowCount() > 0) {
			return true;
		}else {
		 	return false;
		}
	}
	protected function CheckUsers($username,$id) {
		$sql = "SELECT * FROM tableportalusers WHERE username = ? AND status = ? AND admin_id != ?";
		$stmt = $this->c()->prepare($sql);
		$stmt->execute([$username,1,$id]);
		if ($stmt->rowCount() > 0) {
			return true;
		}else {
		 	return false;
		}
	}

	protected function Exist($id) {
		$sql = "SELECT * FROM tableportalusers WHERE admin_id = ? AND status = ?";
		$stmt = $this->c()->prepare($sql);
		$stmt->execute([$id,1]);
		return $stmt->rowCount() == 0 ? false : true;
	}

	public function Name($id) {
		$sql = "SELECT * FROM tableportalusers WHERE admin_id = ? AND status = ?";
		$stmt = $this->c()->prepare($sql);
		$stmt->execute([$id,1]);
		$exe = $stmt->fetch();
		return $exe['username'];
	}
	
	protected function AdminAuth($username) {
		$sql = "SELECT * FROM tableportalusers WHERE username = ? AND status = ?";
		$stmt = $this->c()->prepare($sql);
		$stmt->execute([$username,1]);
		if ($stmt->rowCount() > 0) {
			return $stmt->fetch();
		}else {
		 	return [];
		}
	}

	protected function Password($id,$password) {
		$sql = "UPDATE tableportalusers SET password = ? WHERE admin_id = ? AND status = ?";
		$stmt = $this->c()->prepare($sql);
		if($stmt->execute([password_hash($password, PASSWORD_BCRYPT),$id,1])){
			return true;
		}else {
			return false;
		}
	}

	protected function isPassword($id,$password) {
		$sql = "SELECT * FROM tableportalusers WHERE admin_id = ? AND status = ?";
		$stmt = $this->c()->prepare($sql);
		$stmt->execute([$id,1]);
		$exe = $stmt->fetch();
		if(password_verify(trim($password), $exe['password'])) {
			return true;
		}else {
			return false;
		}
	}
	protected function show($id,$request) {
		$sql = "SELECT * FROM tableportalusers WHERE admin_id = ?";
		$stmt = $this->c()->prepare($sql);
		$stmt->execute([$id]);
		$exe = $stmt->fetch();
		$result = "";
		switch ($request) {
			case 'id':
				$result = $exe['admin_id'];
				break;
			case 'username':
				$result = $exe['username'];
				break;
			case 'lan':
				$result = $exe['lan'];
				break;
			case 'type':
				$result = $exe['type'];
				break;
			case 'added_by':
				$result = $exe['added_by'];
				break;
			case 'status':
				$result = $exe['status'];
				break;
			default:
				$result = "";
				break;
		}
		return $result;
	}


}
?>