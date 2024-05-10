<?php
$nik = $_SESSION['username'];

$query = "SELECT ak.id_kk FROM anggota_keluarga ak
          JOIN kk k ON ak.id_kk = k.id_kk
          WHERE ak.id_penduduk IN (SELECT id_penduduk FROM penduduk WHERE nik_penduduk = '$nik')";

$result = mysqli_query($koneksi, $query);
$row = mysqli_fetch_assoc($result);
$id_kk = $row['id_kk'];

$query_anggota = "SELECT ak.*, p.nik_penduduk, p.nama_penduduk
                  FROM anggota_keluarga ak
                  JOIN penduduk p ON ak.id_penduduk = p.id_penduduk
                  WHERE ak.id_kk = '$id_kk'";

$result_anggota = mysqli_query($koneksi, $query_anggota);
?>
<h3>A. Tambah Laporan Kematian</h3>
<table class="table table-striped table-middle">
    <form action="" method="post">
        <tr>
            <th width="20%">Anggota Keluarga</th>
            <td width="1%">:</td>
            <td>
                <select name="id_penduduk" id="id_penduduk" class="form-control select2bs4" required>
                    <option selected="selected">- Pilih Anggota Keluarga -</option>
                    <?php
                    while ($row_anggota = mysqli_fetch_array($result_anggota)) {
                        $id_penduduk_anggota = $row_anggota['id_penduduk'];
                        $nik_anggota = $row_anggota['nik_penduduk'];
                        $nama_anggota = $row_anggota['nama_penduduk'];
                    ?>
                        <option value="<?= $id_penduduk_anggota ?>">
                            <?= $nik_anggota ?>
                            -
                            <?= $nama_anggota ?>
                        </option>
                    <?php
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <th>Tanggal Kematian</th>
            <td>:</td>
            <td><input type="date" class="form-control" name="tanggal_kematian" id="tanggal_kematian" required></td>
        </tr>
        <tr>
            <th>Jam Kematian</th>
            <td>:</td>
            <td><input type="time" class="form-control" name="jam_kematian" id="jam_kematian" required></td>
        </tr>
        <tr>
            <th>Tempat Kematian</th>
            <td>:</td>
            <td><input type="text" class="form-control" name="tempat_kematian" id="tempat_kematian" required></td>
        </tr>
        <tr>
            <th>Penyebab Kematian</th>
            <td>:</td>
            <td><input type="text" class="form-control" name="penyebab_kematian" id="penyebab_kematian" required></td>
        </tr>
        <tr>
            <th>Bin/Binti</th>
            <td>:</td>
            <td><input type="text" class="form-control" name="bin_binti" id="bin_binti" required></td>
        </tr>
</table>
<button type="submit" class="btn btn-primary" name="simpan">
    <i class="fa-solid fa-floppy-disk"></i>
    Laporkan
</button>
</form>