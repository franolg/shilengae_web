<?php

/**
 * 
 */
class CountryController extends Country {

	public function AddCountry($name,$short) {
		return $this->Add($name,$short);
	}
	public function EditCountry($id,$name,$short) {
		return $this->Edit($id,$name,$short);
	}
	public function EnableCountryList() {
		if($this->Enable()){
			?>
			<script>
	          const Toast = Swal.mixin({
	            toast: true,
	            position: 'top-end',
	            showConfirmButton: false,
	            timer: 2000,
	            timerProgressBar: true,
	            onOpen: (toast) => {
	              toast.addEventListener('mouseenter', Swal.stopTimer)
	              toast.addEventListener('mouseleave', Swal.resumeTimer)
	            }
	          })

	          Toast.fire({
	            icon: 'success',
	            title: 'Enabled successfully.'
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
	            timer: 2000,
	            timerProgressBar: true,
	            onOpen: (toast) => {
	              toast.addEventListener('mouseenter', Swal.stopTimer)
	              toast.addEventListener('mouseleave', Swal.resumeTimer)
	            }
	          })

	          Toast.fire({
	            icon: 'error',
	            title: 'Can\'t enable.'
	          })
        	</script>
			<?php
		}
	}
	public function DisableCountryList() {
		if($this->Disable()){
			?>
			<script>
	          const Toast = Swal.mixin({
	            toast: true,
	            position: 'top-end',
	            showConfirmButton: false,
	            timer: 2000,
	            timerProgressBar: true,
	            onOpen: (toast) => {
	              toast.addEventListener('mouseenter', Swal.stopTimer)
	              toast.addEventListener('mouseleave', Swal.resumeTimer)
	            }
	          })

	          Toast.fire({
	            icon: 'success',
	            title: 'Disabled successfully.'
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
	            timer: 2000,
	            timerProgressBar: true,
	            onOpen: (toast) => {
	              toast.addEventListener('mouseenter', Swal.stopTimer)
	              toast.addEventListener('mouseleave', Swal.resumeTimer)
	            }
	          })

	          Toast.fire({
	            icon: 'error',
	            title: 'Can\'t disable.'
	          })
        	</script>
			<?php
		}
	}
	public function DeletedCountry($id) {
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
				  title: 'Can\'t delete.'
				})
			</script>
		    <?php
		}
	}
}