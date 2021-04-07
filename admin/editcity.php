<?php
include '../private/connect.php'; // including every class from the root/private/connect.php.

$adminview = new AdminView();
$id = $_SESSION['add'];
if(!isset($id) || !$adminview->check($id)){
  header("Location: login.php");
  exit();
}
$cityview = new CityView();
$city = new CityController();

$q = $_GET['q'];
if (!isset($q) || !$cityview->check($q)) {
?>No result <a href="javascript:history.back();">Go Back</a><?php
}else {
$lang = new LocalView($id);

?>
          
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title><?php echo $lang->tr('Shilengae')." ".$lang->tr('Admin Panel'); ?></title>
  <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
  <?php include 'includes/style.php' ?>
</head>
<body>
<style>

</style>
<?php
if(isset($_POST['edit_city'])) {
  $statusMsg = "";
  $backlink = ' <a href="./">Go back</a>';
  $cityname = $_POST['city'];
  $country = $_POST['country'];
  if(empty($cityname)) {
     $statusMsg = $lang->tr("namerequired");
  }elseif (empty($country)) {
     $statusMsg = $lang->tr("countryrequired");
  }else {
      if($city->EditCity($q,$cityname,$country)) {
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
            title: '".$lang->tr("editsuccess")."'
          })
        </script>";
    }
    else{
         $statusMsg = $lang->tr("cityexists");
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
            <div class="col-md-12">
              <div class="card unclass">
                <div class="cssload-thecube">
                  <div class="cssload-cube cssload-c1"></div>
                  <div class="cssload-cube cssload-c2"></div>
                  <div class="cssload-cube cssload-c4"></div>
                  <div class="cssload-cube cssload-c3"></div>
                </div>
                <div class="carder">
                  <div class="card-header card-header-warning">
                    <h4 class="card-title"><?php echo $lang->tr('editcity'); ?></h4>
                    <p class="card-category"><?php echo $lang->tr('changerpage'); ?></p>
                  </div>
                  <div class="card-body" style="padding-top: 30px;padding-left: 30px;padding-right: 30px;">
                    <form method="post" enctype="multipart/form-data">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                             <div class="form-group">
	                          <label class="bmd-label-floating"><?php echo $lang->tr('cityname'); ?></label>
	                          <input type="text" name="city" class="form-control" value="<?php echo $cityview->ShowCity($q,'name'); ?>">
	                        </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <select class="form-control selectpicker temp1" name="country" data-style="btn btn-link">
                              <?php echo $cityview->Cities($cityview->ShowCity($q,'country')); ?>
                            </select>
                          </div>
                        </div>
                      </div>
                      <button type="submit" name="edit_city" class="btn btn-warning pull-right add_pro"><?php echo $lang->tr('editcity'); ?></button>
                      <div class="clearfix"></div>
                    </form>
                  </div>
                </div>
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
<?php } ?>