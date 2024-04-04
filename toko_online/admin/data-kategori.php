<?php
session_start();
require_once "../koneksi.php";
if (!isset($_SESSION['status_login']) || $_SESSION['user_data']['admin_role'] !== 'admin') {
    header("Location: ../index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>DATA KATEGORI|ADMIN|TOKOMEDIA</title>
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
    <div class="data-kategori">
        <main>
            <div class="container">
                <div class="box">
                    <center>
                        <h1>Data Kategori</h1>
                    </center>
                    <div class="tambahdata">
                        <a href="tambahdata.php">Tambah data</a>
                    </div>
                    <div class="table-container">
                        <table border="1" cellspacing="0">
                            <thead>
                                <tr>
                                    <th width="60px">No</th>
                                    <th>Kategori</th>
                                    <th width="200px">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = '1';
                                $kategori = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY category_id DESC");
                                while ($row = mysqli_fetch_array($kategori)) {
                                ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $row['category_name']; ?></td>
                                        <td>
                                            <button><a href="edit-kategory.php?id=<?php echo $row['category_id']; ?>" class="edit">Edit</a></button> || <button><a href="hapus-kategory.php?id=<?php echo $row['category_id']; ?>" class="hapus" onclick="return confirm('Yakin ingin hapus?')">Hapus</a></button>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </main>
    </div>
    <script src=" script.js"></script>
</body>

</html>