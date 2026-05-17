-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 08, 2026 at 05:22 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_anak`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id` int(3) NOT NULL,
  `username` varchar(30) NOT NULL DEFAULT '',
  `password` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_admin`
--

INSERT INTO `tb_admin` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `tb_diagnosis`
--

CREATE TABLE `tb_diagnosis` (
  `id` int(11) NOT NULL,
  `nama_balita` varchar(100) CHARACTER SET utf8 NOT NULL,
  `jenis_kelamin` varchar(15) CHARACTER SET utf8 NOT NULL,
  `umur_bulan` int(5) NOT NULL,
  `tinggi_cm` float NOT NULL,
  `zscore` float NOT NULL,
  `status_zscore` varchar(30) CHARACTER SET utf8 NOT NULL,
  `gejala_dipilih` text CHARACTER SET utf8 NOT NULL,
  `hasil_penyakit` varchar(200) CHARACTER SET utf8 NOT NULL,
  `derajat_kepercayaan` float NOT NULL,
  `solusi` text CHARACTER SET utf8 DEFAULT NULL,
  `tanggal` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_diagnosis`
--

INSERT INTO `tb_diagnosis` (`id`, `nama_balita`, `jenis_kelamin`, `umur_bulan`, `tinggi_cm`, `zscore`, `status_zscore`, `gejala_dipilih`, `hasil_penyakit`, `derajat_kepercayaan`, `solusi`, `tanggal`) VALUES
(5, 'ardi', 'Laki-Laki', 52, 99, -1.98, 'NORMAL', 'G1: Apakah tinggi badan balita normal; G5: Apakah berat badan balita kurang; G9: Apakah status gizi balita buruk; G11: Apakah anak tidak mendapatkan ASI eksklusif selama 6 bulan pertama; G13: Apakah jumlah bintang MPASI <2; G15: Apakah anak mengalami <2x diare dalam 3 bulan terakhir; G16: Apakah anak sering mengalami demam/infeksi; G17: Apakah Status imunisasi anak sudah lengkap; G19: Apakah anak pernah mengalami cacingan; G20: Apakah keluarga menggunakan sumber air bersih; G21: Apakah rumah memiliki jamban sehat; G22: Apakah ada anggota keluarga yang merokok di dalam rumah; G24: Apakah lingkungan rumah kurang bersih; G25: Apakah anak makan dengan frekuensi yang cukup (≥ 3 kali sehari); G27: Apakah anak mengonsumsi makanan bergizi seimbang setiap hari', 'Stunting', 100, '0 Tahun : Melakukan stimulasi dini perkembangan pada bayi, khususnya jika panjang badan lahir dan stunting sudah terdeteksi, Pemberian ASI ekseklusif sampai usia 6 bulan, Pemberian ASI bersama dengan Makanan Pendamping ASI (MPASI) setelah usia 6 bulan, Konsultasi kesehatan anak secara rutin baik di Posyandu, Puskesmas, atau pusat pelayanan kesehatan terdekat. 1 Tahun : Pemberian ASI bersama dengan Makanan Pendamping ASI (MPASI). Berikan asupan protein harian sebanyak 1,2 g/kg berat badan, Memberikan pelayanan dan perawatan kesehatan yang optimal untuk anak dengan konsultasi kesehatan anak secara rutin baik di Posyandu, Puskesmas, atau pusat pelayanan kesehatan terdekat. 2 Tahun, 3 Tahun, 4 Tahun, 5 Tahun, : Pemberian nutrisi yang cukup sesuai dengan usianya, Konsumsi susu pertumbuhan anak, Memberikan variasi makanan yang sehat dan beragam, meliputi serealia atau umbi-umbian, kacang-kacangan, produk olahan susu, telur atau sumber protein lain, dan asupan kaya vitamin A atau lainnya, Memberikan pelayanan dan perawatan kesehatan yang optimal untuk anak dengan konsultasi kesehatan anak secara rutin baik di Posyandu, Puskesmas, atau pusat pelayanan kesehatan terdekat.', '2026-04-27 13:09:14'),
(13, 'Jeni Khoirunnisa', 'Perempuan', 43, 90.13, -2.51, 'PENDEK', 'G2: Apakah tinggi badan balita pendek; G5: Apakah berat badan balita kurang; G8: Apakah status gizi balita kurang; G10: Apakah anak mendapatkan ASI eksklusif selama 6 bulan pertama; G13: Apakah jumlah bintang MPASI <2; G14: Apakah anak mengalami >3x diare dalam 3 bulan terakhir; G16: Apakah anak sering mengalami demam/infeksi; G17: Apakah Status imunisasi anak sudah lengkap; G19: Apakah anak pernah mengalami cacingan; G20: Apakah keluarga menggunakan sumber air bersih; G21: Apakah rumah memiliki jamban sehat; G22: Apakah ada anggota keluarga yang merokok di dalam rumah; G23: Apakah lingkungan rumah bersih dan sehat; G25: Apakah anak makan dengan frekuensi yang cukup (≥ 3 kali sehari)', 'Stunting', 98.68, '0 Tahun : Melakukan stimulasi dini perkembangan pada bayi, khususnya jika panjang badan lahir dan stunting sudah terdeteksi, Pemberian ASI ekseklusif sampai usia 6 bulan, Pemberian ASI bersama dengan Makanan Pendamping ASI (MPASI) setelah usia 6 bulan, Konsultasi kesehatan anak secara rutin baik di Posyandu, Puskesmas, atau pusat pelayanan kesehatan terdekat. 1 Tahun : Pemberian ASI bersama dengan Makanan Pendamping ASI (MPASI). Berikan asupan protein harian sebanyak 1,2 g/kg berat badan, Memberikan pelayanan dan perawatan kesehatan yang optimal untuk anak dengan konsultasi kesehatan anak secara rutin baik di Posyandu, Puskesmas, atau pusat pelayanan kesehatan terdekat. 2 Tahun, 3 Tahun, 4 Tahun, 5 Tahun, : Pemberian nutrisi yang cukup sesuai dengan usianya, Konsumsi susu pertumbuhan anak, Memberikan variasi makanan yang sehat dan beragam, meliputi serealia atau umbi-umbian, kacang-kacangan, produk olahan susu, telur atau sumber protein lain, dan asupan kaya vitamin A atau lainnya, Memberikan pelayanan dan perawatan kesehatan yang optimal untuk anak dengan konsultasi kesehatan anak secara rutin baik di Posyandu, Puskesmas, atau pusat pelayanan kesehatan terdekat.', '2026-04-30 10:17:34'),
(14, 'Nadhifa Almaira', 'Perempuan', 41, 90.8, -2.06, 'PENDEK', 'G2: Apakah tinggi badan balita pendek; G5: Apakah berat badan balita kurang; G8: Apakah status gizi balita kurang; G10: Apakah anak mendapatkan ASI eksklusif selama 6 bulan pertama; G12: Apakah jumlah bintang MPASI >3; G14: Apakah anak mengalami >3x diare dalam 3 bulan terakhir; G16: Apakah anak sering mengalami demam/infeksi; G17: Apakah Status imunisasi anak sudah lengkap; G19: Apakah anak pernah mengalami cacingan; G20: Apakah keluarga menggunakan sumber air bersih; G21: Apakah rumah memiliki jamban sehat; G22: Apakah ada anggota keluarga yang merokok di dalam rumah; G23: Apakah lingkungan rumah bersih dan sehat; G25: Apakah anak makan dengan frekuensi yang cukup (≥ 3 kali sehari); G27: Apakah anak mengonsumsi makanan bergizi seimbang setiap hari', 'Stunting', 82.76, '0 Tahun : Melakukan stimulasi dini perkembangan pada bayi, khususnya jika panjang badan lahir dan stunting sudah terdeteksi, Pemberian ASI ekseklusif sampai usia 6 bulan, Pemberian ASI bersama dengan Makanan Pendamping ASI (MPASI) setelah usia 6 bulan, Konsultasi kesehatan anak secara rutin baik di Posyandu, Puskesmas, atau pusat pelayanan kesehatan terdekat. 1 Tahun : Pemberian ASI bersama dengan Makanan Pendamping ASI (MPASI). Berikan asupan protein harian sebanyak 1,2 g/kg berat badan, Memberikan pelayanan dan perawatan kesehatan yang optimal untuk anak dengan konsultasi kesehatan anak secara rutin baik di Posyandu, Puskesmas, atau pusat pelayanan kesehatan terdekat. 2 Tahun, 3 Tahun, 4 Tahun, 5 Tahun, : Pemberian nutrisi yang cukup sesuai dengan usianya, Konsumsi susu pertumbuhan anak, Memberikan variasi makanan yang sehat dan beragam, meliputi serealia atau umbi-umbian, kacang-kacangan, produk olahan susu, telur atau sumber protein lain, dan asupan kaya vitamin A atau lainnya, Memberikan pelayanan dan perawatan kesehatan yang optimal untuk anak dengan konsultasi kesehatan anak secara rutin baik di Posyandu, Puskesmas, atau pusat pelayanan kesehatan terdekat.', '2026-05-08 19:32:57'),
(15, 'Nadhifa Almaira', 'Perempuan', 41, 90.8, -2.06, 'PENDEK', 'G2: Apakah tinggi badan balita pendek; G5: Apakah berat badan balita kurang; G8: Apakah status gizi balita kurang; G10: Apakah anak mendapatkan ASI eksklusif selama 6 bulan pertama; G12: Apakah jumlah bintang MPASI >3; G14: Apakah anak mengalami >3x diare dalam 3 bulan terakhir; G16: Apakah anak sering mengalami demam/infeksi; G17: Apakah Status imunisasi anak sudah lengkap; G19: Apakah anak pernah mengalami cacingan; G20: Apakah keluarga menggunakan sumber air bersih; G21: Apakah rumah memiliki jamban sehat; G22: Apakah ada anggota keluarga yang merokok di dalam rumah; G23: Apakah lingkungan rumah bersih dan sehat; G25: Apakah anak makan dengan frekuensi yang cukup (≥ 3 kali sehari); G27: Apakah anak mengonsumsi makanan bergizi seimbang setiap hari', 'Stunting', 82.76, '0 Tahun : Melakukan stimulasi dini perkembangan pada bayi, khususnya jika panjang badan lahir dan stunting sudah terdeteksi, Pemberian ASI ekseklusif sampai usia 6 bulan, Pemberian ASI bersama dengan Makanan Pendamping ASI (MPASI) setelah usia 6 bulan, Konsultasi kesehatan anak secara rutin baik di Posyandu, Puskesmas, atau pusat pelayanan kesehatan terdekat. 1 Tahun : Pemberian ASI bersama dengan Makanan Pendamping ASI (MPASI). Berikan asupan protein harian sebanyak 1,2 g/kg berat badan, Memberikan pelayanan dan perawatan kesehatan yang optimal untuk anak dengan konsultasi kesehatan anak secara rutin baik di Posyandu, Puskesmas, atau pusat pelayanan kesehatan terdekat. 2 Tahun, 3 Tahun, 4 Tahun, 5 Tahun, : Pemberian nutrisi yang cukup sesuai dengan usianya, Konsumsi susu pertumbuhan anak, Memberikan variasi makanan yang sehat dan beragam, meliputi serealia atau umbi-umbian, kacang-kacangan, produk olahan susu, telur atau sumber protein lain, dan asupan kaya vitamin A atau lainnya, Memberikan pelayanan dan perawatan kesehatan yang optimal untuk anak dengan konsultasi kesehatan anak secara rutin baik di Posyandu, Puskesmas, atau pusat pelayanan kesehatan terdekat.', '2026-05-08 19:50:40'),
(16, 'Nadhifa Almaira', 'Perempuan', 41, 90.8, -2.06, 'PENDEK', 'G2: Apakah tinggi badan balita pendek; G5: Apakah berat badan balita kurang; G8: Apakah status gizi balita kurang; G10: Apakah anak mendapatkan ASI eksklusif selama 6 bulan pertama; G12: Apakah jumlah bintang MPASI >3; G14: Apakah anak mengalami >3x diare dalam 3 bulan terakhir; G16: Apakah anak sering mengalami demam/infeksi; G17: Apakah Status imunisasi anak sudah lengkap; G19: Apakah anak pernah mengalami cacingan; G20: Apakah keluarga menggunakan sumber air bersih; G21: Apakah rumah memiliki jamban sehat; G22: Apakah ada anggota keluarga yang merokok di dalam rumah; G23: Apakah lingkungan rumah bersih dan sehat; G25: Apakah anak makan dengan frekuensi yang cukup (≥ 3 kali sehari); G27: Apakah anak mengonsumsi makanan bergizi seimbang setiap hari', 'Stunting', 82.76, '0 Tahun : Melakukan stimulasi dini perkembangan pada bayi, khususnya jika panjang badan lahir dan stunting sudah terdeteksi, Pemberian ASI ekseklusif sampai usia 6 bulan, Pemberian ASI bersama dengan Makanan Pendamping ASI (MPASI) setelah usia 6 bulan, Konsultasi kesehatan anak secara rutin baik di Posyandu, Puskesmas, atau pusat pelayanan kesehatan terdekat. 1 Tahun : Pemberian ASI bersama dengan Makanan Pendamping ASI (MPASI). Berikan asupan protein harian sebanyak 1,2 g/kg berat badan, Memberikan pelayanan dan perawatan kesehatan yang optimal untuk anak dengan konsultasi kesehatan anak secara rutin baik di Posyandu, Puskesmas, atau pusat pelayanan kesehatan terdekat. 2 Tahun, 3 Tahun, 4 Tahun, 5 Tahun, : Pemberian nutrisi yang cukup sesuai dengan usianya, Konsumsi susu pertumbuhan anak, Memberikan variasi makanan yang sehat dan beragam, meliputi serealia atau umbi-umbian, kacang-kacangan, produk olahan susu, telur atau sumber protein lain, dan asupan kaya vitamin A atau lainnya, Memberikan pelayanan dan perawatan kesehatan yang optimal untuk anak dengan konsultasi kesehatan anak secara rutin baik di Posyandu, Puskesmas, atau pusat pelayanan kesehatan terdekat.', '2026-05-08 20:08:17');

