<?php
session_start();
$title = "Lapangan";
include 'layout/header-user.php';

$lapangan_futsal = select("SELECT * FROM lapangan WHERE type = 'Futsal' ORDER BY id DESC");
$lapangan_badminton = select("SELECT * FROM lapangan WHERE type = 'Badminton' ORDER BY id DESC");

?>

<div class="container">
  <!-- Lapangan badminton -->
  <h4 class="ms-3 mb-5" style="text-transform:uppercase">Lapangan Badminton</h4>
  <div class="d-flex justify-content-center flex-wrap">
    <?php foreach ($lapangan_futsal as $futsal) : ?>
      <div class="card mb-3 mx-2" style="max-width: 300px;">
        <div class="card-header">
          <h5><?php echo $futsal["name"] ?></h5>
        </div>
        <div class="card-body">
          <img width="100%" height="auto" src="assets/img/lapangan/<?php echo $futsal["photo"] ?>" alt="" srcset="">
        </div>
        <div class="card-footer d-flex justify-content-between">
          <p><?php echo $futsal["status"] == 1 ? "Tersedia" : "Dalam perawatan" ?></p>
          <a href="lapangan-detail.php?id=<?php echo $futsal["id"] ?>" class="btn btn-sm btn-info">Detail</a>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
  <h5 class="text-center mb-3"><?php if (count($lapangan_futsal) == 0) echo "Sementara lapangan sedang dalam perawatan!"  ?></h5>

  <!-- Lapangan futsal -->
  <h4 class="ms-3 mb-5" style="text-transform:uppercase">Lapangan Futsal</h4>
  <div class="d-flex justify-content-center flex-wrap">
    <?php foreach ($lapangan_badminton as $badminton) : ?>
      <div class="card mb-3 mx-2" style="max-width: 300px;">
        <div class="card-header">
          <h5><?php echo $badminton["name"] ?></h5>
        </div>
        <div class="card-body">
          <img width="100%" height="auto" src="assets/img/lapangan/<?php echo $badminton["photo"] ?>" alt="" srcset="">
        </div>
        <div class="card-footer d-flex justify-content-between">
          <p><?php echo $badminton["status"] == 1 ? "Tersedia" : "Dalam perawatan" ?></p>
          <a href="lapangan-detail.php?id=<?php echo $badminton["id"] ?>" class="btn btn-sm btn-info">Detail</a>
        </div>
      </div>
    <?php endforeach; ?>
  </div>

  <h5 class="text-center mb-3"><?php if (count($lapangan_badminton) == 0) echo "Sementara lapangan sedang dalam perawatan!"  ?></h5>
</div>

<?php

include 'layout/footer-user.php';

?>