<form action="" method="post">
    <h3>A. Data Pribadi</h3>
    <table class="table table-striped table-middle">
        <tr>
            <th width="20%">Nama Penduduk</th>
            <td width="1%">:</td>
            <td><input type="text" class="form-control" name="nama_penduduk" required></td>
        </tr>
        <tr>
            <th>Tempat Lahir</th>
            <td>:</td>
            <td><input type="text" class="form-control" name="tempat_lahir_penduduk" required></td>
        </tr>
        <tr>
            <th>Tanggal Lahir</th>
            <td>:</td>
            <td><input type="date" class="form-control" name="tanggal_lahir_penduduk" required></td>
        </tr>
        <tr>
            <th>Jenis Kelamin</th>
            <td>:</td>
            <td>
                <select class="form-control" name="jenis_kelamin_penduduk" required>
                    <option selected disabled>- Pilih -</option>
                    <option value="Laki-Laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </td>
        </tr>
    </table>
    <h3>B. Data Alamat</h3>
    <table class="table table-striped table-middle">
        <tr>
            <th width="20%">Alamat</th>
            <td width="1%">:</td>
            <td><textarea class="form-control" name="alamat_penduduk" required></textarea></td>
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
            <th>Negara</th>
            <td>:</td>
            <td>
                <select class="form-control" name="negara_penduduk" required>
                    <option selected disabled>- Pilih -</option>
                    <option value="WNI">WNI</option>
                    <option value="WNA">WNA</option>
                </select>
            </td>
        </tr>
        <tr>
            <th>RT</th>
            <td>:</td>
            <td><input type="text" class="form-control" name="rt_penduduk"></td>
        </tr>
        <tr>
            <th>RW</th>
            <td>:</td>
            <td><input type="text" class="form-control" name="rw_penduduk"></td>
        </tr>
    </table>

    <h3>C. Data Lain-lain</h3>
    <table class="table table-striped table-middle">
        <tr>
            <th width="20%">Agama</th>
            <td width="1%">:</td>
            <td>
                <select class="form-control" name="agama_penduduk" required>
                    <option selected disabled>- Pilih -</option>
                    <option value="Islam">Islam</option>
                    <option value="Kristen">Kristen</option>
                    <option value="Katholik">Katolik</option>
                    <option value="Hindu">Hindu</option>
                    <option value="Budha">Buddha</option>
                    <option value="Konghucu">Konghucu</option>
                </select>
            </td>
        </tr>
        <tr>
            <th>Pendidikan Terakhir</th>
            <td>:</td>
            <td>
                <select class="form-control" name="pendidikan_terakhir_penduduk" required>
                    <option selected disabled>- Pilih -</option>
                    <option value="Tidak Sekolah">Tidak Sekolah</option>
                    <option value="Tidak Tamat SD">Tidak Tamat SD</option>
                    <option value="SD">SD</option>
                    <option value="SMP">SMP</option>
                    <option value="SMK/SMA Sederajat">SMK/SMA Sederajat</option>
                    <option value="D1">D1</option>
                    <option value="D2">D2</option>
                    <option value="D3">D3</option>
                    <option value="S1">S1</option>
                    <option value="S2">S2</option>
                    <option value="S3">S3</option>
                </select>
            </td>
        </tr>
        <tr>
            <th>Pekerjaan</th>
            <td>:</td>
            <td><input type="text" class="form-control" name="pekerjaan_penduduk"></td>
        </tr>
        <tr>
            <th>Status Perkawinan</th>
            <td>:</td>
            <td>
                <select class="form-control" name="status_perkawinan_penduduk" required>
                    <option selected disabled>- Pilih -</option>
                    <option value="Kawin">Kawin</option>
                    <option value="Belum Kawin">Belum Kawin</option>
                    <option value="Tidak Kawin">Tidak Kawin</option>
                    <option value="Cerai">Cerai</option>
                </select>
            </td>
        </tr>
    </table>
    <div class="d-flex">
        <button type="submit" class="btn btn-primary" name="simpan">
            <i class="fa-solid fa-floppy-disk"></i>
            Simpan
        </button>
</form>
<a href="index.php?page=penduduk" class="btn btn-secondary ml-2">
    <i class="fa-solid fa-xmark"></i>
    Batal
