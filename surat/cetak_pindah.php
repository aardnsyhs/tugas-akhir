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

// Query pertama untuk mendapatkan data penduduk berdasarkan ID
$query_penduduk = "SELECT * FROM penduduk JOIN riwayat_tinggal ON penduduk.id_penduduk=riwayat_tinggal.id_penduduk WHERE riwayat_tinggal.id_penduduk = '$id'";
$hasil_penduduk = mysqli_query($koneksi, $query_penduduk);
$cek_data_penduduk = mysqli_fetch_assoc($hasil_penduduk);

// Query kedua untuk mendapatkan data surat pindah berdasarkan ID penduduk
$query_surat_pindah = "SELECT * FROM surat_pindah JOIN penduduk ON surat_pindah.id_penduduk WHERE surat_pindah.id_penduduk = '$id'";
$hasil_surat_pindah = mysqli_query($koneksi, $query_surat_pindah);
$cek_data_surat_pindah = mysqli_fetch_assoc($hasil_surat_pindah);

// Query ketiga untuk mendapatkan data kartu keluarga berdasarkan ID penduduk
$query_kk = "SELECT * FROM penduduk JOIN anggota_keluarga ON penduduk.id_penduduk=anggota_keluarga.id_penduduk WHERE anggota_keluarga.id_kk = '$id_kk'";
$hasil_kk = mysqli_query($koneksi, $query_kk);

$query_no_kk = "SELECT no_kk FROM penduduk JOIN anggota_keluarga ON penduduk.id_penduduk=anggota_keluarga.id_anggota JOIN kk ON penduduk.id_penduduk=kk.id_penduduk WHERE anggota_keluarga.id_kk='$id_kk'";
$hasil_no_kk = mysqli_query($koneksi, $query_no_kk);
$no_kk = mysqli_fetch_assoc($hasil_no_kk);

if (!$hasil_kk) {
    die('Query Error: ' . mysqli_error($koneksi));
}

$cek_id_kk = mysqli_fetch_assoc($hasil_kk);
if (!$cek_id_kk) {
    die('Data not found for id_penduduk: ' . $id);
}

// Menggabungkan alamat asal dari data penduduk
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

$nomor = 1;

$pdf->Ln();
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

$pdf->MultiCell(0, 7, 'Demikian Surat Pengantar Pindah ini dibuat dan diberikan kepada yang bersangkutan untuk', 0, 'L');
$pdf->MultiCell(0, 7, 'dipergunakan sebagaimana mestinya.', 0, 'L');

$pdf->SetY($pdf->GetY() + 20);

// Atur Tanggal Hari ini
$bulan = [
    1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April', 5 => 'Mei',
    6 => 'Juni', 7 => 'Juli', 8 => 'Agustus', 9 => 'September',
    10 => 'Oktober', 11 => 'November', 12 => 'Desember'
];

$hari = date('d');
$month = $bulan[(int)date('m')];
$tahun = date('Y');

$tanggal_sekarang = $hari . ' ' . $month . ' ' . $tahun;

$pdf->SetX(15);
$pdf->cell(160, 7, 'Cibabat, ' . $tanggal_sekarang, 0, 0, 'R');

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
