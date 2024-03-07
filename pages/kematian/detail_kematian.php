<?php
include "config/connection.php";
$get_id_penduduk = $_GET['id_penduduk'];
$query = "SELECT * FROM `penduduk` JOIN `surat_kematian` ON `penduduk`.id_penduduk = `surat_kematian`.id_penduduk WHERE `surat_kematian`.id_penduduk = '$get_id_penduduk'";
$hasil = mysqli_query($koneksi, $query);
$data_kematian = array();
while ($row = mysqli_fetch_assoc($hasil)) {
    $data_kematian[] = $row;
}
function hitungUsia($tanggal_lahir, $tanggal_kematian)
{
    $lahir = new DateTime($tanggal_lahir);
    $kematian = new DateTime($tanggal_kematian);
    $usia = $lahir->diff($kematian);
    return $usia->y;
}
$tanggal_lahir = $data_kematian[0]['tanggal_lahir_penduduk'];
$tanggal_kematian = $data_kematian[0]['tanggal_kematian'];
?>
<h2>Detail Data Kematian Penduduk</h2>
<table class="table table-striped">
    <tr>
        <th width="22%">NIK</th>
        <td width="1%">:</td>
        <td><?= $data_kematian[0]['nik_penduduk'] ?></td>
    </tr>
    <tr>
        <th>Nama Penduduk Meninggal</th>
        <td>:</td>
        <td><?= $data_kematian[0]['nama_penduduk'] ?></td>
    </tr>
    <tr>
        <th>Bin / Binti</th>
        <td>:</td>
        <td><?= $data_kematian[0]['bin_binti'] ?></td>
    </tr>
    <tr>
        <th>Tanggal Lahir</th>
        <td>:</td>
        <td><?= ($data_kematian[0]['tanggal_lahir_penduduk'] != '0000-00-00') ? date('d-m-Y', strtotime($data_kematian[0]['tanggal_lahir_penduduk'])) : '' ?></td>
    </tr>
    <tr>
        <th>Jenis Kelamin</th>
        <td>:</td>
        <td><?= $data_kematian[0]['jenis_kelamin_penduduk'] ?></td>
    </tr>
    <tr>
        <th>Tanggal Kematian</th>
        <td>:</td>
        <td><?= ($data_kematian[0]['tanggal_kematian'] != '0000-00-00') ? date('d-m-Y', strtotime($data_kematian[0]['tanggal_kematian'])) : '' ?></td>
    </tr>
    <tr>
        <th>Usia Saat Meninggal</th>
        <td>:</td>
        <td>
            <?= hitungUsia($tanggal_lahir, $tanggal_kematian) . " tahun" ?>
        </td>
    </tr>
    <tr>
        <th>Penyebab Kematian</th>
        <td>:</td>
        <td><?= $data_kematian[0]['penyebab_kematian'] ?></td>
    </tr>
    <tr>
        <th>Jam Meninggal</th>
        <td>:</td>
        <td><?= $data_kematian[0]['jam_kematian'] ?></td>
    </tr>
    <tr>
        <th>Tempat Meninggal</th>
        <td>:</td>
        <td><?= $data_kematian[0]['tempat_kematian'] ?></td>
    </tr>
</table>
<a href="index.php?page=kematian" class="btn btn-warning">
    <i class="fa-solid fa-xmark"></i>
    Kembali
</a>