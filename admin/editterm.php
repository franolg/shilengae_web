<?php

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
// $sqq = $c->query("SELECT * FROM tablepolicies WHERE term_id='$id'");

$sqq = $c->query("SELECT * FROM tablepolicies");

// if ($sqq->num_rows == 0) {
   ?> 
   <!-- No result <a href="index.php">Go Back</a> -->
  <?php
// }else {
if(1==1) {
$exe = $sqq->fetch_array();
?>
          
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>Edit Terms and Conditions</title>
  <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
  <?php include 'includes/style.php' ?>
</head>
<body>
<?php
if(isset($_POST['edit_term'])) {
  $sqq1= $c->query("SELECT * FROM tablepolicies");
  $exo1 = $sqq1->fetch_array();
  $termid = $exo1['term_id'];
  $term = mysqli_real_escape_string($c,$_POST['term']);
  $flag = mysqli_real_escape_string($c,$_POST['flag']);

  if($c->query("UPDATE tablepolicies SET content = '$term' ,flag ='$flag' WHERE term_id='$termid'")) {
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
          title: 'Terms and Conditions Have been edited successfully.'
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
                  <h4 class="card-title">Edit Terms and Conditions</h4>
                  <p class="card-category">Be sure before Editing Countries</p>
                </div>
                <div class="card-body">
                  
                  <form method="post"  enctype="multipart/form-data">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Flag</label>
                          <input type="text" name="flag" class="form-control" value="<?php echo $exe['flag']; ?>">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label>Terms and Conditions</label>
                          <div class="form-group">
                          <!--<label class="bmd-label-floating">.</label> -->
                          <textarea class="form-control" name="term" rows="5"><?php echo trim($exe['content']); ?></textarea>
                          </div>
                        </div>
                      </div>
                    </div>
                    <button type="submit" name="edit_term" class="btn btn-warning pull-right">Edit</button>
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
<script src="assets/js/core/bootstrap-material-design.min.js"></script>

</body>
</html>
<?php } ?>