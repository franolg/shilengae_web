<?php

/**
 * App View
 */
class AppView extends Platform {


	public function showTerm($lang = 'EN') {
		$exe = $this->Term();
		if(!empty($exe)) {
        	return array('success' => 1,'statuscode' => 200,"msg" => $exe['content']);
		}else {
        	return array('success' => 0,'statuscode' => 400,"msg" => "Not Available");
		}
	}
}