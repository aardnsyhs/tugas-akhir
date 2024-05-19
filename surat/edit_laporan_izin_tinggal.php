<?php
$get_id_penduduk = $_GET['id_penduduk'];
$query = "SELECT * FROM penduduk JOIN surat_izin_tinggal_temp ON penduduk.id_penduduk = surat_izin_tinggal_temp.id_penduduk WHERE penduduk.id_penduduk = '$get_id_penduduk'";
$cek_hasil = mysqli_query($koneksi, $query);
$hasil = mysqli_fetch_assoc($cek_hasil);
?>
<h2>Ubah Data Izin Tinggal Penduduk</h2>
<form action="" method="POST">
    <table class="table table-striped">
        <input type="hidden" name="id_surat_izin_tinggal_temp" value="<?= $hasil['id_surat_izin_tinggal_temp'] ?>">
        <tr>
            <th width="22%">NIK</th>
            <td width="1%">:</td>
            <td><?= $hasil['nik_penduduk'] ?></td>
        </tr>
        <tr>
            <th>Nama Penduduk Izin Tinggal</th>
            <td>:</td>
            <td><?= $hasil['nama_penduduk'] ?></td>
        </tr>
    </table>
    <h3>Data Baru</h3>
    <table class="table table-striped">
        <tr>
            <th width="22%">Alamat Baru</th>
            <td width="1%">:</td>
            <td><input type="text" name="alamat" class="form-control" value="<?= $hasil['alamat'] ?>"></td>
        </tr>
        <tr>
            <th width="22%">RT Baru</th>
            <td width="1%">:</td>
            <td><input type="text" name="rt" class="form-control" value="<?= $hasil['rt'] ?>"></td>
        </tr>
        <tr>
            <th width="22%">RW Baru</th>
            <td width="1%">:</td>
            <td><input type="text" name="rw" class="form-control" value="<?= $hasil['rw'] ?>"></td>
        </tr>
        <tr>
            <th width="22%">Desa / Kelurahan Baru</th>
            <td width="1%">:</td>
            <td><input type="text" name="kelurahan" class="form-control" value="<?= $hasil['kelurahan'] ?>"></td>
        </tr>
        <tr>
            <th width="22%">Kecamatan Baru</th>
            <td width="1%">:</td>
            <td><input type="text" name="kecamatan" class="form-control" value="<?= $hasil['kecamatan'] ?>"></td>
        </tr>
        <tr>
            <th width="22%">Kabupaten / Kota Baru</th>
            <td width="1%">:</td>
            <td><input type="text" name="kota" class="form-control" value="<?= $hasil['kota'] ?>"></td>
        </tr>
        <tr>
            <th width="22%">Provinsi Baru</th>
            <td width="1%">:</td>
            <td><input type="text" name="provinsi" class="form-control" value="<?= $hasil['provinsi'] ?>"></td>
        </tr>
    </table>
    <div class="d-flex">
        <button type="submit" class="btn btn-primary" name="ubah">
            <i class="fa-solid fa-floppy-disk"></i>
            Ubah
        </button>
</form>
<a href="index.php?page=surat_izin_tinggal" class="btn btn-warning ml-3">
    <i class="fa-solid fa-xmark"></i>
    Kembali
</a>
<?php
if (isset($_POST['ubah'])) {
    $id_surat_izin_tinggal_temp = $_POST['id_surat_izin_tinggal_temp'];
    $alamat = $_POST['alamat'];
    $rt = $_POST['rt'];
    $rw = $_POST['rw'];
    $kelurahan = $_POST['kelurahan'];
    $kecamatan = $_POST['kecamatan'];
    $kota = $_POST['kota'];
    $provinsi = $_POST['provinsi'];

    $sql = "UPDATE `surat_izin_tinggal_temp` SET `alamat` = '$alamat', `rt` = '$rt', `rw` = '$rw', `kelurahan` = '$kelurahan', `kecamatan` = '$kecamatan', `kota` = '$kota', `provinsi` = '$provinsi' WHERE `surat_izin_tinggal_temp`.`id_surat_izin_tinggal_temp` = '$id_surat_izin_tinggal_temp'";
    $query = mysqli_query($koneksi, $sql);
    if ($query) {
        echo "<script>
                Swal.fire({title: 'Ubah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
                }).then((result) => {if (result.value)
                {window.location = 'index.php?page=surat_izin_tinggal';
                }
                })
              </script>";
    } else {
        echo "<script>
                Swal.fire({title: 'Ubah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
                }).then((result) => {if (result.value)
                {window.location = 'index.php?page=surat_izin_tinggal';
                }
                })
              </script>";
    }
}
