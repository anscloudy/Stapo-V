-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 11 Nov 2026 pada 04.49
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laporan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(191) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(191) NOT NULL,
  `owner` varchar(191) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(191) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(191) NOT NULL,
  `name` varchar(191) NOT NULL,
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
-- Struktur dari tabel `laporans`
--

CREATE TABLE `laporans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode` varchar(191) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `lokasi_id` bigint(20) UNSIGNED NOT NULL,
  `petugas_id` bigint(20) UNSIGNED DEFAULT NULL,
  `jenis` varchar(191) NOT NULL,
  `kategori` varchar(191) NOT NULL,
  `nama_barang` varchar(191) NOT NULL,
  `jumlah` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `deskripsi` text NOT NULL,
  `fotos` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`fotos`)),
  `tingkat` varchar(191) NOT NULL DEFAULT 'sedang',
  `status` varchar(191) NOT NULL DEFAULT 'diajukan',
  `catatan_petugas` text DEFAULT NULL,
  `biaya` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `jenis_biaya` varchar(191) DEFAULT NULL,
  `foto_selesai` varchar(191) DEFAULT NULL,
  `tanggal_selesai` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `laporans`
--

INSERT INTO `laporans` (`id`, `kode`, `user_id`, `lokasi_id`, `petugas_id`, `jenis`, `kategori`, `nama_barang`, `jumlah`, `deskripsi`, `fotos`, `tingkat`, `status`, `catatan_petugas`, `biaya`, `jenis_biaya`, `foto_selesai`, `tanggal_selesai`, `created_at`, `updated_at`) VALUES
(1, 'STP-261111-IM0F', 37, 91, 36, 'kerusakan', 'Komputer & Elektronik', 'Komputer PC Laboratorium', 1, 'Monitor mati total, sudah dicek kabel power.', NULL, 'sedang', 'diverifikasi', NULL, 0, NULL, NULL, NULL, '2026-11-05 20:49:13', '2026-11-10 20:49:13'),
(2, 'STP-261111-7JRQ', 37, 79, 36, 'kerusakan', 'Papan Tulis & Proyektor', 'Proyektor Kelas XII RPL', 1, 'Lampu proyektor redup lalu padam.', NULL, 'sedang', 'selesai', NULL, 450000, 'perbaikan', NULL, '2026-11-08', '2026-10-31 20:49:13', '2026-11-10 20:49:13'),
(3, 'STP-261111-CWIQ', 37, 22, 36, 'kerusakan', 'Meja & Kursi', 'Kursi Belajar Patah', 1, 'Kaki kursi patah, berbahaya dipakai.', NULL, 'sedang', 'diverifikasi', NULL, 0, NULL, NULL, NULL, '2026-10-26 20:49:13', '2026-11-10 20:49:13'),
(4, 'STP-261111-TTG5', 37, 99, 36, 'kerusakan', 'Kelistrikan & AC', 'AC Tidak Dingin', 1, 'AC hanya mengeluarkan angin.', NULL, 'sedang', 'ditolak', 'Sudah ditangani vendor kontrak AC, tidak perlu laporan baru.', 0, NULL, NULL, NULL, '2026-10-21 20:49:13', '2026-11-10 20:49:13'),
(5, 'STP-261111-5IS0', 37, 1, NULL, 'kerusakan', 'Papan Tulis & Proyektor', 'Papan Tulis Rusak', 1, 'Permukaan papan tulis mengelupas.', NULL, 'sedang', 'diajukan', NULL, 0, NULL, NULL, NULL, '2026-10-16 20:49:13', '2026-11-10 20:49:13');

-- --------------------------------------------------------

--
-- Struktur dari tabel `laporan_logs`
--

CREATE TABLE `laporan_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `laporan_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` varchar(191) NOT NULL,
  `catatan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `laporan_logs`
--

INSERT INTO `laporan_logs` (`id`, `laporan_id`, `user_id`, `status`, `catatan`, `created_at`, `updated_at`) VALUES
(1, 1, 37, 'diajukan', 'Laporan dibuat.', '2026-11-10 20:49:13', '2026-11-10 20:49:13'),
(2, 1, 36, 'diverifikasi', NULL, '2026-11-10 20:49:13', '2026-11-10 20:49:13'),
(3, 2, 37, 'diajukan', 'Laporan dibuat.', '2026-11-10 20:49:13', '2026-11-10 20:49:13'),
(4, 2, 36, 'selesai', NULL, '2026-11-10 20:49:13', '2026-11-10 20:49:13'),
(5, 3, 37, 'diajukan', 'Laporan dibuat.', '2026-11-10 20:49:13', '2026-11-10 20:49:13'),
(6, 3, 36, 'diverifikasi', NULL, '2026-11-10 20:49:13', '2026-11-10 20:49:13'),
(7, 4, 37, 'diajukan', 'Laporan dibuat.', '2026-11-10 20:49:13', '2026-11-10 20:49:13'),
(8, 4, 36, 'ditolak', 'Sudah ditangani vendor kontrak AC, tidak perlu laporan baru.', '2026-11-10 20:49:13', '2026-11-10 20:49:13'),
(9, 5, 37, 'diajukan', 'Laporan dibuat.', '2026-11-10 20:49:13', '2026-11-10 20:49:13');

