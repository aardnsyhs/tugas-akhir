<div class="card card-dark">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fa fa-file"></i> Kematian
        </h3>
    </div>
    <form action="./report/cetak_kematian.php" method="post" enctype="multipart/form-data">
        <div class="card-body">
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Penduduk</label>
                <div class="col-sm-6">
                    <select name="id_surat_kematian" id="id_surat_kematian" class="form-control select2bs4" required>
                        <option selected="selected">- Pilih Data -</option>
                        <?php
                        // ambil data dari database
                        $query = "SELECT id_surat_kematian, nik_penduduk, nama_penduduk FROM surat_kematian JOIN penduduk ON 
                        surat_kematian.id_penduduk=penduduk.id_penduduk";
                        $hasil = mysqli_query($koneksi, $query);
                        while ($row = mysqli_fetch_array($hasil)) {
                        ?>
                            <option value="<?php echo $row['id_surat_kematian'] ?>">
                                <?php echo $row['nik_penduduk'] ?>
                                -
                                <?php echo $row['nama_penduduk'] ?>
                            </option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <input type="submit" name="Cetak" value="Cetak" class="btn btn-primary">
        </div>
    </form>
</div>