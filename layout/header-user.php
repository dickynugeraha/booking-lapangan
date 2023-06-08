<?php
include('config/app.php');
ob_start();


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- <title>GOR</title> -->
    <title> <?= $title; ?> </title>

    <link rel="icon" href="assets/img/logo.jpg">
 
    <!-- load stylesheets -->
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700"
    />
    <link href="assets/css/my.css" rel="stylesheet">

    <!-- Google web font "Open Sans" -->
    <link rel="stylesheet" href="assets-template/landing-page/font-awesome-4.7.0/css/font-awesome.min.css" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="assets-template/landing-page/css/bootstrap.min.css" />
    <!-- Bootstrap style -->
    <link rel="stylesheet" type="text/css" href="assets-template/landing-page/slick/slick.css" />
    <link rel="stylesheet" type="text/css" href="assets-template/landing-page/slick/slick-theme.css" />
    <link rel="stylesheet" type="text/css" href="assets-template/landing-page/css/datepicker.css" />
    <link rel="stylesheet" href="assets-template/landing-page/css/tooplate-style.css" />
    <!-- Templatemo style -->

    <!-- DataTables -->
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.15/js/dataTables.jqueryui.min.js"></script>
   
  </head>

  <body>
    <div class="tm-main-content" id="top">
      <div class="tm-top-bar-bg"></div>
      <div class="tm-top-bar" id="tm-top-bar">
        <!-- Top Navbar -->
        <div class="container" >
          <div class="row">
            <nav class="navbar navbar-expand-lg narbar-dark" >
              <a class="navbar-brand mr-auto" href="lapangan-tersedia.php">
                  <img src="assets/img/logo.jpg" width="50px" height="50px" alt="Site logo" style="border-radius: 50%;" />
                  GOR
              </a>
              <button
                type="button"
                id="nav-toggle"
                class="navbar-toggler collapsed"
                data-toggle="collapse"
                data-target="#mainNav"
                aria-expanded="false"
                aria-label="Toggle navigation"
              >
                <span class="navbar-toggler-icon"></span>
              </button>
              <div id="mainNav" class="collapse navbar-collapse tm-bg-white">
                <ul class="navbar-nav ml-auto">
                  <li class="nav-item">
                    <a class="nav-link" href="lapangan-tersedia.php"
                      >Available fields<span class="sr-only">(current)</span></a
                    >
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="transaksi-riwayat.php">History Transaction</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="logout-user.php" onclick="return confirm('Are you sure want to leave ?');">Logout</a>
                  </li>
                </ul>
              </div>
            </nav>
          </div>
        </div>
      </div>