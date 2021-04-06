<?php 

/**
 * 
 */
class Localization extends Database {

	function GetLanguage($id) {
		$sql = "SELECT * FROM tableportalusers WHERE admin_id = ? AND status = ?";
		$stmt = $this->c()->prepare($sql);
		$stmt->execute([$id,1]);
		$exe = $stmt->fetch();
		return $exe['lan'];
	}

	function Change($id) {
		$sql = "UPDATE tableportalusers SET lan = ? WHERE admin_id = ? AND status = ?";
		$stmt = $this->c()->prepare($sql);
		if($stmt->execute([$this->toggle($id),$id,1])) {
			return true;
		}else {
			return false;
		}
	}

	function toggle($id) {
		return $this->GetLanguage($id) == 'am' ? 'en' : 'am';
	}

}

?>