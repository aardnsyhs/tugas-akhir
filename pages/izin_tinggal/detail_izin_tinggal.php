<?php
$get_id_penduduk = $_GET['id_penduduk'];
$query = "SELECT * FROM `penduduk` JOIN `surat_izin_tinggal` ON `penduduk`.id_penduduk = `surat_izin_tinggal`.id_penduduk WHERE `surat_izin_tinggal`.id_penduduk = '$get_id_penduduk'";
$hasil = mysqli_query($koneksi, $query);
$data_izin_tinggal = array();
while ($row = mysqli_fetch_assoc($hasil)) {
    $data_izin_tinggal[] = $row;
}
?>
<h2>Detail Data Izin Tinggal Penduduk</h2>
<table class="table table-striped">
    <tr>
        <th width="22%">NIK</th>
        <td width="1%">:</td>
        <td><?= $data_izin_tinggal[0]['nik_penduduk'] ?></td>
    </tr>
    <tr>
        <th>Nama Penduduk Izin Tinggal</th>
        <td>:</td>
        <td><?= $data_izin_tinggal[0]['nama_penduduk'] ?></td>
    </tr>
    <tr>
        <th>Alamat Baru</th>
        <td>:</td>
        <td><?= $data_izin_tinggal[0]['alamat'] ?></td>
    </tr>
    <tr>
        <th>RT Baru</th>
        <td>:</td>
        <td><?= $data_izin_tinggal[0]['rt'] ?></td>
    </tr>
    <tr>
        <th>RW Baru</th>
        <td>:</td>
        <td><?= $data_izin_tinggal[0]['rw'] ?></td>
    </tr>
    <tr>
        <th>Desa Kelurahan Baru</th>
        <td>:</td>
        <td><?= $data_izin_tinggal[0]['kelurahan'] ?></td>
    </tr>
    <tr>
        <th>Kecamatan Baru</th>
        <td>:</td>
        <td>
            <?= $data_izin_tinggal[0]['kecamatan'] ?>
        </td>
    </tr>
    <tr>
        <th>Kabupaten Kota Baru</th>
        <td>:</td>
        <td><?= $data_izin_tinggal[0]['kota'] ?></td>
    </tr>
    <tr>
        <th>Provinsi Baru</th>
        <td>:</td>
        <td><?= $data_izin_tinggal[0]['provinsi_penduduk'] ?></td>
    </tr>
</table>
<a href="index.php?page=izin_tinggal" class="btn btn-warning">
    <i class="fa-solid fa-xmark"></i>
    Kembali
</a>