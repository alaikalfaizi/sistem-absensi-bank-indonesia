-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 19, 2025 at 01:58 AM
-- Server version: 8.0.30
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `absensi_kedua`
--

-- --------------------------------------------------------

--
-- Table structure for table `absensi`
--

CREATE TABLE `absensi` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `jam_masuk` datetime DEFAULT NULL,
  `jam_keluar` datetime DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Hadir',
  `keterangan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `keterangan_masuk` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan_keluar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `absensi`
--

INSERT INTO `absensi` (`id`, `user_id`, `tanggal`, `jam_masuk`, `jam_keluar`, `status`, `keterangan`, `created_at`, `updated_at`, `keterangan_masuk`, `keterangan_keluar`) VALUES
(25, 17, '2025-05-08', '2025-05-08 14:28:44', '2025-05-08 14:28:55', 'Hadir', 'Pulang', '2025-05-08 07:28:44', '2025-05-08 07:28:55', NULL, NULL),
(26, 26, '2025-05-08', '2025-05-08 14:35:54', '2025-05-08 14:36:02', 'Hadir', 'Pulang', '2025-05-08 07:35:54', '2025-05-08 07:36:02', NULL, NULL),
(27, 27, '2025-05-08', '2025-05-08 14:54:40', '2025-05-08 14:54:49', 'Hadir', 'Pulang', '2025-05-08 07:54:40', '2025-05-08 07:54:49', NULL, NULL),
(28, 26, '2025-05-09', '2025-05-09 07:50:20', '2025-05-09 07:52:53', 'Hadir', 'Pulang', '2025-05-09 00:50:20', '2025-05-09 00:52:53', 'Hadir', NULL),
(29, 18, '2025-05-09', '2025-05-09 07:54:17', NULL, 'Hadir', NULL, '2025-05-09 00:54:17', '2025-05-09 00:54:17', 'Hadir', NULL),
(30, 25, '2025-05-09', '2025-05-09 07:55:43', NULL, 'Hadir', NULL, '2025-05-09 00:55:43', '2025-05-09 00:55:43', 'Hadir', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `logbooks`
--

CREATE TABLE `logbooks` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `aktivitas` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `logbooks`
--

INSERT INTO `logbooks` (`id`, `user_id`, `tanggal`, `aktivitas`, `deskripsi`, `created_at`, `updated_at`) VALUES
(28, 18, '2025-05-09', 'testingpertama', 'abcde', '2025-05-09 00:54:31', '2025-05-09 00:54:31');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(2, '2025_04_12_041255_create_users_table', 1),
(3, '2025_04_12_041454_create_absensi_table', 1),
(4, '2025_04_12_041548_create_logbooks_table', 1),
(6, '2025_04_12_061743_create_permission_tables', 2),
(8, '2025_04_12_084709_add_supervisor_id_to_users_table', 3),
(9, '2025_04_12_092828_update_absensi_nullable', 4),
(10, '2025_04_12_094611_add_default_status_to_absensi', 5),
(12, '2025_04_12_123441_add_last_login_at_to_users_table', 6),
(13, '2025_04_15_163147_create_pendaftar_magang_table', 7),
(14, '2025_04_15_201650_add_fields_to_pendaftar_magang_table', 8),
(15, '2025_04_15_210322_add_status_to_pendaftar_magang_table', 9),
(18, '2025_04_24_104536_create_program_kerjas_table', 10),
(19, '2025_04_24_155330_add_tanggal_mulai_and_tanggal_selesai_to_program_kerjas_table', 11),
(20, '2025_05_07_145043_add_keterangan_masuk_keluar_to_absensis_table', 12),
(21, '2025_05_08_113543_add_tanggal_pendaftaran_to_pendaftar_magang_table', 13);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL,
  `permission_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pendaftar_magang`
--

CREATE TABLE `pendaftar_magang` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `asal_universitas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `asal_jurusan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit_kerja` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenis_kelamin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `domisili` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_hp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keahlian` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link_portofolio` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `berkas` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Menunggu',
  `tanggal_pendaftaran` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pendaftar_magang`
--

INSERT INTO `pendaftar_magang` (`id`, `nama`, `asal_universitas`, `asal_jurusan`, `unit_kerja`, `created_at`, `updated_at`, `email`, `jenis_kelamin`, `domisili`, `no_hp`, `keahlian`, `link_portofolio`, `berkas`, `status`, `tanggal_pendaftaran`) VALUES
(1, 'rahmatzuhrihafiz', 'UIN SUSKA RIAU', 'Teknik Informatika', 'Fungsi Perumusan Kekda Provinsi', '2025-04-15 13:20:10', '2025-05-15 08:45:19', 'rahmatzh15@gmail.com', 'Laki-laki', 'Pekanbaru', '081378139441', 'Memancing', 'https://drive.google.com/drive/folders/1aJhIUFoFmwaf-BLSGBmuIHwavZaAS0oo?usp=sharing', '1744723210_sistem_absensi_pegawai-master.zip', 'Menunggu', NULL),
(10, 'rahmatzh', 'UIN SUSKA RIAU', 'Teknik Informatika', 'Fungsi Perumusan Kekda Provinsi', '2025-05-17 03:08:49', '2025-05-17 03:08:49', 'rahmatzh@gmail.com', 'Laki-laki', 'Pekanbaru', '08123456789', 'testing123', 'https://drive.google.com/drive/folders/1aJhIUFoFmwaf-BLSGBmuIHwavZaAS0oo?usp=sharing', '1747451329_iPhone 14 Pro.zip', 'Menunggu', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `program_kerjas`
--

CREATE TABLE `program_kerjas` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tanggal_mulai` date DEFAULT NULL,
  `tanggal_selesai` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `program_kerjas`
