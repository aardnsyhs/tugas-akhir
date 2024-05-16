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

$id = $_GET['id'];

$query = "SELECT * FROM penduduk JOIN surat_pindah ON penduduk.id_penduduk=surat_pindah.id_penduduk JOIN kk ON kk.id_penduduk=penduduk.id_penduduk WHERE surat_pindah.id_penduduk = '$id'";
$hasil = mysqli_query($koneksi, $query);
$cek_data = mysqli_fetch_assoc($hasil);
$alamat_asal = $cek_data['alamat_penduduk'] . ", RT. " . $cek_data['rt_penduduk'] . " RW. " .
               $cek_data['rw_penduduk'] . "\n" .
               $cek_data['desa_kelurahan_penduduk'] . ", " .
               $cek_data['kecamatan_penduduk'] . ", " .
               $cek_data['kabupaten_kota_penduduk'] . "\n" .
               $cek_data['provinsi_penduduk'];

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
    $pdf->cell(80, 7, substr(strtoupper($cek_data['nama_penduduk']), 0, 17), 0, 1, 'L');
    
    $pdf->SetX(15);
    $pdf->cell(45, 7, 'NIK', 0, 0, 'L');
    $pdf->cell(2, 7, ':', 0, 0, 'L');
    $pdf->cell(80, 7, strtoupper($cek_data['nik_penduduk']), 0, 1, 'L');

    $pdf->SetX(15);
    $pdf->cell(45, 7, 'Jenis Kelamin', 0, 0, 'L');
    $pdf->cell(2, 7, ':', 0, 0, 'L');
    $pdf->cell(80, 7, strtoupper($cek_data['jenis_kelamin_penduduk']), 0, 1, 'L');

    $pdf->SetX(15);
    $pdf->cell(45, 7, 'Tempat, Tanggal Lahir', 0, 0, 'L');
    $pdf->cell(2, 7, ':', 0, 0, 'L');
    $pdf->cell(80, 7, $cek_data['tempat_lahir_penduduk'] . ", " . $cek_data['tanggal_lahir_penduduk'], 0, 1, 'L');

    $pdf->SetX(15);
    $pdf->cell(45, 7, 'Warganegara / Agama', 0, 0, 'L');
    $pdf->cell(2, 7, ':', 0, 0, 'L');
    $pdf->cell(80, 7, substr(strtoupper($cek_data['negara_penduduk'] . " / " . $cek_data['agama_penduduk']), 0, 20), 0, 1, 'L');
    
    $pdf->SetX(15);
    $pdf->cell(45, 7, 'Pekerjaan', 0, 0, 'L');
    $pdf->cell(2, 7, ':', 0, 0, 'L');
    $pdf->cell(80, 7, substr(strtoupper($cek_data['pekerjaan_penduduk']), 0, 20), 0, 1, 'L');

    $pdf->SetX(15);
    $pdf->cell(45, 7, 'Status Pernikahan', 0, 0, 'L');
    $pdf->cell(2, 7, ':', 0, 0, 'L');
    $pdf->cell(80, 7, substr(strtoupper($cek_data['status_perkawinan_penduduk']), 0, 20), 0, 1, 'L');

    $pdf->SetX(15);
    $pdf->cell(45, 7, 'Pendidikan', 0, 0, 'L');
    $pdf->cell(2, 7, ':', 0, 0, 'L');
    $pdf->cell(80, 7, substr(strtoupper($cek_data['pendidikan_terakhir_penduduk']), 0, 20), 0, 1, 'L');
    
    $pdf->SetX(15);
    $pdf->Cell(45, 7, 'Alamat Asal', 0, 0, 'L');
    $pdf->Cell(2, 7, ':', 0, 0, 'L');

    $pdf->SetX(62);
    $pdf->MultiCell(0, 7, strtoupper($alamat_asal), 0, 'L');
    
    $pdf->SetX(15);
    $pdf->cell(45, 7, 'No.Kartu Keluarga', 0, 0, 'L');
    $pdf->cell(2, 7, ':', 0, 0, 'L');
    $pdf->cell(80, 7, substr(strtoupper($cek_data['no_kk']), 0, 20), 0, 1, 'L');
    
    $pdf->SetX(15);
    $pdf->Cell(45, 7, 'Alamat Tujuan Pindah', 0, 0, 'L');
    $pdf->Cell(2, 7, ':', 0, 0, 'L');
    
    $pdf->SetX(62);
    $pdf->MultiCell(0, 7, strtoupper($alamat_asal), 0, 'L');

    $pdf->SetX(15);
    $pdf->cell(45, 7, 'Alasan Pindah', 0, 0, 'L');
    $pdf->cell(2, 7, ':', 0, 0, 'L');
    $pdf->cell(80, 7, substr(strtoupper($cek_data['alasan_pindah']), 0, 20), 0, 1, 'L');

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
