-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 28 Nov 2019 pada 16.17
-- Versi server: 10.1.37-MariaDB
-- Versi PHP: 7.3.0

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
-- Struktur dari tabel `levels`
--

CREATE TABLE `levels` (
  `id_level` int(10) UNSIGNED NOT NULL,
  `nama_level` varchar(151) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `login_tokens`
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
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(151) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
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
(10, '2019_11_26_062022_login_token', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(151) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(151) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemesanans`
--

CREATE TABLE `pemesanans` (
  `id_pemesanan` int(10) UNSIGNED NOT NULL,
  `kode_pemesanan` int(11) NOT NULL,
  `tanggal_pemesanan` date NOT NULL,
  `tempat_pemesanan` varchar(151) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `kode_kursi` varchar(151) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_rute` int(11) NOT NULL,
  `tujuan` varchar(151) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_berangkat` date NOT NULL,
  `jam_checkin` time NOT NULL,
  `jam_berangkat` time NOT NULL,
  `total_bayar` int(11) NOT NULL,
  `id_petugas` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `penumpangs`
--

CREATE TABLE `penumpangs` (
  `id_penumpang` int(10) UNSIGNED NOT NULL,
  `username` varchar(151) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(151) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_penumpang` varchar(151) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat_penumpang` varchar(151) COLLATE utf8mb4_unicode_ci NOT NULL,
  `taggal_lahir` date NOT NULL,
  `jenis_kelamin` varchar(151) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telepone` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `petugass`
--

CREATE TABLE `petugass` (
  `id_petugas` int(10) UNSIGNED NOT NULL,
  `username` varchar(151) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(151) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_petugas` varchar(151) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_level` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `rutes`
--

CREATE TABLE `rutes` (
  `id_rute` int(10) UNSIGNED NOT NULL,
  `tujuan` varchar(151) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rute_awal` varchar(151) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rute_akhir` varchar(151) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga` varchar(151) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_transportasi` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `transportasis`
--

CREATE TABLE `transportasis` (
  `id_transportasi` int(10) UNSIGNED NOT NULL,
  `kode` int(11) NOT NULL,
  `jumlah_kursi` int(11) NOT NULL,
  `keterangan` varchar(151) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_type_transportasi` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `transportasis`
--

INSERT INTO `transportasis` (`id_transportasi`, `kode`, `jumlah_kursi`, `keterangan`, `id_type_transportasi`, `created_at`, `updated_at`) VALUES
(11, 123, 100, 'kelas premium', 13, '2019-11-28 03:42:18', '2019-11-28 03:42:26'),
(13, 12, 12, 'awwda', 12, '2019-11-28 04:25:19', '2019-11-28 04:25:19'),
(14, 111, 222, 'asda', 12, '2019-11-28 06:58:50', '2019-11-28 06:58:50');

-- --------------------------------------------------------

--
-- Struktur dari tabel `type_transportasis`
--

CREATE TABLE `type_transportasis` (
  `id_type_transportasi` int(10) UNSIGNED NOT NULL,
  `nama_type` varchar(151) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(151) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `type_transportasis`
--

INSERT INTO `type_transportasis` (`id_type_transportasi`, `nama_type`, `keterangan`, `created_at`, `updated_at`) VALUES
(3, 'awdswdasd', 'dwasdeaw', '2019-11-28 07:00:34', '2019-11-28 07:00:34'),
(4, 'tipe', 'ket', '2019-11-28 07:03:06', '2019-11-28 07:03:06');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(151) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(151) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `first_name`, `password`, `last_name`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'aaaaaaaaa', 'aaaaaaaaa', '$2y$10$14XvtLHpMZKuqelCX.uL/.NBppEsoyabhM/mwsUSOuz0o3zIuVuIW', 'aaaaaaaaa', '$2y$10$39o0nT/aU0KOhT3hgrVTY.A.VTZYQEhTZaEeBUGVDfK5cup/K6oSa', '2019-11-25 23:34:42', '2019-11-25 23:34:42'),
(2, 'admin', 'admin', '$2y$10$V9ZHdnW2KeKId37UsFDHruNV4fSLZthQW5yGxDGs3yFoM3GBykGyu', 'admin', '$2y$10$JS2Zu6ameQ7u3oQFwkzuDuKVcv1ln4zbPXjT37qIFHbvBqXz9Xppy', '2019-11-25 23:42:25', '2019-11-28 07:27:20'),
(3, 'balalala', 'balalala', '$2y$10$o.rQUEHK8U.0EHOvVtzTUeBBf8BLWKHpFO1xkR0/vvfRKLm1vtB56', 'balalala', '$2y$10$wSMW1UZtSRO0f5RorCmcNeozxs82J2b..UkxhPEQUXNKfYIJ645Nm', '2019-11-28 00:12:35', '2019-11-28 00:12:35');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `levels`
--
ALTER TABLE `levels`
  ADD PRIMARY KEY (`id_level`);

--
-- Indeks untuk tabel `login_tokens`
--
ALTER TABLE `login_tokens`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `pemesanans`
--
ALTER TABLE `pemesanans`
  ADD PRIMARY KEY (`id_pemesanan`);

--
-- Indeks untuk tabel `penumpangs`
--
ALTER TABLE `penumpangs`
  ADD PRIMARY KEY (`id_penumpang`),
  ADD UNIQUE KEY `penumpangs_telepone_unique` (`telepone`);

--
-- Indeks untuk tabel `petugass`
--
ALTER TABLE `petugass`
  ADD PRIMARY KEY (`id_petugas`);

--
-- Indeks untuk tabel `rutes`
--
ALTER TABLE `rutes`
  ADD PRIMARY KEY (`id_rute`);

--
-- Indeks untuk tabel `transportasis`
--
ALTER TABLE `transportasis`
  ADD PRIMARY KEY (`id_transportasi`);

--
-- Indeks untuk tabel `type_transportasis`
--
ALTER TABLE `type_transportasis`
  ADD PRIMARY KEY (`id_type_transportasi`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `levels`
--
ALTER TABLE `levels`
  MODIFY `id_level` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `login_tokens`
--
ALTER TABLE `login_tokens`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `pemesanans`
--
ALTER TABLE `pemesanans`
  MODIFY `id_pemesanan` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `penumpangs`
--
ALTER TABLE `penumpangs`
  MODIFY `id_penumpang` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `petugass`
--
ALTER TABLE `petugass`
  MODIFY `id_petugas` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `rutes`
--
ALTER TABLE `rutes`
  MODIFY `id_rute` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `transportasis`
--
ALTER TABLE `transportasis`
  MODIFY `id_transportasi` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `type_transportasis`
--
ALTER TABLE `type_transportasis`
  MODIFY `id_type_transportasi` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
