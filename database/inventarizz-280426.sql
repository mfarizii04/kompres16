-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 28, 2026 at 02:57 AM
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
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('Admin','Dev','Readonly') NOT NULL,
  `created_at` datetime NOT NULL,
  `expired_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`account_id`, `server_id`, `username`, `password`, `role`, `created_at`, `expired_at`) VALUES
(1, 2, 'admin_root', 'RootP@ss2026!', 'Admin', '2026-04-28 09:44:15', '2026-12-03'),
(2, 2, 'dev_audit', 'AuditOnly#99', 'Readonly', '2026-04-28 09:45:01', '2026-06-30'),
(3, 3, 'sql_admin', 'DBManager2026*', 'Admin', '2026-04-28 09:45:29', '2026-12-31'),
(4, 4, 'esemka_web', 'JayaEsemka!04', 'Dev', '2026-04-28 09:45:57', '2026-10-15'),
(5, 5, 'oracle_sys', 'OraSys_Admin26', 'Admin', '2026-04-28 09:46:22', '2026-12-31'),
(6, 5, 'view_user', 'UserRead123', 'Readonly', '2026-04-28 09:46:41', '2026-12-31');

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
-- Table structure for table `excel`
--

CREATE TABLE `excel` (
  `id` int NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telepon` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `excel`
--

INSERT INTO `excel` (`id`, `nama`, `email`, `telepon`) VALUES
(1, 'Chimot', 'chimot@gmail.com', '123'),
(2, 'Chimoti', 'chimoti@gmail.com', '456'),
(3, 'Koke', 'koke@gmail.com', '777'),
(4, 'Chema', 'chema@gmail.com', '3849'),
(5, 'Kelly', 'kelly@gmail.com', '50234'),
(6, 'Mbeumo', 'mbeumo@gmail.com', '1234'),
(7, 'Sumanto', 'sumanto@gmail.com', '4564'),
(8, 'Udu', 'udu@gmail.com', '7774'),
(9, 'Bolu', 'bolu@gmail.com', '545454'),
(10, 'Lahm', 'lahm@gmail.com', '443434');

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
(8, 9, NULL, NULL, 6, NULL, '2026-04-28 09:56:05', '[Sistem Operasi] Ubuntu Mirror Error', '(Kategori: Sistem Operasi) Gagal melakukan \'apt update\' karena mirror repository tidak ditemukan/RTO.', '', 'Belum dibaca');

-- --------------------------------------------------------

--
-- Table structure for table `os`
--

CREATE TABLE `os` (
  `os_id` int NOT NULL,
  `os_name` varchar(100) NOT NULL,
  `status` enum('Active','Nonactive') NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `os`
--

INSERT INTO `os` (`os_id`, `os_name`, `status`, `created_at`) VALUES
(6, 'Ubuntu Server 22.04 LTS', 'Active', '2026-04-28 09:36:30'),
(7, 'Windows Server 2019 Standard', 'Active', '2026-04-28 09:36:36'),
(8, 'CentOS Stream 9', 'Active', '2026-04-28 09:36:43'),
(9, 'RedHat Enterprise Linux 8', 'Active', '2026-04-28 09:36:49');

-- --------------------------------------------------------

--
-- Table structure for table `servers`
--

CREATE TABLE `servers` (
  `server_id` int NOT NULL,
  `os_id` int NOT NULL,
  `db_id` int NOT NULL,
  `server_name` varchar(150) NOT NULL,
  `ip_address` varchar(50) NOT NULL,
  `location` varchar(150) NOT NULL,
  `status` enum('Active','Nonactive') NOT NULL,
  `email` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `servers`
--

INSERT INTO `servers` (`server_id`, `os_id`, `db_id`, `server_name`, `ip_address`, `location`, `status`, `email`, `created_at`) VALUES
(2, 6, 2, 'SRV-PROD-APP-01', '192.168.10.51', 'Data Center Jakarta', 'Active', 'admin.it@corp.com', '2026-04-28 09:39:53'),
(3, 7, 4, 'SRV-WIN-DB-01', '192.168.10.52', 'Office Bekasi Timur', 'Active', 'db.admin@corp.com', '2026-04-28 09:40:46'),
(4, 6, 1, 'SRV-WEB-ESEMKA', '10.20.30.101', 'Cloud AWS Singapore', 'Active', 'webmaster@esemka.id', '2026-04-28 09:41:29'),
(5, 9, 3, 'SRV-CORE-ORACLE', '172.16.5.10', 'IKN Kalimantan', 'Active', 'sys.admin@corp.com', '2026-04-28 09:42:29');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` enum('Admin','Viewer') NOT NULL,
  `created_at` datetime NOT NULL,
  `status` enum('Active','Nonactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `nama`, `email`, `role`, `created_at`, `status`) VALUES
(1, 'superizz', 'B15m1ll@h7*', 'Superizzz', 'superizz@gmail.com', 'Admin', '2025-06-21 06:36:22', 'Active'),
(9, 'mhnfarizi04', '201204', 'Muhammad Farizi', 'mhnfarizi04@gmail.com', 'Viewer', '2025-06-22 04:02:21', 'Active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`account_id`);

--
-- Indexes for table `db`
--
ALTER TABLE `db`
  ADD PRIMARY KEY (`db_id`);

--
-- Indexes for table `excel`
--
ALTER TABLE `excel`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `db`
--
ALTER TABLE `db`
  MODIFY `db_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `excel`
--
ALTER TABLE `excel`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
