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


  <link href="assets/demo/demo.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@9.10.12/dist/sweetalert2.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.10.12/dist/sweetalert2.all.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.10.12/dist/sweetalert2.min.js"></script>
</head>

<body>
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
                  <h4 class="card-title">Change Password</h4>
                  <p class="card-category">Be sure on changing the password</p>
                </div>
                <?php
                $inbox = $c->query("SELECT * FROM message ORDER BY id DESC");
                if($inbox->num_rows == 0){
                  ?>
                  <center>
                    <img class="img-fluid" src="../assets/no-result.jpg" />
                  </center>
                  <?php
                  }else {echo '<ul class="messages-list">';
                    while ($txt = $inbox->fetch_array()) {
                      $status = ($txt['status'] == 'seen') ? a : 'unread';
                ?>
                  <li class="<?php echo $status; ?>">
                      <div class="header">
                        <span class="from"><?php echo $txt['name']; ?></span>
                        <span class="date"><span class="fa fa-paper-clip"></span> <?php echo ago('@'.$txt['timer']); ?></span>
                      </div>
                      <div class="title">
                        <?php echo $txt['subject']." &lt;".$txt['email']."&gt;"; ?>
                      </div>  
                      <div class="description">
                        <?php echo $txt['msg']; ?>
                      </div>    
                  </li>

                <?php
                } echo '</ul>';}
                $c->query("UPDATE message SET status='seen'");
                ?>
               <!--  <div class="card-body">
                    <div class="card p-3">
                      <blockquote class="blockquote mb-0 card-body">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                        <footer class="blockquote-footer">
                          <small class="text-muted">
                            From <cite title="Source Title">mikiyaslemlemu@gmail.com</cite>
                          </small><cite style="font-size: 80%">13 min ago</cite>
                        </footer>
                      </blockquote>
                    </div>
                </div> -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<style>
  .messages-list > li{
  border-bottom: 1px solid #eee;
  }
  .inbox-menu ul {
    margin-top: 30px;
    padding: 0;
    list-style: none
}

.inbox-menu ul li {
    height: 30px;
    padding: 5px 15px;
    position: relative
}

.inbox-menu ul li:hover,
.inbox-menu ul li.active {
    background: #e4e5e6
}

.inbox-menu ul li.title {
    margin: 20px 0 -5px 0;
    text-transform: uppercase;
    font-size: 10px;
    color: #d1d4d7
}

.inbox-menu ul li.title:hover {
    background: 0 0
}

.inbox-menu ul li a {
    display: block;
    width: 100%;
    text-decoration: none;
    color: #3d3f42
}

.inbox-menu ul li a i {
    margin-right: 10px
}

.inbox-menu ul li a .label {
    position: absolute;
    top: 10px;
    right: 15px;
    display: block;
    min-width: 14px;
    height: 14px;
    padding: 2px
}

ul.messages-list {
    list-style: none;
    margin: 15px -15px 0 -15px;
    padding: 15px 15px 0 15px;
    border-bottom: 1px solid #d1d4d7;
}

ul.messages-list li {
    -webkit-border-radius: 2px;
    -moz-border-radius: 2px;
    border-radius: 2px;
    cursor: pointer;
    margin-bottom: 10px;
    padding: 33px;
    transition: all 0.4s ease;
}

ul.messages-list li a {
    color: #3d3f42
}

ul.messages-list li a:hover {
    text-decoration: none
}

ul.messages-list li.unread .header,
ul.messages-list li.unread .title {
    font-weight: 700
}

ul.messages-list li:hover {
    background: #e4e5e6;
/*    border: 1px solid #d1d4d7;
*/    padding: 30px;
    transition: all 0.4s ease;

}

ul.messages-list li:hover .action {
    color: #d1d4d7
}

ul.messages-list li .header {
    margin: 0 0 5px 0
}

ul.messages-list li .header .from {
    width: 49.9%;
    white-space: nowrap;
    overflow: hidden!important;
    text-overflow: ellipsis
}

