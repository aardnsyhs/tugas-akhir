<?php

if (isset($_GET['id_anggota'])) {
    $sql_hapus = "DELETE FROM anggota_keluarga WHERE id_anggota='" . $_GET['id_anggota'] . "'";
    $query_hapus = mysqli_query($koneksi, $sql_hapus);
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
