-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Waktu pembuatan: 28 Bulan Mei 2025 pada 04.35
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pendapatan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_pendapatan`
--

CREATE TABLE `master_pendapatan` (
  `kode` varchar(50) NOT NULL,
  `uraian` varchar(255) NOT NULL,
  `id_opd` int(11) DEFAULT NULL,
  `jumlah` decimal(20,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `tahun` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `master_pendapatan`
--

INSERT INTO `master_pendapatan` (`kode`, `uraian`, `id_opd`, `jumlah`, `created_at`, `tahun`) VALUES
('4', 'PENDAPATAN DAERAH', NULL, 0.00, '2025-05-27 04:31:40', 2025),
('4.1', 'PENDAPATAN ASLI DAERAH (PAD)', NULL, 591181634834.00, '2025-05-27 04:31:40', 2025),
('4.1.01', 'Pajak Daerah', NULL, 292408031500.00, '2025-05-27 04:31:40', 2025),
('4.1.01.09', 'Pajak Reklame', NULL, 1879985000.00, '2025-05-27 04:31:40', 2025),
('4.1.01.09.01', 'Pajak Reklame Papan/Billboard/Videotron/ Megatron', NULL, 1538320000.00, '2025-05-27 04:31:41', 2025),
('4.1.01.09.01.0001', 'Pajak Reklame Papan/Billboard/Videotron/ Megatron', 1, 1538320000.00, '2025-05-27 04:31:41', 2025),
('4.1.01.09.02', 'Pajak Reklame Kain', NULL, 341470000.00, '2025-05-27 04:31:41', 2025),
('4.1.01.09.02.0001', 'Pajak Reklame Kain', 1, 341470000.00, '2025-05-27 04:31:41', 2025),
('4.1.01.09.03', 'Pajak Reklame Melekat/Stiker', NULL, 195000.00, '2025-05-27 04:31:41', 2025),
('4.1.01.09.03.0001', 'Pajak Reklame Melekat/Stiker', 1, 195000.00, '2025-05-27 04:31:41', 2025),
('4.1.01.12', 'Pajak Air Tanah', NULL, 1178460000.00, '2025-05-27 04:31:41', 2025),
('4.1.01.12.01', 'Pajak Air Tanah', NULL, 1178460000.00, '2025-05-27 04:31:41', 2025),
('4.1.01.12.01.0001', 'Pajak Air Tanah', 1, 1178460000.00, '2025-05-27 04:31:41', 2025),
('4.1.01.13', 'Pajak Sarang Burung Walet', NULL, 2730000.00, '2025-05-27 04:31:41', 2025),
('4.1.01.13.01', 'Pajak Sarang Burung Walet', NULL, 2730000.00, '2025-05-27 04:31:41', 2025),
('4.1.01.13.01.0001', 'Pajak Sarang Burung Walet', 1, 2730000.00, '2025-05-27 04:31:41', 2025),
('4.1.01.14', 'Pajak Mineral Bukan Logam dan Batuan', NULL, 1879900000.00, '2025-05-27 04:31:41', 2025),
('4.1.01.14.09', 'Pajak Felspar', NULL, 1565000000.00, '2025-05-27 04:31:41', 2025),
('4.1.01.14.09.0001', 'Pajak Felspar', 1, 1565000000.00, '2025-05-27 04:31:41', 2025),
('4.1.01.14.12', 'Pajak Granit/Andesit', NULL, 135300000.00, '2025-05-27 04:31:41', 2025),
('4.1.01.14.12.0001', 'Pajak Granit/Andesit', 1, 135300000.00, '2025-05-27 04:31:41', 2025),
('4.1.01.14.23', 'Pajak Pasir dan Kerikil', NULL, 140600000.00, '2025-05-27 04:31:41', 2025),
('4.1.01.14.23.0001', 'Pajak Pasir dan Kerikil', 1, 140600000.00, '2025-05-27 04:31:41', 2025),
('4.1.01.14.37', 'Pajak Mineral bukan Logam dan Batuan Lainnya', NULL, 39000000.00, '2025-05-27 04:31:41', 2025),
('4.1.01.14.37.0001', 'Pajak Mineral bukan Logam dan Batuan Lainnya', 1, 39000000.00, '2025-05-27 04:31:41', 2025),
('4.1.01.15', 'Pajak Bumi dan Bangunan Perdesaan dan Perkotaan (PBBP2)', NULL, 67264223768.00, '2025-05-27 04:31:41', 2025),
('4.1.01.15.01', 'PBBP2', NULL, 67264223768.00, '2025-05-27 04:31:41', 2025),
('4.1.01.15.01.0001', 'PBBP2', 1, 67264223768.00, '2025-05-27 04:31:41', 2025),
('4.1.01.16', 'Bea Perolehan Hak Atas Tanah dan Bangunan (BPHTB)', NULL, 36018650000.00, '2025-05-27 04:31:41', 2025),
('4.1.01.16.01', 'BPHTB-Pemindahan Hak', NULL, 36018650000.00, '2025-05-27 04:31:41', 2025),
('4.1.01.16.01.0001', 'BPHTB-Pemindahan Hak', 1, 36018650000.00, '2025-05-27 04:31:41', 2025),
('4.1.01.19', 'Pajak Barang dan Jasa Tertentu (PBJT)', NULL, 79294422732.00, '2025-05-27 04:31:41', 2025),
('4.1.01.19.01', 'PBJT-Makanan dan/atau Minuman', NULL, 13976000000.00, '2025-05-27 04:31:41', 2025),
('4.1.01.19.01.0001', 'PBJT-Restoran', 1, 5026000000.00, '2025-05-27 04:31:41', 2025),
('4.1.01.19.01.0002', 'PBJT-Penyedia Jasa Boga atau Katering', 1, 8950000000.00, '2025-05-27 04:31:41', 2025),
('4.1.01.19.02', 'PBJT-Tenaga Listrik', NULL, 60622252732.00, '2025-05-27 04:31:41', 2025),
('4.1.01.19.02.0001', 'PBJT-Konsumsi Tenaga Listrik dari Sumber Lain', 1, 60622252732.00, '2025-05-27 04:31:41', 2025),
('4.1.01.19.03', 'PBJT-Jasa Perhotelan', NULL, 4144650000.00, '2025-05-27 04:31:41', 2025),
('4.1.01.19.03.0001', 'PBJT-Hotel', 1, 3685000000.00, '2025-05-27 04:31:41', 2025),
('4.1.01.19.03.0004', 'PBJT-Pondok Wisata', 1, 459650000.00, '2025-05-27 04:31:41', 2025),
('4.1.01.19.04', 'PBJT-Jasa Parkir', NULL, 190450000.00, '2025-05-27 04:31:41', 2025),
('4.1.01.19.04.0001', 'PBJT-Penyediaan atau Penyelenggaraan Tempat Parkir', 1, 190450000.00, '2025-05-27 04:31:41', 2025),
('4.1.01.19.05', 'PBJT-Jasa Kesenian dan Hiburan', NULL, 361070000.00, '2025-05-27 04:31:41', 2025),
('4.1.01.19.05.0002', 'PBJT-Pergelaran Kesenian, Musik, Tari, dan/atau Busana', 1, 100570000.00, '2025-05-27 04:31:41', 2025),
('4.1.01.19.05.0009', 'PBJT-Olahraga Permainan dengan Menggunakan Tempat/Ruang dan/atau Peralatan dan Perlengkapan untuk Olahraga dan Kebugaran', 1, 260500000.00, '2025-05-27 04:31:41', 2025),
('4.1.01.20', 'Opsen Pajak Kendaraan Bermotor (PKB)', NULL, 70463740000.00, '2025-05-27 04:31:41', 2025),
('4.1.01.20.01', 'Opsen PKB', NULL, 70463740000.00, '2025-05-27 04:31:41', 2025),
('4.1.01.20.01.0001', 'Opsen PKB', 1, 70463740000.00, '2025-05-27 04:31:41', 2025),
('4.1.01.21', 'Opsen Bea Balik Nama Kendaraan Bermotor (BBNKB)', NULL, 34425920000.00, '2025-05-27 04:31:41', 2025),
('4.1.01.21.01', 'Opsen BBNKB', NULL, 34425920000.00, '2025-05-27 04:31:41', 2025),
('4.1.01.21.01.0001', 'Opsen BBNKB', 1, 34425920000.00, '2025-05-27 04:31:41', 2025),
('4.1.02', 'Retribusi Daerah', NULL, 278439447331.00, '2025-05-27 04:31:41', 2025),
('4.1.02.01', 'Retribusi Jasa Umum', NULL, 259074442472.00, '2025-05-27 04:31:41', 2025),
('4.1.02.01.01', 'Retribusi Pelayanan Kesehatan', NULL, 249523630472.00, '2025-05-27 04:31:41', 2025),
('4.1.02.01.01.0001', 'Retribusi Pelayanan Kesehatan di Pkm', NULL, 56254230472.00, '2025-05-27 04:31:41', 2025),
('4.1.02.01.01.0005', 'Retribusi Pelayanan Kesehatan di Rumah Sakit Umum Daerah', 2, 193019400000.00, '2025-05-27 04:31:41', 2025),
('4.1.02.01.01.0006', 'Retribusi Pelayanan Kesehatan di Tempat Pelayanan Kesehatan Lainnya yang Sejenis', 3, 250000000.00, '2025-05-27 04:31:41', 2025),
('4.1.02.01.04', 'Retribusi Pelayanan Parkir di Tepi Jalan Umum', 4, 1300000000.00, '2025-05-27 04:31:41', 2025),
('4.1.02.01.04.0001', 'Retribusi Penyediaan Pelayanan Parkir di Tepi Jalan Umum', 4, 1300000000.00, '2025-05-27 04:31:41', 2025),
('4.1.02.01.05', 'Retribusi Pelayanan Pasar', 5, 6014952000.00, '2025-05-27 04:31:41', 2025),
('4.1.02.01.05.0002', 'Retribusi Los', 5, 1802840000.00, '2025-05-27 04:31:41', 2025),
('4.1.02.01.05.0003', 'Retribusi Kios', 5, 4212112000.00, '2025-05-27 04:31:41', 2025),
('4.1.02.01.14', 'Retribusi Pelayanan Kebersihan', NULL, 2235860000.00, '2025-05-27 04:31:41', 2025),
('4.1.02.01.14.0001', 'Retribusi Pelayanan Persampahan', NULL, 2200000000.00, '2025-05-27 04:31:41', 2025),
('4.1.02.01.14.0002', 'Retribusi Penyediaan dan/atau Penyedotan Kakus', 7, 35860000.00, '2025-05-27 04:31:41', 2025),
('4.1.02.02', 'Retribusi Jasa Usaha', NULL, 10288912859.00, '2025-05-27 04:31:41', 2025),
('4.1.02.02.03', 'Retribusi Tempat Pelelangan', NULL, 325280000.00, '2025-05-27 04:31:41', 2025),
('4.1.02.02.03.0001', 'Retribusi Penyediaan Tempat Pelelangan', 8, 325280000.00, '2025-05-27 04:31:41', 2025),
('4.1.02.02.06', 'Retribusi Tempat Penginapan/ Pesanggrahan/Vila', NULL, 389200000.00, '2025-05-27 04:31:41', 2025),
('4.1.02.02.06.0001', 'Retribusi Pelayanan Tempat Penginapan/ Pesanggrahan/Vila', 9, 389200000.00, '2025-05-27 04:31:41', 2025),
('4.1.02.02.07', 'Retribusi Rumah Potong Hewan', NULL, 180450000.00, '2025-05-27 04:31:41', 2025),
('4.1.02.02.07.0001', 'Retribusi Pelayanan Rumah Potong Hewan', 10, 180450000.00, '2025-05-27 04:31:41', 2025),
('4.1.02.02.08', 'Retribusi Pelayanan Kepelabuhanan', NULL, 611151000.00, '2025-05-27 04:31:41', 2025),
('4.1.02.02.08.0001', 'Retribusi Pelayanan Kepelabuhanan', 4, 611151000.00, '2025-05-27 04:31:41', 2025),
('4.1.02.02.12', 'Retribusi Penyediaan Tempat Kegiatan Usaha berupa Pasar, Grosir, Pertokoan, dan Tempat Kegiatan Usaha Lainnya', NULL, 43991000.00, '2025-05-27 04:31:41', 2025),
('4.1.02.02.12.0001', 'Retribusi Penyediaan Tempat Kegiatan Usaha berupa Pasar, Grosir, Pertokoan, dan Tempat Kegiatan Usaha Lainnya', 4, 43991000.00, '2025-05-27 04:31:41', 2025),
('4.1.02.02.14', 'Retribusi Penyediaan Tempat Khusus Parkir Diluar Badan Jalan', NULL, 415000000.00, '2025-05-27 04:31:41', 2025),
('4.1.02.02.14.0001', 'Retribusi Penyediaan Tempat Khusus Parkir Diluar Badan Jalan', NULL, 415000000.00, '2025-05-27 04:31:41', 2025),
('4.1.02.02.17', 'Retribusi Pelayanan Tempat Rekreasi, Pariwisata, dan Olahraga', NULL, 5153640000.00, '2025-05-27 04:31:41', 2025),
('4.1.02.02.17.0001', 'Retribusi Pelayanan Tempat Rekreasi, Pariwisata, dan Olahraga', NULL, 5153640000.00, '2025-05-27 04:31:41', 2025),
('4.1.02.02.18', 'Retribusi Pelayanan Penyeberangan Orang atau Barang dengan Menggunakan Kendaraan di Air', NULL, 100084000.00, '2025-05-27 04:31:41', 2025),
('4.1.02.02.18.0001', 'Retribusi Pelayanan Penyeberangan Orang atau Barang dengan Menggunakan Kendaraan di Air', 4, 100084000.00, '2025-05-27 04:31:41', 2025),
('4.1.02.02.20', 'Retribusi Pemanfaatan Aset Daerah', NULL, 3070116859.00, '2025-05-27 04:31:41', 2025),
('4.1.02.02.20.0001', 'Retribusi Pemanfaatan Aset Daerah', NULL, 3070116859.00, '2025-05-27 04:31:41', 2025),
('4.1.02.03', 'Retribusi Perizinan Tertentu', NULL, 9076092000.00, '2025-05-27 04:31:41', 2025),
('4.1.02.03.07', 'Retribusi Persetujuan Bangunan Gedung', NULL, 4476092000.00, '2025-05-27 04:31:41', 2025),
('4.1.02.03.07.0001', 'Retribusi Persetujuan Bangunan Gedung', 7, 4476092000.00, '2025-05-27 04:31:41', 2025),
('4.1.02.03.08', 'Retribusi Penggunaan Tenaga Kerja Asing (TKA)', NULL, 4600000000.00, '2025-05-27 04:31:41', 2025),
('4.1.02.03.08.0001', 'Retribusi Penggunaan Tenaga Kerja Asing (TKA)', 12, 4600000000.00, '2025-05-27 04:31:41', 2025),
('4.1.03', 'Hasil Pengelolaan Kekayaan Daerah yang Dipisahkan', NULL, 10921956475.00, '2025-05-27 04:31:41', 2025),
('4.1.03.02', 'Bagian Laba yang Dibagikan kepada Pemerintah Daerah (Dividen) atas Penyertaan Modal pada BUMD', NULL, 10921956475.00, '2025-05-27 04:31:41', 2025),
('4.1.03.02.01', 'Bagian Laba yang Dibagikan kepada Pemerintah Daerah (Dividen) atas Penyertaan Modal pada BUMD (Lembaga Keuangan)', NULL, 9819576000.00, '2025-05-27 04:31:41', 2025),
('4.1.03.02.01.0001', 'Bagian Laba yang Dibagikan kepada Pemerintah Daerah (Dividen) atas Penyertaan Modal pada BUMD (Lembaga Keuangan)', 1, 9819576000.00, '2025-05-27 04:31:41', 2025),
('4.1.03.02.02', 'Bagian Laba yang Dibagikan kepada Pemerintah Daerah (Dividen) atas Penyertaan Modal pada BUMD (Aneka Usaha)', NULL, 794238050.00, '2025-05-27 04:31:41', 2025),
('4.1.03.02.02.0001', 'Bagian Laba yang Dibagikan kepada Pemerintah Daerah (Dividen) atas Penyertaan Modal pada BUMD (Aneka Usaha)', 1, 794238050.00, '2025-05-27 04:31:41', 2025),
('4.1.03.02.03', 'Bagian Laba yang Dibagikan kepada Pemerintah Daerah (Dividen) atas Penyertaan Modal pada BUMD (Bidang Air Minum)', NULL, 308142425.00, '2025-05-27 04:31:41', 2025),
('4.1.03.02.03.0001', 'Bagian Laba yang Dibagikan kepada Pemerintah Daerah (Dividen) atas Penyertaan Modal pada Perusahaan Milik Daerah/BUMD (Bidang Air Minum)', 1, 308142425.00, '2025-05-27 04:31:41', 2025),
('4.1.04', 'Lain-lain PAD yang Sah', NULL, 9412199528.00, '2025-05-27 04:31:41', 2025),
('4.1.04.01', 'Hasil Penjualan BMD yang Tidak Dipisahkan', NULL, 542000000.00, '2025-05-27 04:31:41', 2025),
('4.1.04.01.03', 'Hasil Penjualan Gedung dan Bangunan', NULL, 400000000.00, '2025-05-27 04:31:41', 2025),
('4.1.04.01.03.0005', 'Hasil Penjualan Bangunan Gedung-Bangunan Gedung Tempat Kerja-Bangunan Gedung Kantor', 5, 400000000.00, '2025-05-27 04:31:41', 2025),
('4.1.04.01.05', 'Hasil Penjualan Aset Tetap Lainnya', NULL, 60000000.00, '2025-05-27 04:31:41', 2025),
('4.1.04.01.05.0054', 'Hasil Penjualan Biota Perairan-Ikan Bersirip (Pisces/Ikan Bersirip)-Ikan Budidaya', 8, 60000000.00, '2025-05-27 04:31:41', 2025),
('4.1.04.01.08', 'Hasil Penjualan Aset Lain-Lain', NULL, 82000000.00, '2025-05-27 04:31:41', 2025),
('4.1.04.01.08.0001', 'Hasil Penjualan Aset Lain-Lain-Aset Lain-Lain-Aset Rusak Berat/Usang', 1, 82000000.00, '2025-05-27 04:31:41', 2025),
('4.1.04.03', 'Hasil Pemanfaatan BMD yang Tidak Dipisahkan', NULL, 100000000.00, '2025-05-27 04:31:41', 2025),
('4.1.04.03.02', 'Hasil Kerja Sama Pemanfaatan BMD', NULL, 100000000.00, '2025-05-27 04:31:41', 2025),
('4.1.04.03.02.0001', 'Hasil Kerja Sama Pemanfaatan BMD', 13, 100000000.00, '2025-05-27 04:31:41', 2025),
('4.1.04.05', 'Jasa Giro', NULL, 1165000000.00, '2025-05-27 04:31:41', 2025),
('4.1.04.05.01', 'Jasa Giro pada Kas Daerah', NULL, 1165000000.00, '2025-05-27 04:31:41', 2025),
('4.1.04.05.01.0001', 'Jasa Giro pada Kas Daerah', 1, 1165000000.00, '2025-05-27 04:31:41', 2025),
('4.1.04.07', 'Pendapatan Bunga', NULL, 3400000000.00, '2025-05-27 04:31:41', 2025),
('4.1.04.07.01', 'Pendapatan Bunga atas Penempatan Uang Pemerintah Daerah', NULL, 3400000000.00, '2025-05-27 04:31:41', 2025),
('4.1.04.07.01.0001', 'Pendapatan Bunga atas Penempatan Uang Pemerintah Daerah', 1, 3400000000.00, '2025-05-27 04:31:41', 2025),
('4.1.04.08', 'Penerimaan atas Tuntutan Ganti Kerugian Keuangan Daerah', NULL, 25000000.00, '2025-05-27 04:31:41', 2025),
('4.1.04.08.01', 'Tuntutan Ganti Kerugian Daerah terhadap Bendahara', NULL, 25000000.00, '2025-05-27 04:31:41', 2025),
('4.1.04.08.01.0001', 'Tuntutan Ganti Kerugian Daerah terhadap Bendahara', 1, 25000000.00, '2025-05-27 04:31:41', 2025),
('4.1.04.15', 'Pendapatan dari Pengembalian', NULL, 2100000000.00, '2025-05-27 04:31:41', 2025),
('4.1.04.15.08', 'Pendapatan dari Pengembalian Kelebihan Pembayaran Belanja Gaji dan Tunjangan ASN', NULL, 2100000000.00, '2025-05-27 04:31:41', 2025),
('4.1.04.15.08.0001', 'Pendapatan dari Pengembalian Kelebihan Pembayaran Belanja Gaji Pokok ASN-Gaji Pokok PNS', 1, 2100000000.00, '2025-05-27 04:31:41', 2025),
('4.1.04.16', 'Pendapatan BLUD', NULL, 2080199528.00, '2025-05-27 04:31:41', 2025),
('4.1.04.16.04', 'Pendapatan BLUD dari Hasil Kerja Sama dengan Pihak Lain', NULL, 1417780000.00, '2025-05-27 04:31:41', 2025),
('4.1.04.16.04.0001', 'Pendapatan BLUD dari Hasil Kerja Sama dengan Pihak Lain', NULL, 1417780000.00, '2025-05-27 04:31:41', 2025),
('4.1.04.16.06', 'Pendapatan BLUD dari Lain-Lain Pendapatan BLUD yang Sah', NULL, 662419528.00, '2025-05-27 04:31:41', 2025),
('4.1.04.16.06.0001', 'Pendapatan BLUD dari Jasa Giro', NULL, 550219528.00, '2025-05-27 04:31:41', 2025),
('4.1.04.16.06.0002', 'Pendapatan BLUD dari Pendapatan Bunga', 2, 34200000.00, '2025-05-27 04:31:41', 2025),
('4.1.04.16.06.0006', 'Pendapatan BLUD dari Pengembangan Usaha', 2, 78000000.00, '2025-05-27 04:31:41', 2025),
('4.2', 'PENDAPATAN TRANSFER', NULL, 1922124039000.00, '2025-05-27 04:31:41', 2025),
('4.2.01', 'Pendapatan Transfer Pemerintah Pusat', NULL, 1807687568000.00, '2025-05-27 04:31:41', 2025),
('4.2.01.05', 'Dana Desa', NULL, 213716344000.00, '2025-05-27 04:31:41', 2025),
('4.2.01.05.01', 'Dana Desa', NULL, 213716344000.00, '2025-05-27 04:31:41', 2025),
('4.2.01.05.01.0001', 'Dana Desa', 1, 213716344000.00, '2025-05-27 04:31:41', 2025),
('4.2.01.06', 'Insentif Fiskal', NULL, 21355245000.00, '2025-05-27 04:31:41', 2025),
('4.2.01.06.02', 'Insentif Fiskal Untuk Penghargaan Kinerja Tahun Sebelumnya', NULL, 21355245000.00, '2025-05-27 04:31:41', 2025),
('4.2.01.06.02.0001', 'Insentif Fiskal Untuk Penghargaan Kinerja Tahun Sebelumnya', 1, 21355245000.00, '2025-05-27 04:31:41', 2025),
('4.2.01.07', 'Dana Bagi Hasil (DBH)', NULL, 57207768000.00, '2025-05-27 04:31:41', 2025),
('4.2.01.07.01', 'DBH Pajak', NULL, 54933081000.00, '2025-05-27 04:31:41', 2025),
('4.2.01.07.01.0001', 'DBH PBB', 1, 6553926000.00, '2025-05-27 04:31:41', 2025),
('4.2.01.07.01.0002', 'DBH PPh Pasal 21', 1, 25611546000.00, '2025-05-27 04:31:41', 2025),
('4.2.01.07.01.0003', 'DBH PPh Pasal 25 dan Pasal 29/WPOPDN', 1, 1397503000.00, '2025-05-27 04:31:41', 2025),
('4.2.01.07.01.0004', 'DBH Cukai Hasil Tembakau (CHT)', 1, 21370106000.00, '2025-05-27 04:31:41', 2025),
('4.2.01.07.02', 'DBH Sumber Daya Alam (SDA)', NULL, 2274687000.00, '2025-05-27 04:31:41', 2025),
('4.2.01.07.02.0002', 'DBH SDA Gas Bumi', 1, 41915000.00, '2025-05-27 04:31:41', 2025),
('4.2.01.07.02.0003', 'DBH SDA Pengusahaan Panas Bumi', 1, 4438000.00, '2025-05-27 04:31:41', 2025),
('4.2.01.07.02.0004', 'DBH SDA Mineral dan Batubara-Landrent', 1, 1014000.00, '2025-05-27 04:31:41', 2025),
('4.2.01.07.02.0007', 'DBH SDA Kehutanan-Iuran izin Usaha Pemanfaatan Hutan (IIUPH)', 1, 258542000.00, '2025-05-27 04:31:41', 2025),
('4.2.01.07.02.0009', 'DBH SDA Perikanan', 1, 1968778000.00, '2025-05-27 04:31:41', 2025),
('4.2.01.08', 'Dana Alokasi Umum (DAU)', NULL, 1097701269000.00, '2025-05-27 04:31:41', 2025),
('4.2.01.08.01', 'DAU yang Tidak Ditentukan Penggunaannya', NULL, 982597625000.00, '2025-05-27 04:31:41', 2025),
('4.2.01.08.01.0001', 'DAU', 1, 982597625000.00, '2025-05-27 04:31:41', 2025),
('4.2.01.08.02', 'DAU yang Ditentukan Penggunaannya', NULL, 115103644000.00, '2025-05-27 04:31:41', 2025),
('4.2.01.08.02.0001', 'DAU Tambahan Dukungan Pendanaan Kelurahan', 1, 2200000000.00, '2025-05-27 04:31:41', 2025),
('4.2.01.08.02.0003', 'DAU Tambahan Dukungan Pendanaan atas Kebijakan Penggajian Pegawai Pemerintah dengan Perjanjian Kerja', 1, 28621055000.00, '2025-05-27 04:31:41', 2025),
('4.2.01.08.02.0004', 'DAU yang Ditentukan Penggunaannya Bidang Pendidikan', 1, 36805087000.00, '2025-05-27 04:31:41', 2025),
('4.2.01.08.02.0005', 'DAU yang Ditentukan Penggunaannya Bidang Kesehatan', 1, 26375042000.00, '2025-05-27 04:31:41', 2025),
('4.2.01.08.02.0006', 'DAU yang Ditentukan Penggunaannya Bidang Pekerjaan Umum', 1, 21102460000.00, '2025-05-27 04:31:41', 2025),
('4.2.01.09', 'Dana Alokasi Khusus (DAK)', NULL, 417706942000.00, '2025-05-27 04:31:41', 2025),
('4.2.01.09.01', 'DAK Fisik', NULL, 17756660000.00, '2025-05-27 04:31:41', 2025),
('4.2.01.09.01.0001', 'DAK Fisik-Bidang Pendidikan-Reguler-PAUD', 1, 499957000.00, '2025-05-27 04:31:41', 2025),
('4.2.01.09.01.0002', 'DAK Fisik-Bidang Pendidikan-Reguler-SD', 1, 935675000.00, '2025-05-27 04:31:41', 2025),
('4.2.01.09.01.0003', 'DAK Fisik-Bidang Pendidikan-Reguler-SMP', 1, 228000000.00, '2025-05-27 04:31:41', 2025),
('4.2.01.09.01.0040', 'DAK Fisik-Bidang Sanitasi-Reguler', 1, 12491878000.00, '2025-05-27 04:31:41', 2025),
('4.2.01.09.01.0060', 'DAK Fisik-Bidang Kesehatan dan KB-Reguler-Penguatan Sistem Kesehatan', 1, 2078540000.00, '2025-05-27 04:31:41', 2025),
('4.2.01.09.01.0076', 'DAK Fisik-Bidang Kesehatan-Keluarga Berencana', 1, 1522610000.00, '2025-05-27 04:31:41', 2025),
('4.2.01.09.02', 'DAK Non Fisik', NULL, 399950282000.00, '2025-05-27 04:31:41', 2025),
('4.2.01.09.02.0001', 'DAK Non Fisik-BOS Reguler', 1, 116044160000.00, '2025-05-27 04:31:41', 2025),
('4.2.01.09.02.0003', 'DAK Non Fisik-BOS Kinerja', 1, 2780000000.00, '2025-05-27 04:31:41', 2025),
('4.2.01.09.02.0004', 'DAK Non Fisik-TPG PNSD', 1, 202292843000.00, '2025-05-27 04:31:41', 2025),
('4.2.01.09.02.0005', 'DAK Non Fisik-Tamsil Guru PNSD', 1, 1305500000.00, '2025-05-27 04:31:41', 2025),
('4.2.01.09.02.0006', 'DAK Non Fisik-TKG PNSD', 1, 1361122000.00, '2025-05-27 04:31:41', 2025),
('4.2.01.09.02.0009', 'DAK Non Fisik-BOP Museum dan Taman Budaya-Museum', 1, 702280000.00, '2025-05-27 04:31:41', 2025),
('4.2.01.09.02.0018', 'DAK Non Fisik-Dana Pelayanan Kepariwisataan', 1, 750000000.00, '2025-05-27 04:31:41', 2025),
('4.2.01.09.02.0028', 'DAK Non Fisik-Dana BOSP-BOP PAUD Reguler', 1, 27506076000.00, '2025-05-27 04:31:41', 2025),
('4.2.01.09.02.0029', 'DAK Non Fisik-Dana BOSP-BOP PAUD Kinerja', 1, 30000000.00, '2025-05-27 04:31:41', 2025),
('4.2.01.09.02.0030', 'DAK Non Fisik-Dana BOSP-BOP Kesetaraan Reguler', 1, 7943870000.00, '2025-05-27 04:31:41', 2025),
('4.2.01.09.02.0031', 'DAK Non Fisik-Dana BOSP-BOP Kesetaraan Kinerja', 1, 135000000.00, '2025-05-27 04:31:41', 2025),
('4.2.01.09.02.0033', 'DAK Non Fisik-Dana BOK-BOK Dinas-BOK Kabupaten/Kota', 1, 8734213000.00, '2025-05-27 04:31:41', 2025),
('4.2.01.09.02.0034', 'DAK Non Fisik-Dana BOK-BOK Dinas-BOK Pengawasan Obat dan Makanan', 1, 414553000.00, '2025-05-27 04:31:41', 2025),
('4.2.01.09.02.0035', 'DAK Non Fisik-Dana BOK-BOK Pkm', 1, 17720965000.00, '2025-05-27 04:31:41', 2025),
('4.2.01.09.02.0039', 'DAK Non Fisik-Bantuan Operasional Keluarga Berencana', 1, 12229700000.00, '2025-05-27 04:31:41', 2025),
('4.2.02', 'Pendapatan Transfer Antar Daerah', NULL, 114436471000.00, '2025-05-27 04:31:41', 2025),
('4.2.02.01', 'Pendapatan Bagi Hasil', NULL, 114436471000.00, '2025-05-27 04:31:41', 2025),
('4.2.02.01.01', 'Pendapatan Bagi Hasil Pajak', NULL, 114436471000.00, '2025-05-27 04:31:41', 2025),
('4.2.02.01.01.0003', 'Pendapatan Bagi Hasil Pajak Bahan Bakar Kendaraan Bermotor', 1, 51411874000.00, '2025-05-27 04:31:41', 2025),
('4.2.02.01.01.0004', 'Pendapatan Bagi Hasil Pajak Air Permukaan', 1, 24995000.00, '2025-05-27 04:31:41', 2025),
('4.2.02.01.01.0005', 'Pendapatan Bagi Hasil Pajak Rokok', 1, 62999602000.00, '2025-05-27 04:31:41', 2025);

-- --------------------------------------------------------

--
-- Struktur dari tabel `opd`
--

CREATE TABLE `opd` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `opd`
--

INSERT INTO `opd` (`id`, `nama`) VALUES
(1, 'BPKAD'),
(2, 'RSUD Kartini'),
(3, 'DKK'),
(4, 'DISHUB'),
(5, 'DISINDAG'),
(6, 'DLH'),
(7, 'DPUPR'),
(8, 'DISKAN'),
(9, 'DISPARBUD'),
(10, 'DKPP'),
(11, 'DISPERKIM'),
(12, 'DISKOP UKM'),
(13, 'DISKOMINFO');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pendapatan`
--

