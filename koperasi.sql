-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 15 Feb 2019 pada 19.10
-- Versi Server: 5.7.25-0ubuntu0.18.04.2
-- PHP Version: 7.2.15-1+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `koperasi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `anggota`
--

CREATE TABLE `anggota` (
  `id_anggota` varchar(10) NOT NULL,
  `id_unit_kerja` varchar(10) NOT NULL,
  `npp` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `tempat` varchar(50) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jenis_kelamin` varchar(1) NOT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `tgl_jadi_anggota` date NOT NULL,
  `gambar` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `anggota`
--

INSERT INTO `anggota` (`id_anggota`, `id_unit_kerja`, `npp`, `nama`, `tempat`, `tgl_lahir`, `jenis_kelamin`, `alamat`, `tgl_jadi_anggota`, `gambar`) VALUES
('AG001', 'UK004', 55649, 'Muhammad Melkan', 'Tuban', '1998-03-15', 'L', 'Ds. Pliwetan Kec. Palang Kab. Tuban', '2018-06-16', '5b2ddd9f692cc.jpg'),
('AG002', 'UK005', 12344, 'Agus Prasetyo', 'Tuban', '1998-08-13', 'L', 'Ds. Gesikharjo Kec. Palang Kab. Tuban', '2018-06-16', '5b25c5bc8f25c.jpg'),
('AG003', 'UK001', 23642, 'Eko Prastiyo', 'Tuban', '1945-01-01', 'L', 'Ds. Sugiharjo Kec. Tuban Kab. Tuban', '2018-06-16', '5b25d28ae61e4.jpg'),
('AG004', 'UK003', 87871, 'Adhi Setyo Wibisono', 'Tuban', '2000-02-22', 'L', 'Ds. Pliwetan Kec. Palang Kab. Tuban', '2018-06-16', '5b260cb6acdbe.jpg'),
('AG005', 'UK002', 46723, 'Abdul Kohar', 'Tuban', '1999-12-03', 'L', 'Ds. Sumurgung Kec. Tuban Kab. Tuban', '2018-06-17', '5b25b97d248b3.jpg'),
('AG006', 'UK002', 21312, 'Andana Widanda', 'Malang', '1998-04-20', 'L', 'Ds. Tunah Kec. Semanding Kab. Tuban', '2018-06-17', '5b260cfcaf67e.jpg'),
('AG007', 'UK002', 32523, 'Anwar Adi Setiyono', 'Tuban', '1996-02-22', 'L', 'Kel. Latsari Kec. Tuban Kab. Tuban', '2018-06-22', '5b2ca6694a91a.jpg'),
('AG008', 'UK005', 53252, 'Arif Budi Kusuma', 'Tuban', '1999-01-30', 'L', 'Ds. Bejagung Kec. Semanding Kab. Tuban', '2018-06-22', '5b2ca6e6e442b.jpg'),
('AG009', 'UK006', 42141, 'Juliant Perdana', 'Tuban', '1998-07-03', 'L', 'Ds. Gesikharjo Kec. Palang Kab. Tuban', '2018-06-23', '5b2ddecaa8a98.jpg'),
('AG010', 'UK006', 21343, 'Faisal Aditya', 'Tuban', '1998-11-13', 'L', 'Ds. Palang', '2018-06-26', '5b363050876e0.jpg'),
('AG011', 'UK004', 31412, 'Wahyu Aprilian', 'Tuban', '2000-11-03', 'L', 'Ds. Palang', '2018-07-02', '5b3a3e2e022f6.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `id_barang` varchar(10) NOT NULL,
  `id_jenis_barang` varchar(10) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `harga_beli` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `keterangan_stok` varchar(10) NOT NULL,
  `gambar` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`id_barang`, `id_jenis_barang`, `nama_barang`, `harga_beli`, `harga_jual`, `stok`, `keterangan_stok`, `gambar`) VALUES
