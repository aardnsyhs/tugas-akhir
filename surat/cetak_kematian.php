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

        $this->Cell(200, 8, 'SURAT KETERANGAN KEMATIAN', 0, 1, 'C');
        $this->Cell(200, 2, 'Nomor:001/001/2024', 0, 1, 'C');
        $this->Ln(10);

        $this->SetFont('Times', 'B', 9.5);
    }
}

$id = $_GET['id'];

$query = "SELECT * FROM penduduk JOIN surat_kematian ON penduduk.id_penduduk=surat_kematian.id_penduduk WHERE surat_kematian.id_penduduk = '$id'";
$hasil = mysqli_query($koneksi, $query);

$cek = mysqli_fetch_assoc($hasil);
$pelapor = $cek['pelapor'];

$query = "SELECT * FROM penduduk WHERE id_penduduk = '$pelapor'";
$cek_hasil = mysqli_query($koneksi, $query);
$hasil_pelapor = mysqli_fetch_assoc($cek_hasil);

$pdf = new PDF('P', 'mm', [210, 330]);
$pdf->AliasNbPages();

foreach ($hasil as $data_penduduk) :
    $pdf->AddPage();

    $pdf->SetFont('Times', '', 12);

    $nomor = 1;

    $pdf->Ln();
    $pdf->MultiCell(0, 7, 'Yang bertanda tangan di bawah ini Lurah Cibabat, Kecamatan Cimahi Utara, Kota Cimahi menerangkan dengan sebenarnya bahwa : ', 0, 'L');

    $pdf->SetX(15);
    $pdf->cell(45, 7, 'Nama', 0, 0, 'L');
    $pdf->cell(2, 7, ':', 0, 0, 'L');
    $pdf->cell(80, 7, substr(strtoupper($data_penduduk['nama_penduduk']), 0, 17), 0, 1, 'L');

    $pdf->SetX(15);
    $pdf->cell(45, 7, 'Bin / Binti', 0, 0, 'L');
    $pdf->cell(2, 7, ':', 0, 0, 'L');
    $pdf->cell(80, 7, strtoupper($data_penduduk['bin_binti']), 0, 1, 'L');

    $pdf->SetX(15);
    $pdf->cell(45, 7, 'NIK', 0, 0, 'L');
    $pdf->cell(2, 7, ':', 0, 0, 'L');
    $pdf->cell(80, 7, strtoupper($data_penduduk['nik_penduduk']), 0, 1, 'L');

    $pdf->SetX(15);
    $pdf->cell(45, 7, 'Tanggal Lahir', 0, 0, 'L');
    $pdf->cell(2, 7, ':', 0, 0, 'L');
    $pdf->cell(80, 7, ($data_penduduk['tanggal_lahir_penduduk'] != '0000-00-00') ? date('d-m-Y', strtotime($data_penduduk['tanggal_lahir_penduduk'])) : '', 0, 1, 'L');

    $pdf->SetX(15);
    $pdf->cell(45, 7, 'Jenis Kelamin', 0, 0, 'L');
    $pdf->cell(2, 7, ':', 0, 0, 'L');
    $pdf->cell(80, 7, substr(strtoupper($data_penduduk['jenis_kelamin_penduduk']), 0, 1), 0, 1, 'L');

    $pdf->SetX(15);
    $pdf->cell(45, 7, 'Tempat, Tanggal Lahir', 0, 0, 'L');
    $pdf->cell(2, 7, ':', 0, 0, 'L');
    $pdf->cell(80, 7, $data_penduduk['tempat_lahir_penduduk'] . ", " . $data_penduduk['tanggal_lahir_penduduk'], 0, 1, 'L');

    $pdf->SetX(15);
    $pdf->cell(45, 7, 'Warganegara / Agama', 0, 0, 'L');
    $pdf->cell(2, 7, ':', 0, 0, 'L');
    $pdf->cell(80, 7, substr(strtoupper($data_penduduk['negara_penduduk'] . " / " . $data_penduduk['agama_penduduk']), 0, 20), 0, 1, 'L');

    $pdf->SetX(15);
    $pdf->cell(45, 7, 'Status Pernikahan', 0, 0, 'L');
    $pdf->cell(2, 7, ':', 0, 0, 'L');
    $pdf->cell(80, 7, substr(strtoupper($data_penduduk['status_perkawinan_penduduk']), 0, 20), 0, 1, 'L');

    $pdf->SetX(15);
    $pdf->cell(45, 7, 'Pekerjaan', 0, 0, 'L');
    $pdf->cell(2, 7, ':', 0, 0, 'L');
    $pdf->cell(80, 7, substr(strtoupper($data_penduduk['pekerjaan_penduduk']), 0, 20), 0, 1, 'L');

    $pdf->SetX(15);
    $pdf->cell(45, 7, 'Alamat', 0, 0, 'L');
    $pdf->cell(2, 7, ':', 0, 0, 'L');
    $pdf->cell(80, 7, substr(strtoupper($data_penduduk['alamat_penduduk']), 0, 20), 0, 1, 'L');

    $pdf->Cell(45, 7, 'Telah Meninggal Dunia Pada');
    $pdf->SetX(61);
    $pdf->Cell(5, 7, ':');
    $pdf->Cell(80, 7, '', 0, 1, 'L');

    $pdf->SetX(15);
    $pdf->cell(45, 7, 'Tanggal', 0, 0, 'L');
    $pdf->cell(2, 7, ':', 0, 0, 'L');
    $pdf->cell(80, 7, ($data_penduduk['tanggal_kematian'] != '0000-00-00') ? date('d-m-Y', strtotime($data_penduduk['tanggal_kematian'])) : '', 0, 1, 'L');

    $pdf->SetX(15);
    $pdf->cell(45, 7, 'Jam', 0, 0, 'L');
    $pdf->cell(2, 7, ':', 0, 0, 'L');
    $pdf->cell(80, 7, $data_penduduk['jam_kematian'], 0, 1, 'L');

    $pdf->SetX(15);
    $pdf->cell(45, 7, 'Tempat Meninggal', 0, 0, 'L');
    $pdf->cell(2, 7, ':', 0, 0, 'L');
    $pdf->cell(7, 7, strtoupper($data_penduduk['tempat_kematian']), 0, 1, 'L');

    $pdf->SetX(15);
    $pdf->cell(45, 7, 'Sebab Kematian', 0, 0, 'L');
    $pdf->cell(2, 7, ':', 0, 0, 'L');
    $pdf->cell(7, 7, strtoupper($data_penduduk['penyebab_kematian']), 0, 1, 'L');

