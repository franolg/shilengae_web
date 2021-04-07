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
<style>

</style>
<?php

$app = new AppController();

if(isset($_POST['add_country'])) {
$statusMsg = "";
$backlink = ' <a href="./">Go back</a>';
$id = uniqid().time();
$term = $_POST['term'];
if(empty($term)) {
   $statusMsg = "Terms and Conditions can\'t be empty.";
}
else {
  echo $app->AddTerm($term);
}
if ($statusMsg != "") {
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
            icon: 'error',
            title: '".$statusMsg."'
          })
        </script>";
  }
}

?>
  <div class="wrapper ">
    <?php
    include_once 'nav.php'; // padding: 34.7%;
    ?>
    <div class="main-panel">
      <?php include_once 'na.php'; ?>
       <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-8">
              <div class="card unclass">
                <div class="cssload-thecube">
                  <div class="cssload-cube cssload-c1"></div>
                  <div class="cssload-cube cssload-c2"></div>
                  <div class="cssload-cube cssload-c4"></div>
                  <div class="cssload-cube cssload-c3"></div>
                </div>
                <div class="carder">
                  <div class="card-header card-header-warning">
                    <h4 class="card-title">Terms and Conditions</h4>
                    <p class="card-category"></p>
                  </div>
                  <div class="card-body" style="padding-top: 30px;padding-left: 30px;padding-right: 30px;">
                    <form method="post"  enctype="multipart/form-data">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label>Terms and Conditions</label>
                            <div class="form-group">
                            <!--<label class="bmd-label-floating">.</label> -->
                            <textarea class="form-control" name="term" rows="5"></textarea>
                            </div>
                          </div>
                        </div>
                      </div>
                      <a href="editterm" class="btn btn-info pull-right add_pro">Edit</a>
                      <button type="submit" name="add_country" class="btn btn-warning pull-right add_pro">Add</button>
                      <div class="clearfix"></div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <!-- <div class="col-md-4">
              <div class="card ">
                <div class="card-body">
                  <h6 class="card-category text-gray text-center">Recently Added Projects</h6>
                  <hr />
                  <?php
                  $con = $c->query("SELECT * FROM tableoperatingcountrylist ORDER BY id DESC ");
                  if($con->num_rows > 0) {
                    echo '
                      <table class="table">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Country</th>
                                <th>Code</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                    ';
                        $counter = 0;
                        while ($exe = $con->fetch_array()) {
                          $counter++;
                          ?>
                          <tr>
                            <td class="text-center"><?php echo $counter?></td>
                            <td><?php echo $exe['country'] ?></td>
                            <td><?php echo $exe['short'] ?></td>
                            <td><?php echo $exe['status'] ? "ON" : "OFF"; ?></td>
                            <td class="td-actions text-right">
                                <a href="editcountry?q=<?php echo $exe['country_id'] ?>" class="btn btn-success">
                                    <i class="material-icons">edit</i>
                                </a>
                                <a href="category?q=<?php echo $exe['country_id'] ?>" class="btn btn-danger">
                                    <i class="material-icons">close</i>
                                </a>
                            </td>
                        </tr>
                          <?php
                        }
                    echo '
                      </tbody>
                    </table>';
                  }
                  else {
                      echo '<h6 class="card-category text-muted text-center pt-5 pb-5"><i class="material-icons" style="top: 4px;padding-right: 4px;font-size: 19px;">warning</i> No Result</h6>';
                  }
                  ?>
                </div>
              </div>
            </div> -->
          </div>
        </div>
      </div>

    </div>
<?php include 'includes/script.php' ?>


<script>
  $(document).ready(function() {
    $(".cssload-thecube").hide();
    $(".add_pro").click(function () {
      $(".carder").hide();
      $(".unclass").css("padding","34.4%");
      $(".cssload-thecube").css("display","block");
    });
  });
</script>
</body>

</html>