<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$database = "delivery";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Menyimpan data pesan baru jika tombol 'Simpan' ditekan
if(isset($_POST['simpan'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Query untuk menyimpan data pesan baru
    $insertSql = "INSERT INTO kontak (name, email, subject, message) VALUES ('$name', '$email', '$subject', '$message')";

    if ($conn->query($insertSql) === TRUE) {
        echo "Data berhasil ditambahkan.";
        // Redirect kembali ke halaman utama setelah data berhasil ditambahkan
        header("Location: index.html");
        exit();
    } else {
        echo "Error: " . $insertSql . "<br>" . $conn->error;
    }
}

// Menutup koneksi ke database
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Form Daftar</title>
    <!-- Tautan CSS Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h3>Form Daftar</h3>
        <form method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Nama</label>
                <input type="text" class="form-control" id="name" name="name">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>
            <div class="mb-3">
                <label for="subject" class="form-label">Subjek</label>
                <input type="text" class="form-control" id="subject" name="subject">
            </div>
            <div class="mb-3">
                <label for="message" class="form-label">Pesan</label>
                <textarea class="form-control" id="message" name="message"></textarea>
            </div>
            <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
            <a href="Tampil.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>

    <!-- Tautan JavaScript Bootstrap 5 (Opsional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
