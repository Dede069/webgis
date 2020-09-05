-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 05, 2020 at 03:08 AM
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
  `nm_kategori_hotspot` varchar(50) NOT NULL,
  `marker` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_kategori_hotspot`
--

INSERT INTO `m_kategori_hotspot` (`id_kategori_hotspot`, `nm_kategori_hotspot`, `marker`) VALUES
(1, 'Ringan', 'ringan.png'),
(2, 'Sedang', 'sedang.png'),
(3, 'Berat/Parah', 'parah.png');

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
(1, 0, 1, 'Dusun 2, Desa Ketapang., South Kalimantan, 70814, ', 'Kebakaran Parah sekali, tes', -3.795058, 114.826965, '2019-12-19', '[[{\"lat\":-3.770392897880197,\"lng\":114.78367543842744},{\"lat\":-3.747097169562818,\"lng\":114.82703791083539},{\"lat\":-3.7738186877268247,\"lng\":114.88192824783182},{\"lat\":-3.7912900055233947,\"lng\":114.88673782591455},{\"lat\":-3.7950582827409485,\"lng\":114.82696164117203}]]'),
(2, 0, 1, 'Jalan Bajuin Raya, DUSUN 03 DESA BAJUIN KEC. BAJUI', 'Kebakaran Parah sekali', -3.767652, 114.823265, '2019-12-19', '[[{\"lat\":-3.7998542481484163,\"lng\":114.81365203857423},{\"lat\":-3.8248613493163273,\"lng\":114.85210418701173},{\"lat\":-3.847127332281291,\"lng\":114.81983184814455},{\"lat\":-3.8365082435466866,\"lng\":114.78172302246095},{\"lat\":-3.805335318820754,\"lng\":114.78069305419923},{\"lat\":-3.7676522562832417,\"lng\":114.82326507568361}]]'),
(3, 0, 2, 'South Kalimantan, Indonesia', 'Rusak parah', -3.833768, 114.962570, '2019-12-20', '[[{\"lat\":-3.8361656900977903,\"lng\":114.99349065983395},{\"lat\":-3.853293194062035,\"lng\":115.00379689858265},{\"lat\":-3.856376108197493,\"lng\":114.9752829713779},{\"lat\":-3.8337678121110392,\"lng\":114.96257194358786}]]'),
(4, 0, 2, 'RT 05, KEL. SARANG HALANG, Sarang Halang, South Ka', 'Rusak parah', -3.815955, 114.783783, '2019-12-20', '[[{\"lat\":-3.8094460989409646,\"lng\":114.83116149902345},{\"lat\":-3.840961425879922,\"lng\":114.84695434570314},{\"lat\":-3.848154979011987,\"lng\":114.79270935058595},{\"lat\":-3.8159547939599165,\"lng\":114.78378295898439},{\"lat\":-3.8008819515536834,\"lng\":114.81502532958986}]]'),
(5, 19, 3, 'Jl. Sepeda', '-', -3.641010, 114.675003, '2020-01-20', ''),
(6, 6, 2, 'Rumah Saiful', '-', -3.661010, 114.775002, '2020-01-20', ''),
(7, 21, 2, 'Rmah Jakaria', '-', -3.846298, 114.897400, '2020-01-20', ''),
(8, 22, 1, 'HUtan Rawa Merawa', '-', -3.761010, 114.857399, '2020-01-20', ''),
(9, 18, 3, 'Gang Jambu', 'Rumah Terbakar', -3.817130, 114.801888, '2020-02-11', ''),
(10, 6, 1, 'Gedung Pencakar', 'Lantai 4 terbakars', -3.655300, 114.696503, '2020-02-11', ''),
(11, 6, 1, 'Pasar Kaki Lima', '4 Loket terbakar', -3.655300, 114.686501, '2020-02-11', ''),
(12, 6, 3, 'Jl. Peganggas gas amat', 'tes', -3.655300, 114.775246, '2020-02-24', ''),
(13, 6, 1, 'Jalan baru', 'tes', -3.776559, 114.777824, '2020-03-21', ''),
(14, 18, 3, 'RW. 07, Kel. Angsau, Angsau, South Kalimantan, 708', 'dfdf', -3.802937, 114.775772, '2020-04-03', ''),
(15, 18, 3, 'Mushola Nurul Ibadah, Jalan Samudera, RT 10 Desa P', 'tes', -3.803622, 114.762718, '2020-04-03', ''),
(16, 6, 1, 'RT 07, KEL. SARANG HALANG, Sarang Halang, South Ka', 'dfdf', -3.814585, 114.781960, '2020-04-03', ''),
(17, 6, 3, 'Matah, RT 27 Desa Pelaihari, Karang Taruna, South', 'tes', -3.802595, 114.758598, '2020-04-03', '');

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
