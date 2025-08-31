<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>
    <link rel="stylesheet" href="<?= base_url('css/page.css');?>">
</head>
<body>

<div class="container">
    <div class="card">
        <div class="card-header">
            <h1>Detail Data Mahasiswa</h1>
        </div>
        <div class="card-body">
            <?php if (!empty($mahasiswa)): ?>
            <!-- Data Table -->
            <div class="table-container">
                 <form method="post" action="<?= base_url('mahasiswa/add');?>">
                <div class="form-group">
                    <label for="">NIM : </label>
                     <?= esc($mahasiswa['nim']); ?>
                </div>
                <div class="form-group">
                    <label for="">Nama : </label>
                     <?= esc($mahasiswa['nama']); ?>
                </div>
                <div class="form-group">
                    <label for="">Umur : </label>
                    <?= esc($mahasiswa['umur']); ?>
                </div>
                <div class="form-actions">
                    <a href="<?= base_url('/'); ?>" class="btn btn-danger">Kembali</a>
                </div>
            </form>
            </div>
        </div>
        <?php else: ?>
    <div class="alert alert-danger" role="alert">
        Data tidak dapat ditemukan.
    </div>
    <?php endif; ?>
        <div class="card-footer">
            Mission 2 Proyek 3 - M Naufal Alfarizky 2025
        </div>
    </div>
</div>

</body>
</html>