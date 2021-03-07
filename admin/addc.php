a<!DOCTYPE html>
<html>
<head>
	<title>Dashboard</title>
	<?php
		include '../private/connect.php'; // including every class from the root/private/connect.php.
		include './includes/style.php'; // including styles
	?>
</head>
<body>
<?php include 'includes/nav.php'; // including left navbar ?>
<?php
$msg = "";
if (isset($_POST['add'])) { // checking if the add is called or the button is pressed
	
	$name = $_POST['country']; // getting country name from the input
	$short = $_POST['short']; // getting short country name from the input
	if ($name == "" || $short == "") {
		$msg = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
					Please fill the form.
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>'; // setting unsuccessful message
	}else {
		$cl = new Country(0); // getting instance of country and 0 refers that the request is not from the API.
		if($cl->AddCountry($name,$short)){ // calling a method to add from the country class 
			$msg = '
			<div class="alert alert-success alert-dismissible fade show" role="alert">
				Country added successfully.
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>'; // setting a success message
		}else {
			$msg = '
			<div class="alert alert-danger alert-dismissible fade show" role="alert">
				Sorry, this country exists
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>'; // setting unsuccessful message
		}
	}
}
$lis = new Country(0);
if (isset($_POST['disable'])) { // checking if the disabled is called or the button is pressed
	$lis->DisableCountryList();
}
if (isset($_POST['enable'])) { // checking if the Enabled is called or the button is pressed
	$lis->EnableCountryList();
}
?>
<div class="page-con">
<?php echo $msg; ?>
<form method="post">
  <div class="form-group">
    <label for="conname">Country Name</label>
    <select class="custom-select mb-3" name="country">
    	<?php
    	echo $lis->get_countries_options();
    	?>
    </select>
	<label for="shconname">Short Representation </label>
	<select class="custom-select" name="short">
    	<?php
    	echo $lis->get_countries_code_options();
    	?>
    </select>
  </div>
  <button name="add" type="submit" class="btn btn-primary mt-3"><i class="fas fa-plus ispace"></i> Add Country</button>
</form>

<h2 class="mt-5 text-muted">
	Country List 
		<?php
			if($lis->CountryShowToggle()){
				echo '<a href="javascript:void(0)" class="badge badge-secondary" data-toggle="modal" data-target="#CountryDisable" style="font-size: 15px;vertical-align: middle;">Enabled</a>';
			}else {
				echo '<a href="javascript:void(0)" class="badge badge-secondary" data-toggle="modal" data-target="#CountryEnable" style="font-size: 15px;vertical-align: middle;">Disabled</a>';
			}
		?>
</h2>
<div class="modal fade" id="CountryDisable" tabindex="-1" role="dialog" aria-labelledby="CountryDisableTitle" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title text-center w-100">Are You Sure?</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body text-center">
				You're about to Disable country lists on Shilengae Mobile App.
			</div>
			<form method="post">
			<div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary" name="disable">Disable</button>
		    </div>
		  	</form>
	    </div>
	</div>
</div> <!-- Pop ups for disabling country list -->
<div class="modal fade" id="CountryEnable" tabindex="-1" role="dialog" aria-labelledby="CountryEnableTitle" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title text-center w-100">Are You Sure?</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body text-center">
       			You're about to enable country lists on Shilengae Mobile App.
			</div>
			<form method="post">
			<div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary" name="enable">Enable</button>
		    </div>
		  	</form>
	    </div>
	</div>
</div> <!-- Pop ups for enabling country list -->
<ul class="list-group">
	<?php
		$list = $lis->ListCountry();
		for ($i = 0;$i < count($list);$i++) {
	  		echo '<li class="list-group-item">'.$list[$i].'</li>';
		}
	?>
</ul>
<?php
    include './includes/script.php'; // including scripts 
?>
</div>

</body>
</html>