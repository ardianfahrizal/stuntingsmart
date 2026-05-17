<?php
include './koneksi.php';
// mengaktifkan session
session_start();
// cek apakah user telah login, jika belum login maka di alihkan ke halaman login
if ($_SESSION['status'] != "login") {
  header("location:./login.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Admin - Stunting Smart</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="../assets/img/favicon.png" rel="icon">
  <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet"> -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
  <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="../assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="../assets/css/style.css" rel="stylesheet">

</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">
    <!-- <h4>Dashboard - Admin Diagnosa Penyakit Penyakit Anak</h4> -->
    <div class="d-flex align-items-center justify-content-between">
      <a href="index.php" class="logo d-flex align-items-center">
        <img src="../assets/img/logo.png" alt="logo">
        <span class="d-none d-lg-block">Stunting Smart</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div>
    <!-- End Logo -->
  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="index.php">
          <i class="bi bi-house"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-database"></i><span>Master Data</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="./penyakit/penyakit.php">
              <span>Data Penyakit dan Solusi</span>
            </a>
          </li>
          <li>
            <a href="./gejala/gejala.php">
              <span>Data Gejala</span>
            </a>
          </li>
        </ul>
      </li><!-- End Components Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="./rules/rules.php">
          <i class="bi bi-boxes"></i>
          <span>Rule</span>
        </a>
      </li><!-- End Profile Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="./data_diagnosis.php">
          <i class="bi bi-clipboard2-pulse"></i>
          <span>Data Diagnosa</span>
        </a>
      </li><!-- End Data Diagnosa Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Laporan</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="./laporan/lapgejala.php">
              <span>Laporan Gejala</span>
            </a>
          </li>
        </ul>
      </li><!-- End Forms Nav -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="javascript:;" data-bs-toggle="modal" data-bs-target="#logoutmodal">
          <i class="bi bi-box-arrow-in-right"></i>
          <span>Logout</span>
        </a>
      </li><!-- End Login Page Nav -->
    </ul>
  </aside><!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav style="--bs-breadcrumb-divider: '>';">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Admin</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
      <hr>
    </div><!-- End Page Title -->

    <section>
      <h1>Selamat Datang Admin</h1>
      <br>
      <p>Stunting Smart, yaitu sebuah platform online untuk diagnosis stunting pada anak. 
        Membantu orang tua dan tenaga medis dengan cepat dan efisien dalam mengidentifikasi kondisi stunting.</p>
    </section>

    <?php
    // Ambil statistik dari tb_diagnosis
    $q_total    = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM tb_diagnosis");
    $r_total    = mysqli_fetch_assoc($q_total);
    $stat_total = $r_total['total'];

    $q_stunting = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM tb_diagnosis WHERE status_zscore IN('PENDEK','SANGAT PENDEK')");
    $r_stunting = mysqli_fetch_assoc($q_stunting);
    $stat_stunting = $r_stunting['total'];

    $q_sangat   = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM tb_diagnosis WHERE status_zscore='SANGAT PENDEK'");
    $r_sangat   = mysqli_fetch_assoc($q_sangat);
    $stat_sangat = $r_sangat['total'];

    $q_pendek   = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM tb_diagnosis WHERE status_zscore='PENDEK'");
    $r_pendek   = mysqli_fetch_assoc($q_pendek);
    $stat_pendek = $r_pendek['total'];

    $q_normal   = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM tb_diagnosis WHERE status_zscore='NORMAL'");
    $r_normal   = mysqli_fetch_assoc($q_normal);
    $stat_normal = $r_normal['total'];

    $q_tinggi   = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM tb_diagnosis WHERE status_zscore='TINGGI'");
    $r_tinggi   = mysqli_fetch_assoc($q_tinggi);
    $stat_tinggi = $r_tinggi['total'];

    // Data bulanan (6 bulan terakhir)
    $bulan_labels = [];
    $bulan_stunt  = [];
    $bulan_norm   = [];
    for ($i = 5; $i >= 0; $i--) {
      $tgl = date('Y-m', strtotime("-$i months"));
      $bulan_labels[] = date('M Y', strtotime("-$i months"));
      $qs = mysqli_query($koneksi, "SELECT COUNT(*) as t FROM tb_diagnosis WHERE DATE_FORMAT(tanggal,'%Y-%m')='$tgl' AND status_zscore IN('PENDEK','SANGAT PENDEK')");
      $rs = mysqli_fetch_assoc($qs); $bulan_stunt[] = (int)$rs['t'];
      $qn = mysqli_query($koneksi, "SELECT COUNT(*) as t FROM tb_diagnosis WHERE DATE_FORMAT(tanggal,'%Y-%m')='$tgl' AND status_zscore='NORMAL'");
      $rn = mysqli_fetch_assoc($qn); $bulan_norm[] = (int)$rn['t'];
    }
    ?>

    <!-- Kartu Statistik -->
      <div class="col-md-6">
        <div class="card border-0 shadow-sm h-100" style="background:linear-gradient(135deg,#2d6a4f,#40916c);color:#fff;">
          <div class="card-body d-flex flex-column justify-content-center align-items-start p-4">
            <i class="bi bi-clipboard2-pulse fs-1 mb-3 opacity-75"></i>
            <h5 class="fw-bold mb-1">Kelola Data Diagnosa</h5>
            <p class="small opacity-75 mb-3">Lihat, download, dan kelola seluruh hasil diagnosa balita yang telah tersimpan dalam sistem.</p>
            <div class="d-flex gap-2 flex-wrap">
              <a href="./data_diagnosis.php" class="btn btn-light btn-sm text-success fw-semibold">
                <i class="bi bi-table"></i> Lihat Semua Data
              </a>
              <a href="../cetak_semua_diagnosis.php" target="_blank" class="btn btn-outline-light btn-sm">
                <i class="bi bi-file-earmark-pdf"></i> Download PDF
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main><!-- End #main -->

  <!-- Logout Modal -->
  <div class="modal fade" id="logoutmodal" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Apakah Anda yakin ingin keluar ?</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-footer">
          <a href="./logout.php" type="button" class="btn btn-success btn-sm"><i class="bi bi-check-lg"></i> Ya</a>
          <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal"><i class="bi bi-x"></i> Tidak</button>
        </div>
      </div>
    </div>
  </div><!-- End Logout Modal-->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="../assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/chart.js/chart.min.js"></script>
  <script src="../assets/vendor/echarts/echarts.min.js"></script>
  <script src="../assets/vendor/quill/quill.min.js"></script>
  <script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="../assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="../assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="../assets/js/main.js"></script>
  <script>
    // ── Pie Chart
    var pieOptions = {
      series: [<?= $stat_sangat ?>, <?= $stat_pendek ?>, <?= $stat_normal ?>, <?= $stat_tinggi ?>],
      chart: { type: 'donut', height: 260 },
      labels: ['Sangat Pendek', 'Pendek', 'Normal', 'Tinggi'],
      colors: ['#dc3545', '#fd7e14', '#198754', '#0d6efd'],
      legend: { position: 'bottom', fontSize: '12px' },
      plotOptions: { pie: { donut: { size: '55%', labels: { show: true, total: { show: true, label: 'Total', formatter: function(w) { return w.globals.seriesTotals.reduce((a,b) => a+b, 0) + ' Balita'; } } } } } },
      dataLabels: { enabled: true, formatter: function(val) { return Math.round(val) + '%'; } },
      responsive: [{ breakpoint: 480, options: { chart: { height: 220 }, legend: { position: 'bottom' } } }]
    };
    var pieChart = new ApexCharts(document.querySelector("#pieChart"), pieOptions);
    pieChart.render();

    // ── Bar Chart
    var barOptions = {
      series: [
        { name: 'Stunting', data: [<?= implode(',', $bulan_stunt) ?>] },
        { name: 'Normal',   data: [<?= implode(',', $bulan_norm) ?>] }
      ],
      chart: { type: 'bar', height: 260, toolbar: { show: false } },
      colors: ['#dc3545', '#198754'],
      plotOptions: { bar: { horizontal: false, columnWidth: '50%', borderRadius: 4 } },
      dataLabels: { enabled: false },
      xaxis: { categories: [<?= '"' . implode('","', $bulan_labels) . '"' ?>], labels: { style: { fontSize: '11px' } } },
      yaxis: { title: { text: 'Jumlah Balita' }, min: 0, forceNiceScale: true },
      legend: { position: 'top', horizontalAlign: 'right' },
      fill: { opacity: 1 },
      tooltip: { y: { formatter: function(val) { return val + " balita"; } } }
    };
    var barChart = new ApexCharts(document.querySelector("#barChart"), barOptions);
    barChart.render();
  </script>

</html>