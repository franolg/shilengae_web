<?php

include '../private/connect.php'; // including every class from the root/private/connect.php.

$db = Database::getInstance();
$c = $db->getc();

$ha = @$c->query("SELECT * FROM tableportalusers WHERE admin_id='".$_SESSION['add']."' ");
$feto = $ha->fetch_array();

if(!isset($_SESSION['add']) || $feto['admin_id'] != $_SESSION['add']){
  header("Location: login.php");
  exit();
}

$id = @$_GET['q'];
$sqq = $c->query("SELECT * FROM tableoperatingcountrylist WHERE country_id='$id'");
if ($sqq->num_rows == 0) {
  ?>
  No result <a href="index.php">Go Back</a>
  <?php
}else {
$exe = $sqq->fetch_array();
?>
          
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>Edit <?php echo $exe['country']; ?></title>
  <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
  <?php include 'includes/style.php' ?>
</head>
<body>
<?php
if(isset($_POST['edit_country'])) {
  $sqq1= $c->query("SELECT * FROM tableoperatingcountrylist WHERE country_id='$id'");
  $exo1 = $sqq1->fetch_array();
  $coid = $exo1['country_id'];
  $name = mysqli_real_escape_string($c,$_POST['name']);
  $code = mysqli_real_escape_string($c,$_POST['code']);
  if($c->query("UPDATE tableoperatingcountrylist SET country = '$name' ,short ='$code' WHERE country_id='$coid'")) {
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
            title: 'Unexpected error, please try again.'
          })
        </script>
    <?php
  }
}
$country = new Country(0);
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
                  <h4 class="card-title">Edit <?php echo ucwords($exe['country']); ?></h4>
                  <p class="card-category">Be sure before Editing Countries</p>
                </div>
                <div class="card-body">
                  
                  <form method="post"  enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <select class="form-control selectpicker temp1" name="name" data-style="btn btn-link">
                              <?php
                                echo $country->get_countries_options($exe['short']);
                              ?>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <select class="form-control selectpicker temp1" name="code" data-style="btn btn-link">
                              <?php
                              echo $country->get_countries_code_options($exe['short']);
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