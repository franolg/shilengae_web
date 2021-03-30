<?php

include '../private/connect.php'; // including every class from the root/private/connect.php.

$admin = new AdminView();
if(!isset($_SESSION['add']) || !$admin->check($_SESSION['add'])){
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
  <title>Shilengae Admin Panel</title>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <?php include 'includes/style.php' ?>
</head>
<body>
<?php
$user = new UserController();
$userview = new UserView();
if (isset($_GET['q'])) {
  $id = $_GET['q'];
  if ($userview->CheckUserID($id)) {
    if($user->DeleteUser($id)){
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
              title: 'Deleted successfully.'
            })
          </script>
          <?php
    } else {
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
              title: 'Can\'t deleted this user.'
            })
          </script>
          <?php
    }
  } else {
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
          title: 'Can\'t find user.'
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
                  <h4 class="card-title">Users</h4>
                  <p class="card-category">Currently Actions are disabled</p>
                </div>
                <div class="card-body">
                  <?php
                  if(!$userview->AnyUsers()){
                    ?>
                    <center>
                      <img class="img-fluid" src="./assets/no-result.jpg" />
                    </center>
                    <?php
                    }
                    else {
                      echo '<table class="table">
                              <thead>
                                  <tr>
                                      <th class="text-center">#</th>
                                      <th>Name</th>
                                      <th>Email</th>
                                      <th>Phone Number</th>
                                      <th>Country</th>
                                      <th class="text-right">Actions</th>
                                  </tr>
                              </thead>
                              <tbody>';
                        echo $userview->UsersTable();
                        echo '</tbody></table>';
                  }
                  ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>