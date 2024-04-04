<?php
session_start();
require_once "../koneksi.php";

$id = $_GET['id'];
$kategori = mysqli_query($conn, "SELECT * FROM tb_product WHERE product_id = '$id'");
$k = mysqli_fetch_object($kategori);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Details</title>
</head>
<body>
    
</body>
</html>