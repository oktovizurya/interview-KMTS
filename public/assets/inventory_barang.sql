-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 11, 2021 at 06:37 AM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.4.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory_barang`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

DROP TABLE IF EXISTS `barang`;
CREATE TABLE IF NOT EXISTS `barang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_barang` varchar(255) DEFAULT NULL,
  `merk` varchar(255) DEFAULT NULL,
  `jenis` varchar(255) DEFAULT NULL,
  `harga` int(11) DEFAULT 0,
  `stok` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id`, `nama_barang`, `merk`, `jenis`, `harga`, `stok`, `created_at`, `updated_at`) VALUES
(1, 'Sapu', NULL, NULL, 10000, 8, '2021-06-10 00:00:00', '2021-06-10 17:49:39'),
(2, 'Baskom', NULL, NULL, 5000, 20, '2021-06-10 00:00:00', '2021-06-11 02:59:29'),
(3, 'Pengki', 'Yamaha', 'Alat Rumah Tangga', 7000, 21, '2021-06-10 15:52:57', '2021-06-11 02:59:23');

-- --------------------------------------------------------

--
-- Table structure for table `barang_keluar`
--

DROP TABLE IF EXISTS `barang_keluar`;
CREATE TABLE IF NOT EXISTS `barang_keluar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pelanggan` int(11) DEFAULT NULL,
  `total_harga` int(11) NOT NULL DEFAULT 0,
  `tanggal` date DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang_keluar`
--

INSERT INTO `barang_keluar` (`id`, `id_pelanggan`, `total_harga`, `tanggal`, `created_at`, `updated_at`) VALUES
(1, 1, 50000, '2021-06-10', '2021-06-10 00:00:00', '2021-06-10 00:00:00'),
(2, 1, 25000, '2021-06-10', '2021-06-10 00:00:00', '2021-06-10 17:32:54'),
(3, 2, 30000, '2021-06-10', '2021-06-10 16:41:04', '2021-06-10 17:16:11'),
(6, 3, 35000, '2021-06-12', '2021-06-10 17:46:43', '2021-06-10 17:46:56'),
(7, 3, 43000, '2021-06-12', '2021-06-11 02:59:10', '2021-06-11 02:59:29');

-- --------------------------------------------------------

--
-- Table structure for table `barang_keluar_detail`
--

DROP TABLE IF EXISTS `barang_keluar_detail`;
CREATE TABLE IF NOT EXISTS `barang_keluar_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_barang_keluar` int(11) DEFAULT NULL,
  `id_barang` int(11) DEFAULT NULL,
  `jumlah` int(11) NOT NULL DEFAULT 0,
  `total` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang_keluar_detail`
--

INSERT INTO `barang_keluar_detail` (`id`, `id_barang_keluar`, `id_barang`, `jumlah`, `total`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 5, 50000, '2021-06-10 00:00:00', '2021-06-10 00:00:00'),
(2, 2, 2, 5, 25000, '2021-06-10 00:00:00', '2021-06-10 00:00:00'),
(5, 3, 2, 2, 10000, '2021-06-10 17:13:42', '2021-06-10 17:13:42'),
(6, 3, 1, 2, 20000, '2021-06-10 17:16:11', '2021-06-10 17:16:11'),
(14, 6, 3, 5, 35000, '2021-06-10 17:46:56', '2021-06-10 17:46:56'),
(16, 7, 2, 3, 15000, '2021-06-11 02:59:29', '2021-06-11 02:59:29'),
(15, 7, 3, 4, 28000, '2021-06-11 02:59:23', '2021-06-11 02:59:23');

-- --------------------------------------------------------

--
-- Table structure for table `barang_masuk`
--

DROP TABLE IF EXISTS `barang_masuk`;
CREATE TABLE IF NOT EXISTS `barang_masuk` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_supplier` int(11) DEFAULT NULL,
  `total_harga` int(11) NOT NULL DEFAULT 0,
  `tanggal` date DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang_masuk`
--

INSERT INTO `barang_masuk` (`id`, `id_supplier`, `total_harga`, `tanggal`, `created_at`, `updated_at`) VALUES
(1, 1, 175000, '2021-06-10', '2021-06-10 00:00:00', '2021-06-10 18:19:02'),
(2, 1, 125000, '2021-06-10', '2021-06-10 00:00:00', '2021-06-10 00:00:00'),
(3, 2, 140000, '2021-06-11', '2021-06-10 17:44:52', '2021-06-10 17:45:38'),
(4, 1, 70000, '2021-06-11', '2021-06-10 17:46:14', '2021-06-10 17:46:23');

-- --------------------------------------------------------

--
-- Table structure for table `barang_masuk_detail`
--

DROP TABLE IF EXISTS `barang_masuk_detail`;
CREATE TABLE IF NOT EXISTS `barang_masuk_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_barang_masuk` int(11) DEFAULT NULL,
  `id_barang` int(11) DEFAULT NULL,
  `jumlah` int(11) NOT NULL DEFAULT 0,
  `total` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang_masuk_detail`
--

INSERT INTO `barang_masuk_detail` (`id`, `id_barang_masuk`, `id_barang`, `jumlah`, `total`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 15, 150000, '2021-06-10 00:00:00', '2021-06-10 00:00:00'),
(2, 2, 2, 25, 125000, '2021-06-10 00:00:00', '2021-06-10 00:00:00'),
(3, 3, 3, 20, 140000, '2021-06-10 17:45:38', '2021-06-10 17:45:38'),
(4, 4, 3, 10, 70000, '2021-06-10 17:46:23', '2021-06-10 17:46:23'),
(6, 1, 2, 5, 25000, '2021-06-10 18:19:02', '2021-06-10 18:19:02');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`) USING HASH
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`(250))
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

DROP TABLE IF EXISTS `pelanggan`;
CREATE TABLE IF NOT EXISTS `pelanggan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `no_telp` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `nama`, `alamat`, `no_telp`, `created_at`, `updated_at`) VALUES
(1, 'Maria', 'Jakarta', '08978273822', '2021-06-10 00:00:00', '2021-06-10 00:00:00'),
(2, 'Andini', 'Tangerang', '089273721932', '2021-06-10 15:38:53', '2021-06-10 15:38:53'),
(3, 'Dimas', 'Bekasi', '089372718329', '2021-06-10 15:39:35', '2021-06-10 15:39:35');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

DROP TABLE IF EXISTS `supplier`;
CREATE TABLE IF NOT EXISTS `supplier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `no_telp` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `nama`, `alamat`, `no_telp`, `created_at`, `updated_at`) VALUES
(1, 'Ahmad', 'Depok', '08978632873', '2021-06-10 00:00:00', '2021-06-10 00:00:00'),
(2, 'Budi', 'DKI Jakarta', '089738282993', '2021-06-10 15:43:07', '2021-06-10 15:43:38');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` int(11) DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`) USING HASH
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `role`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Endang', 1, 'endang@gmail.com', NULL, '$2y$10$pL4RKxhn4X1QyhIQlajDUeJPhvTZIG5OJ/3jfOmsdXZorNFdjIpr6', NULL, '2021-06-10 04:49:14', '2021-06-10 04:49:14'),
(2, 'Supervisor', NULL, 'supervisor@gmail.com', NULL, '$2y$10$tacCxTXwzGoncaKPKBZvtOE0buyftJ8aiFXVS0X6as/mv/B.PfLyK', NULL, '2021-06-10 20:01:47', '2021-06-10 20:01:47');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
