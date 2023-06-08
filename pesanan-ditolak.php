<?php
session_start();
$tittle = 'Booking Ditolak';
include 'layout/header-admin.php';

// membatasi halaman sebelum login
if (isset($_SESSION['username'])) {

    $bookings = select("SELECT 
    users.name, 
    users.address, 
    bookings.created_at, 
    bookings.total_transfer,
    fields.price,
    bookings.transfer_photo,
    bookings.booking_start,
    bookings.booking_end,
    bookings.description_status,
    bookings.booking_count,
    bookings.id as bookingId FROM (
      (bookings INNER JOIN users ON bookings.user_id = users.id)
      INNER JOIN fields ON bookings.field_id= fields.id)
      WHERE bookings.status = 'invalid' ORDER BY bookings.id DESC;");

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
                                        <h3 class="card-title">Pesanan <b style="color: red;">DITOLAK</b></h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <table id="dataTable" class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama pemesan</th>
                                                    <th>Alamat</th>
                                                    <th>Tanggal booking</th>
                                                    <th>Total pembayaran</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody id="">

                                                <?php $no = 1; ?>
                                                <?php foreach ($bookings as $book) : ?>
                                                    <tr>
                                                        <td> <?= $no++; ?> </td>
                                                        <td> <?= $book['name']; ?> </td>
                                                        <td><?= $book['address'];?></td>
                                                        <td><?= date("l, d F Y",strtotime($book['created_at'])); ?></td>
                                                        <td>Rp. <?= number_format($book['total_transfer'], 0, ',', '.');; ?></td>
                                                       
                                                        <td width="17%" class="text-center">
                                                            <a style="color:white" class="btn btn-md btn-warning" data-toggle="modal" data-target="#myModal<?= $book['bookingId']; ?>">Detail</a>
                                                          </td>
                                                    </tr>
                                                  <!-- Modal -->
                                                  <div class="modal fade" id="myModal<?= $book['bookingId']; ?>" role="dialog">
                                                              <div class="modal-dialog">
                                                              <!-- Modal content-->
                                                              <div class="modal-content">
                                                                  <div class="modal-header">
                                                                    <h4 class="modal-title">Detail Booking <?= $book["name"] ?></h4>
                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                  </div>
                                                                  <div class="modal-body">
                                                                    <div class="row d-flex justify-content-between align-items-center">
                                                                      <div class="col-xl-6 col-lg-12 col-md-12">
                                                                        <img class="rounded" src="assets/img/bukti-transfer/<?= $book['transfer_photo']; ?>" style="max-width:100%;"/>
                                                                      </div>
                                                                      <div class="col-xl-6 col-lg-12 col-md-12  mt-4 mt-md-0">
                                                                      <div class="mb-1">
                                                                        <span>Date </span>
                                                                          <span class="font-italic" style="color: grey;"> : <?= date("d M Y", strtotime($book["booking_start"])) ?> </span>
                                                                        </div>  
                                                                      <div class="mb-1">
                                                                        <span>Pesan untuk </span>
                                                                          <span class="font-italic" style="color: grey;"> : <?= $book['booking_count']; ?> jam </span>
                                                                        </div>
                                                                        <div class="mb-1">
                                                                          <span>Harga lapangan </span>
                                                                         <span class="font-italic" style="color: grey;">  : Rp.<?= number_format($book['price'], 0, ',', '.'); ?> </span>
                                                                        </div>
                                                                        <div class="mb-1">
                                                                          <span>Mulai booking </span>
                                                                          <span class="font-italic" style="color: grey;"> : <?= date("H : i", strtotime($book["booking_start"]))?> WIB</span>
                                                                        </div>
                                                                        <div>
                                                                          <span>Akhir booking </span>
                                                                          <span class="font-italic" style="color: grey;"> : <?= date("H : i", strtotime($book["booking_end"]))?> WIB</span>
                                                                        </div>
                                                                        <div>
                                                                          <span>Keterangan </span>
                                                                          <span class="font-italic" style="color: grey;"> : <?= $book["description_status"]?></span>
                                                                        </div>
                                                                      </div>
                                                                    </div>
                                                                  </div>
                                                                  <div class="modal-footer">
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                  </div>
                                                              </div>
                                                              
                                                              </div>
                                                          </div>
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