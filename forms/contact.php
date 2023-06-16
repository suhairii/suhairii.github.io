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

// Memeriksa apakah request menggunakan metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil data dari form
    $name = $_POST["name"];
    $email = $_POST["email"];
    $subject = $_POST["subject"];
    $message = $_POST["message"];

    // Menyiapkan dan menjalankan query SQL untuk memasukkan data ke dalam tabel 'kontak'
    $sql = "INSERT INTO kontak (name, email, subject, message) VALUES ('$name', '$email', '$subject', '$message')";

    if ($conn->query($sql) === TRUE) {
        echo "Pesan Berhasil Terkirim.";
        
  } else {
      echo "Pesan tidak dapat dikirim.";
  }
}

// Menutup koneksi ke database
$conn->close();
?>
