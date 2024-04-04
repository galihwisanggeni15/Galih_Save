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
    <title>DATA PRODUK|ADMIN|TOKOMEDIA</title>
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
                        <h1>Data Produk</h1>
                    </center>
                    <div class="tambahdata">
                        <a href="tambahdataproduk.php">Tambah data</a>
                    </div>
                    <div class="table-container">
                        <table border="1" cellspacing="0">
                            <thead>
                                <tr>
                                    <th width="60px">No</th>
                                    <th>Kategori</th>
                                    <th>Nama Produk</th>
                                    <th>Harga</th>
                                    <th>Gambar</th>
                                    <th>Status</th>
                                    <th>Jumlah Barang</th>
                                    <th width="200px">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                $produk = mysqli_query($conn, "SELECT * FROM tb_product  JOIN tb_category USING (category_id) ORDER BY product_id DESC");
                                if (mysqli_num_rows($produk) > 0) {
                                    while ($row = mysqli_fetch_array($produk)) {
                                ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $row['category_name'] ?></td>
                                            <td><?= $row['product_name'] ?></td>
                                            <td>Rp. <?= number_format($row['product_price']) ?></td>
                                            <td><a href="../produk/<?= $row['product_image'] ?>"><img src="../produk/<?= $row['product_image'] ?>" alt="gambar" width="50px" target="_blank"></a></td>
                                            <td><?= ($row['product_status'] == 0) ? 'Tidak Aktif' : 'Aktif'; ?></td>
                                            <td><?= $row['product_jumlahbarang'] ?></td>
                                            <td>
                                                <button><a href="edit-produk.php?id=<?php echo $row['product_id']; ?>" class="edit">Edit</a></button> || <button><a href="hapus-produk.php?id=<?php echo $row['product_id']; ?>" class="hapus" onclick="return confirm('Yakin ingin hapus?')">Hapus</a></button>
                                            </td>
                                        </tr>
                                    <?php }
                                } else { ?>
                                    <tr>
                                        <td colspan="8">Tidak ada data</td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </main>
    </div>
    <script src="script.js"></script>
</body>

</html>