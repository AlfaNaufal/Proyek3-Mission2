<?php 
    // Konfigurasi KOneksi 
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "akademik_db";

    // Koneksi Database
    $conn = new mysqli($host, $user, $pass, $db);

    //cek konekai
    if($conn->connect_error){
        die("Koneksi Gagal: " . $conn->connect_error);
    }

    $message = '';
    $messageType = '';

    //Query Insert Data Mahasiswa
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nim = $_POST['nim'] ?? '';
        $nama = $_POST['nama'] ?? '';
        $umur = $_POST['umur'] ?? '';

        $stmt = $conn->prepare("INSERT INTO mahasiswa (nim, nama, umur) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $nim, $nama, $umur);

        if ($stmt->execute()) {
            echo "<script>
                    alert('Data berhasil disimpan!');
                    window.location.href = 'display_dan_detail.php';
                  </script>";
            exit;
        } else {
            $message = "Gagal menyimpan data: " . $conn->error;
            $messageType = "danger";
        }
        $stmt->close();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Mahasiswa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <a href="display_dan_detail.php" class="btn-secondary">← Kembali</a>

    <h2>Tambah Data Mahasiswa</h2>

    <?php if($message): ?>
        <div class="alert alert-<?= $messageType; ?>">
            <?= htmlspecialchars($message); ?>
        </div>
    <?php endif; ?>

    <div class="form-container">
        <form method="post" action="">
            <div class="form-group">
                <label for="nim">NIM:</label>
                <input id="nim" type="text" name="nim" placeholder="Masukkan NIM" required>
            </div>
                
            <div class="form-group">
                <label for="nama">Nama:</label>
                <input id="nama" type="text" name="nama" placeholder="Masukkan Nama" required>
            </div>

            <div class="form-group">
                <label for="umur">Umur:</label>
                <input id="umur" type="number" name="umur" placeholder="Masukkan Umur" required>
            </div>

            <button type="submit" class="btn-primary">Simpan Data</button>
        </form>
    </div>

</div>

</body>
</html>
<?php $conn->close(); ?>