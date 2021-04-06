<?php

include '../private/connect.php'; // including every class from the root/private/connect.php.

$admin = new AdminView();

if(!isset($_SESSION['add']) || !$admin->check($_SESSION['add'])){
  header("Location: login.php");
  exit();
}

$countryview = new CountryView();
$country = new CountryController();

$id = @$_GET['q'];
if (!$countryview->checkCountryID($id)) {
  ?>
  No result <a href="javascript:history.back();">Go Back</a>
  <?php
}else {

?>
          
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>Edit <?php echo $countryview->showCountry($id,'name'); ?></title>
  <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
  <?php include 'includes/style.php' ?>
</head>
<body>
<?php
if(isset($_POST['edit_country'])) {
  $name = $_POST['name'];
  $code = $_POST['code'];
  if($country->EditCountry($id,$name,$code)) {
    ?>
      <script>
        const Toast = Swal.mixin({
          toast: true,
          position: 'top-end',
          showConfirmButton: false,
          timer: 9000,
          timerProgressBar: true,
          onOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
          }
        })

        Toast.fire({
          icon: 'success',
          title:  'Country has been edited successfully.'
        })
      </script>
      <?php
  }
  else {
    ?>
        <script>
          const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 9000,
            timerProgressBar: true,
            onOpen: (toast) => {
              toast.addEventListener('mouseenter', Swal.stopTimer)
              toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
          })

          Toast.fire({
            icon: 'error',
            title: 'Country already exist or there is an unknown error.'
          })
        </script>
    <?php
  }
}
?>
<div class="wrapper ">
    <?php
    include_once 'nav.php';
    ?>
    <div class="main-panel">
      <?php include_once 'na.php'; ?>
       <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-warning">
                  <h4 class="card-title">Edit <?php echo ucwords($countryview->showCountry($id,'name')); ?></h4>
                  <p class="card-category">Be sure before Editing Countries</p>
                </div>
                <div class="card-body">
                  <form method="post"  enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <select class="form-control selectpicker temp1" name="name" data-style="btn btn-link">
                              <?php
                                echo $countryview->get_countries_options($countryview->showCountry($id,'short'));
                              ?>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <select class="form-control selectpicker temp1" name="code" data-style="btn btn-link">
                              <?php
                              echo $countryview->get_countries_code_options($countryview->showCountry($id,'short'));
                              ?>
                            </select>
                          </div>
                        </div>
                      </div>

                    <button type="submit" name="edit_country" class="btn btn-warning pull-right">Edit User</button>
                    <div class="clearfix"></div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>

<?php include 'includes/script.php' ?>
<script src="assets/js/core/bootstrap-material-design.min.js"></script>

</body>
</html>
<?php } ?>