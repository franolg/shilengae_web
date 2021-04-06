<?php 

/**
 * 
 */
class Localization extends Database {
	function GetLanguage($id) {
		$admin = new Admin();
		return $admin->Language($id);
	}
}

 ?>