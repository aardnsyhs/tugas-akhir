<?php
if (isset($_GET['id_kk'])) {
    $id_kk = $_GET['id_kk'];
    $sql_cek = "SELECT * FROM `kk` JOIN `penduduk` ON kk.id_penduduk=penduduk.id_penduduk WHERE id_kk='$id_kk'";
    $query_cek = mysqli_query($koneksi, $sql_cek);
    $data_cek = mysqli_fetch_array($query_cek, MYSQLI_BOTH);
    $karkel = $data_cek['id_kk'];
}
?>
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fa fa-users mr-2"></i>Anggota Kartu Keluarga
        </h3>
    </div>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="card-body">
            <input type='hidden' class="form-control" id="id_kk" name="id_kk" value="<?= $data_cek['id_kk']; ?>" disabled />
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">No KK | Kepala Keluarga</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="no_kk" name="no_kk" value="<?= $data_cek['no_kk']; ?>" disabled />
                </div>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="kepala" name="kepala" value="<?= $data_cek['k_keluarga']; ?>" disabled />
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Alamat</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" value="<?= $data_cek['alamat_penduduk']; ?>, RT <?= $data_cek['rt_penduduk']; ?> RW <?= $data_cek['rw_penduduk']; ?> (<?= $data_cek['kecamatan_penduduk']; ?> - <?= $data_cek['kabupaten_kota_penduduk']; ?> - <?= $data_cek['provinsi_penduduk']; ?>)" disabled />
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Anggota</label>
                <div class="col-sm-4">
                    <select name="id_pend" id="id_pend" class="form-control select2bs4" required>
                        <option selected="selected">- Penduduk -</option>
                        <?php
                        $query = "SELECT * FROM `penduduk`";
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
                </div>
                <div class="col-sm-3">
                    <select name="hubungan" id="hubungan" class="form-control">
                        <option>- Hub Keluarga -</option>
                        <option>Kepala Keluarga</option>
                        <option>Istri</option>
                        <option>Anak</option>
                        <option>Orang Tua</option>
                        <option>Mertua</option>
                        <option>Menantu</option>
                        <option>Cucu</option>
                        <option>Famili Lain</option>
                    </select>
                </div>
                <input type="submit" name="Simpan" value="Tambah" class="btn btn-primary">
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>NIK</th>
                                <th>Nama</th>
                                <th>Jenis Kelamin</th>
                                <th>Hubungan Keluarga</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = $koneksi->query("SELECT p.nik_penduduk, p.nama_penduduk, p.jenis_kelamin_penduduk, a.hub_keluarga, a.id_anggota 
			  										FROM penduduk p JOIN anggota_keluarga a ON p.id_penduduk=a.id_penduduk
													WHERE status='Ada' AND id_kk=$karkel");
                            while ($data = $sql->fetch_assoc()) {
                            ?>
                                <tr>
                                    <td>
                                        <?= $data['nik_penduduk']; ?>
                                    </td>
                                    <td>
                                        <?= $data['nama_penduduk']; ?>
                                    </td>
                                    <td>
                                        <?= $data['jenis_kelamin_penduduk']; ?>
                                    </td>
                                    <td>
                                        <?= $data['hub_keluarga']; ?>
                                    </td>
                                    <td>
                                        <a href="?page=hapus_anggota&id_anggota=<?= $data['id_anggota']; ?>" onclick="return confirm('Apakah anda yakin hapus data ini ?')" title="Hapus" class="btn btn-danger btn-sm">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <a href="?page=kk" title="Kembali" class="btn btn-warning">Kembali</a>
        </div>
    </form>
</div>
<?php
if (isset($_POST['Simpan'])) {
    $id_kk = $_GET['id_kk'];
    $id_penduduk = $_POST['id_pend'];
    $hub = $_POST['hubungan'];
    $query = "INSERT INTO `anggota_keluarga` (`id_anggota`, `id_kk`, `id_penduduk`, `hub_keluarga`) VALUES (NULL, '$id_kk', '$id_penduduk', '$hub')";
    $hasil = mysqli_query($koneksi, $query);
    mysqli_close($koneksi);

    if ($hasil) {
        echo "<script>
                Swal.fire({title: 'Tambah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
                }).then((result) => {if (result.value){
                    window.location = 'index.php?page=anggota&id_kk=" . $id_kk . "';
                    }
                })
              </script>";
    } else {
        echo "<script>
                Swal.fire({title: 'Tambah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
                }).then((result) => {if (result.value){
                    window.location = 'index.php?page=anggota&id_kk=" . $id_kk . "';
                    }
                })
              </script>";
    }
}
?>