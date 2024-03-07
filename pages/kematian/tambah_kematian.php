<h3>A. Tambah Data Kematian Penduduk</h3>
<table class="table table-striped table-middle">
    <form action="" method="post">
        <tr>
            <th width="20%">Penduduk</th>
            <td width="1%">:</td>
            <td>
                <select name="id_penduduk" id="id_penduduk" class="form-control select2bs4" required>
                    <option selected="selected">- Pilih Penduduk -</option>
                    <?php
                    include "config/connection.php";
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
            <th>Usia Kematian</th>
            <td>:</td>
            <td><input type="number" class="form-control" name="usia_kematian" id="usia_kematian" required></td>
        </tr>
        <tr>
            <th>Bin/Binti</th>
            <td>:</td>
            <td><input type="text" class="form-control" name="bin_binti" id="bin_binti" required></td>
        </tr>
</table>
<button type="submit" class="btn btn-primary" name="simpan">
    <i class="fa-solid fa-floppy-disk"></i>
    Simpan
</button>
</form>
<?php
if (isset($_POST['simpan'])) {
    $sql_simpan = "INSERT INTO surat_kematian 
                   VALUES (NULL, 
                   '" . $_POST['id_penduduk'] . "',
                   '" . $_POST['tanggal_kematian'] . "',
                   '" . $_POST['jam_kematian'] . "', 
                   '" . $_POST['penyebab_kematian'] . "', 
                   '" . $_POST['tempat_kematian'] . "', 
                   '" . $_POST['usia_kematian'] . "', 
                   '" . $_POST['bin_binti'] . "')";
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
