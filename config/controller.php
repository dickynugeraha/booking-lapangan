<?php

// ------------------------------------- FUNGSI SELECT * FROM ---------------------------------------
function select($query)
{
    // panggil koneksi database
    global $db;

    $result = mysqli_query($db, $query);
    $rows = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

// -------------------------------------- FUNGSI AUTENTIKASI ----------------------------------------
function validate($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
function loginAdmin($post){
    // panggil koneksi database
    global $db;
    $username = $post["username"];
    $password = $post["password"];

    $username = validate($username);
    $pass = validate($password);

    if (empty($username)) {
        header("Location: login-admin.php?error=User Name is required");
        exit();
    } else if (empty($pass)) {
        header("Location: login-admin.php?error=Password is required");
        exit();
    } else {
        $sql = "SELECT * FROM admins WHERE username='$username' AND password='$pass'";

        $result = mysqli_query($db, $sql);

        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            if ($row['username'] === $username && $row['password'] === $pass) {
                $_SESSION['username'] = $row['username'];
                header("Location: dashboard.php");
                exit();
            } else {
                header("Location: login-admin.php?error=Salah Username atau password !");
                exit();
            }
        } else {
            header("Location: login-admin.php?error=Salah Username atau password !");
            exit();
        }
    }
}

function loginUser($post){
    global $db;
    $phone = $post["phone"];
    $password = $post["password"];

    $query = "SELECT * FROM users WHERE phone='$phone'";

        $result = mysqli_query($db, $query);

        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);

            $verifyPassword = password_verify($password,$row["password"] );
            if (!$verifyPassword){
                echo "<script>
                alert('Salah Password, silahkan input kembali!');
                document.location.href = 'login-user.php';
                </script>";
                exit();
                return;
            }
        } else {
            echo "<script>
                alert('User tidak tersedia, silahkan register!');
                document.location.href = 'login-user.php';
                </script>";
                exit();
                return;
        }
        $_SESSION['phone'] = $row['phone'];
        $_SESSION['userId'] = $row['id'];
        echo "<script>
        alert('Login berhasil!');
        document.location.href = 'lapangan-tersedia.php';
        </script>";
        exit();
        return;

}

function registerUser($post){
    global $db;
    $name = $post["name"];
    $phone = $post["phone"];
    $email = $post["email"];
    $address = $post["address"];
    $password = $post["password"];
    $confirmPassword = $post["confirm-password"];

    $query = "SELECT * FROM users WHERE phone='$phone' OR email='$email'";
    $user = mysqli_query($db, $query);
    
    if (mysqli_num_rows($user) >= 1){
        echo "<script>
        alert('Nomor Hp atau email sudah terpakai!');
        document.location.href = 'login-user.php';
        </script>";
        exit();
        return;
    }
     if ($password !== $confirmPassword){
        echo "<script>
        alert('Konfirm password tidak sama!');
        document.location.href = 'login-user.php';
        </script>";
        exit();
        return;
    }
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO users (id, name, phone, address, email, password) VALUES(null, '$name', '$phone', '$address', '$email', '$passwordHash')";
    mysqli_query($db, $query);
    echo "<script>
        alert('Register berhasil, silahkan login untuk melakukan booking!');
        document.location.href = 'login-user.php';
        </script>";
        exit();
        return;
}

// ------------------------------------- FUNGSI LAPANGAN --------------------------------------------
function createLapangan($post){
    global $db;

    $nama_lapangan = $post['nama'];
    $status = $post['status'];
    $tipe = $post['tipe'];
    $fasilitas = $post['fasilitas'];
    $harga_lapangan = $post['harga'];
  
    $gambar = upload_file("lapangan");

    //cek upload file
    if (!$gambar) {
        return false;
    }

    //query tambah data
    $query = "INSERT INTO fields VALUES
    (null,
    '$status',
    '$tipe',
    '$nama_lapangan',
    '$gambar',
    '$fasilitas',
    '$harga_lapangan')";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}
function updateLapangan($post){
    global $db;

    $id = $post['id'];
    $nama_lapangan = $post['nama'];
    $status = $post['status'];
    $tipe = $post['tipe'];
    $fasilitas = $post['fasilitas'];
    $harga_lapangan = $post['harga'];
    $gambarLama = $post['gambarLama'];

    // hapus gambar lama
    if ($_FILES['gambar']['error'] == 4) {
        $gambar = $gambarLama;
    } else {
        //ambil gambar sesuai gambar yang dipilih
        $field = select("SELECT * FROM fields WHERE id = $id")[0];
        $gambar_img = $field["photo"];
        
        $gambar = upload_file("lapangan");

        unlink("assets/img/lapangan/" . $gambar_img);
    }

    
    //query tambah data
    $query = "UPDATE fields SET
    name = '$nama_lapangan',
    status = '$status',
    type = '$tipe',
    photo = '$gambar',
    facility = '$fasilitas',
    price = '$harga_lapangan'
    WHERE id = $id";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);

}
function deleteLapangan($id)
{
    global $db;

    //ambil gambar sesuai gambar yang dipilih
    $field = select("SELECT * FROM fields WHERE id = $id")[0];
    unlink("assets/img/lapangan/" . $field['photo']);

    // query hapus data barang
    $query = "DELETE FROM fields WHERE id = $id";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);

}

