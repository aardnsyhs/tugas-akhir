<?php
$get_id_penduduk = $_GET['id_penduduk'];
$query = "SELECT p.*, sitt.*
        FROM penduduk p
        JOIN surat_izin_tinggal_temp sitt ON p.id_penduduk = sitt.id_penduduk
        WHERE p.id_penduduk = '$get_id_penduduk'";
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

$alamat_penduduk_baru = $data_pindah[0]['alamat'] . ", Rt: " . $data_pindah[0]['rt'] . "/" .
    $data_pindah[0]['rw'] . ", " . $data_pindah[0]['kelurahan'] . ", " .
    $data_pindah[0]['kecamatan'] . ", " . $data_pindah[0]['kota'] . ", " .
    $data_pindah[0]['provinsi'];
?>
<div class="mb-2">
    <h2>A. Detail Data Izin Tinggal Penduduk</h2>
    <table class="table table-striped">
        <tr>
            <th width="22%">NIK</th>
            <td width="1%">:</td>
            <td><?= $data_pindah[0]['nik_penduduk'] ?></td>
        </tr>
        <tr>
            <th>Nama Penduduk Izin Tinggal</th>
            <td>:</td>
            <td><?= $data_pindah[0]['nama_penduduk'] ?></td>
        </tr>
        <tr>
            <th>Alamat Lama</th>
            <td>:</td>
            <td><?= $alamat_penduduk ?></td>
        </tr>
    </table>
</div>
<div class="mb-2">
    <h3>B. Data Baru</h3>
    <table class="table table-striped">
        <tr>
            <th width="22%">Alamat Baru</th>
            <td width="1%">:</td>
            <td><?= $alamat_penduduk_baru ?></td>
        </tr>
    </table>
</div>
<a href="index.php?page=surat_izin_tinggal" class="btn btn-warning">
    <i class="fa-solid fa-xmark"></i>
    Kembali
</a>