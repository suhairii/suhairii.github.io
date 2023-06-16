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

// Mengambil data dari tabel 'kontak'
$sql = "SELECT * FROM kontak";
$result = $conn->query($sql);
$n = 1;
?>

<!DOCTYPE html>
<html>
<head>
	<title>Data Pesan</title>
	<!-- Tautan CSS Bootstrap 5 -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

	<style>
		body{
			font-family: "Open Sans", sans-serif;
		}
		
		.card {
			margin-bottom: 20px;
            
        }
		.table-title {
  text-align: left;
  margin-bottom: 20px;
  background: linear-gradient(#1a1814, #4a4844);
  color: #fff;
  padding: 10px;
}

.btn-primary {
  background-color: #cda45e;
  border-color: #cda45e;
}

.btn-danger {
  background-color: #cda45e;
  border-color: #cda45e;
}
		th{
			color:#1a1814;
		}
        td {
            color: #000;
        }
		.notification {
            padding: 10px;
            background-color: #5cb85c;
            color: #fff;
        }
	</style>
	
</head>

<body>
	<header>
    <div class="container">
            <h3 class="table-title">Data Masukan Dari Pelanggan</h3>
            <a href="index.html" class="btn btn-primary">Kembali ke Web</a> <!-- Tombol navigasi ke index.html -->
        </div>
	</header>
    <br>
	
	
	<div class="container">
	<?php
        // Menampilkan notifikasi jika ada pesan sukses dalam parameter URL
        if (isset($_GET['message'])) {
            $message = $_GET['message'];
            echo '<div class="notification"><i class="fas fa-check-circle"></i> ' . $message . '</div>';
        }

        // Menampilkan notifikasi jika ada pesan kesalahan dalam parameter URL
        if (isset($_GET['error'])) {
            $error = $_GET['error'];
            echo '<div class="notification" style="background-color: #d9534f;"><i class="fas fa-exclamation-circle"></i> ' . $error . '</div>';
        }
        ?>
		
		<table class="table table-sm table-bordered">
			<thead class="table-light">
				<tr>
					<th>No</th>
                
					<th>Nama</th>
					<th>Email</th>
					<th>Subjek</th>
					 <th>Pesan</th>
					 <th>Aksi</th> <!-- Kolom tambahan untuk tombol aksi -->
				</tr>
			</thead>
			<tbody>
				<?php       
				if ($result->num_rows > 0) {
					while($row = $result->fetch_assoc()) {
						echo "<tr>";
						echo "<td>".$row['no']."</td>";
						echo "<td>".$row['name']."</td>";
						echo "<td>".$row['email']."</td>";
						echo "<td>".$row['subject']."</td>";
						echo "<td>".$row['message']."</td>";
						echo "<td>
                        <a href='form-edit.php?no=".$row['no']."' class='btn btn-primary'>Edit</a> 
                        <a href='hapus.php?no=".$row['no']."' class='btn btn-danger'>Hapus</a>
							  </td>"; // Tombol edit dan hapus dengan kelas Bootstrap
						echo "</tr>";
					}
				} else {
					echo "<tr><td colspan='6'>Tidak ada data pesan</td></tr>";
				}
				?>
			</tbody>
		</table>
	</div>
	
	<!-- Tautan JavaScript Bootstrap 5 (Opsional) -->
	<script src="assets/js/main.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var elements = document.querySelectorAll(".container, .btn-primary, .btn-danger");
            elements.forEach(function(element) {
                element.classList.add("animate__animated", "animate__fadeIn");
            });
        });
    </script>
</body>
</html>

<?php
// Menutup koneksi ke database
$conn->close();
?>

