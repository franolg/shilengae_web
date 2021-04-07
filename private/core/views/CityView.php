<?php 

/**
 * 
 */
class CityView extends City {
	public function check($id) {
            return $this->Eid($id);
    }
	public function Cities($selected_country = "") {
	    $options = '';
	    $selected = '';
	    $con = new Country();
	   	$exe = $con->ListAll();
		if(!empty($exe)) {
			foreach ($exe as $country) {
				if($selected_country == $country['country_id']){
					$selected = 'selected="selected"';
					$options .= '<option value="' . $country['country_id'] . '" ' . $selected . ' >'.$country['country'].'</option>';
				} else {
					$options .= '<option value="' . $country['country_id'] . '" >'.$country['country'].'</option>';
				}
	    	}
		}else {
			$options =  "<option>No Cities</option>";
		}
	    return $options;
	}
	public function AnyCity($id) {
		$exe = $this->ListAll($id);
		if(empty($exe)) {
			return true;
		}else {
			return false;
		}
	}
	public function DBCity($id) {
		$con = new CountryView();
		$exes = $this->ListAll($id);
		$counter = 0;
		if(!empty($exes)) {
			foreach ($exes as $exe) {
				?>
				<tr>
	                <td class="text-center"><?php echo ++$counter?></td>
	                <td><?php echo $exe['name'] ?></td>
	                <td><?php echo ucwords(@$con->showCountry($exe['country_id'],'name')) ? ucwords($con->showCountry($exe['country_id'],'name')) : "-"; ?></td>
	                <td class="td-actions text-right">
	                    <a href="editcity?q=<?php echo $exe['city_id'] ?>" class="btn btn-success">
	                        <i class="material-icons">edit</i>
	                    </a>
	                    <a href="?q=<?php echo $exe['city_id'] ?>" class="btn btn-danger">
	                        <i class="material-icons">close</i>
	                    </a>
	                </td>
	            </tr>	
				<?php
			}
		}else {
			?><tr><td>No Result</td></tr><?php
		}
	}
	public function ShowCity($id,$request) {
		return $this->Show($id,$request);
	}
}
 ?>