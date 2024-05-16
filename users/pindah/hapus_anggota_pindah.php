<?php
if (isset($_GET['id_anggota_keluarga_pindah'])) {
    if (isset($_GET['no_kk'])) {
        $id_anggota_keluarga_pindah = $_GET['id_anggota_keluarga_pindah'];
        $no_kk = $_GET['no_kk'];
        $sql_hapus = "DELETE FROM anggota_keluarga_pindah WHERE id_anggota_keluarga_pindah='" . $_GET['id_anggota_keluarga_pindah'] . "'";
        $query_hapus = mysqli_query($koneksi, $sql_hapus);
        $kode = $_GET['id_anggota_keluarga_pindah'];
        if ($query_hapus) {
            echo "<script>
                    Swal.fire({title: 'Hapus Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.value) {
                            window.location = 'index.php?page=lapor_pindah&no_kk=" . $no_kk . "';
                        }
                    })</script>";
        } else {
            echo "<script>
                    Swal.fire({title: 'Hapus Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.value) {
                            window.location = 'index.php?page=lapor_pindah';
                        }
                    })</script>";
    }
    }
}

