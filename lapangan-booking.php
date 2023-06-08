<?php
session_start();
$title = 'Booking fields';
include 'layout/header-user.php';

// membatasi halaman sebelum login
if (isset($_SESSION['phone'])) {

   $fieldId = (int)$_GET['fieldId'];

   $detailField = select("SELECT * FROM fields WHERE id = $fieldId");
   $detailField = $detailField[0];

   if (isset($_POST['booking'])) {
      createBooking($_POST);
   }
?>
    <div class="container" style="min-height: 90vh; margin-top: 3rem;">
    <h2 class="my-5">Booking <?= $detailField["name"] ?></h2>
      <div class="row">
         <!-- form booking -->
        <div class="col-xl-5 col-lg-7 col-md-12">
         <div class="card p-4 mb-3">
         <form action="" method="post" enctype="multipart/form-data" method="post">
            <input type="hidden" name="fieldId" value="<?= $fieldId ?>">
            <input type="hidden" name="userId" value="<?= $_SESSION["userId"] ?>">
               <div class="form-group">
                  <label for="booking_start" class="form-label">Booking start</label> <br>
                  <input required class="form-control" type="datetime-local" name="booking_start" id="booking_start" max="2023-02-01T05:47:32.276Z">
               </div>
               <div class="form-group">
                  <label for="booking_end">Booking end</label><br>
                  <input required class="form-control" type="datetime-local" name="booking_end" id="booking_end">
               </div>
               <div class="form-group">
                  <label for="booking_count">Booking count <i>(hour)</i></label><br>
                  <input required class="form-control" type="number" name="booking_count" onkeyup="calculateTotalPrice()" id="booking_count">
               </div>
               <div class="form-group">
                  <label for="total_transfer">Your price <i>(per hour Rp. <?= number_format($detailField['price'], 0, ',', '.'); ?>)</i></label><br>
                  <input onfocus="this.StyleSheet.border = 'none'" required class="form-control" readonly type="number" name="total_transfer" id="total_transfer">
               </div>
               <div class="form-group">
                  <label for="gambar">Upload bukti transfer</label>
                  <input type="file" required id="gambar" name="gambar" onchange="previewImg()"><br>
                  <img src="" alt="" class="img-thumbnail mt-2" id="img-preview" width="200px">
               </div>
               <div class="form-group" style="float: right;">
                  <button type="submit" name="booking" class="btn btn-primary">Booking</button>
               </div>
            </form>
         </div>
        </div>
        <!-- syarat ketentuan -->
        <div class="col-xl-7 col-lg-7 col-md-12  mt-4 mt-md-0">
         <div class="card p-4">
         <h5 style="margin-bottom:20px;">Syarat dan ketentuan pemesanan</h5>
         <ul class="list-group" style="color: grey;">
               <li class="list-group-item">Pastikan Anda telah mendaftarkan akun terlebih dahulu.</li>
               <li class="list-group-item">Pilih hari dan jam yang tersedia.</li>
               <li class="list-group-item">Pastikan Anda sudah melakukan pembayaran melalui transfer bank BNI berikut ini <strong style="font-size:1.1rem; font-style:italic; color:black;"> 1296523616 </strong> sebelum membuat pesanan.</li>
               <li class="list-group-item">Upload bukti transfer melalui form upload yang disediakan.</li>
               <li class="list-group-item">Jika Anda yakin, silakan tekan booking untuk melakukan pemesanan.</li>
            </ul>
         </div>
        </div>
        <div class="col-xl-6 col-lg-7 col-md-12">
        </div>
      </div>
     
   </div>
   <script>
      function calculateTotalPrice(){
         const totalTransfer = document.getElementById("total_transfer");
         const hourValue = document.getElementById("booking_count").value;
         const price = `<?= $detailField['price'] ?>`;

         let calculate = price * hourValue;

         totalTransfer.value = calculate;
      }
      function previewImg() {
            const gambar = document.querySelector('#gambar');
            const imgPreview = document.querySelector('#img-preview');

            const fileGambar = new FileReader();
            fileGambar.readAsDataURL(gambar.files[0]);

            fileGambar.onload = function(e) {
                imgPreview.src = e.target.result;
            }
        }
   </script>
<?php

} else {
   header("Location: login-user.php");
   exit();
}

include 'layout/footer-user.php';
?>