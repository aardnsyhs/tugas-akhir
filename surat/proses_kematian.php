<?php
$get_id_penduduk = $_GET['id_penduduk'];
$sql = "SELECT * FROM `penduduk` JOIN `surat_kematian_temp` ON `penduduk`.id_penduduk = `surat_kematian_temp`.id_penduduk WHERE `surat_kematian_temp`.id_penduduk = '$get_id_penduduk'";
$cek = mysqli_query($koneksi, $sql);
$hasil = mysqli_fetch_assoc($cek);

$id_surat_kematian_temp = $hasil['id_surat_kematian_temp'];
$id_penduduk = $hasil['id_penduduk'];
$tanggal_kematian = $hasil['tanggal_kematian'];
$jam_kematian = $hasil['jam_kematian'];
$penyebab_kematian = $hasil['penyebab_kematian'];
$tempat_kematian = $hasil['tempat_kematian'];
$bin_binti = $hasil['bin_binti'];
$pelapor = $hasil['pelapor'];
$tanggal = date('Y-m-d');

function hitungUsia($tanggal_lahir, $tanggal_kematian)
{
    $lahir = new DateTime($tanggal_lahir);
    $kematian = new DateTime($tanggal_kematian);
    $usia = $lahir->diff($kematian);
    return $usia->y;
}
$tanggal_lahir = $hasil['tanggal_lahir_penduduk'];
$tanggal_kematian = $hasil['tanggal_kematian'];

$hitung_usia = hitungUsia($tanggal_lahir, $tanggal_kematian);

$sql = "INSERT INTO surat_kematian VALUES (NULL, '$id_penduduk', '$tanggal_kematian', '$jam_kematian', '$penyebab_kematian', '$tempat_kematian', '$hitung_usia', '$bin_binti', '$pelapor', '$tanggal')";
$tambah_kematian = mysqli_query($koneksi, $sql);

$sql = "UPDATE penduduk SET status = 'Meninggal' WHERE id_penduduk = '$id_penduduk'";
$ubah_status = mysqli_query($koneksi, $sql);

$sql = "DELETE FROM `surat_kematian_temp` WHERE `surat_kematian_temp`.id_penduduk = '$id_penduduk'";
$hapus_temp = mysqli_query($koneksi, $sql);

if ($tambah_kematian && $ubah_status && $hapus_temp) {
    echo "<script>
                Swal.fire({title: 'Tambah Data Kematian Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
                }).then((result) => {if (result.value){
                    window.location = 'index.php?page=kematian';
                    }
                })
              </script>";
} else {
    echo "<script>
                Swal.fire({title: 'Tambah Data Kematian Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
                }).then((result) => {if (result.value){
                    window.location = 'index.php?page=surat_kematian';
                    }
                })
          </script>";
}
