-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 17, 2024 at 06:54 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perizinan`
--

-- --------------------------------------------------------

--
-- Table structure for table `izin_ketidakhadiran_pegawai`
--

CREATE TABLE `izin_ketidakhadiran_pegawai` (
  `izin_id` int NOT NULL,
  `keperluan` varchar(255) NOT NULL,
  `finger_print_id` varchar(20) NOT NULL,
  `tgl_mulai_izin` date NOT NULL,
  `durasi_izin_hari` varchar(20) NOT NULL,
  `durasi_izin_jam` varchar(20) NOT NULL,
  `durasi_izin_menit` varchar(20) NOT NULL,
  `nama_pengusul` varchar(255) NOT NULL,
  `tgl_usul` date NOT NULL,
  `ttd_pengusul` varchar(255) NOT NULL,
  `putusan` varchar(50) NOT NULL,
  `tgl_disetujui` date NOT NULL,
  `ttd_atasan` varchar(255) NOT NULL,
  `catatan` varchar(255) NOT NULL,
  `nama_dosen` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `izin_ketidakhadiran_pegawai`
--

INSERT INTO `izin_ketidakhadiran_pegawai` (`izin_id`, `keperluan`, `finger_print_id`, `tgl_mulai_izin`, `durasi_izin_hari`, `durasi_izin_jam`, `durasi_izin_menit`, `nama_pengusul`, `tgl_usul`, `ttd_pengusul`, `putusan`, `tgl_disetujui`, `ttd_atasan`, `catatan`, `nama_dosen`) VALUES
(1, 'Sakit', 'FP1', '2024-10-16', '1', '-', '-', 'Dino', '2024-10-16', 'Dino', 'Disetujui', '2024-10-16', 'Seungchol', 'Surat keterangan dokter menyusul', 'Vernon'),
(102, 'Cuti', 'FP345', '2024-10-17', '2', '-', '-', 'Tartaglia', '2024-10-01', 'Tartaglia', 'Ditunda', '2024-10-06', 'Tsaritsa', 'Cuti tahunan', 'Capitano'),
(123, 'Perjalanan Dinas', 'FP134', '2024-10-21', '3', '-', '-', 'Scaramouhce', '2024-10-17', 'Scaramouche', 'Disetujui', '2024-10-18', 'Tsaritsa', 'Perjalanan dinas ke Inazuma', 'Signora'),
(201, 'Cuti', 'FP652', '2024-10-18', '1', '-', '-', 'Kaeya', '2024-10-15', 'Kaeya', 'Ditolak', '2024-10-15', 'Jean', 'Izin ditolak', 'Lisa');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `izin_ketidakhadiran_pegawai`
--
ALTER TABLE `izin_ketidakhadiran_pegawai`
  ADD PRIMARY KEY (`izin_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
