<?php 

/**
 * 
 */
class Region extends Database {
	protected function ListAll() {
		$sql = "SELECT * FROM region";
		$stmt = $this->c()->query($sql); // getting regions list
		if($stmt->rowCount() > 0) { // checking if the table is not empty
			return $stmt->fetchAll();
		}else {
			return [];
		}
	}
	protected function Add($name,$city) {
		if (!$this->ECName($name,$city)) {
			$id = uniqid().'_'.time();
			$sql = "INSERT INTO region (region_id,name,city_id) VALUES (?,?,?)";
			$stmt = $this->c()->prepare($sql);
			if ($stmt->execute([$id,$name,$city])) {
				return true;
			}else {
				return false;
			}
		}else {
			return false;
		}
	}
	protected function Edit($id,$name,$city) {
		if ($this->Eid($id)) {
			if (!$this->ECName2($id,$name,$city)) {
				$sql = "UPDATE region SET name = ?,city_id = ? WHERE region_id = ?";
				$stmt = $this->c()->prepare($sql);
				if ($stmt->execute([$name,$city,$id])) {
					return true;
				}else {
					return false;
				}
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
	protected function ECName($name,$city) {
		$sql = "SELECT * FROM region WHERE name = ? AND city_id = ?";
		$stmt = $this->c()->prepare($sql);
		$stmt->execute([$name,$city]);
		if ($stmt->rowCount() > 0) {
			return true;
		}else {
			return false;
		}
	}
	protected function ECName2($id,$name,$city) {
		$sql = "SELECT * FROM region WHERE name = ? AND city_id = ? AND region_id != ?";
		$stmt = $this->c()->prepare($sql);
		$stmt->execute([$name,$city,$id]);
		if ($stmt->rowCount() > 0) {
			return true;
		}else {
			return false;
		}
	}
	
	protected function Eid($id) {
		$sql = "SELECT * FROM region WHERE region_id = ?";
		$stmt = $this->c()->prepare($sql);
		$stmt->execute([$id]);
		if ($stmt->rowCount() > 0) {
			return true;
		}else {
			return false;
		}
	}
	protected function Delete($id) {
		if($this->Eid($id)) {
			$sql = "DELETE FROM region WHERE region_id = ?";
			$stmt = $this->c()->prepare($sql);
			if ($stmt->execute([$id])) {
				return true;
			}else {
				return false;
			}
		}else {
			return false;
		}
	}
	protected function Show($id,$request) {
		$sql = "SELECT * FROM region WHERE region_id = ?";
		$stmt = $this->c()->prepare($sql);
		$stmt->execute([$id]);
		$exe = $stmt->fetch();
		$result = "";
		switch ($request) {
			case 'id':
				$result = $exe['region_id'];
				break;
			case 'name':
				$result = $exe['name'];
				break;
			case 'city':
				$result = $exe['city_id'];
				break;
			default:
				$result = "";
				break;
		}
		return $result;
	}
}

 ?>