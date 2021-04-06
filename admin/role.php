<?php
include '../private/connect.php'; // including every class from the root/private/connect.php.

$adminview = new AdminView();
$id = $_SESSION['add'];
if(!isset($id) || !$adminview->check($id)){
  header("Location: login.php");
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
$admin = new AdminController($id);
if(isset($_POST['add_role'])) {
  $statusMsg = "";
  $backlink = ' <a href="./">Go back</a>';
  $username = $_POST['username'];
  $role = $_POST['role'];
  $password = $_POST['pass'];
  $cpassword = $_POST['cp'];
  if(empty($username)) {
     $statusMsg = "Name is required.";
  }elseif (empty($role)) {
     $statusMsg = "Role is required";
  }elseif (empty($password)) {
     $statusMsg = "Password is required";
  }elseif (empty($cpassword)) {
     $statusMsg = "Confirm password is required";
  }elseif (strlen($password) < 6 || strlen($password) > 15) {
     $statusMsg = "Password must be at least 6 and less than 15";
  }elseif (strlen($cpassword) < 6 || strlen($cpassword) > 15) {
     $statusMsg = "Confirm password must be at least 6 and less than 15";
  }elseif ($password != $cpassword) {
     $statusMsg = "Password doesn\'t match";
  }
  else {
      if($admin->AddRole($username,$role,$cpassword)) {
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
            title: '".ucfirst($username)." have been added successfully with a role of ".ucwords($role).".'
          })
        </script>";
    }
    else{
         $statusMsg = "Username Exists.";
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
  $cid = $_GET['q'];
  if ($adminview->check($cid)) {
    $admin->DeletedRole($cid);
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
                    <h4 class="card-title"><?php echo $lang->tr('addrole'); ?></h4>
                    <p class="card-category"><?php echo $lang->tr('addingpage'); ?></p>
                  </div>
                  <div class="card-body" style="padding-top: 30px;padding-left: 30px;padding-right: 30px;">
                    <form method="post" enctype="multipart/form-data">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                             <div class="form-group">
	                          <label class="bmd-label-floating"><?php echo $lang->tr('username'); ?></label>
	                          <input type="text" name="username" class="form-control">
	                        </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <select class="form-control selectpicker temp1" name="role" data-style="btn btn-link">
                              <option disabled="">Admin</option>
                              <option value="moderator">Moderator</option>
                              <option value="account">Accounts</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                             <div class="form-group">
                            <label class="bmd-label-floating"><?php echo $lang->tr('password'); ?></label>
                            <input type="text" name="pass" class="form-control">
                          </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                             <div class="form-group">
                            <label class="bmd-label-floating"><?php echo $lang->tr('confirmpassword'); ?></label>
                            <input type="text" name="cp" class="form-control">
                          </div>
                          </div>
                        </div>
                      </div>
                      <button type="submit" name="add_role" class="btn btn-warning pull-right add_pro"><?php echo $lang->tr('Add Role'); ?></button>
                      <div class="clearfix"></div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card ">
                <div class="card-body">
                  <h6 class="card-category text-gray text-center"><?php echo $lang->tr('Recently Added'); ?></h6>
                  <hr />
                  <?php
                  if(!$adminview->AnyAdmin($id)) {
                    echo '
                      <table class="table">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>'.$lang->tr('Username').'</th>
                                <th>'.$lang->tr('Role').'</th>
                                <th>'.$lang->tr('Added by').'</th>
                                <th>'.$lang->tr('Action').'</th>
                            </tr>
                        </thead>
                        <tbody>
                    ';
                    echo $adminview->DBAdmin($id);
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