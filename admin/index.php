<?php

include '../private/connect.php'; // including every class from the root/private/connect.php.

$admin = new AdminView();

if(!isset($_SESSION['add']) || !$admin->check($_SESSION['add'])){
  header("Location: login.php");
  exit();
}
$lang = new LocalView($_SESSION['add']);
// $msg = $c->query("SELECT * FROM message WHERE status='unseen'");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title><?php echo $lang->tr('shilengae')." ".$lang->tr('adminpanel'); ?> </title>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <?php include 'includes/style.php' ?>
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
                <p class="card-category"><?php echo $lang->tr('usedspace'); ?></p>
                <h3 class="card-title"><?php echo formatBytes($totalSize,$lang->lang()); ?></h3>
              </div>
              <div class="card-footer">
                <div class="stats">
                    <i class="material-icons">memory</i> <?php echo $lang->tr('websitesize'); ?> 
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

</body>

</html>