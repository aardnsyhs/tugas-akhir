<?php
$sql = "SELECT * FROM penduduk WHERE nama_penduduk='$data_nama'";
$cek_penduduk = mysqli_query($koneksi, $sql);
$hasil_penduduk = mysqli_fetch_assoc($cek_penduduk);
$alamat_penduduk = $hasil_penduduk['alamat_penduduk'] . ", " . "Rt: " . $hasil_penduduk['rt_penduduk'] . "/" . 
                    $hasil_penduduk['rw_penduduk'] . ", " . $hasil_penduduk['desa_kelurahan_penduduk'] . ", " . 
                    $hasil_penduduk['kecamatan_penduduk'] . ", " . $hasil_penduduk['kabupaten_kota_penduduk'] . ", " . 
                    $hasil_penduduk['provinsi_penduduk'];
?>
<h3>A. Tambah Data Pindah Penduduk</h3>
<table class="table table-striped table-middle">
    <form action="" method="POST">
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
        <tr>
            <th>Alamat Penduduk Baru</th>
            <td>:</td>
            <td><input type="text" class="form-control" name="desa_kelurahan_penduduk"></td>
        </tr>
        <tr>
            <th>RT</th>
            <td>:</td>
            <td><input type="text" class="form-control" name="desa_kelurahan_penduduk"></td>
        </tr>
        <tr>
            <th>RW</th>
            <td>:</td>
            <td><input type="text" class="form-control" name="desa_kelurahan_penduduk"></td>
        </tr>
        <tr>
            <th>Desa/Kelurahan</th>
            <td>:</td>
            <td><input type="text" class="form-control" name="desa_kelurahan_penduduk"></td>
        </tr>
        <tr>
            <th>Kecamatan</th>
            <td>:</td>
            <td><input type="text" class="form-control" name="kecamatan_penduduk"></td>
        </tr>
        <tr>
            <th>Kabupaten/Kota</th>
            <td>:</td>
            <td><input type="text" class="form-control" name="kabupaten_kota_penduduk"></td>
        </tr>
        <tr>
            <th>Provinsi</th>
            <td>:</td>
            <td><input type="text" class="form-control" name="provinsi_penduduk"></td>
        </tr>
        <tr>
</table>
<button type="submit" class="btn btn-primary" name="Laporkan">
    <i class="fa-solid fa-floppy-disk"></i>
    Laporkan
</button>
</form>
