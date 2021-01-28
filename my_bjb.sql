-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 28 Jan 2021 pada 10.44
-- Versi server: 10.4.17-MariaDB
-- Versi PHP: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `my_bjb`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `id_departemen`
--

CREATE TABLE `id_departemen` (
  `id` int(11) NOT NULL,
  `departemen` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `id_departemen`
--

INSERT INTO `id_departemen` (`id`, `departemen`) VALUES
(1, 'Manajemen'),
(2, 'Marketing');

-- --------------------------------------------------------

--
-- Struktur dari tabel `id_jobtitle`
--

CREATE TABLE `id_jobtitle` (
  `id` int(11) NOT NULL,
  `posisi` varchar(100) NOT NULL,
  `departemen` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `id_jobtitle`
--

INSERT INTO `id_jobtitle` (`id`, `posisi`, `departemen`) VALUES
(1, 'Kepala Cabang', 1),
(2, 'Keuangan', 1),
(3, 'IT', 1),
(4, 'Operasional', 1),
(5, 'Collector', 1),
(6, 'Telemarketing', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `id_karyawan`
--

CREATE TABLE `id_karyawan` (
  `id` int(11) NOT NULL,
  `badge` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `no_hp` varchar(100) NOT NULL,
  `no_ktp` varchar(100) NOT NULL,
  `alamat_ktp` varchar(1000) NOT NULL,
  `alamat_rumah` varchar(1000) NOT NULL,
  `pendidikan` varchar(100) NOT NULL,
  `status_kawin` varchar(100) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `posisi` int(11) NOT NULL,
  `departemen` int(11) DEFAULT NULL,
  `bank` varchar(100) NOT NULL,
  `no_rekening` varchar(100) NOT NULL,
  `nama_rekening` varchar(100) NOT NULL,
  `foto_karyawan` varchar(100) NOT NULL,
  `status_aktif` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `id_user`
--

CREATE TABLE `id_user` (
  `id` int(11) NOT NULL,
  `profilname` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `last_login` datetime NOT NULL,
  `authKey` varchar(100) NOT NULL,
  `accessToken` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `blocked` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `id_user`
--

INSERT INTO `id_user` (`id`, `profilname`, `username`, `password`, `last_login`, `authKey`, `accessToken`, `type`, `blocked`) VALUES
(1, 'Administrator', 'admin', '$2y$13$EhqRr1x2O4bmj7FJchJxIOyHfBk6x2cSRfiUEBswHcJwaeI8J6Nki', '2021-01-28 13:29:20', '21232f297a57a5a743894a0e4a801fc3', '21232f297a57a5a743894a0e4a801fc3', 'Administrator', '');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `id_departemen`
--
ALTER TABLE `id_departemen`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `id_jobtitle`
--
ALTER TABLE `id_jobtitle`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `id_karyawan`
--
ALTER TABLE `id_karyawan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `badge` (`badge`),
  ADD UNIQUE KEY `no_ktp` (`no_ktp`);

--
-- Indeks untuk tabel `id_user`
--
ALTER TABLE `id_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `id_departemen`
--
ALTER TABLE `id_departemen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `id_jobtitle`
--
ALTER TABLE `id_jobtitle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `id_karyawan`
--
ALTER TABLE `id_karyawan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `id_user`
--
ALTER TABLE `id_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
