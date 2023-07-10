<?php
session_start();

// Periksa apakah pengguna sudah login atau belum
if (!isset($_SESSION['email'])) {
    // Pengguna belum login, alihkan ke halaman login.php
    header("Location: login.php");
    exit;
}

// Ambil data pengguna dari sesi
$email = $_SESSION['email'];
$nama = $_SESSION['nama'];

// Tampilkan halaman mobilelegends.php
?>

<!DOCTYPE html>
<html>
<head>
    <title>Halaman Mobile Legends</title>
</head>
<body>
    <h2>Selamat datang, <?php echo $nama; ?>!</h2>
    <p>Ini adalah halaman Mobile Legends.</p>

    <!-- Tambahkan konten sesuai kebutuhan -->
    
    <form action="logout.php" method="POST">
        <input type="submit" value="Logout">
    </form>
</body>
</html>
