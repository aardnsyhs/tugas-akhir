<h2>Detail Data Penduduk</h2>
<?php
include "config/connection.php";
$get_id_penduduk = $_GET['id_penduduk'];
$query = "SELECT * FROM `penduduk` WHERE id_penduduk = $get_id_penduduk";
$hasil = mysqli_query($koneksi, $query);
$data_penduduk = [];
while ($row = mysqli_fetch_assoc($hasil)) {
    $data_penduduk[] = $row;
}
?>
<h3>A. Data Pribadi</h3>
<table class="table table-striped">
    <tr>
        <th width="20%">NIK</th>
        <td width="1%">:</td>
        <td><?= $data_penduduk[0]['nik_penduduk'] ?></td>
    </tr>
    <tr>
        <th>Nama penduduk</th>
        <td>:</td>
        <td><?= $data_penduduk[0]['nama_penduduk'] ?></td>
    </tr>
    <tr>
        <th>Tempat Lahir</th>
        <td>:</td>
        <td><?= $data_penduduk[0]['tempat_lahir_penduduk'] ?></td>
    </tr>
    <tr>
        <th>Tanggal Lahir</th>
        <td>:</td>
        <td>
            <?= ($data_penduduk[0]['tanggal_lahir_penduduk'] != '0000-00-00') ? date('d-m-Y', strtotime($data_penduduk[0]['tanggal_lahir_penduduk'])) : '' ?>
        </td>
    </tr>
    <tr>
        <th>Jenis Kelamin</th>
        <td>:</td>
        <td><?= $data_penduduk[0]['jenis_kelamin_penduduk'] ?></td>
    </tr>
</table>

<h3>B. Data Alamat</h3>
<table class="table table-striped">
    <tr>
        <th width="20%">Alamat KTP</th>
        <td width="1%">:</td>
        <td><?= $data_penduduk[0]['alamat_ktp_penduduk'] ?></td>
    </tr>
    <tr>
        <th>Alamat</th>
        <td>:</td>
        <td><?= $data_penduduk[0]['alamat_penduduk'] ?></td>
    </tr>
    <tr>
        <th>Desa/Kelurahan</th>
        <td>:</td>
        <td><?= $data_penduduk[0]['desa_kelurahan_penduduk'] ?></td>
    </tr>
    <tr>
        <th>Kecamatan</th>
        <td>:</td>
        <td><?= $data_penduduk[0]['kecamatan_penduduk'] ?></td>
    </tr>
    <tr>
        <th>Kabupaten/Kota</th>
        <td>:</td>
        <td><?= $data_penduduk[0]['kabupaten_kota_penduduk'] ?></td>
    </tr>
    <tr>
        <th>Provinsi</th>
        <td>:</td>
        <td><?= $data_penduduk[0]['provinsi_penduduk'] ?></td>
    </tr>
    <tr>
        <th>Negara</th>
        <td>:</td>
        <td><?= $data_penduduk[0]['negara_penduduk'] ?></td>
    </tr>
    <tr>
        <th>RT</th>
        <td>:</td>
        <td><?= $data_penduduk[0]['rt_penduduk'] ?></td>
    </tr>
    <tr>
        <th>RW</th>
        <td>:</td>
        <td><?= $data_penduduk[0]['rw_penduduk'] ?></td>
    </tr>
</table>

<h3>C. Data Lain-lain</h3>
<table class="table table-striped">
    <tr>
        <th width="20%">Agama</th>
        <td width="1%">:</td>
        <td><?= $data_penduduk[0]['agama_penduduk'] ?></td>
    </tr>
    <tr>
        <th>Pendidikan</th>
        <td>:</td>
        <td><?= $data_penduduk[0]['pendidikan_terakhir_penduduk'] ?></td>
    </tr>
    <tr>
        <th>Pekerjaan</th>
        <td>:</td>
        <td><?= $data_penduduk[0]['pekerjaan_penduduk'] ?></td>
    </tr>
    <tr>
        <th>Status Perkawinan</th>
        <td>:</td>
        <td><?= $data_penduduk[0]['status_perkawinan_penduduk'] ?></td>
    </tr>
</table>