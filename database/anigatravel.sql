-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 07, 2020 at 02:01 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `anigatravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_pemesanans`
--

CREATE TABLE `detail_pemesanans` (
  `id_detail` int(10) UNSIGNED NOT NULL,
  `kode_tiket` varchar(151) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_pemesanan` varchar(151) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail_pemesanans`
--

INSERT INTO `detail_pemesanans` (`id_detail`, `kode_tiket`, `kode_pemesanan`, `created_at`, `updated_at`) VALUES
(9, 'TIK1510,TIK1545,', 'PEMS00HZQNT', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `diskons`
--

CREATE TABLE `diskons` (
  `id_diskon` int(10) UNSIGNED NOT NULL,
  `kode_diskon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `diskon` varchar(151) COLLATE utf8mb4_unicode_ci NOT NULL,
  `maximal_diskon` int(11) NOT NULL,
  `status` enum('on','off') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'off',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `diskons`
--

INSERT INTO `diskons` (`id_diskon`, `kode_diskon`, `diskon`, `maximal_diskon`, `status`, `created_at`, `updated_at`) VALUES
(5, 'LIMA', '10', 10000, 'on', '2020-01-22 13:14:15', '2020-01-27 13:18:15'),
(6, 'LO2GDV', '50', 100000, 'off', '2020-01-22 13:14:31', '2020-01-27 13:18:21'),
(8, 'XQX4HE', '10', 10000, 'on', '2020-01-27 13:15:18', '2020-01-27 13:15:18');

-- --------------------------------------------------------

--
-- Table structure for table `drivers`
--

CREATE TABLE `drivers` (
  `id_driver` int(10) UNSIGNED NOT NULL,
  `nama_lengkap` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_ktp` int(20) NOT NULL,
  `no_sim` int(20) NOT NULL,
  `id_transportasi` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `drivers`
--

INSERT INTO `drivers` (`id_driver`, `nama_lengkap`, `no_ktp`, `no_sim`, `id_transportasi`, `created_at`, `updated_at`) VALUES
(5, 'balalala', 1213123, 1213123, 22, '2020-01-18 14:49:11', '2020-01-18 14:49:11'),
(7, 'marsmello', 1111111, 1111111, 23, '2020-01-18 14:58:45', '2020-01-18 15:24:50'),
(8, 'Robert Dowly Junior', 1, 1, 26, '2020-01-18 15:26:16', '2020-01-18 15:26:16'),
(9, 'Khoerul', 1640986544, 998, 24, '2020-01-29 02:58:50', '2020-01-29 02:58:50');

-- --------------------------------------------------------

--
-- Table structure for table `identitass`
--

CREATE TABLE `identitass` (
  `id_identitas` int(10) UNSIGNED NOT NULL,
  `nama_lengkap` varchar(151) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(151) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipe_identitas` varchar(151) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_identitas` varchar(151) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jadwals`
--

CREATE TABLE `jadwals` (
  `id_jadwal` int(10) UNSIGNED NOT NULL,
  `id_rute` int(11) NOT NULL,
  `harga` varchar(151) COLLATE utf8mb4_unicode_ci NOT NULL,
  `waktu_berangkat` time NOT NULL,
  `tanggal_berangkat` date NOT NULL,
  `waktu_sampai` time NOT NULL,
  `tanggal_sampai` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jadwals`
--

INSERT INTO `jadwals` (`id_jadwal`, `id_rute`, `harga`, `waktu_berangkat`, `tanggal_berangkat`, `waktu_sampai`, `tanggal_sampai`, `created_at`, `updated_at`) VALUES
(9, 7, '123', '15:27:00', '2017-10-09', '03:27:00', '2022-02-13', '2019-12-10 22:29:49', '2019-12-10 22:32:58'),
(10, 11, '123141241', '01:00:00', '2020-01-01', '15:01:00', '2020-01-01', '2020-01-10 13:28:02', '2020-01-10 13:28:26'),
(12, 10, '56000', '01:00:00', '2019-12-31', '17:59:00', '2019-12-31', '2020-01-12 08:52:27', '2020-01-12 08:52:27'),
(13, 17, '1000000', '13:00:00', '2020-01-20', '14:59:00', '2020-02-20', '2020-01-20 00:46:01', '2020-01-20 00:46:50'),
(14, 17, '120000', '01:00:00', '2020-01-21', '14:00:00', '2020-01-21', '2020-01-20 00:47:37', '2020-01-20 00:47:37'),
(15, 17, '90000', '12:59:00', '2020-12-12', '14:00:00', '2020-12-12', '2020-01-20 00:48:11', '2020-01-24 01:44:40'),
(16, 39, '1200000', '00:12:00', '2020-12-12', '00:12:00', '0012-12-12', '2020-01-27 22:48:51', '2020-01-28 02:09:27'),
(17, 38, '1000000', '12:01:00', '2020-12-12', '12:12:00', '2020-12-12', '2020-01-28 01:05:25', '2020-01-28 01:13:08');

-- --------------------------------------------------------

--
-- Table structure for table `konfirmasi_pemesanans`
--

CREATE TABLE `konfirmasi_pemesanans` (
  `id_konfirmasi` int(10) UNSIGNED NOT NULL,
  `kode_pemesanan` varchar(151) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_foto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dimensions` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `konfirmasi_pemesanans`
--

INSERT INTO `konfirmasi_pemesanans` (`id_konfirmasi`, `kode_pemesanan`, `nama_foto`, `dimensions`, `path`, `created_at`, `updated_at`) VALUES
(15, 'PEMS00WK5Z3', '1580199624_5e2feec8ca30d.jpg', '245|300|500', 'C:\\xampp\\htdocs\\anigatravel\\storage\\app/public/images', '2020-01-28 08:20:25', '2020-01-28 08:20:25'),
(16, 'PEMS003ABHN', '1580202317_5e2ff94d7fcba.png', '245|300|500', 'C:\\xampp\\htdocs\\anigatravel\\storage\\app/public/images', '2020-01-28 09:05:20', '2020-01-28 09:05:20'),
(17, 'PEMS00EKASN', '1580206379_5e30092baf670.png', '245|300|500', 'C:\\xampp\\htdocs\\anigatravel\\storage\\app/public/images', '2020-01-28 10:13:02', '2020-01-28 10:13:02'),
(18, 'PEMS00SOCFL', '1580206666_5e300a4a59b33.jpg', '245|300|500', 'C:\\xampp\\htdocs\\anigatravel\\storage\\app/public/images', '2020-01-28 10:17:46', '2020-01-28 10:17:46'),
(19, 'PEMS00A3YKU', '1580209936_5e3017104e21c.jpg', '245|300|500', 'C:\\xampp\\htdocs\\anigatravel\\storage\\app/public/images', '2020-01-28 11:12:27', '2020-01-28 11:12:27'),
(20, 'PEMS00RIDG7', '1580268696_5e30fc9878831.jpg', '245|300|500', 'C:\\xampp\\htdocs\\anigatravel\\storage\\app/public/images', '2020-01-29 03:31:38', '2020-01-29 03:31:38'),
(21, 'PEMS00ZVIO2', '1580787965_5e38e8fdc3a53.jpg', '245|300|500', 'C:\\xampp\\htdocs\\anigatravel\\storage\\app/public/images', '2020-02-04 03:46:09', '2020-02-04 03:46:09'),
(22, 'PEMS00EOH55', '1580808395_5e3938cb5f3f0.jpg', '245|300|500', 'C:\\xampp\\htdocs\\anigatravel\\storage\\app/public/images', '2020-02-04 09:26:35', '2020-02-04 09:26:35');

-- --------------------------------------------------------

--
-- Table structure for table `levels`
--

CREATE TABLE `levels` (
  `id_level` int(10) UNSIGNED NOT NULL,
  `nama_level` varchar(151) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `login_tokens`
--

CREATE TABLE `login_tokens` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` varchar(151) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(151) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(151) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_11_25_032856_penumpang', 1),
(4, '2019_11_25_033027_pemesanan', 1),
(5, '2019_11_25_033106_rute', 1),
(6, '2019_11_25_033148_petugas', 1),
(7, '2019_11_25_033211_transportasi', 1),
(8, '2019_11_25_033259_type_transportasi', 1),
(9, '2019_11_25_034555_level', 1),
(10, '2019_11_26_062022_login_token', 2),
(11, '2019_12_03_075703_jadwal', 3),
(12, '2019_12_10_100755_rincian_penumpang', 4),
(13, '2020_01_07_082515_tiket', 5),
(14, '2020_01_15_103209_profile', 6),
(15, '2020_01_18_212306_tempat', 7),
(16, '2020_01_20_092719_konfirmasi_pemesanan', 8),
(17, '2020_01_21_132539_diskon', 9),
(18, '2020_01_24_092023_detail_pemesanan', 10);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(151) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(151) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pemesanans`
--

CREATE TABLE `pemesanans` (
  `id_pemesanan` int(10) UNSIGNED NOT NULL,
  `kode_pemesanan` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total` int(151) NOT NULL,
  `id_penumpang` int(11) NOT NULL,
  `id_petugas` int(11) DEFAULT NULL,
  `status` enum('Menunggu Konfirmasi User','Menunggu Konfirmasi Admin','Sukses') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Menunggu Konfirmasi User',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pemesanans`
--

INSERT INTO `pemesanans` (`id_pemesanan`, `kode_pemesanan`, `total`, `id_penumpang`, `id_petugas`, `status`, `created_at`, `updated_at`) VALUES
(36, 'PEMS00WK5Z3', 2207000, 3, NULL, 'Sukses', '2019-11-11 06:02:18', '2020-02-03 03:50:13'),
(37, 'PEMS003ABHN', 2407000, 3, NULL, 'Sukses', '2020-01-28 08:25:14', '2020-02-04 02:17:04'),
(38, 'PEMS00EKASN', 4407000, 3, NULL, 'Sukses', '2020-01-28 09:54:43', '2020-01-30 14:17:35'),
(39, 'PEMS00SOCFL', 2007000, 3, NULL, 'Sukses', '2020-01-28 10:17:09', '2020-01-29 04:54:11'),
(40, 'PEMS00A3YKU', 2007000, 3, NULL, 'Sukses', '2020-01-28 11:09:23', '2020-01-29 04:53:54'),
(41, 'PEMS00ZVIO2', 2207000, 3, NULL, 'Sukses', '2020-01-29 02:20:31', '2020-02-04 03:46:29'),
(42, 'PEMS00RIDG7', 1007000, 3, NULL, 'Sukses', '2020-01-29 03:31:08', '2020-01-29 04:52:46'),
(43, 'PEMS00EOH55', 2007000, 3, NULL, 'Sukses', '2020-02-04 09:25:57', '2020-02-04 09:27:29');

-- --------------------------------------------------------

--
-- Table structure for table `penumpangs`
--

CREATE TABLE `penumpangs` (
  `id_penumpang` int(10) UNSIGNED NOT NULL,
  `level` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `username` varchar(151) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(151) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_penumpang` varchar(151) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat_penumpang` varchar(151) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` varchar(151) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telepone` int(13) NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `penumpangs`
--

INSERT INTO `penumpangs` (`id_penumpang`, `level`, `username`, `password`, `nama_penumpang`, `alamat_penumpang`, `tanggal_lahir`, `jenis_kelamin`, `telepone`, `token`, `created_at`, `updated_at`) VALUES
(1, 'User', 'asdaa', '$2y$10$jt6kL0imlV5ik1wkbry1hegjX4YGiFA/320bjUFXfNdcCueWk.OZi', 'asdaa', 'asdaa', '2019-12-17', 'Perempuan', 123123123, 'u9A6lmiOP3aH5sTJjbT6LPcoZx1xSQ3JIK1BO6oWmimvXzzMTA5Yl7gAwFKI', '2019-12-02 02:43:12', '2020-01-17 03:56:59'),
(2, 'User', 'aaaaaaaaaa', '$2y$10$1fMQSdCEC6u.9BLLhchxgORyKILw6PCl.uy367TNyl9wYaWLYZK1m', 'aaaaaaaaaa', 'aaaaaaaaaa', '2020-01-07', 'Laki-Laki', 1234567890, 'CRrteAedhb9hTzH6Zp2utdRryBScCgONUwYbRQj9MXGrjTqp5jXObO6Z4FKM', '2020-01-09 01:51:59', '2020-01-09 01:51:59'),
(3, 'User', 'wasdwasd', '$2y$10$y8WHBxhEP2xwqtIMoJFoR.hMHGCL5lJvEXWTXwAbc3UqVD3J896QS', 'wasdwasd', 'alamatwasd', '2001-06-14', 'Laki-Laki', 85210123, 'n1zvdSOeYmcmFls4AGAOlUsecr4FAIdAP4On6u9sGSGxw4u1CdZ9QSaqs2Nx', '2020-01-15 07:31:36', '2020-02-06 15:51:59');

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `id_profile` int(10) UNSIGNED NOT NULL,
  `id_penumpang` int(11) NOT NULL,
  `email` varchar(151) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_ktp` int(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id_profile`, `id_penumpang`, `email`, `no_ktp`, `created_at`, `updated_at`) VALUES
(1, 3, 'admin@gmail.com', 12123123, '2020-01-15 15:44:56', '2020-01-15 15:45:13');

-- --------------------------------------------------------

--
-- Table structure for table `rutes`
--

CREATE TABLE `rutes` (
  `id_rute` int(10) UNSIGNED NOT NULL,
  `tujuan` varchar(151) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rute_awal` int(11) NOT NULL,
  `rute_akhir` int(11) NOT NULL,
  `nama_tempat_awal` varchar(151) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wilayah_awal` varchar(151) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_tempat_akhir` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wilayah_akhir` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_transportasi` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rutes`
--

INSERT INTO `rutes` (`id_rute`, `tujuan`, `rute_awal`, `rute_akhir`, `nama_tempat_awal`, `wilayah_awal`, `nama_tempat_akhir`, `wilayah_akhir`, `id_transportasi`, `created_at`, `updated_at`) VALUES
(37, 'dari Medan ke Bali', 3, 4, 'Kualanamu', 'Medan', 'I Gusti Ngurah Rai', 'Bali', 22, '2020-01-27 12:46:06', '2020-01-27 12:58:07'),
(38, 'Kalimantan', 9, 7, 'Kalimaru', 'Kalimantan Timur', 'Sepingan', 'Balikpapan', 23, '2020-01-27 12:58:26', '2020-01-27 12:58:26'),
(39, 'Malioboro', 14, 15, 'Gambir', 'DKI Jakarta', 'Yogyakarta', 'DIY Yogyakarta', 26, '2020-01-27 13:07:30', '2020-01-27 13:07:30'),
(40, 'Kota Kembang', 18, 16, 'Gubeng', 'Surabaya', 'Bandung Hall', 'Bandung', 27, '2020-01-27 13:07:53', '2020-01-27 13:07:53'),
(41, 'bnd', 18, 16, 'Gubeng', 'Surabaya', 'Bandung Hall', 'Bandung', 28, '2020-01-27 13:08:15', '2020-01-27 13:08:34');

-- --------------------------------------------------------

--
-- Table structure for table `tempats`
--

CREATE TABLE `tempats` (
  `id_tempat` int(10) UNSIGNED NOT NULL,
  `nama_tempat` varchar(151) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_tempat` varchar(151) COLLATE utf8mb4_unicode_ci NOT NULL,
  `wilayah` varchar(151) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipe_tempat` enum('Bandara','Statsiun') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tempats`
--

INSERT INTO `tempats` (`id_tempat`, `nama_tempat`, `kode_tempat`, `wilayah`, `tipe_tempat`, `created_at`, `updated_at`) VALUES
(3, 'Kualanamu', 'AIR9', 'Medan', 'Bandara', '2020-01-27 02:37:33', '2020-01-27 02:37:33'),
(4, 'I Gusti Ngurah Rai', 'AIR18', 'Bali', 'Bandara', '2020-01-27 02:37:53', '2020-01-27 02:37:53'),
(5, 'Djuanda', 'AIR7', 'Jawa Timur', 'Bandara', '2020-01-27 02:38:11', '2020-01-27 02:38:11'),
(6, 'Sultan Hassanudin', 'AIR17', 'Makassar', 'Bandara', '2020-01-27 02:38:40', '2020-01-27 02:38:40'),
(7, 'Sepingan', 'AIR8', 'Balikpapan', 'Bandara', '2020-01-27 02:38:55', '2020-01-27 02:38:55'),
(8, 'Samarinda Baru', 'AIR14', 'Samarinda', 'Bandara', '2020-01-27 02:39:12', '2020-01-27 02:39:12'),
(9, 'Kalimaru', 'AIR8', 'Kalimantan Timur', 'Bandara', '2020-01-27 02:39:33', '2020-01-27 02:39:33'),
(10, 'Ahmad Yani', 'AIR10', 'Semarang', 'Bandara', '2020-01-27 02:39:44', '2020-01-27 02:39:44'),
(12, 'Halim Perdanakusuma', 'AIR19', 'DKI Jakarta', 'Bandara', '2020-01-27 02:41:40', '2020-01-27 02:41:40'),
(13, 'Soekarno-Hatta', 'AIR14', 'DKI Jakarta', 'Bandara', '2020-01-27 02:43:42', '2020-01-27 02:43:42'),
(14, 'Gambir', 'STA6', 'DKI Jakarta', 'Statsiun', '2020-01-27 02:49:47', '2020-01-27 02:49:47'),
(15, 'Yogyakarta', 'STA10', 'DIY Yogyakarta', 'Statsiun', '2020-01-27 02:50:06', '2020-01-27 02:50:06'),
(16, 'Bandung Hall', 'STA12', 'Bandung', 'Statsiun', '2020-01-27 02:50:18', '2020-01-27 02:50:18'),
(17, 'Kuala Namu', 'STA10', 'Medan', 'Statsiun', '2020-01-27 02:50:32', '2020-01-27 02:50:32'),
(18, 'Gubeng', 'STA6', 'Surabaya', 'Statsiun', '2020-01-27 02:50:45', '2020-01-27 02:50:45'),
(19, 'Pasar Senen', 'STA11', 'DKI Jakarta', 'Statsiun', '2020-01-27 02:50:58', '2020-01-27 02:50:58'),
(21, 'Medan Kota', 'STA10', 'Medan', 'Statsiun', '2020-01-27 02:51:47', '2020-01-27 02:51:47');

-- --------------------------------------------------------

--
-- Table structure for table `tikets`
--

CREATE TABLE `tikets` (
  `id_tiket` int(11) NOT NULL,
  `id_jadwal` int(11) NOT NULL,
  `kode_pemesanan` varchar(255) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `kode_tiket` varchar(10) NOT NULL,
  `status` enum('Menunggu Pembayaran','Menunggu Konfirmasi User','Menunggu Konfirmasi Admin','Sukses','Dibatalkan') NOT NULL DEFAULT 'Menunggu Pembayaran',
  `qty` int(11) NOT NULL DEFAULT '1',
  `no_kursi` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tikets`
--

INSERT INTO `tikets` (`id_tiket`, `id_jadwal`, `kode_pemesanan`, `username`, `kode_tiket`, `status`, `qty`, `no_kursi`, `created_at`, `updated_at`) VALUES
(52, 17, 'PEMS00WK5Z3', 'wasdwasd', 'TIK1710', 'Sukses', 1, '10', '2020-02-03 03:50:13', '2020-02-03 03:50:13'),
(53, 16, 'PEMS00WK5Z3', 'wasdwasd', 'TIK1620', 'Sukses', 1, '20', '2020-02-03 03:50:13', '2020-02-03 03:50:13'),
(54, 16, 'PEMS003ABHN', 'wasdwasd', 'TIK1610', 'Sukses', 1, '10', '2020-02-04 02:17:04', '2020-02-04 02:17:04'),
(55, 16, 'PEMS003ABHN', 'wasdwasd', 'TIK1611', 'Sukses', 1, '11', '2020-02-04 02:17:04', '2020-02-04 02:17:04'),
(56, 17, 'PEMS00EKASN', 'wasdwasd', 'TIK1790', 'Sukses', 1, '90', '2020-01-30 14:17:35', '2020-01-30 14:17:35'),
(57, 17, 'PEMS00EKASN', 'wasdwasd', 'TIK1719', 'Sukses', 1, '19', '2020-01-30 14:17:35', '2020-01-30 14:17:35'),
(58, 16, 'PEMS00EKASN', 'wasdwasd', 'TIK1690', 'Sukses', 1, '90', '2020-01-30 14:17:35', '2020-01-30 14:17:35'),
(59, 16, 'PEMS00EKASN', 'wasdwasd', 'TIK166', 'Sukses', 1, '6', '2020-01-30 14:17:35', '2020-01-30 14:17:35'),
(60, 17, 'PEMS00SOCFL', 'wasdwasd', 'TIK172', 'Sukses', 1, '2', '2020-01-29 04:54:11', '2020-01-29 04:54:11'),
(61, 17, 'PEMS00SOCFL', 'wasdwasd', 'TIK1799', 'Sukses', 1, '99', '2020-01-29 04:54:11', '2020-01-29 04:54:11'),
(62, 17, 'PEMS00A3YKU', 'wasdwasd', 'TIK170', 'Sukses', 1, '0', '2020-01-29 04:53:53', '2020-01-29 04:53:53'),
(63, 17, 'PEMS00A3YKU', 'wasdwasd', 'TIK17-1', 'Sukses', 1, '-1', '2020-01-29 04:53:53', '2020-01-29 04:53:53'),
(64, 17, 'PEMS00ZVIO2', 'wasdwasd', 'TIK171', 'Sukses', 1, '1', '2020-02-04 03:46:29', '2020-02-04 03:46:29'),
(65, 16, 'PEMS00ZVIO2', 'wasdwasd', 'TIK169', 'Sukses', 1, '9', '2020-02-04 03:46:29', '2020-02-04 03:46:29'),
(66, 17, 'PEMS00RIDG7', 'wasdwasd', 'TIK1760', 'Sukses', 1, '60', '2020-01-12 04:52:46', '2020-01-29 04:52:46'),
(67, 17, 'PEMS00EOH55', 'wasdwasd', 'TIK1770', 'Sukses', 1, '70', '2020-02-04 09:27:29', '2020-02-04 09:27:29'),
(68, 17, 'PEMS00EOH55', 'wasdwasd', 'TIK1777', 'Sukses', 1, '77', '2020-02-04 09:27:29', '2020-02-04 09:27:29'),
(69, 16, NULL, 'wasdwasd', 'TIK1601', 'Menunggu Pembayaran', 1, '01', '2020-02-04 10:02:22', '2020-02-04 10:02:22');

-- --------------------------------------------------------

--
-- Table structure for table `transportasis`
--

CREATE TABLE `transportasis` (
  `id_transportasi` int(10) UNSIGNED NOT NULL,
  `kode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah_kursi` int(11) NOT NULL,
  `keterangan` varchar(151) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_type_transportasi` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transportasis`
--

INSERT INTO `transportasis` (`id_transportasi`, `kode`, `jumlah_kursi`, `keterangan`, `id_type_transportasi`, `created_at`, `updated_at`) VALUES
(11, '1212', 100, 'eksekutif', 10, '2019-12-01 03:57:05', '2019-12-01 03:57:05'),
(12, '1111', 200, 'ekonomi c', 11, '2019-12-01 03:57:19', '2019-12-01 03:57:19'),
(14, '1313', 250, 'manifest', 8, '2019-12-01 04:17:20', '2019-12-01 04:17:20'),
(16, '5555', 200, 'depart', 9, '2019-12-01 05:06:44', '2019-12-01 05:06:44'),
(19, '123142', 100, 'ekonomi', 8, '2020-01-10 12:53:12', '2020-01-10 12:53:12'),
(20, 'boeing 77', 100, 'Ekonomi', 12, '2020-01-17 01:48:00', '2020-01-17 01:48:19'),
(21, 'meong 5', 200, 'Bisnis', 13, '2020-01-17 01:52:37', '2020-01-17 01:52:37'),
(22, 'GI100', 200, 'Eksekutif', 14, '2020-01-17 13:33:07', '2020-01-17 13:33:07'),
(23, 'C523', 300, 'Ekonomi', 15, '2020-01-17 13:33:33', '2020-01-17 13:33:33'),
(24, 'GI123', 200, 'Bisnis', 14, '2020-01-17 13:33:52', '2020-01-17 13:33:52'),
(25, 'AA12', 150, 'Ekonomi', 18, '2020-01-17 13:34:14', '2020-01-17 13:34:14'),
(26, 'AW123', 300, 'Bisnis', 25, '2020-01-17 13:43:35', '2020-01-17 13:43:35'),
(27, 'ABA321', 250, 'Ekonomi', 30, '2020-01-17 13:44:11', '2020-01-17 13:44:11'),
(28, 'AW231', 250, 'Ekonomi', 25, '2020-01-17 13:44:42', '2020-01-17 13:44:42');

-- --------------------------------------------------------

--
-- Table structure for table `type_transportasis`
--

CREATE TABLE `type_transportasis` (
  `id_type_transportasi` int(10) UNSIGNED NOT NULL,
  `nama_type` varchar(151) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(151) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `type_transportasis`
--

INSERT INTO `type_transportasis` (`id_type_transportasi`, `nama_type`, `keterangan`, `created_at`, `updated_at`) VALUES
(14, 'Pesawat', 'Garuda Indonesia', '2020-01-17 13:30:23', '2020-01-17 13:30:23'),
(15, 'Pesawat', 'Citilink', '2020-01-17 13:30:35', '2020-01-17 13:30:35'),
(16, 'Pesawat', 'Sriwijaya Air', '2020-01-17 13:31:01', '2020-01-17 13:31:01'),
(17, 'Pesawat', 'Lion Air', '2020-01-17 13:31:12', '2020-01-17 13:31:12'),
(18, 'Pesawat', 'Air Asia', '2020-01-17 13:31:21', '2020-01-17 13:31:21'),
(19, 'Pesawat', 'Batik Air', '2020-01-17 13:31:32', '2020-01-17 13:31:32'),
(20, 'Pesawat', 'Wings Air', '2020-01-17 13:31:40', '2020-01-17 13:31:40'),
(21, 'Pesawat', 'NAM Air', '2020-01-17 13:31:50', '2020-01-17 13:31:50'),
(22, 'Pesawat', 'Xpress Air', '2020-01-17 13:32:00', '2020-01-17 13:32:00'),
(23, 'Pesawat', 'Kalstar Aviation', '2020-01-17 13:32:13', '2020-01-17 13:32:13'),
(24, 'Kereta', 'Argo Parahyangan', '2020-01-17 13:41:47', '2020-01-17 13:41:47'),
(25, 'Kereta', 'Argo Wilis', '2020-01-17 13:41:59', '2020-01-17 13:41:59'),
(26, 'Kereta', 'Argo Dwipangga', '2020-01-17 13:42:10', '2020-01-17 13:42:10'),
(27, 'Kereta', 'Argo Lawu', '2020-01-17 13:42:17', '2020-01-17 13:42:17'),
(28, 'Kereta', 'Argo Sindoro', '2020-01-17 13:42:25', '2020-01-17 13:42:25'),
(29, 'Kereta', 'Argo Muria', '2020-01-17 13:42:34', '2020-01-17 13:42:34'),
(30, 'Kereta', 'Argo Bromo Anggrek', '2020-01-17 13:42:41', '2020-01-17 13:42:41'),
(31, 'Kereta', 'Argo Jati', '2020-01-17 13:42:55', '2020-01-17 13:42:55');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `level` enum('admin','operator') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'operator',
  `username` varchar(151) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(151) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `level`, `username`, `first_name`, `password`, `last_name`, `remember_token`, `created_at`, `updated_at`) VALUES
(9, 'admin', 'anigato', 'khoerul', '$2y$10$rkS.jG9fDf8faoBdRjq/3Ovlf1IqNlB.jjNd3kny3McAppUm7PuJ6', 'anam', 'dcbdKRSbAvFyOA0q8ujxyJPGPN2sBebQzKzctgs5jrhaZuEqGuVBpP19G1rF', '2020-01-05 01:41:52', '2020-02-07 00:26:38'),
(10, 'admin', 'balalala', 'balalala', '$2y$10$OZkrbq1eXgzzBAAZDh0qP.F6WTQATHe0oMEuRSZXMlMuUusxjo.Tq', 'balalala', 'uXWVWE2ZiTzeWOwTKpsxqBhtbJq84HyalPwwqwA699Wvh0ZxFrKiC99Cv7Tv', '2020-01-10 12:04:42', '2020-02-06 16:02:09'),
(11, 'operator', 'anamlagi', 'anam', '$2y$10$wx/B4VzBenPVxTPV6jhXA.r8ZWWyr74FEVVQqpsPzNTqkttkhuWoa', 'saja', 'jtU5j5jN3LSkYSoL1LvhHVmRtxAFpVDDd6e6WBySspfTT7IsMdDDZOrVSSiP', '2020-01-20 03:38:01', '2020-01-28 00:30:50'),
(12, 'operator', 'sanjaya', 'sanjaya', '$2y$10$n2twmGcPFzw96WbhAvODYuIICOmsY42eJF.I.8UVsj09ZyfqMsFJ.', 'aji', 'L5r4J9BBwe1C05LimRfaZvsnAFTOQshe491REvvXLeFvk65PmNR4DuHIhg19', '2020-02-06 06:36:47', '2020-02-06 06:36:47'),
(13, 'operator', 'wasdwasd', 'wasdwasd', '$2y$10$VTxaA03lNFiqB6Kbzu8PterA7cSnSqXCdtfJC6XO4u9/vA0mrTM7a', 'wasdwasd', 'lTbLoYR3MaimsKqUFuGHqLaaJuS32a5blNCPo8zloZKfk4eZLmlnzYaOS8tf', '2020-02-06 06:56:20', '2020-02-06 15:55:49');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_pemesanans`
--
ALTER TABLE `detail_pemesanans`
  ADD PRIMARY KEY (`id_detail`);

--
-- Indexes for table `diskons`
--
ALTER TABLE `diskons`
  ADD PRIMARY KEY (`id_diskon`);

--
-- Indexes for table `drivers`
--
ALTER TABLE `drivers`
  ADD PRIMARY KEY (`id_driver`);

--
-- Indexes for table `identitass`
--
ALTER TABLE `identitass`
  ADD PRIMARY KEY (`id_identitas`);

--
-- Indexes for table `jadwals`
--
ALTER TABLE `jadwals`
  ADD PRIMARY KEY (`id_jadwal`);

--
-- Indexes for table `konfirmasi_pemesanans`
--
ALTER TABLE `konfirmasi_pemesanans`
  ADD PRIMARY KEY (`id_konfirmasi`);

--
-- Indexes for table `levels`
--
ALTER TABLE `levels`
  ADD PRIMARY KEY (`id_level`);

--
-- Indexes for table `login_tokens`
--
ALTER TABLE `login_tokens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pemesanans`
--
ALTER TABLE `pemesanans`
  ADD PRIMARY KEY (`id_pemesanan`),
  ADD UNIQUE KEY `kode_pemesanan` (`kode_pemesanan`);

--
-- Indexes for table `penumpangs`
--
ALTER TABLE `penumpangs`
  ADD PRIMARY KEY (`id_penumpang`),
  ADD UNIQUE KEY `penumpangs_telepone_unique` (`telepone`);

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id_profile`),
  ADD UNIQUE KEY `id_penumpang` (`id_penumpang`);

--
-- Indexes for table `rutes`
--
ALTER TABLE `rutes`
  ADD PRIMARY KEY (`id_rute`);

--
-- Indexes for table `tempats`
--
ALTER TABLE `tempats`
  ADD PRIMARY KEY (`id_tempat`);

--
-- Indexes for table `tikets`
--
ALTER TABLE `tikets`
  ADD PRIMARY KEY (`id_tiket`);

--
-- Indexes for table `transportasis`
--
ALTER TABLE `transportasis`
  ADD PRIMARY KEY (`id_transportasi`);

--
-- Indexes for table `type_transportasis`
--
ALTER TABLE `type_transportasis`
  ADD PRIMARY KEY (`id_type_transportasi`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_pemesanans`
--
ALTER TABLE `detail_pemesanans`
  MODIFY `id_detail` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `diskons`
--
ALTER TABLE `diskons`
  MODIFY `id_diskon` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `drivers`
--
ALTER TABLE `drivers`
  MODIFY `id_driver` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `identitass`
--
ALTER TABLE `identitass`
  MODIFY `id_identitas` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jadwals`
--
ALTER TABLE `jadwals`
  MODIFY `id_jadwal` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `konfirmasi_pemesanans`
--
ALTER TABLE `konfirmasi_pemesanans`
  MODIFY `id_konfirmasi` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `levels`
--
ALTER TABLE `levels`
  MODIFY `id_level` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `login_tokens`
--
ALTER TABLE `login_tokens`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `pemesanans`
--
ALTER TABLE `pemesanans`
  MODIFY `id_pemesanan` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `penumpangs`
--
ALTER TABLE `penumpangs`
  MODIFY `id_penumpang` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id_profile` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `rutes`
--
ALTER TABLE `rutes`
  MODIFY `id_rute` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `tempats`
--
ALTER TABLE `tempats`
  MODIFY `id_tempat` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tikets`
--
ALTER TABLE `tikets`
  MODIFY `id_tiket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `transportasis`
--
ALTER TABLE `transportasis`
  MODIFY `id_transportasi` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `type_transportasis`
--
ALTER TABLE `type_transportasis`
  MODIFY `id_type_transportasi` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
