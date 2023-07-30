<?php
session_start();
$tittle = 'Dashboard';
include 'layout/header-admin.php';

// membatasi halaman sebelum login
if (isset($_SESSION['username'])) {

?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Selamat datang admin!</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

  <?php

} else {
  header("Location: login-admin.php");
  exit();
}

include 'layout/footer-admin.php';

  ?>