ul.messages-list li .header .date {
    width: 50%;
    text-align: right;
    float: right
}

ul.messages-list li .title {
    margin: 0 0 5px 0;
    white-space: nowrap;
    overflow: hidden!important;
    text-overflow: ellipsis
}

ul.messages-list li .description {
    font-size: 12px;
/*    padding-left: 29px
*/}

ul.messages-list li .action {
    display: inline-block;
    width: 16px;
    text-align: center;
    margin-right: 10px;
    color: #d1d4d7
}

ul.messages-list li .action .fa-check-square-o {
    margin: 0 -1px 0 1px
}

ul.messages-list li .action .fa-square {
    float: left;
    margin-top: -16px;
    margin-left: 4px;
    font-size: 11px;
    color: #fff
}

ul.messages-list li .action .fa-star.bg {
    float: left;
    margin-top: -16px;
    margin-left: 3px;
    font-size: 12px;
    color: #fff
}

.message .message-title {
    margin-top: 30px;
    padding-top: 10px;
    font-weight: 700;
    font-size: 14px
}

.message .header {
    margin: 20px 0 30px 0;
    padding: 10px 0 10px 0;
    border-top: 1px solid #d1d4d7;
    border-bottom: 1px solid #d1d4d7
}

.message .header .avatar {
    -webkit-border-radius: 2px;
    -moz-border-radius: 2px;
    border-radius: 2px;
    height: 34px;
    width: 34px;
    float: left;
    margin-right: 10px
}

.message .header i {
    margin-top: 1px
}

.message .header .from {
    display: inline-block;
    width: 50%;
    font-size: 12px;
    margin-top: -2px;
    color: #d1d4d7
}

.message .header .from span {
    display: block;
    font-size: 14px;
    font-weight: 700;
    color: #3d3f42
}

.message .header .date {
    display: inline-block;
    width: 29%;
    text-align: right;
    float: right;
    font-size: 12px;
    margin-top: 18px
}

.message .attachments {
    border-top: 3px solid #e4e5e6;
    border-bottom: 3px solid #e4e5e6;
    padding: 10px 0;
    margin-bottom: 20px;
    font-size: 12px
}

.message .attachments ul {
    list-style: none;
    margin: 0 0 0 -40px
}

.message .attachments ul li {
    margin: 10px 0
}

.message .attachments ul li .label {
    padding: 2px 4px
}

.message .attachments ul li span.quickMenu {
    float: right;
    text-align: right
}

.message .attachments ul li span.quickMenu .fa {
    padding: 5px 0 5px 25px;
    font-size: 14px;
    margin: -2px 0 0 5px;
    color: #d1d4d7
}

.contacts ul {
    margin-top: 30px;
    padding: 0;
    list-style: none
}

.contacts ul li {
    height: 30px;
    padding: 5px 15px;
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis!important;
    position: relative;
    cursor: pointer
}

.contacts ul li .label {
    display: inline-block;
    width: 6px;
    height: 6px;
    padding: 0;
    margin: 0 5px 2px 0
}

