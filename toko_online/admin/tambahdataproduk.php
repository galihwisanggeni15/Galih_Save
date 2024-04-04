<?php
session_start();
require_once '../koneksi.php';
if (!isset($_SESSION['status_login']) || $_SESSION['user_data']['admin_role'] !== 'admin') {
    header("Location: ../index.php");
    exit();
}

$admin_nama = $_SESSION['user_data']['admin_nama'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>TAMBAH DATA KATEGORI|ADMIN|TOKOMEDIA</title>
</head>

<body>
    <header>
        <nav>
            <div class="logo">TOKOMEDIA</div>
            <div class="nav-link" id="navLink">
                <a href="beranda.php" class="link-nav">Beranda</a>
                <a href="profil.php" class="link-nav">Profil</a>
                <a href="data-kategori.php" class="link-nav">Data Kategori</a>
                <a href="data-produk.php" class="link-nav">Data Produk</a>
                <div class="login">
                    <button><a href="../logout.php">Log Out</a></button>
                </div>
            </div>
            <div class="menu-toggle" onclick="toggleMenu()">&#9776;</div>
        </nav>
    </header>
    <div class="profil">
        <main>
            <div class="container">
                <center>
                    <h1>Tambah Data Produk</h1>
                </center>
                <div class="container-form">
                    <form action="../fungsi.php" method="POST" class="form-profil" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="cars">Pilih kategori:</label><br>
                            <select name="kategori" id="cars">
                                <option value="">--Pilih--</option>
                                <?php
                                $kategori = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY category_id DESC");
                                while ($r = mysqli_fetch_array($kategori)) {
                                ?>
                                    <option value="<?= $r['category_id'] ?>"><?= $r['category_name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama Produk :</label><br>
                            <input type="text" id="nama" name="nama" required>
                        </div>
                        <div class="form-group">
                            <label for="harga">Harga Produk :</label><br>
                            <input type="number" id="harga" name="harga" required>
                        </div>
                        <div class="form-group">
                            <label for="gambar">Foto Produk :</label><br>
                            <input type="file" id="gambar" name="gambar" required>
                        </div>
                        <div class="form-group">
                            <label for="deskripsi">Deskripsi Produk :</label><br>
                            <input type="text" id="deskripsi" name="deskripsi" required>
                        </div>
                        <div class="form-group">
                            <label for="jumlahbarang">Jumlah Produk :</label><br>
                            <input type="number" id="jumlahbarang" name="jumlahbarang" required>
                        </div>
                        <div class="form-group">
                            <label for="cars">Status Produk:</label><br>
                            <select name="status" id="cars">
                                <option value="">--Pilih--</option>
                                <option value="1">Aktif</option>
                                <option value="0">Tidak Aktif</option>
                            </select>
                        </div>
                        <button type="submit" name="tambahdataproduk">Tambah Data</button>
                    </form>
                </div>
            </div>
        </main>
    </div>
    <script src="script.js"></script>
</body>

</html>