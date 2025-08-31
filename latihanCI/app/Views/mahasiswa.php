<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>
    <link rel="stylesheet" href="<?= base_url('css/style.css');?>">
</head>
<body>

<div class="container">
    <div class="card">
        <div class="card-header">
            <h1>Data Mahasiswa</h1>
        </div>
        <div class="card-body">
            <div class="action-row">
                <!-- Form untuk cari data -->
                <form action="<?= base_url('mahasiswa/cari'); ?>" method="get" class="search-form">
                    <input type="text" class="search-input" placeholder="Cari berdasarkan Nama atau NIM" name="keyword">
                    <button class="btn search-button" type="submit">Cari</button>
                </form>

                <!-- Tombol Tambah -->
                <div>
                    <a href="<?= base_url('mahasiswa/tambah');?>" class="btn btn-success">Tambah Data</a>
                </div>
 
            </div>

            <!-- Data Table -->
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>Umur</th>
                            <th class="text-center">Detail</th>
                            <th class="text-center">Edit</th>
                            <th class="text-center">Hapus</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php  $i=1; foreach($getMahasiswa as $isi){?>
                        <tr>
                            <td><?=$i;?></td>
                            <td><?= $isi['nim'];?></td>
                            <td><?= $isi['nama'];?></td>
                            <td><?= $isi['umur'];?></td>
                            <td class="text-center" >
                                <a href="<?= base_url('mahasiswa/detail/'.$isi['id']);?>?>" class="btn btn-info">Detail</a>
                            </td>
                            <td class="text-center" >
                                <a href="<?= base_url('mahasiswa/edit/'.$isi['id']);?>" class="btn btn-warning">Edit</a>
                            </td>
                            <td class="text-center" >
                                <a href="<?=base_url('mahasiswa/hapus/'.$isi['id']);?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')" class="btn btn-danger">Hapus</a>
                            </td>
                        </tr>
                        <?php $i = $i +1; }?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            Mission 2 Proyek 3 - M Naufal Alfarizky 2025
        </div>
    </div>
</div>

</body>
</html>