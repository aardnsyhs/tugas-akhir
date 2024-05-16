<?php
$get_id_penduduk = $_GET['id_penduduk'];
$query = "
    SELECT p.*, spt.*
    FROM penduduk p
    JOIN surat_pindah_temp spt ON p.id_penduduk = spt.id_penduduk
    WHERE p.id_penduduk = '$get_id_penduduk'
";
$hasil = mysqli_query($koneksi, $query);

if (!$hasil) {
    die('Error: ' . mysqli_error($koneksi));
}

$data_pindah = mysqli_fetch_all($hasil, MYSQLI_ASSOC);
if (count($data_pindah) == 0) {
    die('No data found for the given id_penduduk.');
}

$alamat_penduduk = $data_pindah[0]['alamat_penduduk'] . ", Rt: " . $data_pindah[0]['rt_penduduk'] . "/" .
    $data_pindah[0]['rw_penduduk'] . ", " . $data_pindah[0]['desa_kelurahan_penduduk'] . ", " .
    $data_pindah[0]['kecamatan_penduduk'] . ", " . $data_pindah[0]['kabupaten_kota_penduduk'] . ", " .
    $data_pindah[0]['provinsi_penduduk'];

$alamat_penduduk_baru = $data_pindah[0]['alamat_baru'] . ", Rt: " . $data_pindah[0]['rt_baru'] . "/" .
    $data_pindah[0]['rw_baru'] . ", " . $data_pindah[0]['desa_kelurahan_baru'] . ", " .
    $data_pindah[0]['kecamatan_baru'] . ", " . $data_pindah[0]['kabupaten_kota_baru'] . ", " .
    $data_pindah[0]['provinsi_baru'];
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
        <th>Alamat Lama</th>
        <td>:</td>
        <td><?= $alamat_penduduk ?></td>
    </tr>
</table>
<h3>Data Baru</h3>
<table class="table table-striped">
    <tr>
        <th width="22%">Alamat Baru</th>
        <td width="1%">:</td>
        <td><?= $alamat_penduduk_baru ?></td>
    </tr>
</table>
<a href="index.php?page=surat_pindah" class="btn btn-warning">
    <i class="fa-solid fa-xmark"></i>
    Kembali
</a>