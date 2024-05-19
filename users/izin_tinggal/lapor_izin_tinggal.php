<?php
$sql = "SELECT * FROM penduduk WHERE nama_penduduk='$data_nama'";
$cek_penduduk = mysqli_query($koneksi, $sql);
$hasil_penduduk = mysqli_fetch_assoc($cek_penduduk);
$alamat_penduduk = $hasil_penduduk['alamat_penduduk'] . ", " . "Rt: " . $hasil_penduduk['rt_penduduk'] . "/" .
    $hasil_penduduk['rw_penduduk'] . ", " . $hasil_penduduk['desa_kelurahan_penduduk'] . ", " .
    $hasil_penduduk['kecamatan_penduduk'] . ", " . $hasil_penduduk['kabupaten_kota_penduduk'] . ", " .
    $hasil_penduduk['provinsi_penduduk'];
?>
<h3>A. Alamat Asal</h3>
<form action="" method="POST">
    <table class="table table-striped table-middle">
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
    </table>
    <h3>B. Alamat Tujuan</h3>
    <table class="table table-striped table-middle">
        <tr>
            <th width="20%">Alamat Penduduk Baru</th>
            <td width="1%">:</td>
            <td><input type="text" class="form-control" name="alamat_baru" required></td>
        </tr>
        <tr>
            <th>RT</th>
            <td>:</td>
            <td><input type="text" class="form-control" name="rt_baru" required></td>
        </tr>
        <tr>
            <th>RW</th>
            <td>:</td>
            <td><input type="text" class="form-control" name="rw_baru" required></td>
        </tr>
        <tr>
            <th>Desa/Kelurahan</th>
            <td>:</td>
            <td><input type="text" class="form-control" name="desa_kelurahan_baru" required></td>
        </tr>
        <tr>
            <th>Kecamatan</th>
            <td>:</td>
            <td><input type="text" class="form-control" name="kecamatan_baru" required></td>
        </tr>
        <tr>
            <th>Kabupaten/Kota</th>
            <td>:</td>
            <td><input type="text" class="form-control" name="kabupaten_kota_baru" required></td>
        </tr>
        <tr>
            <th>Provinsi</th>
            <td>:</td>
            <td><input type="text" class="form-control" name="provinsi_baru" required></td>
        </tr>
        <tr>
    </table>
    <button type="submit" class="btn btn-primary" name="Laporkan">
        <i class="fa-solid fa-floppy-disk"></i>
        Laporkan
    </button>
</form>
<?php
if (isset($_POST['Laporkan'])) {
    $alamat_baru = $_POST['alamat_baru'];
    $rt_baru = $_POST['rt_baru'];
    $rw_baru = $_POST['rw_baru'];
    $desa_kelurahan_baru = $_POST['desa_kelurahan_baru'];
    $kecamatan_baru = $_POST['kecamatan_baru'];
    $kabupaten_kota_baru = $_POST['kabupaten_kota_baru'];
    $provinsi_baru = $_POST['provinsi_baru'];

    $query = "SELECT id_penduduk FROM `penduduk` WHERE id_user = '$data_id'";
    $hasil_penduduk = mysqli_query($koneksi, $query);
    $data_penduduk = mysqli_fetch_assoc($hasil_penduduk);
    $id_penduduk = $data_penduduk['id_penduduk'];

    $sql = "INSERT INTO `surat_izin_tinggal_temp` VALUES 
    (NULL, '$id_penduduk', '$alamat_baru', '$rt_baru', '$rw_baru', 
    '$desa_kelurahan_baru', '$kecamatan_baru', '$kabupaten_kota_baru', 
    '$provinsi_baru')";
    $query_simpan = mysqli_query($koneksi, $sql);

    if ($query_simpan) {
        echo "<script>
      Swal.fire({title: 'Tambah Laporan Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
          window.location = 'index.php?page=lapor_izin_tinggal';
          clearStorage();
          }
      })</script>";
    } else {
        echo "<script>
      Swal.fire({title: 'Tambah Laporan Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
          window.location = 'index.php?page=lapor_izin_tinggal';
          }
      })</script>";
    }
}
?>