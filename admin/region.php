<?php
include '../private/connect.php'; // including every class from the root/private/connect.php.

$adminview = new AdminView();
$id = $_SESSION['add'];
if(!isset($id) || !$adminview->check($id)){
  header("Location: login.php");
  exit();
}
if (!$adminview->RealAdmin($_SESSION['add'])) {
  header("Location: 404");
  exit();
}
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
$regionview = new RegionView();
$region = new RegionController();
if(isset($_POST['add_reg'])) {
  $statusMsg = "";
  $backlink = ' <a href="./">Go back</a>';
  $name = $_POST['name'];
  $city = $_POST['city'];
  if(empty($name)) {
     $statusMsg = $lang->tr("namerequired");
  }elseif (empty($city)) {
     $statusMsg = $lang->tr("cityrequired");
  }else {
      if($region->AddRegion($name,$city)) {
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
            title: '".$lang->tr("addedsuccess")."'
          })
        </script>";
    }
    else{
         $statusMsg = $lang->tr("regexists");
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
  $rid = $_GET['q'];
  $region->DeletedRegion($rid);
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
                    <h4 class="card-title"><?php echo $lang->tr('addregion'); ?></h4>
                    <p class="card-category"><?php echo $lang->tr('addingpage'); ?></p>
                  </div>
                  <div class="card-body" style="padding-top: 30px;padding-left: 30px;padding-right: 30px;">
                    <form method="post" enctype="multipart/form-data">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                             <div class="form-group">
	                          <label class="bmd-label-floating"><?php echo $lang->tr('regionname'); ?></label>
	                          <input type="text" name="name" class="form-control">
	                        </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <select class="form-control selectpicker temp1" name="city" data-style="btn btn-link">
                              <?php echo $regionview->Regions(); ?>
                            </select>
                          </div>
                        </div>
                      </div>
                      <button type="submit" name="add_reg" class="btn btn-warning pull-right add_pro"><?php echo $lang->tr('addregion'); ?></button>
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
                  if(!$regionview->AnyRegion($id)) {
                    echo '
                      <table class="table">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>'.$lang->tr('name').'</th>
                                <th>'.$lang->tr('city').'</th>
                                <th>'.$lang->tr('action').'</th>
                            </tr>
                        </thead>
                        <tbody>
                    ';
                    echo $regionview->DBRegion($id);
                    echo '
                      </tbody>
                    </table>';
                  }
                  else {
                      echo '<h6 class="card-category text-muted text-center pt-5 pb-5"><i class="material-icons" style="top: 4px;padding-right: 4px;font-size: 19px;">warning</i> '.$lang->tr('noresult').'</h6>';
                  }
                  ?>
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