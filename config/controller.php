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
function loginAdmin($post)
{
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


// ------------------------------------- FUNGSI LAPANGAN --------------------------------------------
function createLapangan($post)
{
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
    $query = "INSERT INTO lapangan VALUES
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
function updateLapangan($post)
{
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
        $field = select("SELECT * FROM lapangan WHERE id = $id")[0];
        $gambar_img = $field["photo"];

        $gambar = upload_file("lapangan");

        unlink("assets/img/lapangan/" . $gambar_img);
    }


    //query tambah data
    $query = "UPDATE lapangan SET
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
    $field = select("SELECT * FROM lapangan WHERE id = $id")[0];
    unlink("assets/img/lapangan/" . $field['photo']);

    // query hapus data barang
    $query = "DELETE FROM lapangan WHERE id = $id";

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
    move_uploaded_file($tmpName, 'assets/img/' . $location . '/' . $namaFileBaru);

    return $namaFileBaru;
}
