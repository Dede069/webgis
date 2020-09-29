-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 29, 2020 at 07:18 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webgis-ci`
--

-- --------------------------------------------------------

--
-- Table structure for table `m_kategori_hotspot`
--

CREATE TABLE `m_kategori_hotspot` (
  `id_kategori_hotspot` int(11) NOT NULL,
  `kd_kategori_hotspot` varchar(10) DEFAULT 'NULL',
  `nm_kategori_hotspot` varchar(50) NOT NULL,
  `marker` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_kategori_hotspot`
--

INSERT INTO `m_kategori_hotspot` (`id_kategori_hotspot`, `kd_kategori_hotspot`, `nm_kategori_hotspot`, `marker`) VALUES
(1, '001', 'Ringan', 'ringan.png'),
(2, '002', 'Sedang', 'sedang.png'),
(3, '003', 'Berat/Parah', 'parah.png');

-- --------------------------------------------------------

--
-- Table structure for table `m_kecamatan`
--

CREATE TABLE `m_kecamatan` (
  `id_kecamatan` int(11) NOT NULL,
  `kd_kecamatan` varchar(10) NOT NULL,
  `nm_kecamatan` varchar(30) NOT NULL,
  `geojson_kecamatan` varchar(30) NOT NULL,
  `warna_kecamatan` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_kecamatan`
--

INSERT INTO `m_kecamatan` (`id_kecamatan`, `kd_kecamatan`, `nm_kecamatan`, `geojson_kecamatan`, `warna_kecamatan`) VALUES
(6, '63.01.08', 'Tambang Ulang ', '55300320083500.geojson', '#009900'),
(8, '63.01.01', 'Takisung', '25061219081252.geojson', '#0de70d'),
(16, '63.01.05', 'Bati-Bati', '71061219081303.geojson', '#880000'),
(17, '63.01.02', 'Jorong', '34061219081408.geojson', '#000099'),
(18, '63.01.03', 'Pelaihari', '39061219081421.geojson', '#DD9900'),
(19, '63.01.04', 'Kurau', '30061219081442.geojson', '#009999'),
(20, '63.01.07', 'Kintap', '29061219081511.geojson', '#ff0099'),
(21, '63.01.09', 'Batu Ampar', '44061219081535.geojson', '#990099'),
(22, '63.01.10', 'Bajuin', '92061219081549.geojson', '#662222'),
(23, '63.01.11', 'Bumi Makmur', '58061219081604.geojson', '#888'),
(24, '63.01.06', 'Panyipatan', '100061219081653.geojson', '#000000');

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id_pengguna` int(11) NOT NULL,
  `nm_pengguna` varchar(20) NOT NULL,
  `kt_sandi` varchar(150) NOT NULL,
  `level` enum('Admin','User') NOT NULL DEFAULT 'User'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id_pengguna`, `nm_pengguna`, `kt_sandi`, `level`) VALUES
(1, 'admin', '$2y$10$oNX.X8jgLhNclHBeI8ytT.1vODlml8.AN1Ieb.rSIChhCa1e7cS0S', 'Admin'),
(2, 'user', '$2y$10$oNX.X8jgLhNclHBeI8ytT.1vODlml8.AN1Ieb.rSIChhCa1e7cS0S', 'User');

-- --------------------------------------------------------

--
-- Table structure for table `t_hotspot`
--

CREATE TABLE `t_hotspot` (
  `id_hotspot` int(11) NOT NULL,
  `id_kecamatan` int(11) NOT NULL,
  `id_kategori_hotspot` int(11) NOT NULL,
  `lokasi` varchar(50) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `lat` float(9,6) NOT NULL,
  `lng` float(9,6) NOT NULL,
  `tanggal` date NOT NULL,
  `polygon` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_hotspot`
--

INSERT INTO `t_hotspot` (`id_hotspot`, `id_kecamatan`, `id_kategori_hotspot`, `lokasi`, `keterangan`, `lat`, `lng`, `tanggal`, `polygon`) VALUES
(1, 6, 3, 'Jl. Peganggas gas amat', 'Kebakaran Parah sekali; tes', -364.101013, 114.775002, '0000-00-00', NULL),
(2, 8, 2, 'Jl. Pegangga', 'Kebakaran Parah sekali', -3.656000, 114.775002, '0000-00-00', NULL),
(3, 16, 1, 'Jl. Raya', 'Rusak parah', -3.816000, 114.796997, '0000-00-00', NULL),
(4, 18, 3, 'Jl A', 'Rusak parah', -381.716003, 114.800003, '0000-00-00', NULL),
(5, 19, 2, 'Jl. Sepeda', '-', -364.101013, 114.675003, '0000-00-00', NULL),
(6, 21, 1, 'Rumah Saiful', '-', -366.101013, 114.775002, '0000-00-00', NULL),
(7, 17, 3, 'Rmah Jakaria', '-', -3.846000, 1.148000, '0000-00-00', NULL),
(8, 21, 2, 'HUtan Rawa Merawa', '-', -376.101013, 114.857002, '0000-00-00', NULL),
(9, 22, 1, 'Gang Jambu', 'Rumah Terbakar', -381.713013, 114.801003, '0000-00-00', NULL),
(10, 23, 3, 'Gedung Pencakar', 'Lantai 4 terbakars', -36.553001, 114.695999, '0000-00-00', NULL),
(11, 24, 2, 'Pasar Kaki Lima', '4 Loket terbakar', -36.553001, 114.685997, '0000-00-00', NULL),
(12, 6, 1, 'Jl. Peganggas gas amat', 'tes', -36.553001, 114.775002, '0000-00-00', NULL),
(13, 8, 3, 'Jalan baru', 'tes', -3.776000, 114.777000, '0000-00-00', NULL),
(14, 16, 2, 'RW. 07; Kel. Angsau; Angsau; South Kalimantan; 708', 'dfdf', -3.802000, 114.775002, '0000-00-00', NULL),
(15, 18, 1, 'Mushola Nurul Ibadah; Jalan Samudera; RT 10 Desa P', 'tes', -3.803000, 114.762001, '0000-00-00', NULL),
(16, 19, 3, 'RT 07; KEL. SARANG HALANG; Sarang Halang; South Ka', 'dfdf', -3.814000, 11.478000, '0000-00-00', NULL),
(17, 24, 2, 'Matah; RT 27 Desa Pelaihari; Karang Taruna; South', 'tes', -3.802000, 114.758003, '0000-00-00', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `m_kategori_hotspot`
--
ALTER TABLE `m_kategori_hotspot`
  ADD PRIMARY KEY (`id_kategori_hotspot`);

--
-- Indexes for table `m_kecamatan`
--
ALTER TABLE `m_kecamatan`
  ADD PRIMARY KEY (`id_kecamatan`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id_pengguna`);

--
-- Indexes for table `t_hotspot`
--
ALTER TABLE `t_hotspot`
  ADD PRIMARY KEY (`id_hotspot`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `m_kategori_hotspot`
--
ALTER TABLE `m_kategori_hotspot`
  MODIFY `id_kategori_hotspot` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `m_kecamatan`
--
ALTER TABLE `m_kecamatan`
  MODIFY `id_kecamatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id_pengguna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `t_hotspot`
--
ALTER TABLE `t_hotspot`
  MODIFY `id_hotspot` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
