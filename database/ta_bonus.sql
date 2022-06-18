-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 21, 2022 at 05:24 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ta_bonus`
--

-- --------------------------------------------------------

--
-- Table structure for table `absensi`
--

CREATE TABLE `absensi` (
  `id_absensi` int(11) NOT NULL,
  `nik` varchar(10) NOT NULL,
  `hari_kerja` decimal(4,2) NOT NULL,
  `total_masuk` decimal(4,2) NOT NULL,
  `total_poin` decimal(6,3) NOT NULL,
  `keterangan` varchar(35) NOT NULL,
  `bobot_poin_absensi` decimal(6,3) NOT NULL,
  `tgl_penilaian` date NOT NULL,
  `id_bobot_absensi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bobot`
--

CREATE TABLE `bobot` (
  `id_bobot` int(11) NOT NULL,
  `kriteria` varchar(35) NOT NULL,
  `nilai_bobot` decimal(4,2) NOT NULL,
  `perbaikan_bobot` decimal(3,2) NOT NULL,
  `deleted` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bobot`
--

INSERT INTO `bobot` (`id_bobot`, `kriteria`, `nilai_bobot`, `perbaikan_bobot`, `deleted`) VALUES
(43, 'ABSENSI', '25.00', '0.25', '0'),
(44, 'PERILAKU', '15.00', '0.15', '0'),
(45, 'KEDISIPLINAN', '25.00', '0.25', '0'),
(46, 'WAWASAN', '5.00', '0.05', '0'),
(47, 'KERJASAMA TIM', '15.00', '0.15', '0'),
(48, 'KINERJA', '15.00', '0.15', '0');

-- --------------------------------------------------------

--
-- Table structure for table `bonus`
--

CREATE TABLE `bonus` (
  `kode_bonus` varchar(12) NOT NULL,
  `nik` varchar(10) NOT NULL,
  `nama_karyawan` varchar(35) NOT NULL,
  `jml_bonus` int(8) NOT NULL,
  `tgl_penerimaan` date NOT NULL,
  `dibayarkan` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `nik` varchar(10) NOT NULL,
  `nama_lengkap` varchar(35) NOT NULL,
  `gender` enum('L','P') NOT NULL,
  `tempat_lahir` varchar(35) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `date_created` date NOT NULL,
  `deleted` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`nik`, `nama_lengkap`, `gender`, `tempat_lahir`, `tgl_lahir`, `email`, `phone`, `date_created`, `deleted`) VALUES
('0801202201', 'Budi', 'L', 'Jakarta', '2022-01-08', 'budi@gmail.com', '123', '2022-01-08', '0'),
('0801202202', 'Putri', 'P', 'Jakarta', '2022-01-01', 'putri@gmail.com', '144', '2022-01-08', '0'),
('0801202203', 'Omesh', 'L', 'Jakarta', '2021-12-30', 'omesh@gmail.com', '123', '2022-01-08', '0'),
('0801202204', 'Rumi', 'P', 'Jakarta', '2021-12-29', 'rumi@gmail.com', '123', '2022-01-08', '0'),
('0801202205', 'Jojon', 'L', 'Jakarta', '2022-01-05', 'jojon@gmail.com', '123', '2022-01-08', '0'),
('2911202101', 'Tiav', 'P', 'Jakarta', '2021-11-29', 'tiav@gmail.com', '0857711223344', '2021-11-29', '0'),
('2911202102', 'Rusdi', 'L', 'Jakarta', '2021-11-29', 'rusdi@gmail.com', '0857711221566', '2021-11-29', '0');

-- --------------------------------------------------------

--
-- Table structure for table `kedisiplinan`
--

