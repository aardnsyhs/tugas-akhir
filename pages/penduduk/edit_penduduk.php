<?php
if (isset($_GET['id_penduduk'])) {
    $sql = "SELECT * FROM `penduduk` WHERE id_penduduk='" . $_GET['id_penduduk'] . "'";
    $query = mysqli_query($koneksi, $sql);
    $data = mysqli_fetch_array($query, MYSQLI_BOTH);
}
?>
<form action="" method="POST">
    <h3>A. Data Pribadi</h3>
    <table class="table table-striped table-middle">
        <input type="hidden" name="id_penduduk" id="id_penduduk" value="<?= $data['id_penduduk'] ?>">
        <tr>
            <th width="20%">NIK</th>
            <td width="1%">:</td>
            <td>
                <input type="number" class="form-control" name="nik_penduduk" id="nik_penduduk" value="<?= $data['nik_penduduk'] ?>" maxlength="16" required readonly>
            </td>
        </tr>
        <tr>
            <th>Nama Penduduk</th>
            <td>:</td>
            <td><input type="text" class="form-control" name="nama_penduduk" value="<?= $data['nama_penduduk'] ?>" required></td>
        </tr>
        <tr>
            <th>Tempat Lahir</th>
            <td>:</td>
            <td><input type="text" class="form-control" name="tempat_lahir_penduduk" value="<?= $data['tempat_lahir_penduduk'] ?>" required></td>
        </tr>
        <tr>
            <th>Tanggal Lahir</th>
            <td>:</td>
            <td><input type="date" class="form-control" name="tanggal_lahir_penduduk" value="<?= $data['tanggal_lahir_penduduk'] ?>" required></td>
        </tr>
        <tr>
            <th>Jenis Kelamin</th>
            <td>:</td>
            <td>
                <select class="form-control" name="jenis_kelamin_penduduk" required>
                    <?php
                    if ($data['jenis_kelamin_penduduk'] === "Laki-Laki") echo "<option value='Laki-Laki' selected>Laki-Laki</option>";
                    else echo "<option value='Laki-Laki'>Laki-Laki</option>";
                    if ($data['jenis_kelamin_penduduk'] === "Perempuan") echo "<option value='Perempuan' selected>Perempuan</option>";
                    else echo "<option value='Perempuan'>Perempuan</option>";
                    ?>
                </select>
            </td>
        </tr>
    </table>

    <h3>B. Data Alamat</h3>
    <table class="table table-striped table-middle">
        <tr>
            <th width="20%">Alamat</th>
            <td width="1%">:</td>
            <td>
                <input type="text" class="form-control" name="alamat_penduduk" value="<?= $data['alamat_penduduk'] ?>" required></input>
            </td>
        </tr>
        <tr>
            <th>Desa/Kelurahan</th>
            <td>:</td>
            <td><input type="text" class="form-control" name="desa_kelurahan_penduduk" value="<?= $data['desa_kelurahan_penduduk'] ?>"></td>
        </tr>
        <tr>
            <th>Kecamatan</th>
            <td>:</td>
            <td><input type="text" class="form-control" name="kecamatan_penduduk" value="<?= $data['kecamatan_penduduk'] ?>"></td>
        </tr>
        <tr>
            <th>Kabupaten/Kota</th>
            <td>:</td>
            <td><input type="text" class="form-control" name="kabupaten_kota_penduduk" value="<?= $data['kabupaten_kota_penduduk'] ?>"></td>
        </tr>
        <tr>
            <th>Provinsi</th>
            <td>:</td>
            <td><input type="text" class="form-control" name="provinsi_penduduk" value="<?= $data['provinsi_penduduk'] ?>"></td>
        </tr>
        <tr>
            <th>Negara</th>
            <td>:</td>
            <td><input type="text" class="form-control" name="negara_penduduk" value="<?= $data['negara_penduduk'] ?>"></td>
        </tr>
        <tr>
            <th>RT</th>
            <td>:</td>
            <td><input type="text" class="form-control" name="rt_penduduk" value="<?= $data['rt_penduduk'] ?>"></td>
        </tr>
        <tr>
            <th>RW</th>
            <td>:</td>
            <td><input type="text" class="form-control" name="rw_penduduk" value="<?= $data['rw_penduduk'] ?>"></td>
        </tr>
    </table>

    <h3>C. Data Lain-lain</h3>
    <table class="table table-striped table-middle">
        <tr>
            <th width="20%">Agama</th>
            <td width="1%">:</td>
            <td>
                <select class="form-control" name="agama_penduduk" required>
                    <?php
                    if ($data['agama_penduduk'] === "Islam") echo "<option value='Islam' selected>Islam</option>";
                    else echo "<option value='Islam'>Islam</option>";
                    if ($data['agama_penduduk'] === "Kristen") echo "<option value='Kristen' selected>Kristen</option>";
                    else echo "<option value='Kristen'>Kristen</option>";
                    if ($data['agama_penduduk'] === "Katolik") echo "<option value='Katolik' selected>Katolik</option>";
                    else echo "<option value='Katolik'>Katolik</option>";
                    if ($data['agama_penduduk'] === "Hindu") echo "<option value='Hindu' selected>Hindu</option>";
                    else echo "<option value='Hindu'>Hindu</option>";
                    if ($data['agama_penduduk'] === "Buddha") echo "<option value='Buddha' selected>Buddha</option>";
                    else echo "<option value='Buddha'>Buddha</option>";
                    if ($data['agama_penduduk'] === "Konghucu") echo "<option value='Konghucu' selected>Konghucu</option>";
                    else echo "<option value='Konghucu'>Konghucu</option>";
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <th>Pendidikan Terakhir</th>
            <td>:</td>
            <td>
                <select class="form-control" name="pendidikan_terakhir_penduduk" required>
                    <?php
                    if ($data['pendidikan_terakhir_penduduk'] === "Tidak Sekolah") echo "<option value='Tidak Sekolah' selected>Tidak Sekolah</option>";
                    else echo "<option value='Tidak Sekolah'>Tidak Sekolah</option>";
                    if ($data['pendidikan_terakhir_penduduk'] === "Tidak Tamat SD") echo "<option value='Tidak Tamat SD' selected>Tidak Tamat SD</option>";
                    else echo "<option value='Tidak Tamat SD'>Tidak Tamat SD</option>";
                    if ($data['pendidikan_terakhir_penduduk'] === "SD") echo "<option value='SD' selected>SD</option>";
                    else echo "<option value='SD'>SD</option>";
                    if ($data['pendidikan_terakhir_penduduk'] === "SMP") echo "<option value='SMP' selected>SMP</option>";
                    else echo "<option value='SMP'>SMP</option>";
                    if ($data['pendidikan_terakhir_penduduk'] === "SMK/SMA Sederajat") echo "<option value='SMK/SMA Sederajat' selected>SMK/SMA Sederajat</option>";
                    else echo "<option value='SMK/SMA Sederajat'>SMK/SMA Sederajat</option>";
                    if ($data['pendidikan_terakhir_penduduk'] === "D1") echo "<option value='D1' selected>D1</option>";
                    else echo "<option value='D1'>D1</option>";
                    if ($data['pendidikan_terakhir_penduduk'] === "D2") echo "<option value='D2' selected>D2</option>";
                    else echo "<option value='D2'>D2</option>";
                    if ($data['pendidikan_terakhir_penduduk'] === "D3") echo "<option value='D3' selected>D3</option>";
                    else echo "<option value='D3'>D3</option>";
                    if ($data['pendidikan_terakhir_penduduk'] === "S1") echo "<option value='S1' selected>S1</option>";
                    else echo "<option value='S1'>S1</option>";
                    if ($data['pendidikan_terakhir_penduduk'] === "S2") echo "<option value='S2' selected>S2</option>";
                    else echo "<option value='S2'>S2</option>";
                    if ($data['pendidikan_terakhir_penduduk'] === "S3") echo "<option value='S3' selected>S3</option>";
                    else echo "<option value='S3'>S3</option>";
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <th>Pekerjaan</th>
            <td>:</td>
            <td><input type="text" class="form-control" name="pekerjaan_penduduk" value="<?= $data['pekerjaan_penduduk'] ?>"></td>
        </tr>
        <tr>
            <th>Status Perkawinan</th>
            <td>:</td>
            <td>
                <select class="form-control" name="status_perkawinan_penduduk" required>
                    <?php
                    if ($data['status_perkawinan_penduduk'] === "Kawin") echo "<option value='Kawin' selected>Kawin</option>";
                    else echo "<option value='Kawin'>Kawin</option>";
                    if ($data['status_perkawinan_penduduk'] === "Tidak Kawin") echo "<option value='Tidak Kawin' selected>Tidak Kawin</option>";
                    else echo "<option value='Tidak Kawin'>Tidak Kawin</option>";
                    ?>
                </select>
            </td>
        </tr>
    </table>
    <div class="d-flex">
        <button type="submit" class="btn btn-primary" name="ubah">
            <i class="fa-solid fa-floppy-disk"></i>
            Ubah
        </button>