--

INSERT INTO `program_kerjas` (`id`, `user_id`, `judul`, `deskripsi`, `created_at`, `updated_at`, `tanggal_mulai`, `tanggal_selesai`) VALUES
(14, 18, 'testing', 'testing123', '2025-04-28 02:47:53', '2025-04-28 02:47:53', '2025-04-24', '2025-04-28');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(5, 'admin', 'web', '2025-04-14 00:48:32', '2025-04-14 00:48:32'),
(6, 'staff', 'web', '2025-04-14 00:48:32', '2025-04-14 00:48:32'),
(7, 'magang', 'web', '2025-04-14 00:48:32', '2025-04-14 00:48:32');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','staff','magang') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `supervisor_id` bigint UNSIGNED DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `last_login_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `supervisor_id`, `remember_token`, `created_at`, `updated_at`, `last_login_at`) VALUES
(3, 'Admin', 'admin@gmail.com', NULL, '$2y$10$VILBTIlTUekA9b2b7vQGu.dLXDGiZ.dr7omwGLpdKKS4GIeV8MQ.K', 'admin', NULL, NULL, '2025-04-11 21:30:24', '2025-05-17 02:09:20', '2025-05-17 02:09:20'),
(17, 'rahmat123', 'rahmat101@gmail.com', NULL, '$2y$10$SsoF8S0kEau2METc7HPjy.nBjmNOOvatvSO/rY2wzkhj1vaoIwOpe', 'staff', NULL, NULL, '2025-04-12 00:56:23', '2025-05-08 07:35:02', '2025-05-08 07:35:02'),
(18, 'akunmagang1', 'akunmagang1@gmail.com', NULL, '$2y$10$WfNaGwClNjhQCTZIRE8zG.7r23SzoHLBu/XAyv40edfkiim6uIuaK', 'magang', NULL, NULL, '2025-04-12 06:56:36', '2025-05-19 01:56:24', '2025-05-19 01:56:24'),
(25, 'akunmagang13', 'akunmagang13@gmail.com', NULL, '$2y$10$zxZpXGDx7PgBQvV/UVhDjuUPzYDKvUhqZ/fEy9LU43VBtRnl8pKvW', 'magang', NULL, NULL, '2025-05-07 08:08:17', '2025-05-09 00:55:38', '2025-05-09 00:55:38'),
(26, 'akunstaff1', 'akunstaff1@gmail.com', NULL, '$2y$10$8hHE6lzf8d113xeecdn2o.qhA7KbAhOQswJLD9TH7uEg7lTz8wQ3q', 'staff', NULL, NULL, '2025-05-08 07:35:33', '2025-05-17 02:33:08', '2025-05-17 02:33:08'),
(27, 'akunstaff2', 'akunstaff2@gmail.com', NULL, '$2y$10$S6sjDbdu5rMUlKljo6W2fuV8PAAo.2aOw89YY/alHJicMTX9mj6hW', 'staff', NULL, NULL, '2025-05-08 07:46:48', '2025-05-08 07:47:01', '2025-05-08 07:47:01'),
(28, 'testingrahmat', 'testingrahmat@gmail.com', NULL, '$2y$10$7IIIKt.asTMx3Xl6I253OuT8pXYZyGhzZO0meD2Nt9WkeDGPkUqki', 'magang', NULL, NULL, '2025-05-16 15:04:45', '2025-05-16 15:04:45', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `absensi_user_id_foreign` (`user_id`);

--
-- Indexes for table `logbooks`
--
ALTER TABLE `logbooks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `logbooks_user_id_foreign` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `model_has_permissions_model_type_model_id_index` (`model_type`,`model_id`),
  ADD KEY `model_has_permissions_permission_id_foreign` (`permission_id`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `model_has_roles_model_type_model_id_index` (`model_type`,`model_id`),
  ADD KEY `model_has_roles_role_id_foreign` (`role_id`);

--
-- Indexes for table `pendaftar_magang`
--
ALTER TABLE `pendaftar_magang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `program_kerjas`
--
ALTER TABLE `program_kerjas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `program_kerjas_user_id_foreign` (`user_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_supervisor_id_foreign` (`supervisor_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `logbooks`
--
ALTER TABLE `logbooks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pendaftar_magang`
--
ALTER TABLE `pendaftar_magang`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `program_kerjas`
--
ALTER TABLE `program_kerjas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `absensi`
--
ALTER TABLE `absensi`
  ADD CONSTRAINT `absensi_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `logbooks`
--
ALTER TABLE `logbooks`
  ADD CONSTRAINT `logbooks_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `program_kerjas`
--
ALTER TABLE `program_kerjas`
  ADD CONSTRAINT `program_kerjas_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_supervisor_id_foreign` FOREIGN KEY (`supervisor_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
