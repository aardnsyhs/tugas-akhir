<?php
if (isset($_GET['no_kk'])) {
    $encoded_no_kk = $_GET['no_kk'];
    $no_kk = decrypt($encoded_no_kk);

    $sql_cek = "SELECT * FROM `kk` JOIN `penduduk` ON kk.id_penduduk=penduduk.id_penduduk WHERE no_kk='$no_kk'";
    $query_cek = mysqli_query($koneksi, $sql_cek);
    $data_cek = mysqli_fetch_array($query_cek, MYSQLI_BOTH);
    $karkel = encrypt($data_cek['no_kk']);
}
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
    <h3>C. Keperluan</h3>
    <table class="table table-striped table-middle">
        <tr>
            <th width="20%">Alasan Pindah</th>
            <td width="1%">:</td>
            <td><input type="text" class="form-control" name="alasan_pindah" required></td>
        </tr>
        <tr>
            <td>
                <div class="form-group row">
                    <label class="form-label">Anggota Keluarga</label>
                    <div>
                        <select name="id_penduduk" id="id_penduduk" class="form-control select2bs4" required>
                            <option selected="selected">- Anggota Keluarga -</option>
                            <?php
                            $sql = $koneksi->query("SELECT p.nik_penduduk, p.nama_penduduk, p.id_penduduk, a.id_anggota 
                            FROM penduduk p 
                            JOIN anggota_keluarga a ON p.id_penduduk = a.id_penduduk
                            WHERE a.id_kk IN (SELECT id_kk FROM kk WHERE no_kk = '$no_kk') AND status='Ada'");
                            while ($data = $sql->fetch_assoc()) {
                            ?>
                                <option value="<?= $data['id_penduduk'] ?>">
                                    <?= $data['nik_penduduk'] ?> - <?= $data['nama_penduduk'] ?>
                                </option>
                            <?php } ?>
                        </select>
                        <input type="submit" name="Simpan" value="Tambah" class="btn btn-primary mt-2">
                    </div>
                </div>
            </td>
        </tr>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIK</th>
                    <th>Nama Penduduk Pindah</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                $sql = $koneksi->query("SELECT * FROM penduduk JOIN anggota_keluarga_pindah ON anggota_keluarga_pindah.id_penduduk=penduduk.id_penduduk JOIN kk ON penduduk.id_penduduk=kk.id_penduduk WHERE kk.no_kk='$karkel'");
                while ($data = $sql->fetch_assoc()) {
                ?>
                    <tr>
                        <td>
                            <?= $no++ ?>
                        </td>
                        <td>
                            <?= $data['nik_penduduk']; ?>
                        </td>
                        <td>
                            <?= $data['nama_penduduk']; ?>
                        </td>
                        <td>
                            <a href="?page=hapus_anggota_pindah&id_anggota_keluarga_pindah=<?= $data['id_anggota_keluarga_pindah']; ?>&no_kk=<?= encrypt($no_kk) ?>" onclick="return confirm('Apakah anda yakin hapus data ini ?')" title="Hapus" class="btn btn-danger btn-sm">
                                <i class="fa fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </table>
    <button type="submit" class="btn btn-primary" name="Laporkan">
        <i class="fa-solid fa-floppy-disk"></i>
        Laporkan
    </button>
</form>
<?php
if (isset($_POST['Simpan'])) {
    $encoded_no_kk = $_GET['no_kk'];
    $no_kk = decrypt($encoded_no_kk);

    $id_penduduk = $_POST['id_penduduk'];
    $query = "INSERT INTO `anggota_keluarga_pindah` VALUES (NULL, '$id_penduduk')";
    $hasil = mysqli_query($koneksi, $query);
    $no_kk = encrypt($no_kk);

    if ($hasil) {
        echo "<script>
                Swal.fire({title: 'Tambah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
                }).then((result) => {if (result.value){
                    window.location = 'index.php?page=lapor_pindah&no_kk=" . $no_kk . "';
                    }
                })
              </script>";
    } else {
        echo "<script>
                Swal.fire({title: 'Tambah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
                }).then((result) => {if (result.value){
                    window.location = 'index.php?page=lapor_pindah&no_kk=" . $no_kk . "';
                    }
                })
              </script>";
    }
} elseif (isset($_POST['Laporkan'])) {
    $alamat_baru = $_POST['alamat_baru'];
    $rt_baru = $_POST['rt_baru'];
    $rw_baru = $_POST['rw_baru'];
    $desa_kelurahan_baru = $_POST['desa_kelurahan_baru'];
    $kecamatan_baru = $_POST['kecamatan_baru'];
    $kabupaten_kota_baru = $_POST['kabupaten_kota_baru'];
    $provinsi_baru = $_POST['provinsi_baru'];
    $alasan_pindah = $_POST['alasan_pindah'];

    $query = "SELECT id_penduduk FROM `penduduk` WHERE id_user = '$data_id'";
    $hasil_penduduk = mysqli_query($koneksi, $query);
    $data_penduduk = mysqli_fetch_assoc($hasil_penduduk);
    $id_penduduk = $data_penduduk['id_penduduk'];

    $sql = "INSERT INTO `surat_pindah_temp` VALUES (NULL, '$id_penduduk', '$alamat_baru', '$rt_baru', '$rw_baru', '$desa_kelurahan_baru', '$kecamatan_baru', '$kabupaten_kota_baru', '$provinsi_baru', '$alasan_pindah')";
    $query_simpan = mysqli_query($koneksi, $sql);

    if ($query_simpan) {
        echo "<script>
      Swal.fire({title: 'Tambah Laporan Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
          window.location = 'index.php?page=lapor_pindah&no_kk=" . encrypt($no_kk) . "';
          }
      })</script>";
    } else {
        echo "<script>
      Swal.fire({title: 'Tambah Laporan Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
          window.location = 'index.php?page=lapor_pindah&no_kk=" . encrypt($no_kk) . "';
          }
      })</script>";
    }
}
