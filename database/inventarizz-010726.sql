-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 30, 2026 at 11:43 PM
-- Server version: 8.0.30
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventarizz`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `account_id` int NOT NULL,
  `server_id` int NOT NULL,
  `created_at` datetime NOT NULL,
  `expired_at` date NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('Superuser','Service Account','Audit Account') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`account_id`, `server_id`, `created_at`, `expired_at`, `username`, `password`, `role`) VALUES
(1, 2, '2026-04-28 09:44:15', '2026-12-03', 'admin_root', 'RootP@ss2026!', 'Superuser'),
(2, 2, '2026-04-28 09:45:01', '2026-06-30', 'dev_audit', 'AuditOnly#99', 'Audit Account'),
(3, 3, '2026-04-28 09:45:29', '2026-12-31', 'sql_admin', 'DBManager2026*', 'Superuser'),
(4, 4, '2026-04-28 09:45:57', '2026-10-15', 'esemka_web', 'JayaEsemka!04', 'Superuser'),
(5, 5, '2026-04-28 09:46:22', '2026-12-31', 'oracle_sys', 'OraSys_Admin26', 'Superuser'),
(6, 5, '2026-04-28 09:46:41', '2026-12-31', 'view_user', 'UserRead123', 'Audit Account');

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log` (
  `log_id` int NOT NULL,
  `user_id` int NOT NULL,
  `created_at` datetime NOT NULL,
  `modul` enum('Server','Manajemen Akses User','Sistem Operasi','Database','Aplikasi') NOT NULL,
  `aktivitas` text NOT NULL,
  `ip_user` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `status` enum('success','failed','warning') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `activity_log`
--

INSERT INTO `activity_log` (`log_id`, `user_id`, `created_at`, `modul`, `aktivitas`, `ip_user`, `status`) VALUES
(1, 1, '2026-06-21 13:41:35', 'Aplikasi', '[Import dari Excel] Berhasil mengimport [2] data [Aplikasi] baru melalui file Excel Aplikasi', '127.0.0.1', 'success'),
(2, 1, '2026-06-21 13:43:34', 'Aplikasi', '[Import dari Excel] Berhasil mengimport [2] data [Aplikasi] baru melalui file Excel Aplikasi', '127.0.0.1', 'success'),
(3, 1, '2026-06-21 13:53:33', 'Aplikasi', '[Import dari Excel] Gagal memproses [2] baris data [Aplikasi] pada Excel pada baris: [2 (Duplikat Nama), 3 (Duplikat Nama)] akibat ketidaksesuaian Relasi Master', '127.0.0.1', 'failed'),
(4, 1, '2026-06-21 14:07:20', 'Aplikasi', '[Import dari Excel] Gagal memproses [2] baris data [Aplikasi] pada Excel pada baris: [2 (Duplikat Nama), 3 (Duplikat Nama)] akibat ketidaksesuaian Relasi Master', '127.0.0.1', 'failed'),
(5, 1, '2026-06-21 14:09:22', 'Aplikasi', '[Import dari Excel] Gagal memproses [2] baris data [Aplikasi] pada Excel pada baris: [2 (Duplikat Nama), 3 (Duplikat Nama)] akibat ketidaksesuaian Relasi Master', '127.0.0.1', 'failed'),
(6, 1, '2026-06-21 14:14:36', 'Aplikasi', '[Import dari Excel] Gagal memproses [2] baris data [Aplikasi] pada Excel pada baris: [2 (Duplikat Nama), 3 (Duplikat Nama)] akibat ketidaksesuaian Relasi Master', '127.0.0.1', 'failed'),
(7, 1, '2026-06-21 14:26:57', 'Aplikasi', '[Import dari Excel] Gagal memproses [2] baris data [Aplikasi] pada Excel pada baris: [2 (Nama sudah Ada), 3 (Nama sudah Ada)] akibat ketidaksesuaian Relasi Master', '127.0.0.1', 'failed'),
(8, 1, '2026-06-21 14:29:27', 'Aplikasi', '[Import dari Excel] Gagal memproses [2] baris data [Aplikasi] pada Excel pada baris: [2 (Nama sudah Ada), 3 (Nama sudah Ada)] akibat ketidaksesuaian Relasi Master', '127.0.0.1', 'failed'),
(9, 1, '2026-06-21 14:32:51', 'Aplikasi', '[Import dari Excel] Gagal memproses [2] baris data [Aplikasi] pada Excel pada baris: [2 (Nama sudah Ada), 3 (Nama sudah Ada)] akibat ketidaksesuaian Relasi Master', '127.0.0.1', 'failed'),
(10, 1, '2026-06-21 14:43:27', 'Aplikasi', '[Import dari Excel] Gagal memproses [2] baris data [Aplikasi] pada Excel pada baris: [2 (Nama sudah Ada), 3 (Nama sudah Ada)] akibat ketidaksesuaian Relasi Master', '127.0.0.1', 'failed'),
(11, 1, '2026-06-21 14:44:15', 'Aplikasi', '[Import dari Excel] Gagal memproses [2] baris data [Aplikasi] pada Excel pada baris: [2 (Nama sudah Ada), 3 (Nama sudah Ada)] akibat ketidaksesuaian Relasi Master', '127.0.0.1', 'failed'),
(12, 1, '2026-06-21 14:44:44', 'Aplikasi', '[Import dari Excel] Gagal memproses [2] baris data [Aplikasi] pada Excel pada baris: [2 (Nama sudah Ada), 3 (Nama sudah Ada)] akibat ketidaksesuaian Relasi Master', '127.0.0.1', 'failed'),
(13, 1, '2026-06-21 14:45:23', 'Aplikasi', '[Import dari Excel] Gagal memproses [2] baris data [Aplikasi] pada Excel pada baris: [2 (Nama sudah Ada), 3 (Nama sudah Ada)] akibat ketidaksesuaian Relasi Master', '127.0.0.1', 'failed'),
(14, 1, '2026-06-21 14:46:36', 'Aplikasi', '[Import dari Excel] Gagal memproses [2] baris data [Aplikasi] pada Excel pada baris: [2 (Nama sudah Ada), 3 (Nama sudah Ada)] akibat ketidaksesuaian Relasi Master', '127.0.0.1', 'failed'),
(15, 1, '2026-06-21 15:22:23', 'Aplikasi', '[Import dari Excel] Gagal memproses [2] baris data [Aplikasi] pada Excel pada baris: [2 (Nama sudah Ada), 3 (Nama sudah Ada)] akibat ketidaksesuaian Relasi Master', '127.0.0.1', 'failed'),
(16, 1, '2026-06-25 04:04:28', 'Aplikasi', '[Hapus data] Admin menghapus data aplikasi: [SKK Migas Core]', '127.0.0.1', 'success'),
(17, 1, '2026-06-25 04:04:31', 'Aplikasi', '[Hapus data] Admin menghapus data aplikasi: [SKK Migas Health]', '127.0.0.1', 'success'),
(18, 1, '2026-06-25 04:04:50', 'Aplikasi', '[Import dari Excel] Berhasil mengimport [2] data [Aplikasi] baru melalui file Excel Aplikasi', '127.0.0.1', 'success'),
(19, 1, '2026-06-25 04:09:02', 'Aplikasi', '[Hapus data] Admin menghapus data aplikasi: [SKK Migas Core]', '127.0.0.1', 'success'),
(20, 1, '2026-06-25 04:09:04', 'Aplikasi', '[Hapus data] Admin menghapus data aplikasi: [SKK Migas Health]', '127.0.0.1', 'success'),
(21, 1, '2026-06-25 04:09:08', 'Aplikasi', '[Import dari Excel] Berhasil mengimport [2] data [Aplikasi] baru melalui file Excel Aplikasi', '127.0.0.1', 'success'),
(22, 1, '2026-06-25 04:10:16', 'Aplikasi', '[Import dari Excel] Gagal memproses [2] baris data [Aplikasi] pada Excel pada baris: [2 (Nama sudah Ada), 3 (Nama sudah Ada)] akibat ketidaksesuaian Relasi Master', '127.0.0.1', 'failed'),
(23, 1, '2026-06-25 04:22:34', 'Aplikasi', '[Import dari Excel] Gagal mengimport data Aplikasi darl Excel. Template spreadsheet tidak sesuai', '127.0.0.1', 'failed'),
(24, 1, '2026-06-25 04:22:39', 'Aplikasi', '[Import dari Excel] Gagal mengimport data Aplikasi darl Excel. Template spreadsheet tidak sesuai', '127.0.0.1', 'failed'),
(25, 1, '2026-06-25 04:25:47', 'Aplikasi', '[Import dari Excel] Gagal mengimport data Aplikasi darl Excel. Template spreadsheet tidak sesuai', '127.0.0.1', 'failed'),
(26, 1, '2026-06-25 04:26:02', 'Aplikasi', '[Import dari Excel] Gagal memproses [2] baris data [Aplikasi] pada Excel pada baris: [2 (Nama sudah Ada), 3 (Nama sudah Ada)] akibat ketidaksesuaian Relasi Master', '127.0.0.1', 'failed'),
(27, 1, '2026-06-25 04:26:33', 'Aplikasi', '[Import dari Excel] Gagal mengimport data Aplikasi darl Excel. Template spreadsheet tidak sesuai', '127.0.0.1', 'failed'),
(28, 1, '2026-06-25 04:28:11', 'Aplikasi', '[Import dari Excel] Gagal mengimport data Aplikasi darl Excel. Template spreadsheet tidak sesuai', '127.0.0.1', 'failed'),
(29, 1, '2026-06-25 04:28:15', 'Aplikasi', '[Import dari Excel] Gagal memproses [2] baris data [Aplikasi] pada Excel pada baris: [2 (Nama sudah Ada), 3 (Nama sudah Ada)] akibat ketidaksesuaian Relasi Master', '127.0.0.1', 'failed'),
(30, 1, '2026-06-28 16:42:59', 'Aplikasi', '[Import dari Excel] Gagal mengimport data Aplikasi darl Excel. Template spreadsheet tidak sesuai', '127.0.0.1', 'failed'),
(31, 1, '2026-06-28 17:29:58', 'Aplikasi', '[Import dari Excel] Gagal mengimport data Aplikasi darl Excel. Template spreadsheet tidak sesuai', '127.0.0.1', 'failed');

-- --------------------------------------------------------

--
-- Table structure for table `aplikasi`
--

CREATE TABLE `aplikasi` (
  `aplikasi_id` int NOT NULL,
  `server_id` int NOT NULL,
  `account_id` int NOT NULL,
  `os_id` int NOT NULL,
  `db_id` int NOT NULL,
  `created_at` datetime NOT NULL,
  `ssl_expired` datetime NOT NULL,
  `id_key` varchar(100) NOT NULL,
  `nama` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `ip` varchar(50) NOT NULL,
  `status` enum('Aktif','Nonaktif') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `aplikasi`
--

INSERT INTO `aplikasi` (`aplikasi_id`, `server_id`, `account_id`, `os_id`, `db_id`, `created_at`, `ssl_expired`, `id_key`, `nama`, `url`, `password`, `ip`, `status`) VALUES
(2, 5, 5, 9, 3, '2026-05-09 21:52:54', '2026-12-31 19:36:34', 'ORCLE-HELPDESK001', 'Oracle Helpdesk System', 'https://oracle.helpdesk.org/', 'B15m1ll@h8*', '127.0.0.1', 'Aktif'),
(5, 2, 1, 6, 2, '2026-06-18 11:35:30', '2026-07-25 00:00:00', 'SAP-123728HUIJ', 'SAP Helpdesk', 'https://saphelpdesk.com/', '12345', '127.0.0.1', 'Aktif'),
(12, 5, 1, 7, 4, '2026-06-25 04:09:08', '2027-01-01 00:00:00', 'SKK-M1G4S', 'SKK Migas Core', 'https://skkmigas-core.go/', '4lh@mdul1ll@h8*', '127.0.0.1', 'Aktif'),
(13, 5, 1, 7, 4, '2026-06-25 04:09:08', '2028-01-01 00:00:00', 'SKK-M1G438', 'SKK Migas Health', 'https://skkmigas-health.go/', 'B15m1ll@h9*', '127.0.0.1', 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `db`
--

CREATE TABLE `db` (
  `db_id` int NOT NULL,
  `db_name` varchar(100) NOT NULL,
  `status` enum('Active','Nonactive') NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `db`
--

INSERT INTO `db` (`db_id`, `db_name`, `status`, `created_at`) VALUES
(1, 'MySQL 8.0', 'Active', '2026-04-28 09:37:00'),
(2, 'PostgreSQL 15', 'Active', '2026-04-28 09:37:06'),
(3, 'Oracle Database 19c', 'Active', '2026-04-28 09:38:32'),
(4, 'Microsoft SQL Server 2019', 'Active', '2026-04-28 09:38:39');

-- --------------------------------------------------------

--
-- Table structure for table `laporan`
--

CREATE TABLE `laporan` (
  `lapor_id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `account_id` int DEFAULT NULL,
  `db_id` int DEFAULT NULL,
  `os_id` int DEFAULT NULL,
  `server_id` int DEFAULT NULL,
  `tgl` datetime NOT NULL,
  `subjek` varchar(150) NOT NULL,
  `isi` text NOT NULL,
  `respon` text NOT NULL,
  `status` enum('Belum dibaca','Sedang diproses','Selesai') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `laporan`
--

INSERT INTO `laporan` (`lapor_id`, `user_id`, `account_id`, `db_id`, `os_id`, `server_id`, `tgl`, `subjek`, `isi`, `respon`, `status`) VALUES
(1, 9, NULL, NULL, NULL, 2, '2026-04-28 09:52:11', '(SRV-PROD-APP-01) - High CPU Usage', 'Load CPU mencapai 95% pada jam sibuk, aplikasi melambat.', '', 'Belum dibaca'),
(2, 9, NULL, NULL, NULL, 4, '2026-04-28 09:52:33', '(SRV-WEB-ESEMKA) - SSL Certificate Expired', 'Sertifikat SSL web ESEMKA akan habis dalam 2 hari, mohon renewal.', '', 'Belum dibaca'),
(3, 9, NULL, NULL, NULL, 2, '2026-04-28 09:52:45', '(SRV-PROD-APP-01) - Disk Space Warning', 'Partisi /var/log pada server produksi hampir penuh (92%).', '', 'Belum dibaca'),
(4, 9, NULL, NULL, NULL, 5, '2026-04-28 09:53:16', '(SRV-CORE-ORACLE) - Slow Query PostgreSQL', 'Respon database melambat secara signifikan pada jam 14.00 WIB tadi.', '', 'Belum dibaca'),
(5, 9, NULL, NULL, NULL, 3, '2026-04-28 09:53:33', '(SRV-WIN-DB-01) - Windows Update Failure', 'Update KB5031356 gagal terinstal otomatis, butuh pengecekan manual.', '', 'Belum dibaca'),
(6, 9, NULL, 3, NULL, NULL, '2026-04-28 09:55:27', '[Database] SRV-CORE-ORACLE Slow Query', '(Kategori: Database) Query ke database Oracle melambat signifikan pada jam 14.00 WIB tadi.', '', 'Belum dibaca'),
(7, 9, 1, NULL, NULL, NULL, '2026-04-28 09:55:45', '[Akun Server] Lupa Password admin_root', '(Kategori: Akun Server) Tolong reset password untuk akun admin_root di server produksi, saya lupa simpan.', '', 'Belum dibaca'),
(8, 9, NULL, NULL, 6, NULL, '2026-04-28 09:56:05', '[Sistem Operasi] Ubuntu Mirror Error', '(Kategori: Sistem Operasi) Gagal melakukan \'apt update\' karena mirror repository tidak ditemukan/RTO.', 'Ada pokoknya', 'Selesai');

-- --------------------------------------------------------

--
-- Table structure for table `os`
--

CREATE TABLE `os` (
  `os_id` int NOT NULL,
  `created_at` datetime NOT NULL,
  `os_name` varchar(100) NOT NULL,
  `status` enum('Active','Nonactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `os`
--

INSERT INTO `os` (`os_id`, `created_at`, `os_name`, `status`) VALUES
(6, '2026-04-28 09:36:30', 'Ubuntu Server 22.04 LTS', 'Active'),
(7, '2026-04-28 09:36:36', 'Windows Server 2019 Standard', 'Active'),
(8, '2026-04-28 09:36:43', 'CentOS Stream 9', 'Active'),
(9, '2026-04-28 09:36:49', 'RedHat Enterprise Linux 8', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `servers`
--

CREATE TABLE `servers` (
  `server_id` int NOT NULL,
  `os_id` int NOT NULL,
  `db_id` int NOT NULL,
  `created_at` datetime NOT NULL,
  `server_name` varchar(150) NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `ip_address` varchar(50) NOT NULL,
  `location` varchar(150) NOT NULL,
  `status` enum('Active','Nonactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `servers`
--

INSERT INTO `servers` (`server_id`, `os_id`, `db_id`, `created_at`, `server_name`, `email`, `ip_address`, `location`, `status`) VALUES
(2, 6, 2, '2026-04-28 09:39:53', 'SRV-PROD-APP-01', 'admin.it@corp.com', '192.168.10.51', 'Data Center Jakarta', 'Active'),
(3, 7, 4, '2026-04-28 09:40:46', 'SRV-WIN-DB-01', 'db.admin@corp.com', '192.168.10.52', 'Office Bekasi Timur', 'Active'),
(4, 6, 1, '2026-04-28 09:41:29', 'SRV-WEB-ESEMKA', 'webmaster@esemka.id', '10.20.30.101', 'Cloud AWS Singapore', 'Active'),
(5, 9, 3, '2026-04-28 09:42:29', 'SRV-CORE-ORACLE', 'sys.admin@corp.com', '172.16.5.10', 'IKN Kalimantan', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int NOT NULL,
  `created_at` datetime NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` enum('Admin','Viewer') NOT NULL,
  `status` enum('Active','Nonactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `created_at`, `username`, `password`, `nama`, `email`, `role`, `status`) VALUES
(1, '2025-06-21 06:36:22', 'superizz', 'B15m1ll@h7*', 'Superizzz', 'superizz@gmail.com', 'Admin', 'Active'),
(9, '2025-06-22 04:02:21', 'mhnfarizi04', '201204', 'Muhammad Farizi', 'mhnfarizi04@gmail.com', 'Viewer', 'Active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`account_id`);

--
-- Indexes for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `aplikasi`
--
ALTER TABLE `aplikasi`
  ADD PRIMARY KEY (`aplikasi_id`);

--
-- Indexes for table `db`
--
ALTER TABLE `db`
  ADD PRIMARY KEY (`db_id`);

--
-- Indexes for table `laporan`
--
ALTER TABLE `laporan`
  ADD PRIMARY KEY (`lapor_id`);

--
-- Indexes for table `os`
--
ALTER TABLE `os`
  ADD PRIMARY KEY (`os_id`);

--
-- Indexes for table `servers`
--
ALTER TABLE `servers`
  ADD PRIMARY KEY (`server_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `account_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `log_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `aplikasi`
--
ALTER TABLE `aplikasi`
  MODIFY `aplikasi_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `db`
--
ALTER TABLE `db`
  MODIFY `db_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `laporan`
--
ALTER TABLE `laporan`
  MODIFY `lapor_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `os`
--
ALTER TABLE `os`
  MODIFY `os_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `servers`
--
ALTER TABLE `servers`
  MODIFY `server_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
