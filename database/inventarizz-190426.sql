-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 19, 2026 at 06:09 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 7.4.30

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
  `account_id` int(11) NOT NULL,
  `server_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('Admin','Dev','Readonly') NOT NULL,
  `created_at` datetime NOT NULL,
  `expired_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`account_id`, `server_id`, `username`, `password`, `role`, `created_at`, `expired_at`) VALUES
(1, 1, 'admin@esemka', 'esemka', 'Admin', '2025-06-23 06:46:15', '2025-06-25');

-- --------------------------------------------------------

--
-- Table structure for table `db`
--

CREATE TABLE `db` (
  `db_id` int(11) NOT NULL,
  `db_name` varchar(100) NOT NULL,
  `status` enum('Active','Nonactive') NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `db`
--

INSERT INTO `db` (`db_id`, `db_name`, `status`, `created_at`) VALUES
(4, 'PostgreSQL', 'Active', '2025-06-22 00:00:00'),
(6, 'MySQL', 'Active', '2025-06-22 00:00:00'),
(7, 'Oracle', 'Active', '2025-06-22 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `laporan`
--

CREATE TABLE `laporan` (
  `lapor_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `account_id` int(11) DEFAULT NULL,
  `db_id` int(11) DEFAULT NULL,
  `os_id` int(11) DEFAULT NULL,
  `server_id` int(11) DEFAULT NULL,
  `tgl` datetime NOT NULL,
  `subjek` varchar(150) NOT NULL,
  `isi` text NOT NULL,
  `respon` text NOT NULL,
  `status` enum('Belum dibaca','Sedang diproses','Selesai') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `laporan`
--

INSERT INTO `laporan` (`lapor_id`, `user_id`, `account_id`, `db_id`, `os_id`, `server_id`, `tgl`, `subjek`, `isi`, `respon`, `status`) VALUES
(3, 9, NULL, NULL, NULL, 1, '2025-07-12 11:51:43', 'Server_ESEMKA 2.0_Lemottt kayak Keong!!', 'Server_ESEMKA 2.0_Lemottt kayak Keong!!Server_ESEMKA 2.0_Lemottt kayak Keong!!Server_ESEMKA 2.0_Lemottt kayak Keong!!Server_ESEMKA 2.0_Lemottt kayak Keong!!', '', 'Belum dibaca'),
(4, 9, NULL, NULL, 3, NULL, '2025-07-12 12:04:22', 'Sistem Operasi_Windows Server 2012_OS nya Bajakan!!', 'OS Windows Server 2012 tolong dibeli yang original dong.. jangan pake bajakan. Kantor elit, beli os sulittt', '', 'Belum dibaca'),
(5, 9, 1, NULL, NULL, NULL, '2025-07-14 10:46:35', 'Akun Server_admin@esemka_Akun-nya direport karena lupa password', 'Tolong dong teruntuk Mas Atmin, supaya bisa reset password pada akun server admin@esemka huhu', '', 'Belum dibaca'),
(6, 9, NULL, 6, NULL, NULL, '2025-07-14 10:51:52', 'Database_MySQL_Versi MySQL tidak sesuai dengan server', 'Mohon teruntuk Mas Atmin supaya memperbarui versi MySQL , ketika saya menjalankan server ESEMKA 2.0 untuk memperbaiki projek PHP + MySQL CRUD malah error karena versi MySQL (database) tidak cocok dengan server! Tolong diperbaiki ya Mas Atmin. Hatur nuhun!', '', 'Belum dibaca');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `log_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `action` text NOT NULL,
  `log_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `os`
--

CREATE TABLE `os` (
  `os_id` int(11) NOT NULL,
  `os_name` varchar(100) NOT NULL,
  `status` enum('Active','Nonactive') NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `os`
--

INSERT INTO `os` (`os_id`, `os_name`, `status`, `created_at`) VALUES
(2, 'RedHat Enterprise', 'Active', '2025-06-22 06:26:10'),
(3, 'Windows Server 2012', 'Active', '2025-06-22 06:26:25');

-- --------------------------------------------------------

--
-- Table structure for table `servers`
--

CREATE TABLE `servers` (
  `server_id` int(11) NOT NULL,
  `os_id` int(11) NOT NULL,
  `db_id` int(11) NOT NULL,
  `server_name` varchar(150) NOT NULL,
  `ip_address` varchar(50) NOT NULL,
  `location` varchar(150) NOT NULL,
  `status` enum('Active','Nonactive') NOT NULL,
  `email` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `servers`
--

INSERT INTO `servers` (`server_id`, `os_id`, `db_id`, `server_name`, `ip_address`, `location`, `status`, `email`, `created_at`) VALUES
(1, 2, 7, 'ESEMKA 2.0', '127.0.0.1', 'IKN Kalimantan', 'Active', 'serveresemka@email.com', '2025-06-22 10:41:33');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` enum('Admin','Viewer') NOT NULL,
  `created_at` datetime NOT NULL,
  `status` enum('Active','Nonactive') NOT NULL,
  `tgl_login` datetime DEFAULT NULL,
  `status_login` enum('Online','Offline') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `nama`, `email`, `role`, `created_at`, `status`, `tgl_login`, `status_login`) VALUES
(1, 'superizz', '123', 'Superizzz', 'superizz@gmail.com', 'Admin', '2025-06-21 06:36:22', 'Active', NULL, 'Offline'),
(9, 'mhnfarizi04', '123', 'Muhammad Farizi', 'mhnfarizi04@gmail.com', 'Viewer', '2025-06-22 04:02:21', 'Active', '2025-07-21 13:20:39', 'Online');

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
-- Indexes for table `laporan`
--
ALTER TABLE `laporan`
  ADD PRIMARY KEY (`lapor_id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`log_id`);

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
  MODIFY `account_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `db`
--
ALTER TABLE `db`
  MODIFY `db_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `laporan`
--
ALTER TABLE `laporan`
  MODIFY `lapor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `os`
--
ALTER TABLE `os`
  MODIFY `os_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `servers`
--
ALTER TABLE `servers`
  MODIFY `server_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
