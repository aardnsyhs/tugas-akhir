<?php
require_once("../../assets/lib/fpdf/fpdf.php");
require_once("config/connection.php");

class PDF extends FPDF
{
    function Header()
    {
        $this->Image('../../assets/dist/img/logokotacimahi.png', 20, 10, 24, 24);

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

    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
}

$get_id_penduduk = $_GET['id_penduduk'];

$query = "SELECT * FROM `penduduk` JOIN `surat_kematian` ON `penduduk`.id_penduduk = `surat_kematian`.id_penduduk WHERE `penduduk`.id_penduduk = $get_id_penduduk";
$hasil = mysqli_query($conn, $query);
$data_penduduk = [];
while ($row = mysqli_fetch_assoc($hasil)) {
    $data_penduduk[] = $row;
}


$pdf = new PDF('P', 'mm', [210, 330]);
$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->SetFont('Times', '', 12);

$nomor = 1;

$pdf->Ln();
$pdf->MultiCell(0, 7, 'Yang bertanda tangan di bawah ini Kepala Desa Terong Tawah, Kecamatan Labuapi, Kabupaten Lombok Barat menerangkan dengan sebenarnya bahwa : ', 0, 'L');

$pdf->SetX(15);
$pdf->cell(45, 7, 'Nama', 0, 0, 'L');
$pdf->cell(2, 7, ':', 0, 0, 'L');
$pdf->cell(80, 7, substr(strtoupper($data_penduduk[0]['nama_penduduk']), 0, 17), 0, 1, 'L');

$pdf->SetX(15);
$pdf->cell(45, 7, 'Bin / Binti', 0, 0, 'L');
$pdf->cell(2, 7, ':', 0, 0, 'L');
$pdf->cell(80, 7, strtoupper($data_penduduk[0]['bin_binti']), 0, 1, 'L');

$pdf->SetX(15);
$pdf->cell(45, 7, 'NIK', 0, 0, 'L');
$pdf->cell(2, 7, ':', 0, 0, 'L');
$pdf->cell(80, 7, strtoupper($data_penduduk[0]['nik_penduduk']), 0, 1, 'L');

$pdf->SetX(15);
$pdf->cell(45, 7, 'Tanggal Lahir', 0, 0, 'L');
$pdf->cell(2, 7, ':', 0, 0, 'L');
$pdf->cell(80, 7, ($data_penduduk[0]['tanggal_lahir_penduduk'] != '0000-00-00') ? date('d-m-Y', strtotime($data_penduduk[0]['tanggal_lahir_penduduk'])) : '', 0, 1, 'L');

$pdf->SetX(15);
$pdf->cell(45, 7, 'Jenis Kelamin', 0, 0, 'L');
$pdf->cell(2, 7, ':', 0, 0, 'L');
$pdf->cell(80, 7, substr(strtoupper($data_penduduk[0]['jenis_kelamin_penduduk']), 0, 1), 0, 1, 'L');

$pdf->SetX(15);
$pdf->cell(45, 7, 'Tempat, Tanggal Lahir', 0, 0, 'L');
$pdf->cell(2, 7, ':', 0, 0, 'L');
$pdf->cell(80, 7, $data_penduduk[0]['tempat_lahir_penduduk'] . ", " . $data_penduduk[0]['tanggal_lahir_penduduk'], 0, 1, 'L');

$pdf->SetX(15);
$pdf->cell(45, 7, 'Warganegara / Agama', 0, 0, 'L');
$pdf->cell(2, 7, ':', 0, 0, 'L');
$pdf->cell(80, 7, substr(strtoupper($data_penduduk[0]['negara_penduduk'] . " / " . $data_penduduk[0]['agama_penduduk']), 0, 20), 0, 1, 'L');

$pdf->SetX(15);
$pdf->cell(45, 7, 'Status Pernikahan', 0, 0, 'L');
$pdf->cell(2, 7, ':', 0, 0, 'L');
$pdf->cell(80, 7, substr(strtoupper($data_penduduk[0]['status_perkawinan_penduduk']), 0, 20), 0, 1, 'L');

$pdf->SetX(15);
$pdf->cell(45, 7, 'Pekerjaan', 0, 0, 'L');
$pdf->cell(2, 7, ':', 0, 0, 'L');
$pdf->cell(80, 7, substr(strtoupper($data_penduduk[0]['pekerjaan_penduduk']), 0, 20), 0, 1, 'L');

$pdf->SetX(15);
$pdf->cell(45, 7, 'Alamat', 0, 0, 'L');
$pdf->cell(2, 7, ':', 0, 0, 'L');
$pdf->cell(80, 7, substr(strtoupper($data_penduduk[0]['alamat_penduduk']), 0, 20), 0, 1, 'L');

$pdf->Cell(45, 7, 'Telah Meninggal Dunia Pada');
$pdf->SetX(61);
$pdf->Cell(5, 7, ':');
$pdf->Cell(80, 7, '', 0, 1, 'L');

$pdf->SetX(15);
$pdf->cell(45, 7, 'Tanggal', 0, 0, 'L');
$pdf->cell(2, 7, ':', 0, 0, 'L');
$pdf->cell(80, 7, ($data_penduduk[0]['tanggal_kematian'] != '0000-00-00') ? date('d-m-Y', strtotime($data_penduduk[0]['tanggal_kematian'])) : '', 0, 1, 'L');

$pdf->SetX(15);
$pdf->cell(45, 7, 'Jam', 0, 0, 'L');
$pdf->cell(2, 7, ':', 0, 0, 'L');
$pdf->cell(80, 7, $data_penduduk[0]['jam_kematian'], 0, 1, 'L');

$pdf->SetX(15);
$pdf->cell(45, 7, 'Tempat Meninggal', 0, 0, 'L');
$pdf->cell(2, 7, ':', 0, 0, 'L');
$pdf->cell(7, 7, strtoupper($data_penduduk[0]['tempat_kematian']), 0, 1, 'L');

$pdf->SetX(15);
$pdf->cell(45, 7, 'Sebab Kematian', 0, 0, 'L');
$pdf->cell(2, 7, ':', 0, 0, 'L');
$pdf->cell(7, 7, strtoupper($data_penduduk[0]['penyebab_kematian']), 0, 1, 'L');

$pdf->MultiCell(0, 7, 'Surat Keterangan ini dibuat untuk Keamanan', 0, 'L');
$pdf->MultiCell(0, 7, 'Demikian surat keterangan ini dibuat, atas perhatian dan kerjasamanya kami ucapkan terima kasih.', 0, 'L');

// $pdf->Cell(45, 7, 'Berdasarkan Surat Pernyataan Dari');
// $pdf->SetX(70);
// $pdf->Cell(5, 7, ':');
// $pdf->Cell(80, 7, '', 0, 1, 'L');

// $pdf->SetX(15);
// $pdf->cell(45, 7, 'Agama', 0, 0, 'L');
// $pdf->cell(2, 7, ':', 0, 0, 'L');
// $pdf->cell(20, 7, strtoupper($data_penduduk[0]['agama_penduduk']), 0, 1, 'L');

// $pdf->SetX(15);
// $pdf->cell(45, 7, 'Pendidikan', 0, 0, 'L');
// $pdf->cell(2, 7, ':', 0, 0, 'L');
// $pdf->cell(16, 7, strtoupper($data_penduduk[0]['pendidikan_terakhir_penduduk']), 0, 1, 'L');

// $pdf->SetX(15);
// $pdf->cell(45, 7, 'Pekerjaan', 0, 0, 'L');
// $pdf->cell(2, 7, ':', 0, 0, 'L');
// $pdf->cell(20, 7, strtoupper($data_penduduk[0]['pekerjaan_penduduk']), 0, 1, 'L');

// $pdf->SetX(15);
// $pdf->cell(45, 7, 'Kawin/Tidak Kawin', 0, 0, 'L');
// $pdf->cell(2, 7, ':', 0, 0, 'L');
// $pdf->cell(26, 7, strtoupper($data_penduduk[0]['status_perkawinan_penduduk']), 0, 1, 'L');

$pdf->Ln(10);

$pdf->Output();
