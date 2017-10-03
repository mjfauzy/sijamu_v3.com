-- phpMyAdmin SQL Dump
-- version 4.5.0.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 15 Sep 2017 pada 08.00
-- Versi Server: 10.0.17-MariaDB
-- PHP Version: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_sijamu_v3`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_dokumen`
--

CREATE TABLE `tbl_dokumen` (
  `id` int(100) NOT NULL,
  `tgl_upload` varchar(30) NOT NULL,
  `kode_jenis` varchar(30) NOT NULL,
  `no_dokumen` varchar(30) NOT NULL,
  `judul_dokumen` varchar(225) NOT NULL,
  `keterangan_output` text NOT NULL,
  `tahun_prioritas` int(11) NOT NULL,
  `kode_org` varchar(30) NOT NULL,
  `status` enum('Draf','Telah Diperiksa','Telah Disahkan','Terkendali','Tergandakan','Telah Didistribusi','Tidak Berlaku','Telah Dihapus') NOT NULL,
  `file` varchar(100) NOT NULL,
  `file_type` varchar(100) NOT NULL,
  `file_size` int(11) NOT NULL,
  `id_user` varchar(30) NOT NULL,
  `last_edited` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_dokumen`
--

INSERT INTO `tbl_dokumen` (`id`, `tgl_upload`, `kode_jenis`, `no_dokumen`, `judul_dokumen`, `keterangan_output`, `tahun_prioritas`, `kode_org`, `status`, `file`, `file_type`, `file_size`, `id_user`, `last_edited`) VALUES
(1, '22-06-2017', 'SOP.02', 'SOP 001.002/KN 09 06/SBM', 'SOP Pengendalian Dokumen', 'Dokumen SOP Pengendalian Dokumen', 2015, 'SBM.5', 'Telah Didistribusi', '64842-93828-SOP 001 02 SMT PENGENDALIAN DOKUMEN.docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 360744, '11', '22-06-2017, 10:34:34'),
(2, '23-06-2017', 'SOP.02', 'SOP 002.02/KN 09 06/SBM', 'SOP Pengendalian Rekaman', 'Dokumen SOP Pengendalian Rekaman', 2015, 'SBM.5', 'Telah Diperiksa', '5664-54123-SOP 002.02 SMT PENGENDALIAN REKAMAN.docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 100245, '14', '14-07-2017, 09:41:17'),
(3, '14-07-2017', 'SOP.02', 'SOP 013.02/ KN 09 06/SBM', 'SOP Audit Internal', 'Dokumen SOP Audit Internal', 2011, 'SBM.5', 'Draf', '21278-Form Survey Kepuasan Mahasiswa.doc', 'application/msword', 158720, '14', '14-07-2017, 06:52:55'),
(4, '14-07-2017', 'SOP.02', 'SOP 021.03/KN 09 06/SBM', 'SOP PENGADAAN BARANG DAN JASA', 'Dokumen SOP PENGADAAN BARANG DAN JASA', 2015, 'SBM.5', 'Draf', '6770-SISTEM PENDUKUNG KEPUTUSAN PEMBERIAN BONUS BERDASARKAN PENILAIAN KINERJA GURU DENGAN METODE S.d', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 3643880, '14', '14-07-2017, 06:57:56'),
(5, '14-07-2017', 'SOP.02', 'SOP 010.002/KN 09 06/SBM', 'SOP Pengendalian Dokumen', 'Dokumen SOP', 2014, 'SBM.5', 'Draf', '36019-Form Survey Kepuasan Mahasiswa.doc', 'application/msword', 158720, '14', '14-07-2017, 07:00:41'),
(6, '14-07-2017', 'SOP.02', 'SOP 018.02/ KN 09 06/SBM', 'SOP Pengendalian Rekaman', 'Dokumen SOP Pengendalian Rekaman', 2015, 'SBM.5', 'Draf', '27212-Form Survey Kepuasan Mahasiswa.doc', 'application/msword', 158720, '14', '14-07-2017, 07:03:53');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_formulir`
--

CREATE TABLE `tbl_formulir` (
  `id` int(11) NOT NULL,
  `kode_formulir` varchar(30) NOT NULL,
  `nama_formulir` varchar(50) NOT NULL,
  `file` varchar(100) NOT NULL,
  `file_size` varchar(100) NOT NULL,
  `file_type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_formulir`
--

INSERT INTO `tbl_formulir` (`id`, `kode_formulir`, `nama_formulir`, `file`, `file_size`, `file_type`) VALUES
(2, 'FM-1', 'Formulir Bukti Penerimaan', '47119-1-SOP 000.03 SMT TEMPLATE.docx', '81703', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_jenis_dokumen`
--

CREATE TABLE `tbl_jenis_dokumen` (
  `kode_jenis` varchar(30) NOT NULL,
  `jenis_dokumen` varchar(50) NOT NULL,
  `keterangan` text NOT NULL,
  `disiapkan_oleh` varchar(50) NOT NULL,
  `diperiksa_oleh` varchar(50) NOT NULL,
  `disahkan_oleh` varchar(50) NOT NULL,
  `file` varchar(100) NOT NULL,
  `file_type` varchar(100) NOT NULL,
  `file_size` int(11) NOT NULL,
  `last_edited` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_jenis_dokumen`
--

INSERT INTO `tbl_jenis_dokumen` (`kode_jenis`, `jenis_dokumen`, `keterangan`, `disiapkan_oleh`, `diperiksa_oleh`, `disahkan_oleh`, `file`, `file_type`, `file_size`, `last_edited`) VALUES
('FM', 'Formulir', '', '', '', '', '37231-SOP 000.02 SMT TEMPLATE.docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 81703, '18-06-2017, 09:32:33'),
('PMT', 'Pedoman Sistem Manajemen Terintegrasi', '', '', '', '', '48246-SOP 000.02 SMT TEMPLATE.docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 81703, '18-06-2017, 09:33:02'),
('SOP.02', 'SOP Administratif', 'SOP yang berlaku di seluruh PSTBM', 'Eselon IV', 'Eselon III', 'Eselon II', '80347-SOP 000.02 SMT TEMPLATE.docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 81703, '18-06-2017, 09:33:14'),
('SOP.03', 'SOP Teknis', 'SOP yang berlaku di masing-masing bidang', 'Operator Alat,Staf|Bidang Tata Usaha', 'Penanggungjawab Alat,Eselon IV|Bidang Tata Usaha', 'Eselon III', '75649-SOP 000.02 SMT TEMPLATE.docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 81703, '18-06-2017, 09:33:26');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_organisasi`
--

CREATE TABLE `tbl_organisasi` (
  `id` int(11) NOT NULL,
  `kode_org` varchar(30) NOT NULL,
  `nama_org` text NOT NULL,
  `kode_salinan` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_organisasi`
--

INSERT INTO `tbl_organisasi` (`id`, `kode_org`, `nama_org`, `kode_salinan`) VALUES
(1, 'SBM.0', 'Pusat Sains dan Teknologi Bahan Maju', 'Copy 1'),
(2, 'SBM.1', 'Bagian Tata Usaha', 'Copy 2'),
(3, 'SBM.1.1', 'Sub Bag. PKDI', 'Copy 3'),
(4, 'SBM.1.3', 'Sub Bag. Keuangan', 'Copy 4'),
(5, 'SBM.1.2', 'Sub Bag. Perlengkapan', 'Copy 5'),
(6, 'SBM.2', 'Bidang Sains Bahan Maju', 'Copy 6'),
(7, 'SBM.3', 'Bidang Teknologi Berkas Neutron', 'Copy 7'),
(8, 'SBM.4', 'Bidang Keselamatan Kerja dan Keteknikan', 'Copy 8'),
(9, 'SBM.4.1', 'Sub Bid. KKPR', 'Copy 9'),
(10, 'SBM.4.2', 'Sub Bid. Keteknikan', 'Copy 10'),
(11, 'SBM.5', 'Unit Jaminan Mutu', 'MASTER');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pangkat_golongan`
--

CREATE TABLE `tbl_pangkat_golongan` (
  `id_pangkat` int(11) NOT NULL,
  `pangkat` varchar(30) NOT NULL,
  `golongan` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_pangkat_golongan`
--

INSERT INTO `tbl_pangkat_golongan` (`id_pangkat`, `pangkat`, `golongan`) VALUES
(1, 'Pembina Utama', 'IV/e'),
(2, 'Pembina Utama Madya', 'IV/d'),
(3, 'Pembina Utama Muda', 'IV/c'),
(4, 'Pembina Tingkat I', 'IV/b'),
(5, 'Pembina', 'IV/a'),
(6, 'Penata Tingkat I', 'III/d'),
(7, 'Penata', 'III/c'),
(8, 'Penata Muda Tingkat I', 'III/b'),
(9, 'Penata Muda', 'III/a'),
(10, 'Pengatur Tingkat I', 'II/d'),
(11, 'Pengatur', 'II/c'),
(12, 'Pengatur Muda Tingkat I', 'II/b'),
(13, 'Pengatur Muda', 'II/a'),
(14, 'Juru Tingkat I', 'I/d'),
(15, 'Juru', 'I/c'),
(16, 'Juru Muda Tingkat I', 'I/b'),
(17, 'Juru Muda', 'I/a');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_rek_autentikasi_dokumen`
--

CREATE TABLE `tbl_rek_autentikasi_dokumen` (
  `id_autentikasi` int(11) NOT NULL,
  `no_dokumen` varchar(50) NOT NULL,
  `disiapkan_oleh` text NOT NULL,
  `tanggal_disiapkan` varchar(50) NOT NULL,
  `disiapkan_oleh_2` text NOT NULL,
  `tanggal_disiapkan_2` varchar(50) NOT NULL,
  `diperiksa_oleh` text NOT NULL,
  `tanggal_diperiksa` varchar(50) NOT NULL,
  `diperiksa_oleh_2` text NOT NULL,
  `tanggal_diperiksa_2` varchar(50) NOT NULL,
  `disahkan_oleh` text NOT NULL,
  `tanggal_disahkan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_rek_autentikasi_dokumen`
--

INSERT INTO `tbl_rek_autentikasi_dokumen` (`id_autentikasi`, `no_dokumen`, `disiapkan_oleh`, `tanggal_disiapkan`, `disiapkan_oleh_2`, `tanggal_disiapkan_2`, `diperiksa_oleh`, `tanggal_diperiksa`, `diperiksa_oleh_2`, `tanggal_diperiksa_2`, `disahkan_oleh`, `tanggal_disahkan`) VALUES
(1, 'SOP 001.002/KN 09 06/SBM', '11', '22-06-2017', '', '', '2', '22-06-2017', '', '', '1', '22-06-2017'),
(2, 'SOP 002.02/KN 09 06/SBM', '14', '23-06-2017', '', '', '11', '14-07-2017', '', '', '', ''),
(3, 'SOP 013.02/ KN 09 06/SBM', '14', '14-07-2017', '', '', 'Kepala SBM.5', '', '', '', '', ''),
(4, 'SOP 021.03/KN 09 06/SBM', '14', '14-07-2017', '', '', 'Kepala SBM.1', '', 'Kepala SBM.5', '', '', ''),
(5, 'SOP 010.002/KN 09 06/SBM', '14', '14-07-2017', '', '', 'Kepala SBM.1', '', 'Kepala SBM.1.2', '', '', ''),
(6, 'SOP 018.02/ KN 09 06/SBM', '14', '14-07-2017', '', '', 'Kepala Bagian Tata Usaha', '', 'Kepala Unit Jaminan Mutu', '', '', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_rek_bukti`
--

CREATE TABLE `tbl_rek_bukti` (
  `id_bukti` int(11) NOT NULL,
  `kode_dokumen` varchar(30) NOT NULL,
  `jenis_bukti` enum('Penerimaan Salinan','Penarikan') NOT NULL,
  `tanggal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_rek_daftar_dokumen_dimusnahkan`
--

CREATE TABLE `tbl_rek_daftar_dokumen_dimusnahkan` (
  `id_daftar` int(11) NOT NULL,
  `kode_dokumen` varchar(30) NOT NULL,
  `diskripsi_dokumen` text NOT NULL,
  `tahun` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_rek_daftar_induk_dokumen`
--

CREATE TABLE `tbl_rek_daftar_induk_dokumen` (
  `id_daftar_induk` int(32) NOT NULL,
  `tanggal` varchar(30) NOT NULL,
  `no_dokumen` varchar(30) NOT NULL,
  `no_revisi` int(11) NOT NULL,
  `jumlah_salinan` int(11) NOT NULL,
  `keterangan` text NOT NULL,
  `status` varchar(30) NOT NULL,
  `jenis_dokumen` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_rek_daftar_induk_dokumen`
--

INSERT INTO `tbl_rek_daftar_induk_dokumen` (`id_daftar_induk`, `tanggal`, `no_dokumen`, `no_revisi`, `jumlah_salinan`, `keterangan`, `status`, `jenis_dokumen`) VALUES
(1, '22-06-2017', 'SOP 001.002/KN 09 06/SBM', 0, 1, 'Dokumen SOP Pengendalian Dokumen', 'Draf', 'SOP.02'),
(2, '23-06-2017', 'SOP 002.02/KN 09 06/SBM', 0, 1, 'Dokumen SOP Pengendalian Rekaman', 'Draf', 'SOP.02'),
(3, '14-07-2017', 'SOP 013.02/ KN 09 06/SBM', 0, 1, 'Dokumen SOP Audit Internal', 'Draf', 'SOP.02'),
(4, '14-07-2017', 'SOP 021.03/KN 09 06/SBM', 0, 1, 'Dokumen SOP PENGADAAN BARANG DAN JASA', 'Draf', 'SOP.02'),
(5, '14-07-2017', 'SOP 010.002/KN 09 06/SBM', 0, 1, 'Dokumen SOP', 'Draf', 'SOP.02'),
(6, '14-07-2017', 'SOP 018.02/ KN 09 06/SBM', 0, 1, 'Dokumen SOP Pengendalian Rekaman', 'Draf', 'SOP.02'),
(7, '14-07-2017, 09:41:17', 'SOP 002.02/KN 09 06/SBM', 0, 1, 'Dokumen Telah Diperiksa Oleh yang Berwenang', 'Telah Diperiksa', 'SOP.02');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_rek_file_distribusi`
--

CREATE TABLE `tbl_rek_file_distribusi` (
  `id_daftar_distribusi` int(11) NOT NULL,
  `id_dokumen` int(11) NOT NULL,
  `kode_org` varchar(30) NOT NULL,
  `kode_salinan` varchar(30) NOT NULL,
  `file` varchar(100) NOT NULL,
  `file_type` varchar(100) NOT NULL,
  `file_size` int(11) NOT NULL,
  `tanggal_upload` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_rek_file_distribusi`
--

INSERT INTO `tbl_rek_file_distribusi` (`id_daftar_distribusi`, `id_dokumen`, `kode_org`, `kode_salinan`, `file`, `file_type`, `file_size`, `tanggal_upload`) VALUES
(1, 1, 'SBM.0', 'Copy 1', 'COPY1-SOP 001 02 SMT PENGENDALIAN DOKUMEN.pdf', 'application/pdf', 349290, '22-06-2017, 10:59:30'),
(2, 1, 'SBM.5', 'MASTER', 'MASTER-SOP 001 02 SMT PENGENDALIAN DOKUMEN.pdf', 'application/pdf', 349627, '22-06-2017, 10:59:30');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_rek_usulan`
--

CREATE TABLE `tbl_rek_usulan` (
  `id_usulan` int(11) NOT NULL,
  `id_dokumen` int(11) NOT NULL,
  `jenis_usulan` enum('Amandemen','Pemusnahan') NOT NULL,
  `catatan` text NOT NULL,
  `pembuat_usulan` varchar(30) NOT NULL,
  `tanggal_upload` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jabatan` varchar(30) NOT NULL,
  `eselon` varchar(30) NOT NULL,
  `golongan` varchar(5) NOT NULL,
  `kode_org` varchar(30) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` enum('admin','user') NOT NULL,
  `last_login` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `nama`, `jabatan`, `eselon`, `golongan`, `kode_org`, `username`, `password`, `level`, `last_login`) VALUES
(1, 'Drs. Gunawan, M.Sc', 'Kepala', 'Eselon II', 'IV/c', 'SBM.0', '195708281983031004', '98d2bd4ace193c01650928de90bd6d6c', 'user', '07-07-2017, 10:50:58'),
(2, 'Aswan Edysyah Putra, S.IP.', 'Kepala', 'Eselon III', 'IV/b', 'SBM.1', '196610311990031001', '0a21f3e15f8c78a9c4e9df1a64cae6a1', 'user', '14-07-2017, 07:35:31'),
(3, 'Rd. Nenny Gunawati', 'Kepala', 'Eselon IV', 'III/d', 'SBM.1.1', '196511041986032004', '4c9257c2f1ae5bf58b207818d6f5cb3e', 'user', '20-06-2017, 08:59:31'),
(4, 'Agus Rachmadi, S.Sos.', 'Kepala', 'Eselon IV', 'III/d', 'SBM.1.3', '196512131986031002', '9b480127445811b8b24d286703054ca3', 'user', '20-06-2017, 08:40:49'),
(5, 'Enggay Sugaty, SE.', 'Kepala', 'Eselon IV', 'III/c', 'SBM.1.2', '196706031988032004', 'c22a617201a591ba94c605e51f811880', 'user', '20-06-2017, 08:59:57'),
(6, 'Dr. Eng. Iwan Sumirat', 'Kepala', 'Eselon III', 'III/d', 'SBM.3', '196704081997031003', '4492eefb6a056227c81686f89d3410ea', 'user', '20-06-2017, 08:46:30'),
(7, 'Dr. Ing. Arbi Dimyati', 'Kepala', 'Eselon III', 'III/d', 'SBM.2', '196903081988121001', '3cd642629ec0fcfa7e942666d4d119a3', 'user', '07-07-2017, 10:47:31'),
(8, 'Sairun, ST.', 'Kepala', 'Eselon III', 'III/d', 'SBM.4', '196609271986021001', 'f065247257b8d4064e2469e2e5cdc6ac', 'user', '19-06-2017, 15:48:14'),
(9, 'Subur Zanuar, A.Md.', 'Kepala', 'Eselon IV', 'III/d', 'SBM.4.1', '196501011986031008', 'c73237c8acbcda52b199dacb6a191b41', 'user', '19-06-2017, 07:51:11'),
(10, 'Agus Sunardi, SST.', 'Kepala', 'Eselon IV', 'III/c', 'SBM.4.2', '197008121990021002', '9f704821b80a6987e00cbec7f58d2261', 'user', '07-07-2017, 10:54:08'),
(11, 'Irfan Hafid, A.Md.', 'Kepala', 'Eselon IV', 'III/c', 'SBM.5', '197010181991121001', '128a97ca14c90e9d80c80f56bc8beb7b', 'admin', '14-07-2017, 09:38:34'),
(14, 'Administrator', 'Staf', '-', 'I/a', 'SBM.5', 'admin', '0192023a7bbd73250516f069df18b500', 'admin', '16-07-2017, 15:00:15'),
(15, 'Mj Fauzy', 'Staf', '-', 'I/c', 'SBM.1.2', 'mjfauzy', '827ccb0eea8a706c4c34a16891f84e7b', 'user', '07-07-2017, 10:47:53'),
(16, 'Mr Fauzan', 'Operator Alat', '-', 'I/a', 'SBM.2', 'mrfauzan', '674e1f68029ea8563bfcbc7226117fa7', 'user', '19-06-2017, 08:34:45'),
(17, 'Aa Ramadhan', 'Penanggungjawab Alat', '-', 'II/c', 'SBM.2', 'aaramadhan', 'f35ca1e29957b1581e8cf9d62884de63', 'user', '19-06-2017, 14:50:46'),
(18, 'Bu Rina', 'Staf', '-', 'III/c', 'SBM.5', '12345678', '25d55ad283aa400af464c76d713c07ad', 'admin', '23-06-2017, 17:42:20'),
(19, 'Budi', 'Operator Alat', '-', 'II/c', 'SBM.4.2', 'budi', '9c5fa085ce256c7c598f6710584ab25d', 'user', '17-06-2017, 08:04:20'),
(20, 'Ani', 'Penanggungjawab Alat', '-', 'III/b', 'SBM.4.2', 'ani', 'a6c45362cf65dee14014c5396509ba22', 'user', '17-06-2017, 08:03:48'),
(21, 'Dani', 'Operator Alat', '-', 'II/c', 'SBM.4.1', 'dani', '8fc828b696ba1cd92eab8d0a6ffb17d6', 'user', '17-06-2017, 07:57:46'),
(22, 'Ahmad', 'Penanggungjawab Alat', '-', 'III/d', 'SBM.4.1', 'ahmad', '8de13959395270bf9d6819f818ab1a00', 'user', '19-06-2017, 09:01:41'),
(23, 'Joni', 'Staf', '-', 'III/d', 'SBM.1.3', 'joni', '1c0ac25b077a885dc53d91b05b14544e', 'user', '17-06-2017, 08:09:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_dokumen`
--
ALTER TABLE `tbl_dokumen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_formulir`
--
ALTER TABLE `tbl_formulir`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_jenis_dokumen`
--
ALTER TABLE `tbl_jenis_dokumen`
  ADD PRIMARY KEY (`kode_jenis`);

--
-- Indexes for table `tbl_organisasi`
--
ALTER TABLE `tbl_organisasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_pangkat_golongan`
--
ALTER TABLE `tbl_pangkat_golongan`
  ADD PRIMARY KEY (`id_pangkat`);

--
-- Indexes for table `tbl_rek_autentikasi_dokumen`
--
ALTER TABLE `tbl_rek_autentikasi_dokumen`
  ADD PRIMARY KEY (`id_autentikasi`);

--
-- Indexes for table `tbl_rek_bukti`
--
ALTER TABLE `tbl_rek_bukti`
  ADD PRIMARY KEY (`id_bukti`);

--
-- Indexes for table `tbl_rek_daftar_dokumen_dimusnahkan`
--
ALTER TABLE `tbl_rek_daftar_dokumen_dimusnahkan`
  ADD PRIMARY KEY (`id_daftar`);

--
-- Indexes for table `tbl_rek_daftar_induk_dokumen`
--
ALTER TABLE `tbl_rek_daftar_induk_dokumen`
  ADD PRIMARY KEY (`id_daftar_induk`);

--
-- Indexes for table `tbl_rek_file_distribusi`
--
ALTER TABLE `tbl_rek_file_distribusi`
  ADD PRIMARY KEY (`id_daftar_distribusi`);

--
-- Indexes for table `tbl_rek_usulan`
--
ALTER TABLE `tbl_rek_usulan`
  ADD PRIMARY KEY (`id_usulan`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_dokumen`
--
ALTER TABLE `tbl_dokumen`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tbl_formulir`
--
ALTER TABLE `tbl_formulir`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_organisasi`
--
ALTER TABLE `tbl_organisasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `tbl_pangkat_golongan`
--
ALTER TABLE `tbl_pangkat_golongan`
  MODIFY `id_pangkat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `tbl_rek_autentikasi_dokumen`
--
ALTER TABLE `tbl_rek_autentikasi_dokumen`
  MODIFY `id_autentikasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tbl_rek_bukti`
--
ALTER TABLE `tbl_rek_bukti`
  MODIFY `id_bukti` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_rek_daftar_dokumen_dimusnahkan`
--
ALTER TABLE `tbl_rek_daftar_dokumen_dimusnahkan`
  MODIFY `id_daftar` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_rek_daftar_induk_dokumen`
--
ALTER TABLE `tbl_rek_daftar_induk_dokumen`
  MODIFY `id_daftar_induk` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tbl_rek_file_distribusi`
--
ALTER TABLE `tbl_rek_file_distribusi`
  MODIFY `id_daftar_distribusi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_rek_usulan`
--
ALTER TABLE `tbl_rek_usulan`
  MODIFY `id_usulan` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
