<h3>A. Tambah Data Pindah Penduduk</h3>
<table class="table table-striped table-middle">
    <form action="" method="post">
        <tr>
            <th width="20%">Penduduk</th>
            <td width="1%">:</td>
            <td>
                <select name="id_penduduk" id="id_penduduk" class="form-control select2bs4" required>
                    <option selected="selected">- Pilih Penduduk -</option>
                    <?php
                    $query = "SELECT * FROM penduduk WHERE status='Ada'";
                    $hasil = mysqli_query($koneksi, $query);
                    while ($row = mysqli_fetch_array($hasil)) {
                    ?>
                        <option value="<?= $row['id_penduduk'] ?>">
                            <?= $row['nik_penduduk'] ?>
                            -
                            <?= $row['nama_penduduk'] ?>
                        </option>
                    <?php
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <th>Alamat Asal</th>
            <td>:</td>
            <td><input type="text" class="form-control" name="alamat_asal" id="alamat_asal" required></td>
        </tr>
        <tr>
            <th>Alamat Tujuan</th>
            <td>:</td>
            <td><input type="text" class="form-control" name="alamat_tujuan" id="alamat_tujuan" required></td>
        </tr>
        <tr>
            <th>Alasan Pindah</th>
            <td>:</td>
            <td><input type="text" class="form-control" name="alasan_pindah" id="alasan_pindah" required></td>
        </tr>
        <tr>
            <th>Keluarga Pindah</th>
            <td>:</td>
            <td><input type="text" class="form-control" name="keluarga_pindah" id="keluarga_pindah" required></td>
        </tr>
</table>
<button type="submit" class="btn btn-primary" name="simpan">
    <i class="fa-solid fa-floppy-disk"></i>
    Simpan
</button>
</form>
<?php
if (isset($_POST['simpan'])) {
    $sql_simpan = "INSERT INTO surat_pindah (id_penduduk, alamat_asal, alamat_tujuan, alasan_pindah, keluarga_pindah) VALUES (
			'" . $_POST['id_penduduk'] . "',
            '" . $_POST['alamat_asal'] . "',
            '" . $_POST['alamat_tujuan'] . "',
            '" . $_POST['alasan_pindah'] . "',
            '" . $_POST['keluarga_pindah'] . "')";
    $query_simpan = mysqli_query($koneksi, $sql_simpan);

    $sql_ubah = "UPDATE penduduk SET 
			status='Meninggal'
			WHERE id_penduduk='" . $_POST['id_penduduk'] . "'";
    $query_ubah = mysqli_query($koneksi, $sql_ubah);
    mysqli_close($koneksi);

    if ($query_simpan && $query_ubah) {
        echo "<script>
      Swal.fire({title: 'Tambah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
          window.location = 'index.php?page=kematian';
          }
      })</script>";
    } else {
        echo "<script>
      Swal.fire({title: 'Tambah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
          window.location = 'index.php?page=tambah_kematian';
          }
      })</script>";
    }
}
