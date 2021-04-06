<?php

include "../../private/connect.php";


class smt extends Database {
	public function ajax() {
		$return_arr = array();

		$query = "SELECT * FROM tableusers ORDER BY id";

		$result = $this->c()->query($query);

		while($row = $result->fetch()){
		    $id = $row['id'];
		    $username = $row['first_name'];
		    $name = $row['last_name'];
		    $email = $row['mobile'];

		    $return_arr[] = array("id" => $id,
		                    "username" => $username,
		                    "name" => $name,
		                    "email" => $email);
		}

		// Encoding array in JSON format
		return json_encode($return_arr);

	}
}

$ss = new smt();
echo $ss->ajax();

?>