<?php
require_once("../assets/lib/fpdf/fpdf.php");
require_once("../config/connection.php");

$pdf = new FPDF();
class PDF extends FPDF
{
    function Header()
    {
        $this->Image('../assets/dist/img/logokotacimahi.png', 20, 10, 24, 24);
        $this->SetFont('Times', 'B', 15);
        $this->Cell(200, 8, 'PEMERINTAH KOTA CIMAHI', 0, 1, 'C');
        $this->Cell(200, 8, 'KECAMATAN CIMAHI UTARA', 0, 1, 'C');
        $this->Cell(200, 8, 'KELURAHAN CIBABAT', 0, 1, 'C');
        $this->Ln(5);

        $this->SetFont('Times', 'BU', 12);
        for ($i = 0; $i < 10; $i++) {
            $this->Cell(308, 0, '', 1, 1, 'C');
        }

        $this->Ln(1);

        $this->Cell(200, 8, 'SURAT KETERANGAN PINDAH', 0, 1, 'C');
        $this->Cell(200, 2, 'Nomor:001/001/2024', 0, 1, 'C');
        $this->Ln(10);

        $this->SetFont('Times', 'B', 9.5);
    }
}

$id = $_GET['id_penduduk'];
$id_kk = $_GET['id_kk'];

// Query untuk mendapatkan data penduduk berdasarkan ID penduduk
$query_penduduk = "SELECT * FROM penduduk JOIN riwayat_tinggal ON penduduk.id_penduduk=riwayat_tinggal.id_penduduk WHERE riwayat_tinggal.id_penduduk = '$id'";
$hasil_penduduk = mysqli_query($koneksi, $query_penduduk);
if (!$hasil_penduduk) {
    die('Query Error: ' . mysqli_error($koneksi));
}
$cek_data_penduduk = mysqli_fetch_assoc($hasil_penduduk);

// Query untuk mendapatkan data surat pindah berdasarkan ID penduduk
$query_surat_pindah = "SELECT * FROM surat_pindah JOIN penduduk ON surat_pindah.id_penduduk = penduduk.id_penduduk WHERE surat_pindah.id_penduduk = '$id'";
$hasil_surat_pindah = mysqli_query($koneksi, $query_surat_pindah);
if (!$hasil_surat_pindah) {
    die('Query Error: ' . mysqli_error($koneksi));
}
$cek_data_surat_pindah = mysqli_fetch_assoc($hasil_surat_pindah);

// Query untuk mendapatkan jumlah anggota keluarga yang pindah berdasarkan ID KK
$query_jumlah_anggota_pindah = "SELECT COUNT(*) AS jumlah_anggota_pindah FROM anggota_keluarga_pindah WHERE id_kk = '$id_kk'";
$hasil_jumlah_anggota_pindah = mysqli_query($koneksi, $query_jumlah_anggota_pindah);
if (!$hasil_jumlah_anggota_pindah) {
    die('Query Error: ' . mysqli_error($koneksi));
}
$data_jumlah_anggota_pindah = mysqli_fetch_assoc($hasil_jumlah_anggota_pindah);
$jumlah_anggota_pindah = $data_jumlah_anggota_pindah['jumlah_anggota_pindah'];

$hasil_kk_pindah = null;
$jumlah_anggota = 0;

// Jika jumlah anggota pindah lebih dari 1, jalankan query untuk mendapatkan data anggota keluarga pindah
if ($jumlah_anggota_pindah > 1) {
    $query_kk = "SELECT * FROM penduduk JOIN anggota_keluarga_pindah ON penduduk.id_penduduk=anggota_keluarga_pindah.id_penduduk WHERE anggota_keluarga_pindah.id_kk = '$id_kk'";
    $hasil_kk_pindah = mysqli_query($koneksi, $query_kk);
    if (!$hasil_kk_pindah) {
        die('Query Error: ' . mysqli_error($koneksi));
    }

    $query_anggota_pindah = "SELECT (SELECT COUNT(*) FROM penduduk JOIN anggota_keluarga_pindah 
                             ON penduduk.id_penduduk = anggota_keluarga_pindah.id_penduduk 
                             WHERE anggota_keluarga_pindah.id_kk = '$id_kk') AS jumlah_anggota_pindah, penduduk.* FROM penduduk 
                             JOIN anggota_keluarga_pindah ON penduduk.id_penduduk = anggota_keluarga_pindah.id_penduduk 
                             WHERE anggota_keluarga_pindah.id_kk = '$id_kk'";
    $hasil_anggota_pindah = mysqli_query($koneksi, $query_anggota_pindah);
    if (!$hasil_anggota_pindah) {
        die('Query Error: ' . mysqli_error($koneksi));
    }
    $data_anggota_pindah = mysqli_fetch_assoc($hasil_anggota_pindah);
    $jumlah_anggota = $data_anggota_pindah['jumlah_anggota_pindah'];
}

