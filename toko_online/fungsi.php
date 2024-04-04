<?php
if (isset($_POST['register'])) {
    register();
}
if (isset($_POST['login'])) {
    login();
}
if (isset($_POST['gantipw'])) {
    gantipw();
}
if (isset($_POST['ubahdata'])) {
    ubahdata();
}
if (isset($_POST['tambahdatakategori'])) {
    tambahdatakategori();
}
if (isset($_POST['editdatakategori'])) {
    editdatakategori();
}
if (isset($_POST['tambahdataproduk'])) {
    tambahdataproduk();
}
if (isset($_POST['editdataproduk'])) {
    editdataproduk();
}





function register()
{
    if (isset($_POST['register'])) {
        require_once "koneksi.php";
        $namatabel = "tb_users";
        $namalengkap = $_POST['namalengkap'];
        $input_username = $_POST['username'];
        $password = $_POST['password'];
        $nohp = $_POST['nomor'];
        $email = $_POST['email'];
        $alamat = $_POST['alamat'];

        // Validate if username and email are unique

        $query = "SELECT * FROM $namatabel WHERE LOWER(username) = LOWER('$input_username') OR LOWER(admin_email) = LOWER('$email') OR LOWER(admin_telp) = LOWER('$nohp')";
        $result = mysqli_query($conn, $query);

        if (!$result) {
            die("Query failed: " . mysqli_error($conn));
        }

        if (mysqli_num_rows($result) > 0) {
            echo "<script>alert('Username atau email atau nomor hp telah digunakan. Tolong pilih username atau email atau nomor hp lain'); window.location.href = './sigup.php';</script>";
            mysqli_close($conn);
            return;
        }

        // Check minimum password length
        if (strlen($password) < 6) {
            echo "<script>alert('Password minimal 6 karakter'); window.location.href = './sigup.php';</script>";
            mysqli_close($conn);
            return;
        }
        // Insert data into the "remit" table
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Hash the password for security
        $insertQuery = "INSERT INTO $namatabel (admin_nama , username, password, admin_telp, admin_email, admin_alamat, admin_role) VALUES ('$namalengkap', '$input_username', '$hashedPassword', '$nohp', '$email', '$alamat', 'user')";
        $insertResult = mysqli_query($conn, $insertQuery);

        if ($insertResult) {
            echo "<script>alert('Registrasi berhasil silahkan login'); window.location.href = './index.php';</script>";
        } else {
            echo "<script>alert('Registrasi gagal, silahkan ulangi'); window.location.href = './sigup.php';</script>";
        }

        mysqli_close($conn);
    }
}
function login()
{
    if (isset($_POST['login'])) {
        session_start();
        require_once "koneksi.php";
        $namatabel = "tb_users";
        $username = $_POST['username'];
        $user_input_password = $_POST['password'];

        $username = mysqli_real_escape_string($conn, $username);

        $selectQuery = "SELECT admin_email, username, password, admin_role, admin_nama, admin_telp, admin_alamat, admin_id FROM $namatabel WHERE username = '$username'";
        $result = mysqli_query($conn, $selectQuery);

        if ($result) {
            $row = mysqli_fetch_assoc($result);

            if ($row) {
                $row['admin_email'];
                $row['username'];
                $row['admin_telp'];
                $row['admin_id'];
                $db_role = $row['admin_role'];
                $hashedPassword = $row['password'];

                $_SESSION['status_login'] = true;
                $_SESSION['user_data'] = $row;

                // Note: Do not rehash the already hashed password from the database
                if (password_verify($user_input_password, $hashedPassword)) {
                    if ($db_role === 'admin') {
                        header("Location: admin/beranda.php");
                        exit();
                    } else {
                        header("Location: user/beranda.php");
                        exit();
                    }
                } else {
                    echo "<script>alert('Password yang anda masukkan salah'); window.location.href = './index.php';</script>";
                }
            } else {
                echo "<script>alert('Email anda belum terdaftar silahkan register dahulu'); window.location.href = './index.php';</script>";
            }

            mysqli_free_result($result);
        } else {
            // Handle query error
            echo "Query error: " . mysqli_error($conn);
        }

        mysqli_close($conn);
    }
}
function gantipw()
{
    if (isset($_POST['gantipw'])) {
        require_once "koneksi.php"; // Include your database connection file

        $namatabel = "tb_users";
        $username = $_POST['username'];
        $old_password = $_POST['old_password'];
        $new_password = $_POST['new_password'];

        // Hash the old password for comparison
        $hashed_old_password = hash('sha256', $old_password);

        // Check if the old password is correct
        $query = "SELECT * FROM $namatabel WHERE username = '$username' AND password = '$hashed_old_password'";
        $result = mysqli_query($conn, $query);

        if ($result) {
            $row = mysqli_fetch_assoc($result);

            // Hash the new password before updating the database
            $hashedPassword = password_hash($new_password, PASSWORD_DEFAULT);

            // Update the password in the database
            $update_query = "UPDATE $namatabel SET password = '$hashedPassword' WHERE username = '$username'";
            $update_result = mysqli_query($conn, $update_query);

            if ($update_result) {
                echo "<script>alert('Berhasil mengganti password silahkan login'); window.location.href = './index.php';</script>";
            } else {
                echo "<script>alert('Tidak bisa mengganti password coba lagi'); window.location.href = './ubah_password.php';</script>";
            }
        } else {
            echo "<script>alert('Password lama salah'); window.location.href = './ubah_password.php';</script>";
        }

        mysqli_close($conn);
    }
}
function ubahdata()
{
    if (isset($_POST['ubahdata'])) {
        session_start();
        require_once "koneksi.php";
        $namatabel = "tb_users";
        $input_username = $_POST['username'];
        $username = $_SESSION['user_data']['username'];

        // Validate if username is unique
        $query = "SELECT * FROM $namatabel WHERE LOWER(username) = LOWER('$input_username')";
        $result = mysqli_query($conn, $query);

        if (!$result) {
            die("Query failed: " . mysqli_error($conn));
        }

        if (mysqli_num_rows($result) > 0 && $input_username !== $username) {
            echo "<script>alert('Username telah digunakan. Tolong pilih username lain'); window.location.href = './admin/profil.php';</script>";
            mysqli_close($conn);
            return;
        }

        // Update username
        $updateQuery = "UPDATE $namatabel SET username = '$input_username' WHERE username = '$username'";
        $updateResult = mysqli_query($conn, $updateQuery);

        if (!$updateResult) {
            die("Update query failed: " . mysqli_error($conn));
        }

        // Update session data if username is updated
        $_SESSION['user_data']['username'] = $input_username;

        echo "<script>alert('Username berhasil diubah, Silahkan login kembali'); window.location.href = './index.php';</script>";

        mysqli_close($conn);
    }
}
function tambahdatakategori()
{
    if (isset($_POST['tambahdatakategori'])) {
        require_once "koneksi.php";
        $namadata = $_POST['kategori'];

        $query = "SELECT * FROM tb_category WHERE LOWER(category_name) = LOWER('$namadata')";
        $result = mysqli_query($conn, $query);

        if (!$result) {
            die("Query failed: " . mysqli_error($conn));
        }

        if (mysqli_num_rows($result) > 0) {
            echo "<script>alert('Data kategori sudah ada. Tolong pilih kategori lain'); window.location.href = './admin/tambahdata.php';</script>";
            mysqli_close($conn);
            return;
        }

        $tambahqueary = "INSERT INTO tb_category (category_name) VALUES ('$namadata')";
        $insertresult = mysqli_query($conn, $tambahqueary);
        if ($insertresult) {
            echo "<script>alert('Tambah data berhasil'); window.location.href = './admin/data-kategori.php';</script>";
        } else {
            echo "<script>alert('Tambah data gagal, silahkan ulangi'); window.location.href = './admin/tambahdata.php';</script>";
        }

        mysqli_close($conn);
    }
}
function editdatakategori()
{
    if (isset($_POST['editdatakategori'])) {
        require_once "koneksi.php";
        $id = $_GET['id'];
        $newCategoryName = $_POST['kategori'][0];

        $query = "SELECT * FROM tb_category WHERE LOWER(category_name) = LOWER('$newCategoryName')";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {
            echo "<script>alert('Nama category telah digunakan. Tolong pilih nama category lain'); window.location.href = './admin/data-kategori.php';</script>";
            return;
        }
        $updateQuery = "UPDATE tb_category SET category_name = '$newCategoryName' WHERE category_id = '$id'";

        if (mysqli_query($conn, $updateQuery)) {
            echo "<script>alert('Nama kategory berhasil diubah'); window.location.href = './admin/data-kategori.php';</script>";
            return;
        } else {
            echo "<script>alert('Tidak bisa mengganti nama data kategory, Silahkan cobalagi'); window.location.href = './admin/data-kategori.php';</script>";
            return;
        }
        mysqli_close($conn);
    }
}
function tambahdataproduk()
{
    if (isset($_POST['tambahdataproduk'])) {
        include 'koneksi.php';
        // print_r($_FILES['gambar']);
        //  menampung inputan dari form
        $kategori  = $_POST['kategori'];
        $nama      = $_POST['nama'];
        $harga     = $_POST['harga'];
        $deskripsi = $_POST['deskripsi'];
        $status    = $_POST['status'];
        $jumlahproduk    = $_POST['jumlahbarang'];

        // menampung data file yang diupload
        $filename = $_FILES['gambar']['name'];

        // $data = array(
        //     'kategori' => $kategori,
        //     'nama' => $nama,
        //     'harga' => $harga,
        //     'deskripsi' => $deskripsi,
        //     'status' => $status,
        //     'gambar' => $filename,
        // );
        // var_dump($data);
        // die;
        $tmp_name = $_FILES['gambar']['tmp_name'];

        $type1 = explode('.', $filename);
        $type2 = $type1[1];

        $newname = 'produk' . time() . '.' . $type2;

        //menampung format file yang diizinkan
        $tipe_diizinkan = array('jpg', 'jpeg', 'png', 'gif');
        //validasi format file

        //validasi format file
        if (!in_array($type2, $tipe_diizinkan)) {
            echo "<script>alert('Format file tidak diizinkan'); window.location.href = './admin/tambahdataproduk.php';</script>";
            return;
        } else {
            move_uploaded_file($tmp_name, './produk/' . $newname);

            $insert = mysqli_query($conn, "INSERT INTO tb_product (category_id, product_name, product_price,
             product_description, product_image, product_status, product_jumlahbarang) 
                  VALUES ('$kategori', '$nama', '$harga', '$deskripsi', '$newname', '$status', '$jumlahproduk')");


            if ($insert) {
                echo "<script>alert('Berhasil tambah data'); window.location.href = './admin/data-produk.php';</script>";
                return;
            } else {
                echo "<script>alert('Gagal menambah data, coba lagi'); window.location.href = './admin/tambahdataproduk.php';</script>";
                return;
            }
        }
        //proses upload file sekaligus insert ke database
    }
}
function editdataproduk()
{
    if (isset($_POST['editdataproduk'])) {
        require_once "koneksi.php";

        $kategori  = $_POST['kategori'];
        $nama      = $_POST['nama'];
        $harga     = $_POST['harga'];
        $deskripsi = $_POST['deskripsi'];
        $status    = $_POST['status'];
        $jumlahproduk = $_POST['jumlahbarang'];

        $selek = mysqli_query($conn, "SELECT * FROM tb_product WHERE product_name = '" . $nama . "'");
        $p = mysqli_fetch_object($selek);
        $foto    = $p->product_image; // Use the existing image name from the database

        $filename = $_FILES['gambar']['name'];
        $tmp_name = $_FILES['gambar']['tmp_name'];

        if ($filename != '') {
            $type1 = explode('.', $filename);
            $type2 = $type1[1];

            $newname = 'produk' . time() . '.' . $type2;

            $tipe_diizinkan = array('jpg', 'jpeg', 'png', 'gif');

            if (!in_array($type2, $tipe_diizinkan)) {
                echo "<script>alert('Format file tidak diizinkan'); window.location.href = './admin/tambahdataproduk.php';</script>";
                return;
            } else {
                // Remove the existing image before uploading the new one
                unlink('./produk/' . $foto);

                move_uploaded_file($tmp_name, './produk/' . $newname);
                $namagambar = $newname;
            }
        } else {
            $namagambar = $foto;
        }

        // Use SET instead of VALUES in the UPDATE query
        $update = mysqli_query($conn, "UPDATE tb_product SET category_id='$kategori', product_name='$nama', product_price='$harga', product_description='$deskripsi', product_image='$namagambar', product_status='$status', product_jumlahbarang='$jumlahproduk' WHERE product_id='" . $p->product_id . "'");

        if ($update) {
            echo "<script>alert('Berhasil Edit data'); window.location.href = './admin/data-produk.php';</script>";
            return;
        } else {
            echo "<script>alert('Gagal Edit data, coba lagi'); window.location.href = './admin/data-produk.php';</script>";
            return;
        }
    }
}