CREATE TABLE `pendapatan` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_users` int(11) DEFAULT NULL,
  `id_opd` int(11) UNSIGNED DEFAULT NULL,
  `master_pendapatan_kode` varchar(50) NOT NULL,
  `uraian` varchar(255) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `jumlah_pendapatan` decimal(20,2) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `no_bukti` varchar(100) DEFAULT NULL,
  `kategori` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pendapatan`
--

INSERT INTO `pendapatan` (`id`, `id_users`, `id_opd`, `master_pendapatan_kode`, `uraian`, `tanggal`, `jumlah_pendapatan`, `keterangan`, `created_at`, `no_bukti`, `kategori`) VALUES
(25, 6, NULL, '4.1.01.09.01', 'Pajak Reklame Papan/Billboard/Videotron/ Megatron', '2025-04-15', 143560000.00, 'Pembayaran pajak reklame dari...', '2025-04-30 04:41:46', 'INV-20250318-001', 'Bendahara'),
(33, 2, 0, '4.2.01.07.01.0001', 'DBH PBB', '1989-09-27', 456789000.00, 'Laudantium dolor qu', '2025-05-27 04:42:39', 'INV-20250318-001', 'Administrator'),
(40, 8, 3, '4.1.02.01.01.0006', 'Retribusi Pelayanan Kesehatan di Tempat Pelayanan Kesehatan Lainnya yang Sejenis', '1997-01-04', 1230000.00, 'Voluptas doloremque ', '2025-05-27 06:08:18', 'Ab ab in ut tempora ', 'DKK'),
(41, 11, 5, '4.1.02.01.05.0003', 'Retribusi Kios', '2021-07-03', 892000000.00, 'Sequi ex laborum qui', '2025-05-27 06:10:04', 'Minus libero assumen', 'DISINDAG'),
(42, 11, 5, '4.1.02.01.05.0003', 'Retribusi Kios', '2020-01-28', 456789000.00, 'Ullamco ut dolorem t', '2025-05-27 06:10:51', 'Rerum sunt illum in', 'DISINDAG'),
(43, 11, 5, '4.1.02.01.05', 'Retribusi Pelayanan Pasar', '1973-02-02', 15520000000.00, 'Qui at dolor reprehe', '2025-05-27 06:11:25', 'Rerum alias sit omn', 'DISINDAG'),
(44, 9, 13, '4.1.04.03.02.0001', 'Hasil Kerja Sama Pemanfaatan BMD', '2025-05-16', 10900000.00, 'asdfghjkl', '2025-05-27 06:13:17', 'INV-20250318-005', 'DISKOMINFO'),
(45, 10, 4, '4.1.02.01.04.0001', 'Retribusi Penyediaan Pelayanan Parkir di Tepi Jalan Umum', '1978-12-07', 7900000.00, 'Asperiores earum pro', '2025-05-27 06:17:18', 'Quo animi beatae es', 'DISHUB'),
(46, 10, 4, '4.1.02.02.12.0001', 'Retribusi Penyediaan Tempat Kegiatan Usaha berupa Pasar, Grosir, Pertokoan, dan Tempat Kegiatan Usaha Lainnya', '1984-03-25', 89200000.00, 'Non quod suscipit mo', '2025-05-27 06:18:12', 'Omnis quo sint enim ', 'DISHUB'),
(47, 10, 4, '4.1.02.01.04', 'Retribusi Pelayanan Parkir di Tepi Jalan Umum', '2018-10-24', 77500000.00, 'Fugiat et distinctio', '2025-05-27 06:18:28', 'Neque quisquam qui e', 'DISHUB'),
(48, 3, 0, '4.1.01.09.01', 'Pajak Reklame Papan/Billboard/Videotron/ Megatron', '2025-05-10', 52000000.00, 'ASDERFGTHJK', '2025-05-27 06:23:46', 'INV-20250318-003', 'BUD'),
(49, 3, 0, '4.1.02.01.01.0006', 'Retribusi Pelayanan Kesehatan di Tempat Pelayanan Kesehatan Lainnya yang Sejenis', '2025-05-08', 15510000.00, 'asdfghjkl', '2025-05-27 06:24:25', 'INV-20250318-002', 'BUD'),
(50, 3, 0, '4.1.02.01.05.0003', 'Retribusi Kios', '2025-01-01', 652000000.00, 'sdfghjkl', '2025-05-27 06:26:08', 'INV-20250318-003', 'BUD'),
(51, 6, 1, '4.1.01.19.01.0002', 'PBJT-Penyedia Jasa Boga atau Katering', '1971-07-14', 61000000.00, 'Alias consequuntur r', '2025-05-27 07:00:18', 'Magnam qui nihil nis', 'BPKAD'),
(58, 3, 1, '4.1.01.09.02', 'Pajak Reklame Kain', '2025-06-25', 341470000.00, 'Dana hibah', '2025-05-27 17:40:43', '123456754', 'BPKAD'),
(60, 11, 5, '4.1.04.01.03.0005', 'Hasil Penjualan Bangunan Gedung-Bangunan Gedung Tempat Kerja-Bangunan Gedung Kantor', '2023-05-10', 1056000.00, 'Et proident pariatu', '2025-05-28 00:25:07', 'Commodo minus vero d', 'DISINDAG'),
(61, 11, 5, '4.1.04.01.03.0005', 'Hasil Penjualan Bangunan Gedung-Bangunan Gedung Tempat Kerja-Bangunan Gedung Kantor', '2014-08-06', 134000000.00, 'Quasi in quo tempori', '2025-05-28 01:10:55', 'Sed nostrum molestia', 'DISINDAG'),
(62, 3, 1, '4.1.01.09.02', 'Pajak Reklame Kain', '2025-06-25', 341470000.00, 'Dana hibah', '2025-05-28 01:18:15', '123456754', 'BPKAD');