// Query untuk mendapatkan nomor KK
$query_no_kk = "SELECT no_kk FROM penduduk JOIN anggota_keluarga ON penduduk.id_penduduk=anggota_keluarga.id_penduduk JOIN kk ON penduduk.id_penduduk=kk.id_penduduk WHERE anggota_keluarga.id_kk='$id_kk'";
$hasil_no_kk = mysqli_query($koneksi, $query_no_kk);
if (!$hasil_no_kk) {
    die('Query Error: ' . mysqli_error($koneksi));
}
$no_kk = mysqli_fetch_assoc($hasil_no_kk);
$alamat_asal = $cek_data_penduduk['alamat'] . ", RT. " . $cek_data_penduduk['rt'] . " RW. " .
    $cek_data_penduduk['rw'] . "\n" .
    $cek_data_penduduk['desa_kelurahan'] . ", " .
    $cek_data_penduduk['kecamatan'] . ", " .
    $cek_data_penduduk['kota'] . "\n" .
    $cek_data_penduduk['provinsi'];

$alamat_tujuan = $cek_data_surat_pindah['alamat_baru'] . ", RT. " . $cek_data_surat_pindah['rt_baru'] . " RW. " .
    $cek_data_surat_pindah['rw_baru'] . "\n" .
    $cek_data_surat_pindah['desa_kelurahan_baru'] . ", " .
    $cek_data_surat_pindah['kecamatan_baru'] . ", " .
    $cek_data_surat_pindah['kabupaten_kota_baru'] . "\n" .
    $cek_data_surat_pindah['provinsi_baru'];

$pdf = new PDF('P', 'mm', [210, 330]);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times', '', 12);

$pdf->MultiCell(0, 7, 'Yang bertanda tangan di bawah ini Lurah Cibabat, Kecamatan Cimahi Utara, Kota Cimahi menerangkan dengan sebenarnya bahwa : ', 0, 'L');

$pdf->SetX(15);
$pdf->cell(45, 7, 'Nama', 0, 0, 'L');
$pdf->cell(2, 7, ':', 0, 0, 'L');
$pdf->cell(80, 7, substr(strtoupper($cek_data_penduduk['nama_penduduk']), 0, 17), 0, 1, 'L');

$pdf->SetX(15);
$pdf->cell(45, 7, 'NIK', 0, 0, 'L');
$pdf->cell(2, 7, ':', 0, 0, 'L');
$pdf->cell(80, 7, strtoupper($cek_data_penduduk['nik_penduduk']), 0, 1, 'L');

$pdf->SetX(15);
$pdf->cell(45, 7, 'Jenis Kelamin', 0, 0, 'L');
$pdf->cell(2, 7, ':', 0, 0, 'L');
$pdf->cell(80, 7, strtoupper($cek_data_penduduk['jenis_kelamin_penduduk']), 0, 1, 'L');

$pdf->SetX(15);
$pdf->cell(45, 7, 'Tempat, Tanggal Lahir', 0, 0, 'L');
$pdf->cell(2, 7, ':', 0, 0, 'L');
$tanggal_lahir = date('d-m-Y', strtotime($cek_data_penduduk['tanggal_lahir_penduduk']));
$pdf->cell(80, 7, $cek_data_penduduk['tempat_lahir_penduduk'] . ", " . $tanggal_lahir, 0, 1, 'L');

$pdf->SetX(15);
$pdf->cell(45, 7, 'Warganegara / Agama', 0, 0, 'L');
$pdf->cell(2, 7, ':', 0, 0, 'L');
$pdf->cell(80, 7, substr(strtoupper($cek_data_penduduk['negara_penduduk'] . " / " . $cek_data_penduduk['agama_penduduk']), 0, 20), 0, 1, 'L');

$pdf->SetX(15);
$pdf->cell(45, 7, 'Pekerjaan', 0, 0, 'L');
$pdf->cell(2, 7, ':', 0, 0, 'L');
$pdf->cell(80, 7, substr(strtoupper($cek_data_penduduk['pekerjaan_penduduk']), 0, 20), 0, 1, 'L');

$pdf->SetX(15);
$pdf->cell(45, 7, 'Status Pernikahan', 0, 0, 'L');
$pdf->cell(2, 7, ':', 0, 0, 'L');
$pdf->cell(80, 7, substr(strtoupper($cek_data_penduduk['status_perkawinan_penduduk']), 0, 20), 0, 1, 'L');

$pdf->SetX(15);
$pdf->cell(45, 7, 'Pendidikan', 0, 0, 'L');
$pdf->cell(2, 7, ':', 0, 0, 'L');
$pdf->cell(80, 7, substr(strtoupper($cek_data_penduduk['pendidikan_terakhir_penduduk']), 0, 20), 0, 1, 'L');

