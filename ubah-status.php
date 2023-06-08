<?php
include 'config/app.php';
session_start();

// membatasi halaman sebelum login
if (isset($_SESSION['username'])) {
    // menerima id barang yang dipilih pengguna

    if(updateStatusBooking($_POST) > 1){
      echo "<script>
      alert('Status booking berhasil di update!');
      document.location.href = 'pesanan-diproses.php';
      </script>";
      exit();
      return;
  } else {
      echo "<script>
      alert('Status booking gagal di update!');
      document.location.href = 'pesanan-diproses.php';
      </script>";
      exit();
      return;
  }

} else {
    header("Location: login-admin.php");
    exit();
}
