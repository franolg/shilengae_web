<?php

include '../private/connect.php'; // including every class from the root/private/connect.php.

$admin = new AdminView();

if(!isset($_SESSION['add']) || !$admin->check($_SESSION['add'])){
  header("Location: login.php");
  exit();
}
$user = new UserController();
$userview = new UserView();

$id = @$_GET['q'];
if (!$userview->CheckUserID($id)) {
  ?>
  No result <a href="javascript:history.back();">Go Back</a>
  <?php
}else {

$lang = new LocalView($_SESSION['add']);
?>
          
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title><?php echo $lang->tr('edit')." ".$userview->ShowUser($id,'firstname')." ".$userview->ShowUser($id,'lastname'); ?></title>
  <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
  <?php include 'includes/style.php' ?>
</head>
<body>
<?php
if(isset($_POST['edit_user'])) {
  $firstname = $_POST['first_name'];
  $lastname = $_POST['last_name'];
  $email = $_POST['email'];
  $mobile = $_POST['mobile'];
  $country = $_POST['country'];
  $state = $_POST['state'];
  $city = $_POST['city'];
  $gender = $_POST['gender'];
  $birth = $_POST['birth'];
  $career = $_POST['career'];
  $experience = $_POST['experience'];
  $salary = $_POST['salary'];
  $callingcode = $_POST['calling_code'];
  $business = $_POST['business'];
  if($user->EditUser($id,$firstname,$lastname,$email,$mobile,$country,$state,$city,$gender,$birth,$career,$experience,$salary,$callingcode,$business)) {
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
          title: '<?php echo $lang->tr('editsuccess'); ?>'
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
            title: '<?php echo $lang->tr('unexpectederror'); ?>'
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
                  <h4 class="card-title"><?php echo $lang->tr('edit'); ?></h4>
                  <p class="card-category"><?php echo $lang->tr('changerpage'); ?></p>
                </div>
                <div class="card-body" style="overflow-x: hidden;">
                  
                  <form method="post"  enctype="multipart/form-data">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating"><?php echo $lang->tr('firstname'); ?></label>
                          <input type="text" name="first_name" class="form-control" value="<?php echo $userview->ShowUser($id,'firstname'); ?>">
                        </div>
                      </div>
                      <div class="col-md-6">
                       <div class="form-group">
                          <label class="bmd-label-floating"><?php echo $lang->tr('lastname'); ?></label>
                          <input type="text" name="last_name" class="form-control" value="<?php echo $userview->ShowUser($id,'lastname'); ?>">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating"><?php echo $lang->tr('email'); ?></label>
                          <input type="text" name="email" class="form-control" value="<?php echo $userview->ShowUser($id,'email'); ?>">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating"><?php echo $lang->tr('mobile'); ?></label>
                          <input type="text" name="mobile" class="form-control" value="<?php echo $userview->ShowUser($id,'mobile'); ?>">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating"><?php echo $lang->tr('country'); ?></label>
                          <input type="text" name="country" class="form-control" value="<?php echo $userview->ShowUser($id,'country'); ?>">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating"><?php echo $lang->tr('state'); ?></label>
                          <input type="text" name="state" class="form-control" value="<?php echo $userview->ShowUser($id,'state'); ?>">
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating"><?php echo $lang->tr('city'); ?></label>
                          <input type="text" name="city" class="form-control" value="<?php echo $userview->ShowUser($id,'city'); ?>">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating"><?php echo $lang->tr('gender'); ?></label>
                          <input type="text" name="gender" class="form-control" value="<?php echo $userview->ShowUser($id,'gender'); ?>">
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating"><?php echo $lang->tr('birth'); ?></label>
                          <input type="text" name="birth" class="form-control" value="<?php echo $userview->ShowUser($id,'birth'); ?>">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating"><?php echo $lang->tr('career'); ?></label>
                          <input type="text" name="career" class="form-control" value="<?php echo $userview->ShowUser($id,'career'); ?>">
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating"><?php echo $lang->tr('experience'); ?></label>
                          <input type="text" name="experience" class="form-control" value="<?php echo $userview->ShowUser($id,'experience'); ?>">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating"><?php echo $lang->tr('salary'); ?></label>
                          <input type="text" name="salary" class="form-control" value="<?php echo $userview->ShowUser($id,'salary'); ?>">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating"><?php echo $lang->tr('callingcode'); ?></label>
                          <input type="text" name="calling_code" class="form-control" value="<?php echo $userview->ShowUser($id,'code'); ?>">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating"><?php echo $lang->tr('business'); ?></label>
                          <input type="text" name="business" class="form-control" value="<?php echo $userview->ShowUser($id,'business'); ?>">
                        </div>
                      </div>
                    </div>

                    <button type="submit" name="edit_user" class="btn btn-warning pull-right"><?php echo $lang->tr('edituser'); ?></button>
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

</body>
</html>
<?php } ?>