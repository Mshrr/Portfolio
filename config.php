<?php
$servername = "localhost"; // ganti dengan nama server MySQL Anda
$username = "username_mysql"; // ganti dengan nama pengguna MySQL Anda
$password = "password_mysql"; // ganti dengan kata sandi MySQL Anda
$dbname = "nama_database"; // ganti dengan nama database yang telah Anda buat

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
