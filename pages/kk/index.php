<?php
include "config/connection.php";
$query = "SELECT * FROM `kk` JOIN `penduduk` ON kk.id_penduduk = penduduk.id_penduduk";
$hasil = mysqli_query($koneksi, $query);
$data_kk = [];
while ($row = mysqli_fetch_assoc($hasil)) $data_kk[] = $row;
?>
<div class="card card-dark">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fa fa-table"></i>
            Data Kartu Keluarga
        </h3>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <div class="mb-3">
                <a href="?page=tambah_kk" class="btn btn-primary">
                    <i class="fa fa-edit"></i> Tambah Kartu Keluarga
                </a>
            </div>
            <table class="table table-striped table-condensed table-hover" id="example1">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>No Kartu Keluarga</th>
                        <th>Kepala Keluarga</th>
                        <th>Alamat</th>
                        <th>Anggota KK</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $nomor = 1; ?>
                    <?php foreach ($data_kk as $kk) : ?>
                        <tr>
                            <td><?= $nomor++ ?></td>
                            <td><?= $kk['no_kk'] ?></td>
                            <td><?= $kk['k_keluarga'] ?></td>
                            <td><?= $kk['alamat_penduduk'] ?></td>
                            <td>
                                <a href="?page=anggota&id_kk=<?= $kk['id_kk'] ?>" title="Anggota KK" class="btn btn-info btn-sm">
                                    <i class="fa fa-users"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>