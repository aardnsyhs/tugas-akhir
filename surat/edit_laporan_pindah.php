<?php
$get_id_penduduk = $_GET['id_penduduk'];
$query = "SELECT p.*, spt.*
        FROM penduduk p
        JOIN surat_pindah_temp spt ON p.id_penduduk = spt.id_penduduk
        WHERE p.id_penduduk = '$get_id_penduduk'";
$hasil = mysqli_query($koneksi, $query);

$sql_kk = "SELECT * FROM penduduk JOIN anggota_keluarga ON penduduk.id_penduduk = anggota_keluarga.id_penduduk WHERE penduduk.id_penduduk=$get_id_penduduk";
$query = mysqli_query($koneksi, $sql_kk);
$hasil_id_kk = mysqli_fetch_assoc($query);
$id_kk = $hasil_id_kk['id_kk'];

if (!$hasil) {
    die('Error: ' . mysqli_error($koneksi));
}

$data_pindah = mysqli_fetch_all($hasil, MYSQLI_ASSOC);
if (count($data_pindah) == 0) {
    die('No data found for the given id_penduduk.');
}

$alamat_penduduk = $data_pindah[0]['alamat_penduduk'] . ", Rt: " . $data_pindah[0]['rt_penduduk'] . "/" .
    $data_pindah[0]['rw_penduduk'] . ", " . $data_pindah[0]['desa_kelurahan_penduduk'] . ", " .
    $data_pindah[0]['kecamatan_penduduk'] . ", " . $data_pindah[0]['kabupaten_kota_penduduk'] . ", " .
    $data_pindah[0]['provinsi_penduduk'];
?>
<div class="mb-2">
    <h2>A. Detail Data Pindah Penduduk</h2>
    <form action="" method="POST">
        <table class="table table-striped">
            <input type="hidden" name="id_surat_pindah_temp" value="<?= $data_pindah[0]['id_surat_pindah_temp'] ?>">
            <tr>
                <th width="22%">NIK</th>
                <td width="1%">:</td>
                <td><?= $data_pindah[0]['nik_penduduk'] ?></td>
            </tr>
            <tr>
                <th>Nama Penduduk Pindah</th>
                <td>:</td>
                <td><?= $data_pindah[0]['nama_penduduk'] ?></td>
            </tr>
            <tr>
                <th>Alamat Lama</th>
                <td>:</td>
                <td><?= $alamat_penduduk ?></td>
            </tr>
        </table>
</div>
<div class="mb-2">
    <h3>B. Data Baru</h3>
    <table class="table table-striped">
        <tr>
            <th width="22%">Alamat Baru</th>
            <td width="1%">:</td>
            <td><input class="form-control" type="text" name="alamat_baru" value="<?= $data_pindah[0]['alamat_baru'] ?>"></td>
        </tr>
        <tr>
            <th width="22%">RT Baru</th>
            <td width="1%">:</td>
            <td><input class="form-control" type="number" name="rt_baru" value="<?= $data_pindah[0]['rt_baru'] ?>"></td>
        </tr>
        <tr>
            <th width="22%">RW Baru</th>
            <td width="1%">:</td>
            <td><input class="form-control" type="number" name="rw_baru" value="<?= $data_pindah[0]['rw_baru'] ?>"></td>
        </tr>
        <tr>
            <th width="22%">Kelurahan Baru</th>
            <td width="1%">:</td>
            <td><input type="text" class="form-control" name="desa_kelurahan_baru" value="<?= $data_pindah[0]['desa_kelurahan_baru'] ?>"></td>
        </tr>
        <tr>
            <th width="22%">Kecamatan Baru</th>
            <td width="1%">:</td>
            <td><input type="text" class="form-control" name="kecamatan_baru" value="<?= $data_pindah[0]['kecamatan_baru'] ?>"></td>
        </tr>
        <tr>
            <th width="22%">Kota Baru</th>
            <td width="1%">:</td>
            <td><input type="text" class="form-control" name="kabupaten_kota_baru" value="<?= $data_pindah[0]['kabupaten_kota_baru'] ?>"></td>
        </tr>
        <tr>
            <th width="22%">Provinsi Baru</th>
            <td width="1%">:</td>
            <td><input type="text" class="form-control" name="provinsi_baru" value="<?= $data_pindah[0]['provinsi_baru'] ?>"></td>
        </tr>
        <tr>
            <th width="22%">Alasan Pindah</th>
            <td width="1%">:</td>
            <td><input type="text" class="form-control" name="alasan_pindah" value="<?= $data_pindah[0]['alasan_pindah'] ?>"></td>
        </tr>
    </table>
    <div class="d-flex">
        <button type="submit" class="btn btn-primary" name="ubah">
            <i class="fa-solid fa-floppy-disk"></i>
            Ubah
        </button>
        </form>
    </div>
    <div class="mt-2">
        <h3>C. Anggota Keluarga Pindah</h3>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIK</th>
                    <th>Nama Penduduk Pindah</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                $sql = $koneksi->query("SELECT * FROM anggota_keluarga_pindah_temp JOIN penduduk ON anggota_keluarga_pindah_temp.id_penduduk=penduduk.id_penduduk WHERE id_kk='$id_kk'");
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
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
    <a href="index.php?page=surat_pindah" class="btn btn-warning">
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

        $sql = "UPDATE surat_pindah_temp SET alamat_baru = '$alamat_baru', rt_baru = '$rt_baru', 
        rw_baru = '$rw_baru', desa_kelurahan_baru = '$desa_kelurahan_baru', kecamatan_baru = 
        '$kecamatan_baru', kabupaten_kota_baru = '$kabupaten_kota_baru', provinsi_baru = 
        '$provinsi_baru', alasan_pindah = '$alasan_pindah' WHERE id_surat_pindah_temp = '$id_surat_pindah_temp'";
        $query = mysqli_query($koneksi, $sql);

        if ($query) {
            echo "<script>
          Swal.fire({title: 'Ubah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
          }).then((result) => {if (result.value)
            {window.location = 'index.php?page=surat_pindah';
            }
          })</script>";
        } else {
            echo "<script>
          Swal.fire({title: 'Ubah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
          }).then((result) => {if (result.value)
            {window.location = 'index.php?page=surat_pindah';
            }
          })</script>";
        }
    }
