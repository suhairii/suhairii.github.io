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

// Mendapatkan nilai 'no' dari parameter URL
$no = $_GET['no'];

// Menampilkan data pesan berdasarkan nomor yang dipilih
$sql = "SELECT * FROM kontak WHERE no = $no";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

// Mengupdate data pesan jika tombol 'Update' ditekan
if(isset($_POST['update'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Query untuk mengupdate data pesan
    $updateSql = "UPDATE kontak SET name='$name', email='$email', subject='$subject', message='$message' WHERE no = $no";

    if ($conn->query($updateSql) === TRUE) {
        $message = "Data Berhasil di Update.";
        header("Location: Tampil.php?message=" . urlencode($message));
        exit();
    } else {
        echo "Error: " . $updateSql . "<br>" . $conn->error;
    }
}

// Menutup koneksi ke database
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Form Edit Data</title>
    <!-- Tautan CSS Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css">
    <style>
        .container {
            margin-top: 50px;
        }

        h3 {
            text-align: center;
        }

        form {
            margin-top: 30px;
        }

        .btn-primary {
            background-color: #cda45e;
            border-color: #cda45e;
        }

        .btn-secondary {
            background-color: #cda45e;
            border-color: #cda45e;
            margin-left: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h3>Edit Data</h3>
        <form method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Nama</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $row['name']; ?>">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $row['email']; ?>">
            </div>
            <div class="mb-3">
                <label for="subject" class="form-label">Subjek</label>
                <input type="text" class="form-control" id="subject" name="subject" value="<?php echo $row['subject']; ?>">
            </div>
            <div class="mb-3">
                <label for="message" class="form-label">Pesan</label>
                <textarea class="form-control" id="message" name="message"><?php echo $row['message']; ?></textarea>
            </div>
            <button type="submit" name="update" class="btn btn-primary">Update</button>
            <a href="Tampil.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>

    <!-- Tautan JavaScript Bootstrap 5 (Opsional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
