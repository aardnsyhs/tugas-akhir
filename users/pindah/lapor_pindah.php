<?php
$sql = "SELECT * FROM penduduk WHERE nama_penduduk='$data_nama'";
$cek_penduduk = mysqli_query($koneksi, $sql);
$hasil_penduduk = mysqli_fetch_assoc($cek_penduduk);
$alamat_penduduk = $hasil_penduduk['alamat_penduduk'] . ", " . "Rt: " . $hasil_penduduk['rt_penduduk'] . "/" .
    $hasil_penduduk['rw_penduduk'] . ", " . $hasil_penduduk['desa_kelurahan_penduduk'] . ", " .
    $hasil_penduduk['kecamatan_penduduk'] . ", " . $hasil_penduduk['kabupaten_kota_penduduk'] . ", " .
    $hasil_penduduk['provinsi_penduduk'];
?>
<h3>A. Alamat Asal</h3>
<form action="" method="POST">
    <table class="table table-striped table-middle">
        <tr>
            <th width="20%">Nama Penduduk</th>
            <td width="1%">:</td>
            <td><input type="text" class="form-control" name="nama_penduduk" value="<?= $data_nama ?>" readonly></td>
        </tr>
        <tr>
            <th width="20%">Alamat Penduduk lama</th>
            <td width="1%">:</td>
            <td><input type="text" class="form-control" name="alamat_penduduk" value="<?= $alamat_penduduk ?>" readonly></input></td>
        </tr>
    </table>
    <h3>B. Alamat Tujuan</h3>
    <table class="table table-striped table-middle">
        <tr>
            <th width="20%">Alamat Penduduk Baru</th>
            <td width="1%">:</td>
            <td><input type="text" class="form-control" name="alamat_baru"></td>
        </tr>
        <tr>
            <th>RT</th>
            <td>:</td>
            <td><input type="text" class="form-control" name="rt_baru"></td>
        </tr>
        <tr>
            <th>RW</th>
            <td>:</td>
            <td><input type="text" class="form-control" name="rw_baru"></td>
        </tr>
        <tr>
            <th>Desa/Kelurahan</th>
            <td>:</td>
            <td><input type="text" class="form-control" name="desa_kelurahan_baru"></td>
        </tr>
        <tr>
            <th>Kecamatan</th>
            <td>:</td>
            <td><input type="text" class="form-control" name="kecamatan_baru"></td>
        </tr>
        <tr>
            <th>Kabupaten/Kota</th>
            <td>:</td>
            <td><input type="text" class="form-control" name="kabupaten_kota_baru"></td>
        </tr>
        <tr>
            <th>Provinsi</th>
            <td>:</td>
            <td><input type="text" class="form-control" name="provinsi_baru"></td>
        </tr>
        <tr>
    </table>
    <h3>C. Keperluan</h3>
    <table class="table table-striped table-middle">
        <tr>
            <th width="20%">Alasan Pindah</th>
            <td width="1%">:</td>
            <td><input type="text" class="form-control" name="alasan_pindah"></td>
        </tr>
        <tr>
            <td>
                <div class="form-group row">
                    <label class="col-form-label">Anggota Keluarga</label>
                    <div class="w-100 d-flex">
                        <select name="id_pend" id="id_pend" class="form-control select2bs4" required>
                            <option selected="selected">- Anggota Keluarga -</option>
                            <?php
                            $query = "SELECT * FROM `penduduk`";
                            $hasil = mysqli_query($koneksi, $query);
                            while ($row = mysqli_fetch_array($hasil)) {
                            ?>
                                <option value="<?= $row['id_penduduk'] ?>">
                                    <?= $row['nik_penduduk'] ?>
                                    -
                                    <?= $row['nama_penduduk'] ?>
                                </option>
                            <?php
                            }
                            ?>
                        </select>
                        <input type="submit" name="Simpan" value="Tambah" class="btn btn-primary ml-5">
                    </div>
                </div>
            </td>
        </tr>
        <table class="table table-striped table-condensed table-middle table-hover mt-2 align-items-center justify-content-center mx-auto">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIK</th>
                    <th>Nama Lengkap</th>
                </tr>
            </thead>
            <tbody>
                <?php $nomor = 1; ?>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </table>
    <button type="submit" class="btn btn-primary" name="Laporkan">
        <i class="fa-solid fa-floppy-disk"></i>
        Laporkan
    </button>
</form>
<?php
if (isset($_POST['Laporkan'])) {
    $rt_baru = $_POST['rt_baru'];
    $rw_baru = $_POST['rw_baru'];
    $desa_kelurahan_baru = $_POST['desa_kelurahan_baru'];
    $kecamatan_baru = $_POST['kecamatan_baru'];
    $kabupaten_kota_baru = $_POST['kabupaten_kota_baru'];
    $provinsi_baru = $_POST['provinsi_baru'];
    $alasan_pindah = $_POST['alasan_pindah'];
}
