<?php
include 'config/app.php';
session_start();

// membatasi halaman sebelum login
if (isset($_SESSION['username'])) {
    // menerima id barang yang dipilih pengguna
    $id = (int)$_GET['id'];

    if (deleteLapangan($id) > 0) {
        echo "<script>
                alert('Data Lapangan Berhasil Dihapus !');
                document.location.href = 'lapangan.php';
             </script>";
    } else {
        echo "<script>
                alert('Data Lapangan Gagal Dihapus !');
                document.location.href = 'lapangan.php';
             </script>";
    }
} else {
    header("Location: login-admin.php");
    exit();
}
