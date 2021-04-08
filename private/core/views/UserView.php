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
	public function CheckUserID($id) {
		return $this->IDExist($id);
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
		if (!$this->isEmailBanned($email)) {
			if ($this->Facebook($userid,$firstname,$lastname,$email,urldecode($img),$timer)) {
				return array('success' => 1,'statuscode' => 200,"msg" => "Your facebook account have been linked successfully.");
			} else {
				return array('success' => 0,'statuscode' => 400,"msg" => "Unable to link you facebook account");
			}
		}else {
			return array('success' => 0,'statuscode' => 400,"msg" => "You're Banned");
		}
	}
	public function MobileExists($code,$mobile) {
		return $this->Exist($code,$mobile);
	}
	public function ShowUser($id,$request) {
		return $this->show($id,$request);
	}

	public function UsersTable() {
		$exes = $this->ListAll();
		$counter = 0;
		if(!empty($exes)) {
			foreach ($exes as $exe) {
				?>
				<tr>
                    <td class="text-center"><?php echo ++$counter; ?></td>
                    <td><?php echo $exe['first_name']." ".$exe['last_name']; ?></td>
                    <td><?php echo $exe['email']; ?></td>
                    <td>+<?php echo $exe['calling_code']." ".$exe['mobile']; ?></td>
                    <td><?php echo $exe['country']; ?></td>
                    <td class="td-actions text-right">
                        <a href="edit?q=<?php echo $exe['user_id']; ?>" class="btn btn-success">
                            <i class="material-icons">edit</i>
                        </a>
                        <a href="user?q=<?php echo $exe['user_id']; ?>" class="btn btn-danger">
                            <i class="material-icons">close</i>
                        </a>
                    </td>
                </tr>
				<?php
			}
		}else {
			?><tr><td>No Result</td></tr><?php
		}
	}
	public function UsersTablejs() {
		return $this->ListAlljs();
	}
	public function AnyUsers() {
		return $this->CheckUsers();
	}
}