<div class="card card-dark">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fa fa-file"></i> Kematian
        </h3>
    </div>
    <div class="card-body">
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Penduduk</label>
            <div class="col-sm-6">
                <select name="id_surat_kematian" id="id_surat_kematian" class="form-control select2bs4" required>
                    <option selected="selected">- Pilih Data -</option>
                    <?php
                    $query = "SELECT id_surat_kematian, nik_penduduk, nama_penduduk FROM surat_kematian JOIN penduduk ON 
				                  surat_kematian.id_penduduk=penduduk.id_penduduk";
                    $hasil = mysqli_query($koneksi, $query);
                    foreach ($hasil as $row) :
                    ?>
                        <option value="<?= $row['id_surat_kematian'] ?>">
                            <?= $row['nik_penduduk'] ?>
                            -
                            <?= $row['nama_penduduk'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <a href="./report/cetak_kematian.php?id_surat_kematian=<?= $row['id_surat_kematian'] ?>" class="btn btn-primary" target="_blank">Cetak</a>
    </div>
</div>