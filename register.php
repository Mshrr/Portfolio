<?php
$servername = "sql6.freesqldatabase.com"; // Ganti dengan nama server MySQL Anda
$username = "sql6631604"; // Ganti dengan nama pengguna MySQL Anda
$password = "AvJ6bfttTX"; // Ganti dengan kata sandi MySQL Anda
$dbname = "sql6631604"; // Ganti dengan nama database yang telah Anda buat

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
    $name = clean_input($_POST["name"]);
    $wa = clean_input($_POST["wa"]);
    $usrname = clean_input($_POST["usrname"]);
    $team = clean_input($_POST["team"]);
    $usrteam = clean_input($_POST["usrteam"]);
    $idteam = clean_input($_POST["idteam"]);
    $agreement = clean_input($_POST["agreement"]);

    // Query untuk memasukkan data pendaftaran ke dalam tabel Tournament
    $sql = "INSERT INTO Tournament (name, wa, usrname, team, usrteam, idteam, agreement) VALUES ('$name', '$wa', '$usrname', '$team', '$usrteam', '$idteam', '$agreement')";

    if ($conn->query($sql) === TRUE) {
        // Pendaftaran berhasil, alihkan ke halaman index.php
        header("Location: index.php");
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
    <style>
        body {
            /* background-color: #112e47; */
            color: white;
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
        }

        @media (max-width: 600px) {
            body {
                background-image: url('lunar.jpg');
            }
        }

        @media (min-width: 601px) {
            body {
                background-image: url('lunar.jpg');
            }
        }
        .register {
            background-color: #2b3844be;
            width: 60%;
            left: 0;
            margin-left: 16%;
            margin-right: 20%;
            border-radius: 20px;
            padding: 40px;

            
        }
        .input {
            width: 99%;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #2b384488;
            border-radius: 5px;
            border-color: #2b384488;
            border-bottom-color: #ffffff6b;
            border-right-color: #ffffff6b;
        }
        
        .submit {
            width: 99%;
            display: flex;
            background-color: #3789af;
            border-radius: 10px;
        }
    </style>
    <div class="register">
        <div class="image" style="display: flex; justify-content: center; align-items: center;">
            <img src="/logoml.png" alt="Logo Mobile Legends" style="width:400px; height:200px;">
        </div>
    <h2>Pendaftaran</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <label for="name">Nama Team:</label><br>
        <input class="input" type="text" id="name" name="name" required><br><br>

        <label for="wa">No. WhatsApp Leader:</label><br>
        <input class="input" type="text" id="wa" name="wa" required><br><br>

        <label for="usrname">Username:</label><br>
        <input class="input" type="text" id="usrname" name="usrname" required><br><br>

        <label for="team">Team:</label><br>
        <textarea class="input" id="team" name="team" rows="3" required></textarea><br><br>

        <label for="usrteam">Username Team:</label><br>
        <textarea class="input" id="usrteam" name="usrteam" rows="3" required></textarea><br><br>

        <label for="idteam">ID Team:</label><br>
        <textarea class="input" id="idteam" name="idteam" rows="3" required></textarea><br><br>

        <label for="agreement">Persetujuan:</label>
        <input type="radio" id="agreement" name="agreement" value="Yes" required> Yes
        <input type="radio" id="agreement" name="agreement" value="No" required> No<br><br>

        <input class="submit" type="submit" value="Submit">
    </form>
    </div>
</body>
</html>

<?php
$conn->close();
?>