-- --------------------------------------------------------

--
-- Struktur dari tabel `lokasis`
--

CREATE TABLE `lokasis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(191) NOT NULL,
  `tipe` varchar(191) NOT NULL DEFAULT 'umum',
  `jurusan` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `lokasis`
--

INSERT INTO `lokasis` (`id`, `nama`, `tipe`, `jurusan`, `created_at`, `updated_at`) VALUES
(1, 'Kelas X DPIB A', 'kelas', 'DPIB', '2026-11-10 20:49:00', '2026-11-10 20:49:00'),
(2, 'Kelas X DPIB B', 'kelas', 'DPIB', '2026-11-10 20:49:00', '2026-11-10 20:49:00'),
(3, 'Kelas X DPIB C', 'kelas', 'DPIB', '2026-11-10 20:49:00', '2026-11-10 20:49:00'),
(4, 'Kelas XI DPIB A', 'kelas', 'DPIB', '2026-11-10 20:49:00', '2026-11-10 20:49:00'),
(5, 'Kelas XI DPIB B', 'kelas', 'DPIB', '2026-11-10 20:49:00', '2026-11-10 20:49:00'),
(6, 'Kelas XI DPIB C', 'kelas', 'DPIB', '2026-11-10 20:49:00', '2026-11-10 20:49:00'),
(7, 'Kelas XII DPIB A', 'kelas', 'DPIB', '2026-11-10 20:49:00', '2026-11-10 20:49:00'),
(8, 'Kelas XII DPIB B', 'kelas', 'DPIB', '2026-11-10 20:49:00', '2026-11-10 20:49:00'),
(9, 'Kelas XII DPIB C', 'kelas', 'DPIB', '2026-11-10 20:49:00', '2026-11-10 20:49:00'),
(10, 'Kelas X TKP A', 'kelas', 'TKP', '2026-11-10 20:49:00', '2026-11-10 20:49:00'),
(11, 'Kelas X TKP B', 'kelas', 'TKP', '2026-11-10 20:49:00', '2026-11-10 20:49:00'),
(12, 'Kelas X TKP C', 'kelas', 'TKP', '2026-11-10 20:49:00', '2026-11-10 20:49:00'),
(13, 'Kelas XI TKP A', 'kelas', 'TKP', '2026-11-10 20:49:00', '2026-11-10 20:49:00'),
(14, 'Kelas XI TKP B', 'kelas', 'TKP', '2026-11-10 20:49:00', '2026-11-10 20:49:00'),
(15, 'Kelas XI TKP C', 'kelas', 'TKP', '2026-11-10 20:49:00', '2026-11-10 20:49:00'),
(16, 'Kelas XII TKP A', 'kelas', 'TKP', '2026-11-10 20:49:00', '2026-11-10 20:49:00'),
(17, 'Kelas XII TKP B', 'kelas', 'TKP', '2026-11-10 20:49:00', '2026-11-10 20:49:00'),
(18, 'Kelas XII TKP C', 'kelas', 'TKP', '2026-11-10 20:49:00', '2026-11-10 20:49:00'),
(19, 'Kelas X TP A', 'kelas', 'TP', '2026-11-10 20:49:00', '2026-11-10 20:49:00'),
(20, 'Kelas X TP B', 'kelas', 'TP', '2026-11-10 20:49:00', '2026-11-10 20:49:00'),
(21, 'Kelas X TP C', 'kelas', 'TP', '2026-11-10 20:49:00', '2026-11-10 20:49:00'),
(22, 'Kelas XI TP A', 'kelas', 'TP', '2026-11-10 20:49:00', '2026-11-10 20:49:00'),
(23, 'Kelas XI TP B', 'kelas', 'TP', '2026-11-10 20:49:00', '2026-11-10 20:49:00'),
(24, 'Kelas XI TP C', 'kelas', 'TP', '2026-11-10 20:49:00', '2026-11-10 20:49:00'),
(25, 'Kelas XII TP A', 'kelas', 'TP', '2026-11-10 20:49:00', '2026-11-10 20:49:00'),
(26, 'Kelas XII TP B', 'kelas', 'TP', '2026-11-10 20:49:00', '2026-11-10 20:49:00'),
(27, 'Kelas XII TP C', 'kelas', 'TP', '2026-11-10 20:49:00', '2026-11-10 20:49:00'),
(28, 'Kelas X TKRO A', 'kelas', 'TKRO', '2026-11-10 20:49:00', '2026-11-10 20:49:00'),
(29, 'Kelas X TKRO B', 'kelas', 'TKRO', '2026-11-10 20:49:00', '2026-11-10 20:49:00'),
(30, 'Kelas X TKRO C', 'kelas', 'TKRO', '2026-11-10 20:49:00', '2026-11-10 20:49:00'),
(31, 'Kelas XI TKRO A', 'kelas', 'TKRO', '2026-11-10 20:49:00', '2026-11-10 20:49:00'),
(32, 'Kelas XI TKRO B', 'kelas', 'TKRO', '2026-11-10 20:49:00', '2026-11-10 20:49:00'),
(33, 'Kelas XI TKRO C', 'kelas', 'TKRO', '2026-11-10 20:49:00', '2026-11-10 20:49:00'),
(34, 'Kelas XII TKRO A', 'kelas', 'TKRO', '2026-11-10 20:49:00', '2026-11-10 20:49:00'),
(35, 'Kelas XII TKRO B', 'kelas', 'TKRO', '2026-11-10 20:49:00', '2026-11-10 20:49:00'),
(36, 'Kelas XII TKRO C', 'kelas', 'TKRO', '2026-11-10 20:49:00', '2026-11-10 20:49:00'),
(37, 'Kelas X TBSM A', 'kelas', 'TBSM', '2026-11-10 20:49:01', '2026-11-10 20:49:01'),
(38, 'Kelas X TBSM B', 'kelas', 'TBSM', '2026-11-10 20:49:01', '2026-11-10 20:49:01'),
(39, 'Kelas X TBSM C', 'kelas', 'TBSM', '2026-11-10 20:49:01', '2026-11-10 20:49:01'),
(40, 'Kelas XI TBSM A', 'kelas', 'TBSM', '2026-11-10 20:49:01', '2026-11-10 20:49:01'),
(41, 'Kelas XI TBSM B', 'kelas', 'TBSM', '2026-11-10 20:49:01', '2026-11-10 20:49:01'),
(42, 'Kelas XI TBSM C', 'kelas', 'TBSM', '2026-11-10 20:49:01', '2026-11-10 20:49:01'),
(43, 'Kelas XII TBSM A', 'kelas', 'TBSM', '2026-11-10 20:49:01', '2026-11-10 20:49:01'),
(44, 'Kelas XII TBSM B', 'kelas', 'TBSM', '2026-11-10 20:49:01', '2026-11-10 20:49:01'),
(45, 'Kelas XII TBSM C', 'kelas', 'TBSM', '2026-11-10 20:49:01', '2026-11-10 20:49:01'),
(46, 'Kelas X TEI A', 'kelas', 'TEI', '2026-11-10 20:49:01', '2026-11-10 20:49:01'),
(47, 'Kelas X TEI B', 'kelas', 'TEI', '2026-11-10 20:49:01', '2026-11-10 20:49:01'),
(48, 'Kelas X TEI C', 'kelas', 'TEI', '2026-11-10 20:49:01', '2026-11-10 20:49:01'),
(49, 'Kelas XI TEI A', 'kelas', 'TEI', '2026-11-10 20:49:01', '2026-11-10 20:49:01'),
(50, 'Kelas XI TEI B', 'kelas', 'TEI', '2026-11-10 20:49:01', '2026-11-10 20:49:01'),
(51, 'Kelas XI TEI C', 'kelas', 'TEI', '2026-11-10 20:49:01', '2026-11-10 20:49:01'),
(52, 'Kelas XII TEI A', 'kelas', 'TEI', '2026-11-10 20:49:01', '2026-11-10 20:49:01'),
(53, 'Kelas XII TEI B', 'kelas', 'TEI', '2026-11-10 20:49:01', '2026-11-10 20:49:01'),
(54, 'Kelas XII TEI C', 'kelas', 'TEI', '2026-11-10 20:49:01', '2026-11-10 20:49:01'),
(55, 'Kelas X TITL A', 'kelas', 'TITL', '2026-11-10 20:49:01', '2026-11-10 20:49:01'),
(56, 'Kelas X TITL B', 'kelas', 'TITL', '2026-11-10 20:49:01', '2026-11-10 20:49:01'),
(57, 'Kelas X TITL C', 'kelas', 'TITL', '2026-11-10 20:49:01', '2026-11-10 20:49:01'),
(58, 'Kelas XI TITL A', 'kelas', 'TITL', '2026-11-10 20:49:01', '2026-11-10 20:49:01'),
(59, 'Kelas XI TITL B', 'kelas', 'TITL', '2026-11-10 20:49:01', '2026-11-10 20:49:01'),
(60, 'Kelas XI TITL C', 'kelas', 'TITL', '2026-11-10 20:49:01', '2026-11-10 20:49:01'),
(61, 'Kelas XII TITL A', 'kelas', 'TITL', '2026-11-10 20:49:01', '2026-11-10 20:49:01'),
(62, 'Kelas XII TITL B', 'kelas', 'TITL', '2026-11-10 20:49:01', '2026-11-10 20:49:01'),
(63, 'Kelas XII TITL C', 'kelas', 'TITL', '2026-11-10 20:49:01', '2026-11-10 20:49:01'),
(64, 'Kelas X TOI A', 'kelas', 'TOI', '2026-11-10 20:49:01', '2026-11-10 20:49:01'),
(65, 'Kelas X TOI B', 'kelas', 'TOI', '2026-11-10 20:49:01', '2026-11-10 20:49:01'),
(66, 'Kelas X TOI C', 'kelas', 'TOI', '2026-11-10 20:49:01', '2026-11-10 20:49:01'),
(67, 'Kelas XI TOI A', 'kelas', 'TOI', '2026-11-10 20:49:01', '2026-11-10 20:49:01'),
(68, 'Kelas XI TOI B', 'kelas', 'TOI', '2026-11-10 20:49:01', '2026-11-10 20:49:01'),
(69, 'Kelas XI TOI C', 'kelas', 'TOI', '2026-11-10 20:49:01', '2026-11-10 20:49:01'),
(70, 'Kelas XII TOI A', 'kelas', 'TOI', '2026-11-10 20:49:01', '2026-11-10 20:49:01'),
(71, 'Kelas XII TOI B', 'kelas', 'TOI', '2026-11-10 20:49:01', '2026-11-10 20:49:01'),
(72, 'Kelas XII TOI C', 'kelas', 'TOI', '2026-11-10 20:49:01', '2026-11-10 20:49:01'),
(73, 'Kelas X PPLG A', 'kelas', 'PPLG', '2026-11-10 20:49:01', '2026-11-10 20:49:01'),
(74, 'Kelas X PPLG B', 'kelas', 'PPLG', '2026-11-10 20:49:01', '2026-11-10 20:49:01'),
(75, 'Kelas X PPLG C', 'kelas', 'PPLG', '2026-11-10 20:49:01', '2026-11-10 20:49:01'),
(76, 'Kelas XI RPL A', 'kelas', 'PPLG', '2026-11-10 20:49:01', '2026-11-10 20:49:01'),
(77, 'Kelas XI RPL B', 'kelas', 'PPLG', '2026-11-10 20:49:01', '2026-11-10 20:49:01'),
(78, 'Kelas XI RPL C', 'kelas', 'PPLG', '2026-11-10 20:49:01', '2026-11-10 20:49:01'),
(79, 'Kelas XII RPL A', 'kelas', 'PPLG', '2026-11-10 20:49:01', '2026-11-10 20:49:01'),
(80, 'Kelas XII RPL B', 'kelas', 'PPLG', '2026-11-10 20:49:01', '2026-11-10 20:49:01'),
(81, 'Kelas XII RPL C', 'kelas', 'PPLG', '2026-11-10 20:49:01', '2026-11-10 20:49:01'),
(82, 'Bengkel Kerja Bangku', 'bengkel', 'TP', '2026-11-10 20:49:01', '2026-11-10 20:49:01'),
(83, 'Bengkel Kerja Mesin', 'bengkel', 'TP', '2026-11-10 20:49:01', '2026-11-10 20:49:01'),
(84, 'Bengkel Kerja Mesin CNC', 'bengkel', 'TP', '2026-11-10 20:49:01', '2026-11-10 20:49:01'),
(85, 'Ruang Gambar CAD (Pemesinan)', 'laboratorium', 'TP', '2026-11-10 20:49:01', '2026-11-10 20:49:01'),
(86, 'Bengkel Chassis', 'bengkel', 'TKRO', '2026-11-10 20:49:01', '2026-11-10 20:49:01'),
(87, 'Bengkel Motor (Engine)', 'bengkel', 'TKRO', '2026-11-10 20:49:01', '2026-11-10 20:49:01'),
(88, 'Bengkel Kelistrikan Otomotif', 'bengkel', 'TKRO', '2026-11-10 20:49:01', '2026-11-10 20:49:01'),
(89, 'Bengkel Teknologi Dasar Otomotif', 'bengkel', 'TKRO', '2026-11-10 20:49:01', '2026-11-10 20:49:01'),
(90, 'Bengkel Sepeda Motor', 'bengkel', 'TBSM', '2026-11-10 20:49:01', '2026-11-10 20:49:01'),
(91, 'Laboratorium Komputer 1 (PPLG)', 'laboratorium', 'PPLG', '2026-11-10 20:49:01', '2026-11-10 20:49:01'),
(92, 'Laboratorium Komputer 2 (PPLG)', 'laboratorium', 'PPLG', '2026-11-10 20:49:01', '2026-11-10 20:49:01'),
(93, 'Laboratorium Elektronika', 'laboratorium', 'TEI', '2026-11-10 20:49:01', '2026-11-10 20:49:01'),
(94, 'Bengkel Instalasi Tenaga Listrik', 'bengkel', 'TITL', '2026-11-10 20:49:01', '2026-11-10 20:49:01'),
(95, 'Laboratorium Otomasi Industri', 'laboratorium', 'TOI', '2026-11-10 20:49:01', '2026-11-10 20:49:01'),
(96, 'Ruang Gambar DPIB', 'laboratorium', 'DPIB', '2026-11-10 20:49:01', '2026-11-10 20:49:01'),
(97, 'Bengkel Konstruksi Bangunan', 'bengkel', 'TKP', '2026-11-10 20:49:01', '2026-11-10 20:49:01'),
(98, 'Perpustakaan', 'umum', NULL, '2026-11-10 20:49:01', '2026-11-10 20:49:01'),
(99, 'Ruang Guru', 'umum', NULL, '2026-11-10 20:49:01', '2026-11-10 20:49:01'),
(100, 'Ruang Kepala Sekolah', 'umum', NULL, '2026-11-10 20:49:01', '2026-11-10 20:49:01'),
(101, 'Ruang Tata Usaha', 'umum', NULL, '2026-11-10 20:49:01', '2026-11-10 20:49:01'),
(102, 'Ruang BK', 'umum', NULL, '2026-11-10 20:49:01', '2026-11-10 20:49:01'),
(103, 'UKS', 'umum', NULL, '2026-11-10 20:49:01', '2026-11-10 20:49:01'),
(104, 'Masjid / Musala', 'umum', NULL, '2026-11-10 20:49:01', '2026-11-10 20:49:01'),
(105, 'Aula', 'umum', NULL, '2026-11-10 20:49:01', '2026-11-10 20:49:01'),
(106, 'Lapangan Upacara', 'umum', NULL, '2026-11-10 20:49:01', '2026-11-10 20:49:01'),
(107, 'Lapangan Olahraga', 'umum', NULL, '2026-11-10 20:49:01', '2026-11-10 20:49:01'),
(108, 'Kantin', 'umum', NULL, '2026-11-10 20:49:01', '2026-11-10 20:49:01'),
(109, 'Toilet Siswa', 'umum', NULL, '2026-11-10 20:49:01', '2026-11-10 20:49:01'),
(110, 'Toilet Guru', 'umum', NULL, '2026-11-10 20:49:01', '2026-11-10 20:49:01'),
(111, 'Area Parkir', 'umum', NULL, '2026-11-10 20:49:01', '2026-11-10 20:49:01'),
(112, 'Pos Satpam & Gerbang', 'umum', NULL, '2026-11-10 20:49:01', '2026-11-10 20:49:01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_10_20_000001_add_role_fields_to_users_table', 1),
(5, '2026_10_20_000002_create_lokasis_table', 1),
(6, '2026_10_20_000003_create_laporans_table', 1),
(7, '2026_11_03_000001_merge_status_diproses_into_diverifikasi', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(191) NOT NULL,
  `token` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(191) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `role` varchar(191) NOT NULL DEFAULT 'pelapor',
  `nis_nip` varchar(191) DEFAULT NULL,
  `kelas` varchar(191) DEFAULT NULL,
  `phone` varchar(191) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `nis_nip`, `kelas`, `phone`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admincuy@gmail.com', 'admin', NULL, NULL, NULL, NULL, '$2y$12$QqtwTrh3.wPLzDje8rWss.BZoVf9dbf.pCR7ABKv9j1AD9VmV2d.e', NULL, '2026-11-10 20:49:01', '2026-11-10 20:49:01'),
(2, 'Guru', 'gurucuy@gmail.com', 'pelapor', NULL, 'Guru / Staf', NULL, NULL, '$2y$12$52hpEtRvg8LBUXIXKRuiZO4Y9l9/9cF.c0QwdOcq8IG9K1IWKCKr2', NULL, '2026-11-10 20:49:01', '2026-11-10 20:49:01'),
(3, 'Abdul Aziz Nurrahman', '0085192025@siswa.smkn5solo.sch.id', 'pelapor', '0085192025', 'Kelas XII RPL C', NULL, NULL, '$2y$12$42bxo.394rt2V1hVpK7u5OCBVGIpZMi2g8mfIqymeyprenJ3IgpW6', NULL, '2026-11-10 20:49:02', '2026-11-10 20:49:02'),
(4, 'Adiputra Arya Sena', '0099677881@siswa.smkn5solo.sch.id', 'pelapor', '0099677881', 'Kelas XII RPL C', NULL, NULL, '$2y$12$gnwk6OIqytJ5yCIHBphidOHI0LFbcoQJmFNexP.9Ds1inXnGB6NAu', NULL, '2026-11-10 20:49:02', '2026-11-10 20:49:02'),
(5, 'Alvin Yourry Putra Mentari', '0085189232@siswa.smkn5solo.sch.id', 'pelapor', '0085189232', 'Kelas XII RPL C', NULL, NULL, '$2y$12$Q2DP7FoaMALadaJUz46jVuTpIPzVLXOWpdjZ14PsSJ4PzBeZM5uhi', NULL, '2026-11-10 20:49:02', '2026-11-10 20:49:02'),
(6, 'Amadeo Brian Ranastya Putra', '0082552856@siswa.smkn5solo.sch.id', 'pelapor', '0082552856', 'Kelas XII RPL C', NULL, NULL, '$2y$12$NQbvs6.RjyBZOVqNu2Tx8OpqZ4fzWEefveSnym23lPWIyzyiYNJNm', NULL, '2026-11-10 20:49:03', '2026-11-10 20:49:03'),
(7, 'Andreas Kelvin Anasta Putra', '0091140341@siswa.smkn5solo.sch.id', 'pelapor', '0091140341', 'Kelas XII RPL C', NULL, NULL, '$2y$12$oWhUL3OLwkwbMmxj1m4MJuh8.p6ykI3Hbj0k5cRKB6p5F9VRhM8xW', NULL, '2026-11-10 20:49:03', '2026-11-10 20:49:03'),
(8, 'Anjeli Afifah Darajati', '0081528255@siswa.smkn5solo.sch.id', 'pelapor', '0081528255', 'Kelas XII RPL C', NULL, NULL, '$2y$12$FNRGDz4GAeZ4YgdaS1XywOuj7tIAeKFxE4pVs4ItHwokaX5vK2ci2', NULL, '2026-11-10 20:49:03', '2026-11-10 20:49:03'),
(9, 'Azriel Aida Nurochim', '0094655031@siswa.smkn5solo.sch.id', 'pelapor', '0094655031', 'Kelas XII RPL C', NULL, NULL, '$2y$12$xodB3DE7CFwwPpudz5DU0O0avnCUcg0gMYq929t9Zzlhqu175Hl8a', NULL, '2026-11-10 20:49:04', '2026-11-10 20:49:04'),
(10, 'Bintang Fahri Hascarya', '0089632086@siswa.smkn5solo.sch.id', 'pelapor', '0089632086', 'Kelas XII RPL C', NULL, NULL, '$2y$12$Fete/z6zt8f6fr6WfeoJu.ppTxXo3RH5UD2LfeXyKtG3mB20kgLVa', NULL, '2026-11-10 20:49:04', '2026-11-10 20:49:04'),
(11, 'Carisha Amira Insani', '0082793500@siswa.smkn5solo.sch.id', 'pelapor', '0082793500', 'Kelas XII RPL C', NULL, NULL, '$2y$12$fyU7KGe9cbj8qEOsdK/JWu0HV54RF.JGb3hy9rq.Mc7q.rV.YLLvC', NULL, '2026-11-10 20:49:05', '2026-11-10 20:49:05'),
(12, 'Chelsea Muhammad Adli', '0096404873@siswa.smkn5solo.sch.id', 'pelapor', '0096404873', 'Kelas XII RPL C', NULL, NULL, '$2y$12$V4DvZ9qEXvz5EnTJgBIxROV/fzfsYRx4jXULEDuDviU7uw9Lh0Gy.', NULL, '2026-11-10 20:49:05', '2026-11-10 20:49:05'),
(13, 'Christian Wardana', '0085226056@siswa.smkn5solo.sch.id', 'pelapor', '0085226056', 'Kelas XII RPL C', NULL, NULL, '$2y$12$Cy9I.y5Xb/bW/6c6kILSpuc7WFYTUjMp.4w5STqadayXofj8dG62a', NULL, '2026-11-10 20:49:05', '2026-11-10 20:49:05'),
(14, 'Cleodora Bertha Fortuna', '0099325275@siswa.smkn5solo.sch.id', 'pelapor', '0099325275', 'Kelas XII RPL C', NULL, NULL, '$2y$12$r3Qn.oTznsnftUPtljNKsuSYfWf5F6I9DAByyRTzj9OMaIYqkdUou', NULL, '2026-11-10 20:49:06', '2026-11-10 20:49:06'),
(15, 'Cristiano Vieli Kaligis', '0099196067@siswa.smkn5solo.sch.id', 'pelapor', '0099196067', 'Kelas XII RPL C', NULL, NULL, '$2y$12$VX8srzK8figthcVRIB4/K.Ib/R8OCvn4emLP2udTtdboRfreX7yrC', NULL, '2026-11-10 20:49:06', '2026-11-10 20:49:06'),
(16, 'Daffa Farih Irfanudin', '0093922303@siswa.smkn5solo.sch.id', 'pelapor', '0093922303', 'Kelas XII RPL C', NULL, NULL, '$2y$12$CKASRBcgrads76Pt2kyPVuuOTwOeWt.J28DjRHduzzpK7rv2mgwD6', NULL, '2026-11-10 20:49:06', '2026-11-10 20:49:06'),
(17, 'Desta Tiar Redriana', '0087475927@siswa.smkn5solo.sch.id', 'pelapor', '0087475927', 'Kelas XII RPL C', NULL, NULL, '$2y$12$R2bKVLaZ8o3tCyy4gmeZL.4LnX8XZktCpIPwBJoz/QMWmMtW7lnbq', NULL, '2026-11-10 20:49:07', '2026-11-10 20:49:07'),
(18, 'Farrel Brilliant Nugroho', '0091553307@siswa.smkn5solo.sch.id', 'pelapor', '0091553307', 'Kelas XII RPL C', NULL, NULL, '$2y$12$2Z22/2zbN8aEybHrhtCmKu8yZKmfTN3d6GYXBkfF0Ts2HGz5dDmRy', NULL, '2026-11-10 20:49:07', '2026-11-10 20:49:07'),
(19, 'Fida Qurottu Aini', '0086726378@siswa.smkn5solo.sch.id', 'pelapor', '0086726378', 'Kelas XII RPL C', NULL, NULL, '$2y$12$iQLt2Fg3LtRj4m5ydyeK7e8Khs2vK2z6ooJ/MDzKrJ.3GTJsQ3lVK', NULL, '2026-11-10 20:49:07', '2026-11-10 20:49:07'),
(20, 'Ghozi Mumtaza Hanif', '0098225927@siswa.smkn5solo.sch.id', 'pelapor', '0098225927', 'Kelas XII RPL C', NULL, NULL, '$2y$12$0yyl8zriuVawTh7jnskiyOWTUDKNKomUBK1wI4W6Qm012lS.ZaBZK', NULL, '2026-11-10 20:49:08', '2026-11-10 20:49:08'),
(21, 'Irfan Aji Wardana', '0083318812@siswa.smkn5solo.sch.id', 'pelapor', '0083318812', 'Kelas XII RPL C', NULL, NULL, '$2y$12$sT3DUAV3k022UK2R0Qb8W.zT.kOWEe.9qnitAYjmRpD2Fcc/bKcni', NULL, '2026-11-10 20:49:08', '2026-11-10 20:49:08'),
(22, 'Manestiko Banyubiru', '0098813285@siswa.smkn5solo.sch.id', 'pelapor', '0098813285', 'Kelas XII RPL C', NULL, NULL, '$2y$12$ePbMOjlqtodt6QTnkS6FuedVNAgID5jreumAXRQz6FDOXfqe3DvAu', NULL, '2026-11-10 20:49:08', '2026-11-10 20:49:08'),
(23, 'Michael Aditya', '0082434559@siswa.smkn5solo.sch.id', 'pelapor', '0082434559', 'Kelas XII RPL C', NULL, NULL, '$2y$12$vUBj8/49V.kG4VuxDdGpEuAU44D25NEQEsrXI.y0xIUYcsuPhxYYq', NULL, '2026-11-10 20:49:09', '2026-11-10 20:49:09'),
(24, 'Moses Adi Saputra', '0099030536@siswa.smkn5solo.sch.id', 'pelapor', '0099030536', 'Kelas XII RPL C', NULL, NULL, '$2y$12$fMQXSWcLCaNmC3dZ4aAbGu0OiyefRjev.QEVLymRqwz8shJZRDF3O', NULL, '2026-11-10 20:49:09', '2026-11-10 20:49:09'),
(25, 'Muhammad Anshori', '0097488229@siswa.smkn5solo.sch.id', 'pelapor', '0097488229', 'Kelas XII RPL C', NULL, NULL, '$2y$12$IH/arQCMOaSKrc6CGpP//.19whsOxs034a5skmNIAJvwOgKG84Mgy', NULL, '2026-11-10 20:49:09', '2026-11-10 20:49:09'),
(26, 'Muhammad Fahri Rahman Arrafi', '3096322062@siswa.smkn5solo.sch.id', 'pelapor', '3096322062', 'Kelas XII RPL C', NULL, NULL, '$2y$12$avap2HuQr.k7oLuNI00.g.vJnEngCBgr3aYUsHBro9Flh1oMn08DG', NULL, '2026-11-10 20:49:10', '2026-11-10 20:49:10'),
(27, 'Muhammad Rosyid Muryanto', '0098352062@siswa.smkn5solo.sch.id', 'pelapor', '0098352062', 'Kelas XII RPL C', NULL, NULL, '$2y$12$Wv0E2f.j3OiZlrUAbRs7YutndlpJ48giePXLhDmm7kecdwrbv9qOi', NULL, '2026-11-10 20:49:10', '2026-11-10 20:49:10'),
(28, 'Nicholas Gusti Saputra', '3098883861@siswa.smkn5solo.sch.id', 'pelapor', '3098883861', 'Kelas XII RPL C', NULL, NULL, '$2y$12$O2Hp9mbHo5w9U.SEH788Ce57BLExteFFCH5kMT.0h.xpt3ayP06lG', NULL, '2026-11-10 20:49:10', '2026-11-10 20:49:10'),
(29, 'Pranaja Abi Praya Widyatamaka', '0099821145@siswa.smkn5solo.sch.id', 'pelapor', '0099821145', 'Kelas XII RPL C', NULL, NULL, '$2y$12$KSg/jSQTJ2TDkA3JugGhuONLDvt0fAVZR.tV1nPDzSV/PyK0nuHQC', NULL, '2026-11-10 20:49:11', '2026-11-10 20:49:11'),
(30, 'Ramaditya Surya Putra', '0097645030@siswa.smkn5solo.sch.id', 'pelapor', '0097645030', 'Kelas XII RPL C', NULL, NULL, '$2y$12$OF2sGRphG2/fj.zb5Y/UjekZ0njzJ8J2J4IRcXqtnopkJNV6aCl2y', NULL, '2026-11-10 20:49:11', '2026-11-10 20:49:11'),
(31, 'Sabian Apta Arira', '0082793082@siswa.smkn5solo.sch.id', 'pelapor', '0082793082', 'Kelas XII RPL C', NULL, NULL, '$2y$12$WfbmRRsVqNvnkueviSyFquqPhwBcbUDEeevNua4TstMzpt2tz3ZXK', NULL, '2026-11-10 20:49:11', '2026-11-10 20:49:11'),
(32, 'Satria Rahmansyah', '0098491439@siswa.smkn5solo.sch.id', 'pelapor', '0098491439', 'Kelas XII RPL C', NULL, NULL, '$2y$12$0aSb6HiKuiqOv7vrWbHUiOMsbJbSo8mg5sy7nkgd7fzXrjF27KUqi', NULL, '2026-11-10 20:49:12', '2026-11-10 20:49:12'),
(33, 'Theodorick Bakuh Panggalih', '0094722484@siswa.smkn5solo.sch.id', 'pelapor', '0094722484', 'Kelas XII RPL C', NULL, NULL, '$2y$12$B82XUUQ0RfCJP9tl6qLXGOixrGoEdhYIZEQRBa/AcFYk580.GQRsK', NULL, '2026-11-10 20:49:12', '2026-11-10 20:49:12'),
(34, 'X-Ian Adi Nugroho', '0082122132@siswa.smkn5solo.sch.id', 'pelapor', '0082122132', 'Kelas XII RPL C', NULL, NULL, '$2y$12$3E.rVmSnzm95ZbkwEgJ9qu2FMylAXOmROhU1/GUH3mfH19wToLmBC', NULL, '2026-11-10 20:49:12', '2026-11-10 20:49:12'),
(35, 'Admin Sarpras', 'admin@smkn5solo.sch.id', 'admin', 'ADM001', NULL, NULL, NULL, '$2y$12$XQ8yzzd8DrzKwZcgP.HFSeXBO88ZXl2DZDUlpVHaHWxO4u1nk7PY2', NULL, '2026-11-10 20:49:13', '2026-11-10 20:49:13'),
(36, 'Petugas Sarpras', 'petugas@smkn5solo.sch.id', 'petugas', 'PTG001', NULL, NULL, NULL, '$2y$12$DoHoGirx1ft7XGUSHOOsreGP744BziDz/YBsi4njmEhxahGNdhJCm', NULL, '2026-11-10 20:49:13', '2026-11-10 20:49:13'),
(37, 'Budi Santoso', 'budi@siswa.smkn5solo.sch.id', 'pelapor', '0051234', 'Kelas XII RPL A', '081234567890', NULL, '$2y$12$iYgZPHo7RsRYLTcPCd.y9OkkTxA6Fv7gDMQwbAMsSZ7SFICyY6Eme', NULL, '2026-11-10 20:49:13', '2026-11-10 20:49:13');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `laporans`
--
ALTER TABLE `laporans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `laporans_kode_unique` (`kode`),
  ADD KEY `laporans_user_id_foreign` (`user_id`),
  ADD KEY `laporans_lokasi_id_foreign` (`lokasi_id`),
  ADD KEY `laporans_petugas_id_foreign` (`petugas_id`),
  ADD KEY `laporans_status_created_at_index` (`status`,`created_at`);

--
-- Indeks untuk tabel `laporan_logs`
--
ALTER TABLE `laporan_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `laporan_logs_laporan_id_foreign` (`laporan_id`),
  ADD KEY `laporan_logs_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `lokasis`
--
ALTER TABLE `lokasis`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_nis_nip_unique` (`nis_nip`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `laporans`
--
ALTER TABLE `laporans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `laporan_logs`
--
ALTER TABLE `laporan_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `lokasis`
--
ALTER TABLE `lokasis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `laporans`
--
ALTER TABLE `laporans`
  ADD CONSTRAINT `laporans_lokasi_id_foreign` FOREIGN KEY (`lokasi_id`) REFERENCES `lokasis` (`id`),
  ADD CONSTRAINT `laporans_petugas_id_foreign` FOREIGN KEY (`petugas_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `laporans_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `laporan_logs`
--
ALTER TABLE `laporan_logs`
  ADD CONSTRAINT `laporan_logs_laporan_id_foreign` FOREIGN KEY (`laporan_id`) REFERENCES `laporans` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `laporan_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
