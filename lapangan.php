<?php
session_start();
$tittle = 'Data Lapangan';
include 'layout/header-admin.php';

// membatasi halaman sebelum login
if (isset($_SESSION['username'])) {

    $fields = select("SELECT * FROM lapangan ORDER BY id DESC");
?>

    <!-- Content Wrapper. Contains page content -->

    <script src="assets-template/plugins/jquery/jquery.min.js"></script>


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
                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Data <b style="color: green;">LAPANGAN</b></h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <a href="tambah-lapangan.php" class="btn btn-primary btn-small mb-2"> <i class="fas fa-plus"></i> Tambah</a>
                                        <table id="dataTable" class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Lapangan</th>
                                                    <th>Status</th>
                                                    <th>Tipe</th>
                                                    <th>Harga per jam</th>
                                                    <th>gambar</th>
                                                    <th>Fasilitas</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody id="">

                                                <?php $no = 1; ?>
                                                <?php foreach ($fields as $field) : ?>
                                                    <tr>
                                                        <td> <?= $no++; ?> </td>
                                                        <td> <?= $field['name']; ?> </td>
                                                        <td><?= $field['status'] == "1" ? "Aktif" : "Dalam perawatan"; ?></td>
                                                        <td><?= $field['type']; ?></td>
                                                        <td>Rp. <?= number_format($field['price'], 0, ',', '.'); ?></td>
                                                        <td><a href="assets/img/lapangan/<?= $field['photo']; ?>">
                                                                <img src="assets/img/lapangan/<?= $field['photo']; ?>" width="100px" height="100px" alt="gambar">
                                                            </a>
                                                        </td>
                                                        <td><?= $field['facility']; ?></td>
                                                        <td width="17%" class="text-center">
                                                            <a href="ubah-lapangan.php?id=<?= $field['id']; ?>" class="btn btn-sm btn-warning" style="color: white;"><i class="fas fa-edit" style="margin-right: 3px;"></i>Edit</a>
                                                            <a href="hapus-lapangan.php?id=<?= $field['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin mengahapus data field keluar ini ?')"><i class="fas fa-trash-alt" style="margin-right: 3px;"></i>Hapus</a>
                                                        </td>
                                                    </tr>

                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

    </div><!-- /.container-fluid -->



<?php

} else {
    header("Location: login-admin.php");
    exit();
}

include 'layout/footer-admin.php';

?>