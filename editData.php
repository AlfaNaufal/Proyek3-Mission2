<?php 
    // Konfigurasi KOneksi 
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "akademik_db";
    $nim = $_GET['nim'] ?? null;

    // Koneksi Database
    $conn = new mysqli($host, $user, $pass, $db);

    //cek konekai
    if($conn->connect_error){
        die("Koneksi Gagal: " . $conn->connect_error);
    }

    $message = '';
    $messageType = '';

    //Query Update Data Mahasiswa
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nim = $_POST['nim'] ?? '';
        $nama = $_POST['nama'] ?? '';
        $umur = $_POST['umur'] ?? '';

        $stmt = $conn->prepare("UPDATE mahasiswa SET nama=?, umur=? WHERE nim=?");
        $stmt->bind_param("sis", $nama, $umur, $nim);
        
        if ($stmt->execute()) {
            $message = "Data berhasil diperbarui!";
            $messageType = "success";
        } else {
            $message = "Error: " . $conn->error;
            $messageType = "danger";
        }
        $stmt->close();
    }

    //Query ambil semua data Mahasiswa
    if ($nim) {
        $stmt = $conn->prepare("SELECT nim, nama, umur FROM mahasiswa WHERE nim=?");
        $stmt->bind_param("s", $nim);
        $stmt->execute();
        $result = $stmt->get_result();
    } else {
        die("NIM tidak diberikan di URL");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Mahasiswa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <a href="display_dan_detail.php" class="btn-secondary">← Kembali</a>

    <h2>Edit Data Mahasiswa</h2>

    <?php if($message): ?>
        <div class="alert alert-<?= $messageType; ?>">
            <?= htmlspecialchars($message); ?>
        </div>
    <?php endif; ?>

    <?php 
        if ($result->num_rows > 0):
            $coll = $result->fetch_assoc(); 
    ?>
    
    <div class="form-container">
        <form method="post" action="">
            <div class="form-group">
                <label for="nim">NIM:</label>
                <input readonly id="nim" type="text" name="nim" value="<?= htmlspecialchars($coll['nim']); ?>">
            </div>
                
            <div class="form-group">
                <label for="nama">Nama:</label>
                <input id="nama" type="text" name="nama" value="<?= htmlspecialchars($coll['nama']); ?>" required>
            </div>

            <div class="form-group">
                <label for="umur">Umur:</label>
                <input id="umur" type="number" name="umur" value="<?= htmlspecialchars($coll['umur']); ?>" required>
            </div>

            <button type="submit" class="btn-primary">Simpan Perubahan</button>
        </form>
    </div>

    <?php else: ?>
        <div class="no-data">
            <p>Data mahasiswa tidak ditemukan.</p>
        </div>
    <?php endif; ?>

</div>

</body>
</html>
<?php $conn->close(); ?>