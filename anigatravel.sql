-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 11, 2020 at 05:54 AM
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
  `no_ktp` bigint(50) NOT NULL,
  `no_sim` bigint(50) NOT NULL,
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
(9, 'Khoerul', 1640986544, 998, 24, '2020-01-29 02:58:50', '2020-01-29 02:58:50'),
(16, 'dwadad12', 12312312, 2131231, 26, '2020-02-08 12:04:09', '2020-02-08 12:04:09');

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
(17, 38, '1000000', '12:01:00', '2020-12-12', '12:12:00', '2020-12-12', '2020-01-28 01:05:25', '2020-01-28 01:13:08'),
(18, 42, '1500000', '00:12:00', '2020-12-12', '12:12:00', '2020-12-12', '2020-02-07 23:41:40', '2020-02-07 23:41:40'),
(21, 43, '5400000', '00:12:00', '2020-12-12', '12:31:00', '2020-03-12', '2020-02-07 23:48:30', '2020-02-07 23:48:30'),
(22, 45, '1250000', '13:21:00', '2020-12-12', '13:23:00', '2020-12-31', '2020-02-08 00:43:52', '2020-02-08 15:09:50'),
(23, 41, '500000', '03:12:00', '2020-12-12', '02:13:00', '2020-02-02', '2020-02-08 00:44:36', '2020-02-08 00:44:36'),
(24, 45, '100000', '00:12:00', '2020-12-12', '03:12:00', '2021-12-12', '2020-02-08 15:05:39', '2020-02-08 15:05:39'),
(25, 44, '1500000', '00:31:00', '2020-12-12', '00:12:00', '2021-12-04', '2020-02-08 15:06:12', '2020-02-08 15:06:12'),
(26, 44, '120000', '12:31:00', '2020-12-12', '03:12:00', '2021-12-21', '2020-02-08 15:11:23', '2020-02-08 15:11:23'),
(27, 49, '1250000', '05:14:00', '2020-12-12', '02:11:00', '2020-12-13', '2020-02-13 00:48:33', '2020-02-13 00:48:33'),
(28, 50, '500000', '00:12:00', '2020-12-12', '14:13:00', '2021-04-11', '2020-02-13 00:52:59', '2020-02-13 00:52:59'),
(29, 50, '1200000', '02:12:00', '2020-12-12', '15:12:00', '2021-12-03', '2020-02-13 01:47:57', '2020-02-13 01:48:44'),
(30, 49, '540000', '00:31:00', '2020-12-12', '02:14:00', '2020-12-15', '2020-02-13 01:50:51', '2020-02-13 01:50:51'),
(31, 48, '1500000', '11:11:00', '2020-03-25', '15:30:00', '2020-03-25', '2020-03-27 07:30:42', '2020-03-27 07:30:42'),
(32, 38, '1000000', '05:06:00', '2020-03-28', '11:06:00', '2020-03-28', '2020-03-27 07:32:12', '2020-03-27 07:32:12'),
(33, 41, '300000', '12:12:00', '2020-03-29', '05:09:00', '2020-03-30', '2020-03-27 07:34:20', '2020-03-27 07:34:20'),
(34, 45, '1000000', '12:12:00', '2020-09-20', '03:15:00', '2020-09-21', '2020-09-11 03:36:52', '2020-09-11 03:36:52');

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
(22, 'PEMS00EOH55', '1580808395_5e3938cb5f3f0.jpg', '245|300|500', 'C:\\xampp\\htdocs\\anigatravel\\storage\\app/public/images', '2020-02-04 09:26:35', '2020-02-04 09:26:35'),
(23, 'PEMS00CIVT1', '1581174758_5e3ecfe66bcc4.png', '245|300|500', 'C:\\xampp\\htdocs\\anigatravel\\storage\\app/public/images', '2020-02-08 15:12:42', '2020-02-08 15:12:42'),
(24, 'PEMS00IRL8Y', '1581177515_5e3edaab7d924.jpg', '245|300|500', 'C:\\xampp\\htdocs\\anigatravel\\storage\\app/public/images', '2020-02-08 15:58:37', '2020-02-08 15:58:37'),
(25, 'PEMS00WU8G8', '1581178728_5e3edf68aa6b1.jpg', '245|300|500', 'C:\\xampp\\htdocs\\anigatravel\\storage\\app/public/images', '2020-02-08 16:18:49', '2020-02-08 16:18:49'),
(26, 'PEMS00LQQR0', '1581404506_5e42515a7c8f8.jpg', '245|300|500', 'C:\\xampp\\htdocs\\anigatravel\\storage\\app/public/images', '2020-02-11 07:01:48', '2020-02-11 07:01:48'),
(30, 'PEMS00V9O9B', '1581409505_5e4264e12e974.png', '245|300|500', 'C:\\xampp\\htdocs\\anigatravel\\storage\\app/public/images', '2020-02-11 08:25:05', '2020-02-11 08:25:05'),
(31, 'PEMS00OPUCC', '1581462765_5e4334ed5c737.jpg', '245|300|500', 'C:\\xampp\\htdocs\\anigatravel\\storage\\app/public/images', '2020-02-11 23:12:47', '2020-02-11 23:12:47'),
(32, 'PEMS001TIYH', '1581473558_5e435f168ae90.jpg', '245|300|500', 'C:\\xampp\\htdocs\\anigatravel\\storage\\app/public/images', '2020-02-11 23:15:25', '2020-02-12 02:12:40'),
(33, 'PEMS00LRHYP', '1581482755_5e4383034da4a.jpg', '245|300|500', 'C:\\xampp\\htdocs\\anigatravel\\storage\\app/public/images', '2020-02-12 04:45:56', '2020-02-12 04:45:56'),
(34, 'PEMS00SCKHY', '1581512401_5e43f6d1e743c.jpg', '245|300|500', 'C:\\xampp\\htdocs\\anigatravel\\storage\\app/public/images', '2020-02-12 12:58:47', '2020-02-12 13:00:03'),
(35, 'PEMS00G8R0H', '1581512586_5e43f78a27bf3.jpg', '245|300|500', 'C:\\xampp\\htdocs\\anigatravel\\storage\\app/public/images', '2020-02-12 13:03:09', '2020-02-12 13:03:09'),
(36, 'PEMS00DMAP9', '1581513586_5e43fb723b79f.png', '245|300|500', 'C:\\xampp\\htdocs\\anigatravel\\storage\\app/public/images', '2020-02-12 13:19:48', '2020-02-12 13:19:48'),
(37, 'PEMS00KYLKX', '1581751750_5e479dc6d3162.png', '245|300|500', 'C:\\xampp\\htdocs\\anigatravel\\storage\\app/public/images', '2020-02-15 07:29:14', '2020-02-15 07:29:14'),
(38, 'PEMS003R3FY', '1581811884_5e4888ac97c10.png', '245|300|500', 'C:\\xampp\\htdocs\\anigatravel\\storage\\app/public/images', '2020-02-16 00:11:27', '2020-02-16 00:11:27'),
(39, 'PEMS00FIYZQ', '1581811923_5e4888d34cf77.jpg', '245|300|500', 'C:\\xampp\\htdocs\\anigatravel\\storage\\app/public/images', '2020-02-16 00:12:03', '2020-02-16 00:12:03'),
(40, 'PEMS00HIQ7F', '1581811944_5e4888e878ea5.jpg', '245|300|500', 'C:\\xampp\\htdocs\\anigatravel\\storage\\app/public/images', '2020-02-16 00:12:25', '2020-02-16 00:12:25'),
(41, 'PEMS00FFZDR', '1581848230_5e4916a60dbf9.jpg', '245|300|500', 'C:\\xampp\\htdocs\\anigatravel\\storage\\app/public/images', '2020-02-16 10:17:12', '2020-02-16 10:17:12'),
(42, 'PEMS00I38SQ', '1581851599_5e4923cfe2c41.png', '245|300|500', 'C:\\xampp\\htdocs\\anigatravel\\storage\\app/public/images', '2020-02-16 11:13:22', '2020-02-16 11:13:22'),
(43, 'PEMS002SO8A', '1581856156_5e49359c5c20d.jpg', '245|300|500', 'C:\\xampp\\htdocs\\anigatravel\\storage\\app/public/images', '2020-02-16 12:28:20', '2020-02-16 12:29:18'),
(44, 'PEMS00KSRWG', '1582973257_5e5a41497e101.png', '245|300|500', 'C:\\xampp\\htdocs\\anigatravel\\storage\\app/public/images', '2020-02-18 03:04:50', '2020-02-29 10:47:39'),
(45, 'PEMS00T9D9J', '1582333612_5e507eac6486f.jpg', '245|300|500', 'C:\\xampp\\htdocs\\anigatravel\\storage\\app/public/images', '2020-02-22 01:06:54', '2020-02-22 01:06:54'),
(46, 'PEMS0099XEX', '1582334872_5e508398f14c6.jpg', '245|300|500', 'C:\\xampp\\htdocs\\anigatravel\\storage\\app/public/images', '2020-02-22 01:27:54', '2020-02-22 01:27:54'),
(47, 'PEMS00TOI92', '1582973351_5e5a41a79115e.png', '245|300|500', 'C:\\xampp\\htdocs\\anigatravel\\storage\\app/public/images', '2020-02-29 10:49:12', '2020-02-29 10:49:12'),
(48, 'PEMS00YGT9T', '1583076275_5e5bd3b32b87b.png', '245|300|500', 'C:\\xampp\\htdocs\\anigatravel\\storage\\app/public/images', '2020-03-01 15:24:35', '2020-03-01 15:24:35'),
(49, 'PEMS00TTQH5', '1583076392_5e5bd42859ef3.png', '245|300|500', 'C:\\xampp\\htdocs\\anigatravel\\storage\\app/public/images', '2020-03-01 15:26:32', '2020-03-01 15:26:32'),
(50, 'PEMS00QNIB1', '1583477648_5e61f39030108.png', '245|300|500', 'C:\\xampp\\htdocs\\anigatravel\\storage\\app/public/images', '2020-03-06 06:51:40', '2020-03-06 06:54:11'),
(51, 'PEMS00OPFZ3', '1583598129_5e63ca3104ae3.png', '245|300|500', 'C:\\xampp\\htdocs\\anigatravel\\storage\\app/public/images', '2020-03-07 16:22:10', '2020-03-07 16:22:10'),
(52, 'PEMS00TGP3J', '1585108035_5e7ad443e5240.jpg', '245|300|500', 'C:\\xampp\\htdocs\\anigatravel\\storage\\app/public/images', '2020-03-25 03:47:16', '2020-03-25 03:47:16'),
(53, 'PEMS00UYCOZ', '1585296286_5e7db39eb2a04.png', '245|300|500', 'C:\\xampp\\htdocs\\anigatravel\\storage\\app/public/images', '2020-03-27 08:03:36', '2020-03-27 08:04:50'),
(54, 'PEMS00HU82R', '1585306410_5e7ddb2a26fb5.png', '245|300|500', 'C:\\xampp\\htdocs\\anigatravel\\storage\\app/public/images', '2020-03-27 10:53:31', '2020-03-27 10:53:31'),
(55, 'PEMS000X8TL', '1599795741_5f5af21daf178.png', '245|300|500', 'C:\\xampp\\htdocs\\Project\\Ujikom\\anigatravel\\storage\\app/public/images', '2020-09-11 03:41:42', '2020-09-11 03:42:29');

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
  `status` enum('Menunggu Konfirmasi User','Menunggu Konfirmasi Admin','Sukses','Batal') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Menunggu Konfirmasi User',
  `ket_batal` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pemesanans`
--

INSERT INTO `pemesanans` (`id_pemesanan`, `kode_pemesanan`, `total`, `id_penumpang`, `id_petugas`, `status`, `ket_batal`, `created_at`, `updated_at`) VALUES
(44, 'PEMS00CIVT1', 1377000, 3, NULL, 'Sukses', NULL, '2020-02-08 15:11:59', '2020-02-08 15:13:07'),
(45, 'PEMS00WU8G8', 1257000, 3, NULL, 'Sukses', NULL, '2020-02-08 15:32:36', '2020-02-11 07:02:48'),
(46, 'PEMS00IRL8Y', 127000, 3, NULL, 'Sukses', NULL, '2020-02-08 15:58:11', '2020-02-09 03:23:24'),
(47, 'PEMS00H5EI9', 2507000, 5, NULL, 'Menunggu Konfirmasi User', NULL, '2020-02-02 00:44:15', '2020-02-11 00:44:15'),
(48, 'PEMS00D2C0A', 1257000, 6, NULL, 'Menunggu Konfirmasi User', NULL, '2020-02-02 01:06:03', '2020-02-11 01:06:03'),
(49, 'PEMS00OPUCC', 6107000, 3, 10, 'Sukses', NULL, '2020-01-26 02:09:55', '2020-02-14 14:34:34'),
(50, 'PEMS001TIYH', 107000, 3, 9, 'Batal', 'transaksi tidak sesuai', '2020-01-26 03:10:51', '2020-02-12 03:16:14'),
(51, 'PEMS00CP1I8', 107000, 8, NULL, 'Menunggu Konfirmasi User', NULL, '2020-02-11 04:35:59', '2020-02-11 04:35:59'),
(52, 'PEMS00LQQR0', 1257000, 10, NULL, 'Sukses', NULL, '2020-02-11 07:00:33', '2020-02-11 07:03:12'),
(57, 'PEMS00V9O9B', 127000, 10, 9, 'Batal', 'gambar burk', '2020-02-11 08:23:34', '2020-02-12 03:18:09'),
(58, 'PEMS00HIQ7F', 1377000, 3, 10, 'Sukses', NULL, '2020-02-12 02:13:12', '2020-02-16 00:15:58'),
(59, 'PEMS00TTQH5', 107000, 10, 9, 'Sukses', NULL, '2020-02-12 03:29:31', '2020-03-01 15:27:14'),
(60, 'PEMS00LRHYP', 1507000, 11, 9, 'Sukses', NULL, '2020-02-12 04:45:14', '2020-02-12 04:46:31'),
(61, 'PEMS00SCKHY', 207000, 12, 13, 'Sukses', NULL, '2020-02-12 12:57:32', '2020-02-12 13:00:24'),
(62, 'PEMS00G8R0H', 1507000, 12, 13, 'Batal', 'silahkan cek lagi.. fotonya salah', '2020-02-12 13:02:12', '2020-02-12 13:03:42'),
(63, 'PEMS00DMAP9', 1507000, 12, 13, 'Sukses', NULL, '2020-02-12 13:19:21', '2020-02-12 13:20:26'),
(64, 'PEMS00FIYZQ', 4667000, 3, 10, 'Sukses', NULL, '2020-02-14 01:03:12', '2020-02-16 00:15:50'),
(65, 'PEMS00KYLKX', 1257000, 10, 10, 'Sukses', NULL, '2020-02-15 07:27:24', '2020-02-16 00:15:41'),
(66, 'PEMS003R3FY', 1707000, 3, 10, 'Sukses', NULL, '2020-02-16 00:11:00', '2020-02-16 00:15:31'),
(67, 'PEMS00FFZDR', 1507000, 11, 10, 'Batal', 'error', '2020-02-16 10:11:22', '2020-02-16 11:10:08'),
(68, 'PEMS00I38SQ', 2407000, 11, 10, 'Batal', 'lorem ipsum dollor sit amet lorem ipsum dollor sit amet lorem ipsum dollor sit amet lorem ipsum dollor sit amet lorem ipsum dollor sit amet lorem ipsum dollor sit amet lorem ipsum dollor sit amet lorem ipsum dollor sit amet lorem ipsum dollor sit amet lorem ipsum dollor sit amet lorem ipsum dollor sit amet', '2020-02-16 10:19:58', '2020-02-16 11:14:05'),
(69, 'PEMS00T9D9J', 2407000, 11, 9, 'Sukses', NULL, '2020-02-16 12:26:52', '2020-02-22 14:18:05'),
(70, 'PEMS002SO8A', 1747000, 11, 9, 'Sukses', NULL, '2020-02-16 12:28:00', '2020-03-06 04:04:00'),
(71, 'PEMS0099XEX', 6157000, 11, 9, 'Sukses', NULL, '2020-02-16 13:54:00', '2020-03-01 14:12:09'),
(72, 'PEMS00KSRWG', 507000, 3, 9, 'Sukses', NULL, '2020-02-18 03:02:58', '2020-03-01 14:12:02'),
(73, 'PEMS002DKNG', 1257000, 11, NULL, 'Menunggu Konfirmasi User', NULL, '2020-02-21 15:42:02', '2020-02-21 15:42:02'),
(74, 'PEMS00RKAI2', 547000, 11, NULL, 'Menunggu Konfirmasi User', NULL, '2020-02-21 23:57:00', '2020-02-21 23:57:00'),
(75, 'PEMS00TGP3J', 3537000, 3, 9, 'Sukses', NULL, '2020-02-22 11:46:43', '2020-03-25 04:26:50'),
(76, 'PEMS00TOI92', 1207000, 3, 9, 'Sukses', NULL, '2020-02-29 09:56:26', '2020-03-01 14:11:51'),
(77, 'PEMS00OPFZ3', 547000, 3, 9, 'Sukses', NULL, '2020-03-01 15:21:09', '2020-03-25 03:49:26'),
(78, 'PEMS00YGT9T', 1207000, 3, 9, 'Sukses', NULL, '2020-03-01 15:24:01', '2020-03-01 15:25:03'),
(79, 'PEMS00QNIB1', 1007000, 17, 9, 'Sukses', NULL, '2020-03-06 06:49:11', '2020-03-06 07:02:56'),
(80, 'PEMS00ONRHC', 7317000, 3, NULL, 'Menunggu Konfirmasi User', NULL, '2020-03-25 03:46:46', '2020-03-25 03:46:46'),
(81, 'PEMS00UYCOZ', 1087000, 18, 9, 'Sukses', NULL, '2020-03-27 08:02:01', '2020-03-27 10:51:45'),
(82, 'PEMS00HU82R', 507000, 18, 9, 'Batal', 'gambar tidak sesuai', '2020-03-27 10:53:13', '2020-03-27 11:54:29'),
(83, 'PEMS000X8TL', 1007000, 19, 9, 'Sukses', NULL, '2020-09-11 03:41:05', '2020-09-11 03:44:36');

-- --------------------------------------------------------

--
-- Table structure for table `penumpangs`
--

CREATE TABLE `penumpangs` (
  `id_penumpang` int(10) UNSIGNED NOT NULL,
  `level` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `username` varchar(151) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(151) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_penumpang` varchar(151) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat_penumpang` text COLLATE utf8mb4_unicode_ci,
  `tanggal_lahir` date DEFAULT NULL,
  `jenis_kelamin` varchar(151) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telepone` char(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `penumpangs`
--

INSERT INTO `penumpangs` (`id_penumpang`, `level`, `username`, `password`, `nama_penumpang`, `alamat_penumpang`, `tanggal_lahir`, `jenis_kelamin`, `telepone`, `token`, `created_at`, `updated_at`) VALUES
(1, 'User', 'asdaa', '$2y$10$jt6kL0imlV5ik1wkbry1hegjX4YGiFA/320bjUFXfNdcCueWk.OZi', 'asdaa', 'asdaa', '2019-12-17', 'Perempuan', '123123123', 'u9A6lmiOP3aH5sTJjbT6LPcoZx1xSQ3JIK1BO6oWmimvXzzMTA5Yl7gAwFKI', '2019-12-02 02:43:12', '2020-01-17 03:56:59'),
(2, 'User', 'aaaaaaaaaa', '$2y$10$1fMQSdCEC6u.9BLLhchxgORyKILw6PCl.uy367TNyl9wYaWLYZK1m', 'aaaaaaaaaa', 'aaaaaaaaaa', '2020-01-07', 'Laki-Laki', '1234567890', 'CRrteAedhb9hTzH6Zp2utdRryBScCgONUwYbRQj9MXGrjTqp5jXObO6Z4FKM', '2020-01-09 01:51:59', '2020-01-09 01:51:59'),
(3, 'User', 'wasdwasd', '$2y$10$y8WHBxhEP2xwqtIMoJFoR.hMHGCL5lJvEXWTXwAbc3UqVD3J896QS', 'wasdwasd', 'alamatwasd', '2001-06-14', 'Laki-Laki', '852101231234', '5GlHVWA4Y7of9lh9B30MNCNL853nOzsrrGbEmQVtPm1k2b1hp6LNx5qLoRbG', '2020-01-15 07:31:36', '2020-03-25 03:18:55'),
(4, 'user', 'ibusiti', '$2y$10$MhRlVXoBuhNYrz..USsAcO1KwKdbFBBHtIi1.K9Lg/yYbP85M2cEy', 'ibusiti', 'diah', '1978-12-12', 'Perempuan', '852106620', 'zj50AnYUPploDah15HaRfQ5gIHOvhLX6v9nJFNgB1owyWpj0wcDD2TJV2ZsW', '2020-02-10 03:41:32', '2020-02-10 03:41:32'),
(5, 'user', 'usernamenya', '$2y$10$r9HlwlkYqcignq1fKgng3.wGXosyFGuAEDEawPCsjkQLi70zWO/4y', 'user name nya', 'user  name nya ada dimana', '2020-12-12', 'Perempuan', '123456789012', 'zwb0VY1d4cKJEaTnOrYvmSinbj8lp1L4wQo7LUU2AbHa9ZUq7oyjnmsSuUPn', '2020-02-10 04:04:06', '2020-02-28 11:50:16'),
(6, 'user', 'usersatu', '$2y$10$f7ks7rDUDCUW0x9KM8yHQ.0ZtpyPfsOo8CJQDX4O0sOPd/kgfmOb6', 'usersatu dua tiga', 'usersatu dua tiga empat', '2020-12-12', 'Laki-Laki', '085124121213', 'RgXERXf0xqJyG7PJSgeatyfFBAJwLE35Eot9QhfPhNYyp7CzZ09AX3zDHKZl', '2020-02-11 01:01:30', '2020-02-11 01:05:29'),
(8, 'user', 'papazola', '$2y$10$S5m0b0CRxTXG1XYiSkTqYOwCH6.8PDL4zuiCYHCfXF86VaHb4dQf.', 'papa pipi zola', 'pulau rintis', '2000-02-02', 'Laki-Laki', '085225263753', 'vM0l4iCUGSR4SMBULX1GY0jcA4Fcz1YTmm2G9FfAtwUQqJi7FhSwnZomNI8C', '2020-02-11 04:30:03', '2020-02-11 04:34:34'),
(9, 'user', 'userdua', '$2y$10$3Edkkc4.oTMjEtTOsYpHpudXmSu2AGE9t89fk85pW2hIR7lcSYeQ.', 'user dua tiga', 'null', '2000-02-02', 'null', 'null', 'NQDFCipq1c3NG401ywEgXXz5g6FowznZ2Z75dqV6U809i15M7QOP85tem1nc', '2020-02-11 06:29:57', '2020-02-11 06:29:57'),
(10, 'user', 'usertiga', '$2y$10$BYsB9rmSM6eclNSdfKCRveQNIvHhqy6/wR8FYjmcnsrPsIrhcnxei', 'user tiga', 'alamatnya panjang sekali', '2000-02-02', 'Perempuan', '085225263753', 'NKFGvtlmwUmocgwbGJ8jABL7Sv9l8inZLnIvuj8AOcBFcP2JIWSp8HRGLWbr', '2020-02-11 06:31:46', '2020-03-01 15:26:11'),
(11, 'user', 'userempat', '$2y$10$O1Q0IUnX0RZXH0A8G32l6Og7TRochlkAJKDL.HpJWH6GiB/Dhimhi', 'user empat lima enam tjh', 'Jalan Irigasi, Dusun Sukajadi, RT 33, RW 08, Desa Sukanagara, Kecamatan Padaherang, Kabupaten Pangandaran, Provinsi Jawa Barat, Indonesia, Asia Tenggara, ASIA, Bumi, Bima Sakti, 46384', NULL, 'Laki-Laki', '08885323801', 'TyofDzIcZFJELnll3Bs3MHDfpdSGeMOPJrLTDVDHx0aoACotm1phUaonFUZ9', '2020-02-12 04:27:29', '2020-03-05 12:26:57'),
(12, 'user', 'mamazila', '$2y$10$f0TvuL4ia4COilB7WcJl.ePa/3ox2fthGgoDZ5hsjZVw7XOsXKhc2', 'mama zila', 'mama zila ada si game papa zola 5', NULL, 'Perempuan', '12345678901', 'TqY5mohDcZ9LQbnTj0ufZ8I6wYnIMJF8GKiFjLyyV2ybRB9kUJ6ZAauhKPAG', '2020-02-12 12:55:20', '2020-02-12 12:57:16'),
(13, 'user', 'miawaug', '$2y$10$dsbkFSyHIwvkjIfYONF9sutUUMPDYTgkRbE5UCKhBBh9q6QIl2wbS', 'miawaug', NULL, NULL, NULL, NULL, 'AHHPmTbz7Bv7lcAwXrjNUathCDcKZ6vdpOAGu7ooKkPfpsoT3j8NyQ4T7Ael', '2020-02-28 05:52:42', '2020-02-28 05:52:42'),
(14, 'user', 'mimimi', '$2y$10$jtkG229VA3FLXSA.5pOfDurlcAHzV8xOaTXqzLgtHFBmA.okJqeJ.', 'mimimimi', 'jalan irigasi dusun sukajadi rt33 rw 08 desa sukanagara kecamatan padaherang kabupaten pangandaran provinsi jawa barat negara indonesia wilayah asia tenggara benua asia planet bumi tata surya galaxi bima sakti', NULL, 'Perempuan', '085210665025', 'D0l0E1b1v0fTBvfy6QqQUiXm5jTne9CslvJbip2VZyMllTOM8KhpO6TIiwJL', '2020-02-29 01:14:19', '2020-02-29 02:05:37'),
(15, 'user', 'asdasd', '$2y$10$sQgh2DZLTMJqvxBx14COnOFSt0P0atNE98FmaXYUqORSCXwF6tM2S', 'asdasd', NULL, NULL, NULL, NULL, 'GyhmiTROCyEWGdrKfiuTvxX5pUwPzqytM6xugO8iYTmeKMWtlHr8SmhqOoVG', '2020-02-29 04:52:12', '2020-02-29 04:52:12'),
(16, 'user', 'mamankgarox', '$2y$10$gC8nwhCFh6uBLiEHBu.5SuV.yFYHntPEkrLwMi82nBzYI46o2ef9i', 'mamank_garox', NULL, NULL, NULL, NULL, 'lG1h0wmfEGcVfOMi3nqbiMwbHJH3Z6u4QAFUTHxiVr8bVlwv4vckNDcZJS7x', '2020-03-06 06:26:21', '2020-03-06 06:26:21'),
(17, 'user', 'ainun', '$2y$10$1FC.DsCxkYZCN4NZXUpuP.4hIT9JdiwPqphC5GE804kIoAp1uu9Gu', 'Ainun Nadifah', 'Rt06/Rw02 Kec Patimuan', NULL, 'Perempuan', '085150021000', 'Hn0xAfI442v0NEMyjS1tsu9YBcAUTCcsiirB6vgIrVA4W7SdR4lXR6hb2jGu', '2020-03-06 06:37:40', '2020-03-06 06:46:46'),
(18, 'user', 'youtube', '$2y$10$HKwpAOfQiX0VpM0/BISjweMCXeDt6oyexudq4URE4BgTyyuweDFZC', 'youtube anigato', 'jalan jalan ke sana kemari', NULL, 'Laki-Laki', '085210775045', 'AyOrn0EyAcAGX9DrXWvBo1iLPjbsSJu0E3TruUP7fxPgYIszwYX4j0ZWPMkK', '2020-03-27 07:55:35', '2020-03-27 11:55:06'),
(19, 'user', 'khoerul', '$2y$10$0NQfFBVlOBacVMB8I08GeuMo9MV3bAHQ2Krmi2UHdE7aCALjkHkzu', 'khoerul anam', 'dimana aja juga boleh', NULL, 'Laki-Laki', '076943734738', 'MEKlBSdSUraa4JiuLWkenvT6BjBkMMs48PYfOvuWchmf8rngKRRJMMg9z5di', '2020-09-11 03:38:04', '2020-09-11 03:44:58');

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `id_profile` int(10) UNSIGNED NOT NULL,
  `id_penumpang` int(11) NOT NULL,
  `email` varchar(151) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_ktp` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id_profile`, `id_penumpang`, `email`, `no_ktp`, `created_at`, `updated_at`) VALUES
