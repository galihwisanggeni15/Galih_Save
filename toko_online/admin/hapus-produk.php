<?php
require_once '../koneksi.php';
if (isset($_GET['id'])) {
    $delete = mysqli_query($conn, "DELETE FROM tb_product WHERE product_id = '" . $_GET['id'] . "'");
    echo "<script>alert('Produk berhasil dihapus'); window.location.href = './data-produk.php';</script>";
} else {
    echo "<script>alert('Produk gagal dihapus, silahkan coba lagi'); window.location.href = './data-produk.php';</script>";
}
