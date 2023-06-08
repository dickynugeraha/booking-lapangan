<?php
session_start();
$tittle = 'Detail Booking';
include 'layout/header-admin.php';

if ($_SESSION["username"]){
   $bookingId = $_GET["bookingId"];

   $detailTransaction = select("SELECT * FROM ((
   bookings INNER JOIN users ON bookings.user_id= users.id)
   INNER JOIN fields ON bookings.field_id= fields.id) WHERE bookings.id = $bookingId;");
   $detailTransaction = $detailTransaction[0];
//    var_dump($detailTransaction);
//    exit();
?>
    <link rel="stylesheet" href="assets/css/detail.css"/>

	<div class="container" style="min-height: 80vh; margin-top:6rem;">
		<div class="card" >
			<div class="container-fliud" >
				<div class="wrapper row" >
					<div class="preview col-md-6">
						
						<div class="preview-pic tab-content">
						  <div class="tab-pane active" id="pic-1"><img src="assets/img/bukti-transfer/<?= $detailTransaction['transfer_photo']; ?>" /></div>
						  <div class="tab-pane" id="pic-2"><img src="assets/img/bukti-transfer/<?= $detailTransaction['transfer_photo']; ?>" /></div>
						  <div class="tab-pane" id="pic-3"><img src="assets/img/bukti-transfer/<?= $detailTransaction['transfer_photo']; ?>" /></div>
						  <div class="tab-pane" id="pic-4"><img src="assets/img/bukti-transfer/<?= $detailTransaction['transfer_photo']; ?>" /></div>
						  <div class="tab-pane" id="pic-5"><img src="assets/img/bukti-transfer/<?= $detailTransaction['transfer_photo']; ?>" /></div>
						</div>
						
						
					</div>
					<div class="details col-md-6">
						<h3 class="product-title"><?= $detailTransaction["name"]; ?> Booking</h3>
                        <p class="vote">Price field per hour Rp. <?= number_format($detailTransaction['price'], 0, ',', '.'); ?>, booking for <strong> <?= $detailTransaction["booking_count"] ?> hour </strong></p>
						<h6 class="price">current price: <span class="size" data-toggle="tooltip" title="small">Rp. <?= number_format($detailTransaction['total_transfer'], 0, ',', '.'); ?></span></h6>
						<h6 class="sizes">booking start:
							<span class="size" data-toggle="tooltip" title="small"><?= date("H : i", strtotime($detailTransaction["booking_start"]))?></span>
						</h6>
						<h6 class="colors">booking end:
                        <span class="size" data-toggle="tooltip" title="small"><?= date("H : i", strtotime($detailTransaction["booking_end"]))?></span>
						</h6>
					</div>
				</div>
			</div>
		</div>
	</div>


<?php
} else {
    header("Location: login-admin.php");
    exit();
}
include 'layout/footer-admin.php';
?>

