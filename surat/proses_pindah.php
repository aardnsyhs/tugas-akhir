<?php
$get_id_penduduk = $_GET['id_penduduk'];
$sql = "SELECT * FROM `penduduk` JOIN `surat_pindah_temp` 
ON `penduduk`.id_penduduk = `surat_pindah_temp`.id_penduduk
JOIN kk ON `penduduk`.id_penduduk = `kk`.id_penduduk 
WHERE `surat_pindah_temp`.id_penduduk = '$get_id_penduduk'";
$cek = mysqli_query($koneksi, $sql);
$hasil = mysqli_fetch_assoc($cek);

$id_surat_pindah_temp = $hasil['id_surat_pindah_temp'];
$id_kk = $hasil['id_kk'];
$id_penduduk = $hasil['id_penduduk'];
$alamat_baru = $hasil['alamat_baru'];
$rt_baru = $hasil['rt_baru'];
$rw_baru = $hasil['rw_baru'];
$desa_kelurahan_baru = $hasil['desa_kelurahan_baru'];
$kecamatan_baru = $hasil['kecamatan_baru'];
$kabupaten_kota_baru = $hasil['kabupaten_kota_baru'];
$provinsi_baru = $hasil['provinsi_baru'];
$alasan_pindah = $hasil['alasan_pindah'];

$sql = "INSERT INTO surat_pindah VALUES (NULL, '$id_penduduk', '$alamat_baru', '$rt_baru', '$rw_baru', '$desa_kelurahan_baru', '$kecamatan_baru', '$kabupaten_kota_baru', '$provinsi_baru', '$alasan_pindah')";
$tambah_pindah = mysqli_query($koneksi, $sql);

$sql = "UPDATE `penduduk` SET `alamat_penduduk` = '$alamat_baru', `rt_penduduk` = '$rt_baru', `rw_penduduk` = '$rw_baru', `desa_kelurahan_penduduk` = '$desa_kelurahan_baru', `kecamatan_penduduk` = '$kecamatan_baru', `kabupaten_kota_penduduk` = '$kabupaten_kota_baru', `provinsi_penduduk` = '$provinsi_baru', `status` = 'Pindah' WHERE `id_penduduk` = '$id_penduduk'";
$ubah_status = mysqli_query($koneksi, $sql);

$sql = "SELECT * FROM anggota_keluarga_pindah WHERE id_kk=$id_kk";
$hasil_anggota_pindah = mysqli_query($koneksi, $sql);

foreach ($hasil_anggota_pindah as $anggota_pindah) {
    $id_penduduk_pindah = $anggota_pindah['id_penduduk'];
    $sql = "UPDATE `penduduk` SET `alamat_penduduk` = '$alamat_baru', `desa_kelurahan_penduduk` = '$desa_kelurahan_baru', 
    `kecamatan_penduduk` = '$kecamatan_baru', `kabupaten_kota_penduduk` = '$kabupaten_kota_baru', `provinsi_penduduk` = '$provinsi_baru', 
    `rt_penduduk` = '$rt_baru', `rw_penduduk` = '$rw_baru' WHERE `penduduk`.`id_penduduk` = $id_penduduk_pindah";
    $query_update_anggota = mysqli_query($koneksi, $sql);
}

$sql = "DELETE FROM `surat_pindah_temp` WHERE `surat_pindah_temp`.id_penduduk = '$id_penduduk'";
$hapus_temp = mysqli_query($koneksi, $sql);


if ($tambah_pindah && $ubah_status && $hapus_temp) {
    echo "<script>
                Swal.fire({title: 'Tambah Data Pindah Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
                }).then((result) => {if (result.value){
                    window.location = 'index.php?page=pindah';
                    }
                })
              </script>";
} else {
    echo "<script>
                Swal.fire({title: 'Tambah Data Pindah Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
                }).then((result) => {if (result.value){
                    window.location = 'index.php?page=pindah';
                    }
                })
          </script>";
}