('BR001', 'JB001', 'Sabun Lifebuoy', 2500, 3000, 15, 'Buah', '5b362d2f03bc7.jpg'),
('BR002', 'JB001', 'Sabun Lux', 2000, 2400, 16, 'Buah', '5b362d402791c.jpg'),
('BR003', 'JB002', 'Shampoo Lifebuoy (Sachet)', 500, 600, 8, 'Sachet', '5b362e0255477.jpg'),
('BR004', 'JB002', 'Shampo Head and Sholders', 10000, 12000, 6, 'Buah', '5b362e1bc980b.jpg'),
('BR005', 'JB001', 'Sabun Kodok', 2000, 2400, 8, 'Buah', '5b362e2e91258.jpg'),
('BR006', 'JB003', 'Pepsodent', 8000, 9600, 2, 'Buah', '5b362e3c7074c.jpg'),
('BR007', 'JB004', 'Beras', 10000, 12000, 8, 'Kilo', '5b362e4902881.jpg'),
('BR008', 'JB004', 'Gulaku Premium', 10000, 12000, 16, 'Kilo', '5b362e5b54220.jpg'),
('BR009', 'JB004', 'Minyak Goreng', 12000, 14400, 25, 'Liter', '5b362ea53b3b7.jpg'),
('BR010', 'JB003', 'Ciptadent', 5000, 6000, 19, 'Buah', '5b362eb971d97.jpg'),
('BR011', 'JB001', 'Sabun Dettol', 5000, 6000, 11, 'Buah', '5b362ee57bf53.png'),
('BR012', 'JB002', 'Sampoo Lifebuoy (Botolan)', 3500, 4200, 20, 'Botol', '5b362f2304588.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `bayar_kredit`
--

CREATE TABLE `bayar_kredit` (
  `id_byrkredit` int(11) NOT NULL,
  `id_kredit` varchar(10) NOT NULL,
  `id_anggota` varchar(10) NOT NULL,
  `id_user` varchar(10) NOT NULL,
  `tgl_bayar` date NOT NULL,
  `jml_kredit` int(11) NOT NULL,
  `jml_angsur` int(11) NOT NULL,
  `jml_bayar` int(11) NOT NULL,
  `sisa_kredit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `bayar_langsung`
--

CREATE TABLE `bayar_langsung` (
  `id_langsung` varchar(10) NOT NULL,
  `id_anggota` varchar(10) NOT NULL,
  `id_jual_anggota` varchar(10) NOT NULL,
  `total` int(11) NOT NULL,
  `bayar` int(11) NOT NULL,
  `kembali` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detil_jual_anggota`
--

CREATE TABLE `detil_jual_anggota` (
  `id_detil_anggota` int(11) NOT NULL,
  `id_barang` varchar(10) NOT NULL,
  `id_jual_anggota` varchar(10) NOT NULL,
  `id_anggota` varchar(10) NOT NULL,
  `id_user` varchar(10) NOT NULL,
  `harga` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `sub_total` int(11) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `detil_jual_anggota`
--

INSERT INTO `detil_jual_anggota` (`id_detil_anggota`, `id_barang`, `id_jual_anggota`, `id_anggota`, `id_user`, `harga`, `jumlah`, `sub_total`, `status`) VALUES
(1, 'BR003', 'JA002', 'AG002', 'US001', 600, 1, 600, 1),
(2, 'BR001', 'JA002', 'AG002', 'US001', 3000, 1, 3000, 1),
(3, 'BR004', 'JA002', 'AG002', 'US001', 12000, 1, 12000, 1),
(5, 'BR006', 'JA001', 'AG004', 'US001', 9600, 1, 9600, 1),
(6, 'BR008', 'JA002', 'AG002', 'US001', 12000, 2, 24000, 1),
(7, 'BR001', '0', 'AG005', 'US001', 3000, 1, 3000, 0),
(9, 'BR003', 'JA003', 'AG003', 'US001', 600, 1, 600, 1),
(10, 'BR003', 'JA004', 'AG003', 'US001', 600, 1, 600, 1),
(13, 'BR004', '0', 'AG007', 'US001', 12000, 1, 12000, 0),
(14, 'BR002', '0', 'AG002', 'US001', 2400, 1, 2400, 0),
(15, 'BR001', '0', 'AG002', 'US001', 3000, 2, 6000, 0),
(16, 'BR004', '0', 'AG002', 'US001', 12000, 1, 12000, 0),
(20, 'BR009', 'JA005', 'AG002', 'US001', 14400, 1, 14400, 2),
(21, 'BR009', 'JA006', 'AG002', 'US001', 14400, 2, 28800, 2),
(22, 'BR001', 'JA007', 'AG002', 'US001', 3000, 2, 6000, 2),
(24, 'BR011', 'JA008', 'AG002', 'US001', 6000, 1, 6000, 2),
(25, 'BR003', 'JA009', 'AG003', 'US001', 600, 1, 600, 2),
(26, 'BR004', 'JA010', 'AG003', 'US001', 12000, 1, 12000, 2),
(27, 'BR002', 'JA011', 'AG003', 'US001', 2400, 1, 2400, 2),
(28, 'BR002', 'JA013', 'AG003', 'US001', 2400, 1, 2400, 2),
(30, 'BR007', 'JA013', 'AG003', 'US001', 12000, 1, 12000, 2),
(34, 'BR001', '0', 'AG001', 'US001', 3000, 1, 0, 0),
(35, 'BR001', 'JA012', 'AG009', 'US001', 3000, 1, 3000, 2),
(36, 'BR004', 'JA012', 'AG009', 'US001', 12000, 1, 12000, 2),
(37, 'BR008', 'JA013', 'AG003', 'US001', 12000, 1, 12000, 2),
(38, 'BR001', '0', 'AG007', 'US001', 3000, 1, 3000, 0),
(44, 'BR009', 'JA013', 'AG003', 'US001', 14400, 1, 14400, 2),
(45, 'BR001', 'JA014', 'AG003', 'US001', 3000, 1, 3000, 2),
(46, 'BR002', 'JA014', 'AG003', 'US001', 2400, 1, 2400, 2),
(47, 'BR011', 'JA014', 'AG003', 'US001', 6000, 1, 6000, 2),
(48, 'BR009', 'JA014', 'AG003', 'US001', 14400, 1, 14400, 2),
(49, 'BR008', 'JA014', 'AG003', 'US001', 12000, 1, 12000, 2),
(50, 'BR001', '0', 'AG003', 'US001', 3000, 1, 3000, 0),
(51, 'BR002', '0', 'AG003', 'US001', 2400, 1, 2400, 0),
(52, 'BR005', '0', 'AG003', 'US001', 2400, 1, 2400, 0),
(53, 'BR009', '0', 'AG003', 'US001', 14400, 1, 14400, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `detil_jual_umum`
--

CREATE TABLE `detil_jual_umum` (
  `id_detil_umum` int(11) NOT NULL,
  `id_barang` varchar(10) NOT NULL,
  `id_jual_umum` varchar(10) NOT NULL,
  `id_user` varchar(10) NOT NULL,
  `harga` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `sub_total` int(11) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `detil_jual_umum`
--

INSERT INTO `detil_jual_umum` (`id_detil_umum`, `id_barang`, `id_jual_umum`, `id_user`, `harga`, `jumlah`, `sub_total`, `status`) VALUES
(1, 'BR003', 'JU001', 'US001', 600, 4, 600, 1),
(2, 'BR002', 'JU002', 'US001', 2400, 1, 7200, 1),
(8, 'BR003', 'JU003', 'US001', 9000, 1, 600, 1),
(10, 'BR004', 'JU003', 'US001', 12000, 1, 12000, 1),
(11, 'BR006', 'JU003', 'US001', 9600, 1, 9600, 1),
(12, 'BR007', 'JU003', 'US001', 12000, 1, 12000, 1),
(25, 'BR005', 'JU005', 'US001', 2400, 2, 4800, 1),
(26, 'BR006', 'JU005', 'US001', 9600, 1, 9600, 1),
(27, 'BR002', 'JU006', 'US001', 2400, 1, 2400, 1),
(29, 'BR004', 'JU006', 'US001', 12000, 1, 12000, 1),
(30, 'BR004', 'JU007', 'US001', 12000, 2, 24000, 1),
(39, 'BR003', 'JU008', 'US001', 600, 1, 600, 1),
(40, 'BR010', 'JU008', 'US001', 6000, 1, 6000, 1),
(41, 'BR009', 'JU008', 'US001', 14400, 1, 14400, 1),
(42, 'BR003', 'JU009', 'US001', 600, 2, 1200, 0),
(43, 'BR007', '0', 'US001', 12000, 1, 12000, 0),
(44, 'BR005', '0', 'US001', 2400, 1, 2400, 0),
(45, 'BR001', '0', 'US001', 3000, 1, 3000, 0),
(48, 'BR006', '0', 'US001', 9600, 1, 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `gaji`
--

CREATE TABLE `gaji` (
  `id_gaji` int(11) NOT NULL,
  `id_anggota` varchar(10) NOT NULL,
  `id_jual_anggota` varchar(10) NOT NULL,
  `potongan` int(11) NOT NULL,
  `gaji_bersih` int(11) NOT NULL,
  `tgl_potong` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `gaji`
--

INSERT INTO `gaji` (`id_gaji`, `id_anggota`, `id_jual_anggota`, `potongan`, `gaji_bersih`, `tgl_potong`) VALUES
(1, 'AG002', 'JA005', 14400, 500, '2018-06-30'),
(2, 'AG002', 'JA006', 28800, 500, '2018-06-30'),
(3, 'AG002', 'JA007', 6000, 100, '2018-06-30'),
(5, 'AG003', 'JA009', 600, 1199400, '2018-06-30'),
(6, 'AG003', 'JA010', 12000, 1188000, '2018-07-01'),
(7, 'AG003', 'JA011', 2400, 1185600, '2018-07-01'),
(8, 'AG009', 'JA012', 15000, 1485000, '2018-07-01'),
(9, 'AG003', 'JA014', 37800, 1162200, '2019-02-05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_barang`
--

CREATE TABLE `jenis_barang` (
  `id_jenis_barang` varchar(10) NOT NULL,
  `jenis` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jenis_barang`
--

INSERT INTO `jenis_barang` (`id_jenis_barang`, `jenis`) VALUES
('JB001', 'Sabun'),
('JB002', 'Shampo'),
('JB003', 'Pasta gigi'),
('JB004', 'Bahan Pokok'),
('JB005', 'Sayur Sayuran');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jual_anggota`
--

CREATE TABLE `jual_anggota` (
  `id_jual_anggota` varchar(10) NOT NULL,
  `tgl_transaksi` date NOT NULL,
  `total_transaksi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jual_anggota`
--

INSERT INTO `jual_anggota` (`id_jual_anggota`, `tgl_transaksi`, `total_transaksi`) VALUES
('JA001', '2018-06-23', 9600),
('JA002', '2018-06-23', 39600),
('JA003', '2018-06-25', 600),
('JA004', '2018-06-25', 600),
('JA005', '2018-06-30', 14400),
('JA006', '2018-06-30', 28800),
('JA007', '2018-06-30', 6000),
('JA008', '2018-06-30', 6000),
('JA009', '2018-06-30', 600),
('JA010', '2018-07-01', 12000),
('JA011', '2018-07-01', 2400),
('JA012', '2018-07-01', 15000),
('JA013', '2019-02-05', 40800),
('JA014', '2019-02-05', 37800);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jual_umum`
--

CREATE TABLE `jual_umum` (
  `id_jual_umum` varchar(10) NOT NULL,
  `tgl_transaksi` date NOT NULL,
  `total_transaksi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jual_umum`
--

INSERT INTO `jual_umum` (`id_jual_umum`, `tgl_transaksi`, `total_transaksi`) VALUES
('JU001', '2018-06-19', 600),
('JU002', '2018-06-19', 7200),
('JU003', '2018-06-22', 34200),
('JU004', '2018-06-29', 3000),
('JU005', '2018-06-29', 14400),
('JU006', '2018-07-08', 14400),
('JU007', '2018-07-08', 24000),
('JU008', '2018-07-08', 21000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kredit`
--

CREATE TABLE `kredit` (
  `id_kredit` varchar(10) NOT NULL,
  `id_anggota` varchar(10) NOT NULL,
  `id_user` varchar(10) NOT NULL,
  `tgl_kredit` date NOT NULL,
  `jml_kredit` int(11) NOT NULL,
  `kali_angsur` int(11) NOT NULL,
  `jml_angsur` int(11) NOT NULL,
  `bunga` varchar(5) NOT NULL,
  `total_angsur` int(11) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `unit_kerja`
--

CREATE TABLE `unit_kerja` (
  `id_unit_kerja` varchar(10) NOT NULL,
  `unit_kerja` varchar(30) NOT NULL,
  `gaji_pokok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `unit_kerja`
--

INSERT INTO `unit_kerja` (`id_unit_kerja`, `unit_kerja`, `gaji_pokok`) VALUES
('UK001', 'Gudang', 1200000),
('UK002', 'Keuangan', 1500000),
('UK003', 'Keamanan', 1200000),
('UK004', 'Kebersihan', 1200000),
('UK005', 'Administrasi', 1500000),
('UK006', 'Teknisi', 1500000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` varchar(10) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(256) NOT NULL,
  `akses` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `nama`, `username`, `password`, `akses`) VALUES
('US001', 'Bos Koperasi', 'admin', '$2y$10$Z1Ll2b31/xrZYqUNQbCV/u1qt.9FbAYRb2IZPMDcn0fbKJ6QpIfdK', 1),
('US002', 'Sumanto', 'manto', '$2y$10$rxJVLcikA6Y4iC3vyHf0u.NA6j2tDdz0YPWamQmgMKLmkFaiOvXQm', 2),
('US003', 'Pakde Sudjarwo', 'pakde', '$2y$10$Q4TLztqBODSWtzL9k4zC/.VdYvFYIqbdyRmCmxLA1op9DKHmJfPpS', 3),
('US004', 'Ahmad Wahyudi', 'ahmad', '$2y$10$pbGANLTnvEP/MpaXylTX4Otuheuy8JWu.5GyfzPxP5qIDuQaos1WC', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`id_anggota`),
  ADD KEY `anggota_unit` (`id_unit_kerja`);

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`),
  ADD KEY `barang_jenis` (`id_jenis_barang`);

--
-- Indexes for table `bayar_kredit`
--
ALTER TABLE `bayar_kredit`
  ADD PRIMARY KEY (`id_byrkredit`,`id_kredit`,`id_anggota`),
  ADD KEY `bayarkredit_anggota` (`id_anggota`),
  ADD KEY `bayarkredit_kredit` (`id_kredit`),
  ADD KEY `bayarkredit_user` (`id_user`);

--
-- Indexes for table `bayar_langsung`
--
ALTER TABLE `bayar_langsung`
  ADD PRIMARY KEY (`id_langsung`,`id_anggota`),
  ADD KEY `langsung_anggota` (`id_anggota`),
  ADD KEY `langsung_jual_anggota` (`id_jual_anggota`);

--
-- Indexes for table `detil_jual_anggota`
--
ALTER TABLE `detil_jual_anggota`
  ADD PRIMARY KEY (`id_detil_anggota`,`id_barang`,`id_jual_anggota`),
  ADD KEY `detilanggota_barang` (`id_barang`),
  ADD KEY `detilanggota_jual` (`id_jual_anggota`),
  ADD KEY `detilanggota_user` (`id_user`),
  ADD KEY `detilanggota_anggota` (`id_anggota`);

--
-- Indexes for table `detil_jual_umum`
--
ALTER TABLE `detil_jual_umum`
  ADD PRIMARY KEY (`id_detil_umum`,`id_barang`,`id_jual_umum`),
  ADD KEY `detilumum_barang` (`id_barang`),
  ADD KEY `detilumum_jual` (`id_jual_umum`),
  ADD KEY `detilumum_user` (`id_user`);

--
-- Indexes for table `gaji`
--
ALTER TABLE `gaji`
  ADD PRIMARY KEY (`id_gaji`),
  ADD KEY `gaji_anggota` (`id_anggota`),
  ADD KEY `gaji_jual` (`id_jual_anggota`);

--
-- Indexes for table `jenis_barang`
--
ALTER TABLE `jenis_barang`
  ADD PRIMARY KEY (`id_jenis_barang`);

--
-- Indexes for table `jual_anggota`
--
ALTER TABLE `jual_anggota`
  ADD PRIMARY KEY (`id_jual_anggota`);

--
-- Indexes for table `jual_umum`
--
ALTER TABLE `jual_umum`
  ADD PRIMARY KEY (`id_jual_umum`);

--
-- Indexes for table `kredit`
--
ALTER TABLE `kredit`
  ADD PRIMARY KEY (`id_kredit`),
  ADD KEY `kredit_anggota` (`id_anggota`),
  ADD KEY `kredit_user` (`id_user`);

--
-- Indexes for table `unit_kerja`
--
ALTER TABLE `unit_kerja`
  ADD PRIMARY KEY (`id_unit_kerja`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bayar_kredit`
--
ALTER TABLE `bayar_kredit`
  MODIFY `id_byrkredit` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `detil_jual_anggota`
--
ALTER TABLE `detil_jual_anggota`
  MODIFY `id_detil_anggota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
--
-- AUTO_INCREMENT for table `detil_jual_umum`
--
ALTER TABLE `detil_jual_umum`
  MODIFY `id_detil_umum` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT for table `gaji`
--
ALTER TABLE `gaji`
  MODIFY `id_gaji` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `anggota`
--
ALTER TABLE `anggota`
  ADD CONSTRAINT `anggota_unit` FOREIGN KEY (`id_unit_kerja`) REFERENCES `unit_kerja` (`id_unit_kerja`);

--
-- Ketidakleluasaan untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_jenis` FOREIGN KEY (`id_jenis_barang`) REFERENCES `jenis_barang` (`id_jenis_barang`);

--
-- Ketidakleluasaan untuk tabel `bayar_kredit`
--
ALTER TABLE `bayar_kredit`
  ADD CONSTRAINT `bayarkredit_anggota` FOREIGN KEY (`id_anggota`) REFERENCES `anggota` (`id_anggota`),
  ADD CONSTRAINT `bayarkredit_kredit` FOREIGN KEY (`id_kredit`) REFERENCES `kredit` (`id_kredit`),
  ADD CONSTRAINT `bayarkredit_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Ketidakleluasaan untuk tabel `bayar_langsung`
--
ALTER TABLE `bayar_langsung`
  ADD CONSTRAINT `langsung_anggota` FOREIGN KEY (`id_anggota`) REFERENCES `anggota` (`id_anggota`),
  ADD CONSTRAINT `langsung_jual_anggota` FOREIGN KEY (`id_jual_anggota`) REFERENCES `jual_anggota` (`id_jual_anggota`);

--
-- Ketidakleluasaan untuk tabel `detil_jual_anggota`
--
ALTER TABLE `detil_jual_anggota`
  ADD CONSTRAINT `detilanggota_anggota` FOREIGN KEY (`id_anggota`) REFERENCES `anggota` (`id_anggota`),
  ADD CONSTRAINT `detilanggota_barang` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`),
  ADD CONSTRAINT `detilanggota_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Ketidakleluasaan untuk tabel `detil_jual_umum`
--
ALTER TABLE `detil_jual_umum`
  ADD CONSTRAINT `detilumum_barang` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`),
  ADD CONSTRAINT `detilumum_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Ketidakleluasaan untuk tabel `gaji`
--
ALTER TABLE `gaji`
  ADD CONSTRAINT `gaji_anggota` FOREIGN KEY (`id_anggota`) REFERENCES `anggota` (`id_anggota`),
  ADD CONSTRAINT `gaji_jual` FOREIGN KEY (`id_jual_anggota`) REFERENCES `jual_anggota` (`id_jual_anggota`);

--
-- Ketidakleluasaan untuk tabel `kredit`
--
ALTER TABLE `kredit`
  ADD CONSTRAINT `kredit_anggota` FOREIGN KEY (`id_anggota`) REFERENCES `anggota` (`id_anggota`),
  ADD CONSTRAINT `kredit_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
