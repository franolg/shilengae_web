<?php
session_start();
ob_start();

include '../private/connect.php'; // including every class from the root/private/connect.php.

$db = Database::getInstance();
$c = $db->getc();

$ha = @$c->query("SELECT * FROM tableportalusers WHERE admin_id='".$_SESSION['add']."' ");
$feto = $ha->fetch_array();

if(!isset($_SESSION['add']) || $feto['admin_id'] != $_SESSION['add']){
  header("Location: login.php");
  exit();
}

?>
          
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>Shilengae Admin Panel</title>
  <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
  <?php include 'includes/style.php' ?>
</head>
<body class="">
<style>

</style>
<?php

$country = new Country(0);
if(isset($_POST['add_country'])) {
  $statusMsg = "";
  $backlink = ' <a href="./">Go back</a>';
  $id = uniqid().time();
  $name = mysqli_real_escape_string($c,$_POST['name']);
  $code = mysqli_real_escape_string($c,$_POST['code']);
  if(empty($name)) {
     $statusMsg = "Counrty name is required.";

  }elseif (empty($code)) {
     $statusMsg = "Counrty code is required";
  }
  else {
    if($country->AddCountry($name,$code)) {
      echo "<script>
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
          title: '".ucwords($name)." have been added to projects successfully.'
        })
      </script>";
  }
  else{
       $statusMsg = "Country already exists.";
  }
  }
  if ($statusMsg != "") {
      echo "<script>
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
              title: '".$statusMsg."'
            })
          </script>";
    }
}else if(isset($_GET['q'])) {
  $id = $_GET['q'];
  $chj = $c->query("SELECT * FROM tableoperatingcountrylist WHERE country_id = '$id'");
  if ($chj->num_rows != 0) {
  if($c->query("DELETE FROM tableoperatingcountrylist WHERE country_id = '$id'")){
        echo "<script>
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
            title: 'Deleted successfully.'
          })
        </script>";
  }
  }
}
if (isset($_POST['disable'])) { // checking if the disabled is called or the button is pressed
  $country->DisableCountryList();
}
if (isset($_POST['enable'])) { // checking if the Enabled is called or the button is pressed
  $country->EnableCountryList();
}
?>
  <div class="wrapper ">
    <?php
    include_once 'nav.php'; // padding: 34.7%;
    ?>
    <div class="main-panel">
      <?php include_once 'na.php'; ?>
       <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-8">
              <div class="card unclass">
                <div class="cssload-thecube">
                  <div class="cssload-cube cssload-c1"></div>
                  <div class="cssload-cube cssload-c2"></div>
                  <div class="cssload-cube cssload-c4"></div>
                  <div class="cssload-cube cssload-c3"></div>
                </div>
                <div class="carder">
                  <div class="card-header card-header-warning">
                    <h4 class="card-title">Add Country</h4>
                    <p class="card-category">Be sure before adding a country</p>
                  </div>
                  <div class="card-body" style="padding-top: 30px;padding-left: 30px;padding-right: 30px;">
                    <form method="post"  enctype="multipart/form-data">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <select class="form-control selectpicker temp1" name="name" data-style="btn btn-link">
                              <?php
                                echo $country->get_countries_options();
                              ?>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <select class="form-control selectpicker temp1" name="code" data-style="btn btn-link">
                              <?php
                              echo $country->get_countries_code_options();
                              ?>
                            </select>
                          </div>
                        </div>
                      </div>
                      <button type="submit" name="add_country" class="btn btn-warning pull-right add_pro">Add Country</button>
                      <div class="clearfix"></div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card ">
                <div class="card-body">
                  <h6 class="card-category text-gray text-center">Recently Added Projects </h6>
                  <hr />
                  <?php
                  $con = $c->query("SELECT * FROM tableoperatingcountrylist ORDER BY id DESC ");
                  if($con->num_rows > 0) {
                    echo '
                      <table class="table">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Country</th>
                                <th>Code</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                    ';
                        $counter = 0;
                        while ($exe = $con->fetch_array()) {
                          $counter++;
                          ?>
                          <tr>
                            <td class="text-center"><?php echo $counter?></td>
                            <td><?php echo $exe['country'] ?></td>
                            <td><?php echo $exe['short'] ?></td>
                            <td><?php echo $exe['status'] ? "ON" : "OFF"; ?></td>
                            <td class="td-actions text-right">
                                <a href="editcountry?q=<?php echo $exe['country_id'] ?>" class="btn btn-success">
                                    <i class="material-icons">edit</i>
                                </a>
                                <a href="category?q=<?php echo $exe['country_id'] ?>" class="btn btn-danger">
                                    <i class="material-icons">close</i>
                                </a>
                            </td>
                        </tr>
                          <?php
                        }
                    echo '
                      </tbody>
                    </table>';
                  }
                  else {
                      echo '<h6 class="card-category text-muted text-center pt-5 pb-5"><i class="material-icons" style="top: 4px;padding-right: 4px;font-size: 19px;">warning</i> No Result</h6>';
                  }
                  ?>
                  <form method="post">
                    <?php
                      if($country->CountryShowToggle()){
                        ?>
                          <button type="submit" name="disable" class="btn btn-block btn-dark">Disable App Country</button>
                        <?php
                      }else {
                        ?>
                          <button type="submit" name="enable" class="btn btn-block btn-success">Enable App country</button>
                        <?php
                      }
                    ?>
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


<script>
  $(document).ready(function() {
    $(".cssload-thecube").hide();
    $(".add_pro").click(function () {
      $(".carder").hide();
      $(".unclass").css("padding","34.4%");
      $(".cssload-thecube").css("display","block");
    });
  });
</script>
</body>

</html>