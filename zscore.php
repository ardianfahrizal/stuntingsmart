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

  <title>Data Anak – Diagnosa Stunting</title>
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
  <link href="./assets/vendor/remixicon/remixicon.css" rel="stylesheet">

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

    body {
      background: var(--bg);
    }

    .page-wrapper {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 2rem 1rem;
    }

    .zscore-card {
      background: #fff;
      border-radius: var(--radius);
      box-shadow: var(--shadow);
      width: 100%;
      max-width: 680px;
      padding: 2.5rem 2.5rem 2rem;
    }

    .zscore-card .back-btn {
      margin-bottom: 1.5rem;
    }

    .zscore-card .page-title {
      font-family: 'DM Serif Display', serif;
      color: var(--dark);
      font-size: 1.6rem;
      text-align: center;
      margin-bottom: 0.3rem;
    }

    .zscore-card .page-subtitle {
      text-align: center;
      color: var(--muted);
      font-size: 0.88rem;
      margin-bottom: 2rem;
    }

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
      margin-bottom: 1.2rem;
    }

    .form-section-title {
      font-family: 'DM Serif Display', serif;
      color: var(--dark);
      font-size: 1.05rem;
      margin-bottom: 1.2rem;
      padding-bottom: 0.6rem;
      border-bottom: 2px dashed var(--border);
    }

    .field-label {
      display: block;
      font-size: 0.78rem;
      font-weight: 700;
      letter-spacing: 0.06em;
      text-transform: uppercase;
      color: var(--muted);
      margin-bottom: 6px;
    }

    .field-input {
      width: 100%;
      padding: 11px 14px;
      border: 1.5px solid var(--border);
      border-radius: 10px;
      font-size: 0.95rem;
      font-family: inherit;
      color: var(--dark);
      background: #faf9f7;
      outline: none;
      transition: border-color 0.2s, box-shadow 0.2s;
    }

    .field-input:focus {
      border-color: var(--accent2);
      box-shadow: 0 0 0 3px rgba(82,183,136,0.15);
      background: #fff;
    }

    .field-hint {
      font-size: 0.76rem;
      color: var(--muted);
      margin-top: 4px;
    }

    .radio-group {
      display: flex;
      gap: 1rem;
    }

    .radio-option {
      flex: 1;
      border: 1.5px solid var(--border);
      border-radius: 10px;
      padding: 10px 14px;
      cursor: pointer;
      display: flex;
      align-items: center;
      gap: 9px;
      font-size: 0.93rem;
      color: var(--dark);
      transition: border-color 0.2s, background 0.2s;
      background: #faf9f7;
    }

    .radio-option:has(input:checked) {
      border-color: var(--accent2);
      background: var(--success-light);
      color: var(--accent);
      font-weight: 600;
    }

    .radio-option input {
      accent-color: var(--accent);
      width: 16px;
      height: 16px;
    }

    .btn-submit-zscore {
      width: 100%;
      padding: 13px;
      background: var(--accent);
      color: #fff;
      border: none;
      border-radius: 12px;
      font-size: 1rem;
      font-weight: 700;
      font-family: inherit;
      cursor: pointer;
      transition: background 0.2s, transform 0.1s;
      margin-top: 1.5rem;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
    }

    .btn-submit-zscore:hover {
      background: #245a42;
      transform: translateY(-1px);
    }

    .form-row {
      display: flex;
      gap: 1.2rem;
      margin-bottom: 1rem;
    }

    .form-col {
      flex: 1;
    }

    @media (max-width: 576px) {
      .form-row { flex-direction: column; gap: 0; }
      .zscore-card { padding: 1.5rem 1.2rem; }
    }
  </style>
</head>

