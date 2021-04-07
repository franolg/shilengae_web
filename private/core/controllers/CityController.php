<?php 

/**
 * 
 */

class CityController extends City {

	public function AddCity($name,$country) {
		return $this->Add($name,$country);
	}
	public function EditCity($cid,$name,$country) {
		return $this->Edit($cid,$name,$country);
	}
	public function DeletedCity($id) {
		if ($this->Delete($id)) {
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
				  title: 'Can not delete.'
				})
			</script>
		    <?php
		}
	}


}
?>