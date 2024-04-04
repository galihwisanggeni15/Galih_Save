<?php
session_start();
require_once "../koneksi.php";

if (!isset($_SESSION['status_login']) || $_SESSION['user_data']['admin_role'] !== 'admin') {
    header("Location: ../index.php");
    exit();
}
$id = $_GET['id'];
$kategori = mysqli_query($conn, "SELECT * FROM tb_category WHERE category_id = '$id'");
$k = mysqli_fetch_object($kategori);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>EDIT DATA KATEGORI|ADMIN|TOKOMEDIA</title>
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
                    <h1>Edit Data Kategori</h1>
                </center>
                <div class="container-form">
                    <form action="../fungsi.php?id=<?= $id ?>" method="POST" class="form-profil">
                        <div class="form-group">
                            <label for="name">Nama Kategori :</label><br>
                            <input type="text" id="name" name="kategori[]" value="<?= $k->category_name ?>" required>
                        </div>
                        <button type="submit" name="editdatakategori">Edit Data</button>
                    </form>
                </div>
            </div>
        </main>
    </div>
    <script src="script.js"></script>
</body>

</html>