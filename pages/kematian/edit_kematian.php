<?php

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
<h2>Ubah Data Kematian Penduduk</h2>
<form action="" method="POST">
    <table class="table table-striped">
        <tr>
            <th width="22%">NIK</th>
            <td width="1%">:</td>
            <td>
                <input type="number" class="form-control" name="nik_penduduk" id="nik_penduduk" value="<?= $data_kematian[0]['nik_penduduk'] ?>" disabled>
            </td>
        </tr>
        <tr>
            <th>Nama Penduduk Meninggal</th>
            <td>:</td>
            <td>
                <input type="text" class="form-control" name="nama_penduduk" id="nama_penduduk" value="<?= $data_kematian[0]['nama_penduduk'] ?>" disabled>
            </td>
        </tr>
        <tr>
            <th>Bin / Binti</th>
            <td>:</td>
            <td>
                <input type="text" class="form-control" name="bin_binti" id="bin_binti" value="<?= $data_kematian[0]['bin_binti'] ?>" required>
            </td>
        </tr>
        <tr>
            <th>Tanggal Lahir</th>
            <td>:</td>
            <td>
                <input type="date" class="form-control" name="tanggal_lahir_penduduk" value="<?= $data_kematian[0]['tanggal_lahir_penduduk'] ?>" disabled>
            </td>
        </tr>
        <tr>
            <th>Jenis Kelamin</th>
            <td>:</td>
            <td>
                <input type="text" class="form-control" name="jenis_kelamin_penduduk" id="jenis_kelamin_penduduk" value="<?= $data_kematian[0]['jenis_kelamin_penduduk'] ?>" disabled>
            </td>
        </tr>
        <tr>
            <th>Usia Saat Meninggal</th>
            <td>:</td>
            <td>
                <input type="text" class="form-control" name="usia_kematian" id="usia_kematian" value="<?= hitungUsia($tanggal_lahir, $tanggal_kematian) . ' tahun' ?>" disabled>
            </td>
        </tr>
        <tr>
            <th>Penyebab Kematian</th>
            <td>:</td>
            <td>
                <input type="text" class="form-control" name="penyebab_kematian" id="penyebab_kematian" value="<?= $data_kematian[0]['penyebab_kematian'] ?>" required>
            </td>
        </tr>
        <tr>
            <th>Tanggal Kematian</th>
            <td>:</td>
            <td>
                <input type="date" class="form-control" name="tanggal_kematian" id="tanggal_kematian" value="<?= $data_kematian[0]['tanggal_kematian'] ?>" required>
            </td>
        </tr>
        <tr>
            <th>Jam Meninggal</th>
            <td>:</td>
            <td>
                <input type="time" class="form-control" name="jam_kematian" id="jam_kematian" value="<?= $data_kematian[0]['jam_kematian'] ?>" required>
            </td>
        </tr>
        <tr>
            <th>Tempat Meninggal</th>
            <td>:</td>
            <td>
                <input type="text" class="form-control" name="tempat_kematian" id="tempat_kematian" value="<?= $data_kematian[0]['tempat_kematian'] ?>" required>
            </td>
        </tr>
    </table>
    <div class="d-flex">
        <button type="submit" class="btn btn-primary" name="ubah">
            <i class="fa-solid fa-floppy-disk"></i>
            Ubah
        </button>
</form>
<a href="index.php?page=kematian" class="btn btn-secondary ml-2">
    <i class="fa-solid fa-xmark"></i>
    Batal
</a>
<?php
if (isset($_POST['ubah'])) {
    $sql = "UPDATE `surat_kematian` SET 
           `tanggal_kematian` = '" . $_POST['tanggal_kematian'] . "', 
           `jam_kematian` = '" . $_POST['jam_kematian'] . "', 
           `penyebab_kematian` = '" . $_POST['penyebab_kematian'] . "', 
           `tempat_kematian` = '" . $_POST['tempat_kematian'] . "', 
           `usia_kematian` = '" . $_POST['usia_kematian'] . "', 
           `bin_binti` = '" . $_POST['bin_binti'] . "' 
           WHERE `surat_kematian`.`id_surat_kematian` = '" . $data_kematian[0]['id_surat_kematian'] . "'";
    $query = mysqli_query($koneksi, $sql);
    mysqli_close($koneksi);
    if ($query) {
        echo "<script>
      Swal.fire({title: 'Ubah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
      }).then((result) => {if (result.value)
        {window.location = 'index.php?page=kematian';
        }
      })</script>";
    } else {
        echo "<script>
      Swal.fire({title: 'Ubah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
      }).then((result) => {if (result.value)
        {window.location = 'index.php?page=kematian';
        }
      })</script>";
    }
}
