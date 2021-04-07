<?php

/**
 * Platform Model
 */
class Platform extends Database
{
	
	protected function Term($lang = 'EN') {
		$adc = $this->c()->prepare("SELECT * FROM tableterm WHERE SelectedCountry = ? AND flag = ?"); // getting user with the same id
		$adc->execute([$lang,1]);
		if($adc->rowCount()) {
			return $adc->fetch();
		}else {
        	return [];
		}
	}
	protected function Add($term,$lang) {

		$adc = $this->c()->prepare("SELECT * FROM tableterm WHERE SelectedCountry = '$lang'"); // getting user with the same id
		$exe = $adc->fetch();
		if($adc->rowCount()) {
			return [false,0];
		}else {
			$id = uniqid().time();
			$timer = time();
			$cog = new Cog();
			$term = $cog->sql_prep($term);
        	$stmt = $this->c()->prepare("INSERT INTO tableterm (term_id,content,created_at,flag,SelectedCountry) VALUES (?,?,?,?,?)");
			if($stmt->execute([$id,$term,$timer,1,$lang])){
				return [true,1];
			}else {
				return [false,1];
			}
		}
	}

	protected function Edit($term,$flag,$lang) {
		$sql = "UPDATE tableterm SET content = ? ,flag = ?";
		$adc = $this->c()->prepare($sql); // getting user with the same id
		if($adc->execute([$term,$flag])) {
			return true;
		}else {
			return false;
		}
	}

	protected function Show($request) {
		$sql = "SELECT * FROM tableterm";
		$stmt = $this->c()->query($sql);
		$exe = $stmt->fetch();
		$result = "";
		switch ($request) {
			case 'flag':
				$result = $exe['flag'];
				break;
			case 'content':
				$result = $exe['content'];
				break;
			default:
				$result = "";
				break;
		}
		return $result;
	}

	protected function PrivacyPolicy($lang = 'EN') {
		$adc = $this->c()->prepare("SELECT * FROM tablepolicies WHERE SelectedCountry = ? AND flag = ?"); // getting user with the same id
		$adc->execute([$lang,1]);
		if($adc->rowCount()) {
			return $adc->fetch();
		}else {
        	return [];
		}
	}
	protected function AddPP($term,$lang) {

		$adc = $this->c()->prepare("SELECT * FROM tablepolicies WHERE SelectedCountry = '$lang'"); // getting user with the same id
		$exe = $adc->fetch();
		if($adc->rowCount()) {
			return [false,0];
		}else {
			$id = uniqid().time();
			$timer = time();
			$cog = new Cog();
			$term = $cog->sql_prep($term);
        	$stmt = $this->c()->prepare("INSERT INTO tablepolicies (term_id,content,created_at,flag,SelectedCountry) VALUES (?,?,?,?,?)");
			if($stmt->execute([$id,$term,$timer,1,$lang])){
				return [true,1];
			}else {
				return [false,1];
			}
		}
	}

	protected function EditPP($term,$flag,$lang) {
		$sql = "UPDATE tablepolicies SET content = ? ,flag = ?";
		$adc = $this->c()->prepare($sql); // getting user with the same id
		if($adc->execute([$term,$flag])) {
			return true;
		}else {
			return false;
		}
	}

	protected function ShowPP($request) {
		$sql = "SELECT * FROM tablepolicies";
		$stmt = $this->c()->query($sql);
		$exe = $stmt->fetch();
		$result = "";
		switch ($request) {
			case 'flag':
				$result = $exe['flag'];
				break;
			case 'content':
				$result = $exe['content'];
				break;
			default:
				$result = "";
				break;
		}
		return $result;
	}

}