<?php
$url = $_SERVER['PHP_SELF'];
?>
<div class="sidebar" data-color="orange" data-background-color="white" data-image="assets/img/sidebar-1.jpg">
  <div class="logo"><a href="fgsystem.net" class="simple-text logo-normal">
      Shilengae
    </a></div>
  <div class="sidebar-wrapper">
    <ul class="nav">
      <li class="nav-item <?php $rev = substr($url,7) == 'index.php' ? 'active' : '' ; echo $rev; ?>">
        <a class="nav-link" href="./index.php">
          <i class="material-icons">dashboard</i>
          <p>Dashboard</p>
        </a>
      </li>
      <li class="nav-item <?php $rev = substr($url,7) == 'user' ? 'active' : '' ; echo $rev; ?>">
        <a class="nav-link" href="./user">
          <i class="material-icons">person</i>
          <p>User</p>
        </a>
      </li>
      <li class="nav-item <?php $rev = substr($url,7) == 'country' ? 'active' : '' ; echo $rev; ?>">
        <a class="nav-link" href="./country">
          <i class="material-icons">flag</i>
          <p>Countries</p>
        </a>
      </li>
      <li class="nav-item <?php $rev = substr($url,7) == 'termandcondition' ? 'active' : '' ; echo $rev; ?>">
        <a class="nav-link" href="./termandcondition">
          <i class="material-icons">photo_size_select_actual</i>
          <p>Terms And Condition</p>
        </a>
      </li>
      <li class="nav-item <?php $rev = substr($url,7) == 'change.php' ? 'active' : '' ; echo $rev; ?>">
        <a class="nav-link" href="./change.php">
          <i class="material-icons">vpn_key</i>
          <p>Change Password</p>
        </a>
      </li>
     
      <li class="nav-item <?php $rev = substr($url,7) == 'logout.php?logout' ? 'active' : '' ; echo $rev; ?>">
        <a class="nav-link" href="./logout.php?logout">
          <i class="material-icons">power_settings_new</i>
          <p>Logout</p>
        </a>
      </li>
    </ul>
  </div>
</div>