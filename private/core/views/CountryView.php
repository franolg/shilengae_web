<?php

/**
 * 
 */
class CountryView extends Country {
	public $api;

	function __construct($api = 1) {
		$this->api = $api;
	}

	public function Countries() {
		$exe = $this->ListAll();
		if ($this->api) { // checking if the request is from the api or not
			if(!empty($exe)) { // checking if the table is not empty
			    $country = array();
			    $id = 0;
			    foreach($exe as $con) {
			        $country[$id] = $con['country'];
			    	$id++;
			    }
				return array(
					'success' => 1,
					'statuscode' => 200,
					'list' => $this->TCountries(),
					'msg' => "Result found.",
					'country' => $country,
				);
			}else {
				return array(
						'success' => 0,
						'statuscode' => 400,
                                    'list' => false,
						'msg' => "List is empty",
						'country' => null,
					);
			}
		}else {
			if(!empty($exe)) {
				return $exe['country'];
			}else {
				return "No Result";
			}
		}
	}
}