<?php
session_start();

if (!isset($_SESSION['status_login']) || $_SESSION['user_data']['admin_role'] !== 'user') {
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
    <title>BERANDA|USER|TOKOMEDIA</title>
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
    <div class="beranda">
        <main>
            <div class="search">
                <input type="text" placeholder="Search..">
            </div>
            <div class="container">
                <?php
                require_once '../koneksi.php';
                $produk = mysqli_query($conn, "SELECT * FROM tb_product ORDER BY RAND() LIMIT 8");
                if (mysqli_num_rows($produk) > 0) {
                    while ($p = mysqli_fetch_array($produk)) {
                ?>
                        <div class="card">
                            <img src="../produk/<?= $p['product_image']; ?>" alt="Product Image" class="card-img">
                            <div class="card-info">
                                <h3 class="card-title"><?= $p['product_name']; ?></h3>
                                <p class="card-price">Rp. <?= number_format($p['product_price']); ?></p>
                                <button class="buy-btn"><a href="detail-produk.php/id=<?= $p['product_id']; ?>">Buy Now</a></button>
                            </div>
                        </div>
                <?php }
                } else {
                    echo "<h1>Tidak ada produk</h1>";
                } ?>
            </div>
        </main>
    </div>
    <script src="script.js"></script>
</body>

</html>