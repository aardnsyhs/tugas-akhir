<div class="card card-dark">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fa fa-table"></i> Data Pindah
        </h3>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <div>
                <a href="?page=tambah_pindah" class="btn btn-primary">
                    <i class="fa fa-edit"></i> Tambah Data</a>
            </div>
            <br>
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIK</th>
                        <th>Nama Penduduk Pindah</th>
                        <th>Jenis Kelamin</th>
                        <th>Alamat Asal</th>
                        <th>Alamat Tujuan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $sql = $koneksi->query("SELECT * FROM `penduduk` JOIN `surat_pindah` ON `penduduk`.id_penduduk = `surat_pindah`.id_penduduk");
                    foreach ($sql as $data_pindah) :
                    ?>
                        <tr>
                            <td><?= $no ?></td>
                            <td><?= $data_pindah['nik_penduduk'] ?></td>
                            <td><?= $data_pindah['nama_penduduk'] ?></td>
                            <td><?= $data_pindah['jenis_kelamin_penduduk'] ?></td>
                            <td><?= $data_pindah['alamat_asal'] ?></td>
                            <td><?= $data_pindah['alamat_tujuan'] ?></td>
                            <td>
                                <a href="?page=detail_kematian&id_penduduk=<?= $data_pindah['id_penduduk']; ?>" title="Detail" class="btn btn-info btn-sm">
                                    <i class="fa fa-user"></i>
                                </a>
                                <a href="?page=edit_kematian&id_penduduk=<?= $data_pindah['id_penduduk']; ?>" title="Ubah" class="btn btn-success btn-sm">
                                    <i class="fa fa-edit"></i>
                                </a>
                            </td>
                        <?php endforeach; ?>
                </tbody>
                </tfoot>
            </table>
        </div>
    </div>
</div>