-- --------------------------------------------------------

--
-- Struktur dari tabel `realisasi`
--

CREATE TABLE `realisasi` (
  `id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `uraian` varchar(255) NOT NULL,
  `no_bukti` varchar(50) NOT NULL,
  `jumlah_realisasi` decimal(15,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `rekonsiliasi`
--

CREATE TABLE `rekonsiliasi` (
  `id` int(11) NOT NULL,
  `kode_rekening` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `jumlah` decimal(15,2) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('Administrator','Bendahara','PA/KPA','BUD') NOT NULL,
  `id_opd` int(11) DEFAULT NULL,
  `role_opd` varchar(100) DEFAULT NULL,
  `status_akun` enum('Aktif','Nonaktif') DEFAULT 'Aktif',
  `last_login` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `id_opd`, `role_opd`, `status_akun`, `last_login`, `created_at`, `updated_at`) VALUES
(2, 'admin', '$2y$10$2Ndb2RoEhiSmaesvtEl7IOY5R6Z18FX9I9nZOA9ud0fqQUKJP9FTW', 'Administrator', NULL, NULL, 'Aktif', '2025-05-28 01:20:04', '2025-03-10 06:52:43', '2025-05-27 18:20:04'),
(3, 'bud', '$2y$10$gVQpNR1RH98tW2XHVG9WJOOoUusp5rxSHTDZgUDLQNvot6axL3Pke', 'BUD', NULL, NULL, 'Aktif', '2025-05-28 01:16:23', '2025-05-27 04:33:10', '2025-05-27 18:16:23'),
(4, 'bendahara', '$2y$10$GiTU9r3sr1GdLcnPgmGWFuzd14AMslXYYEYRM2e2ck.sS.KDDJcb2', 'Bendahara', NULL, 'Bendahara', 'Aktif', NULL, '2025-05-27 04:33:10', NULL),
(5, 'pakpa', '$2y$10$XInYMEKOjASyjBBPABxIBeKhKhkarhzZij/Koh0DWcp.chvNNPkV2', 'PA/KPA', NULL, 'PAKPA', 'Aktif', '2025-05-28 00:38:56', '2025-05-27 04:33:10', '2025-05-27 17:38:56'),
(6, 'bpkad', '$2y$10$zTdWOCzhFqZTvbOQ8vPY.e7QR32F8NmKYq2hpQ13umIeWTS30zLXi', 'Bendahara', 1, 'BPKAD', 'Aktif', '2025-05-27 19:06:02', '2025-05-27 04:35:00', '2025-05-27 12:06:02'),
(7, 'rsudkartini', '$2y$10$AR9p4fwxrb/QA2nyLd7Z9O83TRFGqCpxFdeaY3xMXJsbyf5j5qchW', 'Bendahara', 2, 'RSUDKartini', 'Aktif', NULL, '2025-05-27 04:35:00', NULL),
(8, 'dkk', '$2y$10$P1F0ny./ncoFLxMOt8p1r.lQ8QOrm4zxh2fFa.hpvyEIHS1aqBWaS', 'Bendahara', 3, 'DKK', 'Aktif', '2025-05-27 17:30:58', '2025-05-27 04:35:00', '2025-05-27 10:30:58'),
(9, 'diskominfo', '$2y$10$tmpZhlQGzjO6Y6WwJMzy8e8ltH2r2eCdfwvL5JwcWPDFHq3gZXUqW', 'Bendahara', 13, 'DISKOMINFO', 'Aktif', '2025-05-28 00:39:20', '2025-05-27 04:35:00', '2025-05-27 17:39:20'),
(10, 'dishub', '$2y$10$sWgmSrkX/0W7NDHG08VP.uatOoZ4XKky2Kj8A8oLaydrdjxj/7llW', 'Bendahara', 4, 'DISHUB', 'Aktif', '2025-05-27 15:51:30', '2025-05-27 04:35:00', '2025-05-27 08:51:30'),
(11, 'disindag', '$2y$10$Uv9XQK9nnu5zSjNpP1IjYu7xtUfQ7gy6PCJhTgcBu435kgbDknYd.', 'Bendahara', 5, 'DISINDAG', 'Aktif', '2025-05-28 01:09:08', '2025-05-27 04:35:00', '2025-05-27 18:09:08'),
(12, 'dlh', '$2y$10$UP7id2mTf8nphfRQHuz9CuUbMxxnP8hNsASao5eeV8Fc3iZq/dg8e', 'Bendahara', 6, 'DLH', 'Aktif', '2025-05-27 06:21:30', '2025-05-27 04:35:00', '2025-05-26 23:21:30');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `master_pendapatan`
--
ALTER TABLE `master_pendapatan`
  ADD PRIMARY KEY (`kode`),
  ADD KEY `fk_id_opd` (`id_opd`);

--
-- Indeks untuk tabel `opd`
--
ALTER TABLE `opd`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pendapatan`
--
ALTER TABLE `pendapatan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `master_pendapatan_kode` (`master_pendapatan_kode`),
  ADD KEY `fk_pendapatan_user` (`id_users`);

--
-- Indeks untuk tabel `realisasi`
--
ALTER TABLE `realisasi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `rekonsiliasi`
--
ALTER TABLE `rekonsiliasi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `fk_users_opd` (`id_opd`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `opd`
--
ALTER TABLE `opd`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `pendapatan`
--
ALTER TABLE `pendapatan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT untuk tabel `realisasi`
--
ALTER TABLE `realisasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `rekonsiliasi`
--
ALTER TABLE `rekonsiliasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `master_pendapatan`
--
ALTER TABLE `master_pendapatan`
  ADD CONSTRAINT `fk_id_opd` FOREIGN KEY (`id_opd`) REFERENCES `opd` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_opd` FOREIGN KEY (`id_opd`) REFERENCES `opd` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
