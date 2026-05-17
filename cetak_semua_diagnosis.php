<?php
include './admin/koneksi.php';
session_start();
if ($_SESSION['status'] != "login") {
  header("location:./admin/login.php");
  exit;
}
require_once './vendor/fpdf/fpdf.php';

class PDFAll extends FPDF {
    function Header() {
        $this->SetFont('Helvetica', 'B', 15);
        $this->SetTextColor(45, 106, 79);
        $this->Cell(0, 9, 'LAPORAN DATA DIAGNOSA STUNTING', 0, 1, 'C');
        $this->SetFont('Helvetica', '', 10);
        $this->SetTextColor(80, 80, 80);
        $this->Cell(0, 6, 'Sistem Pakar Stunting Smart  |  Tanggal Cetak: ' . date('d/m/Y H:i'), 0, 1, 'C');
        $this->SetDrawColor(45, 106, 79);
        $this->SetLineWidth(0.7);
        $this->Line(10, $this->GetY(), 287, $this->GetY());
        $this->Ln(3);
    }
    function Footer() {
        $this->SetY(-12);
        $this->SetFont('Helvetica', 'I', 8);
        $this->SetTextColor(150, 150, 150);
        $this->Cell(0, 8, 'Halaman ' . $this->PageNo() . ' dari {nb}  |  Stunting Smart', 0, 0, 'C');
    }
}

$q = mysqli_query($koneksi, "SELECT * FROM tb_diagnosis ORDER BY tanggal DESC");
$rows = [];
while ($r = mysqli_fetch_assoc($q)) $rows[] = $r;

$pdf = new PDFAll('L', 'mm', 'A4'); // Landscape
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetAutoPageBreak(true, 18);

// Summary
$total = count($rows);
$stunting = 0; $normal = 0; $sangat = 0; $tinggi = 0;
foreach ($rows as $r) {
  switch ($r['status_zscore']) {
    case 'SANGAT PENDEK': $sangat++; $stunting++; break;
    case 'PENDEK':        $stunting++; break;
    case 'NORMAL':        $normal++; break;
    case 'TINGGI':        $tinggi++; break;
  }
}
$pdf->SetFont('Helvetica', '', 10);
$pdf->SetFillColor(240, 248, 244);
$pdf->Cell(60, 7, 'Total Balita Didiagnosa: ' . $total, 0, 0, 'L', true);
$pdf->Cell(60, 7, 'Stunting (Pendek+Sangat Pendek): ' . $stunting, 0, 0, 'L', true);
$pdf->Cell(60, 7, 'Normal: ' . $normal, 0, 0, 'L', true);
$pdf->Cell(60, 7, 'Tinggi: ' . $tinggi, 0, 1, 'L', true);
$pdf->Ln(3);

// Table Header
$pdf->SetFont('Helvetica', 'B', 8);
$pdf->SetFillColor(45, 106, 79);
$pdf->SetTextColor(255, 255, 255);
$cols = [
  '#' => 8, 'Nama Balita' => 38, 'JK' => 12, 'Umur(Bln)' => 18,
  'Tinggi(cm)' => 18, 'Z-Score' => 16, 'Status Pertumbuhan' => 28,
  'Hasil Diagnosa' => 38, 'Kepercayaan' => 20, 'Tanggal' => 28
];
foreach ($cols as $label => $w) {
  $pdf->Cell($w, 7, $label, 1, 0, 'C', true);
}
$pdf->Ln();

// Table Rows
$pdf->SetTextColor(30, 30, 30);
$no = 1;
$fill = false;
foreach ($rows as $row) {
  $pdf->SetFillColor($fill ? 240 : 255, $fill ? 248 : 255, $fill ? 244 : 255);
  $pdf->SetFont('Helvetica', '', 7.5);
  $pdf->Cell(8,  6, $no++, 1, 0, 'C', $fill);
  $pdf->Cell(38, 6, mb_strimwidth($row['nama_balita'], 0, 22, '..', 'UTF-8'), 1, 0, 'L', $fill);
  $pdf->Cell(12, 6, substr($row['jenis_kelamin'], 0, 4), 1, 0, 'C', $fill);
  $pdf->Cell(18, 6, $row['umur_bulan'], 1, 0, 'C', $fill);
  $pdf->Cell(18, 6, $row['tinggi_cm'], 1, 0, 'C', $fill);
  $pdf->Cell(16, 6, number_format($row['zscore'], 2), 1, 0, 'C', $fill);
  $pdf->Cell(28, 6, $row['status_zscore'], 1, 0, 'C', $fill);
  $pdf->Cell(38, 6, mb_strimwidth($row['hasil_penyakit'], 0, 24, '..', 'UTF-8'), 1, 0, 'L', $fill);
  $pdf->Cell(20, 6, number_format($row['derajat_kepercayaan'], 2) . '%', 1, 0, 'C', $fill);
  $pdf->Cell(28, 6, date('d/m/Y H:i', strtotime($row['tanggal'])), 1, 1, 'C', $fill);
  $fill = !$fill;
}

$pdf->Ln(4);
$pdf->SetFont('Helvetica', 'I', 8);
$pdf->SetTextColor(120, 120, 120);
$pdf->Cell(0, 5, 'Dokumen ini dihasilkan secara otomatis oleh Sistem Pakar Stunting Smart. Untuk keperluan medis, konsultasikan dengan tenaga kesehatan profesional.', 0, 1, 'C');

$pdf->Output('D', 'Laporan_Semua_Diagnosa_' . date('Ymd_His') . '.pdf');
