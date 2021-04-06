<?php

/**
 * 
 */
class AdminView extends Admin {
	public function check($id) {
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
	public function AnyAdmin($id) {
		$exe = $this->ListAll($id);
		if(empty($exe)) {
			return true;
		}else {
			return false;
		}
	}
	public function whois($id) {
		return $this->name($id);
	}
	public function DBAdmin($id) {
		$exes = $this->ListAll($id);
		$counter = 0;
		if(!empty($exes)) {
			foreach ($exes as $exe) {
				?>
				<tr>
	                <td class="text-center"><?php echo ++$counter?></td>
	                <td><?php echo $exe['username'] ?></td>
	                <td><?php echo ucwords($exe['type']) ?></td>
	                <td><?php echo ucwords($this->whois($exe['added_by'])); ?></td>
	                <td class="td-actions text-right">
	                    <a href="editrole?q=<?php echo $exe['admin_id'] ?>" class="btn btn-success">
	                        <i class="material-icons">edit</i>
	                    </a>
	                    <a href="?q=<?php echo $exe['admin_id'] ?>" class="btn btn-danger">
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

	public function ShowAdmin($id,$val) {
		return $this->show($id,$val);
	}

}

?>