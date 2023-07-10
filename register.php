<?php
$servername = "sql6.freesqldatabase.com"; // ganti dengan nama server MySQL Anda
$username = "sql6631604"; // ganti dengan nama pengguna MySQL Anda
$password = "AvJ6bfttTX"; // ganti dengan kata sandi MySQL Anda
$dbname = "sql6631604"; // ganti dengan nama database yang telah Anda buat

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Fungsi untuk membersihkan input dari karakter khusus
function clean_input($data) {
    global $conn;
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    $data = $conn->real_escape_string($data);
    return $data;
}

// Memproses data pendaftaran
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = clean_input($_POST["nama"]);
    $email = clean_input($_POST["email"]);
    $telepon = clean_input($_POST["telepon"]);
    $password = clean_input($_POST["password"]);

    // Query untuk memasukkan data pendaftaran ke dalam tabel
    $sql = "INSERT INTO mobile_legends (nama, email, telepon, password) VALUES ('$nama', '$email', '$telepon', '$password')";

    if ($conn->query($sql) === TRUE) {
        // Pendaftaran berhasil, alihkan ke halaman login.php dan tampilkan popup
        echo "<script>alert('Pendaftaran Berhasil!'); window.location.href = 'login.php';</script>";
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Halaman Pendaftaran</title>
</head>
<body>
    <h2>Pendaftaran</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <label for="nama">Nama:</label>
        <input type="text" id="nama" name="nama" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="telepon">Telepon:</label>
        <input type="text" id="telepon" name="telepon" required><br><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>

        <input type="submit" value="Daftar">
    </form>
</body>
</html>

<?php
$conn->close();
?>
