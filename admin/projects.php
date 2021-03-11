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
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>Elnes Admin Panel</title>
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
<style>
  .cssload-thecube {
  display: none;
  width: 73px;
  height: 73px;
  margin: 0 auto;
  margin-top: 49px;
  position: relative;
  transform: rotateZ(45deg);
    -o-transform: rotateZ(45deg);
    -ms-transform: rotateZ(45deg);
    -webkit-transform: rotateZ(45deg);
    -moz-transform: rotateZ(45deg);
  }
  .cssload-thecube .cssload-cube {
    position: relative;
    transform: rotateZ(45deg);
      -o-transform: rotateZ(45deg);
      -ms-transform: rotateZ(45deg);
      -webkit-transform: rotateZ(45deg);
      -moz-transform: rotateZ(45deg);
  }
  .cssload-thecube .cssload-cube {
    float: left;
    width: 50%;
    height: 50%;
    position: relative;
    transform: scale(1.1);
      -o-transform: scale(1.1);
      -ms-transform: scale(1.1);
      -webkit-transform: scale(1.1);
      -moz-transform: scale(1.1);
  }
  .cssload-thecube .cssload-cube:before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgb(250,164,67);
    animation: cssload-fold-thecube 2.76s infinite linear both;
      -o-animation: cssload-fold-thecube 2.76s infinite linear both;
      -ms-animation: cssload-fold-thecube 2.76s infinite linear both;
      -webkit-animation: cssload-fold-thecube 2.76s infinite linear both;
      -moz-animation: cssload-fold-thecube 2.76s infinite linear both;
    transform-origin: 100% 100%;
      -o-transform-origin: 100% 100%;
      -ms-transform-origin: 100% 100%;
      -webkit-transform-origin: 100% 100%;
      -moz-transform-origin: 100% 100%;
  }
  .cssload-thecube .cssload-c2 {
    transform: scale(1.1) rotateZ(90deg);
      -o-transform: scale(1.1) rotateZ(90deg);
      -ms-transform: scale(1.1) rotateZ(90deg);
      -webkit-transform: scale(1.1) rotateZ(90deg);
      -moz-transform: scale(1.1) rotateZ(90deg);
  }
  .cssload-thecube .cssload-c3 {
    transform: scale(1.1) rotateZ(180deg);
      -o-transform: scale(1.1) rotateZ(180deg);
      -ms-transform: scale(1.1) rotateZ(180deg);
      -webkit-transform: scale(1.1) rotateZ(180deg);
      -moz-transform: scale(1.1) rotateZ(180deg);
  }
  .cssload-thecube .cssload-c4 {
    transform: scale(1.1) rotateZ(270deg);
      -o-transform: scale(1.1) rotateZ(270deg);
      -ms-transform: scale(1.1) rotateZ(270deg);
      -webkit-transform: scale(1.1) rotateZ(270deg);
      -moz-transform: scale(1.1) rotateZ(270deg);
  }
  .cssload-thecube .cssload-c2:before {
    animation-delay: 0.35s;
      -o-animation-delay: 0.35s;
      -ms-animation-delay: 0.35s;
      -webkit-animation-delay: 0.35s;
      -moz-animation-delay: 0.35s;
  }
  .cssload-thecube .cssload-c3:before {
    animation-delay: 0.69s;
      -o-animation-delay: 0.69s;
      -ms-animation-delay: 0.69s;
      -webkit-animation-delay: 0.69s;
      -moz-animation-delay: 0.69s;
  }
  .cssload-thecube .cssload-c4:before {
    animation-delay: 1.04s;
      -o-animation-delay: 1.04s;
      -ms-animation-delay: 1.04s;
      -webkit-animation-delay: 1.04s;
      -moz-animation-delay: 1.04s;
  }



  @keyframes cssload-fold-thecube {
    0%, 10% {
      transform: perspective(136px) rotateX(-180deg);
      opacity: 0;
    }
    25%,
          75% {
      transform: perspective(136px) rotateX(0deg);
      opacity: 1;
    }
    90%,
          100% {
      transform: perspective(136px) rotateY(180deg);
      opacity: 0;
    }
  }

  @-o-keyframes cssload-fold-thecube {
    0%, 10% {
      -o-transform: perspective(136px) rotateX(-180deg);
      opacity: 0;
    }
    25%,
          75% {
      -o-transform: perspective(136px) rotateX(0deg);
      opacity: 1;
    }
    90%,
          100% {
      -o-transform: perspective(136px) rotateY(180deg);
      opacity: 0;
    }
  }

  @-ms-keyframes cssload-fold-thecube {
    0%, 10% {
      -ms-transform: perspective(136px) rotateX(-180deg);
      opacity: 0;
    }
    25%,
          75% {
      -ms-transform: perspective(136px) rotateX(0deg);
      opacity: 1;
    }
    90%,
          100% {
      -ms-transform: perspective(136px) rotateY(180deg);
      opacity: 0;
    }
  }

  @-webkit-keyframes cssload-fold-thecube {
    0%, 10% {
      -webkit-transform: perspective(136px) rotateX(-180deg);
      opacity: 0;
    }
    25%,
          75% {
      -webkit-transform: perspective(136px) rotateX(0deg);
      opacity: 1;
    }
    90%,
          100% {
      -webkit-transform: perspective(136px) rotateY(180deg);
      opacity: 0;
    }
  }

  @-moz-keyframes cssload-fold-thecube {
    0%, 10% {
      -moz-transform: perspective(136px) rotateX(-180deg);
      opacity: 0;
    }
    25%,
          75% {
      -moz-transform: perspective(136px) rotateX(0deg);
      opacity: 1;
    }
    90%,
          100% {
      -moz-transform: perspective(136px) rotateY(180deg);
      opacity: 0;
    }
  }
