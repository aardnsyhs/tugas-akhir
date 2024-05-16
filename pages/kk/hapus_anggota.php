<?php
if (isset($_GET['id_anggota'])) {
    $sql = "DELETE FROM anggota_keluarga WHERE id_anggota='" . $_GET['id_anggota'] . "'";
    $sql = "UPDATE penduduk JOIN anggota_keluarga ON penduduk.id_penduduk=anggota_keluarga.id_penduduk SET penduduk.status_keluarga='Belum Berkeluarga' WHERE anggota_keluarga.id_anggota='" . $_GET['id_anggota'] . "'";
    $query_hapus = mysqli_query($koneksi, $sql);
    $kode = $_GET['id_anggota'];
    if ($query_hapus) {
        echo "<script>
                Swal.fire({title: 'Hapus Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.value) {
                        window.location = 'index.php?page=kk';
                    }
                })</script>";
    } else {
        echo "<script>
                Swal.fire({title: 'Hapus Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.value) {
                        window.location = 'index.php?page=kk';
                    }
                })</script>";
    }
}
