<?php
$get_id_penduduk = $_GET['id_penduduk'];
$query = "SELECT * FROM penduduk JOIN surat_pindah_temp ON penduduk.id_penduduk = surat_pindah_temp.id_penduduk WHERE penduduk.id_penduduk = '$get_id_penduduk'";
$cek_hasil = mysqli_query($koneksi, $query);
$hasil = mysqli_fetch_assoc($cek_hasil);
?>
<h2>Ubah Data Pindah Penduduk</h2>
<form action="" method="POST">
    <table class="table table-striped">
        <input type="hidden" name="id_surat_pindah_temp" value="<?= $hasil['id_surat_pindah_temp'] ?>">
        <tr>
            <th width="22%">NIK</th>
            <td width="1%">:</td>
            <td><?= $hasil['nik_penduduk'] ?></td>
        </tr>
        <tr>
            <th>Nama Penduduk Pindah</th>
            <td>:</td>
            <td><?= $hasil['nama_penduduk'] ?></td>
        </tr>
    </table>
    <h3>Data Baru</h3>
    <table class="table table-striped">
        <tr>
            <th width="22%">Alamat Baru</th>
            <td width="1%">:</td>
            <td><input type="text" name="alamat_baru" class="form-control" value="<?= $hasil['alamat_baru'] ?>"></td>
        </tr>
        <tr>
            <th width="22%">RT Baru</th>
            <td width="1%">:</td>
            <td><input type="text" name="rt_baru" class="form-control" value="<?= $hasil['rt_baru'] ?>"></td>
        </tr>
        <tr>
            <th width="22%">RW Baru</th>
            <td width="1%">:</td>
            <td><input type="text" name="rw_baru" class="form-control" value="<?= $hasil['rw_baru'] ?>"></td>
        </tr>
        <tr>
            <th width="22%">Desa / Kelurahan Baru</th>
            <td width="1%">:</td>
            <td><input type="text" name="desa_kelurahan_baru" class="form-control" value="<?= $hasil['desa_kelurahan_baru'] ?>"></td>
        </tr>
        <tr>
            <th width="22%">Kecamatan Baru</th>
            <td width="1%">:</td>
            <td><input type="text" name="kecamatan_baru" class="form-control" value="<?= $hasil['kecamatan_baru'] ?>"></td>
        </tr>
        <tr>
            <th width="22%">Kabupaten / Kota Baru</th>
            <td width="1%">:</td>
            <td><input type="text" name="kabupaten_kota_baru" class="form-control" value="<?= $hasil['kabupaten_kota_baru'] ?>"></td>
        </tr>
        <tr>
            <th width="22%">Provinsi Baru</th>
            <td width="1%">:</td>
            <td><input type="text" name="provinsi_baru" class="form-control" value="<?= $hasil['provinsi_baru'] ?>"></td>
        </tr>
        <tr>
            <th width="22%">Alasan Pindah</th>
            <td width="1%">:</td>
            <td><input type="text" name="alasan_pindah" class="form-control" value="<?= $hasil['alasan_pindah'] ?>"></td>
        </tr>
    </table>
    <div class="d-flex">
        <button type="submit" class="btn btn-primary" name="ubah">
            <i class="fa-solid fa-floppy-disk"></i>
            Ubah
        </button>
</form>
<a href="index.php?page=surat_pindah" class="btn btn-warning ml-3">
    <i class="fa-solid fa-xmark"></i>
    Kembali
</a>
<?php
if (isset($_POST['ubah'])) {
    $id_surat_pindah_temp = $_POST['id_surat_pindah_temp'];
    $alamat_baru = $_POST['alamat_baru'];
    $rt_baru = $_POST['rt_baru'];
    $rw_baru = $_POST['rw_baru'];
    $desa_kelurahan_baru = $_POST['desa_kelurahan_baru'];
    $kecamatan_baru = $_POST['kecamatan_baru'];
    $kabupaten_kota_baru = $_POST['kabupaten_kota_baru'];
    $provinsi_baru = $_POST['provinsi_baru'];
    $alasan_pindah = $_POST['alasan_pindah'];

    $sql = "UPDATE `surat_pindah_temp` SET `alamat_baru` = '$alamat_baru', `rt_baru` = '$rt_baru', `rw_baru` = '$rw_baru', `desa_kelurahan_baru` = '$desa_kelurahan_baru', `kecamatan_baru` = '$kecamatan_baru', `kabupaten_kota_baru` = '$kabupaten_kota_baru', `provinsi_baru` = '$provinsi_baru' WHERE `surat_pindah_temp`.`id_surat_pindah_temp` = '$id_surat_pindah_temp'";
    $query = mysqli_query($koneksi, $sql);
    if ($query) {
        echo "<script>
                Swal.fire({title: 'Ubah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
                }).then((result) => {if (result.value)
                {window.location = 'index.php?page=surat_pindah';
                }
                })
              </script>";
    } else {
        echo "<script>
                Swal.fire({title: 'Ubah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
                }).then((result) => {if (result.value)
                {window.location = 'index.php?page=surat_pindah';
                }
                })
              </script>";
    }
}
