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

    //Query ambil semua data Mahasiswa
    $sql = "SELECT nim, nama, umur FROM mahasiswa ORDER BY nim ASC";
    $result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Mahasiswa</title>
</head>
<body>
    <h2>Daftar Mahasiswa</h2>

    <?php if($result->num_rows > 0): ?>
        <table border="1", cellpadding="5", cellspacing="0"  >
            <tr>
                <th>NIM</th>
                <th>NAMA</th>
                <th>UMUR</th>
            </tr>
            <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['nim'];  ?></td>
                <td><?= $row['nama'];  ?></td>
                <td><?= $row['umur'];  ?></td>
            </tr>
            <?php endwhile; ?>
        </table>
        <?php else: ?>
            <p>Tidak ada Data Mahasiswa.</p>
        <?php endif; ?>
</body>
</html>
<?php $conn->close(); ?>