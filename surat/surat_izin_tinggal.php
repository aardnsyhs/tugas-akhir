<div class="card card-dark">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fa fa-table"></i> Laporan Izin Tinggal
        </h3>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIK</th>
                        <th>Nama Penduduk</th>
                        <th>Jenis Kelamin</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $sql = $koneksi->query("SELECT * FROM `penduduk` JOIN `surat_izin_tinggal_temp` ON `penduduk`.id_penduduk = `surat_izin_tinggal_temp`.id_penduduk");
                    foreach ($sql as $data_izin_tinggal) : ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $data_izin_tinggal['nik_penduduk'] ?></td>
                            <td><?= $data_izin_tinggal['nama_penduduk'] ?></td>
                            <td><?= $data_izin_tinggal['jenis_kelamin_penduduk'] ?></td>
                            <td>
                                <a href="?page=detail_laporan_izin_tinggal&id_penduduk=<?= $data_izin_tinggal['id_penduduk']; ?>" title="Detail" class="btn btn-info btn-sm">
                                    <i class="fa fa-user"></i>
                                </a>
                                <a href="?page=edit_laporan_izin_tinggal&id_penduduk=<?= $data_izin_tinggal['id_penduduk']; ?>" title="Ubah" class="btn btn-warning btn-sm">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="?page=proses_izin_tinggal&id_penduduk=<?= $data_izin_tinggal['id_penduduk']; ?>" title="Setujui" class="btn btn-success btn-sm">
                                    <i class="fa fa-check"></i>
                                </a>
                            </td>
                        <?php endforeach; ?>
                </tbody>
                </tfoot>
            </table>
        </div>
    </div>
</div>