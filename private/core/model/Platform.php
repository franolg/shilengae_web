<?php

/**
 * Platform Model
 */
class Platform extends Database
{
	
	protected function Term($lang = 'EN') {
		$adc = $this->c()->prepare("SELECT * FROM tablepolicies WHERE SelectedCountry = ? AND flag = ?"); // getting user with the same id
		$adc->execute([$lang,1]);
		if($adc->rowCount()) {
			return $adc->fetch();
		}else {
        	return [];
		}
	}
	protected function AddTerm($term,$lang="EN") {

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
}