.contacts ul li:hover {
    background: #e4e5e6
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
    $(document).ready(function(){
    
  if($('.messages-list').length) {
    
    /* ---------- Check / Uncheck Checkbox ---------- */
    $('.messages-list').on('click', '.fa-square-o', function(event){
      event.preventDefault();
      
      $(this).removeClass('fa-square-o').addClass('fa-check-square-o');
      
    });
    
    $('.messages-list').on('click', '.fa-check-square-o', function(event){
      event.preventDefault();
      
      $(this).removeClass('fa-check-square-o').addClass('fa-square-o');
      
    });
    
    /* ---------- Check / Uncheck Stars ---------- */
    $('.messages-list').on('click', '.fa-star-o', function(event){
      event.preventDefault();
      
      $(this).removeClass('fa-star-o').addClass('fa-star');
      
    });
    
    $('.messages-list').on('click', '.fa-star', function(event){
      event.preventDefault();
      
      $(this).removeClass('fa-star').addClass('fa-star-o');
      
    }); 
    
    /* ---------- White icons in active li---------- */
    $('.action').find('i.fa-square-o').replaceWith('<i class="fa fa-square-o"></i><i class="fa fa-square"></i>');
    $('.action').find('i.fa-star-o').replaceWith('<i class="fa fa-star-o"></i><i class="fa fa-star bg"></i>');
      
  }
  
  /* ---------- Placeholder Fix for IE ---------- */
  $('input, textarea').placeholder();

  /* ---------- Auto Height texarea ---------- */
  $('textarea').autosize();   
  
}); 
  </script>
</body>

</html>
<!-- 
<div class="card-body">
              <div id="typography">
                <div class="card-title">
                  <h2>Typography</h2>
                </div>
                <div class="row">
                  <div class="tim-typo">
                    <h1>
                      <span class="tim-note">Header 1</span>The Life of Material Dashboard </h1>
                  </div>
                  <div class="tim-typo">
                    <h2>
                      <span class="tim-note">Header 2</span>The Life of Material Dashboard</h2>
                  </div>
                  <div class="tim-typo">
                    <h3>
                      <span class="tim-note">Header 3</span>The Life of Material Dashboard</h3>
                  </div>
                  <div class="tim-typo">
                    <h4>
                      <span class="tim-note">Header 4</span>The Life of Material Dashboard</h4>
                  </div>
                  <div class="tim-typo">
                    <h5>
                      <span class="tim-note">Header 5</span>The Life of Material Dashboard</h5>
                  </div>
                  <div class="tim-typo">
                    <h6>
                      <span class="tim-note">Header 6</span>The Life of Material Dashboard</h6>
                  </div>
                  <div class="tim-typo">
                    <p>
                      <span class="tim-note">Paragraph</span>
                      I will be the leader of a company that ends up being worth billions of dollars, because I got the answers. I understand culture. I am the nucleus. I think that’s a responsibility that I have, to push possibilities, to show people, this is the level that things could be at.</p>
                  </div>
                  <div class="tim-typo">
                    <span class="tim-note">Quote</span>
                    <blockquote class="blockquote">
                      <p>
                        I will be the leader of a company that ends up being worth billions of dollars, because I got the answers. I understand culture. I am the nucleus. I think that’s a responsibility that I have, to push possibilities, to show people, this is the level that things could be at.
                      </p>
                      <small>
                        Kanye West, Musician
                      </small>
                    </blockquote>
                  </div>
                  <div class="tim-typo">
                    <span class="tim-note">Muted Text</span>
                    <p class="text-muted">
                      I will be the leader of a company that ends up being worth billions of dollars, because I got the answers...
                    </p>
                  </div>
                  <div class="tim-typo">
                    <span class="tim-note">Primary Text</span>
                    <p class="text-primary">
                      I will be the leader of a company that ends up being worth billions of dollars, because I got the answers... </p>
                  </div>
                  <div class="tim-typo">
                    <span class="tim-note">Info Text</span>
                    <p class="text-info">
                      I will be the leader of a company that ends up being worth billions of dollars, because I got the answers... </p>
                  </div>
                  <div class="tim-typo">
                    <span class="tim-note">Success Text</span>
                    <p class="text-success">
                      I will be the leader of a company that ends up being worth billions of dollars, because I got the answers... </p>
                  </div>
                  <div class="tim-typo">
                    <span class="tim-note">Warning Text</span>
                    <p class="text-warning">
                      I will be the leader of a company that ends up being worth billions of dollars, because I got the answers...
                    </p>
                  </div>
                  <div class="tim-typo">
                    <span class="tim-note">Danger Text</span>
                    <p class="text-danger">
                      I will be the leader of a company that ends up being worth billions of dollars, because I got the answers... </p>
                  </div>
                  <div class="tim-typo">
                    <h2>
                      <span class="tim-note">Small Tag</span>
                      Header with small subtitle
                      <br>
                      <small>Use "small" tag for the headers</small>
                    </h2>
                  </div>
                </div>
              </div>
            </div> -->