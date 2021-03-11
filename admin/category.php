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

  <link href="../owl/owl.carousel.min.css" rel="stylesheet">

  <link href="assets/demo/demo.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@9.10.12/dist/sweetalert2.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.10.12/dist/sweetalert2.all.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.10.12/dist/sweetalert2.min.js"></script>


</head>
<body>
<?php
if (isset($_GET['q'])) {
  $id = $_GET['q'];
  $chj = $c->query("SELECT * FROM category WHERE id = '$id'");
  if ($chj->num_rows != 0) {
    if($c->query("DELETE FROM category WHERE id = '$id'")){
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



if (isset($_POST['addc'])) {
  $cat = strtolower(trim(mysqli_real_escape_string($c,$_POST['cat'])));
  $timer = time();
  $sq = $c->query("SELECT * FROM category WHERE name='$cat'");
  if ($sq->num_rows == 0) {
    if($cat != "") {
      if ($c->query("INSERT INTO category (name,timer)VALUES('$cat','$timer')")) {
        echo "<script>
              const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                onOpen: (toast) => {
                  toast.addEventListener('mouseenter', Swal.stopTimer)
                  toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
              })

              Toast.fire({
                icon: 'success',
                title: 'Category added successfully'
              })
            </script>";
      }
      else {
         echo "<script>
                const Toast = Swal.mixin({
                  toast: true,
                  position: 'top-end',
                  showConfirmButton: false,
                  timer: 3000,
                  timerProgressBar: true,
                  onOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                  }
                })

                Toast.fire({
                  icon: 'error',
                  title: 'Category can\'t be added, Please try again.'
                })
              </script>";
      }
    }
    else {
         echo "<script>
                const Toast = Swal.mixin({
                  toast: true,
                  position: 'top-end',
                  showConfirmButton: false,
                  timer: 3000,
                  timerProgressBar: true,
                  onOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                  }
                })

                Toast.fire({
                  icon: 'error',
                  title: 'Unknown Category Name.'
                })
              </script>";
      }
  }
  else {
    echo "<script>
            const Toast = Swal.mixin({
              toast: true,
              position: 'top-end',
              showConfirmButton: false,
              timer: 3000,
              timerProgressBar: true,
              onOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
              }
            })

            Toast.fire({
              icon: 'error',
              title: 'Category already exists.'
            })
          </script>";
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
                  <h4 class="card-title">Add Categories</h4>
                  <p class="card-category">The Category name must be unique</p>
                </div>
                <div class="card-body">
                  <form method="post">                    
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Category Name</label>
                          <input type="text" name="cat" class="form-control">
                        </div>
                      </div>
                    </div>
                   
                    <button type="submit" name="addc" class="btn btn-warning pull-right" >Add Category</button>
                    <div class="clearfix"></div>
                  </form>
                </div>
              </div>
            </div>
            
            <div class="col-md-8">
              <div class="container">
              <div class="card card-profile">
                <div class="card-body" style="overflow-x: auto;">
                  <h6 class="card-category text-gray">What users see in the website</h6>
                  <hr />
                  <div class="owl-carousel pro-list1">
                  <a class="item filter-button itemer" data-filter="">All</a>
                    <?php
                    $sd = $c->query("SELECT * FROM category");
                    while ($ex = $sd->fetch_array()) {
                      ?>
                      <a class="item filter-button itemer" data-filter="<?php echo $ex['name']; ?>"><?php echo ucwords($ex['name']); ?></a>
                      <?php
                    }
                    ?>
                  </div>
                </div>
              </div>
            </div>
            </div>
            <div class="col-md-4">
              <div class="card card-profile">
                <div class="card-body">
                  <h6 class="card-category text-gray">Recently Added Categories</h6>
                  <hr />

                    <table class="table">
                      <thead class=" text-primary">
                        <tr><th>Category</th><th>Time</th></tr>
                      </thead>
                      <tbody>
                        <?php
                        $ds = $c->query("SELECT * FROM category ORDER BY id DESC");
                        while ($exe = $ds->fetch_array()) {
                          ?>
                          <tr><td class="dodo"><div class="con-cat"><a href="category.php?q=<?php echo $exe['id'] ?>" class="untext btn btn-block btn-outline-warning text-white"><i class="material-icons">delete</i> Delete</a></div><?php echo ucwords($exe['name']); ?></td><td><?php echo ago('@'.$exe['timer']); ?></td></tr>
                          <?php
                        }
                        ?>
                      </tbody>
                    </table>
                  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

<style>
  .untext {
    height: 80%;
  }
  .dodo:hover .con-cat {
    visibility: visible;
    opacity: 1;
  }
  .con-cat {
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    background: rgb(13, 13, 13, 0.2);
    color: #fff;
    visibility: hidden;
    opacity: 0;
    transition: opacity .2s, visibility .2s;
  }
  a.item {
    text-align: center;
    color: #979797 !important;
    text-decoration: none;
  }
  a.item:hover {
    transition: all 0.4s ease;
  }
  .pro-list1 {
    margin-left: auto;
    margin-right: auto;
    width: 900px;
    color: #979797;
    text-align: center;
    margin-bottom: 30px;
  }
  .pro-list1 > div > div > div {
    text-align: center;
    border-right: 1px solid #979797;
  }
  .pro-list1 > div > div > div:last-child {
    text-align: center;
    border: none;
  }
</style>
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