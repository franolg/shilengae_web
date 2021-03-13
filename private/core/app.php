<?php

class App {

	public function showTerm($lang = 'EN') {
		$db = Database::getInstance(); // getting instance of the database.
		$c = $db->getc();
		$adc = $c->query("SELECT * FROM tablepolicies WHERE SelectedCountry = '$lang' AND flag = 1"); // getting user with the same id
		$exe = $adc->fetch_array();
		if($adc->num_rows) {
        	return array('success' => 1,'statuscode' => 200,"msg" => $exe['content']);
		}else {
        	return array('success' => 0,'statuscode' => 400,"msg" => "Not Available");
		}
	}
	public function addTerm($term,$lang="EN") {
		$db = Database::getInstance(); // getting instance of the database.
		$c = $db->getc();
		$adc = $c->query("SELECT * FROM tablepolicies WHERE SelectedCountry = '$lang'"); // getting user with the same id
		$exe = $adc->fetch_array();
		if($adc->num_rows) {
			$statusMsg = "Can\'t add term, Currently only one term is allowed.";
        	 return "<script>
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
            title: '".$statusMsg."'
          })
        </script>";
		}else {
			$id = uniqid().time();
			$timer = time();
			$cog = new Cog();
			$term = $cog->sql_prep($term);
        	if ($c->query("INSERT INTO tablepolicies (term_id,content,created_at,flag,SelectedCountry) VALUES ('$id','$term','$timer',1,'$lang')")) {
        		return "<script>
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
				        title: 'Terms and Conditions added successfully.'
				      })
				    </script>";
        	} else {
        		$statusMsg = "Error adding country";
        	 return "<script>
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
            title: '".$statusMsg."'
          })
        </script>";
        	}
		}
	}
}

?>