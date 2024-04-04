<?php
session_start();

$admin_nama = $_SESSION['user_data']['admin_nama'];
$username = $_SESSION['user_data']['username'];
$nomor = $_SESSION['user_data']['admin_telp'];
$email = $_SESSION['user_data']['admin_email'];
$alamat = $_SESSION['user_data']['admin_alamat'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>PROFIL|USER|TOKOMEDIA</title>
</head>

<body>
    <header>
        <nav>
            <div class="logo">TOKOMEDIA</div>
            <div class="nav-link" id="navLink">
                <a href="beranda.php" class="link-nav">Beranda</a>
                <a href="profil.php" class="link-nav">Profil</a>
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
                    <h1>Profil Anda</h1>
                </center>
                <div class="container-form">
                    <form action="../fungsi.php" method="POST" class="form-profil">
                        <div class="form-group">
                            <label for="name">Nama Lengkap :</label><br>
                            <input type="text" id="name" name="nama" value="<?= $admin_nama ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="username">Username :</label><br>
                            <input type="text" id="username" name="username" value="<?= $username ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="nomor">Nomor Telephone :</label><br>
                            <input type="number" id="nomor" name="nomor" value="<?= $nomor; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Alamat Email :</label><br>
                            <input type="email" id="email" name="email" value="<?= $email; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat Rumah :</label><br>
                            <input type="text" id="alamat" name="alamat" value="<?= $alamat; ?>" required>
                        </div>
                        <button type="submit" name="ubahdata">Ubah Data</button>
                    </form>
                </div>
            </div>
        </main>
    </div>
    <script src="script.js"></script>
</body>

</html>