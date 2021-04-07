<?php

include '../private/connect.php'; // including every class from the root/private/connect.php.

$admin = new AdminView();

if(!isset($_SESSION['add']) || !$admin->check($_SESSION['add'])){
  header("Location: login.php");
  exit();
}
if (!$admin->RealAdmin($_SESSION['add'])) {
  header("Location: 404");
  exit();
}
$id = @$_GET['q'];
// $sqq = $c->query("SELECT * FROM tablepolicies WHERE term_id='$id'");


// if ($sqq->num_rows == 0) {
   ?> 
   <!--  No result <a href="javascript:history.back();">Go Back</a> -->
  <?php
// }else {
if(1==1) {
$app = new AppView();
$appc = new AppController();
$lang = new LocalView($_SESSION['add']);
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
<?php
if(isset($_POST['edit_term'])) {
  $term = $_POST['term'];
  $flag = $_POST['flag'];
  if(empty($term)) {
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
            title: '<?php echo $lang->tr('termrequired'); ?>'
          })
        </script>
    <?php
  }else if ($appc->EditTerm($term,$flag)) {
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
                  <h4 class="card-title"><?php echo $lang->tr('editterm'); ?></h4>
                  <p class="card-category"><?php echo $lang->tr('changerpage'); ?></p>
                </div>
                <div class="card-body">
                  
                  <form method="post"  enctype="multipart/form-data">
                    <div class="row">
                      <div class="col-md-12 pt-2">
                        <div class="form-group">
                          <label class="bmd-label-floating">Flag</label>
                          <input type="text" name="flag" class="form-control" value="<?php echo $app->ShowTerms('flag'); ?>">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label><?php echo $lang->tr('termsandcondition'); ?></label>
                          <div class="form-group">
                          <!--<label class="bmd-label-floating">.</label> -->
                          <textarea class="form-control" name="term" rows="5"><?php echo trim($app->ShowTerms('content')); ?></textarea>
                          </div>
                        </div>
                      </div>
                    </div>
                    <button type="submit" name="edit_term" class="btn btn-warning pull-right"><?php echo $lang->tr('edit'); ?></button>
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