(1, 3, 'admin@gmail.com', 1234567890123456, '2020-01-15 15:44:56', '2020-03-06 05:55:22'),
(2, 5, 'usernamenya@gmail.com', 11685586, '2020-02-11 00:38:34', '2020-02-11 00:38:36'),
(3, 6, 'usersatu@ymail.com', 0, '2020-02-11 01:05:29', '2020-02-11 01:05:29'),
(5, 7, 'null@gmail.com', 987654321098765, '2020-02-11 04:15:20', '2020-02-11 04:18:22'),
(6, 8, 'papapipi@gmail.com', 1234567890123456, '2020-02-11 04:34:34', '2020-02-11 04:34:34'),
(7, 10, 'a@gmail.com', 1234567890123456, '2020-02-11 06:59:15', '2020-02-11 06:59:15'),
(8, 11, 'userempat@gmail.com', 12312312312312312, '2020-02-12 04:41:54', '2020-02-16 14:57:28'),
(9, 12, 'mamazila@gmai.com', 1231231231231231, '2020-02-12 12:57:16', '2020-02-12 12:57:16'),
(10, 14, 'mimimi@gmail.com', 3207201406010004, '2020-02-29 02:04:43', '2020-02-29 02:05:37'),
(11, 17, 'ainunwkwk@gmail.com', 1011001011010001, '2020-03-06 06:46:46', '2020-03-06 06:46:46'),
(12, 18, 'youtubeanigato@gmail.com', 1234567890123456, '2020-03-27 08:00:36', '2020-03-27 08:00:36'),
(13, 19, 'khoerul@gmail.comm', 986784568764356, '2020-09-11 03:40:37', '2020-09-11 03:40:37');

