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

    //Query ambil semua data Mahasiswa
    if ($nim) {
        // Gunakan prepared statement
        $stmt = $conn->prepare("SELECT nim, nama, umur FROM mahasiswa WHERE nim = ?");
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
    <title>Detail Data Mahasiswa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <a href="display_dan_detail.php" class="btn-secondary">← Kembali</a>
    
    <h2>Detail Data Mahasiswa</h2>

    <?php 
        if ($result->num_rows > 0):
            $row = $result->fetch_assoc(); 
    ?>

    <div class="detail-container">
        <div class="detail-item">
            <strong>NIM:</strong> <?= htmlspecialchars($row['nim']); ?>
        </div>
        <div class="detail-item">
            <strong>Nama:</strong> <?= htmlspecialchars($row['nama']); ?>
        </div>
        <div class="detail-item">
            <strong>Umur:</strong> <?= htmlspecialchars($row['umur']); ?> tahun
        </div>
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