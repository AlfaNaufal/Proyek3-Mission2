<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>
    <link rel="stylesheet" href="<?= base_url(relativePath: 'css/page.css');?>">
</head>
<body>
    
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h1>Edit Data Mahasiswa</h1>
            </div>
        <a href="<?= base_url('/'); ?>" class="btn btn-danger">Kembali</a>
        <div class="card-body">

            <!-- Data Table -->
            <div class="table-container">

            <form method="post" action="<?= base_url('mahasiswa/update');?>">
                <input type="hidden" name="id" value="<?= $mahasiswa['id'] ?>">
                <div class="form-group">
                    <label for=""><b>NIM</b></label>
                    <input readonly type="number" name="nim" value="<?= $mahasiswa['nim'] ?>" minlength="1" maxlength="11"class="form-control" required>
                </div>
                <div class="form-group">
                    <label for=""><b>Nama</b></label>
                     <input type="text" name="nama"value="<?= $mahasiswa['nama'] ?>" minlength="1" maxlength="25" class="form-control" required>
                </div>
                <div class="form-group" >
                    <label for=""><b>Umur</b></label>
                    <input type="number" name="umur" value="<?= $mahasiswa['umur'] ?>" minlength="1" maxlength="3"class="form-control" required>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
            </div>
        </div>
        <div class="card-footer">
            Mission 2 Proyek 3 - M Naufal Alfarizky 2025
        </div>
    </div>
</div>

</body>
</html>