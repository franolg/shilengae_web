<?php
class Login {

	public $mobile;
	public $password;
	public $calling_code;
	public $app_country;
	public $req_type;


	public function __construct($mobile,$password,$calling_code,$req_type) {
		$this->mobile = $mobile;
		$this->password = $password;
		$this->calling_code = $calling_code;
		$this->req_type = $req_type;
	}


	public function auth() {
		$db = Database::getInstance();
		$c = $db->getc();
		$cog = new Cog();
		$qur = $c->query("SELECT * FROM tableusers WHERE mobile = '".$cog->sql_prep($this->mobile)."' AND calling_code = '".$cog->sql_prep($this->calling_code)."'");
		if ($qur->num_rows > 0) {
			$exe = $qur->fetch_array();
				if ($this->password == $exe['password']) {
					if ($this->req_type == 'api') {
						return array(
							'success' => 1,
							'statuscode' => 200,
							'msg' => 'Login Successfully!',
							'user' => array(
								'id' =>	(int) $exe['id'],
								'user_id' => $exe['user_id'],
								'first_name' => $exe['first_name'],
								'last_name' => $exe['last_name'],
								'email' => $exe['email'],
								'mobile' => (int) $exe['mobile'],
								'country' => $exe['country'],
								'state' => $exe['state'],
								'city' => $exe['city'],
								'gender' => $exe['gender'],
								'birth' => $exe['birth'],
								'career' => $exe['career'],
								'experience' => $exe['experience'],
								'salary' => $exe['salary'],
								'profile_image' => $exe['profile_image'],
								'calling_code' => (int) $exe['calling_code'],
								'language' => $exe['language'],
								'verified' => (int) $exe['verified'],
								'email_verified_at' => (int) $exe['email_verified_at'],
								'business' => (int) $exe['business'],
								'company' => $exe['company'],
								'last_online_at' => (int) $exe['last_online_at'],
								'last_logged_in' => (int) $exe['last_logged_in'],
								'login_attempt' => (int) $exe['login_attempt'],
								'time_spent' => (int) $exe['time_spent'],
								'last_seen_ip' => $exe['last_seen_ip'],
								'last_device' => $exe['last_device'],
								'SelectedCountry' => $exe['SelectedCountry'],
								'joined' => (int) $exe['joined'],
								'modified_at' => (int) $exe['modified_at'],
								),
						);
					}
					else {
						return 'Login Successfully!';
					}
				}
				else {
					return array(
						'success' => 0,
						'statuscode' => 400,
						'msg' => 'Sorry, this password is incorrect!',
					);
				}
			
		}else {
			return array(
				'success' => 0,
				'statuscode' => 400,
				'msg' => 'Unknown user!',
			);
		}
	}

	
}
?>