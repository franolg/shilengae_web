<?php 

/**
 * 
 */

class RegionController extends Region {

	public function AddRegion($name,$city) {
		return $this->Add($name,$city);
	}
	public function EditRegion($cid,$name,$city) {
		return $this->Edit($cid,$name,$city);
	}
	public function DeletedRegion($id) {
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