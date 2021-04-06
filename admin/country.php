<?php
include '../private/connect.php'; // including every class from the root/private/connect.php.

$admin = new AdminView();

if(!isset($_SESSION['add']) || !$admin->check($_SESSION['add'])){
  header("Location: login.php");
  exit();
}

$lang = new LocalView($_SESSION['add']);

?>
          
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title><?php echo $lang->tr('shilengae')." ".$lang->tr('adminpanel'); ?></title>
  <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
  <?php include 'includes/style.php' ?>
</head>
<body class="">
<style>

</style>
<?php
$countryview = new CountryView();
$country = new CountryController();
if(isset($_POST['add_country'])) {
  $statusMsg = "";
  $backlink = ' <a href="./">Go back</a>';
  $id = uniqid().time();
  $name = $_POST['name'];
  if(empty($name)) {
     $statusMsg = $lang->tr('countrynamerequired');
  }
  else {
      if($country->AddCountry($name)) {
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
            title: '".$lang->tr('addedsuccess')."'
          })
        </script>";
    }
    else{
         $statusMsg = $lang->tr('countryexists');
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
}
else if(isset($_GET['q'])) {
  $id = $_GET['q'];
  if ($countryview->checkCountryID($id)) {
    $country->DeletedCountry($id);
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
                    <h4 class="card-title"><?php echo $lang->tr('addcountry'); ?></h4>
                    <p class="card-category"><?php echo $lang->tr('addingpage'); ?></p>
                  </div>
                  <div class="card-body" style="padding-top: 30px;padding-left: 30px;padding-right: 30px;">
                    <form method="post"  enctype="multipart/form-data">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <select class="form-control selectpicker temp1" name="name" data-style="btn btn-link">
                              <?php
                                echo $countryview->get_countries_options();
                              ?>
                            </select>
                          </div>
                        </div>
                      </div>
                      <button type="submit" name="add_country" class="btn btn-warning pull-right add_pro"><?php echo $lang->tr('addcountry'); ?></button>
                      <div class="clearfix"></div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card ">
                <div class="card-body">
                  <h6 class="card-category text-gray text-center"><?php echo $lang->tr('recentlyadded'); ?></h6>
                  <hr />
                  <?php
                  if(!$countryview->CountryEmpty()) {
                    echo '
                      <table class="table">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>'.$lang->tr("country").'</th>
                                <th>'.$lang->tr("countrycode").'</th>
                                <th>'.$lang->tr("status").'</th>
                                <th>'.$lang->tr("action").'</th>
                            </tr>
                        </thead>
                        <tbody>
                    ';
                    echo $countryview->DBCountry();
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
                      if($countryview->CountryShowToggle()){
                        ?>
                          <button type="submit" name="disable" class="btn btn-block btn-dark"><?php echo $lang->tr('disablecountry'); ?></button>
                        <?php
                      }else {
                        ?>
                          <button type="submit" name="enable" class="btn btn-block btn-success"><?php echo $lang->tr('enablecountry'); ?></button>
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