-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2022 at 02:30 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_tailor`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id_cart` int(11) NOT NULL,
  `invoice` varchar(20) NOT NULL,
  `kode_barang` varchar(13) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `harga` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `sub_total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `data_pembeli`
--

CREATE TABLE `data_pembeli` (
  `id_pembeli` int(11) NOT NULL,
  `nama_pembeli` varchar(30) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `no_hp` varchar(13) NOT NULL,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_pembeli`
--

INSERT INTO `data_pembeli` (`id_pembeli`, `nama_pembeli`, `alamat`, `no_hp`, `username`, `password`) VALUES
(1, 'Firdiyatus sholihahatul', 'Probolinggo', '089505016100', 'firdi', '123'),
(13, 'thor', 'Jember', '0812548', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `kode_transaksi` varchar(20) NOT NULL,
  `kode_barang` varchar(13) NOT NULL,
  `qty` int(11) NOT NULL,
  `sub_total` double NOT NULL,
  `catatan` varchar(225) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_transaksi`
--

INSERT INTO `detail_transaksi` (`kode_transaksi`, `kode_barang`, `qty`, `sub_total`, `catatan`) VALUES
('AD12122290301', 'BPK', 5, 250000, NULL),
('AD12122295991', 'CP', 2, 60000, NULL),
('AD131222110096', 'CP', 2, 60000, NULL),
('AD131222111312', 'BPK', 2, 100000, NULL),
('AD131222140712', 'BPK', 3, 150000, NULL),
('AD131222191415', 'BPK', 1, 50000, NULL),
('AD131222193120', 'BPK', 2, 100000, NULL),
('AD131222201520', 'SAKS', 5, 200000, NULL),
('AD171222195121', 'CPK', 5, 125000, NULL),
('AD171222195320', 'KPL', 5, 175000, NULL),
('AD171222195920', 'CP', 9, 270000, NULL),
('AD171222200320', 'SAKL', 8, 360000, NULL),
('AD171222201621', 'KPL', 9, 315000, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `id_karyawan` int(11) NOT NULL,
  `username` varchar(13) NOT NULL,
  `nama_karyawan` varchar(30) NOT NULL,
  `alamat_karyawan` varchar(100) NOT NULL,
  `no_hp` varchar(13) NOT NULL,
  `foto_profil` varchar(100) NOT NULL,
  `password` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `level` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id_karyawan`, `username`, `nama_karyawan`, `alamat_karyawan`, `no_hp`, `foto_profil`, `password`, `level`) VALUES
(1, 'admin', 'Administrator', 'Jember', '085678901234', 'LOGO-POLITEKNIK-NEGERI-JEMBER.png', 'admin', 1),
(25, 'e41210477', 'Fikri A', 'Jember', '089505016100', 'Logo BEM.png', '123', 2);

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE `level` (
  `id_level` int(1) NOT NULL,
  `level` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`id_level`, `level`) VALUES
(1, 'Admin'),
(2, 'Karyawan');

-- --------------------------------------------------------

--
-- Table structure for table `master_barang`
--

CREATE TABLE `master_barang` (
  `kode_barang` varchar(13) NOT NULL,
  `nama_barang` varchar(30) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `master_barang`
--

INSERT INTO `master_barang` (`kode_barang`, `nama_barang`, `harga`) VALUES
('BPK', 'Baju Panjang Katun M', 50000),
('CP', 'Celana Panjang M', 30000),
('CPK', 'Celana Pendek M', 25000),
('KPL', 'Kemeja Panjang L', 35000),
('SAK', 'Seragam Atasan Katun M', 40000),
('SAKL', 'Seragam Atasan Katun L', 45000),
('SAKS', 'Seragam Atasan Katun SS', 40000),
('SAKXL', 'Seragam Atasan Katun XL', 50000);

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id_status` char(1) NOT NULL,
  `nama_status` enum('Proses','Selesai','Pending','Konfirmasi') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id_status`, `nama_status`) VALUES
