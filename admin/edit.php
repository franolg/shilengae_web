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
  No result <a href="index.php">Go Back</a>
  <?php
}else {
?>
          
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>Edit <?php echo $userview->ShowUser($id,'firstname')." ".$userview->ShowUser($id,'lastname'); ?></title>
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
          title: '<?php echo $firstname; ?> has been edited successfully.'
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
                  <h4 class="card-title">Edit <?php echo ucwords($userview->ShowUser($id,'firstname')); ?></h4>
                  <p class="card-category">Be sure before Editing Users</p>
                </div>
                <div class="card-body" style="overflow-x: hidden;">
                  
                  <form method="post"  enctype="multipart/form-data">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">First Name</label>
                          <input type="text" name="first_name" class="form-control" value="<?php echo $userview->ShowUser($id,'firstname'); ?>">
                        </div>
                      </div>
                      <div class="col-md-6">
                       <div class="form-group">
                          <label class="bmd-label-floating">Last Name</label>
                          <input type="text" name="last_name" class="form-control" value="<?php echo $userview->ShowUser($id,'lastname'); ?>">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Email</label>
                          <input type="text" name="email" class="form-control" value="<?php echo $userview->ShowUser($id,'email'); ?>">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Mobile</label>
                          <input type="text" name="mobile" class="form-control" value="<?php echo $userview->ShowUser($id,'mobile'); ?>">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Country</label>
                          <input type="text" name="country" class="form-control" value="<?php echo $userview->ShowUser($id,'country'); ?>">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">State</label>
                          <input type="text" name="state" class="form-control" value="<?php echo $userview->ShowUser($id,'state'); ?>">
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">City</label>
                          <input type="text" name="city" class="form-control" value="<?php echo $userview->ShowUser($id,'city'); ?>">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Gender</label>
                          <input type="text" name="gender" class="form-control" value="<?php echo $userview->ShowUser($id,'gender'); ?>">
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Birth</label>
                          <input type="text" name="birth" class="form-control" value="<?php echo $userview->ShowUser($id,'birth'); ?>">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Career</label>
                          <input type="text" name="career" class="form-control" value="<?php echo $userview->ShowUser($id,'career'); ?>">
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Experience</label>
                          <input type="text" name="experience" class="form-control" value="<?php echo $userview->ShowUser($id,'experience'); ?>">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Salary</label>
                          <input type="text" name="salary" class="form-control" value="<?php echo $userview->ShowUser($id,'salary'); ?>">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Calling Code</label>
                          <input type="text" name="calling_code" class="form-control" value="<?php echo $userview->ShowUser($id,'code'); ?>">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Business</label>
                          <input type="text" name="business" class="form-control" value="<?php echo $userview->ShowUser($id,'business'); ?>">
                        </div>
                      </div>
                    </div>

                    <button type="submit" name="edit_user" class="btn btn-warning pull-right">Edit User</button>
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