<?php
session_start();

// Hapus semua data sesi
session_unset();
session_destroy();

// Alihkan ke halaman login.php setelah logout berhasil
header("Location: login.php");
exit;
?>