('1', 'Konfirmasi'),
('2', 'Proses'),
('3', 'Pending'),
('4', 'Selesai');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `kode_transaksi` varchar(20) NOT NULL,
  `waktu` datetime NOT NULL,
  `karyawan` int(11) DEFAULT NULL,
  `id_pembeli` int(11) NOT NULL,
  `total` double NOT NULL,
  `dibayar` double DEFAULT NULL,
  `sisa_pembayaran` double DEFAULT NULL,
  `status` char(1) NOT NULL,
  `tgl_jadi` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`kode_transaksi`, `waktu`, `karyawan`, `id_pembeli`, `total`, `dibayar`, `sisa_pembayaran`, `status`, `tgl_jadi`) VALUES
('AD12122290301', '2022-12-12 09:03:30', 1, 1, 250000, 275000, 0, '4', '2022-12-12'),
('AD12122295991', '2022-12-12 10:00:10', 1, 1, 60000, 80000, 0, '4', '2022-12-12'),
('AD131222110096', '2022-12-13 11:00:48', 1, 1, 60000, 60000, 0, '4', '2022-12-13'),
('AD131222111312', '2022-12-13 11:13:32', 1, 1, 100000, 125000, 0, '4', '2022-12-13'),
('AD131222140712', '2022-12-13 14:07:09', 1, 1, 150000, 150000, 0, '4', '2022-12-31'),
('AD131222191415', '2022-12-13 19:15:05', 1, 1, 50000, 50000, 0, '4', '2022-12-13'),
('AD131222193120', '2022-12-13 19:31:59', 1, 1, 100000, 550000, 0, '4', '2022-12-17'),
('AD131222201520', '2022-12-13 20:15:12', 1, 1, 200000, 200000, 0, '4', '2022-12-31'),
('AD171222195121', '2022-12-17 19:51:41', NULL, 13, 125000, 0, 0, '4', '2022-12-18'),
('AD171222195320', '2022-12-17 19:54:04', 25, 13, 175000, 175000, 0, '4', '2022-12-17'),
('AD171222195920', '2022-12-17 20:00:06', 25, 1, 270000, 300000, 0, '4', '2022-12-17'),
('AD171222200320', '2022-12-17 20:03:54', 25, 13, 360000, 150000, 210000, '2', '2022-12-17'),
('AD171222201621', '2022-12-17 20:17:11', 25, 1, 315000, 125000, 190000, '2', '2022-12-17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id_cart`),
  ADD KEY `cart_kodebarang` (`kode_barang`);

--
-- Indexes for table `data_pembeli`
--
ALTER TABLE `data_pembeli`
  ADD PRIMARY KEY (`id_pembeli`);

--
-- Indexes for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD KEY `kode_transaksi` (`kode_transaksi`),
  ADD KEY `kode_barang` (`kode_barang`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id_karyawan`),
  ADD KEY `Level` (`level`);

--
-- Indexes for table `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`id_level`);

--
-- Indexes for table `master_barang`
--
ALTER TABLE `master_barang`
  ADD PRIMARY KEY (`kode_barang`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id_status`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`kode_transaksi`),
  ADD KEY `id_karyawan` (`karyawan`),
  ADD KEY `id_pembeli` (`id_pembeli`),
  ADD KEY `status_ibfk_1` (`status`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id_cart` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `data_pembeli`
--
ALTER TABLE `data_pembeli`
  MODIFY `id_pembeli` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id_karyawan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_kodebarang` FOREIGN KEY (`kode_barang`) REFERENCES `master_barang` (`kode_barang`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD CONSTRAINT `detail_transaksi_ibfk_1` FOREIGN KEY (`kode_transaksi`) REFERENCES `transaksi` (`kode_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_transaksi_ibfk_2` FOREIGN KEY (`kode_barang`) REFERENCES `master_barang` (`kode_barang`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD CONSTRAINT `Level` FOREIGN KEY (`level`) REFERENCES `level` (`id_level`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `status_ibfk_1` FOREIGN KEY (`status`) REFERENCES `status` (`id_status`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`karyawan`) REFERENCES `karyawan` (`id_karyawan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`id_pembeli`) REFERENCES `data_pembeli` (`id_pembeli`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