<body>
  <div class="page-wrapper">
    <div class="zscore-card">
      <div class="back-btn">
        <a href="./index.php" class="btn btn-outline-danger btn-sm">
          <i class="bi bi-box-arrow-left"></i> Kembali
        </a>
      </div>

      <!-- <div class="text-center mb-1">
        <span class="step-badge"><i class="bi bi-1-circle-fill"></i> Langkah 1 dari 2</span>
      </div> -->
      <h1 class="page-title">Data Anak</h1>
      <p class="page-subtitle">
        Isi data di bawah untuk menghitung Z-Score berdasarkan standar WHO (TB/U).<br>
      </p>

      <p class="form-section-title">Perhitungan Z-Score</p>

      <div id="zsErrorMsg" class="alert alert-danger py-2 mb-3" style="display:none; font-size:0.85rem;"></div>

      <div class="form-row">
        <div class="form-col">
          <label class="field-label">Nama Balita</label>
          <input type="text" class="field-input" id="zsNama" placeholder="Masukkan Nama Balita" autocomplete="off">
        </div>
        <div class="form-col">
          <label class="field-label">Jenis Kelamin</label>
          <div class="radio-group">
            <label class="radio-option">
              <input type="radio" name="zsKelamin" value="L" id="zsLaki"> Laki-Laki
            </label>
            <label class="radio-option">
              <input type="radio" name="zsKelamin" value="P" id="zsPerempuan" checked> Perempuan
            </label>
          </div>
        </div>
      </div>

      <div class="form-row">
        <div class="form-col">
          <label class="field-label">Umur Balita (Bulan)</label>
          <input type="number" class="field-input" id="zsUmur" placeholder="6 – 60 bulan" min="6" max="60">
          <div class="field-hint">Masukkan umur antara 6 – 60 bulan</div>
        </div>
        <div class="form-col">
          <label class="field-label">Tinggi Badan (Cm)</label>
          <input type="number" class="field-input" id="zsTinggi" placeholder="Tinggi badan balita" step="0.1">
          <div class="field-hint">Masukkan tinggi dalam satuan sentimeter</div>
        </div>
      </div>

      <!-- Hidden form to POST to konsultasi.php -->
      <form id="zscoreForm" action="./konsultasi.php" method="POST">
        <input type="hidden" name="zs_nama"    id="hNama">
        <input type="hidden" name="zs_kelamin" id="hKelamin">
        <input type="hidden" name="zs_umur"    id="hUmur">
        <input type="hidden" name="zs_tinggi"  id="hTinggi">
        <input type="hidden" name="zs_score"   id="hZScore">
        <input type="hidden" name="zs_status"  id="hZStatus">
      </form>

      <button type="button" class="btn-submit-zscore" onclick="validateAndProceed()">
        <i class="bi bi-arrow-right-circle-fill"></i> Submit
      </button>
    </div>
  </div>

  <!-- WHO Reference Data & Z-Score Logic -->
  <script>
  const WHO_BOYS = {
    6:[1,67.6,0.0379], 7:[1,69.2,0.0380], 8:[1,70.6,0.0380], 9:[1,72.0,0.0381],
    10:[1,73.3,0.0382], 11:[1,74.5,0.0383], 12:[1,75.7,0.0383], 13:[1,76.9,0.0384],
    14:[1,78.0,0.0385], 15:[1,79.1,0.0386], 16:[1,80.2,0.0387], 17:[1,81.2,0.0388],
    18:[1,82.3,0.0388], 19:[1,83.2,0.0389], 20:[1,84.2,0.0390], 21:[1,85.1,0.0391],
    22:[1,86.0,0.0392], 23:[1,86.9,0.0393], 24:[1,87.8,0.0393], 25:[1,88.6,0.0394],
    26:[1,89.4,0.0394], 27:[1,90.3,0.0395], 28:[1,91.1,0.0396], 29:[1,91.9,0.0397],
    30:[1,92.7,0.0397], 31:[1,93.4,0.0398], 32:[1,94.2,0.0398], 33:[1,95.0,0.0399],
    34:[1,95.7,0.0399], 35:[1,96.4,0.0400], 36:[1,97.1,0.0400], 37:[1,97.8,0.0401],
    38:[1,98.5,0.0402], 39:[1,99.2,0.0402], 40:[1,99.9,0.0403], 41:[1,100.6,0.0403],
    42:[1,101.3,0.0404], 43:[1,101.9,0.0404], 44:[1,102.6,0.0405], 45:[1,103.2,0.0405],
    46:[1,103.9,0.0406], 47:[1,104.5,0.0406], 48:[1,105.2,0.0407], 49:[1,105.8,0.0407],
    50:[1,106.4,0.0408], 51:[1,107.1,0.0408], 52:[1,107.7,0.0409], 53:[1,108.3,0.0409],
    54:[1,108.9,0.0410], 55:[1,109.5,0.0410], 56:[1,110.1,0.0411], 57:[1,110.7,0.0411],
    58:[1,111.3,0.0412], 59:[1,111.9,0.0412], 60:[1,112.5,0.0413]
  };
  const WHO_GIRLS = {
    6:[1,65.7,0.0385], 7:[1,67.3,0.0387], 8:[1,68.7,0.0388], 9:[1,70.1,0.0389],
    10:[1,71.5,0.0391], 11:[1,72.8,0.0392], 12:[1,74.0,0.0393], 13:[1,75.2,0.0394],
    14:[1,76.4,0.0395], 15:[1,77.5,0.0396], 16:[1,78.6,0.0398], 17:[1,79.7,0.0399],
    18:[1,80.7,0.0400], 19:[1,81.7,0.0401], 20:[1,82.7,0.0402], 21:[1,83.7,0.0403],
    22:[1,84.6,0.0404], 23:[1,85.5,0.0405], 24:[1,86.4,0.0406], 25:[1,87.3,0.0407],
    26:[1,88.1,0.0408], 27:[1,88.9,0.0409], 28:[1,89.7,0.0410], 29:[1,90.5,0.0411],
    30:[1,91.3,0.0412], 31:[1,92.1,0.0412], 32:[1,92.9,0.0413], 33:[1,93.6,0.0414],
    34:[1,94.4,0.0415], 35:[1,95.1,0.0415], 36:[1,95.9,0.0416], 37:[1,96.6,0.0417],
    38:[1,97.3,0.0417], 39:[1,98.0,0.0418], 40:[1,98.7,0.0419], 41:[1,99.4,0.0419],
    42:[1,100.1,0.0420], 43:[1,100.8,0.0421], 44:[1,101.5,0.0421], 45:[1,102.1,0.0422],
    46:[1,102.8,0.0422], 47:[1,103.4,0.0423], 48:[1,104.1,0.0424], 49:[1,104.7,0.0424],
    50:[1,105.3,0.0425], 51:[1,106.0,0.0425], 52:[1,106.6,0.0426], 53:[1,107.2,0.0427],
    54:[1,107.8,0.0427], 55:[1,108.4,0.0428], 56:[1,109.0,0.0428], 57:[1,109.6,0.0429],
    58:[1,110.2,0.0429], 59:[1,110.8,0.0430], 60:[1,111.4,0.0430]
  };

  function calcZScore(height, month, gender) {
    const ref = gender === 'L' ? WHO_BOYS : WHO_GIRLS;
    const [L, M, S] = ref[month];
    if (L !== 0) {
      return (Math.pow(height / M, L) - 1) / (L * S);
    } else {
      return Math.log(height / M) / S;
    }
  }

  function getZStatus(z) {
    if (z < -3) return 'SANGAT PENDEK';
    if (z < -2) return 'PENDEK';
    if (z <= 2)  return 'NORMAL';
    return 'TINGGI';
  }

  function validateAndProceed() {
    const nama    = document.getElementById('zsNama').value.trim();
    const kelamin = document.querySelector('input[name="zsKelamin"]:checked')?.value;
    const umur    = parseInt(document.getElementById('zsUmur').value);
    const tinggi  = parseFloat(document.getElementById('zsTinggi').value);
    const errEl   = document.getElementById('zsErrorMsg');

    errEl.style.display = 'none';

    // Semua field wajib diisi
    if (!nama) {
      errEl.textContent = '⚠ Nama balita wajib diisi.';
      errEl.style.display = 'block';
      document.getElementById('zsNama').focus();
      return;
    }
    if (isNaN(umur)) {
      errEl.textContent = '⚠ Umur balita wajib diisi.';
      errEl.style.display = 'block';
      document.getElementById('zsUmur').focus();
      return;
    }
    if (umur < 6 || umur > 60) {
      errEl.textContent = '⚠ Umur harus antara 6 – 60 bulan.';
      errEl.style.display = 'block';
      document.getElementById('zsUmur').focus();
      return;
    }
    if (isNaN(tinggi)) {
      errEl.textContent = '⚠ Tinggi badan wajib diisi.';
      errEl.style.display = 'block';
      document.getElementById('zsTinggi').focus();
      return;
    }
    if (tinggi < 30 || tinggi > 130) {
      errEl.textContent = '⚠ Tinggi badan tidak valid (30 – 130 cm).';
      errEl.style.display = 'block';
      document.getElementById('zsTinggi').focus();
      return;
    }

    // Hitung Z-Score
    const z      = calcZScore(tinggi, umur, kelamin);
    const status = getZStatus(z);

    // Isi hidden form
    document.getElementById('hNama').value    = nama;
    document.getElementById('hKelamin').value = kelamin;
    document.getElementById('hUmur').value    = umur;
    document.getElementById('hTinggi').value  = tinggi;
    document.getElementById('hZScore').value  = z.toFixed(2);
    document.getElementById('hZStatus').value = status;

    document.getElementById('zscoreForm').submit();
  }

  // Enter key submits
  document.addEventListener('keydown', function(e) {
    if (e.key === 'Enter') validateAndProceed();
  });
  </script>

  <!-- Vendor JS Files -->
  <script src="./assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>
