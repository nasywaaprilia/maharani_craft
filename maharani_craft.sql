-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 15, 2025 at 09:27 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `maharani_craft`
--

-- --------------------------------------------------------

--
-- Table structure for table `bahan_baku`
--

CREATE TABLE `bahan_baku` (
  `id_bahan` varchar(20) NOT NULL,
  `nama_bahan` varchar(50) NOT NULL,
  `satuan` varchar(20) NOT NULL,
  `stok` int(11) NOT NULL,
  `id_supplier` varchar(20) NOT NULL,
  `tanggal_masuk` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bahan_baku`
--

INSERT INTO `bahan_baku` (`id_bahan`, `nama_bahan`, `satuan`, `stok`, `id_supplier`, `tanggal_masuk`) VALUES
('BB0001', 'Kain perca tenun', 'meter', 250, 'S001', '2025-06-25'),
('BB0002', 'Kain perca Batik', 'meter', 150, 'S002', '2025-07-17');

-- --------------------------------------------------------

--
-- Table structure for table `bahan_keluar`
--

CREATE TABLE `bahan_keluar` (
  `id_bahankeluar` varchar(20) NOT NULL,
  `id_produksi` varchar(20) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bahan_keluar`
--

INSERT INTO `bahan_keluar` (`id_bahankeluar`, `id_produksi`, `tanggal`) VALUES
('BK001', 'PRS0001', '2025-07-15'),
('BK002', 'PRS0002', '2025-07-15');

-- --------------------------------------------------------

--
-- Table structure for table `detail_bahankeluar`
--

CREATE TABLE `detail_bahankeluar` (
  `id` int(11) NOT NULL,
  `id_bahankeluar` varchar(20) NOT NULL,
  `id_bahan` varchar(20) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `satuan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_bahankeluar`
--

INSERT INTO `detail_bahankeluar` (`id`, `id_bahankeluar`, `id_bahan`, `jumlah`, `satuan`) VALUES
(6, 'BK002', 'BB0002', 45, 'meter'),
(7, 'BK001', 'BB0001', 75, 'meter'),
(8, 'BK001', 'BB0002', 50, 'meter');

-- --------------------------------------------------------

--
-- Table structure for table `detail_hasilproduksi`
--

CREATE TABLE `detail_hasilproduksi` (
  `id` int(11) NOT NULL,
  `id_produksi` varchar(20) NOT NULL,
  `id_produk` varchar(20) NOT NULL,
  `stok_produk` int(11) NOT NULL,
  `satuan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_hasilproduksi`
--

INSERT INTO `detail_hasilproduksi` (`id`, `id_produksi`, `id_produk`, `stok_produk`, `satuan`) VALUES
(20, 'PRS0001', 'PRD0001', 90, 'PCS'),
(21, 'PRS0002', 'PRD0001', 80, 'PCS'),
(22, 'PRS0002', 'PRD0002', 80, 'PCS'),
(23, 'PRS0002', 'PRD0003', 25, 'PCS');

-- --------------------------------------------------------

--
-- Table structure for table `detail_penjualan`
--

CREATE TABLE `detail_penjualan` (
  `id` int(11) NOT NULL,
  `id_penjualan` varchar(20) NOT NULL,
  `id_produk` varchar(20) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `satuan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_penjualan`
--

INSERT INTO `detail_penjualan` (`id`, `id_penjualan`, `id_produk`, `jumlah`, `satuan`) VALUES
(4, 'PJ001', 'PRD0001', 5, 'PCS'),
(5, 'PJ002', 'PRD0002', 50, 'PCS'),
(6, 'PJ003', 'PRD0003', 25, 'PCS'),
(7, 'PJ003', 'PRD0001', 15, 'PCS');

-- --------------------------------------------------------

--
-- Table structure for table `hasilproduksi`
--

CREATE TABLE `hasilproduksi` (
  `id_produksi` varchar(20) NOT NULL,
  `tanggal_produksi` date NOT NULL,
  `keterangan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hasilproduksi`
--

INSERT INTO `hasilproduksi` (`id_produksi`, `tanggal_produksi`, `keterangan`) VALUES
('PRS0001', '2025-07-13', 'produksi'),
('PRS0002', '2025-07-15', 'produksi tambahan');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` varchar(200) NOT NULL,
  `nama_kategori` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
('K-0001', 'Badcover'),
('K-0002', 'Sarung Bantal'),
('K-0003', 'Sajadah');

-- --------------------------------------------------------

--
-- Table structure for table `listpo`
--

CREATE TABLE `listpo` (
  `id_po` varchar(20) NOT NULL,
  `nama_customer` varchar(100) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `id_produk` varchar(20) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `no_hp` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `listpo`
--

INSERT INTO `listpo` (`id_po`, `nama_customer`, `tanggal`, `id_produk`, `jumlah`, `no_hp`) VALUES
('PO0001', 'Ani', '2025-06-28', 'PRD0001', 23, '098765432127'),
('PO0002', 'Endang', '2025-07-25', 'PRD0001', 20, '098765432127');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `id_penjualan` varchar(20) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`id_penjualan`, `tanggal`) VALUES
('PJ001', '2025-07-15'),
('PJ002', '2025-07-15'),
('PJ003', '2025-07-15');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` varchar(20) NOT NULL,
  `id_kategori` varchar(200) NOT NULL,
  `nama_produk` varchar(50) NOT NULL,
  `satuan` varchar(50) NOT NULL,
  `harga_produk` int(200) NOT NULL,
  `gambar_produk` varchar(100) NOT NULL,
  `deskripsi_produk` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `id_kategori`, `nama_produk`, `satuan`, `harga_produk`, `gambar_produk`, `deskripsi_produk`) VALUES
('PRD0001', 'K-0001', 'Badcover batik merah', 'PCS', 285000, '1750882820_dc34de5258762f1bd3a6.jpeg', 'terbuat dari bahan perca batik'),
('PRD0002', 'K-0003', 'Sajadah batik', 'PCS', 170000, '1752604775_9699ed041429bcef2be3.jpeg', 'sajah batik coklat'),
('PRD0003', 'K-0002', 'Sarung bantal motif', 'PCS', 250000, '1752604809_0668dec70c289bca18bc.jpeg', 'sarung bantal motif warna ungun');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id_supplier` varchar(20) NOT NULL,
  `nama_supplier` varchar(50) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `no_hp` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id_supplier`, `nama_supplier`, `alamat`, `no_hp`) VALUES
('S001', 'CV. Tenun Mandiri', 'Jl. Bima No. 5, Klaten', '098765432127'),
('S002', 'CV. Batik Mandiri', 'Jl. Mawar No. 7, Pekalongan', '098765432127');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `level` enum('Gudang','Produksi','Penjualan') NOT NULL,
  `name` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `level`, `name`, `password`, `status`, `username`) VALUES
(9, 'admingudang@gmail.com', 'Gudang', 'admin gudang', '$2y$10$9k827KgcYSV66hFtmXqvSujTSp.4qcsIThg2uMbeeDmb0kf.i0j3e', 'Active', 'admingudang'),
(11, 'adminproduksi@gmail.com', 'Produksi', 'admin produksi', '$2y$10$k7VndtksGLtjn6BHXNcns.7kQrz2hlR5o57t7puZcPIyOyQZhKdHu', 'Active', 'adminproduksi'),
(12, 'adminpenjualan@gmail.com', 'Penjualan', 'admin penjualan', '$2y$10$enhhLAiPAmZdf4jUCRbBy.bxTaQntlcW62hpcejC0pbMIwf1k9g16', 'Active', 'adminpenjualan');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bahan_baku`
--
ALTER TABLE `bahan_baku`
  ADD PRIMARY KEY (`id_bahan`),
  ADD KEY `id_supplier` (`id_supplier`);

--
-- Indexes for table `bahan_keluar`
--
ALTER TABLE `bahan_keluar`
  ADD PRIMARY KEY (`id_bahankeluar`),
  ADD KEY `id_produksi` (`id_produksi`);

--
-- Indexes for table `detail_bahankeluar`
--
ALTER TABLE `detail_bahankeluar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_bahankeluar` (`id_bahankeluar`),
  ADD KEY `id_bahan` (`id_bahan`);

--
-- Indexes for table `detail_hasilproduksi`
--
ALTER TABLE `detail_hasilproduksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_produksi` (`id_produksi`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indexes for table `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_penjualan` (`id_penjualan`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indexes for table `hasilproduksi`
--
ALTER TABLE `hasilproduksi`
  ADD PRIMARY KEY (`id_produksi`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `listpo`
--
ALTER TABLE `listpo`
  ADD PRIMARY KEY (`id_po`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id_penjualan`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_bahankeluar`
--
ALTER TABLE `detail_bahankeluar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `detail_hasilproduksi`
--
ALTER TABLE `detail_hasilproduksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bahan_baku`
--
ALTER TABLE `bahan_baku`
  ADD CONSTRAINT `bahan_baku_ibfk_1` FOREIGN KEY (`id_supplier`) REFERENCES `supplier` (`id_supplier`);

--
-- Constraints for table `bahan_keluar`
--
ALTER TABLE `bahan_keluar`
  ADD CONSTRAINT `bahan_keluar_ibfk_1` FOREIGN KEY (`id_produksi`) REFERENCES `hasilproduksi` (`id_produksi`);

--
-- Constraints for table `detail_bahankeluar`
--
ALTER TABLE `detail_bahankeluar`
  ADD CONSTRAINT `detail_bahankeluar_ibfk_1` FOREIGN KEY (`id_bahankeluar`) REFERENCES `bahan_keluar` (`id_bahankeluar`),
  ADD CONSTRAINT `detail_bahankeluar_ibfk_2` FOREIGN KEY (`id_bahan`) REFERENCES `bahan_baku` (`id_bahan`);

--
-- Constraints for table `detail_hasilproduksi`
--
ALTER TABLE `detail_hasilproduksi`
  ADD CONSTRAINT `detail_hasilproduksi_ibfk_1` FOREIGN KEY (`id_produksi`) REFERENCES `hasilproduksi` (`id_produksi`),
  ADD CONSTRAINT `detail_hasilproduksi_ibfk_2` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`);

--
-- Constraints for table `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  ADD CONSTRAINT `detail_penjualan_ibfk_1` FOREIGN KEY (`id_penjualan`) REFERENCES `penjualan` (`id_penjualan`),
  ADD CONSTRAINT `detail_penjualan_ibfk_2` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`);

--
-- Constraints for table `listpo`
--
ALTER TABLE `listpo`
  ADD CONSTRAINT `listpo_ibfk_1` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`);

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
