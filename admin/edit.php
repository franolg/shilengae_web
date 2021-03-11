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
if(isset($_POST['add_pro'])) {
  $sqq1= $c->query("SELECT * FROM project WHERE pid='$id'");
  $exo1 = $sqq1->fetch_array();
  $pid = $exo1['pid'];
  $name = mysqli_real_escape_string($c,$_POST['name']);
  $location = mysqli_real_escape_string($c,$_POST['location']);
  $theme = mysqli_real_escape_string($c,$_POST['theme']);
  $scope = mysqli_real_escape_string($c,$_POST['scope']);
  $description = mysqli_real_escape_string($c,$_POST['description']);
  $cat = mysqli_real_escape_string($c,$_POST['cat']);
  if($c->query("UPDATE project SET name = '$name',category = '$cat',location = '$location',theme = '$theme',scope = '$scope',description = '$description' WHERE pid='$pid'")) {
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
          title: '<?php echo $name; ?> have been edited to projects successfully.'
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

$sqq = $c->query("SELECT * FROM project WHERE pid='$id'");
if ($sqq->num_rows == 0) {
  ?>
  No result <a href="index.php">Go Back</a>
  <?php
}else {
$exo = $sqq->fetch_array();

?>
          
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>Edit <?php echo $exo['name']; ?></title>
  <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <link href="assets/css/material-dashboard.css?v=2.1.2" rel="stylesheet" />
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/4.0.0/css/jasny-bootstrap.min.css">
  <link href="assets/demo/demo.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@9.10.12/dist/sweetalert2.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.10.12/dist/sweetalert2.all.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.10.12/dist/sweetalert2.min.js"></script>
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
                  <h4 class="card-title">Edit <?php echo ucwords($exo['name']); ?> Project</h4>
                  <p class="card-category">Be sure before Editing the project</p>
                </div>
                <div class="card-body" style="overflow-x: hidden;">
                  
                  <form method="post"  enctype="multipart/form-data">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Project Name</label>
                          <input type="text" name="name" class="form-control" value="<?php echo $exo['name']; ?>">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <style>
                          .temp1 > .btn {
                            padding: unset !important;
                            line-height: 3 !important;
                            margin: 0px 0 0 !important;
                          }
                           .show > .btn.dropdown-toggle, .show > .btn.dropdown-toggle:hover, .show > .btn.dropdown-toggle:focus {
                            background: transparent !important;
                            color: #919191 !important;
                            border-color: transparent !important;
                            box-shadow: unset !important;
                           }
                           .dropdown-menu .dropdown-item:hover {
                            color: #919191;
                           }
                           .dropdown-menu .dropdown-item:hover {
                            background: linear-gradient(60deg, #ffa726, #fb8c00);
                            color: #fff;
                           }
                           .dropdown-item.active {
                            background: linear-gradient(60deg, #ffa726, #fb8c00);
                            color: #fff;
                           }
                        </style>
                      <div class="form-group">
                        <select class="form-control selectpicker temp1" name="cat" data-style="btn btn-link">
                          <?php
                          $dw = $c->query("SELECT * FROM category");
                          if($dw->num_rows > 0){
                            echo "<optgroup label='Category'>";
                            while ($er = $dw->fetch_array()) {
                              $check = "";
                              if ($exo['category'] == $er['name']) {
                                $check = "selected";
                              }
                              echo '<option value="'.$er['name'].'" '.$check.'>'.$er['name'].'</option>';
                            }
                            echo "</optgroup>";
                          }else {
                            ?>
                            <optgroup label="Category"><option>No result</option></optgroup>
                            <?php
                          }
                          ?>
                        </select>
                      </div>
                    </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Location</label>
                          <input type="text" name="location" class="form-control" value="<?php echo $exo['location']; ?>">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Theme</label>
                          <input type="text" name="theme" class="form-control" value="<?php echo $exo['theme']; ?>">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Scope</label>
                          <input type="text" name="scope" class="form-control" value="<?php echo $exo['scope']; ?>">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label>Description</label>
                          <div class="form-group">
                          <!--<label class="bmd-label-floating">.</label> -->
                          <textarea class="form-control" name="description" rows="5"><?php echo $exo['description']; ?></textarea>
                          </div>
                        </div>
                      </div>
                    </div>

                    <button type="submit" name="add_pro" class="btn btn-warning pull-right">Edit Category</button>
                    <div class="clearfix"></div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
<style>
  .untext .material-icons {
    bottom: 3px !important;
    right: 3px !important;
    top: unset !important;
    font-size: unset !important;
  } 
  .untext {
    width: 50%;
    color: white;
    font-size: 100%;
    top: 35%;
    left: 50%;
    transform: translate(-50%, -50%);
    -ms-transform: translate(-50%, -50%);
  }
  /* relevant styles */
  .deg {
    position: relative;
    padding: 2% 2%;
  }

  .projer {
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    background: rgb(13, 13, 13, 0.42);
    color: #fff;
    visibility: hidden;
    opacity: 0;
    border-radius: 5px;
    transition: opacity .2s, visibility .2s;
  }

  .deg:hover .projer {
    visibility: visible;
    opacity: 1;
  }
</style>


  <script src="assets/js/core/jquery.min.js"></script>
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap-material-design.min.js"></script>
  <script src="assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <script src="assets/js/plugins/moment.min.js"></script>
  <script src="assets/js/plugins/sweetalert2.js"></script>
  <script src="assets/js/plugins/jquery.validate.min.js"></script>
  <script src="assets/js/plugins/jquery.bootstrap-wizard.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.17/js/bootstrap-select.min.js"></script>
  <script src="assets/js/plugins/bootstrap-datetimepicker.min.js"></script>
  <script src="assets/js/plugins/bootstrap-tagsinput.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/4.0.0/js/jasny-bootstrap.js"></script>
  <script src="assets/js/plugins/jasny-bootstrap.min.js"></script>
  <script src="assets/js/plugins/fullcalendar.min.js"></script>
  <script src="assets/js/plugins/jquery-jvectormap.js"></script>
  <script src="assets/js/plugins/nouislider.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
  <script src="assets/js/plugins/arrive.min.js"></script>
  <script src="assets/js/plugins/chartist.min.js"></script>
  <script src="assets/js/plugins/bootstrap-notify.js"></script>
  <script src="assets/js/material-dashboard.js?v=2.1.2" type="text/javascript"></script>



</body>

</html>
<?php } ?>