CREATE TABLE `kedisiplinan` (
  `id_disiplin` int(11) NOT NULL,
  `nik` varchar(10) NOT NULL,
  `hari_kerja` decimal(4,2) NOT NULL,
  `total_masuk` decimal(4,2) NOT NULL,
  `total_potongan` decimal(4,2) NOT NULL,
  `total_poin_kedisiplinan` decimal(5,2) NOT NULL,
  `keterangan_disiplin` varchar(35) NOT NULL,
  `bobot_poin_kedisiplinan` decimal(6,3) NOT NULL,
  `tgl_penilaian_kedisiplinan` date NOT NULL,
  `id_bobot_kedisiplinan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kerjasama_tim`
--

CREATE TABLE `kerjasama_tim` (
  `id_kerjasama` int(11) NOT NULL,
  `nik` varchar(10) NOT NULL,
  `potongan` int(11) NOT NULL,
  `total_poin_kerjasama` decimal(5,2) NOT NULL,
  `keterangan_kerjasama` varchar(35) NOT NULL,
  `bobot_poin_kerjasama` decimal(6,3) NOT NULL,
  `tgl_penilaian_kerjasama` date NOT NULL,
  `id_bobot_kerjasama` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kinerja`
--

CREATE TABLE `kinerja` (
  `id_kinerja` int(11) NOT NULL,
  `nik` varchar(10) NOT NULL,
  `komunikasi` decimal(5,2) NOT NULL,
  `target` decimal(5,2) NOT NULL,
  `teknis` decimal(5,2) NOT NULL,
  `disiplin` decimal(5,2) NOT NULL,
  `kecepatan` decimal(5,2) NOT NULL,
  `adaptasi` decimal(5,2) NOT NULL,
  `waktu` decimal(5,2) NOT NULL,
  `total_poin_kinerja` decimal(6,3) NOT NULL,
  `keterangan_kinerja` varchar(35) NOT NULL,
  `bobot_poin_kinerja` decimal(6,3) NOT NULL,
  `tgl_penilaian_kinerja` date NOT NULL,
  `id_bobot_kinerja` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `nilai_kriteria`
--

CREATE TABLE `nilai_kriteria` (
  `id_nilai` int(11) NOT NULL,
  `min_value` decimal(5,3) NOT NULL,
  `max_value` decimal(6,3) NOT NULL,
  `nilai_kriteria` varchar(35) NOT NULL,
  `bobot` decimal(5,3) NOT NULL,
  `id_bobot` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nilai_kriteria`
--

INSERT INTO `nilai_kriteria` (`id_nilai`, `min_value`, `max_value`, `nilai_kriteria`, `bobot`, `id_bobot`) VALUES
(27, '0.000', '79.990', 'Buruk', '0.500', 43),
(28, '80.000', '94.990', 'Cukup', '0.750', 43),
(29, '95.000', '100.000', 'Baik', '1.000', 43),
(30, '0.000', '69.000', 'Buruk', '0.250', 44),
(31, '70.000', '79.000', 'Kurang', '0.500', 44),
(32, '80.000', '89.000', 'Cukup', '0.750', 44),
(33, '90.000', '100.000', 'Baik', '1.000', 44),
(34, '0.000', '69.990', 'Kurang', '0.500', 45),
(35, '70.000', '89.990', 'Cukup', '0.750', 45),
(36, '90.000', '100.000', 'Baik', '1.000', 45),
(37, '0.000', '25.000', 'Buruk', '0.250', 46),
(38, '26.000', '50.000', 'Kurang', '0.500', 46),
(39, '51.000', '75.000', 'Baik', '0.750', 46),
(40, '76.000', '100.000', 'Sangat Baik', '1.000', 46),
(41, '0.000', '79.990', 'Buruk', '0.500', 47),
(42, '80.000', '89.990', 'Cukup', '0.750', 47),
(43, '90.000', '100.000', 'Baik', '1.000', 47),
(44, '0.000', '79.990', 'Buruk', '0.500', 48),
(45, '80.000', '89.990', 'Cukup', '0.750', 48),
(46, '90.000', '100.000', 'Baik', '1.000', 48);

-- --------------------------------------------------------

--
-- Table structure for table `penilaian`
--

CREATE TABLE `penilaian` (
  `id_penilaian` int(11) NOT NULL,
  `nik` varchar(10) NOT NULL,
  `nilai_si` decimal(6,3) NOT NULL,
  `nilai_vi` decimal(6,3) NOT NULL,
  `akumulasi_poin` decimal(6,3) NOT NULL,
  `tgl_penilaian` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `penilaian_karyawan`
--

CREATE TABLE `penilaian_karyawan` (
  `id_penilaian` int(11) NOT NULL,
  `nik` varchar(10) NOT NULL,
  `kriteria` varchar(35) NOT NULL,
  `bobot_penilaian` decimal(5,3) NOT NULL,
  `ket_penilaian` varchar(50) NOT NULL,
  `bobot_perbaikan` decimal(5,3) NOT NULL,
  `nilai_si` decimal(5,3) NOT NULL,
  `nilai_vi` decimal(5,3) NOT NULL,
  `tgl_penilaian` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penilaian_karyawan`
--

INSERT INTO `penilaian_karyawan` (`id_penilaian`, `nik`, `kriteria`, `bobot_penilaian`, `ket_penilaian`, `bobot_perbaikan`, `nilai_si`, `nilai_vi`, `tgl_penilaian`) VALUES
(170, '0801202201', 'ABSENSI', '1.000', 'Baik', '0.250', '0.000', '0.000', '2022-01-30'),
(171, '0801202201', 'PERILAKU', '1.000', 'Baik', '0.150', '0.000', '0.000', '2022-01-30'),
(172, '0801202201', 'KEDISIPLINAN', '1.000', 'Baik', '0.250', '0.000', '0.000', '2022-01-30'),
(173, '0801202201', 'WAWASAN', '1.000', 'Sangat Baik', '0.050', '0.000', '0.000', '2022-01-30'),
(174, '0801202201', 'KERJASAMA TIM', '1.000', 'Baik', '0.150', '0.000', '0.000', '2022-01-30'),
(175, '0801202201', 'KINERJA', '1.000', 'Baik', '0.150', '0.000', '0.000', '2022-01-30');

-- --------------------------------------------------------

--
-- Table structure for table `perilaku`
--

CREATE TABLE `perilaku` (
  `id_perilaku` int(11) NOT NULL,
  `nik` varchar(10) NOT NULL,
  `kebersihan` decimal(5,2) NOT NULL,
  `peraturan` decimal(5,2) NOT NULL,
  `kejujuran` decimal(5,2) NOT NULL,
  `komunikasi` decimal(5,2) NOT NULL,
  `total_poin_perilaku` decimal(6,3) NOT NULL,
  `keterangan_perilaku` varchar(35) NOT NULL,
  `bobot_poin_perilaku` decimal(6,3) NOT NULL,
  `tgl_penilaian_perilaku` date NOT NULL,
  `id_bobot_perilaku` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `full_name` varchar(35) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` text NOT NULL,
  `akses` enum('0') NOT NULL,
  `is_active` enum('0','1') NOT NULL,
  `date_created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `full_name`, `username`, `password`, `akses`, `is_active`, `date_created`) VALUES
(1, 'Administrator', 'admin', '$2y$10$A3D1K1CsMDaK9iTsovgdbO5hlpj1.AwWuBqkrE.GW5L/8vyEru6ZK', '0', '1', '2021-11-29');

-- --------------------------------------------------------

--
-- Table structure for table `wawasan`
--

CREATE TABLE `wawasan` (
  `id_wawasan` int(11) NOT NULL,
  `nik` varchar(10) NOT NULL,
  `hasil_evaluasi` decimal(5,2) NOT NULL,
  `total_poin_wawasan` decimal(5,2) NOT NULL,
  `keterangan_wawasan` varchar(35) NOT NULL,
  `bobot_poin_wawasan` decimal(6,3) NOT NULL,
  `tgl_penilaian_wawasan` date NOT NULL,
  `id_bobot_wawasan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id_absensi`);

--
-- Indexes for table `bobot`
--
ALTER TABLE `bobot`
  ADD PRIMARY KEY (`id_bobot`);

--
-- Indexes for table `bonus`
--
ALTER TABLE `bonus`
  ADD PRIMARY KEY (`kode_bonus`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`nik`);

--
-- Indexes for table `kedisiplinan`
--
ALTER TABLE `kedisiplinan`
  ADD PRIMARY KEY (`id_disiplin`);

--
-- Indexes for table `kerjasama_tim`
--
ALTER TABLE `kerjasama_tim`
  ADD PRIMARY KEY (`id_kerjasama`);

--
-- Indexes for table `kinerja`
--
ALTER TABLE `kinerja`
  ADD PRIMARY KEY (`id_kinerja`);

--
-- Indexes for table `nilai_kriteria`
--
ALTER TABLE `nilai_kriteria`
  ADD PRIMARY KEY (`id_nilai`);

--
-- Indexes for table `penilaian`
--
ALTER TABLE `penilaian`
  ADD PRIMARY KEY (`id_penilaian`);

--
-- Indexes for table `penilaian_karyawan`
--
ALTER TABLE `penilaian_karyawan`
  ADD PRIMARY KEY (`id_penilaian`);

--
-- Indexes for table `perilaku`
--
ALTER TABLE `perilaku`
  ADD PRIMARY KEY (`id_perilaku`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `wawasan`
--
ALTER TABLE `wawasan`
  ADD PRIMARY KEY (`id_wawasan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id_absensi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `bobot`
--
ALTER TABLE `bobot`
  MODIFY `id_bobot` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT for table `kedisiplinan`
--
ALTER TABLE `kedisiplinan`
  MODIFY `id_disiplin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `kerjasama_tim`
--
ALTER TABLE `kerjasama_tim`
  MODIFY `id_kerjasama` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `kinerja`
--
ALTER TABLE `kinerja`
  MODIFY `id_kinerja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `nilai_kriteria`
--
ALTER TABLE `nilai_kriteria`
  MODIFY `id_nilai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
--
-- AUTO_INCREMENT for table `penilaian`
--
ALTER TABLE `penilaian`
  MODIFY `id_penilaian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `penilaian_karyawan`
--
ALTER TABLE `penilaian_karyawan`
  MODIFY `id_penilaian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=176;
--
-- AUTO_INCREMENT for table `perilaku`
--
ALTER TABLE `perilaku`
  MODIFY `id_perilaku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `wawasan`
--
ALTER TABLE `wawasan`
  MODIFY `id_wawasan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
