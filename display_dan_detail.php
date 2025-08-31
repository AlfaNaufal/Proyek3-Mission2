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

    //Query Hapus data Mahasiswa
    if (isset($_GET['delete'])) {
        $nimDel = $_GET['delete'];
        $sqlDel = "DELETE FROM mahasiswa WHERE nim='$nimDel'";

        if ($conn->query($sqlDel) === TRUE) {
            echo "<script>
                    alert('Data berhasil dihapus!');
                    window.location.href = 'display_dan_detail.php';
                </script>";
            exit;
        } else {
            echo "<script>
                    alert('Gagal menghapus data: " . $conn->error . "');
                </script>";
        }
    }

    
    //Query ambil data Mahasiswa yang dicari
    if(isset($_GET['search'])){
        $cari = $_GET['search'];
        $sql = "SELECT nim, nama, umur FROM mahasiswa WHERE nama LIKE '%$cari%'";
    }else{
        //Query ambil semua data Mahasiswa
        $sql = "SELECT nim, nama, umur FROM mahasiswa ORDER BY nim ASC";

    }
    
    $result = $conn->query($sql);
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Mahasiswa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Data Mahasiswa</h2>

        <div class="search-container">
            <form method="get" action="" class="search-form">
                <label for="search"><b>Search</b></label>
                <input type="text" name="search" id="search" placeholder="Ketik Nama Disini" value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
                <button type="submit">Cari</button>
            </form>
        </div>

        <a href="insertData.php" class="add-data-btn">Tambah Data</a>
        
        <?php if($result->num_rows > 0): ?>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>NIM</th>
                            <th>NAMA</th>
                            <th>UMUR</th>
                            <th>Detail</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['nim']); ?></td>
                            <td><?= htmlspecialchars($row['nama']); ?></td>
                            <td><?= htmlspecialchars($row['umur']); ?></td>
                            <td>
                                <a href="displayDetail.php?nim=<?= urlencode($row['nim']);?>" class="action-btn btn-view">View Data</a>
                            </td>
                            <td>
                                <a href="editData.php?nim=<?= urlencode($row['nim']);?>" class="action-btn btn-edit">Edit Data</a>
                            </td>
                            <td>
                                <a href="display_dan_detail.php?delete=<?= urlencode($row['nim']); ?>" 
                                   class="action-btn btn-delete"
                                   onclick="return confirm('Yakin ingin menghapus data <?= htmlspecialchars($row['nama']); ?> (<?= htmlspecialchars($row['nim']); ?>) ?')">
                                   Hapus Data
                                </a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="no-data">
                <p>Tidak ada Data Mahasiswa.</p>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
<?php $conn->close(); ?>