</style>
                    <?php
                      // if(isset($_POST['delete']))
                      if(isset($_POST['add_pro']) && !empty($_FILES["file"]["name"])) {
                        $statusMsg = "";
                        $backlink = ' <a href="./">Go back</a>';
                        // File upload path
                        $targetDir = "../assets/projects/";
                        $fileName = uniqid() . basename($_FILES["file"]["name"]);
                        $targetFilePath = $targetDir . $fileName;
                        $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
                        $pid = uniqid();
                        $name = mysqli_real_escape_string($c,$_POST['name']);
                        $location = mysqli_real_escape_string($c,$_POST['location']);
                        $theme = mysqli_real_escape_string($c,$_POST['theme']);
                        $scope = mysqli_real_escape_string($c,$_POST['scope']);
                        $description = mysqli_real_escape_string($c,$_POST['description']);
                        $cat = mysqli_real_escape_string($c,$_POST['cat']);

                        $image_info = getimagesize($_FILES["file"]["tmp_name"]);
                        $image_width = $image_info[0];
                        $image_height = $image_info[1];

                        $allowTypes = array('jpg','png','jpeg');
                        if ($image_width == 451 && $image_height == 240){
                          if (!file_exists($targetFilePath)) {
                            if(in_array($fileType, $allowTypes)) {
                                  // Upload file to server
                              if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
                                  // Insert image file name into database
                                $timer = time();
                                $insert = $c->query("INSERT INTO project (pid,name,category,location,theme,scope,description,image,timer) VALUES ('$pid','$name','$cat','$location','$theme','$scope','$description','$fileName','$timer')");
                                if($insert) {
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
                                        title: '".ucwords($name)." have been added to projects successfully.'
                                      })
                                    </script>";
                                }
                                else{
                                     $statusMsg = "File upload failed, please try again.";
                                }
                              }
                              else{
                                   $statusMsg = "Sorry, there was an error uploading your file.";
                              }
                            }
                            else{
                                 $statusMsg = "Sorry, only JPG, JPEG & PNG files are allowed to upload.";
                            }
                          }
                          else {
                               $statusMsg = "This error must not been seen. Contact the Developers.";
                          }
                        }
                        else {
                           $statusMsg = "Image width & height not correct image size must be 451x240.";
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
                      else if (isset($_GET['q'])) {
                        $id = $_GET['q'];
                        $chj = $c->query("SELECT * FROM project WHERE pid = '$id'");
                        if ($chj->num_rows != 0) {
                          if($c->query("DELETE FROM project WHERE pid = '$id'")){
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
                      else{
                        $statusMsg = 'Please select a file to upload.';
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
                    <h4 class="card-title">Add Project</h4>
                    <p class="card-category">Be sure before adding the project</p>
                  </div>
                  <div class="card-body" style="overflow-x: hidden;">
                    <form method="post"  enctype="multipart/form-data">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="bmd-label-floating">Project Name</label>
                            <input type="text" name="name" class="form-control">
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
                                echo '<option value="'.$er['name'].'">'.ucwords($er['name']).'</option>';
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
                            <input type="text" name="location" class="form-control">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="bmd-label-floating">Theme</label>
                            <input type="text" name="theme" class="form-control">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label class="bmd-label-floating">Scope</label>
                            <input type="text" name="scope" class="form-control">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label>Description</label>
                            <div class="form-group">
                            <!--<label class="bmd-label-floating">.</label> -->
                            <textarea class="form-control" name="description" rows="5"></textarea>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-12">
                        <div class="fileinput fileinput-new text-center" data-provides="fileinput" style="max-width: 100% !important;">
                          <div class="fileinput-new thumbnail ">
                          <img src="../assets/sample/451x240.png" rel="nofollow" alt="..." style="width: 100%;height: 100%;">
                        </div>
                        <div class="fileinput-preview fileinput-exists thumbnail" style="width: 100%;height: 100%;min-width: 745px;max-height: 500px;background: #eeeeee;"></div>
                        <div class="row">
                          <div class="col-md-6">
                          <span class="btn btn-block btn-outline-warning btn-file">
                             <span class="fileinput-new">Select image</span>
                             <span class="fileinput-exists">Change</span>
                             <input type="file" name="file" />
                          </span>
                        </div>
                          <div class="col-md-6">
                            <a href="javascript:;" class="btn btn-block btn-outline-warning fileinput-exists" data-dismiss="fileinput">
                          <i class="fa fa-times"></i> Remove</a>
                        </div>
                        </div>
                        </div>
                        </div>
                      </div>

                      <button type="submit" name="add_pro" class="btn btn-warning pull-right add_pro">Add Project</button>
                      <div class="clearfix"></div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card ">
                <div class="card-body">
                  <h6 class="card-category text-gray text-center">Recently Added Projects</h6>
                  <hr />
                  <?php
                  $pro = $c->query("SELECT * FROM project ORDER BY id DESC LIMIT 2");
                  if($pro->num_rows > 0) {
                    while ($eex = $pro->fetch_array()) {
                      echo '<div class="deg">
                              <div class="projer">
                              <a href="edit.php?q='.$eex['pid'].'" class="untext btn btn-outline-warning text-white"><i class="material-icons">edit</i> Edit</a><br>
                              <a href="projects.php?q='.$eex['pid'].'" class="untext btn btn-outline-danger text-white"><i class="material-icons">delete</i> Delete</a>
                              </div>
                              <h4 class="card-title">'.$eex['name'].'</h4>
                              <p class="card-text">
                                '.$eex['description'].'
                              </p>
                              <img class="card-img-top" src="../assets/projects/'.$eex['image'].'" rel="nofollow" alt="Card image cap">
                              <p class="card-text text-right"><small class="text-muted">Published '.ago('@'.$eex['timer']).'</small></p></div>
                            <hr>';
                    }
                    echo '<a href="all_projects.php" class="btn btn-block btn-info"><i class="material-icons">apps</i> See All</a>';
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
    font-size: 20px;
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