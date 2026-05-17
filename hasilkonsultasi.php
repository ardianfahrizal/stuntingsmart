<?php
include './admin/koneksi.php';
// mengaktifkan session
session_start();
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Hasil Diagnosa Stunting</title>
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
      --accent: #2d6a4f;
      --accent2: #52b788;
      --success-light: #d8f3dc;
      --border: #e5e0d8;
      --dark: #1e2228;
      --muted: #6b7280;
      --radius: 16px;
      --shadow: 0 4px 24px rgba(30,34,40,0.10);
    }

    body { background: #f5f2ee; }

    .result-page-title {
      font-family: 'DM Serif Display', serif;
      font-size: 2rem; text-align: center;
      margin: 2.5rem 0 1.5rem;
      color: var(--dark);
    }

    /* ── Z-Score Result Panel ── */
    .zscore-result-panel {
      background: #fff;
      border: 1.5px solid var(--border);
      border-radius: var(--radius);
      box-shadow: var(--shadow);
      overflow: hidden;
      margin-bottom: 1.5rem;
    }
    .zscore-result-panel .panel-header {
      background: linear-gradient(135deg, var(--accent) 0%, #40916c 100%);
      padding: 1rem 1.5rem;
      display: flex; align-items: center; gap: 10px;
    }
    .zscore-result-panel .panel-header h5 {
      color: #fff; margin: 0;
      font-family: 'DM Serif Display', serif; font-weight: 400; font-size: 1.1rem;
    }
    .zscore-result-panel .panel-body { padding: 1.4rem 1.6rem; }

    .result-name-label {
      font-size: 0.78rem; font-weight: 600; letter-spacing: 0.05em;
      text-transform: uppercase; color: var(--muted); margin-bottom: 0.8rem;
    }
    .result-name-label span { color: var(--dark); font-size: 1rem; text-transform: none; letter-spacing: 0; font-weight: 600; }

    .zscore-display {
      display: flex; align-items: center; gap: 1.2rem;
      background: #f5f2ee; border-radius: 12px;
      padding: 1rem 1.3rem; margin-bottom: 1rem;
      border: 1px solid var(--border);
    }
    .zscore-label { font-size: 0.78rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; color: var(--muted); }
    .zscore-value { font-family: 'DM Serif Display', serif; font-size: 2.4rem; line-height: 1; color: var(--dark); }

    .status-badge {
      display: inline-flex; align-items: center; gap: 6px;
      padding: 8px 16px; border-radius: 10px;
      font-weight: 700; font-size: 0.95rem; letter-spacing: 0.02em;
    }
    .status-sangat-pendek { background: #fee2e2; color: #991b1b; }
    .status-pendek        { background: #fef9c3; color: #854d0e; }
    .status-normal        { background: var(--success-light); color: var(--accent); }
    .status-tinggi        { background: #dbeafe; color: #1e40af; }

    .scale-bar { margin-bottom: 1rem; }
    .scale-bar-label { font-size: 0.75rem; color: var(--muted); margin-bottom: 5px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.04em; }
    .scale-track {
      height: 10px; border-radius: 99px;
      background: linear-gradient(to right, #ef4444 0%, #f97316 20%, #22c55e 40%, #22c55e 75%, #3b82f6 100%);
      position: relative; overflow: visible;
    }
    .scale-needle {
      position: absolute; top: 50%; transform: translateY(-50%);
      width: 18px; height: 18px; border-radius: 50%;
      background: var(--dark); border: 2.5px solid #fff;
      box-shadow: 0 2px 8px rgba(0,0,0,0.25);
    }
    .scale-labels { display: flex; justify-content: space-between; font-size: 0.7rem; color: var(--muted); margin-top: 5px; }

    .interpretation {
      padding: 12px 14px; border-radius: 10px;
      font-size: 0.88rem; line-height: 1.6;
      background: #f9f7f4; color: var(--muted);
      border-left: 3px solid var(--accent2);
    }

    /* ── Dempster-Shafer Result Panel ── */
    .ds-result-panel {
      background: #fff;
      border: 1.5px solid var(--border);
      border-radius: var(--radius);
      box-shadow: var(--shadow);
      overflow: hidden;
      margin-bottom: 1.5rem;
    }
    .ds-result-panel .panel-header {
      background: linear-gradient(135deg, #1e3a5f 0%, #2c5282 100%);
      padding: 1rem 1.5rem;
      display: flex; align-items: center; gap: 10px;
    }
    .ds-result-panel .panel-header h5 {
      color: #fff; margin: 0;
      font-family: 'DM Serif Display', serif; font-weight: 400; font-size: 1.1rem;
    }
    .ds-result-panel .panel-body { padding: 1.4rem 1.6rem; }

    .gejala-list {
      background: #f9f7f4; border-radius: 10px;
      padding: 1rem 1.2rem; margin-bottom: 1.2rem;
      border: 1px solid var(--border);
      font-size: 0.88rem; color: var(--muted);
    }
    .gejala-list b { color: var(--dark); }

    .diagnosa-result-box {
      background: #eff8ff;
      border: 2px solid #93c5fd;
      border-radius: 12px;
      padding: 1.2rem 1.5rem;
      text-align: center;
      margin-bottom: 1rem;
    }
    .diagnosa-result-box .diagnosa-label { font-size: 0.78rem; color: var(--muted); font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; }
    .diagnosa-result-box .diagnosa-name { font-family: 'DM Serif Display', serif; font-size: 1.4rem; color: #1e3a5f; margin: 4px 0; }
    .diagnosa-result-box .diagnosa-confidence {
      font-size: 1.8rem; font-weight: 700; color: #2563eb;
    }

    .solusi-box {
      background: var(--success-light);
      border-left: 4px solid var(--accent);
      border-radius: 10px;
      padding: 1rem 1.3rem;
      font-size: 0.9rem; line-height: 1.7;
      color: #1a3a2a;
    }
    .solusi-box .solusi-title { font-weight: 700; font-size: 0.82rem; text-transform: uppercase; letter-spacing: 0.05em; color: var(--accent); margin-bottom: 6px; }

    /* ── Combined Summary Banner ── */
    .combined-summary {
      background: linear-gradient(135deg, #1e2228 0%, #2d3748 100%);
      border-radius: var(--radius);
      padding: 1.4rem 2rem;
      margin-bottom: 1.5rem;
      box-shadow: var(--shadow);
      color: #fff;
    }
    .combined-summary h6 { font-size: 0.78rem; text-transform: uppercase; letter-spacing: 0.08em; color: rgba(255,255,255,0.6); margin-bottom: 0.5rem; }
    .combined-summary .summary-row { display: flex; gap: 1.5rem; flex-wrap: wrap; }
    .combined-summary .summary-item { flex: 1; min-width: 140px; }
    .combined-summary .summary-value { font-family: 'DM Serif Display', serif; font-size: 1.15rem; color: #fff; }
    .combined-summary .summary-sub { font-size: 0.78rem; color: rgba(255,255,255,0.6); }

    .section-divider-label {
      text-align: center; position: relative;
      font-size: 0.75rem; font-weight: 600; text-transform: uppercase;
      letter-spacing: 0.1em; color: var(--muted);
      margin: 1.5rem 0;
    }
    .section-divider-label::before, .section-divider-label::after {
      content: '';
      position: absolute; top: 50%;
      width: 38%; height: 1px; background: var(--border);
    }
    .section-divider-label::before { left: 0; }
    .section-divider-label::after { right: 0; }
  </style>
</head>

<body>
  <div class="container pb-5" style="max-width:800px;">
    <h1 class="result-page-title">Hasil Diagnosa Stunting</h1>

    <?php
    $koneksi = mysqli_connect("localhost", "root", "", "db_anak");
    if (mysqli_connect_errno()) {
      echo "<div class='alert alert-danger'>Koneksi database gagal : " . mysqli_connect_error() . "</div>";
    }

    // ─── Ambil data Z-Score dari POST ───────────────────────────────────────
    $zs_nama    = isset($_POST['zs_nama'])    ? htmlspecialchars(trim($_POST['zs_nama'])) : '';
    $zs_kelamin = isset($_POST['zs_kelamin']) ? htmlspecialchars($_POST['zs_kelamin'])   : '';
    $zs_umur    = isset($_POST['zs_umur'])    ? intval($_POST['zs_umur'])                : 0;
    $zs_tinggi  = isset($_POST['zs_tinggi'])  ? floatval($_POST['zs_tinggi'])            : 0;
    $zs_score   = isset($_POST['zs_score'])   ? floatval($_POST['zs_score'])             : null;
    $zs_status  = isset($_POST['zs_status'])  ? htmlspecialchars($_POST['zs_status'])    : '';

    $has_zscore = ($zs_nama !== '' && $zs_umur > 0 && $zs_tinggi > 0 && $zs_score !== null);

    // ─── Fungsi interpretasi Z-Score ────────────────────────────────────────
    function getZInterpretation($status, $nama) {
      $n = $nama ?: 'Balita';
      switch($status) {
        case 'SANGAT PENDEK':
          return "<strong>$n</strong> termasuk kategori <strong>Sangat Pendek (Severely Stunted)</strong>. Kondisi ini memerlukan perhatian segera. Segera konsultasikan dengan dokter anak atau tenaga kesehatan untuk evaluasi lebih lanjut dan intervensi gizi.";
        case 'PENDEK':
          return "<strong>$n</strong> termasuk kategori <strong>Pendek (Stunted)</strong>. Perlu peningkatan asupan gizi dan pemantauan rutin. Konsultasikan dengan tenaga kesehatan untuk program intervensi yang tepat.";
        case 'NORMAL':
          return "<strong>$n</strong> memiliki tinggi badan dalam rentang <strong>Normal</strong>. Pertumbuhan berlangsung baik sesuai standar WHO. Pertahankan pola makan bergizi seimbang dan pemantauan rutin.";
        case 'TINGGI':
          return "<strong>$n</strong> memiliki tinggi badan di atas rata-rata (<strong>Tinggi</strong>). Pertumbuhan sangat baik. Tetap pantau perkembangan secara rutin.";
        default:
          return "Status pertumbuhan tidak dapat ditentukan.";
      }
    }

    function getZStatusClass($status) {
      switch($status) {
        case 'SANGAT PENDEK': return 'status-sangat-pendek';
        case 'PENDEK':        return 'status-pendek';
        case 'NORMAL':        return 'status-normal';
        case 'TINGGI':        return 'status-tinggi';
        default:              return 'status-normal';
      }
    }

    function getZStatusIcon($status) {
      switch($status) {
        case 'SANGAT PENDEK': return '⚠️';
        case 'PENDEK':        return '📉';
        case 'NORMAL':        return '✅';
        case 'TINGGI':        return '📈';
        default:              return '—';
      }
    }
    ?>

    <?php if (isset($_POST['bukti'])): ?>
    <?php

    // ─────────────────────────────────────────────────────────────────────────
    // BAGIAN DEMPSTER-SHAFER
    // ─────────────────────────────────────────────────────────────────────────
    $gejaladipilih = $_POST['bukti'];

    $sql = "SELECT GROUP_CONCAT(b.kdpenyakit), a.belief
            FROM tb_rules a
            JOIN tb_penyakit b ON a.id_penyakit=b.id
            WHERE a.id_gejala IN(" . implode(',', $gejaladipilih) . ")
            GROUP BY a.id_gejala";
    $result = $koneksi->query($sql);
    $bukti = array();
    while ($row = $result->fetch_row()) {
      $bukti[] = $row;
    }

    $sql = "SELECT GROUP_CONCAT(kdpenyakit) FROM tb_penyakit";
    $result = $koneksi->query($sql);
    $row = $result->fetch_row();
    $fod = $row[0];

    // Menentukan nilai densitas (Dempster-Shafer)
    $densitas_baru = array();
    while (!empty($bukti)) {
      $densitas1[0] = array_shift($bukti);
      $densitas1[1] = array($fod, 1 - $densitas1[0][1]);
      $densitas2 = array();
      if (empty($densitas_baru)) {
        $densitas2[0] = array_shift($bukti);
      } else {
        foreach ($densitas_baru as $k => $r) {
          if ($k != "&theta;") {
            $densitas2[] = array($k, $r);
          }
        }
      }
      $theta = 1;
      foreach ($densitas2 as $d) $theta -= $d[1];
      $densitas2[] = array($fod, $theta);
      $m = count($densitas2);
      $densitas_baru = array();
      for ($y = 0; $y < $m; $y++) {
        for ($x = 0; $x < 2; $x++) {
          if (!($y == $m - 1 && $x == 1)) {
            $v = explode(',', $densitas1[$x][0]);
            $w = explode(',', $densitas2[$y][0]);
            sort($v); sort($w);
            $vw = array_intersect($v, $w);
            if (empty($vw)) {
              $k = "&theta;";
            } else {
              $k = implode(',', $vw);
            }
            if (!isset($densitas_baru[$k])) {
              $densitas_baru[$k] = $densitas1[$x][1] * $densitas2[$y][1];
            } else {
              $densitas_baru[$k] += $densitas1[$x][1] * $densitas2[$y][1];
            }
          }
        }
      }
      foreach ($densitas_baru as $k => $d) {
        if ($k != "&theta;") {
          $densitas_baru[$k] = $d / (1 - (isset($densitas_baru["&theta;"]) ? $densitas_baru["&theta;"] : 0));
        }
      }
    }

    unset($densitas_baru["&theta;"]);
    arsort($densitas_baru);

    $arrPenyakit = array();
    $qry = mysqli_query($koneksi, "SELECT * FROM tb_penyakit");
    while ($data = mysqli_fetch_array($qry)) {
      $arrPenyakit["$data[kdpenyakit]"] = $data['nama_penyakit'];
    }

    $codes = array_keys($densitas_baru);
    $top_codes = explode(',', $codes[0]);
    $kode_penyakit_utama = $top_codes[0];

    $strS = mysqli_query($koneksi, "SELECT * FROM tb_penyakit WHERE kdpenyakit='$kode_penyakit_utama'");
    $dataS = mysqli_fetch_array($strS);

    $final_codes = explode(',', $codes[0]);
    $sql = "SELECT GROUP_CONCAT(nama_penyakit)
            FROM tb_penyakit
            WHERE kdpenyakit IN('" . implode("','", $final_codes) . "')";
    $result = $koneksi->query($sql);
    $rowPenyakit = $result->fetch_row();
    $nama_penyakit_hasil = $rowPenyakit[0];
    $derajat_kepercayaan = round($densitas_baru[$codes[0]] * 100, 2);

    // ─── Simpan ke database tb_diagnosis ───────────────────────────────────
    $gejala_str = '';
    foreach ($gejaladipilih as $gjl) {
      $q = mysqli_query($koneksi, "SELECT gejala FROM tb_gejala WHERE id='".intval($gjl)."'");
      $d = mysqli_fetch_assoc($q);
      if ($d) $gejala_str .= 'G'.$gjl.': '.$d['gejala'].'; ';
    }
    $save_nama     = mysqli_real_escape_string($koneksi, $zs_nama);
    $save_kelamin  = mysqli_real_escape_string($koneksi, $zs_kelamin === 'L' ? 'Laki-Laki' : 'Perempuan');
    $save_gejala   = mysqli_real_escape_string($koneksi, rtrim($gejala_str, '; '));
    $save_penyakit = mysqli_real_escape_string($koneksi, $nama_penyakit_hasil);
    $save_solusi   = isset($dataS['solusi']) ? mysqli_real_escape_string($koneksi, $dataS['solusi']) : '';
    $save_status   = mysqli_real_escape_string($koneksi, $zs_status);
    // Cegah duplikasi (dalam 1 menit)
    $chk = mysqli_query($koneksi, "SELECT id FROM tb_diagnosis WHERE nama_balita='$save_nama' AND tanggal >= NOW() - INTERVAL 1 MINUTE LIMIT 1");
    $diagnosis_id = 0;
    if (mysqli_num_rows($chk) == 0 && $zs_nama !== '') {
      $ins = "INSERT INTO tb_diagnosis (nama_balita, jenis_kelamin, umur_bulan, tinggi_cm, zscore, status_zscore, gejala_dipilih, hasil_penyakit, derajat_kepercayaan, solusi)
              VALUES ('$save_nama','$save_kelamin',$zs_umur,$zs_tinggi,$zs_score,'$save_status','$save_gejala','$save_penyakit',$derajat_kepercayaan,'$save_solusi')";
      mysqli_query($koneksi, $ins);
      $diagnosis_id = mysqli_insert_id($koneksi);
    } else {
      $row_chk = mysqli_fetch_assoc($chk);
      $diagnosis_id = $row_chk ? $row_chk['id'] : 0;
    }

    ?>

    <!-- ═══════════════════════════════════════════════════════════════════ -->
    <!-- COMBINED SUMMARY BANNER                                             -->
    <!-- ═══════════════════════════════════════════════════════════════════ -->
    <?php if ($has_zscore): ?>
    <div class="combined-summary">
      <h6>Ringkasan Hasil Diagnosa</h6>
      <div class="summary-row">
        <div class="summary-item">
          <div class="summary-sub">Nama Balita</div>
          <div class="summary-value"><?= $zs_nama ?></div>
          <div class="summary-sub"><?= $zs_kelamin === 'L' ? 'Laki-Laki' : 'Perempuan' ?>, <?= $zs_umur ?> bln</div>
        </div>
        <div class="summary-item">
          <div class="summary-sub">Z-Score (TB/U)</div>
          <div class="summary-value"><?= number_format($zs_score, 2) ?></div>
          <div class="summary-sub"><?= $zs_status ?></div>
        </div>
        <div class="summary-item">
          <div class="summary-sub">Hasil Dempster-Shafer</div>
          <div class="summary-value"><?= $nama_penyakit_hasil ?></div>
          <div class="summary-sub">Kepercayaan: <?= $derajat_kepercayaan ?>%</div>
        </div>
      </div>
    </div>
    <?php endif; ?>

    <!-- ═══════════════════════════════════════════════════════════════════ -->
    <!-- PANEL 1: HASIL Z-SCORE WHO                                          -->
    <!-- ═══════════════════════════════════════════════════════════════════ -->
    <!-- <?php if ($has_zscore): ?>
    <div class="zscore-result-panel">
      <div class="panel-header">
        <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="color:#52b788">
          <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
        </svg>
        <h5>Hasil Perhitungan Z-Score (Standar WHO)</h5>
      </div>
      <div class="panel-body">
        <div class="result-name-label">
          Nama: <span><?= $zs_nama ?> (<?= $zs_kelamin === 'L' ? 'Laki-Laki' : 'Perempuan' ?>, <?= $zs_umur ?> bulan, <?= $zs_tinggi ?> cm)</span>
        </div>

        <div class="zscore-display">
          <div>
            <div class="zscore-label">Z-Score (TB/U)</div>
            <div class="zscore-value"><?= number_format($zs_score, 2) ?></div>
          </div>
          <div style="flex:1; text-align:right;">
            <div class="zscore-label" style="margin-bottom:6px">Status Pertumbuhan</div>
            <div class="status-badge <?= getZStatusClass($zs_status) ?>">
              <?= getZStatusIcon($zs_status) ?> <?= $zs_status ?>
            </div>
          </div>
        </div>

        <div class="scale-bar">
          <div class="scale-bar-label">Posisi Z-Score</div>
          <div class="scale-track">
            <?php
            $pct = min(100, max(0, (($zs_score + 4) / 8) * 100));
            ?>
            <div class="scale-needle" style="left: calc(<?= $pct ?>% - 9px);"></div>
          </div>
          <div class="scale-labels">
            <span>≤ -3 (Sangat Pendek)</span>
            <span>-2</span>
            <span>0</span>
            <span>2</span>
            <span>≥ 3 (Tinggi)</span>
          </div>
        </div>

        <div class="interpretation">
          <?= getZInterpretation($zs_status, $zs_nama) ?>
        </div>
      </div>
    </div>
    <?php endif; ?> -->

    <!-- ═══════════════════════════════════════════════════════════════════ -->
    <!-- PANEL 2: HASIL DEMPSTER-SHAFER                                      -->
    <!-- ═══════════════════════════════════════════════════════════════════ -->
    <div class="ds-result-panel">
      <div class="panel-header">
        <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="color:#93c5fd">
          <path stroke-linecap="round" stroke-linejoin="round" d="M9 3H5a2 2 0 00-2 2v4m6-6h10a2 2 0 012 2v4M9 3v18m0 0h10a2 2 0 002-2V9M9 21H5a2 2 0 01-2-2V9m0 0h18"/>
        </svg>
        <h5>Hasil Diagnosa</h5>
      </div>
      <div class="panel-body">

        <!-- Gejala yang dipilih -->
        <div class="gejala-list">
          <b>Gejala Yang Dipilih:</b><br>
          <?php foreach ($gejaladipilih as $gjlplh): ?>
            <?php
            $qry = mysqli_query($koneksi, "SELECT * FROM tb_gejala WHERE id='$gjlplh'");
            while ($data = mysqli_fetch_array($qry)):
            ?>
              <span class="badge bg-secondary me-1 mb-1">G<?= $gjlplh ?></span> <?= $data['gejala'] ?><br>
            <?php endwhile; ?>
          <?php endforeach; ?>
        </div>

        <!-- Hasil diagnosa -->
        <div class="diagnosa-result-box">
          <div class="diagnosa-label">Terdeteksi</div>
          <div class="diagnosa-name"><?= $nama_penyakit_hasil ?></div>
          <div class="diagnosa-confidence"><?= $derajat_kepercayaan ?>%</div>
          <div style="font-size:0.78rem; color:#6b7280; margin-top:4px;">Derajat Kepercayaan</div>
        </div>

        <!-- Saran / Solusi -->
        <?php if (!empty($dataS['solusi'])): ?>
        <div class="solusi-box">
          <div class="solusi-title">Saran & Solusi</div>
          <?= nl2br($dataS['solusi']) ?>
        </div>
        <?php endif; ?>
      </div>
    </div>

    <?php else: ?>
    <div class="alert alert-warning text-center">Tidak ada data gejala yang dikirim.</div>
    <?php endif; ?>

    <div class="d-flex justify-content-center gap-3 mt-3 flex-wrap">
      <a href="../sistemstunting2/zscore.php" class="btn btn-outline-danger">
        <i class="bi bi-arrow-left-circle"></i> Kembali ke Konsultasi
      </a>
      <?php if ($diagnosis_id > 0): ?>
      <a href="./cetak_diagnosis.php?id=<?= $diagnosis_id ?>" target="_blank" class="btn btn-success">
        <i class="bi bi-file-earmark-pdf"></i> Download PDF Hasil Diagnosa
      </a>
      <?php endif; ?>
    </div>
  </div>

  <script src="./assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>