-- --------------------------------------------------------

--
-- Table structure for table `rutes`
--

CREATE TABLE `rutes` (
  `id_rute` int(10) UNSIGNED NOT NULL,
  `tujuan` varchar(151) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
(38, 'Kalimantan', 9, 7, 'Kalimaru', 'Kalimantan Timur', 'Sepingan', 'Balikpapan', 25, '2020-01-27 12:58:26', '2020-02-12 12:28:04'),
(41, 'bnd', 18, 16, 'Gubeng', 'Surabaya', 'Bandung Hall', 'Bandung', 28, '2020-01-27 13:08:15', '2020-01-27 13:08:34'),
(42, 'undefined', 5, 7, 'Djuanda', 'Jawa Timur', 'Sepingan', 'Balikpapan', 23, '2020-02-07 15:00:01', '2020-02-07 15:00:01'),
(43, 'undefined', 10, 12, 'Ahmad Yani', 'Semarang', 'Halim Perdanakusuma', 'DKI Jakarta', 27, '2020-02-07 15:02:07', '2020-02-07 15:02:07'),
(44, 'undefined', 21, 17, 'Medan Kota', 'Medan', 'Kuala Namu', 'Medan', 28, '2020-02-07 15:03:44', '2020-02-07 15:03:44'),
(45, 'undefined', 10, 4, 'Ahmad Yani', 'Semarang', 'I Gusti Ngurah Rai', 'Bali', 23, '2020-02-08 15:00:08', '2020-02-08 15:00:08'),
(46, 'undefined', 8, 3, 'Samarinda Baru', 'Samarinda', 'Kualanamu', 'Medan', 24, '2020-02-08 15:02:27', '2020-02-08 15:02:27'),
(47, NULL, 18, 15, 'Gubeng', 'Surabaya', 'Yogyakarta', 'DIY Yogyakarta', 27, '2020-02-08 15:02:54', '2020-02-08 15:02:54'),
(48, 'undefined', 13, 4, 'Soekarno-Hatta', 'DKI Jakarta', 'I Gusti Ngurah Rai', 'Bali', 22, '2020-02-12 12:27:52', '2020-02-12 12:27:52'),
(49, 'undefined', 13, 3, 'Soekarno-Hatta', 'DKI Jakarta', 'Kualanamu', 'Medan', 24, '2020-02-13 00:47:48', '2020-02-13 00:47:48'),
(50, 'undefined', 21, 14, 'Medan Kota', 'Medan', 'Gambir', 'DKI Jakarta', 27, '2020-02-13 00:52:18', '2020-02-13 00:52:18'),
(51, 'undefined', 13, 8, 'Soekarno-Hatta', 'DKI Jakarta', 'Samarinda Baru', 'Samarinda', 25, '2020-03-27 10:48:19', '2020-03-27 10:48:19');

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
  `status` enum('Menunggu Pembayaran','Menunggu Konfirmasi User','Menunggu Konfirmasi Admin','Sukses','Batal') NOT NULL DEFAULT 'Menunggu Pembayaran',
  `qty` int(11) NOT NULL DEFAULT '1',
  `no_kursi` bigint(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tikets`
--

INSERT INTO `tikets` (`id_tiket`, `id_jadwal`, `kode_pemesanan`, `username`, `kode_tiket`, `status`, `qty`, `no_kursi`, `created_at`, `updated_at`) VALUES
(70, 22, 'PEMS00CIVT1', 'wasdwasd', 'TIK2210', 'Sukses', 1, 10, '2020-02-08 15:13:07', '2020-02-08 15:13:07'),
(71, 26, 'PEMS00CIVT1', 'wasdwasd', 'TIK265', 'Sukses', 1, 5, '2020-02-08 15:13:07', '2020-02-08 15:13:07'),
(72, 22, 'PEMS00WU8G8', 'wasdwasd', 'TIK221', 'Sukses', 1, 1, '2020-02-11 07:02:48', '2020-02-11 07:02:48'),
(73, 26, 'PEMS00IRL8Y', 'wasdwasd', 'TIK269', 'Sukses', 1, 9, '2020-02-09 03:23:24', '2020-02-09 03:23:24'),
(74, 22, 'PEMS00OPUCC', 'wasdwasd', 'TIK2267', 'Sukses', 1, 67, '2020-02-14 14:34:34', '2020-02-14 14:34:34'),
(75, 24, 'PEMS00OPUCC', 'wasdwasd', 'TIK2432', 'Sukses', 1, 32, '2020-02-14 14:34:34', '2020-02-14 14:34:34'),
(76, 24, 'PEMS00OPUCC', 'wasdwasd', 'TIK2410', 'Sukses', 1, 10, '2020-02-14 14:34:34', '2020-02-14 14:34:34'),
(77, 24, 'PEMS00OPUCC', 'wasdwasd', 'TIK24123', 'Sukses', 1, 123, '2020-02-14 14:34:34', '2020-02-14 14:34:34'),
(78, 24, 'PEMS00OPUCC', 'wasdwasd', 'TIK2490', 'Sukses', 1, 90, '2020-02-14 14:34:34', '2020-02-14 14:34:34'),
(79, 24, 'PEMS00OPUCC', 'wasdwasd', 'TIK247', 'Sukses', 1, 7, '2020-02-14 14:34:34', '2020-02-14 14:34:34'),
(80, 22, 'PEMS00OPUCC', 'wasdwasd', 'TIK229', 'Sukses', 1, 9, '2020-02-14 14:34:34', '2020-02-14 14:34:34'),
(81, 24, 'PEMS00OPUCC', 'wasdwasd', 'TIK249', 'Sukses', 1, 9, '2020-02-14 14:34:34', '2020-02-14 14:34:34'),
(82, 25, 'PEMS00OPUCC', 'wasdwasd', 'TIK259', 'Sukses', 1, 9, '2020-02-14 14:34:34', '2020-02-14 14:34:34'),
(83, 22, 'PEMS00H5EI9', 'usernamenya', 'TIK228', 'Menunggu Konfirmasi User', 1, 8, '2020-02-11 00:44:16', '2020-02-11 00:44:15'),
(84, 22, 'PEMS00H5EI9', 'usernamenya', 'TIK226', 'Menunggu Konfirmasi User', 1, 6, '2020-02-11 00:44:16', '2020-02-11 00:44:15'),
(85, 22, 'PEMS00D2C0A', 'usersatu', 'TIK2290', 'Menunggu Konfirmasi User', 1, 90, '2020-02-11 01:06:03', '2020-02-11 01:06:03'),
(86, 25, 'PEMS00OPUCC', 'wasdwasd', 'TIK257', 'Sukses', 1, 7, '2020-01-21 14:34:34', '2020-02-14 14:34:34'),
(87, 24, 'PEMS001TIYH', 'wasdwasd', 'TIK248', 'Batal', 1, 8, '2020-02-12 03:16:14', '2020-02-12 03:16:14'),
(88, 22, 'PEMS00HIQ7F', 'wasdwasd', 'TIK227', 'Sukses', 1, 7, '2020-02-16 00:15:58', '2020-02-16 00:15:58'),
(89, 26, 'PEMS00HIQ7F', 'wasdwasd', 'TIK2667', 'Sukses', 1, 67, '2020-02-16 00:15:58', '2020-02-16 00:15:58'),
(91, 24, NULL, 'papapipi', 'TIK2497', 'Menunggu Pembayaran', 1, 97, '2020-02-11 04:10:42', '2020-02-11 04:10:42'),
(92, 24, NULL, 'papapipi', 'TIK2477', 'Menunggu Pembayaran', 1, 77, '2020-02-11 04:10:50', '2020-02-11 04:10:50'),
(93, 24, 'PEMS00CP1I8', 'papazola', 'TIK2488', 'Menunggu Konfirmasi User', 1, 88, '2020-02-11 04:35:59', '2020-02-11 04:35:59'),
(94, 22, 'PEMS00LQQR0', 'usertiga', 'TIK220', 'Sukses', 1, 0, '2020-02-11 07:03:12', '2020-02-11 07:03:12'),
(96, 26, 'PEMS00V9O9B', 'usertiga', 'TIK268', 'Batal', 1, 8, '2020-02-12 03:18:09', '2020-02-12 03:18:09'),
(97, 24, 'PEMS00TTQH5', 'usertiga', 'TIK2480', 'Sukses', 1, 80, '2020-03-01 15:27:14', '2020-03-01 15:27:14'),
(98, 25, 'PEMS00LRHYP', 'userempat', 'TIK2512', 'Sukses', 1, 12, '2020-01-28 17:00:00', '2020-02-12 04:46:30'),
(99, 24, 'PEMS00SCKHY', 'mamazila', 'TIK2455', 'Sukses', 1, 55, '2020-02-12 13:00:24', '2020-02-12 13:00:24'),
(100, 24, 'PEMS00SCKHY', 'mamazila', 'TIK2465', 'Sukses', 1, 65, '2020-02-05 13:00:24', '2020-02-12 13:00:24'),
(101, 25, 'PEMS00G8R0H', 'mamazila', 'TIK2590', 'Batal', 1, 90, '2020-02-12 13:03:42', '2020-02-12 13:03:42'),
(102, 25, 'PEMS00DMAP9', 'mamazila', 'TIK2590', 'Sukses', 1, 90, '2020-02-12 13:20:26', '2020-02-12 13:20:26'),
(103, 27, 'PEMS00FIYZQ', 'wasdwasd', 'TIK2790', 'Sukses', 1, 90, '2020-02-16 00:15:50', '2020-02-16 00:15:50'),
(104, 27, 'PEMS00FIYZQ', 'wasdwasd', 'TIK2799', 'Sukses', 1, 99, '2020-02-16 00:15:50', '2020-02-16 00:15:50'),
(105, 30, 'PEMS00FIYZQ', 'wasdwasd', 'TIK3012', 'Sukses', 1, 12, '2020-02-16 00:15:50', '2020-02-16 00:15:50'),
(106, 30, 'PEMS00FIYZQ', 'wasdwasd', 'TIK3011', 'Sukses', 1, 11, '2020-02-16 00:15:50', '2020-02-16 00:15:50'),
(107, 30, 'PEMS00FIYZQ', 'wasdwasd', 'TIK3090', 'Sukses', 1, 90, '2020-02-16 00:15:50', '2020-02-16 00:15:50'),
(108, 30, 'PEMS00FIYZQ', 'wasdwasd', 'TIK300', 'Sukses', 1, 0, '2020-02-16 00:15:50', '2020-02-16 00:15:50'),
(109, 27, 'PEMS00KYLKX', 'usertiga', 'TIK2712', 'Sukses', 1, 12, '2020-02-16 00:15:41', '2020-02-16 00:15:41'),
(110, 29, 'PEMS003R3FY', 'wasdwasd', 'TIK2912', 'Sukses', 1, 12, '2020-02-16 00:15:31', '2020-02-16 00:15:31'),
(111, 28, 'PEMS003R3FY', 'wasdwasd', 'TIK2811', 'Sukses', 1, 11, '2020-02-16 00:15:31', '2020-02-16 00:15:31'),
(112, 28, 'PEMS00FFZDR', 'userempat', 'TIK2812', 'Batal', 1, 12, '2020-02-16 11:10:08', '2020-02-16 11:10:08'),
(113, 28, 'PEMS00FFZDR', 'userempat', 'TIK2854', 'Batal', 1, 54, '2020-02-16 11:10:08', '2020-02-16 11:10:08'),
(114, 28, 'PEMS00FFZDR', 'userempat', 'TIK2855', 'Batal', 1, 55, '2020-02-16 11:10:08', '2020-02-16 11:10:08'),
(115, 29, 'PEMS00I38SQ', 'userempat', 'TIK2923', 'Batal', 1, 23, '2020-02-16 11:14:05', '2020-02-16 11:14:05'),
(116, 29, 'PEMS00I38SQ', 'userempat', 'TIK2943', 'Batal', 1, 43, '2020-02-16 11:14:05', '2020-02-16 11:14:05'),
(117, 29, 'PEMS00T9D9J', 'userempat', 'TIK2943', 'Sukses', 1, 43, '2020-02-22 14:18:05', '2020-02-22 14:18:05'),
(118, 29, 'PEMS00T9D9J', 'userempat', 'TIK2911', 'Sukses', 1, 11, '2020-02-22 14:18:05', '2020-02-22 14:18:05'),
(119, 30, 'PEMS002SO8A', 'userempat', 'TIK30123', 'Sukses', 1, 123, '2020-03-06 04:04:00', '2020-03-06 04:04:00'),
(120, 29, 'PEMS002SO8A', 'userempat', 'TIK29312', 'Sukses', 1, 312, '2020-03-06 04:04:00', '2020-03-06 04:04:00'),
(121, 27, 'PEMS0099XEX', 'userempat', 'TIK2745', 'Sukses', 1, 45, '2020-03-01 14:12:09', '2020-03-01 14:12:09'),
(122, 27, 'PEMS0099XEX', 'userempat', 'TIK2714', 'Sukses', 1, 14, '2020-03-01 14:12:09', '2020-03-01 14:12:09'),
(123, 27, 'PEMS0099XEX', 'userempat', 'TIK2774', 'Sukses', 1, 74, '2020-03-01 14:12:09', '2020-03-01 14:12:09'),
(124, 29, 'PEMS0099XEX', 'userempat', 'TIK29150', 'Sukses', 1, 150, '2020-03-01 14:12:09', '2020-03-01 14:12:09'),
(125, 29, 'PEMS0099XEX', 'userempat', 'TIK2955', 'Sukses', 1, 55, '2020-03-01 14:12:09', '2020-03-01 14:12:09'),
(126, 28, 'PEMS00KSRWG', 'wasdwasd', 'TIK2812', 'Sukses', 1, 12, '2020-03-01 14:12:02', '2020-03-01 14:12:02'),
(128, 27, NULL, 'usertiga', 'TIK2710', 'Menunggu Pembayaran', 1, 10, '2020-02-21 13:34:44', '2020-02-21 13:34:44'),
(129, 27, NULL, 'usertiga', 'TIK2720', 'Menunggu Pembayaran', 1, 20, '2020-02-21 13:40:13', '2020-02-21 13:40:13'),
(130, 27, 'PEMS002DKNG', 'userempat', 'TIK2797', 'Menunggu Konfirmasi User', 1, 97, '2020-02-21 15:42:02', '2020-02-21 15:42:02'),
(131, 30, 'PEMS00RKAI2', 'userempat', 'TIK3089', 'Menunggu Konfirmasi User', 1, 89, '2020-02-21 23:57:01', '2020-02-21 23:57:01'),
(132, 27, NULL, 'userempat', 'TIK271', 'Menunggu Pembayaran', 1, 1, '2020-02-21 23:57:30', '2020-02-21 23:57:30'),
(133, 30, 'PEMS00TGP3J', 'wasdwasd', 'TIK30124', 'Sukses', 1, 124, '2020-03-25 04:26:50', '2020-03-25 04:26:50'),
(134, 30, 'PEMS00TGP3J', 'wasdwasd', 'TIK3043', 'Sukses', 1, 43, '2020-03-25 04:26:50', '2020-03-25 04:26:50'),
(135, 27, 'PEMS00TGP3J', 'wasdwasd', 'TIK2754', 'Sukses', 1, 54, '2020-03-25 04:26:50', '2020-03-25 04:26:50'),
(136, 29, 'PEMS00TGP3J', 'wasdwasd', 'TIK2954', 'Sukses', 1, 54, '2020-03-25 04:26:50', '2020-03-25 04:26:50'),
(139, 27, NULL, 'mimimi', 'TIK2743', 'Menunggu Pembayaran', 1, 43, '2020-02-29 01:16:15', '2020-02-29 01:16:15'),
(140, 28, NULL, 'mimimi', 'TIK281', 'Menunggu Pembayaran', 1, 1, '2020-02-29 02:27:14', '2020-02-29 02:27:14'),
(141, 29, 'PEMS00TOI92', 'wasdwasd', 'TIK291', 'Sukses', 1, 1, '2020-03-01 14:11:51', '2020-03-01 14:11:51'),
(142, 29, NULL, 'asdasd', 'TIK2932', 'Menunggu Pembayaran', 1, 32, '2020-02-29 04:53:23', '2020-02-29 04:53:23'),
(144, 30, 'PEMS00OPFZ3', 'wasdwasd', 'TIK30251', 'Sukses', 1, 251, '2020-03-25 03:49:26', '2020-03-25 03:49:26'),
(145, 29, 'PEMS00YGT9T', 'wasdwasd', 'TIK29184', 'Sukses', 1, 213, '2020-03-01 15:25:03', '2020-03-01 15:25:03'),
(146, 28, 'PEMS00QNIB1', 'ainun', 'TIK28738', 'Sukses', 1, 5, '2020-03-06 07:02:56', '2020-03-06 07:02:56'),
(147, 28, 'PEMS00QNIB1', 'ainun', 'TIK28305', 'Sukses', 1, 6, '2020-03-06 07:02:56', '2020-03-06 07:02:56'),
(152, 30, 'PEMS00ONRHC', 'wasdwasd', 'TIK30179', 'Menunggu Konfirmasi User', 1, 111, '2020-03-25 03:46:46', '2020-03-25 03:46:46'),
(153, 29, 'PEMS00ONRHC', 'wasdwasd', 'TIK29599', 'Menunggu Konfirmasi User', 1, 111, '2020-03-25 03:46:46', '2020-03-25 03:46:46'),
(154, 29, 'PEMS00ONRHC', 'wasdwasd', 'TIK29972', 'Menunggu Konfirmasi User', 1, 1111, '2020-03-25 03:46:46', '2020-03-25 03:46:46'),
(155, 30, 'PEMS00ONRHC', 'wasdwasd', 'TIK30494', 'Menunggu Konfirmasi User', 1, 323, '2020-03-25 03:46:46', '2020-03-25 03:46:46'),
(156, 28, 'PEMS00ONRHC', 'wasdwasd', 'TIK28114', 'Menunggu Konfirmasi User', 1, 0, '2020-03-25 03:46:46', '2020-03-25 03:46:46'),
(157, 28, 'PEMS00ONRHC', 'wasdwasd', 'TIK28994', 'Menunggu Konfirmasi User', 1, -10, '2020-03-25 03:46:46', '2020-03-25 03:46:46'),
(158, 28, 'PEMS00ONRHC', 'wasdwasd', 'TIK28574', 'Menunggu Konfirmasi User', 1, 202, '2020-03-25 03:46:46', '2020-03-25 03:46:46'),
(159, 27, 'PEMS00ONRHC', 'wasdwasd', 'TIK27928', 'Menunggu Konfirmasi User', 1, 400, '2020-03-25 03:46:46', '2020-03-25 03:46:46'),
(160, 30, 'PEMS00ONRHC', 'wasdwasd', 'TIK30701', 'Menunggu Konfirmasi User', 1, 200, '2020-03-25 03:46:46', '2020-03-25 03:46:46'),
(161, 30, 'PEMS00ONRHC', 'wasdwasd', 'TIK30784', 'Menunggu Konfirmasi User', 1, 201, '2020-03-25 03:46:46', '2020-03-25 03:46:46'),
(163, 30, 'PEMS00UYCOZ', 'youtube', 'TIK30740', 'Sukses', 1, 2, '2020-03-27 10:51:45', '2020-03-27 10:51:45'),
(164, 30, 'PEMS00UYCOZ', 'youtube', 'TIK30295', 'Sukses', 1, 3, '2020-03-27 10:51:45', '2020-03-27 10:51:45'),
(165, 28, 'PEMS00HU82R', 'youtube', 'TIK28091', 'Batal', 1, 9, '2020-03-27 11:54:29', '2020-03-27 11:54:29'),
(166, 34, 'PEMS000X8TL', 'khoerul', 'TIK34380', 'Sukses', 1, 9, '2020-09-11 03:44:36', '2020-09-11 03:44:36');

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
(28, 'AW231', 250, 'Ekonomi', 25, '2020-01-17 13:44:42', '2020-01-17 13:44:42'),
(31, 'TRANS14', 12, 'Eksekutif', 14, '2020-02-07 14:10:18', '2020-02-07 14:10:18');

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
  `level` enum('operator','admin') COLLATE utf8mb4_unicode_ci NOT NULL,
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
(9, 'admin', 'anigato', 'khoerul', '$2y$10$rkS.jG9fDf8faoBdRjq/3Ovlf1IqNlB.jjNd3kny3McAppUm7PuJ6', 'anam', 'AYwTkwxUrcoKoFz2Ux0PELzcTZCjFuJKPd03JPSuoF3msiulKH7kqgxsFltC', '2020-01-05 01:41:52', '2020-09-11 03:42:54'),
(10, 'admin', 'balalala', 'balalala', '$2y$10$OZkrbq1eXgzzBAAZDh0qP.F6WTQATHe0oMEuRSZXMlMuUusxjo.Tq', 'balalala', 'JwXwaYNPZjmdg4zYoXLvMgOlmN1dMiyPTnpmEZj18vZDo0U89XzDkouThag2', '2020-01-10 12:04:42', '2020-03-27 12:00:50'),
(14, 'operator', 'qweqwe', 'qweqwe', '$2y$10$OWwB54wnN2lyFlKKD3ZIRu2MbNlpYKChR/ktIxfFDI11mDwQRKAmG', 'qweqwe', 'i5cCvgxgrWaHiM9LXsdexbHmCPmnDLMmwR4ZTu678zKyCcG0eCjlHFPCVKy6', '2020-02-16 15:41:05', '2020-03-27 12:01:15'),
(28, 'operator', 'sariroti', 'sari roti', '$2y$10$MolrOmCs5mDZdct7gGsxAuqZeV6CZ0gzgmT5wI34heRv6AUz4PSti', 'roti sari roti', '1e00LtY0kgoafMGu3zLabsULa7jpHbz71TF2Uworak3QUQcWexbNtNTjod6l', '2020-02-17 02:00:11', '2020-03-07 16:54:38'),
(29, 'operator', 'siapasaja', 'siapa aku', '$2y$10$L0VfyLBYQU0H2gu6USfCeeo7T2nsInAKdN6wiFviOQbxlLb6ecOp.', 'saja', 'kw4qcglaen1lqm6OqOqteU5T2vMsQiOT8ZKdhMz8NP742i0xx6yI5wFfpl45', '2020-03-27 10:39:30', '2020-03-27 10:40:06');

--
-- Indexes for dumped tables
--

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
  ADD PRIMARY KEY (`id_penumpang`);

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
-- AUTO_INCREMENT for table `diskons`
--
ALTER TABLE `diskons`
  MODIFY `id_diskon` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `drivers`
--
ALTER TABLE `drivers`
  MODIFY `id_driver` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `identitass`
--
ALTER TABLE `identitass`
  MODIFY `id_identitas` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jadwals`
--
ALTER TABLE `jadwals`
  MODIFY `id_jadwal` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `konfirmasi_pemesanans`
--
ALTER TABLE `konfirmasi_pemesanans`
  MODIFY `id_konfirmasi` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

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
  MODIFY `id_pemesanan` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `penumpangs`
--
ALTER TABLE `penumpangs`
  MODIFY `id_penumpang` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id_profile` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `rutes`
--
ALTER TABLE `rutes`
  MODIFY `id_rute` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `tempats`
--
ALTER TABLE `tempats`
  MODIFY `id_tempat` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tikets`
--
ALTER TABLE `tikets`
  MODIFY `id_tiket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=167;

--
-- AUTO_INCREMENT for table `transportasis`
--
ALTER TABLE `transportasis`
  MODIFY `id_transportasi` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `type_transportasis`
--
ALTER TABLE `type_transportasis`
  MODIFY `id_type_transportasi` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