</a>
<?php
if (isset($_POST['simpan'])) {
    $nama_penduduk = $_POST['nama_penduduk'];
    $tempat_lahir_penduduk = $_POST['tempat_lahir_penduduk'];
    $jenis_kelamin_penduduk = $_POST['jenis_kelamin_penduduk'];
    $alamat_penduduk = $_POST['alamat_penduduk'];
    $desa_kelurahan_penduduk = $_POST['desa_kelurahan_penduduk'];
    $kecamatan_penduduk = $_POST['kecamatan_penduduk'];
    $kabupaten_kota_penduduk = $_POST['kabupaten_kota_penduduk'];
    $provinsi_penduduk = $_POST['provinsi_penduduk'];
    $negara_penduduk = $_POST['negara_penduduk'];
    $rt_penduduk = $_POST['rt_penduduk'];
    $rw_penduduk = $_POST['rw_penduduk'];
    $agama_penduduk = $_POST['agama_penduduk'];
    $pendidikan_terakhir_penduduk = $_POST['pendidikan_terakhir_penduduk'];
    $pekerjaan_penduduk = $_POST['pekerjaan_penduduk'];
    $status_perkawinan_penduduk = $_POST['status_perkawinan_penduduk'];

    function generateNIK($kode_provinsi, $kode_kota, $kode_kecamatan, $tanggal_lahir, $nomor_urut)
    {
        $tanggal_lahir_format = date('dmy', strtotime($tanggal_lahir));
        $nik_penduduk = $kode_provinsi . $kode_kota . $kode_kecamatan . $tanggal_lahir_format . sprintf('%04d', $nomor_urut);
        return $nik_penduduk;
    }
    $tanggal_lahir_penduduk = $_POST['tanggal_lahir_penduduk'];
    $nik_penduduk = generateNIK("32", "77", "03", $tanggal_lahir_penduduk, 1);

    $pass_nik = md5($nik_penduduk);

    $sql = "INSERT INTO `user` (`id_user`, `id_role`, `nama_user`, `username`, `password`, `password_changed`, `status_user`) 
            VALUES (NULL, '4', '$nama_penduduk', '$nik_penduduk', '$pass_nik', '0', 'Penduduk');";
    $hasil_user = mysqli_query($koneksi, $sql);

    if ($hasil_user) {
        $sql = "SELECT id_user FROM user WHERE username = '$nik_penduduk'";
        $hasil_penduduk = mysqli_query($koneksi, $sql);
        $data_penduduk = mysqli_fetch_assoc($hasil_penduduk);
        $id_user = $data_penduduk['id_user'];

        $query = "INSERT INTO `penduduk`
                    VALUES (NULL, '$id_user', '$nik_penduduk', '$nama_penduduk', '$tempat_lahir_penduduk',
                                    '$tanggal_lahir_penduduk', '$jenis_kelamin_penduduk',
                                    '$alamat_penduduk', '$desa_kelurahan_penduduk', '$kecamatan_penduduk', '$kabupaten_kota_penduduk', 
                                    '$provinsi_penduduk', '$negara_penduduk', '$rt_penduduk', '$rw_penduduk', '$agama_penduduk', 
                                    '$pendidikan_terakhir_penduduk', '$pekerjaan_penduduk', '$status_perkawinan_penduduk', 'Ada', 'Belum Berkeluarga')";

        $query = "SELECT id_penduduk, alamat_penduduk, rt_penduduk, rw_penduduk, desa_kelurahan_penduduk, kecamatan_penduduk, kabupaten_kota_penduduk, provinsi_penduduk FROM penduduk JOIN user ON penduduk.id_user=user.id_user WHERE user.id_user='$id_user'";
        $cek_id_penduduk = mysqli_query($koneksi, $query);
        $hasil = mysqli_fetch_assoc($cek_id_penduduk);
        $id_penduduk = $hasil['id_penduduk'];      

        var_dump($id_penduduk);
        die();

        $query = "INSERT INTO riwayat_tinggal VALUES (NULL, '$id_penduduk', )";
        $hasil = mysqli_query($koneksi, $query);
        if ($hasil) {
            // Membuat User
            echo "<script>
                Swal.fire({title: 'Tambah Data Penduduk Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
                }).then((result) => {if (result.value){
                    window.location = 'index.php?page=penduduk';
                    }
                })
              </script>";
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
        }
    }
}
?>