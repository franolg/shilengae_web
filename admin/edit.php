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

$id = @$_GET['q'];
$sqq = $c->query("SELECT * FROM tableusers WHERE user_id='$id'");
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
  <title>Edit <?php echo $exe['first_name']." ".$exe['last_name']; ?></title>
  <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
  <?php include 'includes/style.php' ?>
</head>
<body>
<?php
if(isset($_POST['edit_user'])) {
  $sqq1= $c->query("SELECT * FROM tableusers WHERE user_id='$id'");
  $exo1 = $sqq1->fetch_array();
  $userid = $exo1['user_id'];
  $first_name = mysqli_real_escape_string($c,$_POST['first_name']);
  $last_name = mysqli_real_escape_string($c,$_POST['last_name']);
  $email = mysqli_real_escape_string($c,$_POST['email']);
  $mobile = mysqli_real_escape_string($c,$_POST['mobile']);
  $country = mysqli_real_escape_string($c,$_POST['country']);
  $state = mysqli_real_escape_string($c,$_POST['state']);
  $city = mysqli_real_escape_string($c,$_POST['city']);
  $gender = mysqli_real_escape_string($c,$_POST['gender']);
  $birth = mysqli_real_escape_string($c,$_POST['birth']);
  $career = mysqli_real_escape_string($c,$_POST['career']);
  $experience = mysqli_real_escape_string($c,$_POST['experience']);
  $salary = mysqli_real_escape_string($c,$_POST['salary']);
  $calling_code = mysqli_real_escape_string($c,$_POST['calling_code']);
  $business = mysqli_real_escape_string($c,$_POST['business']);


  if($c->query("UPDATE tableusers SET first_name = '$first_name',last_name = '$last_name',email = '$email',mobile = '$mobile',country = '$country',state = '$state',city = '$city',gender = '$gender',birth = '$birth',career = '$career',experience = '$experience',salary = '$salary',calling_code = '$calling_code',business = '$business' WHERE user_id='$userid'")) {
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
          title: '<?php echo $first_name; ?> has been edited successfully.'
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
                  <h4 class="card-title">Edit <?php echo ucwords($exe['first_name']); ?></h4>
                  <p class="card-category">Be sure before Editing Users</p>
                </div>
                <div class="card-body" style="overflow-x: hidden;">
                  
                  <form method="post"  enctype="multipart/form-data">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">First Name</label>
                          <input type="text" name="first_name" class="form-control" value="<?php echo $exe['first_name']; ?>">
                        </div>
                      </div>
                      <div class="col-md-6">
                       <div class="form-group">
                          <label class="bmd-label-floating">Last Name</label>
                          <input type="text" name="last_name" class="form-control" value="<?php echo $exe['last_name']; ?>">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Email</label>
                          <input type="text" name="email" class="form-control" value="<?php echo $exe['email']; ?>">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Mobile</label>
                          <input type="text" name="mobile" class="form-control" value="<?php echo $exe['mobile']; ?>">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Country</label>
                          <input type="text" name="country" class="form-control" value="<?php echo $exe['country']; ?>">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">State</label>
                          <input type="text" name="state" class="form-control" value="<?php echo $exe['state']; ?>">
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">City</label>
                          <input type="text" name="city" class="form-control" value="<?php echo $exe['city']; ?>">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Gender</label>
                          <input type="text" name="gender" class="form-control" value="<?php echo $exe['gender']; ?>">
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Birth</label>
                          <input type="text" name="birth" class="form-control" value="<?php echo $exe['birth']; ?>">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Career</label>
                          <input type="text" name="career" class="form-control" value="<?php echo $exe['career']; ?>">
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Experience</label>
                          <input type="text" name="experience" class="form-control" value="<?php echo $exe['experience']; ?>">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Salary</label>
                          <input type="text" name="salary" class="form-control" value="<?php echo $exe['salary']; ?>">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Calling Code</label>
                          <input type="text" name="calling_code" class="form-control" value="<?php echo $exe['calling_code']; ?>">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Business</label>
                          <input type="text" name="business" class="form-control" value="<?php echo $exe['business']; ?>">
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