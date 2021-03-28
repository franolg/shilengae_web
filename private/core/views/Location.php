<?php

/**
 * 
 */
class Location {
	
	public function to($loc = null) {
		switch ($loc) {
			case 'home':
				header("Location: index");
				break;

			default:
				header("Location: 404");
				break;
		}
	}
}


?>