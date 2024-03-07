<?php

$sql = $koneksi->query("SELECT COUNT(id_penduduk) AS pend FROM penduduk WHERE status='Ada'");
while ($data = $sql->fetch_assoc()) {
    $pend = $data['pend'];
}

$sql = $koneksi->query("SELECT COUNT(id_kk) AS kartu FROM kk");
while ($data = $sql->fetch_assoc()) {
    $kartu = $data['kartu'];
}

$sql = $koneksi->query("SELECT COUNT(id_penduduk) AS laki FROM penduduk WHERE jenis_kelamin_penduduk='Laki-Laki'");
while ($data = $sql->fetch_assoc()) {
    $laki = $data['laki'];
}

$sql = $koneksi->query("SELECT COUNT(id_penduduk) AS prem FROM penduduk WHERE jenis_kelamin_penduduk='Perempuan'");
while ($data = $sql->fetch_assoc()) {
    $prem = $data['prem'];
}

$sql = $koneksi->query("SELECT COUNT(id_surat_kematian) AS mendu FROM surat_kematian");
while ($data = $sql->fetch_assoc()) {
    $mendu = $data['mendu'];
}

$sql = $koneksi->query("SELECT COUNT(id_surat_pindah) AS pindah FROM surat_pindah");
while ($data = $sql->fetch_assoc()) {
    $pindah = $data['pindah'];
}
?>
<div class="row">
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>
                    <?php echo $pend;  ?>
                </h3>
                <p>Penduduk</p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>
                    <?php echo $kartu;  ?>
                </h3>
                <p>Kartu Keluarga</p>
            </div>
            <div class="icon">
                <i class="ion ion-card"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-red">
            <div class="inner">
                <h3>
                    <?php echo $laki;  ?>
                </h3>
                <p>Laki-laki</p>
            </div>
            <div class="icon">
                <i class="ion ion-male"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>
                    <?php echo $prem;  ?>
                </h3>
                <p>Perempuan</p>
            </div>
            <div class="icon">
                <i class="ion ion-female"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>
                    <?php echo $mendu;  ?>
                </h3>

                <p>Meninggal</p>
            </div>
            <div class="icon">
                <i class="ion ion-android-sad"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>
                    <?php echo $pindah;  ?>
                </h3>
                <p>Pindah</p>
            </div>
            <div class="icon">
                <i class="ion ion-android-upload"></i>
            </div>
        </div>
    </div>
</div>