<?php
include('config/app.php');
ob_start();


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> <?= $tittle; ?> </title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="assets-template/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="assets-template/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="assets-template/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- my css -->
    <link href="assets/css/my.css" rel="stylesheet">
    <!-- Theme style -->
    <link rel="stylesheet" href="assets-template/dist/css/adminlte.min.css">
    <!-- apex-chart -->
    <link rel="stylesheet" href="assets-template/plugins/apex-chart/apexcharts.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="assets-template/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">

    <link rel="icon" href="assets/img/logo.jpg">

    
    <!-- DataTables -->
    <link rel="stylesheet" href="assets-template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="assets-template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="assets-template/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <!-- <script type="text/javascript" src="frontend-script.js"></script> -->
    <!-- <script src="assets-template/plugins/jquery/jquery.min.js"></script> -->

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
          

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">

                    <div class="info">
                        <a href="dashboard.php" class="d-block"> Welcome <?= $_SESSION['username']; ?> ! </a>
                    </div>
                </div>



                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">


                        <li class="nav-item">
                            <a href="pengguna.php" class="nav-link">
                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                    Pengguna
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="lapangan.php" class="nav-link">
                                <i class="nav-icon fas fa-flag"></i>
                                <p>
                                    Lapangan
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="pesanan-ditolak.php" class="nav-link">
                                <i class="nav-icon fas fa-solid fa-ban"></i>
                                <p>
                                    Pesanan Ditolak
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="pesanan-diproses.php" class="nav-link">
                                <i><img src="assets/img/icon-waiting.svg" style="height: 25px; width: 25px; margin-right:5px"></i>
                                <p>
                                    Pesanan Diproses
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="pesanan-selesai.php" class="nav-link">
                                <i><img src="assets/img/icon-acc.svg" style="height: 25px; width: 25px;  margin-right:5px"></i>
                                <p>
                                    Pesanan Selesai
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="logout-admin.php" onclick="return confirm('Yakin Ingin Keluar ?');" class="nav-link">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <p>
                                    Logout
                                </p>
                            </a>
                        </li>

                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>