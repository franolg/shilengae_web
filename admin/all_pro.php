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
function ago($datetime, $full = false) {
  $now = new DateTime;
  $ago = new DateTime($datetime);
  $diff = $now->diff($ago);

  $diff->w = floor($diff->d / 7);
  $diff->d -= $diff->w * 7;

  $string = array(
      'y' => 'year',
      'm' => 'month',
      'w' => 'week',
      'd' => 'day',
      'h' => 'hour',
      'i' => 'minute',
      's' => 'second',
  );
  foreach ($string as $k => &$v) {
      if ($diff->$k) {
          $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
      } else {
          unset($string[$k]);
      }
  }

  if (!$full) $string = array_slice($string, 0, 1);
  return $string ? implode(', ', $string) . ' ago' : 'just now';
}
function projects($id){
  global $c;
  $nu = $c->query("SELECT * FROM project WHERE pid='$id'");
  $un = $nu->fetch_array();

  return $un['name'];
}
?>
          
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>Shilengae Admin Panel</title>
  <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
<?php include 'includes/style.php' ?>
</head>
<body class="">
<?php
if (isset($_GET['q'])) {
  $id = $_GET['q'];
  $chj = $c->query("SELECT * FROM pro_image WHERE tid = '$id'");
  if ($chj->num_rows != 0) {
    if($c->query("DELETE FROM pro_image WHERE tid = '$id'")){
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
              title: 'Deleted successfully.'
            })
          </script>";
    }
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
              <div class="card ">
                <div class="card-body">
                  <h6 class="card-category text-gray text-center">All Projects</h6>
                  <hr />
                  <?php
                  $pro = $c->query("SELECT * FROM pro_image ORDER BY id DESC");
                  if($pro->num_rows > 0) {
                    echo '<div class="row">';
                    while ($eex = $pro->fetch_array()) {
                      echo '<div class="col-md-4">
                              <div class="card">
                              <div class="card-body">
                              <div class="deg">
                                <div class="projer">
                                <a href="all_pro.php?q='.$eex['tid'].'" class="untext btn btn-outline-danger"><i class="material-icons">delete</i> Delete</a>
                                </div>
                                <h4 class="card-title text-center mb-3"><b>'.ucwords(projects($eex['pid'])).'<b></h4>
                                <img class="card-img-top" src="../assets/projects/'.$eex['photo'].'" rel="nofollow" alt="Card image cap">
                                <p class="card-text text-right"><small class="text-muted">Published '.ago('@'.$eex['timer']).'</small></p></div>
                              </div></div></div>';
                    }
                    echo "</div>";
                  }
                  else {
                      echo '<h6 class="card-category text-muted text-center pt-5 pb-5"><i class="material-icons" style="top: 4px;padding-right: 4px;font-size: 19px;">warning</i> No Result</h6>';
                  }
                    
                    // <a href=\"javascript:;\" class=\"btn btn-primary btn-round\">Follow</a>
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


</body>

</html>