<div class="card card-dark">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fa fa-table"></i> Data Kematian
        </h3>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <div>
                <a href="?page=tambah_kematian" class="btn btn-primary">
                    <i class="fa fa-edit"></i> Tambah Data</a>
            </div>
            <br>
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIK</th>
                        <th>Nama Penduduk Meninggal</th>
                        <th>Jenis Kelamin</th>
                        <th>Usia Saat Meninggal</th>
                        <th>Penyebab Meninggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $sql = $koneksi->query("SELECT * FROM `penduduk` JOIN `surat_kematian` ON `penduduk`.id_penduduk = `surat_kematian`.id_penduduk");
                    function hitungUsia($tanggal_lahir, $tanggal_kematian)
                    {
                        $lahir = new DateTime($tanggal_lahir);
                        $kematian = new DateTime($tanggal_kematian);
                        $usia = $lahir->diff($kematian);
                        return $usia->y;
                    }
                    foreach ($sql as $data_kematian) :
                        $tanggal_lahir = $data_kematian['tanggal_lahir_penduduk'];
                        $tanggal_kematian = $data_kematian['tanggal_kematian'];
                    ?>
                        <tr>
                            <td><?= $no ?></td>
                            <td><?= $data_kematian['nik_penduduk'] ?></td>
                            <td><?= $data_kematian['nama_penduduk'] ?></td>
                            <td><?= $data_kematian['jenis_kelamin_penduduk'] ?></td>
                            <td><?= hitungUsia($tanggal_lahir, $tanggal_kematian) ?></td>
                            <td><?= $data_kematian['penyebab_kematian'] ?></td>
                            <td>
                                <a href="?page=detail_kematian&id_penduduk=<?= $data_kematian['id_penduduk']; ?>" title="Detail" class="btn btn-info btn-sm">
                                    <i class="fa fa-user"></i>
                                </a>
                                <a href="?page=edit_kematian&id_penduduk=<?= $data_kematian['id_penduduk']; ?>" title="Ubah" class="btn btn-success btn-sm">
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