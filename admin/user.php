<?php

  include '../private/connect.php'; // including every class from the root/private/connect.php.

  $admin = new AdminView();
  if(!isset($_SESSION['add']) || !$admin->check($_SESSION['add'])){
    header("Location: login.php");
    exit();
  }
  $lang = new LocalView($_SESSION['add']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title><?php echo $lang->tr('Shilengae')." ".$lang->tr('Admin Panel'); ?></title>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <?php include 'includes/style.php' ?>
</head>
<body>
<?php
  $user = new UserController();
  $userview = new UserView();
  if (isset($_GET['b'])) {
    $id = $_GET['b'];
    if ($userview->CheckUserID($id)) {
      if($user->BanUser($id)){
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
                title: 'Banned successfully.'
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
                title: 'Can not ban this user.'
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
            title: 'Can not find user.'
          })
        </script>
        <?php
    }
  }
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
                  <h4 class="card-title"><?php echo $lang->tr('user'); ?></h4>
                  <p class="card-category"><?php echo $lang->tr('addingpage'); ?></p>
                </div>
                <div class="card-body">
                  <?php
                  if(!$userview->AnyUsers()){
                    ?>
                    <center>
                      <img class="img-fluid" src="./assets/no-result.jpg" />
                    </center>
                    <?php
                    }else {
                  ?>
                  <div class="p-4">
                    <div class="row mt-5 mb-3 align-items-center">
<!--                       <div class="col-md-1"></div>
 -->                      <div class="col-md-8">
                        <input type="text" class="form-control" placeholder="<?php echo $lang->tr('searchtable'); ?>" id="searchField">
                      </div>
                      <div class="col-md-2 text-right">
                        <span class="pr-3"><?php echo $lang->tr('rowperpage'); ?></span>
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
                <?php } ?>
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
    'id' : '<?php echo urldecode($lang->tr('id')); ?>',
    'fn': '<?php echo urldecode($lang->tr('firstname')); ?>',
    'ln': '<?php echo urldecode($lang->tr('lastname')); ?>',
    'email': '<?php echo urldecode($lang->tr('email')); ?>',
    'calling_code': '<?php echo urldecode($lang->tr('callingcode')); ?>',
    'mobile': '<?php echo urldecode($lang->tr('mobile')); ?>',
    'country': '<?php echo urldecode($lang->tr('country')); ?>',
    'last_online_at' : 'Last online',
    'last_logged_in' : 'Last logged',
    'login_attempt' : 'Login Attempt',
    'time_spent' : 'Time Spent',
    'last_seen_ip' : 'Last seen IP',
    'last_device' : 'Last Device',
    'action': '<?php echo urldecode($lang->tr('action')); ?>'

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