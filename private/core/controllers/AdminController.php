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
}

?>