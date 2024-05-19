<?php
$get_id_penduduk = $_GET['id_penduduk'];
$sql = "SELECT * FROM `penduduk` JOIN `surat_izin_tinggal_temp` 
ON `penduduk`.id_penduduk = `surat_izin_tinggal_temp`.id_penduduk 
WHERE `surat_izin_tinggal_temp`.id_penduduk = '$get_id_penduduk'";
$cek = mysqli_query($koneksi, $sql);
$hasil = mysqli_fetch_assoc($cek);

$id_surat_pindah_temp = $hasil['id_surat_izin_tinggal_temp'];
$id_penduduk = $hasil['id_penduduk'];
$alamat = $hasil['alamat'];
$rt = $hasil['rt'];
$rw = $hasil['rw'];
$kelurahan = $hasil['kelurahan'];
$kecamatan = $hasil['kecamatan'];
$kota = $hasil['kota'];
$provinsi = $hasil['provinsi'];
$tanggal = date('Y-m-d');

$sql = "INSERT INTO surat_izin_tinggal VALUES (NULL, '$id_penduduk', '$alamat', '$rt', '$rw', '$kelurahan', '$kecamatan', '$kota', '$provinsi', '$tanggal')";
$tambah_izin_tinggal = mysqli_query($koneksi, $sql);

$sql = "DELETE FROM `surat_izin_tinggal_temp` WHERE `surat_izin_tinggal_temp`.id_penduduk = '$id_penduduk'";
$hapus_temp = mysqli_query($koneksi, $sql);

if ($tambah_izin_tinggal && $hapus_temp) {
    echo "<script>
                Swal.fire({title: 'Tambah Data Izin Tinggal Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
                }).then((result) => {if (result.value){
                    window.location = 'index.php?page=izin_tinggal';
                    }
                })
              </script>";
} else {
    echo "<script>
                Swal.fire({title: 'Tambah Data Izin Tinggal Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
                }).then((result) => {if (result.value){
                    window.location = 'index.php?page=izin_tinggal';
                    }
                })
          </script>";
}
