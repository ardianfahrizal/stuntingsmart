<?php
include './admin/koneksi.php';
// mengaktifkan session
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Diagnosa Stunting Anak</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="./assets/img/favicon.png" rel="icon">
  <link href="./assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="./assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
  <link href="./assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="./assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="./assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="./assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="./assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="./assets/css/style.css" rel="stylesheet">

  <style>
    :root {
      --bg: #f5f2ee;
      --card: #ffffff;
      --dark: #1e2228;
      --accent: #2d6a4f;
      --accent2: #52b788;
      --danger: #d62828;
      --warning: #f77f00;
      --warn-light: #fff3cd;
      --success: #2d6a4f;
      --success-light: #d8f3dc;
      --muted: #6b7280;
      --border: #e5e0d8;
      --radius: 16px;
      --shadow: 0 4px 24px rgba(30,34,40,0.10);
    }

    .gejala {
      color: blue;
      padding: 5px;
      display: flex;
      justify-content: center;
    }

    /* Z-Score Result Card */
    .zscore-result {
      background: linear-gradient(135deg, #e8f5ee 0%, #f0faf5 100%);
      border: 1.5px solid #b7e4c7;
      border-radius: var(--radius);
      padding: 1.5rem 2rem;
      margin-bottom: 1.5rem;
      position: relative;
      overflow: hidden;
    }
    .zscore-result::before {
      content: '';
      position: absolute;
      top: 0; left: 0;
      width: 5px; height: 100%;
      background: var(--accent2);
      border-radius: 4px 0 0 4px;
    }
    .zscore-result.status-danger {
      background: linear-gradient(135deg, #fde8e8 0%, #fff5f5 100%);
      border-color: #f5b7b7;
    }
    .zscore-result.status-danger::before { background: var(--danger); }
    .zscore-result.status-warning {
      background: linear-gradient(135deg, #fff8e1 0%, #fffdf0 100%);
      border-color: #ffd54f;
    }
    .zscore-result.status-warning::before { background: var(--warning); }
    .zscore-result .result-title {
      font-family: 'DM Serif Display', serif;
      font-size: 1.05rem;
      color: var(--dark);
      margin-bottom: 1rem;
    }
    .zscore-result .result-grid {
      display: flex;
      flex-wrap: wrap;
      gap: 1rem;
    }
    .result-item { flex: 1; min-width: 130px; }
    .result-item .item-label {
      font-size: 0.72rem;
      font-weight: 700;
      letter-spacing: 0.06em;
      text-transform: uppercase;
      color: var(--muted);
      margin-bottom: 3px;
    }
    .result-item .item-value { font-size: 1rem; font-weight: 600; color: var(--dark); }
    .result-item .item-value.score-value { font-size: 1.3rem; color: var(--accent); }
    .result-item .item-value .status-badge {
      display: inline-block;
      padding: 3px 12px;
      border-radius: 50px;
      font-size: 0.85rem;
      font-weight: 700;
    }
    .status-NORMAL { background: var(--success-light); color: var(--accent); }
    .status-PENDEK { background: #fff3cd; color: #856404; }
    .status-SANGAT-PENDEK { background: #f8d7da; color: #721c24; }
    .status-TINGGI { background: #cce5ff; color: #004085; }
    .step-badge {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      background: var(--success-light);
      color: var(--accent);
      border-radius: 50px;
      padding: 4px 14px;
      font-size: 0.78rem;
      font-weight: 700;
      letter-spacing: 0.05em;
      text-transform: uppercase;
      margin-bottom: 0.8rem;
    }
    .section-divider {
      border: none;
      border-top: 2px dashed #d0cec9;
      margin: 1.5rem 0;
    }
  </style>
</head>

<body>
  <?php
  $zs_nama    = '';
  $zs_kelamin = '';
  $zs_umur    = '';
  $zs_tinggi  = '';
  $zs_score   = '';
  $zs_status  = '';

  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['zs_nama']) && !isset($_POST['bukti'])) {
    // Data baru dari zscore.php
    $zs_nama    = htmlspecialchars(trim($_POST['zs_nama']));
    $zs_kelamin = htmlspecialchars($_POST['zs_kelamin'] ?? '');
    $zs_umur    = intval($_POST['zs_umur'] ?? 0);
    $zs_tinggi  = floatval($_POST['zs_tinggi'] ?? 0);
    $zs_score   = htmlspecialchars($_POST['zs_score'] ?? '');
    $zs_status  = htmlspecialchars($_POST['zs_status'] ?? '');

    $_SESSION['zs_nama']    = $zs_nama;
    $_SESSION['zs_kelamin'] = $zs_kelamin;
    $_SESSION['zs_umur']    = $zs_umur;
    $_SESSION['zs_tinggi']  = $zs_tinggi;
    $_SESSION['zs_score']   = $zs_score;
    $_SESSION['zs_status']  = $zs_status;

  } elseif (isset($_SESSION['zs_nama'])) {
    $zs_nama    = $_SESSION['zs_nama'];
    $zs_kelamin = $_SESSION['zs_kelamin'];
    $zs_umur    = $_SESSION['zs_umur'];
    $zs_tinggi  = $_SESSION['zs_tinggi'];
    $zs_score   = $_SESSION['zs_score'];
    $zs_status  = $_SESSION['zs_status'];
  }

  // Jika tidak ada data Z-Score dan bukan dari form gejala, redirect ke zscore.php
  if (empty($zs_nama) && !isset($_POST['bukti'])) {
    header('Location: ./zscore.php');
    exit;
  }

  $statusClass = '';
  if ($zs_status === 'SANGAT PENDEK') $statusClass = 'status-danger';
  elseif ($zs_status === 'PENDEK') $statusClass = 'status-warning';

  $badgeClass = 'status-' . str_replace(' ', '-', $zs_status ?: 'NORMAL');
  ?>

  <section>
    <div class="card mt-4 col-md-8 mx-auto">
      <div class="mt-4 d-flex gap-2">
        <a href="./zscore.php" type="button" class="btn btn-outline-secondary btn-sm ms-3">
          <i class="bi bi-arrow-left"></i> Ubah Data Anak
        </a>
        <a href="./index.php" type="button" class="btn btn-outline-danger btn-sm">
          <i class="bi bi-box-arrow-left"></i> Kembali ke Beranda
        </a>
      </div>

      <!-- <div class="text-center mt-3">
        <span class="step-badge"><i class="bi bi-2-circle-fill"></i> Langkah 2 dari 2</span>
      </div> -->
      <h4 class="text-dark d-flex justify-content-center mb-1">Proses Diagnosa Stunting</h4>

      <div class="card-body">

        <?php if (!empty($zs_nama)): ?>
        <!-- ====== HASIL PERHITUNGAN Z-SCORE (STANDAR WHO) ====== -->
        <h5 class="text-secondary text-center mt-4">Informasi Tinggi Badan Balita</h5>
        <div class="zscore-result <?= $statusClass ?>">
          <p class="result-title">Hasil Perhitungan Z-Score (Standar WHO)</p>
          <div class="result-grid">
            <div class="result-item">
              <div class="item-label">Nama Balita</div>
              <div class="item-value"><?= $zs_nama ?></div>
            </div>
            <div class="result-item">
              <div class="item-label">Jenis Kelamin</div>
              <div class="item-value"><?= $zs_kelamin === 'L' ? 'Laki-Laki' : 'Perempuan' ?></div>
            </div>
            <div class="result-item">
              <div class="item-label">Umur</div>
              <div class="item-value"><?= $zs_umur ?> Bulan</div>
            </div>
            <div class="result-item">
              <div class="item-label">Tinggi Badan</div>
              <div class="item-value"><?= $zs_tinggi ?> cm</div>
            </div>
            <div class="result-item">
              <div class="item-label">Nilai Z-Score (TB/U)</div>
              <div class="item-value score-value"><?= $zs_score ?></div>
            </div>
            <div class="result-item">
              <div class="item-label">Status Pertumbuhan TInggi Anak</div>
              <div class="item-value">
                <span class="status-badge <?= $badgeClass ?>"><?= $zs_status ?></span>
              </div>
            </div>
          </div>
        </div>
        <?php endif; ?>

        <hr class="section-divider">

        <!-- ====== PILIH GEJALA ====== -->
        <div class="bg-info rounded-1">
          <h3 class="mt-4 ms-2 p-1">Petunjuk Pengisian</h3>
          <p class="ms-3 me-2 pb-2">Proses konsultasi terdiri dari 27 pertanyaan. Selanjutnya, anda diminta untuk menjawab dengan cara klik opsi gejalanya apabila gejala tersebut sesuai dengan kondisi yang terjadi. Bacalah dan jawab setiap gejala dengan teliti dan seksama.</p>
        </div>

        <h5 class="text-secondary text-center mt-4">Pilih Gejala</h5>

        <?php
        $koneksi = mysqli_connect("localhost", "root", "", "db_anak");
        if (mysqli_connect_errno()) {
          echo "Koneksi database gagal : " . mysqli_connect_error();
        }
        ?>

        <form id="konsultasiForm" action="./hasilkonsultasi.php" method="POST">
          <!-- Teruskan data Z-Score ke hasilkonsultasi.php -->
          <input type="hidden" name="zs_nama"    value="<?= htmlspecialchars($zs_nama) ?>">
          <input type="hidden" name="zs_kelamin" value="<?= htmlspecialchars($zs_kelamin) ?>">
          <input type="hidden" name="zs_umur"    value="<?= htmlspecialchars($zs_umur) ?>">
          <input type="hidden" name="zs_tinggi"  value="<?= htmlspecialchars($zs_tinggi) ?>">
          <input type="hidden" name="zs_score"   value="<?= htmlspecialchars($zs_score) ?>">
          <input type="hidden" name="zs_status"  value="<?= htmlspecialchars($zs_status) ?>">

          <?php
          $sqli = "SELECT * FROM tb_gejala";
          $result = $koneksi->query($sqli);

          if (isset($_POST['bukti'])) {
            if (count($_POST['bukti']) < 2) {
              echo "<p class=\"gejala\">Mohon maaf anda harus pilih minimal 2 gejala</p>";
            } elseif (count($_POST['bukti']) <= 0) {
              echo "<p class=\"gejala\">Anda harus memilih gejala terlebih dahulu</p>";
            }
          }

          while ($row = $result->fetch_object()) {
            echo "<hr> ";
            echo "<label for='checkbox" . $row->id . "' style='cursor: pointer;'>";
            echo "<input style='cursor: pointer; width:20px;height:20px;' type='checkbox' id='checkbox" . $row->id . "' name='bukti[]' value='" . $row->id . "'";
            if (isset($_POST['bukti'])) {
              echo (in_array($row->id, $_POST['bukti']) ? " checked" : "");
            }
            echo ">&ensp; " . $row->id . ". " . $row->gejala . "</label><br>";
          }
          ?>

          <div class="mt-4 mb-3" style="justify-content: center;display: flex;">
            <button type="button" class="btn btn-outline-success btn-md"
              onclick="return validateGejala();"
              style="width: 180px; height: 48px; cursor: pointer; box-shadow: 0 0 10px rgb(255, 250, 240 alig);">
              <i class="bi bi-check-lg"></i> Diagnosa
            </button>
          </div>
        </form>
      </div>
    </div>
  </section>

  <script>
  function validateGejala() {
    const boxes = document.getElementsByName("bukti[]");
    let checkboxesChecked = 0;
    for (let i = 0; i < boxes.length; i++) {
      if (boxes[i].checked) checkboxesChecked++;
    }
    if (checkboxesChecked < 2) {
      alert("Maaf, Anda harus memilih minimal 2 gejala");
      return false;
    }
    document.getElementById('konsultasiForm').submit();
    return true;
  }
  </script>

  <!-- Vendor JS Files -->
  <script src="./assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>
