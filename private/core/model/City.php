



<?php 

/**
 * 
 */
class City extends Database {
	public function ListAll() {
		$sql = "SELECT * FROM city";
		$stmt = $this->c()->query($sql); // getting cities list
		if($stmt->rowCount() > 0) { // checking if the table is not empty
			return $stmt->fetchAll();
		}else {
			return [];
		}
	}
	protected function Add($name,$country) {
		if (!$this->ECName($name,$country)) {
			$id = uniqid().'_'.time();
			$sql = "INSERT INTO city (city_id,name,country_id) VALUES (?,?,?)";
			$stmt = $this->c()->prepare($sql);
			if ($stmt->execute([$id,$name,$country])) {
				return true;
			}else {
				return false;
			}
		}else {
			return false;
		}
	}
	protected function Edit($id,$name,$country) {
		if ($this->Eid($id)) {
			if (!$this->ECName2($id,$name,$country)) {
				$sql = "UPDATE city SET name = ?,country_id = ? WHERE city_id = ?";
				$stmt = $this->c()->prepare($sql);
				if ($stmt->execute([$name,$country,$id])) {
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
	protected function ECName($name,$country) {
		$sql = "SELECT * FROM city WHERE name = ? AND country_id = ?";
		$stmt = $this->c()->prepare($sql);
		$stmt->execute([$name,$country]);
		if ($stmt->rowCount() > 0) {
			return true;
		}else {
			return false;
		}
	}
	protected function ECName2($id,$name,$country) {
		$sql = "SELECT * FROM city WHERE name = ? AND country_id = ? AND city_id != ?";
		$stmt = $this->c()->prepare($sql);
		$stmt->execute([$name,$country,$id]);
		if ($stmt->rowCount() > 0) {
			return true;
		}else {
			return false;
		}
	}
	
	protected function Eid($id) {
		$sql = "SELECT * FROM city WHERE city_id = ?";
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
			$sql = "DELETE FROM city WHERE city_id = ?";
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
		$sql = "SELECT * FROM city WHERE city_id = ?";
		$stmt = $this->c()->prepare($sql);
		$stmt->execute([$id]);
		$exe = $stmt->fetch();
		$result = "";
		switch ($request) {
			case 'id':
				$result = $exe['city_id'];
				break;
			case 'name':
				$result = $exe['name'];
				break;
			case 'country':
				$result = $exe['country_id'];
				break;
			default:
				$result = "";
				break;
		}
		return $result;
	}
}

 ?>