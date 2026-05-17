<?php
include './admin/koneksi.php';
require_once './vendor/fpdf/fpdf.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id <= 0) {
    die('ID tidak valid.');
}

$q = mysqli_query($koneksi, "SELECT * FROM tb_diagnosis WHERE id=$id");
if (!$q || mysqli_num_rows($q) == 0) {
    die('Data tidak ditemukan.');
}
$data = mysqli_fetch_assoc($q);

class PDF extends FPDF {
    function Header() {
        $this->SetFont('Helvetica', 'B', 16);
        $this->SetTextColor(45, 106, 79);
        $this->Cell(0, 10, 'SISTEM PAKAR STUNTING SMART', 0, 1, 'C');
        $this->SetFont('Helvetica', '', 11);
        $this->SetTextColor(60, 60, 60);
        $this->Cell(0, 7, 'Hasil Diagnosa Stunting', 0, 1, 'C');
        $this->SetDrawColor(45, 106, 79);
        $this->SetLineWidth(0.8);
        $this->Line(10, $this->GetY(), 200, $this->GetY());
        $this->Ln(4);
    }
    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Helvetica', 'I', 8);
        $this->SetTextColor(150, 150, 150);
        $this->Cell(0, 10, 'Dicetak: ' . date('d/m/Y H:i') . '  |  Stunting Smart', 0, 0, 'C');
    }
    function SectionTitle($title) {
        $this->SetFont('Helvetica', 'B', 11);
        $this->SetFillColor(45, 106, 79);
        $this->SetTextColor(255, 255, 255);
        $this->Cell(0, 8, '  ' . $title, 0, 1, 'L', true);
        $this->SetTextColor(30, 30, 30);
        $this->Ln(2);
    }
    function RowData($label, $value, $fill = false) {
        $this->SetFont('Helvetica', 'B', 10);
        $this->SetFillColor(240, 248, 244);
        $this->Cell(55, 7, $label, 0, 0, 'L', $fill);
        $this->SetFont('Helvetica', '', 10);
        $this->Cell(0, 7, ': ' . $value, 0, 1, 'L', $fill);
    }
}

$pdf = new PDF();
$pdf->AddPage();
$pdf->SetAutoPageBreak(true, 20);

// ── Data Balita
$pdf->SectionTitle('DATA BALITA');
$pdf->Ln(2);
$pdf->RowData('Nama Balita',     $data['nama_balita'], true);
$pdf->RowData('Jenis Kelamin',   $data['jenis_kelamin']);
$pdf->RowData('Umur',            $data['umur_bulan'] . ' bulan', true);
$pdf->RowData('Tinggi Badan',    $data['tinggi_cm'] . ' cm');
$pdf->RowData('Tanggal Periksa', date('d/m/Y H:i', strtotime($data['tanggal'])), true);
$pdf->Ln(4);

// ── Hasil Z-Score
$pdf->SectionTitle('HASIL Z-SCORE (STANDAR WHO)');
$pdf->Ln(2);
$pdf->RowData('Z-Score (TB/U)',     number_format($data['zscore'], 2), true);
$pdf->RowData('Status Pertumbuhan', $data['status_zscore']);

// Status description
$pdf->Ln(2);
$pdf->SetFont('Helvetica', 'I', 9);
$pdf->SetFillColor(232, 245, 236);
$pdf->SetTextColor(30, 80, 50);
$interp = '';
switch ($data['status_zscore']) {
    case 'SANGAT PENDEK': $interp = 'Kondisi ini memerlukan perhatian segera. Segera konsultasikan dengan dokter anak atau tenaga kesehatan untuk evaluasi lebih lanjut dan intervensi gizi.'; break;
    case 'PENDEK':        $interp = 'Perlu peningkatan asupan gizi dan pemantauan rutin. Konsultasikan dengan tenaga kesehatan untuk program intervensi yang tepat.'; break;
    case 'NORMAL':        $interp = 'Pertumbuhan berlangsung baik sesuai standar WHO. Pertahankan pola makan bergizi seimbang dan pemantauan rutin.'; break;
    case 'TINGGI':        $interp = 'Pertumbuhan sangat baik, tinggi badan di atas rata-rata. Tetap pantau perkembangan secara rutin.'; break;
    default:              $interp = '-'; break;
}
$pdf->MultiCell(0, 6, $interp, 0, 'L', true);
$pdf->SetTextColor(30, 30, 30);
$pdf->Ln(4);

// ── Gejala
$pdf->SectionTitle('GEJALA YANG DIPILIH');
$pdf->Ln(2);
$pdf->SetFont('Helvetica', '', 9);
$gejala_arr = explode('; ', $data['gejala_dipilih']);
foreach ($gejala_arr as $g) {
    $g = trim($g);
    if ($g !== '') {
        $pdf->Cell(5, 6, '', 0, 0);
        $pdf->SetFont('Helvetica', '', 7);
        $pdf->Cell(5, 6, chr(108), 0, 0, 'C'); // bullet (Zapf Dingbats not available, use dash)
        $pdf->SetFont('Helvetica', '', 9);
        $pdf->MultiCell(0, 6, '- ' . $g, 0, 'L');
    }
}
$pdf->Ln(4);

// ── Hasil Diagnosa DS
$pdf->SectionTitle('HASIL DIAGNOSA (DEMPSTER-SHAFER)');
$pdf->Ln(2);
$pdf->RowData('Hasil Diagnosa',       $data['hasil_penyakit'], true);
$pdf->RowData('Derajat Kepercayaan',  number_format($data['derajat_kepercayaan'], 2) . '%');
$pdf->Ln(4);

// ── Saran
if (!empty($data['solusi'])) {
    $pdf->SectionTitle('SARAN & SOLUSI');
    $pdf->Ln(2);
    $pdf->SetFont('Helvetica', '', 9);
    $pdf->SetFillColor(216, 243, 220);
    $pdf->SetTextColor(26, 58, 42);
    $pdf->MultiCell(0, 6, strip_tags(str_replace(['<br>', '<br/>', '<br />'], "\n", $data['solusi'])), 0, 'L', true);
    $pdf->SetTextColor(30, 30, 30);
}

$pdf->Ln(4);
$pdf->SetFont('Helvetica', 'I', 8);
$pdf->SetTextColor(120, 120, 120);
$pdf->Cell(0, 6, 'Dokumen ini dihasilkan secara otomatis oleh Sistem Pakar Stunting Smart.', 0, 1, 'C');
$pdf->Cell(0, 6, 'Konsultasikan hasil ini dengan tenaga medis profesional untuk penanganan lebih lanjut.', 0, 1, 'C');

$filename = 'Hasil_Diagnosa_' . preg_replace('/[^a-zA-Z0-9_]/', '_', $data['nama_balita']) . '_' . date('Ymd') . '.pdf';
$pdf->Output('D', $filename);
