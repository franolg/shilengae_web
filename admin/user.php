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
                  ?>
                  <div class="p-4">
                    <div class="row mt-5 mb-3 align-items-center">
<!--                       <div class="col-md-1"></div>
 -->                      <div class="col-md-8">
                        <input type="text" class="form-control" placeholder="Search in table..." id="searchField">
                      </div>
                      <div class="col-md-2 text-right">
                        <span class="pr-3">Rows Per Page:</span>
                      </div>
                      <div class="col-md-2">
                          <div class="d-flex justify-content-end">
                              <select class="custom-select" name="rowsPerPage" id="changeRows">
                                  <option value="1">1</option>
                                  <option value="5" selected>5</option>
                                  <option value="10">10</option>
                                  <option value="15">15</option>
                              </select>
                          </div>
                      </div>
                  </div>
                  <div id="table-sortable" class=""></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://table-sortable.now.sh/table-sortable.js"></script>
<script>
  var columns = {
    'id' : 'Id',
    'fn': 'First Name',
    'ln': 'Last Name',
    'email': 'Email',
    'calling_code': 'Calling Code',
    'mobile':'Mobile',
    'country': 'Country',
    'action': 'Actions'
}

  var table = $('#table-sortable').tableSortable({
            data: <?php echo $userview->UsersTablejs();?>,
            columns: columns,
            searchField: '#searchField',
            responsive: {
                1100: {
                    columns: {
                        'id': 'Id',
                        'name': 'Name',
                    },
                },
            },
            sorting: ['id', 'name'],
            rowsPerPage: 5,
            pagination: true,
            tableWillMount: function() {
                console.log('table will mount')
            },
            tableDidMount: function() {
                console.log('table did mount')
            },
            tableWillUpdate: function() {console.log('table will update')},
            tableDidUpdate: function() {console.log('table did update')},
            tableWillUnmount: function() {console.log('table will unmount')},
            tableDidUnmount: function() {console.log('table did unmount')},
            onPaginationChange: function(nextPage, setPage) {
                setPage(nextPage);
            }
        });

        $('#changeRows').on('change', function() {
            table.updateRowsPerPage(parseInt($(this).val(), 10));
        })

</script>
</body>
</html>