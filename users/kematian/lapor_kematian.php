<?php
$nik = $_SESSION['username'];
$id_user = $_SESSION['id'];

$query = "SELECT ak.id_kk FROM anggota_keluarga ak
          JOIN kk k ON ak.id_kk = k.id_kk
          WHERE ak.id_penduduk IN (SELECT id_penduduk FROM penduduk WHERE nik_penduduk = '$nik')";

$result = mysqli_query($koneksi, $query);

$sql = "SELECT id_penduduk FROM penduduk WHERE id_user = '$id_user'";
$cek_pelapor = mysqli_query($koneksi, $sql);
$hasil_pelapor = mysqli_fetch_assoc($cek_pelapor);
$id_penduduk = $hasil_pelapor['id_penduduk'];


if (!$result) {
    echo "Error: " . mysqli_error($koneksi);
    exit;
}

$row = mysqli_fetch_assoc($result);
$id_kk = $row['id_kk'];

$query_anggota = "SELECT ak.*, p.nik_penduduk, p.nama_penduduk
                  FROM anggota_keluarga ak
                  JOIN penduduk p ON ak.id_penduduk = p.id_penduduk
                  WHERE ak.id_kk = '$id_kk'";

$result_anggota = mysqli_query($koneksi, $query_anggota);

if (!$result_anggota) {
    echo "Error: " . mysqli_error($koneksi);
    exit;
}

if (mysqli_num_rows($result_anggota) == 0) {
    echo "No results found";
    exit;
}
?>

<h3>A. Tambah Laporan Kematian</h3>
<table class="table table-striped table-middle">
    <form action="" method="POST">
        <tr>
            <input type="hidden" name="pelapor" value="<?= $id_penduduk ?>">
            <th width="20%">Anggota Keluarga</th>
            <td width="1%">:</td>
            <td>
                <select name="id_penduduk" id="id_penduduk" class="form-control select2bs4" required>
                    <option selected="selected">- Pilih Anggota Keluarga -</option>
                    <?php
                    while ($row_anggota = mysqli_fetch_array($result_anggota)) {
                        $id_penduduk_anggota = $row_anggota['id_penduduk'];
                        $nik_anggota = $row_anggota['nik_penduduk'];
                        $nama_anggota = $row_anggota['nama_penduduk'];
                    ?>
                        <option value="<?= $id_penduduk_anggota ?>">
                            <?= $nik_anggota ?>
                            -
                            <?= $nama_anggota ?>
                        </option>
                    <?php
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <th>Tanggal Kematian</th>
            <td>:</td>
            <td><input type="date" class="form-control" name="tanggal_kematian" id="tanggal_kematian" required></td>
        </tr>
        <tr>
            <th>Jam Kematian</th>
            <td>:</td>
            <td><input type="time" class="form-control" name="jam_kematian" id="jam_kematian" required></td>
        </tr>
        <tr>
            <th>Tempat Kematian</th>
            <td>:</td>
            <td><input type="text" class="form-control" name="tempat_kematian" id="tempat_kematian" required></td>
        </tr>
        <tr>
            <th>Penyebab Kematian</th>
            <td>:</td>
            <td><input type="text" class="form-control" name="penyebab_kematian" id="penyebab_kematian" required></td>
        </tr>
        <tr>
            <th>Bin/Binti</th>
            <td>:</td>
            <td><input type="text" class="form-control" name="bin_binti" id="bin_binti" required></td>
        </tr>
        <input type="hidden" name="id_kk" value="<?= $id_kk ?>">
</table>
<button type="submit" class="btn btn-primary" name="Laporkan">
    <i class="fa-solid fa-floppy-disk"></i>
    Laporkan
</button>
</form>
<?php
if (isset($_POST['Laporkan'])) {
    $id_penduduk = $_POST['id_penduduk'];
    $query = "SELECT tanggal_lahir_penduduk FROM penduduk WHERE id_penduduk=$id_penduduk";
    $cek = mysqli_query($koneksi, $query);
    $hasil = mysqli_fetch_assoc($cek);
    $tanggal_lahir_penduduk = $hasil['tanggal_lahir_penduduk'];

    $sql = $koneksi->query("SELECT tanggal_lahir_penduduk FROM `penduduk` JOIN `surat_kematian_temp` ON `penduduk`.id_penduduk = `surat_kematian_temp`.id_penduduk");
    function hitungUsia($tanggal_lahir_penduduk, $tanggal_kematian)
    {
        $lahir = new DateTime($tanggal_lahir_penduduk);
        $kematian = new DateTime($tanggal_kematian);
        $usia = $lahir->diff($kematian);
        return $usia->y;
    }
    foreach ($sql as $data_kematian) :
        $tanggal_lahir = $data_kematian['tanggal_lahir_penduduk'];
    endforeach;
    $tanggal_kematian = $_POST['tanggal_kematian'];
    $sql_simpan = "INSERT INTO surat_kematian_temp (id_penduduk, tanggal_kematian, jam_kematian, penyebab_kematian, tempat_kematian, usia_kematian, bin_binti, pelapor) VALUES (
			'" . $_POST['id_penduduk'] . "',
            '" . $_POST['tanggal_kematian'] . "',
            '" . $_POST['jam_kematian'] . "',
            '" . $_POST['penyebab_kematian'] . "',
            '" . $_POST['tempat_kematian'] . "',
            '" . hitungUsia($tanggal_lahir_penduduk, $tanggal_kematian) . "',
            '" . $_POST['bin_binti'] . "',
            '" . $_POST['pelapor'] . "')";
    $query_simpan = mysqli_query($koneksi, $sql_simpan);
    mysqli_close($koneksi);

    if ($query_simpan) {
        echo "<script>
      Swal.fire({title: 'Tambah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
          window.location = 'index.php?page=lapor_kematian';
          }
      })</script>";
    } else {
        echo "<script>
      Swal.fire({title: 'Tambah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
          window.location = 'index.php?page=lapor_kematian';
          }
      })</script>";
    }
}
