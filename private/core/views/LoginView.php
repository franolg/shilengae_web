<?php

/**
 * Login View
 */
class LoginView extends User {
	
	public function LogUser($calling_code,$mobile,$password) {
		$exe = $this->Auth($mobile,$calling_code);
		if (!empty($exe)) {
			if(password_verify($password, $exe['password'])) {
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
			}else {
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

	public function LogAdmin($username,$password) {
		$exe = $this->AdminAuth($this->usernamer);
		if (!empty($exe)) {
			if(password_verify($this->password, $exe['password'])) {
				$_SESSION['add'] = $exe['admin_id'];
				$send = new Location();
				$send->to("home");
			}else {
				?>
				<script>
			        const Toast = Swal.mixin({
			          toast: true,
			          position: 'top-end',
			          showConfirmButton: false,
			          timer: 9000,
			          timerProgressBar: true,
			          onOpen: (toast) => {
			            toast.addEventListener('mouseenter', Swal.stopTimer)
			            toast.addEventListener('mouseleave', Swal.resumeTimer)
			          }
			        })

			        Toast.fire({
			          icon: 'error',
			          title: 'Username or password not correct.'
			        })
			    </script>
				<?php
			}
		}
	}
}