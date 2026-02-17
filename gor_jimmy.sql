-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 17, 2026 at 03:47 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gor_jimmy`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id` varchar(255) NOT NULL,
  `kode` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `whatsapp` varchar(100) NOT NULL,
  `jenis` enum('Biasa','Member') NOT NULL,
  `lapangan` varchar(100) NOT NULL,
  `jadwal` varchar(100) NOT NULL,
  `tanggal` date NOT NULL,
  `hari` varchar(50) NOT NULL,
  `status` enum('Pending','Booked','Selesai','Dibatalkan','Blokir') NOT NULL,
  `dp` int(20) NOT NULL,
  `total_bayar` varchar(20) NOT NULL,
  `invoice` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id`, `kode`, `nama`, `whatsapp`, `jenis`, `lapangan`, `jadwal`, `tanggal`, `hari`, `status`, `dp`, `total_bayar`, `invoice`, `created_at`, `updated_at`) VALUES
('BO-0L1VIO', 'ORDER-AN8GXXZR', 'Indy', '085333633621', 'Biasa', 'LAP-3ZULJO', 'JAD-Z5X6T3', '2026-02-18', 'Rabu', 'Booked', 165000, '165000', NULL, '2026-02-17 04:29:56', '2026-02-17 06:47:52'),
('BO-7A4ZEM', 'ORDER-SRA4GTDL', 'ANDIKA SAPUTRA', '085333633621', 'Biasa', 'LAP-3ZULJO', 'JAD-8DZSCX', '2026-02-18', 'Rabu', 'Booked', 150000, '150000', NULL, '2026-02-15 05:06:14', '2026-02-15 13:45:46'),
('BO-ALBOIC', 'ORDER-AN8GXXZR', 'Indy', '085333633621', 'Biasa', 'LAP-3ZULJO', 'JAD-EH8DCP', '2026-02-18', 'Rabu', 'Booked', 165000, '165000', NULL, '2026-02-17 04:29:56', '2026-02-17 06:47:52'),
('BO-ASI2BY', 'ORDER-K0CHHC5V', 'ANDIKA SAPUTRA', '085333633621', 'Biasa', 'LAP-3ZULJO', 'JAD-QITULM', '2026-02-18', 'Rabu', 'Booked', 150000, '150000', NULL, '2026-02-10 12:51:03', '2026-02-16 02:37:01'),
('BO-BZQDBL', 'ORDER-GFGSPZEY', 'Andika Saputra', '085333633621', 'Biasa', 'LAP-3ZULJO', 'JAD-JKOIFW', '2026-02-18', 'Rabu', 'Booked', 50000, '150000', NULL, '2026-02-17 06:49:20', '2026-02-17 06:50:21'),
('BO-ER4EVI', 'ORDER-3XDXWZ1R', 'Andika Saputra', '085333633621', 'Member', 'LAP-OEMRB1', 'JAD-JAAT1Q', '2026-02-18', 'Rabu', 'Booked', 150000, '150000', NULL, '2026-02-16 07:16:59', '2026-02-17 06:47:06'),
('BO-KTKQ8S', 'ORDER-RBAAGJMY', 'cris', '537464857943', 'Member', 'LAP-3ZULJO', 'JAD-NFCKAH', '2026-02-18', 'Rabu', 'Pending', 50000, '75000', NULL, '2026-02-17 06:44:44', '2026-02-17 06:44:44'),
('BO-O37OVU', 'ORDER-3XDXWZ1R', 'Andika Saputra', '085333633621', 'Member', 'LAP-OEMRB1', 'JAD-DH2Y0K', '2026-02-18', 'Rabu', 'Booked', 150000, '150000', NULL, '2026-02-16 07:16:59', '2026-02-17 06:47:06'),
('BO-USJDG0', 'ORDER-SRA4GTDL', 'ANDIKA SAPUTRA', '085333633621', 'Biasa', 'LAP-3ZULJO', 'JAD-9TSPSF', '2026-02-18', 'Rabu', 'Booked', 150000, '150000', NULL, '2026-02-15 05:06:15', '2026-02-15 13:45:46'),
('BO-VFUE8P', 'ORDER-GFGSPZEY', 'Andika Saputra', '085333633621', 'Biasa', 'LAP-3ZULJO', 'JAD-IHTQGZ', '2026-02-18', 'Rabu', 'Booked', 50000, '150000', NULL, '2026-02-17 06:49:20', '2026-02-17 06:50:21');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `galeri`
--

CREATE TABLE `galeri` (
  `id` varchar(255) NOT NULL,
  `gambar` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `galeri`
--

INSERT INTO `galeri` (`id`, `gambar`, `created_at`, `updated_at`) VALUES
('GAL-SMQESH', '1770754398_landing_page.png', '2026-02-10 13:13:18', '2026-02-10 20:13:18');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

CREATE TABLE `jadwal` (
  `id` varchar(255) NOT NULL,
  `lapangan` varchar(255) NOT NULL,
  `hari` varchar(100) NOT NULL,
  `waktu` varchar(100) NOT NULL,
  `status` enum('Tersedia','Booked','Blokir') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jadwal`
--

