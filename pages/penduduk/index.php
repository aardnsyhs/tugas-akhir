<?php
include "config/connection.php";
$hasil = mysqli_query($koneksi, "SELECT *, TIMESTAMPDIFF(YEAR, `tanggal_lahir_penduduk`, CURDATE()) AS usia_penduduk FROM `penduduk`");
$data_penduduk = [];
while ($row = mysqli_fetch_assoc($hasil)) {
    $data_penduduk[] = $row;
}
?>
<div class="card card-dark">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fa fa-table"></i>
            Data Penduduk
        </h3>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <div class="mb-3">
                <a href="?page=tambah_penduduk" class="btn btn-primary">
                    <i class="fa fa-edit"></i> Tambah Penduduk
                </a>
            </div>
            <table class="table table-striped table-condensed table-bordered table-hover" id="example1">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIK</th>
                        <th>Nama Penduduk</th>
                        <th>Jenis Kelamin</th>
                        <th>Usia</th>
                        <th>Pendidikan</th>
                        <th>Pekerjaan</th>
                        <th>Kawin</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $nomor = 1; ?>
                    <?php foreach ($data_penduduk as $penduduk) : ?>
                        <tr>
                            <td><?= $nomor++ ?></td>
                            <td><?= $penduduk['nik_penduduk'] ?></td>
                            <td><?= $penduduk['nama_penduduk'] ?></td>
                            <td><?= $penduduk['jenis_kelamin_penduduk'] ?></td>
                            <td><?= $penduduk['usia_penduduk'] ?></td>
                            <td><?= $penduduk['pendidikan_terakhir_penduduk'] ?></td>
                            <td><?= $penduduk['pekerjaan_penduduk'] ?></td>
                            <td><?= $penduduk['status_perkawinan_penduduk'] ?></td>
                            <td>
                                <a href="?page=detail_penduduk&id_penduduk=<?= $penduduk['id_penduduk']; ?>" title="Detail" class="btn btn-info btn-sm">
                                    <i class="fa fa-user"></i>
                                </a>
                                <a href="?page=edit_penduduk&id_penduduk=<?= $penduduk['id_penduduk']; ?>" title="Ubah" class="btn btn-success btn-sm">
                                    <i class="fa fa-edit"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>