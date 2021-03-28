<?php 

class Country extends Database {

	protected function ListAll() {
		$sql = "SELECT * FROM tableoperatingcountrylist";
		$countryList = $this->c()->query($sql); // getting country list
		if($countryList->rowCount() > 0) { // checking if the table is not empty
			return $countryList->fetchAll();
		}else {
			return [];
		}
	}
	protected function TCountries() {
		$TCountry = $this->c()->query("SELECT * FROM ctoggler WHERE status = 0"); // checking if the country list is showing at the app
		if ($TCountry->rowCount() == 0) {
		 	return true;
		 }else {
		 	return false;
		 }
	} 

}
?>