<?php

class App {

	public function showTerm($lang = 'EN') {
		$db = Database::getInstance(); // getting instance of the database.
		$c = $db->getc();
		$adc = $c->query("SELECT * FROM tablepolicies WHERE SelectedCountry = '$lang' AND flag = 1"); // getting user with the same id
		$exe = $adc->fetch_array();
		if($adc->num_rows) {
        	return array('success' => 1,'statuscode' => 200,"msg" => $exe['content']);;
		}else {
        	return array('success' => 0,'statuscode' => 400,"msg" => "Not Available");;
		}
	}
}

?>