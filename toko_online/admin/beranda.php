<?php
session_start();

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
    <title>BERANDA|ADMIN|TOKOMEDIA</title>
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
    <div class="beranda">
        <main>
            <div class="container">
                <h1>Beranda</h1>
                <div class="box">Selamat Datang <?php echo $admin_nama ?> di TOKOMEDIA</div>
            </div>
        </main>
    </div>
    <script src="script.js"></script>
</body>

</html>