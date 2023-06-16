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

// Memeriksa apakah ada parameter ID yang dikirim melalui URL
if (isset($_GET['no'])) {
    $no = $_GET['no'];

    // Menyiapkan dan menjalankan query SQL untuk menghapus data dari tabel 'kontak'
    $sql = "DELETE FROM kontak WHERE no = $no";

    if ($conn->query($sql) === TRUE) {
        $message = "Data berhasil dihapus.";
        header("Location: Tampil.php?message=" . urlencode($message));
        exit();
        
    } else {
        $error = "Terjadi kesalahan saat menghapus data: " . $conn->error;
        // Redirect ke halaman Tampil.php dengan pesan kesalahan
        header("Location: Tampil.php?error=" . urlencode($error));
        exit();
    }
}

// Menutup koneksi ke database



