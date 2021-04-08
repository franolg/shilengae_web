<?php

/**
 * User Model
 */
class User extends Database {

	protected function ListAll() {
		$sql = "SELECT * FROM tableusers WHERE status = 1";
		$stmt = $this->c()->query($sql); // getting country list
		if($stmt->rowCount() > 0) { // checking if the table is not empty
			return $stmt->fetchAll();
		}else {
			return [];
		}
	}
	public function ListAlljs() {
		$return_arr = array();
		$query = "SELECT * FROM tableusers ORDER BY id";
		$result = $this->c()->query($query);
		while($row = $result->fetch()){
			$first_name = urldecode($row['first_name']);
			$last_name = urldecode($row['last_name']);
			$email = urldecode($row['email']);
			$calling_code = urldecode($row['calling_code']);
			$country = urldecode($row['country']);
			$stm = '<a href="edit?q='.$row['user_id'].'" class="btn btn-success btn-sm d-block">
                            <i class="material-icons">edit</i>
                        </a>
                        <a href="?b='.$row['user_id'].'" class="btn btn-danger btn-sm d-block">
                            <i class="material-icons">block</i>
                        </a>
                        <a href="?q='.$row['user_id'].'" class="btn btn-danger btn-sm d-block">
                            <i class="material-icons">close</i>
                        </a>';
			$user_id = $row['user_id'];
			$mobile = $row['mobile'];
			$last_online_at = $row['last_online_at'];
			$last_logged_in = $row['last_logged_in'];
			$login_attempt = $row['login_attempt'];
			$time_spent = $row['time_spent'];
			$last_seen_ip = $row['last_seen_ip'];
			$last_device = $row['last_device'];

		    $return_arr[] = array(
		    	"id" => $user_id,
		    	"fn" => $first_name,
		    	"ln" => $last_name,
		    	"email" => $email,
		    	"calling_code" => $calling_code,
		    	"country" => $country,
		    	"action" => $stm,
		    	"mobile" => $mobile,
		    	"last_online_at" => $last_online_at,
		    	"last_logged_in" => $last_logged_in,
		    	"login_attempt" => $login_attempt,
		    	"time_spent" => $time_spent,
		    	"last_seen_ip" => $last_seen_ip,
		    	"last_device" => $last_device
		    );
		}

		// Encoding array in JSON format
		return json_encode($return_arr);
	}

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

	protected function Exist($code,$mobile) {
		$sql = "SELECT * FROM tableusers WHERE mobile = ? AND calling_code = ? AND status = ?";
		$stmt = $this->c()->prepare($sql);
		$stmt->execute([$mobile,$code,1]);
		return $stmt->rowCount() == 0 ? false : true;
	}
	protected function CheckUsers() {
		$sql = "SELECT * FROM tableusers WHERE status = 1";
		$stmt = $this->c()->query($sql);
		return $stmt->rowCount() == 0 ? false : true;
	}
	protected function IDExist($id) {
		$sql = "SELECT * FROM tableusers WHERE user_id = ? AND status = ?";
		$stmt = $this->c()->prepare($sql);
		$stmt->execute([$id,1]);
		return $stmt->rowCount() == 0 ? false : true;
	}
	protected function FindEmail($email) {
		$sql = "SELECT * FROM tableusers WHERE email = ? AND status = ?";
		$stmt = $this->c()->prepare($sql);
		$stmt->execute([urldecode($email),1]);
        return $stmt->rowCount() == 0 ? false : true;
    }
	protected function isEmailBanned($email) {
		$sql = "SELECT * FROM tableusers WHERE email = ? AND status = ?";
		$stmt = $this->c()->prepare($sql);
		$stmt->execute([urldecode($email),0]);
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

	protected function Edit($id,$firstname,$lastname,$email,$mobile,$country,$state,$city,$gender,$birth,$career,$experience,$salary,$callingcode,$business) {
		$timer = time();
		$sql = "UPDATE tableusers SET first_name = ?,last_name = ?,email = ?,mobile = ?,country = ?,state = ?,city = ?,gender = ?,birth = ?,career = ?,experience = ?,salary = ?,calling_code = ?,business = ?,modified_at = ? WHERE user_id = ?";
		$stmt = $this->c()->prepare($sql);
		if($stmt->execute([$firstname,$lastname,$email,$mobile,$country,$state,$city,$gender,$birth,$career,$experience,$salary,$callingcode,$business,$timer,$id])){
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
	protected function Delete($id) {
		$sql = "DELETE FROM tableusers WHERE user_id = ?";
		$stmt = $this->c()->prepare($sql);
		if ($stmt->execute([$id])) {
			return true;
		}else {
			return false;
		}
	}
	protected function Ban($id) {
		$sql = "UPDATE tableusers SET status = ?  WHERE user_id = ?";
		$stmt = $this->c()->prepare($sql);
		if ($stmt->execute([0,$id])) {
			return true;
		}else {
			return false;
		}
	}
	protected function show($id,$request) {
		$sql = "SELECT * FROM tableusers WHERE user_id = ? AND status = ?";
		$stmt = $this->c()->prepare($sql);
		$stmt->execute([$id,1]);
		$exe = $stmt->fetch();
		$result = "";
		switch ($request) {
			case 'id':
				$result = $exe['user_id'];
				break;
			case 'firstname':
				$result = $exe['first_name'];
				break;
			case 'lastname':
				$result = $exe['last_name'];
				break;
			case 'email':
				$result = $exe['email'];
				break;
			case 'mobile':
				$result = $exe['mobile'];
				break;
			case 'code':
				$result = $exe['calling_code'];
				break;
			case 'country':
				$result = $exe['country'];
				break;
			case 'language':
				$result = $exe['language'];
				break;
			case 'business':
				$result = $exe['business'];
				break;
			case 'company':
				$result = $exe['company'];
				break;
			case 'birth':
				$result = $exe['birth'];
				break;
			case 'career':
				$result = $exe['career'];
				break;
			case 'state':
				$result = $exe['state'];
				break;
			case 'city':
				$result = $exe['city'];
				break;
			case 'gender':
				$result = $exe['gender'];
				break;
			case 'experience':
				$result = $exe['experience'];
				break;
			case 'salary':
				$result = $exe['salary'];
				break;
			default:
				$result = "";
				break;
		}
		return $result;
	}

}