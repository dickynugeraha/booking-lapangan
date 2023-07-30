<?php
session_start();
$title = "Lapangan";
include 'layout/header-user.php';

if ($_SESSION["phone"]) {
    $fields = select("SELECT * FROM lapangan WHERE status = 1");
?>

    <link href="assets-template/landing-page/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <link href="assets/css/card.css" rel="stylesheet" />

    <div class="container profile-page">
        <h2 class="mb-5">Ayo pesan sekarang!</h2>
        <div class="row">
            <?php $no = 1; ?>
            <?php foreach ($fields as $field) : ?>
                <div class="col-xl-6 col-lg-7 col-md-12">
                    <div class="card profile-header">
                        <div class="body">
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-12">
                                    <div class="profile-image float-md-right">
                                        <img src="assets/img/lapangan/<?= $field['photo']; ?>" alt="" height="auto" width="auto">
                                    </div>
                                </div>
                                <div class="col-lg-8 col-md-8 col-12">
                                    <h4 class="mt-2 m-b-0"><strong><?= $field["name"] ?> </strong> <span style="font-size:medium; color: grey"> - <?= $field["type"] ?></span> </h4>
                                    <span class="job_post">Harga per jam : Rp. <?= number_format($field['price'], 0, ',', '.'); ?></span><br>
                                    <p class="font-italic"><?= $field["facility"] ?></p>
                                    <div>
                                        <a href="lapangan-booking.php?fieldId=<?= $field["id"] ?>" style="color: white;" class="btn btn-primary">Booking</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>


        </div>
    </div>

<?php
} else {
    header("Location: index.php");
    exit();
}
include 'layout/footer-user.php';
?>