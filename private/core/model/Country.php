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
	protected function Ctoggler() {
		$sql = "SELECT * FROM ctoggler WHERE status = 0";
		$countryList = $this->c()->query($sql); // getting country list
		if($countryList->rowCount() > 0) { // checking if the table is not empty
			return false;
		}else {
			return true;
		}
	}
	protected function Add($name,$short) {
		$id = uniqid(); // setting a unique id.
		$sql = "SELECT * FROM tableoperatingcountrylist WHERE country = ? OR short = ?";
		$stmt = $this->c()->prepare($sql); // getting table country table data when the country name and short country name are the same with name and short
		$stmt->execute([$name,$short]);
		if($stmt->rowCount() == 0) { // checking if the table is empty so that country can't be added twice
			$sql1 = "INSERT INTO tableoperatingcountrylist (country_id,country,short) VALUES (?,?,?)";
			$stmt = $this->c()->prepare($sql1);
			if($stmt->execute([$id,$name,$short])){ // inserting the country.
				return true;
			}
			else {
				return false;
			}
		}
		else {
			return false;
		}
	}
	protected function Edit($id,$name,$short) {
		$sql = "SELECT * FROM tableoperatingcountrylist WHERE country = ? OR short = ?";
		$stmt = $this->c()->prepare($sql); // getting table country table data when the country name and short country name are the same with name and short
		$stmt->execute([$name,$short]);
		if($stmt->rowCount() == 0) { // checking if the table is empty so that country can't be added twice
			$sql = "UPDATE tableoperatingcountrylist SET country = ?,short = ? WHERE country_id = ?";
			$stmt = $this->c()->prepare($sql);
			if ($stmt->execute([$name,$short,$id])) {
				return true;
			}else {
				return false;
			}
		}
		else {
			return false;
		}
	}
	protected function Enable() {
		$sql = "UPDATE ctoggler SET status = 1";
		if($this->c()->query($sql)) {
			return true;
		}else {
			return false;
		}
	}
	protected function Disable() {
		$sql = "UPDATE ctoggler SET status = 0";
		if($this->c()->query($sql)) {
			return true;
		}else {
			return false;
		}
	}
	protected function isCountryID($id) {
		$sql = "SELECT * FROM tableoperatingcountrylist WHERE country_id = ?";
		$stmt = $this->c()->prepare($sql);
		$stmt->execute([$id]);
		if ($stmt->rowCount() > 0) {
			return true;
		}else {
			return false;
		}
	}
	protected function Delete($id) {
		$sql = "DELETE FROM tableoperatingcountrylist WHERE country_id = ?";
		$stmt = $this->c()->prepare($sql);
		if ($stmt->execute([$id])) {
			return true;
		}else {
			return false;
		}
	}
	protected function show($id,$request) {
		$sql = "SELECT * FROM tableoperatingcountrylist WHERE country_id = ?";
		$stmt = $this->c()->prepare($sql);
		$stmt->execute([$id]);
		$exe = $stmt->fetch();
		$result = "";
		switch ($request) {
			case 'id':
				$result = $exe['country_id'];
				break;
			case 'name':
				$result = $exe['country'];
				break;
			case 'short':
				$result = $exe['short'];
				break;
			case 'status':
				$result = $exe['status'];
				break;
			default:
				$result = "";
				break;
		}
		return $result;
	}

}
?>