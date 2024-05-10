<?php
require_once("../assets/lib/fpdf/fpdf.php");
require_once("../config/connection.php");

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

    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
}

if (isset($_POST['Cetak'])) {
    $id = $_POST['id_surat_kematian'];
}

$query = "SELECT * FROM penduduk JOIN surat_kematian ON penduduk.id_penduduk=surat_kematian.id_penduduk WHERE surat_kematian.id_surat_kematian = '$id'";
$hasil = mysqli_query($koneksi, $query);

foreach ($hasil as $data_penduduk) :
    $pdf = new PDF('P', 'mm', [210, 330]);
    $pdf->AliasNbPages();
    $pdf->AddPage();

    $pdf->SetFont('Times', '', 12);

    $nomor = 1;

    $pdf->Ln();
    $pdf->MultiCell(0, 7, 'Yang bertanda tangan di bawah ini Kepala Dukcapil Cimahi, Kecamatan Cimahi Utara, Kota Cimahi menerangkan dengan sebenarnya bahwa : ', 0, 'L');

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

    $pdf->MultiCell(0, 7, 'Surat Keterangan ini dibuat untuk Keamanan', 0, 'L');
    $pdf->MultiCell(0, 7, 'Demikian surat keterangan ini dibuat, atas perhatian dan kerjasamanya kami ucapkan terima kasih.', 0, 'L');

endforeach;
// $pdf->Cell(45, 7, 'Berdasarkan Surat Pernyataan Dari');
// $pdf->SetX(70);
// $pdf->Cell(5, 7, ':');
// $pdf->Cell(80, 7, '', 0, 1, 'L');

// $pdf->SetX(15);
// $pdf->cell(45, 7, 'Agama', 0, 0, 'L');
// $pdf->cell(2, 7, ':', 0, 0, 'L');
// $pdf->cell(20, 7, strtoupper($data_penduduk['agama_penduduk']), 0, 1, 'L');

// $pdf->SetX(15);
// $pdf->cell(45, 7, 'Pendidikan', 0, 0, 'L');
// $pdf->cell(2, 7, ':', 0, 0, 'L');
// $pdf->cell(16, 7, strtoupper($data_penduduk['pendidikan_terakhir_penduduk']), 0, 1, 'L');

// $pdf->SetX(15);
// $pdf->cell(45, 7, 'Pekerjaan', 0, 0, 'L');
// $pdf->cell(2, 7, ':', 0, 0, 'L');
// $pdf->cell(20, 7, strtoupper($data_penduduk['pekerjaan_penduduk']), 0, 1, 'L');

// $pdf->SetX(15);
// $pdf->cell(45, 7, 'Kawin/Tidak Kawin', 0, 0, 'L');
// $pdf->cell(2, 7, ':', 0, 0, 'L');
// $pdf->cell(26, 7, strtoupper($data_penduduk['status_perkawinan_penduduk']), 0, 1, 'L');

$pdf->Ln(10);

$pdf->Output();
