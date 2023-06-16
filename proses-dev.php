<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "delivery";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $database);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Memeriksa apakah data telah dikirim melalui metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil nilai dari inputan formulir
    $nama = $_POST["nama"];
    $email = $_POST["email"];
    $no_hp = $_POST["no_hp"];
    $tanggal = $_POST["tanggal"];
    $alamat = $_POST["alamat"];
    $jumlah = $_POST["jumlah"];
    $catatan = $_POST["catatan"];

    // Menyiapkan pernyataan SQL untuk memasukkan data ke dalam tabel 'delivery'
    $sql = "INSERT INTO delivery (nama, email, no_hp, tanggal, alamat, jumlah, catatan)
            VALUES ('$nama', '$email', '$no_hp', '$tanggal', '$alamat', '$jumlah', '$catatan')";

    if ($conn->query($sql) === true) {
        echo "Data berhasil disimpan";
    } else {
        echo "Terjadi kesalahan: " . $conn->error;
    }
}

// Menutup koneksi
$conn->close();
?>
