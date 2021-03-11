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

$msg = $c->query("SELECT * FROM message WHERE status='unseen'");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Elnes Admin Panel</title>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
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
<body>
<?php
include 'php.php';
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
            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-warning card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">storage</i>
                  </div>
                  <p class="card-category">Used Space</p>
                  <h3 class="card-title"><?php echo formatBytes($totalSize); ?></h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                      <i class="material-icons">memory</i> Website Size 
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-success card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">folder_open</i>
                  </div>
                  <p class="card-category">Projects</p>
                  <h3 class="card-title"><?php echo numberof("project"); ?></h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons">list</i> All projects
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-danger card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">category</i>
                  </div>
                  <p class="card-category">Categories</p>
                  <h3 class="card-title"><?php echo numberof("category"); ?></h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons">file_copy</i> All Categories
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-info card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">contact_support</i>
                  </div>
                  <p class="card-category">Received Messages</p>
                  <h3 class="card-title"><?php echo $msg->num_rows; ?></h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons">email</i> New Messages
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
    </div>
  </div>

  <script src="assets/js/core/jquery.min.js"></script>
  <script src="../owl/owl.carousel.min.js"></script>
  <script src="../unpkg/aos.js"></script>
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap-material-design.min.js"></script>
  <script src="assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <script src="assets/js/plugins/moment.min.js"></script>
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
  <script src="../index.js"></script>
</body>

</html>