INSERT INTO `jadwal` (`id`, `lapangan`, `hari`, `waktu`, `status`, `created_at`, `updated_at`) VALUES
('JAD-04V9JS', 'LAP-3ZULJO', 'Jumat', '17.00-18.00', 'Tersedia', '2026-02-09 05:44:24', '2026-02-09 05:44:24'),
('JAD-0AI3LV', 'LAP-OEMRB1', 'Minggu', '11.00-12.00', 'Tersedia', '2026-02-09 10:02:33', '2026-02-09 10:02:33'),
('JAD-0XFJ4B', 'LAP-3ZULJO', 'Senin', '15.00-16.00', 'Tersedia', '2026-02-09 02:59:00', '2026-02-09 02:59:00'),
('JAD-15IFLU', 'LAP-OEMRB1', 'Kamis', '20.00-21.00', 'Tersedia', '2026-02-09 09:54:07', '2026-02-09 09:54:07'),
('JAD-1JRQPQ', 'LAP-OEMRB1', 'Sabtu', '10.00-11.00', 'Tersedia', '2026-02-09 09:59:44', '2026-02-09 09:59:44'),
('JAD-1N7ZR1', 'LAP-OEMRB1', 'Rabu', '17.00-18.00', 'Tersedia', '2026-02-09 09:50:41', '2026-02-10 06:11:14'),
('JAD-1OIPZA', 'LAP-3ZULJO', 'Kamis', '09.00-10.00', 'Tersedia', '2026-02-09 05:38:32', '2026-02-09 05:38:32'),
('JAD-1SJWZF', 'LAP-OEMRB1', 'Sabtu', '19.00-20.00', 'Tersedia', '2026-02-09 10:01:03', '2026-02-09 10:01:03'),
('JAD-1ZQQPI', 'LAP-3ZULJO', 'Jumat', '11.00-12.00', 'Tersedia', '2026-02-09 05:43:15', '2026-02-09 05:43:15'),
('JAD-3KXAJC', 'LAP-3ZULJO', 'Selasa', '20.00-21.00', 'Tersedia', '2026-02-09 03:31:57', '2026-02-09 03:31:57'),
('JAD-3LHDTI', 'LAP-OEMRB1', 'Sabtu', '18.00-19.00', 'Tersedia', '2026-02-09 10:00:54', '2026-02-09 10:00:54'),
('JAD-3MCDXB', 'LAP-3ZULJO', 'Sabtu', '21.00-22.00', 'Tersedia', '2026-02-09 05:50:38', '2026-02-09 05:50:38'),
('JAD-3P2SH3', 'LAP-OEMRB1', 'Selasa', '15.00-16.00', 'Tersedia', '2026-02-09 09:48:01', '2026-02-09 09:48:01'),
('JAD-43NR85', 'LAP-OEMRB1', 'Selasa', '18.00-19.00', 'Tersedia', '2026-02-09 09:48:29', '2026-02-09 09:48:29'),
('JAD-47WZEV', 'LAP-3ZULJO', 'Jumat', '22.00-23.00', 'Tersedia', '2026-02-09 05:46:26', '2026-02-09 05:46:26'),
('JAD-4SN95X', 'LAP-OEMRB1', 'Selasa', '20.00-21.00', 'Tersedia', '2026-02-09 09:48:45', '2026-02-09 09:48:45'),
('JAD-4YSNHB', 'LAP-3ZULJO', 'Kamis', '08.00-09.00', 'Tersedia', '2026-02-09 05:27:01', '2026-02-09 05:27:01'),
('JAD-5CEICW', 'LAP-OEMRB1', 'Sabtu', '15.00-16.00', 'Tersedia', '2026-02-09 10:00:24', '2026-02-09 10:00:24'),
('JAD-6IJO2N', 'LAP-OEMRB1', 'Minggu', '20.00-21.00', 'Tersedia', '2026-02-09 10:03:47', '2026-02-09 10:03:47'),
('JAD-7DZUVR', 'LAP-3ZULJO', 'Senin', '21.00-22.00', 'Tersedia', '2026-02-09 03:01:55', '2026-02-09 03:01:55'),
('JAD-7LKC6J', 'LAP-OEMRB1', 'Kamis', '18.00-19.00', 'Tersedia', '2026-02-09 09:53:50', '2026-02-09 09:53:50'),
('JAD-7VGLIX', 'LAP-3ZULJO', 'Kamis', '13.00-14.00', 'Tersedia', '2026-02-09 05:39:18', '2026-02-09 05:39:18'),
('JAD-8DZSCX', 'LAP-3ZULJO', 'Rabu', '14.00-15.00', 'Booked', '2026-02-09 05:23:38', '2026-02-15 13:39:46'),
('JAD-8GFSIJ', 'LAP-3ZULJO', 'Minggu', '11.00-12.00', 'Tersedia', '2026-02-09 06:41:02', '2026-02-09 06:41:02'),
('JAD-8HHRFM', 'LAP-3ZULJO', 'Senin', '14.00-15.00', 'Tersedia', '2026-02-09 02:58:51', '2026-02-09 02:58:51'),
('JAD-8UKL1F', 'LAP-3ZULJO', 'Sabtu', '14.00-15.00', 'Tersedia', '2026-02-09 05:48:34', '2026-02-09 05:48:34'),
('JAD-971TGH', 'LAP-3ZULJO', 'Sabtu', '10.00-11.00', 'Tersedia', '2026-02-09 05:47:27', '2026-02-09 05:47:27'),
('JAD-9G4WMT', 'LAP-3ZULJO', 'Jumat', '08.00-09.00', 'Tersedia', '2026-02-09 05:42:24', '2026-02-09 05:42:24'),
('JAD-9MURVW', 'LAP-3ZULJO', 'Minggu', '22.00-23.00', 'Tersedia', '2026-02-09 06:43:36', '2026-02-09 06:43:36'),
('JAD-9TSPSF', 'LAP-3ZULJO', 'Rabu', '16.00-17.00', 'Booked', '2026-02-09 05:24:46', '2026-02-15 13:39:46'),
('JAD-A38BXR', 'LAP-OEMRB1', 'Minggu', '14.00-15.00', 'Tersedia', '2026-02-09 10:02:58', '2026-02-09 10:02:58'),
('JAD-A8WWNW', 'LAP-3ZULJO', 'Senin', '13.00-14.00', 'Tersedia', '2026-02-09 02:58:39', '2026-02-09 02:58:39'),
('JAD-AGD7US', 'LAP-OEMRB1', 'Sabtu', '13.00-14.00', 'Tersedia', '2026-02-09 10:00:08', '2026-02-09 10:00:08'),
('JAD-AIXYSG', 'LAP-OEMRB1', 'Senin', '17.00-18.00', 'Tersedia', '2026-02-09 09:45:40', '2026-02-09 09:45:40'),
('JAD-AJJ8ZZ', 'LAP-OEMRB1', 'Rabu', '12.00-13.00', 'Tersedia', '2026-02-09 09:50:02', '2026-02-09 09:50:02'),
('JAD-AMAIAC', 'LAP-3ZULJO', 'Senin', '10.00-11.00', 'Tersedia', '2026-02-09 02:58:03', '2026-02-09 02:58:03'),
('JAD-AMTXWF', 'LAP-3ZULJO', 'Selasa', '16.00-17.00', 'Tersedia', '2026-02-09 03:28:09', '2026-02-09 03:28:09'),
('JAD-AMZTI7', 'LAP-OEMRB1', 'Jumat', '14.00-15.00', 'Tersedia', '2026-02-09 09:57:35', '2026-02-09 09:57:35'),
('JAD-AN7QHM', 'LAP-OEMRB1', 'Kamis', '19.00-20.00', 'Tersedia', '2026-02-09 09:53:59', '2026-02-09 09:53:59'),
('JAD-AZVVSC', 'LAP-OEMRB1', 'Sabtu', '17.00-18.00', 'Tersedia', '2026-02-09 10:00:45', '2026-02-09 10:00:45'),
('JAD-BKZNFH', 'LAP-OEMRB1', 'Jumat', '20.00-21.00', 'Tersedia', '2026-02-09 09:58:21', '2026-02-09 09:58:21'),
('JAD-BY7GBB', 'LAP-3ZULJO', 'Selasa', '17.00-18.00', 'Tersedia', '2026-02-09 03:28:19', '2026-02-09 03:28:19'),
('JAD-BYYZVP', 'LAP-OEMRB1', 'Rabu', '21.00-22.00', 'Tersedia', '2026-02-09 09:51:16', '2026-02-09 09:51:16'),
('JAD-CF2K2L', 'LAP-OEMRB1', 'Selasa', '08.00-09.00', 'Tersedia', '2026-02-09 09:46:41', '2026-02-09 09:46:41'),
('JAD-COJZ4R', 'LAP-OEMRB1', 'Minggu', '09.00-10.00', 'Tersedia', '2026-02-09 10:02:12', '2026-02-09 10:02:12'),
('JAD-CSQJCT', 'LAP-3ZULJO', 'Sabtu', '20.00-21.00', 'Tersedia', '2026-02-09 05:50:26', '2026-02-09 05:50:26'),
('JAD-CUHC1D', 'LAP-OEMRB1', 'Rabu', '11.00-12.00', 'Tersedia', '2026-02-09 09:49:55', '2026-02-09 09:49:55'),
('JAD-CZIX4C', 'LAP-OEMRB1', 'Minggu', '13.00-14.00', 'Tersedia', '2026-02-09 10:02:50', '2026-02-09 10:02:50'),
('JAD-D5BGUB', 'LAP-OEMRB1', 'Sabtu', '21.00-22.00', 'Tersedia', '2026-02-09 10:01:20', '2026-02-09 10:01:20'),
('JAD-D6H115', 'LAP-OEMRB1', 'Jumat', '16.00-17.00', 'Tersedia', '2026-02-09 09:57:51', '2026-02-09 09:57:51'),
('JAD-DGDU7A', 'LAP-3ZULJO', 'Rabu', '11.00-12.00', 'Tersedia', '2026-02-09 05:22:13', '2026-02-09 05:22:13'),
('JAD-DH2Y0K', 'LAP-OEMRB1', 'Rabu', '13.00-14.00', 'Booked', '2026-02-09 09:50:10', '2026-02-17 06:47:06'),
('JAD-DHATRS', 'LAP-3ZULJO', 'Jumat', '18.00-19.00', 'Tersedia', '2026-02-09 05:44:34', '2026-02-09 05:44:34'),
('JAD-DLSS7P', 'LAP-3ZULJO', 'Selasa', '08.00-09.00', 'Tersedia', '2026-02-09 03:06:52', '2026-02-09 03:06:52'),
('JAD-DOJMB2', 'LAP-3ZULJO', 'Senin', '17.00-18.00', 'Tersedia', '2026-02-09 05:38:09', '2026-02-09 05:38:09'),
('JAD-DQUZ4Z', 'LAP-OEMRB1', 'Minggu', '15.00-16.00', 'Tersedia', '2026-02-09 10:03:07', '2026-02-09 10:03:07'),
('JAD-DQVTOH', 'LAP-OEMRB1', 'Selasa', '13.00-14.00', 'Tersedia', '2026-02-09 09:47:46', '2026-02-09 09:47:46'),
('JAD-DQYXDH', 'LAP-OEMRB1', 'Senin', '13.00-14.00', 'Tersedia', '2026-02-09 09:45:01', '2026-02-09 09:45:01'),
('JAD-EGDKGP', 'LAP-OEMRB1', 'Kamis', '17.00-18.00', 'Tersedia', '2026-02-09 09:53:42', '2026-02-09 09:53:42'),
('JAD-EH8DCP', 'LAP-3ZULJO', 'Rabu', '18.00-19.00', 'Booked', '2026-02-09 05:25:19', '2026-02-17 06:47:52'),
('JAD-EIAZJG', 'LAP-OEMRB1', 'Jumat', '10.00-11.00', 'Tersedia', '2026-02-09 09:56:59', '2026-02-09 09:56:59'),
('JAD-EKEWW7', 'LAP-3ZULJO', 'Minggu', '21.00-22.00', 'Tersedia', '2026-02-09 06:43:21', '2026-02-09 06:43:21'),
('JAD-EOQKIC', 'LAP-OEMRB1', 'Jumat', '22.00-23.00', 'Tersedia', '2026-02-09 09:58:41', '2026-02-09 09:58:41'),
('JAD-F0QLLN', 'LAP-3ZULJO', 'Kamis', '21.00-22.00', 'Tersedia', '2026-02-09 05:41:29', '2026-02-09 05:41:29'),
('JAD-F1XWTK', 'LAP-OEMRB1', 'Senin', '22.00-23.00', 'Tersedia', '2026-02-09 09:46:32', '2026-02-09 09:46:32'),
('JAD-F6YVO1', 'LAP-OEMRB1', 'Senin', '08.00-09.00', 'Tersedia', '2026-02-09 06:44:18', '2026-02-09 06:44:18'),
('JAD-FDUVTA', 'LAP-3ZULJO', 'Minggu', '12.00-13.00', 'Tersedia', '2026-02-09 06:41:15', '2026-02-09 06:41:15'),
('JAD-FETRTX', 'LAP-OEMRB1', 'Rabu', '15.00-16.00', 'Tersedia', '2026-02-09 09:50:24', '2026-02-09 09:50:24'),
('JAD-FFKVES', 'LAP-OEMRB1', 'Jumat', '08.00-09.00', 'Tersedia', '2026-02-09 09:55:25', '2026-02-09 09:55:25'),
('JAD-FG147V', 'LAP-OEMRB1', 'Sabtu', '12.00-13.00', 'Tersedia', '2026-02-09 09:59:59', '2026-02-09 09:59:59'),
('JAD-FHVBQL', 'LAP-OEMRB1', 'Senin', '20.00-21.00', 'Tersedia', '2026-02-09 09:46:10', '2026-02-09 09:46:10'),
('JAD-FI0ZRJ', 'LAP-3ZULJO', 'Kamis', '18.00-19.00', 'Tersedia', '2026-02-09 05:41:00', '2026-02-09 05:41:00'),
('JAD-FPIH90', 'LAP-OEMRB1', 'Senin', '10.00-11.00', 'Tersedia', '2026-02-09 09:44:29', '2026-02-09 09:44:29'),
('JAD-FVV1WG', 'LAP-3ZULJO', 'Minggu', '17.00-18.00', 'Tersedia', '2026-02-09 06:42:25', '2026-02-09 06:42:25'),
('JAD-FYZO3K', 'LAP-3ZULJO', 'Selasa', '11.00-12.00', 'Tersedia', '2026-02-09 03:20:03', '2026-02-09 03:20:03'),
('JAD-G1CYAI', 'LAP-3ZULJO', 'Senin', '18.00-19.00', 'Tersedia', '2026-02-09 03:00:06', '2026-02-09 03:00:06'),
('JAD-G4QBDF', 'LAP-3ZULJO', 'Jumat', '20.00-21.00', 'Tersedia', '2026-02-09 05:45:46', '2026-02-09 05:45:46'),
('JAD-G6YOTQ', 'LAP-OEMRB1', 'Selasa', '19.00-20.00', 'Tersedia', '2026-02-09 09:48:37', '2026-02-09 09:48:37'),
('JAD-GEGTNM', 'LAP-OEMRB1', 'Minggu', '12.00-13.00', 'Tersedia', '2026-02-09 10:02:42', '2026-02-09 10:02:42'),
('JAD-GFJGRZ', 'LAP-OEMRB1', 'Rabu', '16.00-17.00', 'Tersedia', '2026-02-09 09:50:33', '2026-02-09 09:50:33'),
('JAD-GIP2BG', 'LAP-3ZULJO', 'Minggu', '16.00-17.00', 'Tersedia', '2026-02-09 06:42:13', '2026-02-09 06:42:13'),
('JAD-GNK7ZQ', 'LAP-3ZULJO', 'Sabtu', '11.00-12.00', 'Tersedia', '2026-02-09 05:47:57', '2026-02-09 05:47:57'),
('JAD-GSBF6W', 'LAP-3ZULJO', 'Minggu', '13.00-14.00', 'Tersedia', '2026-02-09 06:41:34', '2026-02-09 06:41:34'),
('JAD-GWKIQV', 'LAP-3ZULJO', 'Senin', '08.00-09.00', 'Tersedia', '2026-02-09 02:57:48', '2026-02-09 02:57:48'),
('JAD-H3KS5V', 'LAP-OEMRB1', 'Sabtu', '20.00-21.00', 'Tersedia', '2026-02-09 10:01:10', '2026-02-09 10:01:10'),
('JAD-HBMOB1', 'LAP-OEMRB1', 'Rabu', '09.00-10.00', 'Tersedia', '2026-02-09 09:49:37', '2026-02-09 09:49:37'),
('JAD-HDN7J2', 'LAP-OEMRB1', 'Senin', '18.00-19.00', 'Tersedia', '2026-02-09 09:45:49', '2026-02-09 09:45:49'),
('JAD-HEQYOJ', 'LAP-OEMRB1', 'Senin', '15.00-16.00', 'Tersedia', '2026-02-09 09:45:22', '2026-02-09 09:45:22'),
('JAD-HKRWYV', 'LAP-3ZULJO', 'Rabu', '20.00-21.00', 'Tersedia', '2026-02-09 05:26:10', '2026-02-09 05:26:10'),
('JAD-HVDQTW', 'LAP-OEMRB1', 'Minggu', '22.00-23.00', 'Tersedia', '2026-02-09 10:04:07', '2026-02-09 10:18:44'),
('JAD-HVFPTR', 'LAP-OEMRB1', 'Sabtu', '09.00-10.00', 'Tersedia', '2026-02-09 09:59:03', '2026-02-09 09:59:03'),
('JAD-HXM4MM', 'LAP-3ZULJO', 'Jumat', '12.00-13.00', 'Tersedia', '2026-02-09 05:43:24', '2026-02-09 05:43:24'),
('JAD-HXMLLB', 'LAP-OEMRB1', 'Kamis', '21.00-22.00', 'Tersedia', '2026-02-09 09:54:18', '2026-02-09 09:54:18'),
('JAD-IFSRNP', 'LAP-3ZULJO', 'Sabtu', '16.00-17.00', 'Tersedia', '2026-02-09 05:49:09', '2026-02-09 05:49:09'),
('JAD-IH4RIK', 'LAP-OEMRB1', 'Kamis', '13.00-14.00', 'Tersedia', '2026-02-09 09:52:56', '2026-02-09 09:52:56'),
('JAD-IHTQGZ', 'LAP-3ZULJO', 'Rabu', '08.00-09.00', 'Booked', '2026-02-09 05:21:21', '2026-02-17 06:50:21'),
('JAD-IJWNQ7', 'LAP-OEMRB1', 'Kamis', '16.00-17.00', 'Tersedia', '2026-02-09 09:53:34', '2026-02-09 09:53:34'),
('JAD-IMSHUI', 'LAP-OEMRB1', 'Kamis', '22.00-23.00', 'Tersedia', '2026-02-09 09:54:30', '2026-02-09 09:54:30'),
('JAD-ITLIQB', 'LAP-3ZULJO', 'Minggu', '20.00-21.00', 'Tersedia', '2026-02-09 06:43:08', '2026-02-09 06:43:08'),
('JAD-IVLOEH', 'LAP-3ZULJO', 'Kamis', '16.00-17.00', 'Tersedia', '2026-02-09 05:40:35', '2026-02-09 05:40:35'),
('JAD-IZCYEG', 'LAP-OEMRB1', 'Minggu', '19.00-20.00', 'Tersedia', '2026-02-09 10:03:38', '2026-02-09 10:03:38'),
('JAD-JAAT1Q', 'LAP-OEMRB1', 'Rabu', '14.00-15.00', 'Booked', '2026-02-09 09:50:17', '2026-02-17 06:47:06'),
('JAD-JCIFKM', 'LAP-3ZULJO', 'Rabu', '15.00-16.00', 'Tersedia', '2026-02-09 05:24:37', '2026-02-09 05:24:37'),
('JAD-JKOIFW', 'LAP-3ZULJO', 'Rabu', '13.00-14.00', 'Booked', '2026-02-09 05:22:33', '2026-02-17 06:50:21'),
('JAD-JKUZ3E', 'LAP-OEMRB1', 'Rabu', '19.00-20.00', 'Tersedia', '2026-02-09 09:50:57', '2026-02-09 09:50:57'),
('JAD-JMLCPP', 'LAP-OEMRB1', 'Minggu', '10.00-11.00', 'Tersedia', '2026-02-09 10:02:25', '2026-02-09 10:02:25'),
('JAD-JSCGIH', 'LAP-3ZULJO', 'Selasa', '14.00-15.00', 'Tersedia', '2026-02-09 03:25:33', '2026-02-09 03:25:33'),
('JAD-JTQAYY', 'LAP-OEMRB1', 'Selasa', '21.00-22.00', 'Tersedia', '2026-02-09 09:48:55', '2026-02-09 09:48:55'),
('JAD-JVOKVK', 'LAP-OEMRB1', 'Selasa', '12.00-13.00', 'Tersedia', '2026-02-09 09:47:34', '2026-02-09 09:47:34'),
('JAD-JWSXEH', 'LAP-OEMRB1', 'Rabu', '22.00-23.00', 'Tersedia', '2026-02-09 09:51:28', '2026-02-09 09:51:28'),
('JAD-JYBHJE', 'LAP-3ZULJO', 'Minggu', '10.00-11.00', 'Tersedia', '2026-02-09 06:40:50', '2026-02-09 06:40:50'),
('JAD-KFY2UG', 'LAP-OEMRB1', 'Sabtu', '08.00-09.00', 'Tersedia', '2026-02-09 09:58:49', '2026-02-09 09:58:49'),
('JAD-KQBFL8', 'LAP-OEMRB1', 'Senin', '11.00-12.00', 'Tersedia', '2026-02-09 09:44:43', '2026-02-09 09:44:43'),
('JAD-KRDLQJ', 'LAP-3ZULJO', 'Minggu', '19.00-20.00', 'Tersedia', '2026-02-09 06:42:54', '2026-02-09 06:42:54'),
('JAD-KZEST0', 'LAP-3ZULJO', 'Selasa', '12.00-13.00', 'Tersedia', '2026-02-09 03:24:28', '2026-02-09 03:24:28'),
('JAD-L2DSP3', 'LAP-OEMRB1', 'Selasa', '16.00-17.00', 'Tersedia', '2026-02-09 09:48:12', '2026-02-09 09:48:12'),
('JAD-LB7QAV', 'LAP-3ZULJO', 'Senin', '11.00-12.00', 'Tersedia', '2026-02-09 02:58:14', '2026-02-09 02:58:14'),
('JAD-LIPJE9', 'LAP-OEMRB1', 'Sabtu', '11.00-12.00', 'Tersedia', '2026-02-09 09:59:51', '2026-02-09 09:59:51'),
('JAD-LKGMEY', 'LAP-3ZULJO', 'Kamis', '11.00-12.00', 'Tersedia', '2026-02-09 05:38:53', '2026-02-09 05:38:53'),
('JAD-LLLF6Q', 'LAP-3ZULJO', 'Sabtu', '15.00-16.00', 'Tersedia', '2026-02-09 05:49:01', '2026-02-09 05:49:01'),
('JAD-LLPVCO', 'LAP-3ZULJO', 'Jumat', '10.00-11.00', 'Tersedia', '2026-02-09 05:42:42', '2026-02-09 05:42:42'),
('JAD-LUETFT', 'LAP-OEMRB1', 'Jumat', '17.00-18.00', 'Tersedia', '2026-02-09 09:57:59', '2026-02-09 09:57:59'),
('JAD-LWRUDL', 'LAP-OEMRB1', 'Sabtu', '16.00-17.00', 'Tersedia', '2026-02-09 10:00:36', '2026-02-09 10:00:36'),
('JAD-MIB9K4', 'LAP-3ZULJO', 'Senin', '09.00-10.00', 'Tersedia', '2026-02-09 02:57:56', '2026-02-09 02:57:56'),
('JAD-ML7OQS', 'LAP-OEMRB1', 'Minggu', '08.00-09.00', 'Tersedia', '2026-02-09 10:02:04', '2026-02-09 10:02:04'),
('JAD-MNWGDM', 'LAP-3ZULJO', 'Kamis', '10.00-11.00', 'Tersedia', '2026-02-09 05:38:44', '2026-02-09 05:38:44'),
('JAD-N6TZVW', 'LAP-OEMRB1', 'Kamis', '08.00-09.00', 'Tersedia', '2026-02-09 09:51:46', '2026-02-09 09:51:46'),
('JAD-NEKHQP', 'LAP-3ZULJO', 'Minggu', '18.00-19.00', 'Tersedia', '2026-02-09 06:42:40', '2026-02-09 06:42:40'),
('JAD-NFCKAH', 'LAP-3ZULJO', 'Rabu', '10.00-11.00', 'Tersedia', '2026-02-09 05:22:02', '2026-02-09 05:22:02'),
('JAD-NIKQRG', 'LAP-OEMRB1', 'Sabtu', '22.00-23.00', 'Tersedia', '2026-02-09 10:01:31', '2026-02-09 10:01:31'),
('JAD-NSL1GX', 'LAP-OEMRB1', 'Sabtu', '14.00-15.00', 'Tersedia', '2026-02-09 10:00:16', '2026-02-09 10:00:16'),
('JAD-NSOOI1', 'LAP-3ZULJO', 'Jumat', '16.00-17.00', 'Tersedia', '2026-02-09 05:44:05', '2026-02-09 05:44:05'),
('JAD-O7PKW2', 'LAP-OEMRB1', 'Kamis', '14.00-15.00', 'Tersedia', '2026-02-09 09:53:05', '2026-02-09 09:53:05'),
('JAD-OC4JZM', 'LAP-OEMRB1', 'Selasa', '11.00-12.00', 'Tersedia', '2026-02-09 09:47:26', '2026-02-09 09:47:26'),
('JAD-OJRWNF', 'LAP-3ZULJO', 'Senin', '16.00-17.00', 'Tersedia', '2026-02-09 02:59:58', '2026-02-09 02:59:58'),
('JAD-OSS4YM', 'LAP-OEMRB1', 'Selasa', '14.00-15.00', 'Tersedia', '2026-02-09 09:47:54', '2026-02-09 09:47:54'),
('JAD-OUPCM1', 'LAP-OEMRB1', 'Senin', '14.00-15.00', 'Tersedia', '2026-02-09 09:45:14', '2026-02-09 09:45:14'),
('JAD-OWGHRV', 'LAP-OEMRB1', 'Selasa', '22.00-23.00', 'Tersedia', '2026-02-09 09:49:06', '2026-02-09 09:49:06'),
('JAD-PCIKEO', 'LAP-3ZULJO', 'Kamis', '12.00-13.00', 'Tersedia', '2026-02-09 05:39:02', '2026-02-09 05:39:02'),
('JAD-PDMURT', 'LAP-OEMRB1', 'Kamis', '12.00-13.00', 'Tersedia', '2026-02-09 09:52:48', '2026-02-09 09:52:48'),
('JAD-PKQ3AB', 'LAP-OEMRB1', 'Jumat', '12.00-13.00', 'Tersedia', '2026-02-09 09:57:18', '2026-02-09 09:57:18'),
('JAD-PW4ELC', 'LAP-3ZULJO', 'Senin', '20.00-21.00', 'Tersedia', '2026-02-09 03:01:45', '2026-02-09 03:01:45'),
('JAD-PW6KA0', 'LAP-3ZULJO', 'Jumat', '21.00-22.00', 'Tersedia', '2026-02-09 05:45:58', '2026-02-09 05:45:58'),
('JAD-PWPR4O', 'LAP-3ZULJO', 'Selasa', '22.00-23.00', 'Tersedia', '2026-02-09 05:20:23', '2026-02-09 05:20:23'),
('JAD-QAKGJF', 'LAP-3ZULJO', 'Senin', '12.00-13.00', 'Tersedia', '2026-02-09 02:58:25', '2026-02-09 02:58:25'),
('JAD-QELRFL', 'LAP-3ZULJO', 'Minggu', '08.00-09.00', 'Tersedia', '2026-02-09 05:51:30', '2026-02-09 05:51:30'),
('JAD-QITULM', 'LAP-3ZULJO', 'Rabu', '09.00-10.00', 'Booked', '2026-02-09 05:21:38', '2026-02-16 02:37:01'),
('JAD-QMNMDD', 'LAP-3ZULJO', 'Rabu', '12.00-13.00', 'Tersedia', '2026-02-09 05:22:24', '2026-02-09 05:22:24'),
('JAD-QNOKJP', 'LAP-3ZULJO', 'Selasa', '13.00-14.00', 'Tersedia', '2026-02-09 03:24:50', '2026-02-09 03:24:50'),
('JAD-QOOGPY', 'LAP-OEMRB1', 'Senin', '19.00-20.00', 'Tersedia', '2026-02-09 09:45:59', '2026-02-09 09:45:59'),
('JAD-QSWRBX', 'LAP-3ZULJO', 'Sabtu', '17.00-18.00', 'Tersedia', '2026-02-09 05:49:18', '2026-02-09 05:49:18'),
('JAD-RAOZEB', 'LAP-3ZULJO', 'Sabtu', '22.00-23.00', 'Tersedia', '2026-02-09 05:51:06', '2026-02-09 05:51:06'),
('JAD-RDGJ2C', 'LAP-3ZULJO', 'Sabtu', '18.00-19.00', 'Tersedia', '2026-02-09 05:49:38', '2026-02-09 05:49:38'),
('JAD-RFNAS3', 'LAP-3ZULJO', 'Jumat', '15.00-16.00', 'Tersedia', '2026-02-09 05:43:57', '2026-02-09 05:43:57'),
('JAD-RFWET5', 'LAP-3ZULJO', 'Minggu', '14.00-15.00', 'Tersedia', '2026-02-09 06:41:47', '2026-02-09 06:41:47'),
('JAD-RPKCLT', 'LAP-3ZULJO', 'Minggu', '09.00-10.00', 'Tersedia', '2026-02-09 06:40:25', '2026-02-09 06:40:25'),
('JAD-RQ1XBK', 'LAP-3ZULJO', 'Kamis', '22.00-23.00', 'Tersedia', '2026-02-09 05:41:40', '2026-02-09 05:41:40'),
('JAD-RQ7K0C', 'LAP-OEMRB1', 'Kamis', '09.00-10.00', 'Tersedia', '2026-02-09 09:52:22', '2026-02-09 09:52:22'),
('JAD-S1A2GF', 'LAP-3ZULJO', 'Selasa', '18.00-19.00', 'Tersedia', '2026-02-09 03:29:17', '2026-02-09 03:29:17'),
('JAD-S53ZQV', 'LAP-OEMRB1', 'Jumat', '11.00-12.00', 'Tersedia', '2026-02-09 09:57:10', '2026-02-09 09:57:10'),
('JAD-SBD0DR', 'LAP-3ZULJO', 'Sabtu', '13.00-14.00', 'Tersedia', '2026-02-09 05:48:22', '2026-02-09 05:48:22'),
('JAD-SBLWKD', 'LAP-OEMRB1', 'Minggu', '18.00-19.00', 'Tersedia', '2026-02-09 10:03:30', '2026-02-09 10:03:30'),
('JAD-SGFXLU', 'LAP-OEMRB1', 'Jumat', '15.00-16.00', 'Tersedia', '2026-02-09 09:57:43', '2026-02-09 09:57:43'),
('JAD-SLHRF1', 'LAP-OEMRB1', 'Selasa', '17.00-18.00', 'Tersedia', '2026-02-09 09:48:22', '2026-02-09 09:48:22'),
('JAD-SV0RFQ', 'LAP-OEMRB1', 'Senin', '16.00-17.00', 'Tersedia', '2026-02-09 09:45:30', '2026-02-09 09:45:30'),
('JAD-SVMTZI', 'LAP-3ZULJO', 'Minggu', '15.00-16.00', 'Tersedia', '2026-02-09 06:41:59', '2026-02-09 06:41:59'),
('JAD-SVWOZ3', 'LAP-OEMRB1', 'Senin', '09.00-10.00', 'Tersedia', '2026-02-09 06:52:58', '2026-02-09 06:52:58'),
('JAD-T3VCWO', 'LAP-3ZULJO', 'Jumat', '09.00-10.00', 'Tersedia', '2026-02-09 05:42:33', '2026-02-09 05:42:33'),
('JAD-T6YMVT', 'LAP-3ZULJO', 'Selasa', '15.00-16.00', 'Tersedia', '2026-02-09 03:26:28', '2026-02-09 03:26:28'),
('JAD-TWNQQV', 'LAP-OEMRB1', 'Kamis', '15.00-16.00', 'Tersedia', '2026-02-09 09:53:14', '2026-02-09 09:53:14'),
('JAD-UL4I23', 'LAP-3ZULJO', 'Sabtu', '08.00-09.00', 'Tersedia', '2026-02-09 05:46:52', '2026-02-09 05:46:52'),
('JAD-ULWTUD', 'LAP-3ZULJO', 'Selasa', '09.00-10.00', 'Tersedia', '2026-02-09 03:07:00', '2026-02-09 03:07:00'),
('JAD-UQP8W3', 'LAP-OEMRB1', 'Kamis', '11.00-12.00', 'Tersedia', '2026-02-09 09:52:39', '2026-02-09 09:52:39'),
('JAD-V6PUIL', 'LAP-OEMRB1', 'Selasa', '10.00-11.00', 'Tersedia', '2026-02-09 09:47:19', '2026-02-09 09:47:19'),
('JAD-V7Z52A', 'LAP-3ZULJO', 'Jumat', '14.00-15.00', 'Tersedia', '2026-02-09 05:43:40', '2026-02-09 05:43:40'),
('JAD-VAZDXJ', 'LAP-OEMRB1', 'Jumat', '21.00-22.00', 'Tersedia', '2026-02-09 09:58:30', '2026-02-09 09:58:30'),
('JAD-VC15KO', 'LAP-3ZULJO', 'Sabtu', '09.00-10.00', 'Tersedia', '2026-02-09 05:47:18', '2026-02-09 05:47:18'),
('JAD-VE9GOQ', 'LAP-OEMRB1', 'Rabu', '10.00-11.00', 'Tersedia', '2026-02-09 09:49:46', '2026-02-09 09:49:46'),
('JAD-VKCANA', 'LAP-OEMRB1', 'Senin', '21.00-22.00', 'Tersedia', '2026-02-09 09:46:22', '2026-02-09 09:46:22'),
('JAD-VKZ1YF', 'LAP-OEMRB1', 'Minggu', '17.00-18.00', 'Tersedia', '2026-02-09 10:03:24', '2026-02-09 10:03:24'),
('JAD-VMFNB5', 'LAP-3ZULJO', 'Selasa', '21.00-22.00', 'Tersedia', '2026-02-09 05:20:46', '2026-02-09 05:20:46'),
('JAD-VMFUVC', 'LAP-OEMRB1', 'Rabu', '18.00-19.00', 'Tersedia', '2026-02-09 09:50:49', '2026-02-10 12:43:55'),
('JAD-VNOOVS', 'LAP-3ZULJO', 'Jumat', '13.00-14.00', 'Tersedia', '2026-02-09 05:43:31', '2026-02-09 05:43:31'),
('JAD-VP9FVW', 'LAP-3ZULJO', 'Kamis', '17.00-18.00', 'Tersedia', '2026-02-09 05:40:51', '2026-02-09 05:40:51'),
('JAD-VVDMDX', 'LAP-OEMRB1', 'Senin', '12.00-13.00', 'Tersedia', '2026-02-09 09:44:52', '2026-02-09 09:44:52'),
('JAD-W61ONJ', 'LAP-OEMRB1', 'Minggu', '16.00-17.00', 'Tersedia', '2026-02-09 10:03:16', '2026-02-09 10:03:16'),
('JAD-W6EYSF', 'LAP-OEMRB1', 'Jumat', '19.00-20.00', 'Tersedia', '2026-02-09 09:58:14', '2026-02-09 09:58:14'),
('JAD-WJHCWI', 'LAP-OEMRB1', 'Jumat', '18.00-19.00', 'Tersedia', '2026-02-09 09:58:07', '2026-02-09 09:58:07'),
('JAD-WWMV4G', 'LAP-3ZULJO', 'Rabu', '22.00-23.00', 'Tersedia', '2026-02-09 05:26:38', '2026-02-10 12:43:50'),
('JAD-WXVYXD', 'LAP-3ZULJO', 'Kamis', '14.00-15.00', 'Tersedia', '2026-02-09 05:39:27', '2026-02-09 05:39:27'),
('JAD-XAAUSN', 'LAP-3ZULJO', 'Sabtu', '19.00-20.00', 'Tersedia', '2026-02-09 05:49:46', '2026-02-09 05:49:46'),
('JAD-XAWO34', 'LAP-3ZULJO', 'Selasa', '10.00-11.00', 'Tersedia', '2026-02-09 03:19:54', '2026-02-09 03:19:54'),
('JAD-XHH6Z7', 'LAP-OEMRB1', 'Minggu', '21.00-22.00', 'Tersedia', '2026-02-09 10:03:57', '2026-02-09 10:03:57'),
('JAD-XHIMQR', 'LAP-3ZULJO', 'Kamis', '15.00-16.00', 'Tersedia', '2026-02-09 05:40:26', '2026-02-09 05:40:26'),
('JAD-XMOR3V', 'LAP-OEMRB1', 'Kamis', '10.00-11.00', 'Tersedia', '2026-02-09 09:52:30', '2026-02-09 09:52:30'),
('JAD-XOVN6K', 'LAP-3ZULJO', 'Senin', '19.00-20.00', 'Tersedia', '2026-02-09 03:01:35', '2026-02-09 03:01:35'),
('JAD-XPLLCN', 'LAP-OEMRB1', 'Jumat', '13.00-14.00', 'Tersedia', '2026-02-09 09:57:25', '2026-02-09 09:57:25'),
('JAD-XW3RA1', 'LAP-3ZULJO', 'Kamis', '20.00-21.00', 'Tersedia', '2026-02-09 05:41:18', '2026-02-09 05:41:18'),
('JAD-XXMMF6', 'LAP-3ZULJO', 'Rabu', '21.00-22.00', 'Tersedia', '2026-02-09 05:26:22', '2026-02-10 12:44:07'),
('JAD-XZRI2S', 'LAP-3ZULJO', 'Kamis', '19.00-20.00', 'Tersedia', '2026-02-09 05:41:08', '2026-02-09 05:41:08'),
('JAD-YDI0JB', 'LAP-3ZULJO', 'Selasa', '19.00-20.00', 'Tersedia', '2026-02-09 03:30:03', '2026-02-09 03:30:03'),
('JAD-YFSRRL', 'LAP-3ZULJO', 'Sabtu', '12.00-13.00', 'Tersedia', '2026-02-09 05:48:13', '2026-02-09 05:48:13'),
('JAD-YOA2O2', 'LAP-3ZULJO', 'Rabu', '19.00-20.00', 'Tersedia', '2026-02-09 05:25:56', '2026-02-10 12:44:01'),
('JAD-YOJQLN', 'LAP-3ZULJO', 'Jumat', '19.00-20.00', 'Tersedia', '2026-02-09 05:45:35', '2026-02-09 05:45:35'),
('JAD-YVTCVA', 'LAP-OEMRB1', 'Selasa', '09.00-10.00', 'Tersedia', '2026-02-09 09:46:48', '2026-02-09 09:46:48'),
('JAD-YZHOE2', 'LAP-OEMRB1', 'Jumat', '09.00-10.00', 'Tersedia', '2026-02-09 09:56:48', '2026-02-09 09:56:48'),
('JAD-Z5X6T3', 'LAP-3ZULJO', 'Rabu', '17.00-18.00', 'Booked', '2026-02-09 05:25:11', '2026-02-17 06:47:52'),
('JAD-Z9YAFI', 'LAP-3ZULJO', 'Senin', '22.00-23.00', 'Tersedia', '2026-02-09 03:02:06', '2026-02-09 03:02:06'),
('JAD-ZMQGDJ', 'LAP-OEMRB1', 'Rabu', '08.00-09.00', 'Tersedia', '2026-02-09 09:49:17', '2026-02-10 12:43:43'),
('JAD-ZRMPH7', 'LAP-OEMRB1', 'Rabu', '20.00-21.00', 'Tersedia', '2026-02-09 09:51:05', '2026-02-09 09:51:05');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lapangan`
--

CREATE TABLE `lapangan` (
  `id` varchar(255) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lapangan`