$pdf->SetX(15);
$pdf->Cell(45, 7, 'Alamat Asal', 0, 0, 'L');
$pdf->Cell(2, 7, ':', 0, 0, 'L');
$pdf->SetX(62);
$pdf->MultiCell(0, 7, strtoupper($alamat_asal), 0, 'L');

$pdf->SetX(15);
$pdf->cell(45, 7, 'No.Kartu Keluarga', 0, 0, 'L');
$pdf->cell(2, 7, ':', 0, 0, 'L');
$pdf->cell(80, 7, substr(strtoupper($no_kk['no_kk']), 0, 20), 0, 1, 'L');

$pdf->SetX(15);
$pdf->Cell(45, 7, 'Alamat Tujuan Pindah', 0, 0, 'L');
$pdf->Cell(2, 7, ':', 0, 0, 'L');
$pdf->SetX(62);
$pdf->MultiCell(0, 7, strtoupper($alamat_tujuan), 0, 'L');

$pdf->SetX(15);
$pdf->cell(45, 7, 'Alasan Pindah', 0, 0, 'L');
$pdf->cell(2, 7, ':', 0, 0, 'L');
$pdf->cell(80, 7, substr(strtoupper($cek_data_surat_pindah['alasan_pindah']), 0, 20), 0, 1, 'L');

$pdf->SetX(15);
$pdf->cell(45, 7, 'Keluarga Pindah', 0, 0, 'L');
$pdf->cell(2, 7, ':', 0, 0, 'L');
$pdf->cell(80, 7, substr(strtoupper($jumlah_anggota . ' Orang'), 0, 20), 0, 1, 'L');

$pdf->SetFont('Times', 'B', 12);
$cellWidth = array(10, 60, 80);
$totalWidth = array_sum($cellWidth);

$pdf->Ln(5);

$startX = ($pdf->GetPageWidth() - $totalWidth) / 2;
$pdf->SetX($startX);

$pdf->Cell($cellWidth[0], 7, 'No', 1, 0, 'C');
$pdf->Cell($cellWidth[1], 7, 'NIK Penduduk', 1, 0, 'C');
$pdf->Cell($cellWidth[2], 7, 'Nama Penduduk', 1, 1, 'C');

$pdf->SetFont('Times', '', 12);
$no = 1;
if ($hasil_kk_pindah) {
    while ($row = mysqli_fetch_assoc($hasil_kk_pindah)) {
        $pdf->SetX($startX);
        $pdf->Cell($cellWidth[0], 7, $no, 1, 0, 'C');
        $pdf->Cell($cellWidth[1], 7, $row['nik_penduduk'], 1, 0, 'C');
        $pdf->Cell($cellWidth[2], 7, $row['nama_penduduk'], 1, 1, 'C');
        $no++;
    }
}

$pdf->Ln(5);

$pdf->MultiCell(0, 7, 'Demikian Surat Pengantar Pindah ini dibuat dan diberikan kepada yang bersangkutan untuk', 0, 'L');
$pdf->MultiCell(0, 7, 'dipergunakan sebagaimana mestinya.', 0, 'L');

$pdf->SetY($pdf->GetY() + 20);

$tanggal_pindah = $cek_data_surat_pindah['tanggal_pindah'];
$bulan_indonesia = array(
    'January' => 'Januari',
    'February' => 'Februari',
    'March' => 'Maret',
    'April' => 'April',
    'May' => 'Mei',
    'June' => 'Juni',
    'July' => 'Juli',
    'August' => 'Agustus',
    'September' => 'September',
    'October' => 'Oktober',
    'November' => 'November',
    'December' => 'Desember'
);
$tanggal_pindah_format = date("d F Y", strtotime($tanggal_pindah));
foreach ($bulan_indonesia as $bulan_inggris => $bulan_indonesia) {
    $tanggal_pindah_format = str_replace($bulan_inggris, $bulan_indonesia, $tanggal_pindah_format);
}

$pdf->SetX(15);
$pdf->cell(160, 7, 'Cibabat, ' . $tanggal_pindah_format, 0, 0, 'R');

$pdf->Ln(5);

$pdf->SetX(17);
$pdf->Cell(160, 7, 'An.LURAH CIBABAT', 0, 0, 'R');

$pdf->Ln(5);

$posX = 140;
$posY = $pdf->GetY();
$width = 40;
$height = 30;

$pdf->Image('../assets/dist/img/ttd.png', $posX, $posY, $width, $height);

$pdf->Ln(13);
$pdf->SetX(17);
$pdf->Cell(150, 7, 'Nama Lurah', 0, 0, 'R');

$pdf->SetX(17);
$pdf->Cell(166, 7, '_________________________', 0, 0, 'R');

$pdf->Output();