endforeach;

$pdf->Cell(45, 7, 'Berdasarkan surat pernyataan dari');
$pdf->SetX(68);
$pdf->Cell(5, 7, ':');
$pdf->Cell(80, 7, '', 0, 1, 'L');

$pdf->SetX(15);
$pdf->cell(45, 7, 'Nama', 0, 0, 'L');
$pdf->cell(2, 7, ':', 0, 0, 'L');
$pdf->cell(80, 7, substr(strtoupper($hasil_pelapor['nama_penduduk']), 0, 20), 0, 1, 'L');

$pdf->SetX(15);
$pdf->cell(45, 7, 'NIK', 0, 0, 'L');
$pdf->cell(2, 7, ':', 0, 0, 'L');
$pdf->cell(80, 7, substr(strtoupper($hasil_pelapor['nik_penduduk']), 0, 20), 0, 1, 'L');

$pdf->SetX(15);
$pdf->cell(45, 7, 'Tempat / Tanggal Lahir', 0, 0, 'L');
$pdf->cell(2, 7, ':', 0, 0, 'L');
$pdf->cell(80, 7, substr(strtoupper($hasil_pelapor['tempat_lahir_penduduk'] . " / " . $hasil_pelapor['tanggal_lahir_penduduk']), 0, 20), 0, 1, 'L');

$pdf->SetX(15);
$pdf->cell(45, 7, 'Pekerjaan', 0, 0, 'L');
$pdf->cell(2, 7, ':', 0, 0, 'L');
$pdf->cell(80, 7, substr(strtoupper($hasil_pelapor['pekerjaan_penduduk']), 0, 20), 0, 1, 'L');

$pdf->SetX(15);
$pdf->cell(45, 7, 'Alamat', 0, 0, 'L');
$pdf->cell(2, 7, ':', 0, 0, 'L');
$pdf->cell(80, 7, substr(strtoupper($hasil_pelapor['alamat_penduduk']), 0, 20), 0, 1, 'L');

$pdf->MultiCell(0, 7, 'Surat Keterangan ini dibuat untuk Keamanan', 0, 'L');
$pdf->MultiCell(0, 7, 'Demikian surat keterangan ini dibuat, atas perhatian dan kerjasamanya kami ucapkan terima kasih.', 0, 'L');

$pdf->SetY($pdf->GetY() + 20);

$tanggal = $cek['tanggal'];
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
$tanggal_format = date("d F Y", strtotime($tanggal));
foreach ($bulan_indonesia as $bulan_inggris => $bulan_indonesia) {
    $tanggal_format = str_replace($bulan_inggris, $bulan_indonesia, $tanggal_format);
}

$pdf->SetX(15);
$pdf->cell(160, 7, 'Cibabat, ' . $tanggal_format, 0, 0, 'R');

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
