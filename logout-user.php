<?php 
session_start();
$_SESSION['phone'] == "";
unset($_SESSION['phone']);


header('location:index.php');