<!DOCTYPE html>
<html>
<head>
	<title>Dashboard</title>
	<?php
		include '../private/connect.php'; // including every class from the root/private/connect.php.
		include './includes/style.php'; // including styles
	?>
</head>
<body>
<?php

$cog = new Cog();
$edit = $cog->u($cog->sql_prep($_GET['edit']));
$id = $cog->u($cog->sql_prep($_GET['id']));
$country = new Country(0); // getting instance of country and 0 refers that the request is not from the API.

$co
?>
<?php include 'includes/nav.php';  // including left navbar ?>
<div class="page-con">
	<?php
	if ($edit == 'country') {
		echo '<h2 class="text-muted mb-5"><i class="fas fa-edit" style=""></i> Editing '.$country->CountryName($id).'</h2>
				<form method="post">
				  <div class="form-group">
				    <label for="conname">Country Name</label>
				    <select class="custom-select mb-3" name="country">
				    	'.$country->get_countries_options($country->CountryCode($id)).'
				    </select>
					<label for="shconname">Short Representation </label>
					<select class="custom-select" name="short">
				    	'.$country->get_countries_code_options($country->CountryCode($id)).'
				    </select>
				  </div>
				  <button name="add" type="submit" class="btn btn-primary mt-3"><i class="fas fa-edit"></i> Edit Country</button>
				</form>';

	}elseif ($edit == 'city') {
		echo '<h2 class="text-muted mb-5"><i class="fas fa-edit" style=""></i> Editing '.$country->CityName($id).'</h2>
			<form method="post">
			  <div class="form-group">
			    <label for="conname">Country Name</label>
			    <select class="custom-select mb-3" name="ccountry">
			    	'.$country->get_saved_countries_options($country->CityToCid($id)).'
			    </select>
				<label for="shconname">City Name</label>
			    	<input type="text" class="form-control" name="city" placeholder="city" value="'.$country->CityName($id).'">
			  </div>
			  <button name="addcity" type="submit" class="btn btn-primary mt-3"><i class="fas fa-plus ispace"></i> Add City</button>
			</form>';
	}
	?>
</div>
<?php
    include './includes/script.php'; // including scripts 
?>
</body>
</html>