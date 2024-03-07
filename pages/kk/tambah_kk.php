<form action="" method="post">
    <h3>Tambah Kartu Keluarga</h3>
    <table class="table table-striped table-middle">
        <tr>
            <th width="20%">NIK</th>
            <td width="1%">:</td>
            <td><input type="text" class="form-control" name="nik_penduduk" required></td>
        </tr>
        <tr>
            <th>Nama Kepala Keluarga</th>
            <td>:</td>
            <td><input type="text" class="form-control" name="k_keluarga" required></td>
        </tr>
    </table>
    <button type="submit" class="btn btn-primary" name="simpan">
        <i class="fa-solid fa-floppy-disk"></i>
        Simpan
    </button>
</form>
<?php
include "config/connection.php";
if (isset($_POST['simpan'])) {
    $nik_penduduk = $_POST['nik_penduduk'];
    $k_keluarga = $_POST['k_keluarga'];
}
?>