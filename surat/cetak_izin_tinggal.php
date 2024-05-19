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

        $this->Cell(200, 8, 'SURAT KETERANGAN IZIN TINGGAL SEMENTARA', 0, 1, 'C');
        $this->Cell(200, 2, 'Nomor:001/001/2024', 0, 1, 'C');
        $this->Ln(10);

        $this->SetFont('Times', 'B', 9.5);
    }
}

$id = $_GET['id_penduduk'];

$query = "SELECT * FROM penduduk JOIN surat_izin_tinggal ON penduduk.id_penduduk=surat_izin_tinggal.id_penduduk WHERE surat_izin_tinggal.id_penduduk='$id'";
$hasil = mysqli_query($koneksi, $query);
$cek_data = mysqli_fetch_assoc($hasil);

$alamat_asal = $cek_data['alamat_penduduk'] . ", RT. " . $cek_data['rt_penduduk'] . " RW. " .
    $cek_data['rw_penduduk'] . "\n" .
    $cek_data['desa_kelurahan_penduduk'] . ", " .
    $cek_data['kecamatan_penduduk'] . ", " .
    $cek_data['kabupaten_kota_penduduk'] . "\n" .
    $cek_data['provinsi_penduduk'];

$alamat_tujuan = $cek_data['alamat'] . ", RT. " . $cek_data['rt'] . " RW. " .
    $cek_data['rw'] . ", " .
    $cek_data['kelurahan'] . ", " .
    $cek_data['kecamatan'] . ", " .
    $cek_data['kota'] . ", " .
    $cek_data['provinsi'];

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
$pdf->cell(45, 7, 'Jenis Kelamin', 0, 0, 'L');
$pdf->cell(2, 7, ':', 0, 0, 'L');
$pdf->cell(80, 7, strtoupper($cek_data['jenis_kelamin_penduduk']), 0, 1, 'L');

$pdf->SetX(15);
$pdf->cell(45, 7, 'Tempat, Tanggal Lahir', 0, 0, 'L');
$pdf->cell(2, 7, ':', 0, 0, 'L');
$tanggal_lahir = date('d-m-Y', strtotime($cek_data['tanggal_lahir_penduduk']));
$pdf->cell(80, 7, $cek_data['tempat_lahir_penduduk'] . ", " . $tanggal_lahir, 0, 1, 'L');

$pdf->SetX(15);
$pdf->cell(45, 7, 'Kewarganegaraan', 0, 0, 'L');
$pdf->cell(2, 7, ':', 0, 0, 'L');
$pdf->cell(80, 7, substr(strtoupper($cek_data['negara_penduduk']), 0, 20), 0, 1, 'L');

$pdf->SetX(15);
$pdf->cell(45, 7, 'Agama', 0, 0, 'L');
$pdf->cell(2, 7, ':', 0, 0, 'L');
$pdf->cell(80, 7, substr(strtoupper($cek_data['agama_penduduk']), 0, 20), 0, 1, 'L');

$pdf->SetX(15);
$pdf->cell(45, 7, 'Pekerjaan', 0, 0, 'L');
$pdf->cell(2, 7, ':', 0, 0, 'L');
$pdf->cell(80, 7, substr(strtoupper($cek_data['pekerjaan_penduduk']), 0, 20), 0, 1, 'L');

$pdf->SetX(15);
$pdf->cell(45, 7, 'NIK', 0, 0, 'L');
$pdf->cell(2, 7, ':', 0, 0, 'L');
$pdf->cell(80, 7, strtoupper($cek_data['nik_penduduk']), 0, 1, 'L');

$pdf->SetX(15);
$pdf->Cell(45, 7, 'Alamat Asal', 0, 0, 'L');
$pdf->Cell(2, 7, ':', 0, 0, 'L');
$pdf->SetX(62);
$pdf->MultiCell(0, 7, strtoupper($alamat_asal), 0, 'L');

$pdf->MultiCell(0, 7, 'Adalah benar nama tersebut di atas bertempat tinggal sementara pada alamat', 0, 'L');
$pdf->MultiCell(0, 7, $alamat_tujuan, 0, 'L');

$pdf->Cell(0, 7, '', 0, 1);

$pdf->MultiCell(0, 7, 'Demikian Surat Keterangan Izin Tinggal Sementara ini dibuat dan diberikan kepada yang bersangkutan untuk', 0, 'L');
$pdf->MultiCell(0, 7, 'dipergunakan sebagaimana mestinya dan berlaku selama 3 (tiga) bulan sejak tanggal dikeluarkan', 0, 'L');


$pdf->SetY($pdf->GetY() + 20);

$tanggal_pindah = $cek_data['tanggal'];
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
$pdf->Cell(160, 7, 'An. LURAH CIBABAT', 0, 0, 'R');

$pdf->SetY($pdf->GetY() - 7);
$pdf->SetX(17);
$pdf->Cell(0, 7, 'Yang Bersangkutan', 0, 1, 'L');

$pdf->Ln(5);

$pdf->SetX(10);
$pdf->Cell(0, 32, '_________________________', 0, 0, 'L');

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
