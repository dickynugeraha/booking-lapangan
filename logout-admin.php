<?php 
session_start();
$_SESSION['username'] == "";
unset($_SESSION['username']);

header('location:login-admin.php');