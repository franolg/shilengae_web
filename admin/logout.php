<?php
session_start();
ob_start(); 

include '../private/connect.php'; // including every class from the root/private/connect.php.
?>
<?php
if(!isset($_SESSION['add'])) {
	header("Location: index.php");
}
if(isset($_SESSION['add']) == "") {
	header("Location: index.php");
}
if(isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['add']);
	header("Location: index.php");
}
?>