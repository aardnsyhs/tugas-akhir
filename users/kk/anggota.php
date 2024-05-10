<?php
if (isset($_GET['no_kk'])) {
    $encoded_no_kk = $_GET['no_kk'];
    $no_kk = base64_decode($encoded_no_kk);

    $sql_cek = "SELECT * FROM `kk` JOIN `penduduk` ON kk.id_penduduk=penduduk.id_penduduk WHERE no_kk='$no_kk'";
    $query_cek = mysqli_query($koneksi, $sql_cek);
    $data_cek = mysqli_fetch_array($query_cek, MYSQLI_BOTH);
    $karkel = $data_cek['no_kk'];
}
?>
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fa fa-users mr-2"></i>Anggota Kartu Keluarga
        </h3>
    </div>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="card-body">
            <input type='hidden' class="form-control" id="id_kk" name="id_kk" value="<?= $data_cek['id_kk']; ?>" disabled />
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">No KK | Kepala Keluarga</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="no_kk" name="no_kk" value="<?= $data_cek['no_kk']; ?>" disabled />
                </div>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="kepala" name="kepala" value="<?= $data_cek['k_keluarga']; ?>" disabled />
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Alamat</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" value="<?= $data_cek['alamat_penduduk']; ?>, RT <?= $data_cek['rt_penduduk']; ?> RW <?= $data_cek['rw_penduduk']; ?> (<?= $data_cek['kecamatan_penduduk']; ?> - <?= $data_cek['kabupaten_kota_penduduk']; ?> - <?= $data_cek['provinsi_penduduk']; ?>)" disabled />
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>NIK</th>
                                <th>Nama</th>
                                <th>Jenis Kelamin</th>
                                <th>Hubungan Keluarga</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = $koneksi->query("SELECT p.nik_penduduk, p.nama_penduduk, p.jenis_kelamin_penduduk, a.hub_keluarga, a.id_anggota 
                            FROM penduduk p 
                            JOIN anggota_keluarga a ON p.id_penduduk = a.id_penduduk
                            WHERE a.id_kk IN (SELECT id_kk FROM kk WHERE no_kk = '$karkel')
                            AND p.status = 'Ada'");
                            while ($data = $sql->fetch_assoc()) {
                            ?>
                                <tr>
                                    <td>
                                        <?= $data['nik_penduduk']; ?>
                                    </td>
                                    <td>
                                        <?= $data['nama_penduduk']; ?>
                                    </td>
                                    <td>
                                        <?= $data['jenis_kelamin_penduduk']; ?>
                                    </td>
                                    <td>
                                        <?= $data['hub_keluarga']; ?>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </form>
</div>