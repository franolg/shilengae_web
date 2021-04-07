<?php
$url = $_SERVER['PHP_SELF'];
$lang = new LocalView($_SESSION['add']);
if (isset($_POST['changelan'])) {
  $lang->changelan();
  header("Location: ".$url);
}
$asa = new AdminView();
if ($asa->RealAdmin($_SESSION['add'])) {
?>
<div class="sidebar" data-color="orange" data-background-color="white" data-image="assets/img/sidebar-1.jpg">
  <div class="logo"><a href="fgsystem.net" class="simple-text logo-normal">
      <?php echo $lang->tr('shilengae'); ?>
    </a></div>
  <div class="sidebar-wrapper">
    <ul class="nav">
      <li class="nav-item <?php $rev = substr($url,7) == 'index.php' ? 'active' : '' ; echo $rev; ?>">
        <a class="nav-link" href="./index.php">
          <i class="material-icons">dashboard</i>
          <p><?php echo $lang->tr('dashboard'); ?></p>
        </a>
      </li>
      <li class="nav-item <?php $rev = substr($url,7) == 'role' ? 'active' : '' ; echo $rev; ?>">
        <a class="nav-link" href="./role">
          <i class="material-icons">manage_accounts</i>
          <p><?php echo $lang->tr('role'); ?></p>
        </a>
      </li>
      <li class="nav-item <?php $rev = substr($url,7) == 'user' ? 'active' : '' ; echo $rev; ?>">
        <a class="nav-link" href="./user">
          <i class="material-icons">person</i>
          <p><?php echo $lang->tr('user'); ?></p>
        </a>
      </li>
      <li class="nav-item <?php $rev = substr($url,7) == 'country' ? 'active' : '' ; echo $rev; ?>">
        <a class="nav-link" href="./country">
          <i class="material-icons">emoji_flags</i>
          <p><?php echo $lang->tr('countries'); ?></p>
        </a>
      </li>
      <li class="nav-item <?php $rev = substr($url,7) == 'city' ? 'active' : '' ; echo $rev; ?>">
        <a class="nav-link" href="./city">
          <i class="material-icons">apartment</i>
          <p><?php echo $lang->tr('city'); ?></p>
        </a>
      </li>
      <li class="nav-item <?php $rev = substr($url,7) == 'region' ? 'active' : '' ; echo $rev; ?>">
        <a class="nav-link" href="./region">
          <i class="material-icons">gite</i>
          <p><?php echo $lang->tr('region'); ?></p>
        </a>
      </li>
      <li class="nav-item <?php $rev = substr($url,7) == 'privacypolicy' ? 'active' : '' ; echo $rev; ?>">
        <a class="nav-link" href="./privacypolicy">
          <i class="material-icons">collections_bookmark</i>
          <p><?php echo $lang->tr('privacypolicy'); ?></p>
        </a>
      </li>
      <li class="nav-item <?php $rev = substr($url,7) == 'termandcondition' ? 'active' : '' ; echo $rev; ?>">
        <a class="nav-link" href="./termandcondition">
          <i class="material-icons">auto_stories</i>
          <p><?php echo $lang->tr('termsandcondition'); ?></p>
        </a>
      </li>
      <li class="nav-item <?php $rev = substr($url,7) == 'change.php' ? 'active' : '' ; echo $rev; ?>">
        <a class="nav-link" href="./change.php">
          <i class="material-icons">vpn_key</i>
          <p><?php echo $lang->tr('changepassword'); ?> </p>
        </a>
      </li>
     
      <li class="nav-item <?php $rev = substr($url,7) == 'logout.php?logout' ? 'active' : '' ; echo $rev; ?>">
        <a class="nav-link" href="./logout.php?logout">
          <i class="material-icons">power_settings_new</i>
          <p><?php echo $lang->tr('logout'); ?></p>
        </a>
      </li>
      <li class="nav-item ml-3 <?php $rev = substr($url,7) == 'changelan.php' ? 'active' : '' ; echo $rev; ?>">
        <form method="post">
          <button class="nav-link btn-block float-left" style="cursor: pointer;background: transparent;border: none;" type="submit" name="changelan">
            <i><?php echo $lang->lang() != 'am' ? '🇪🇹 ' : '🇺🇸 '; ?></i>
            <p class="float-left"><?php echo $lang->lang() != 'am' ? 'Amharic' : 'English'; ?></p>
          </button>
        </form>
      </li> 
    </ul>
  </div>
</div>
<?php
}else {
?>
<div class="sidebar" data-color="orange" data-background-color="white" data-image="assets/img/sidebar-1.jpg">
  <div class="logo"><a href="fgsystem.net" class="simple-text logo-normal">
      <?php echo $lang->tr('shilengae'); ?>
    </a></div>
  <div class="sidebar-wrapper">
    <ul class="nav">
      <li class="nav-item <?php $rev = substr($url,7) == 'index.php' ? 'active' : '' ; echo $rev; ?>">
        <a class="nav-link" href="./index.php">
          <i class="material-icons">dashboard</i>
          <p><?php echo $lang->tr('dashboard'); ?></p>
        </a>
      </li>
      <li class="nav-item <?php $rev = substr($url,7) == 'user' ? 'active' : '' ; echo $rev; ?>">
        <a class="nav-link" href="./user">
          <i class="material-icons">person</i>
          <p><?php echo $lang->tr('user'); ?></p>
        </a>
      </li>
      <li class="nav-item <?php $rev = substr($url,7) == 'country' ? 'active' : '' ; echo $rev; ?>">
        <a class="nav-link" href="./country">
          <i class="material-icons">emoji_flags</i>
          <p><?php echo $lang->tr('countries'); ?></p>
        </a>
      </li>
      <li class="nav-item <?php $rev = substr($url,7) == 'city' ? 'active' : '' ; echo $rev; ?>">
        <a class="nav-link" href="./city">
          <i class="material-icons">apartment</i>
          <p><?php echo $lang->tr('city'); ?></p>
        </a>
      </li>
      <li class="nav-item <?php $rev = substr($url,7) == 'region' ? 'active' : '' ; echo $rev; ?>">
        <a class="nav-link" href="./region">
          <i class="material-icons">gite</i>
          <p><?php echo $lang->tr('region'); ?></p>
        </a>
      </li>
      <li class="nav-item <?php $rev = substr($url,7) == 'change.php' ? 'active' : '' ; echo $rev; ?>">
        <a class="nav-link" href="./change.php">
          <i class="material-icons">vpn_key</i>
          <p><?php echo $lang->tr('changepassword'); ?> </p>
        </a>
      </li>
      <li class="nav-item <?php $rev = substr($url,7) == 'logout.php?logout' ? 'active' : '' ; echo $rev; ?>">
        <a class="nav-link" href="./logout.php?logout">
          <i class="material-icons">power_settings_new</i>
          <p><?php echo $lang->tr('logout'); ?></p>
        </a>
      </li>
      <li class="nav-item ml-3 <?php $rev = substr($url,7) == 'changelan.php' ? 'active' : '' ; echo $rev; ?>">
        <form method="post">
          <button class="nav-link btn-block float-left" style="cursor: pointer;background: transparent;border: none;" type="submit" name="changelan">
            <i><?php echo $lang->lang() != 'am' ? '🇪🇹 ' : '🇺🇸 '; ?></i>
            <p class="float-left"><?php echo $lang->lang() != 'am' ? 'Amharic' : 'English'; ?></p>
          </button>
        </form>
      </li> 
    </ul>
  </div>
</div>
<?php

}
?>