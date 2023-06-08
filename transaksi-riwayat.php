<?php
session_start();
$title = "Histori transaksi";
include 'layout/header-user.php';

if ($_SESSION["phone"]){
   $userId = $_SESSION["userId"];
   $userBookings = select("SELECT 
    users.name, 
    users.address, 
    bookings.created_at, 
    bookings.total_transfer,
    fields.price,
    fields.name,
    bookings.transfer_photo,
    bookings.status,
    bookings.booking_start,
    bookings.booking_end,
    bookings.description_status,
    bookings.booking_count,
    bookings.id as bookingId FROM (
  (bookings INNER JOIN users ON bookings.user_id = users.id)
  INNER JOIN fields ON bookings.field_id= fields.id)
  WHERE users.id=$userId ORDER BY  bookings.id DESC;");

?>

   <div class="content-wrapper" style="min-height: 90vh; max-width:90%; margin:auto; margin-top: 3rem; margin-bottom: 3rem;">
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
                                        <h3 class="card-title">Riwayat pemesanan anda</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <table id="dataTable" class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Field Name</th>
                                                    <th>Booking Date</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="">

                                                <?php $no = 1; ?>
                                                <?php foreach ($userBookings as $book) : ?>
                                                <?php
                                                    $color = "#B6E2A1";
                                                    if ($book['status'] == 'process'){
                                                        $color = "#FFFBC1";
                                                    }
                                                    if ($book['status'] == 'invalid'){
                                                        $color = "#F7A4A4";
                                                    }
                                                
                                                ?>
                                                    
                                                    <tr>
                                                        <td> <?= $no++; ?> </td>
                                                        <td> <?= $book['name']; ?> </td>
                                                        <td> <?= date("l, d F Y",strtotime($book['created_at'])); ?> </td>
                                                        <td style=" background-color: <?= $color ?>"> <?= $book['status']; ?> </td>
                                                        <td width="10%" class="text-center">
                                                         <a style="color:white" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#myModal<?= $book['bookingId']; ?>">Detail</a>

                                                        </td>
                                                    </tr>
                                                        <!-- Modal -->
                                                        <div class="modal fade" style="margin-top: 10rem;" id="myModal<?= $book['bookingId']; ?>" role="dialog">
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
                                                                        <span>Booking for </span>
                                                                          <span class="font-italic" style="color: grey;"> : <?= $book['booking_count']; ?> hour </span>
                                                                        </div>
                                                                        <div class="mb-1">
                                                                          <span>Price of field </span>
                                                                         <span class="font-italic" style="color: grey;">  : Rp.<?= number_format($book['price'], 0, ',', '.'); ?> </span>
                                                                        </div>
                                                                        <div class="mb-1">
                                                                          <span>Booking start </span>
                                                                          <span class="font-italic" style="color: grey;"> : <?= date("H : i", strtotime($book["booking_start"]))?> WIB</span>
                                                                        </div>
                                                                        <div class="mb-1">
                                                                          <span>Booking end </span>
                                                                          <span class="font-italic" style="color: grey;"> : <?= date("H : i", strtotime($book["booking_end"]))?> WIB</span>
                                                                        </div>
                                                                        <div>
                                                                          <span>Description </span>
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
    header("Location: index.php");
    exit();
}
include 'layout/footer-user.php';
?>

