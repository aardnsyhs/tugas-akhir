<?php
// Pastikan variabel $koneksi sudah terdefinisi sebelumnya

$sql = "SELECT * FROM penduduk WHERE status_keluarga='Belum Berkeluarga'";
$query = mysqli_query($koneksi, $sql);
?>
<form method="POST" id="formTambahKartuKeluarga">
    <h3>Tambah Kartu Keluarga</h3>
    <table class="table table-striped table-middle">
        <tr>
            <th width="20%">Pilih Kepala Keluarga</th>
            <td width="1%">:</td>
            <td>
                <select name="id_penduduk" id="id_penduduk" class="form-control select2bs4" required>
                    <option selected disabled>- Pilih Kepala Keluarga -</option>
                    <?php
                    while ($row_penduduk = mysqli_fetch_array($query)) {
                        $id_penduduk = $row_penduduk['id_penduduk'];
                        $nik_penduduk = $row_penduduk['nik_penduduk'];
                        $nama_penduduk = $row_penduduk['nama_penduduk'];
                    ?>
                        <option value="<?= $id_penduduk ?>" data-nama="<?= $nama_penduduk ?>">
                            <?= $nik_penduduk ?> - <?= $nama_penduduk ?>
                        </option>
                    <?php
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <th>Nama Kepala Keluarga</th>
            <td>:</td>
            <td><input type="text" class="form-control" name="nama_penduduk" id="nama_penduduk" readonly></td>
        </tr>
    </table>
    <div class="d-flex">
        <button type="submit" class="btn btn-primary" name="simpan">
            <i class="fa-solid fa-floppy-disk"></i>
            Simpan
        </button>
        <a href="?page=kk" class="btn btn-warning ml-2">
            <i class="fa-solid fa-floppy-disk"></i>
            Kembali
        </a>
    </div>
</form>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('#id_penduduk').change(function() {
            var selectedOption = $(this).find('option:selected');
            var namaKepalaKeluarga = selectedOption.data('nama');
            $('#nama_penduduk').val(namaKepalaKeluarga);
        });
    });
</script>
<?php
if (isset($_POST['simpan'])) {
    $id_penduduk = $_POST['id_penduduk'];
    $nama_penduduk = $_POST['nama_penduduk'];

    function generateNoKK($kode_provinsi, $kode_kota, $kode_kecamatan, $tanggal, $nomor_urut)
    {
        $tanggal_format = date('dmy', strtotime($tanggal));
        $kk = $kode_provinsi . $kode_kota . $kode_kecamatan . $tanggal_format . sprintf('%04d', $nomor_urut);
        return $kk;
    }
    $tanggal_dibuat = date('Y-m-d');
    $no_kk = generateNoKK("32", "77", "03", $tanggal_dibuat, 1);

    $sql_tambah = "INSERT INTO kk VALUES (NULL, '$no_kk', '$id_penduduk', '$nama_penduduk')";
    $query_tambah = mysqli_query($koneksi, $sql_tambah);

    $sql_update = "UPDATE penduduk SET status_keluarga='Sudah Berkeluarga' WHERE id_penduduk='$id_penduduk'";
    $query_update = mysqli_query($koneksi, $sql_update);

    if ($query_tambah && $query_update) {
        echo "<script>
      Swal.fire({title: 'Tambah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
          window.location = 'index.php?page=kk';
          }
      })</script>";
    } else {
        echo "<script>
      Swal.fire({title: 'Tambah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
          window.location = 'index.php?page=tambah_kk';
          }
      })</script>";
    }
}