// --------------------------------------- FUNGSI BOOKING ------------------------------------------
function createBooking($post){
    global $db;
    $fieldId = $post["fieldId"];
    $userId = $post["userId"];
    $booking_start = $post["booking_start"];
    $booking_end = $post["booking_end"];
    $booking_count = $post["booking_count"];
    $total_transfer = $post["total_transfer"];
    
    date_default_timezone_set('Asia/Jakarta');
    $now = date("Y-m-d h:i:s");

    $sql = "SELECT booking_start, booking_end FROM bookings WHERE status = 'valid' OR status = 'process' AND (field_id = $fieldId)";

    $listBooking = select($sql);

    $isAvailableBook = false;
    foreach ($listBooking as $book) {
       if (strtotime($book["booking_start"]) < strtotime($booking_start)){
            if ( strtotime($booking_start) < strtotime($book["booking_end"])){
                $isAvailableBook = true;
            }
       }
    }

    if ($isAvailableBook){
        echo "<script>
                alert('Lapangan sudah diboking, Silahkan pilih jam lain!');
                document.location.href = 'lapangan-booking.php?fieldId=".$fieldId."';
                </script>";
                exit();
                return;
    } else {
        $gambar = upload_file("bukti-transfer");
        $sql = "INSERT INTO bookings
        (id, user_id, field_id, booking_start, booking_end, transfer_photo, created_at, booking_count, total_transfer) VALUES
        (null, '$userId', '$fieldId', '$booking_start', '$booking_end', '$gambar', '$now', $booking_count, $total_transfer)";
        mysqli_query($db, $sql);

        if(mysqli_affected_rows($db) >= 1){
            echo "<script>
            alert('Booking berhasil, lihat status booking di riwayat!');
            document.location.href = 'transaksi-riwayat.php';
            </script>";
            exit();
            return;
        } else {
            echo "<script>
            alert('Booking gagal!');
            document.location.href = 'transaksi-riwayat.php';
            </script>";
            exit();
            return;
        }
    }
}

function updateStatusBooking($post){
    global $db;

    $bookingId = $post["bookingId"];
    $status = $post["status"];
    $desc = $post["desc"];

    $query = "UPDATE bookings SET
    status = '$status',
    description_status = '$desc'
    WHERE id = $bookingId";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}


// fungsi mengupload file 
function upload_file($location)
{
    $namaFile   = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error      = $_FILES['gambar']['error'];
    $tmpName    = $_FILES['gambar']['tmp_name'];

    // cek file yang diupload
    $extensifileValid   = ['jpg', 'jpeg', 'png'];
    $extensifile        = explode('.', $namaFile);
    $extensifile        = strtolower(end($extensifile));


    // cek extensi file 
    if (!in_array($extensifile, $extensifileValid)) {

        //pesan gagal
        echo "<script>
                alert('Format file tidak valid');
                document.location.href = 'lapangan.php';
                </script>";
        die();
    }

    //cek ukuran file 2MB
    if ($ukuranFile > 2048000) {
        //pesan gagal

        echo "<script>
                alert('Ukuran Maksimal File 2 MB');
                document.location.href = 'lapangan.php';
                </script>";
        die();
    }

    // generate nama file baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $extensifile;

    //pindahkan ke folder local 
    move_uploaded_file($tmpName, 'assets/img/'. $location .'/' . $namaFileBaru);

    return $namaFileBaru;
}