-- --------------------------------------------------------

--
-- Table structure for table `tb_gejala`
--

CREATE TABLE `tb_gejala` (
  `id` int(11) NOT NULL,
  `kdgejala` varchar(3) DEFAULT NULL,
  `gejala` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_gejala`
--

INSERT INTO `tb_gejala` (`id`, `kdgejala`, `gejala`) VALUES
(1, 'G1', 'Apakah tinggi badan balita normal'),
(2, 'G2', 'Apakah tinggi badan balita pendek'),
(3, 'G3', 'Apakah tinggi badan balita sangat pendek'),
(4, 'G4', 'Apakah berat badan balita normal'),
(5, 'G5', 'Apakah berat badan balita kurang'),
(6, 'G6', 'Apakah berat badan balita buruk'),
(7, 'G7', 'Apakah status gizi balita baik'),
(8, 'G8', 'Apakah status gizi balita kurang'),
(9, 'G9', 'Apakah status gizi balita buruk'),
(10, 'G10', 'Apakah anak mendapatkan ASI eksklusif selama 6 bulan pertama'),
(11, 'G11', 'Apakah anak tidak mendapatkan ASI eksklusif selama 6 bulan pertama'),
(12, 'G12', 'Apakah jumlah bintang MPASI >3'),
(13, 'G13', 'Apakah jumlah bintang MPASI <2'),
(14, 'G14', 'Apakah anak mengalami >3x diare dalam 3 bulan terakhir'),
(15, 'G15', 'Apakah anak mengalami <2x diare dalam 3 bulan terakhir'),
(16, 'G16', 'Apakah anak sering mengalami demam/infeksi'),
(17, 'G17', 'Apakah Status imunisasi anak sudah lengkap'),
(18, 'G18', 'Apakah Status imunisasi anak belum lengkap'),
(19, 'G19', 'Apakah anak pernah mengalami cacingan'),
(20, 'G20', 'Apakah keluarga menggunakan sumber air bersih'),
(21, 'G21', 'Apakah rumah memiliki jamban sehat'),
(22, 'G22', 'Apakah ada anggota keluarga yang merokok di dalam rumah'),
(23, 'G23', 'Apakah lingkungan rumah bersih dan sehat'),
(24, 'G24', 'Apakah lingkungan rumah kurang bersih'),
(25, 'G25', 'Apakah anak makan dengan frekuensi yang cukup (≥ 3 kali sehari)'),
(26, 'G26', 'Apakah anak makan dengan frekuensi < 3 kali sehari'),
(27, 'G27', 'Apakah anak mengonsumsi makanan bergizi seimbang setiap hari');

-- --------------------------------------------------------

--
-- Table structure for table `tb_penyakit`
--

CREATE TABLE `tb_penyakit` (
  `id` int(11) NOT NULL,
  `kdpenyakit` varchar(3) DEFAULT NULL,
  `nama_penyakit` varchar(100) DEFAULT NULL,
  `definisi` text DEFAULT NULL,
  `solusi` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_penyakit`
--

INSERT INTO `tb_penyakit` (`id`, `kdpenyakit`, `nama_penyakit`, `definisi`, `solusi`) VALUES
(1, 'P1', 'Stunting', 'Stunting kondisi gagal tumbuh pada anak, di mana tinggi badan anak jauh di bawah rata-rata usianya dan berada di bawah ambang batas tertentu berdasarkan standar pertumbuhan WHO, yaitu Z-score kurang dari (-3). Kondisi ini akibat kekurangan gizi kronis yang parah dan berkelanjutan, bukan hanya memengaruhi tinggi badan, tetapi juga perkembangan otak, kecerdasan, dan daya tahan tubuh. ', '0 Tahun : Melakukan stimulasi dini perkembangan pada bayi, khususnya jika panjang badan lahir dan stunting sudah terdeteksi, Pemberian ASI ekseklusif sampai usia 6 bulan, Pemberian ASI bersama dengan Makanan Pendamping ASI (MPASI) setelah usia 6 bulan, Konsultasi kesehatan anak secara rutin baik di Posyandu, Puskesmas, atau pusat pelayanan kesehatan terdekat. 1 Tahun : Pemberian ASI bersama dengan Makanan Pendamping ASI (MPASI). Berikan asupan protein harian sebanyak 1,2 g/kg berat badan, Memberikan pelayanan dan perawatan kesehatan yang optimal untuk anak dengan konsultasi kesehatan anak secara rutin baik di Posyandu, Puskesmas, atau pusat pelayanan kesehatan terdekat. 2 Tahun, 3 Tahun, 4 Tahun, 5 Tahun, : Pemberian nutrisi yang cukup sesuai dengan usianya, Konsumsi susu pertumbuhan anak, Memberikan variasi makanan yang sehat dan beragam, meliputi serealia atau umbi-umbian, kacang-kacangan, produk olahan susu, telur atau sumber protein lain, dan asupan kaya vitamin A atau lainnya, Memberikan pelayanan dan perawatan kesehatan yang optimal untuk anak dengan konsultasi kesehatan anak secara rutin baik di Posyandu, Puskesmas, atau pusat pelayanan kesehatan terdekat.'),
(2, 'P2', 'Balita Normal', 'Balita normal adalah anak yang memiliki tinggi badan dan perkembangan sesuai dengan standar pertumbuhan yang ditetapkan oleh WHO. Balita normal berarti tinggi badan balita berada di atas nilai z-score -2 SD dari median standar WHO, tidak seperti balita stunting yang tinggi badannya berada di bawah nilai tersebut. Balita normal juga menunjukkan perkembangan kognitif dan fisik yang sesuai usianya, tidak lemas, dan tidak mudah terserang penyakit kronis.', 'Untuk balita normal, fokus pencegahan stunting adalah, makanan bergizi seimbang, pantauan pertumbuhan teratur, sanitasi yang baik, imunisasi lengkap, pola asuh dan stimulasi optimal. Langkah ini membantu anak tetap tumbuh optimal dan mencegah stunting sejak dini.');

-- --------------------------------------------------------

--
-- Table structure for table `tb_rules`
--

CREATE TABLE `tb_rules` (
  `id_rules` int(11) NOT NULL,
  `id_gejala` int(11) DEFAULT NULL,
  `id_penyakit` int(11) DEFAULT NULL,
  `belief` float DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_rules`
--

INSERT INTO `tb_rules` (`id_rules`, `id_gejala`, `id_penyakit`, `belief`) VALUES
(197, 27, 2, 0.6),
(196, 25, 2, 0.6),
(171, 2, 1, 0.8),
(176, 9, 1, 1),
(182, 18, 1, 0.6),
(185, 24, 1, 0.6),
(177, 11, 1, 0.6),
(186, 26, 1, 0.6),
(178, 13, 1, 0.6),
(198, 15, 2, 0.4),
(179, 14, 1, 0.6),
(183, 19, 1, 0.6),
(189, 7, 2, 0.8),
(195, 23, 2, 0.6),
(194, 21, 2, 0.6),
(193, 20, 2, 0.6),
(192, 17, 2, 0.6),
(191, 12, 2, 0.6),
(190, 10, 2, 0.4),
(188, 4, 2, 0.8),
(187, 1, 2, 0.8),
(175, 8, 1, 0.8),
(174, 6, 1, 1),
(173, 5, 1, 0.8),
(172, 3, 1, 1),
(184, 22, 1, 0.6),
(181, 16, 1, 0.6);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_diagnosis`
--
ALTER TABLE `tb_diagnosis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tinggi_cm` (`tinggi_cm`,`zscore`);

--
-- Indexes for table `tb_gejala`
--
ALTER TABLE `tb_gejala`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kdgejala` (`kdgejala`);

--
-- Indexes for table `tb_penyakit`
--
ALTER TABLE `tb_penyakit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kdpenyakit` (`kdpenyakit`);

--
-- Indexes for table `tb_rules`
--
ALTER TABLE `tb_rules`
  ADD PRIMARY KEY (`id_rules`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_diagnosis`
--
ALTER TABLE `tb_diagnosis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tb_gejala`
--
ALTER TABLE `tb_gejala`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `tb_penyakit`
--
ALTER TABLE `tb_penyakit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `tb_rules`
--
ALTER TABLE `tb_rules`
  MODIFY `id_rules` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=199;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
