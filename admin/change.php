<?php
include '../private/connect.php'; // including every class from the root/private/connect.php.

$adminview = new AdminView();
if(!isset($_SESSION['add']) || !$adminview->check($_SESSION['add'])){
  header("Location: login.php");
  exit();
}

$admin = new AdminController($_SESSION['add']);

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
                  <h4 class="card-title">Change Password</h4>
                  <p class="card-category">Be sure on changing the password</p>
                </div>
                <div class="card-body" style="overflow-x: hidden;">
                  <?php
                    if(isset($_POST['add_pro'])) {
                        $current = $_POST['cp'];
                        $new = $_POST['np'];
                        $rewrite = $_POST['rp'];
                        if($admin->checkPassword($current)) {
                          if($new == $rewrite){
                            if($admin->changePassword($rewrite)) {
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
                                  title: 'Password have been changed successfully.'
                                })
                              </script>
                              <?php
                          }
                          else{
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
                                    title: 'Can\'t change password try again.' 
                                  })
                                </script>
                            <?php
                          }
                        }else {
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
                                    title: 'Password doesn\'t match'
                                  })
                                </script>
                            <?php
                        }
                      }else{
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
                                    title: 'Current password is not correct'
                                  })
                                </script>
                            <?php
                      }
                    }
                  ?>
                  <form method="post"  enctype="multipart/form-data">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Current Password</label>
                          <input type="text" name="cp" class="form-control">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">New Password</label>
                          <input type="text" name="np" class="form-control">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Confirm Password</label>
                          <input type="text" name="rp" class="form-control">
                        </div>
                      </div>
                    </div>

                    <button type="submit" name="add_pro" class="btn btn-warning pull-right">Change</button>
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