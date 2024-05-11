<?php
if (isset($_POST['Laporkan'])) {
    $sql = $koneksi->query("SELECT * FROM `penduduk` JOIN `surat_kematian_temp` ON `penduduk`.id_penduduk = `surat_kematian`.id_penduduk");
    function hitungUsia($tanggal_lahir, $tanggal_kematian)
    {
        $lahir = new DateTime($tanggal_lahir);
        $kematian = new DateTime($tanggal_kematian);
        $usia = $lahir->diff($kematian);
        return $usia->y;
    }
    foreach ($sql as $data_kematian) :
        $tanggal_lahir = $data_kematian['tanggal_lahir_penduduk'];
    endforeach;
    $tanggal_kematian = $_POST['tanggal_kematian'];
    $sql_simpan = "INSERT INTO surat_kematian_temp (id_penduduk, tanggal_kematian, jam_kematian, penyebab_kematian, tempat_kematian, usia_kematian, bin_binti) VALUES (
            NULL,
			'" . $_POST['id_penduduk'] . "',
            '" . $_POST['tanggal_kematian'] . "',
            '" . $_POST['jam_kematian'] . "',
            '" . $_POST['penyebab_kematian'] . "',
            '" . $_POST['tempat_kematian'] . "',
            '" . hitungUsia($tanggal_lahir, $tanggal_kematian) . "',
            '" . $_POST['bin_binti'] . "')";
    $query_simpan = mysqli_query($koneksi, $sql_simpan);
    mysqli_close($koneksi);

    if ($query_simpan) {
        echo "<script>
      Swal.fire({title: 'Tambah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
          window.location = 'index.php?page=lapor_kematian';
          }
      })</script>";
    } else {
        echo "<script>
      Swal.fire({title: 'Tambah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
          window.location = 'index.php?page=lapor_kematian';
          }
      })</script>";
    }
}