--

INSERT INTO `lapangan` (`id`, `nama`, `deskripsi`, `created_at`, `updated_at`) VALUES
('LAP-3ZULJO', 'Lapangan 1', 'test', '2026-02-08 13:18:58', '2026-02-08 15:00:59'),
('LAP-OEMRB1', 'Lapangan 2', 'test', '2026-02-08 15:01:16', '2026-02-09 10:37:51');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_02_15_125159_add_whatsapp_to_users_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('ctOJiVfldw5hIcQYDo5S6hxPXtHht1jbg6Ly7qSI', 4, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il9mbGFzaCI7YToyOntzOjM6Im5ldyI7YTowOnt9czozOiJvbGQiO2E6MDp7fX1zOjY6Il90b2tlbiI7czo0MDoibEk0MFM5ZENJQThxVmdBQ1JVaVBEZTJhS2RoakI5YndXcFhJaXdUdyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NDt9', 1771339415),
('elDTg2zaNANsdmxu3SDCIeBX6B8ffvbvM4HDa9r6', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il9mbGFzaCI7YToyOntzOjM6Im5ldyI7YTowOnt9czozOiJvbGQiO2E6MDp7fX1zOjY6Il90b2tlbiI7czo0MDoiWnVoVGZQclNJR2pkYkh1VXlPc1NlamowR3p4bThLZ1Y5bnV4RkV1UyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC91c2VyLWluZGV4IjtzOjU6InJvdXRlIjtzOjEwOiJ1c2VyLmluZGV4Ijt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1771336243);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `whatsapp` varchar(20) DEFAULT NULL,
  `role` enum('Admin','Member') NOT NULL,
  `jenis` enum('Admin','Biasa','Member') NOT NULL,
  `status` enum('Aktif','Nonaktif') NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `whatsapp`, `role`, `jenis`, `status`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin', NULL, 'Admin', 'Admin', 'Aktif', '$2y$12$DPX/TUGgQkakRYcJmtoWbe8dONiq6Q10qB7QUvgW1h3S7DRrs.5XG', '2026-02-08 10:37:37', '2026-02-08 10:37:37'),
(3, 'Andika Saputra', 'andyas', '085333633621', 'Member', 'Member', 'Aktif', '$2y$12$D/W/rPs16S7JyTpmLD32guDoRfGsSJrDR/POZuDlsAmYhPVw1VSvi', '2026-02-15 06:54:16', '2026-02-15 06:54:16'),
(4, 'cris02', 'sirc02', '537464857943', 'Member', 'Member', 'Aktif', '$2y$12$k4V0rSw8nL/m3E.xpo/hY.2q5eMgM45WCXWkgeljowD6kmdce5JqK', '2026-02-17 06:42:20', '2026-02-17 07:43:26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lapangan` (`lapangan`),
  ADD KEY `jadwal` (`jadwal`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `galeri`
--
ALTER TABLE `galeri`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lapangan` (`lapangan`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lapangan`
--
ALTER TABLE `lapangan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
