<?php
include '../private/connect.php'; // including every class from the root/private/connect.php.

$adminview = new AdminView();
$id = $_SESSION['add'];
if(!isset($id) || !$adminview->check($id)){
  header("Location: login.php");
  exit();
}
$lang = new LocalView($id);
$admin = new AdminController($id);

$adid = @$_GET['q'];
if (!$adminview->check($adid)) {
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
  <title><?php echo $lang->tr('Shilengae')." ".$lang->tr('Admin Panel'); ?></title>
  <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
  <?php include 'includes/style.php' ?>
</head>
<body class="">
<style>

</style>
<?php
if(isset($_POST['edit_role'])) {
  $statusMsg = "";
  $backlink = ' <a href="./">Go back</a>';
  $username = $_POST['username'];
  $role = $_POST['role'];
  if(empty($username)) {
     $statusMsg = "Name is required.";
  }elseif (empty($role)) {
     $statusMsg = "Role is required";
  }
  else {
      if($admin->EditRole($username,$role,$adid)) {
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
            title: '".ucfirst($username)." have been edited successfully with a role of ".ucwords($role).".'
          })
        </script>";
    }
    else{
         $statusMsg = "Please try again.";
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
                    <h4 class="card-title"><?php echo $lang->tr('Edit Role'); ?></h4>
                    <p class="card-category"><?php echo $lang->tr('Adding Page'); ?></p>
                  </div>
                  <div class="card-body" style="padding-top: 30px;padding-left: 30px;padding-right: 30px;">
                    <form method="post"  enctype="multipart/form-data">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                             <div class="form-group">
                            <label class="bmd-label-floating"><?php echo $lang->tr('Username'); ?></label>
                            <input type="text" name="username" class="form-control" value="<?php echo $adminview->ShowAdmin($adid,'username'); ?>">
                          </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <select class="form-control selectpicker temp1" name="role" data-style="btn btn-link">
                              <option <?php echo $adminview->ShowAdmin($adid,'type') == 'admin' ?'selected': ''; ?> value="admin" disabled="">Admin</option>
                              <option <?php echo $adminview->ShowAdmin($adid,'type') == 'moderator' ?'selected': ''; ?> value="moderator">Moderator</option>
                              <option <?php echo $adminview->ShowAdmin($adid,'type') == 'account' ?'selected': ''; ?> value="account">Accounts</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <button type="submit" name="edit_role" class="btn btn-warning pull-right add_pro"><?php echo $lang->tr('Add Role'); ?></button>
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