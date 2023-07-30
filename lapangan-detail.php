<?php
session_start();
$title = "Lapangan";
include 'layout/header-user.php';
$id = (int)$_GET['id'];

$lapangan = select("SELECT * FROM lapangan WHERE id = $id")[0];


?>

<div class="container" style="min-height: 70vh;">
  <div class="card my-5">
    <div class="card-header">
      <h5><?php echo $lapangan["name"] ?></h5>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-sm-6">
          <img width="100%" height="auto" src="assets/img/lapangan/<?php echo $lapangan["photo"] ?>" alt="" srcset="">
        </div>
        <div class="col-sm-6">
          <ul style="font-size: 1.2rem;">
            <li>Harga</li>
            <p>Rp. <?php echo number_format($lapangan["price"], 2, ',', '.'); ?> / Jam</p>
            <li>Deskripsi</li>
            <?php $deskripsi = explode("|", $lapangan["facility"]) ?>
            <ul>
              <?php foreach ($deskripsi as $desk) : ?>
                <li>
                  <p class="mb-0"><?php echo $desk ?></p>
                </li>
              <?php endforeach; ?>
            </ul>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>

<?php

include 'layout/footer-user.php';

?>