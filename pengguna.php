<?php
session_start();
$tittle = 'Pengguna Website GOR';
include 'layout/header-admin.php';

// membatasi halaman sebelum login
if (isset($_SESSION['username'])) {

    $users = select("SELECT * FROM users ORDER BY id DESC");
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
                                        <h1 class="card-title">Pengguna <b style="color: green;">GOR</b></h1>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <table id="dataTable" class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama </th>
                                                    <th>Alamat </th>
                                                    <th>No HP </th>
                                                    <th>Email</th>
                                                  
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php $no = 1; ?>
                                                <?php foreach ($users as $user) : ?>
                                                    <tr>
                                                        <td> <?= $no++; ?> </td>
                                                        <td> <?= $user['name']; ?> </td>
                                                        <td><?= $user['address']; ?></td>
                                                        <td><?= $user['phone']; ?></td>
                                                        <td><?= $user['email']; ?></td>
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
    </section>
    <!-- /.content -->
    </div>


 

<?php

} else {
    header("Location: login-admin.php");
    exit();
}

include 'layout/footer-admin.php';

?>