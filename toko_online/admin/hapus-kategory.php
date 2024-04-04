<?php
require_once '../koneksi.php';
if(isset($_GET['id'])){
    $delete = mysqli_query($conn, "DELETE FROM tb_category WHERE category_id = '". $_GET['id']."'");
    echo "<script>alert('Kategori berhasil dihapus'); window.location.href = './data-kategori.php';</script>";
}else{
    echo "<script>alert('Kategori gagal dihapus, silahkan coba lagi'); window.location.href = './data-kategori.php';</script>";
}
?>