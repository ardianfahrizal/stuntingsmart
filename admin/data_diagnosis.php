<?php
include './koneksi.php';
session_start();
if ($_SESSION['status'] != "login") {
  header("location:./login.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Data Diagnosa - Admin Stunting Smart</title>
  <link href="../assets/img/favicon.png" rel="icon">
  <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
  <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../assets/vendor/simple-datatables/style.css" rel="stylesheet">
  <link href="../assets/css/style.css" rel="stylesheet">
  <style>
    .badge-stunting   { background: #fee2e2; color: #991b1b; }
    .badge-sangat     { background: #fecaca; color: #7f1d1d; }
    .badge-normal     { background: #d1fae5; color: #065f46; }
    .badge-tinggi     { background: #dbeafe; color: #1e40af; }
    .status-label { padding: 3px 10px; border-radius: 20px; font-size:0.8rem; font-weight:600; }
    .table th { background: #2d6a4f; color: #fff; font-size: 0.85rem; }
    .table td { font-size: 0.85rem; vertical-align: middle; }
    .action-btns { white-space: nowrap; }
  </style>
</head>
<body>

  <!-- Header -->
  <header id="header" class="header fixed-top d-flex align-items-center">
    <div class="d-flex align-items-center justify-content-between">
      <a href="index.php" class="logo d-flex align-items-center">
        <img src="../assets/img/logo.png" alt="logo">
        <span class="d-none d-lg-block">Stunting Smart</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div>
  </header>

  <!-- Sidebar -->
  <aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
      <li class="nav-item">
        <a class="nav-link collapsed" href="index.php">
          <i class="bi bi-house"></i><span>Dashboard</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-database"></i><span>Master Data</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
          <li><a href="./penyakit/penyakit.php"><span>Data Penyakit dan Solusi</span></a></li>
          <li><a href="./gejala/gejala.php"><span>Data Gejala</span></a></li>
        </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="./rules/rules.php">
          <i class="bi bi-boxes"></i><span>Rule</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="./data_diagnosis.php">
          <i class="bi bi-clipboard2-pulse"></i><span>Data Diagnosa</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Laporan</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
          <li><a href="./laporan/lapgejala.php"><span>Laporan Gejala</span></a></li>
        </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="javascript:;" data-bs-toggle="modal" data-bs-target="#logoutmodal">
          <i class="bi bi-box-arrow-in-right"></i><span>Logout</span>
        </a>
      </li>
    </ul>
  </aside>

  <main id="main" class="main">
    <div class="pagetitle">
      <h1>Data Hasil Diagnosa</h1>
      <nav style="--bs-breadcrumb-divider: '>';">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Admin</a></li>
          <li class="breadcrumb-item active">Data Diagnosa</li>
        </ol>
      </nav>
      <hr>
    </div>

    <section class="section">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center py-3">
          <h5 class="mb-0"><i class="bi bi-clipboard2-pulse me-2 text-success"></i>Daftar Hasil Diagnosa Balita</h5>
          <div class="d-flex gap-2">
            <a href="../cetak_semua_diagnosis.php" target="_blank" class="btn btn-danger btn-sm">
              <i class="bi bi-file-earmark-pdf"></i> Download Semua Data
            </a>
            
          </div>
        </div>
        <div class="card-body pt-3">
          <?php
          $result = mysqli_query($koneksi, "SELECT * FROM tb_diagnosis ORDER BY tanggal DESC");
          $total = mysqli_num_rows($result);
          ?>
          <p class="text-muted">Total data: <strong><?= $total ?></strong> rekaman diagnosa</p>

          <?php if ($total == 0): ?>
          <div class="alert alert-info text-center">
            <i class="bi bi-info-circle"></i> Belum ada data diagnosa tersimpan.
          </div>
          <?php else: ?>
          <div class="table-responsive">
            <table class="table table-bordered table-hover datatable">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Nama Balita</th>
                  <th>Jenis Kelamin</th>
                  <th>Umur (Bln)</th>
                  <th>Tinggi (cm)</th>
                  <th>Z-Score</th>
                  <th>Status</th>
                  <th>Hasil Diagnosa</th>
                  <th>Kepercayaan</th>
                  <th>Tanggal</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                mysqli_data_seek($result, 0);
                while ($row = mysqli_fetch_assoc($result)):
                  $statusClass = '';
                  switch($row['status_zscore']) {
                    case 'SANGAT PENDEK': $statusClass = 'badge-sangat'; break;
                    case 'PENDEK':        $statusClass = 'badge-stunting'; break;
                    case 'NORMAL':        $statusClass = 'badge-normal'; break;
                    case 'TINGGI':        $statusClass = 'badge-tinggi'; break;
                    default:              $statusClass = 'badge-normal'; break;
                  }
                ?>
                <tr>
                  <td><?= $no++ ?></td>
                  <td><strong><?= htmlspecialchars($row['nama_balita']) ?></strong></td>
                  <td><?= htmlspecialchars($row['jenis_kelamin']) ?></td>
                  <td class="text-center"><?= $row['umur_bulan'] ?></td>
                  <td class="text-center"><?= $row['tinggi_cm'] ?></td>
                  <td class="text-center"><?= number_format($row['zscore'], 2) ?></td>
                  <td><span class="status-label <?= $statusClass ?>"><?= $row['status_zscore'] ?></span></td>
                  <td><?= htmlspecialchars($row['hasil_penyakit']) ?></td>
                  <td class="text-center"><?= number_format($row['derajat_kepercayaan'], 2) ?>%</td>
                  <td><?= date('d/m/Y H:i', strtotime($row['tanggal'])) ?></td>
                  <td class="action-btns">
                    <a href="../cetak_diagnosis.php?id=<?= $row['id'] ?>" target="_blank"
                       class="btn btn-sm btn-success" title="Download PDF">
                      <i class="bi bi-file-earmark-pdf"></i> PDF
                    </a>
                    <a href="hapus_diagnosis.php?id=<?= $row['id'] ?>"
                       onclick="return confirm('Hapus data ini?')"
                       class="btn btn-sm btn-danger" title="Hapus">
                      <i class="bi bi-trash"></i>
                    </a>
                  </td>
                </tr>
                <?php endwhile; ?>
              </tbody>
            </table>
          </div>
          <?php endif; ?>
        </div>
      </div>
    </section>
  </main>

  <!-- Logout Modal -->
  <div class="modal fade" id="logoutmodal" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Apakah Anda yakin ingin keluar?</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-footer">
          <a href="./logout.php" type="button" class="btn btn-success btn-sm"><i class="bi bi-check-lg"></i> Ya</a>
          <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal"><i class="bi bi-x"></i> Tidak</button>
        </div>
      </div>
    </div>
  </div>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="../assets/js/main.js"></script>
  <script>
    const datatable = new simpleDatatables.DataTable(".datatable", {
      perPage: 10,
      labels: {
        placeholder: "Cari data...",
        perPage: "{select} data per halaman",
        noRows: "Tidak ada data",
        info: "Menampilkan {start} hingga {end} dari {rows} data"
      }
    });
  </script>

</body>
</html>
