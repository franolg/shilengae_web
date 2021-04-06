<?php 

/**
 * 
 */
class AdminController extends Admin {
	public $id;
	function __construct($id) {
		$this->id = $id;
	}
	
	public function changePassword($password) {
		return $this->Password($this->id,$password);
	}
	public function checkPassword($password) {
		return $this->isPassword($this->id,$password);
	}
	public function AddRole($username,$role,$password) {
		return $this->Add($this->id,$username,$role,$password);
	}
	public function EditRole($username,$role,$id) {
		return $this->Edit($this->id,$username,$role,$id);
	}
	public function DeletedRole($id) {
		if($this->Remove($id)){
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
				  icon: 'success',
				  title: 'Deleted successfully.'
				})
			</script>
		    <?php
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
				  title: 'Can\'t remove.'
				})
			</script>
		    <?php
		}
	}
}

?>