</form>
<a href="index.php?page=penduduk" class="btn btn-secondary ml-2">
    <i class="fa-solid fa-xmark"></i>
    Batal
</a>
<?php

if (isset($_POST['ubah'])) {
    $sql = "UPDATE `penduduk` SET 
           `nama_penduduk` = '" . $_POST['nama_penduduk'] . "', 
           `tempat_lahir_penduduk` = '" . $_POST['tempat_lahir_penduduk'] . "', 
           `tanggal_lahir_penduduk` = '" . $_POST['tanggal_lahir_penduduk'] . "', 
           `jenis_kelamin_penduduk` = '" . $_POST['jenis_kelamin_penduduk'] . "', 
           `alamat_penduduk` = '" . $_POST['alamat_penduduk'] . "', 
           `desa_kelurahan_penduduk` = '" . $_POST['desa_kelurahan_penduduk'] . "', 
           `kecamatan_penduduk` = '" . $_POST['kecamatan_penduduk'] . "', 
           `kabupaten_kota_penduduk` = '" . $_POST['kabupaten_kota_penduduk'] . "', 
           `provinsi_penduduk` = '" . $_POST['provinsi_penduduk'] . "', 
           `negara_penduduk` = '" . $_POST['negara_penduduk'] . "', 
           `rt_penduduk` = '" . $_POST['rt_penduduk'] . "', 
           `rw_penduduk` = '" . $_POST['rw_penduduk'] . "', 
           `agama_penduduk` = '" . $_POST['agama_penduduk'] . "', 
           `pendidikan_terakhir_penduduk` = '" . $_POST['pendidikan_terakhir_penduduk'] . "', 
           `pekerjaan_penduduk` = '" . $_POST['pekerjaan_penduduk'] . "', 
           `status_perkawinan_penduduk` = '" . $_POST['status_perkawinan_penduduk'] . "' 
           WHERE `penduduk`.`id_penduduk` = '" . $_POST['id_penduduk'] . "'";
    $query = mysqli_query($koneksi, $sql);
    mysqli_close($koneksi);

    if ($query) {
        echo "<script>
      Swal.fire({title: 'Ubah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
      }).then((result) => {if (result.value)
        {window.location = 'index.php?page=penduduk';
        }
      })</script>";
    } else {
        echo "<script>
      Swal.fire({title: 'Ubah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
      }).then((result) => {if (result.value)
        {window.location = 'index.php?page=penduduk';
        }
      })</script>";
    }
}
