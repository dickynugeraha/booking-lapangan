<?php
session_start();
$tittle = 'Edit Lapangan Keluar';
include 'layout/header-admin.php';

// membatasi halaman sebelum login
if (isset($_SESSION['username'])) {

    $id = (int)$_GET['id'];

    $field = select("SELECT * FROM fields WHERE id = $id")[0];

    // cek apakah tombol tambah ditekan
    if (isset($_POST['ubah-lapangan'])) {
        if (updateLapangan($_POST) > 0) {
            echo "<script>
                alert('Data Lapangan Berhasil Diperbaharui !');
                document.location.href = 'lapangan.php';
             </script>";
        } else {
            echo "<script>
                alert('Data Lapangan Gagal Diperbaharui !');
                document.location.href = 'lapangan.php';
             </script>";
        }
    }


?>

   
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                    </div><!-- /.col -->

                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
         

                <form action="" method="post" enctype="multipart/form-data" style="width: 95%; margin-left: 40px; min-height:900px">
                <h2 class="text-center">Ubah Data Lapangan</h2>
                     <input type="hidden" name="id" value="<?= $field['id']; ?>">
                    <input type="hidden" name="gambarLama" value="<?= $field['photo']; ?>">


                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Lapangan</label>
                        <input value="<?= $field['name']; ?>" type="text" class="form-control" id="nama" name="nama" placeholder="Nama Lapangan ..." required>
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select id="status" name="status"  class="form-control">
                           <option value="">--pilih---</option>
                           <option <?= $field['status'] == "1" ? "selected" : ""; ?> value="1">Aktif</option>
                           <option <?= $field['status'] == "0" ? "selected" : ""; ?> value="0">Dalam Perawatan</option>
                        </select>
                   </div>

                    <div class="mb-3">
                        <label for="tipe" class="form-label">Tipe Lapangan</label>
                        <select id="tipe" name="tipe" class="form-control">
                           <option value="">--pilih---</option>
                           <option <?= $field['type'] === "Futsal" ? "selected" : ""; ?> value="Futsal">Futsal</option>
                           <option <?= $field['type'] === "Badminton" ? "selected" : ""; ?>  value="Badminton">Badminton</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="fasilitas" class="form-label">Fasilitas</label>
                        <textarea type="text"  rows="5" class="form-control" id="fasilitas" name="fasilitas" placeholder="Fasilitas ..." required> <?= $field['facility']; ?></textarea>
                    </div>


                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga per jam</label>
                        <input value="<?= $field['price']; ?>" type="number" class="form-control" id="harga" name="harga" placeholder="Harga Perjam..." required>
                    </div>

                    <div class="mb-3">
                        <label for="gambar" class="form-label">Gambar Lapangan</label><br>
                        <input type="file" id="gambar" name="gambar" onchange="previewImg()"><br>

                        <img src="assets/img/lapangan/<?= $field['photo']; ?>" alt="" class="img-thumbnail img-preview mt-2" width="200px">
                    </div>

                    <a href="lapangan.php" class="btn btn-danger" style="float: right;">Cancel</a>
                    <button type="submit" name="ubah-lapangan" class="btn btn-warning mb-3" style="float: right; margin-right: 10px;">Ubah</button>
                </form>

            </div>
        </section>
        <!-- /.content -->
    </div>


    <script>
        // preview image
    
        function previewImg() {
            const gambar = document.querySelector('#gambar');
            const imgPreview = document.querySelector('.img-preview');

            const fileGambar = new FileReader();
            fileGambar.readAsDataURL(gambar.files[0]);

            fileGambar.onload = function(e) {
                imgPreview.src = e.target.result;
            }
        }

    </script>


<?php

} else {
    header("Location: login-template.php");
    exit();
}

include 'layout/footer-admin.php';

?>