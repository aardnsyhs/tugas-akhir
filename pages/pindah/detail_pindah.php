<?php
$get_id_penduduk = $_GET['id_penduduk'];
$query = "SELECT * FROM `penduduk` JOIN `surat_pindah` ON `penduduk`.id_penduduk = `surat_pindah`.id_penduduk WHERE `surat_pindah`.id_penduduk = '$get_id_penduduk'";
$hasil = mysqli_query($koneksi, $query);
$data_pindah = array();
while ($row = mysqli_fetch_assoc($hasil)) {
    $data_pindah[] = $row;
}
?>
<h2>Detail Data Pindah Penduduk</h2>
<table class="table table-striped">
    <tr>
        <th width="22%">NIK</th>
        <td width="1%">:</td>
        <td><?= $data_pindah[0]['nik_penduduk'] ?></td>
    </tr>
    <tr>
        <th>Nama Penduduk Pindah</th>
        <td>:</td>
        <td><?= $data_pindah[0]['nama_penduduk'] ?></td>
    </tr>
    <tr>
        <th>Alamat Baru</th>
        <td>:</td>
        <td><?= $data_pindah[0]['alamat_penduduk'] ?></td>
    </tr>
    <tr>
        <th>RT Baru</th>
        <td>:</td>
        <td><?= $data_pindah[0]['rt_penduduk']?></td>
    </tr>
    <tr>
        <th>RW Baru</th>
        <td>:</td>
        <td><?= $data_pindah[0]['rw_penduduk'] ?></td>
    </tr>
    <tr>
        <th>Desa Kelurahan Baru</th>
        <td>:</td>
        <td><?= $data_pindah[0]['desa_kelurahan_penduduk'] ?></td>
    </tr>
    <tr>
        <th>Kecamatan Baru</th>
        <td>:</td>
        <td>
            <?= $data_pindah[0]['kecamatan_penduduk'] ?>
        </td>
    </tr>
    <tr>
        <th>Kabupaten Kota Baru</th>
        <td>:</td>
        <td><?= $data_pindah[0]['kabupaten_kota_penduduk'] ?></td>
    </tr>
    <tr>
        <th>Provinsi Baru</th>
        <td>:</td>
        <td><?= $data_pindah[0]['provinsi_penduduk'] ?></td>
    </tr>
    <tr>
        <th>Alasan Pindah</th>
        <td>:</td>
        <td><?= $data_pindah[0]['alasan_pindah'] ?></td>
    </tr>
</table>
<a href="index.php?page=pindah" class="btn btn-warning">
    <i class="fa-solid fa-xmark"></i>
    Kembali
</a>