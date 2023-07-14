<?php
session_start();

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

// Memproses data login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = clean_input($_POST["email"]);
    $password = clean_input($_POST["password"]);

    // Query untuk memeriksa keberadaan email dan password yang cocok dalam tabel
    $sql = "SELECT * FROM mobile_legends WHERE email='$email' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Login berhasil, simpan email dan nama pengguna dalam sesi
        $row = $result->fetch_assoc();
        $_SESSION['email'] = $row['email'];
        $_SESSION['nama'] = $row['nama'];

        // Alihkan ke halaman mobilelegends.php
        header("Location: mobilelegends.php");
        exit;
    } else {
        // Login gagal, tampilkan pesan error
        $error_message = "Email atau password salah.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Halaman Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <style>
    body {
        background-image: url('/lunar.jpg');
        background-size: cover;

        .text {
            color: white;
        }

        
    }
    
    </style>

</head>
<body>
    <?php if (isset($error_message)) { ?>
        <p><?php echo $error_message; ?></p>
    <?php } ?>
    <div class="bg-dark">
    <h2 class="text">Login</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <label class="text" for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label class="text" for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>

        <input type="submit" value="Login">
    </form>
    </div>
    <p class="text">Belum punya akun? <a href="register.php">Daftar di sini</a></p>
</body>
</html>

<?php
$conn->close();
?>
