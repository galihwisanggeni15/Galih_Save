<?php
// Koneksi ke database
$host = "localhost"; // Hostname
$username = "root"; // Username MySQL
$password = ""; // Password MySQL
$database = "db_toko_online"; // Nama database

// Melakukan koneksi ke database
$conn = mysqli_connect($host, $username, $password, $database);

// Memeriksa koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
