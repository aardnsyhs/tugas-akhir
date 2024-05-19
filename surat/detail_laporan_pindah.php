<?php
$get_id_penduduk = $_GET['id_penduduk'];
$query = "SELECT p.*, spt.*
        FROM penduduk p
        JOIN surat_pindah_temp spt ON p.id_penduduk = spt.id_penduduk
        WHERE p.id_penduduk = '$get_id_penduduk'";
$hasil = mysqli_query($koneksi, $query);

$sql_kk = "SELECT * FROM penduduk JOIN anggota_keluarga ON penduduk.id_penduduk = anggota_keluarga.id_penduduk WHERE penduduk.id_penduduk=$get_id_penduduk";
$query = mysqli_query($koneksi, $sql_kk);
$hasil_id_kk = mysqli_fetch_assoc($query);
$id_kk = $hasil_id_kk['id_kk'];

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
<div class="mb-2">
    <h2>A. Detail Data Pindah Penduduk</h2>
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
<div class="mt-2">
    <h3>C. Anggota Keluarga Pindah</h3>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>No</th>
                <th>NIK</th>
                <th>Nama Penduduk Pindah</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $sql = $koneksi->query("SELECT * FROM anggota_keluarga_pindah_temp JOIN penduduk ON anggota_keluarga_pindah_temp.id_penduduk=penduduk.id_penduduk WHERE id_kk='$id_kk'");
            while ($data = $sql->fetch_assoc()) {
            ?>
                <tr>
                    <td>
                        <?= $no++ ?>
                    </td>
                    <td>
                        <?= $data['nik_penduduk']; ?>
                    </td>
                    <td>
                        <?= $data['nama_penduduk']; ?>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>
<a href="index.php?page=surat_pindah" class="btn btn-warning">
    <i class="fa-solid fa-xmark"></i>
    Kembali
</a>