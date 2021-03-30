<?php

/**
 * 
 */
class AdminView extends Admin {
	function check($id) {
		return $this->Exist($id);
	}
	public function Login($username,$password) {
		$exe = $this->AdminAuth($username);
		if (!empty($exe)) {
			if(password_verify($password, $exe['password'])) {
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

?>