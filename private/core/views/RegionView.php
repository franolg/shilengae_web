<?php 
/**
 * 
 */
class RegionView extends Region
{
	
	public function check($id) {
            return $this->Eid($id);
    }
	public function Regions($selected_city = "") {
	    $options = '';
	    $selected = '';
	    $city = new City();
	   	$exe = $city->ListAll();
		if(!empty($exe)) {
			foreach ($exe as $city) {
				if($selected_city == $city['city_id']){
					$selected = 'selected="selected"';
					$options .= '<option value="' . $city['city_id'] . '" ' . $selected . ' >'.$city['name'].'</option>';
				} else {
					$options .= '<option value="' . $city['city_id'] . '" >'.$city['name'].'</option>';
				}
	    	}
		}else {
			$options =  "<option>No Regions</option>";
		}
	    return $options;
	}
	public function AnyRegion($id) {
		$exe = $this->ListAll($id);
		if(empty($exe)) {
			return true;
		}else {
			return false;
		}
	}
	public function DBRegion($id) {
		$city = new CityView();
		$exes = $this->ListAll($id);
		$counter = 0;
		if(!empty($exes)) {
			foreach ($exes as $exe) {
				?>
				<tr>
	                <td class="text-center"><?php echo ++$counter?></td>
	                <td><?php echo $exe['name'] ?></td>
	                <td><?php echo ucwords(@$city->showCity($exe['city_id'],'name')) ? ucwords($city->showCity($exe['city_id'],'name')) : "-"; ?></td>
	                <td class="td-actions text-right">
	                    <a href="editreg?q=<?php echo $exe['region_id'] ?>" class="btn btn-success">
	                        <i class="material-icons">edit</i>
	                    </a>
	                    <a href="?q=<?php echo $exe['region_id'] ?>" class="btn btn-danger">
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
	public function ShowRegion($id,$request) {
		return $this->Show($id,$request);
	}

} 
?>