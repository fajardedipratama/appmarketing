-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 03 Mar 2021 pada 10.21
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
-- Struktur dari tabel `id_city`
--

CREATE TABLE `id_city` (
  `id` int(11) NOT NULL,
  `kota` varchar(100) NOT NULL,
  `provinsi` varchar(100) NOT NULL,
  `oat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `id_city`
--

INSERT INTO `id_city` (`id`, `kota`, `provinsi`, `oat`) VALUES
(1, 'BANGKALAN', 'Jawa Timur', 200),
(2, 'BANYUWANGI', 'Jawa Timur', 200),
(3, 'BLITAR', 'Jawa Timur', 200),
(5, 'TRENGGALEK', 'Jawa Timur', 300);

-- --------------------------------------------------------

--
-- Struktur dari tabel `id_customer`
--

CREATE TABLE `id_customer` (
  `id` int(11) NOT NULL,
  `perusahaan` varchar(100) NOT NULL,
  `lokasi` varchar(100) NOT NULL,
  `alamat_lengkap` varchar(1000) NOT NULL,
  `pic` varchar(100) NOT NULL,
  `telfon` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `catatan` varchar(1000) NOT NULL,
  `sales` int(11) DEFAULT NULL,
  `expired` date DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_time` datetime DEFAULT NULL,
  `verified` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `id_customer`
--

INSERT INTO `id_customer` (`id`, `perusahaan`, `lokasi`, `alamat_lengkap`, `pic`, `telfon`, `email`, `catatan`, `sales`, `expired`, `created_by`, `created_time`, `verified`) VALUES
(1, 'ADILUHUNG SARANA SEGARA PT', '1', '', '', '', '', '', 7, NULL, 5, NULL, ''),
(7, 'DJAWANI GUNUNG ABADI PT', '5', '', 'suwito', '', '', '', 12, NULL, 5, NULL, ''),
(8, 'INTI LUHUR FUJA ABADI PT', '2', '', '', '', '', '', 12, NULL, 5, NULL, ''),
(9, 'ADMIRA PT', '5', '', 'purchasing', '', 'admira@gmail.com', '', 10, NULL, 5, NULL, 'yes'),
(11, 'CONBLOC PT', '1', '', '', '', '', '', 10, '2021-03-27', 10, NULL, 'no'),
(12, 'PUTRA JAYA SAKTI PT', '3', '', '', '', '', '', 10, '2021-04-02', 5, '2021-02-26 10:53:18', 'yes'),
(14, 'ABC PT', '2', '', '', '', '', '', 10, '2021-04-02', 10, '2021-03-03 15:45:27', 'yes');

-- --------------------------------------------------------

--
-- Struktur dari tabel `id_dailyreport`
--

CREATE TABLE `id_dailyreport` (
  `id` int(11) NOT NULL,
  `sales` int(11) NOT NULL,
  `waktu` datetime NOT NULL,
  `perusahaan` int(11) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `volume` varchar(100) NOT NULL,
  `jarak_ambil` varchar(100) NOT NULL,
  `catatan` varchar(1000) NOT NULL,
  `pengingat` date DEFAULT NULL,
  `con_used` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `id_dailyreport`
--

INSERT INTO `id_dailyreport` (`id`, `sales`, `waktu`, `perusahaan`, `keterangan`, `volume`, `jarak_ambil`, `catatan`, `pengingat`, `con_used`) VALUES
(3, 10, '2021-02-22 10:46:27', 9, 'Penawaran', '8', '1bulan sekali', 'butuh awal april', '2021-04-01', 'Telfon Kantor'),
(4, 10, '2021-02-22 10:47:01', 9, 'Belum ada kebutuhan', '8', '1bulan sekali', 'butuh awal mei', '2021-05-01', 'WA Pribadi'),
(6, 10, '2021-02-22 15:51:21', 9, 'Penawaran', '', '', '', NULL, 'Telfon Kantor'),
(7, 10, '2021-02-22 15:51:53', 9, 'Belum ada kebutuhan', '', '', '', NULL, 'Telfon Kantor'),
(8, 10, '2021-02-23 10:48:53', 9, 'PIC sibuk', '', '', '', NULL, 'Telfon Kantor'),
(10, 10, '2021-02-25 10:27:21', 11, 'Penawaran', '', '', '', NULL, 'Telfon Kantor'),
(11, 10, '2021-02-25 10:29:20', 11, 'Belum ada kebutuhan', '', '', '', NULL, 'Telfon Kantor'),
(12, 10, '2021-02-25 10:29:28', 11, 'Penawaran', '', '', '', NULL, 'Telfon Kantor'),
(13, 10, '2021-03-02 10:28:51', 11, 'Kontrak vendor lain', '', '', '', NULL, 'Telfon Kantor'),
(14, 8, '2021-03-03 11:17:11', 12, 'PIC sibuk', '', '', '', NULL, 'Telfon Kantor'),
(15, 8, '2021-03-03 11:17:21', 12, 'Penawaran', '', '', '', NULL, 'Telfon Kantor'),
(16, 10, '2021-03-03 13:05:44', 12, 'Penawaran', '', '', '', NULL, 'Telfon Kantor'),
(17, 10, '2021-03-03 15:46:32', 14, 'Belum ada kebutuhan', '', '', '', '2021-03-07', 'Telfon Kantor'),
(18, 10, '2021-03-03 15:46:42', 14, 'Penawaran', '', '', '', NULL, 'Telfon Kantor');

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
-- Struktur dari tabel `id_exkaryawan`
--

CREATE TABLE `id_exkaryawan` (
  `id` int(11) NOT NULL,
  `badge` int(11) NOT NULL,
  `alasan` varchar(1000) NOT NULL,
  `tgl_resign` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `id_exkaryawan`
--

INSERT INTO `id_exkaryawan` (`id`, `badge`, `alasan`, `tgl_resign`) VALUES
(3, 15, 'resignnnn', '2021-02-02');

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
  `badge` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `nama_pendek` varchar(100) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `agama` varchar(100) NOT NULL,
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

--
-- Dumping data untuk tabel `id_karyawan`
--

INSERT INTO `id_karyawan` (`id`, `badge`, `nama`, `nama_pendek`, `gender`, `tempat_lahir`, `tanggal_lahir`, `agama`, `no_hp`, `no_ktp`, `alamat_ktp`, `alamat_rumah`, `pendidikan`, `status_kawin`, `tanggal_masuk`, `posisi`, `departemen`, `bank`, `no_rekening`, `nama_rekening`, `foto_karyawan`, `status_aktif`) VALUES
(1, 6, 'Alisiaodha Qurnia Yaasintya', 'Alisia', 'Perempuan', 'Surabaya', '1998-03-31', 'Islam', '081244285595', '3578087103980001', 'Jalan Lebak Rejo Utara 3/59 Surabaya', 'Jalan Lebak Rejo Utara 3/59 Surabaya', 'D4/S1', 'Belum Menikah', '2021-01-04', 6, NULL, 'BCA', '6750617407', 'Alisiaodha Qurnia Yaasintya', '6018c32763feealisia.jpg', 'Aktif'),
(2, 1, 'Daniel Posuma', 'Daniel', 'Laki-Laki', 'Surabaya', '1966-06-26', 'Kristen', '082330410329', '3578092606660001', 'Jalan Semolowaru Selatan 6/5 Sby', 'Jalan Semolowaru Selatan 6/5 Sby', 'D4/S1', 'Menikah', '2020-12-02', 1, NULL, 'BCA', '7880199701', 'Wiyana ', '6018c4038fb8cdaniel.jpg', 'Aktif'),
(3, 2, 'Atis Dwi Anita', 'Atis', 'Perempuan', 'Surabaya', '1986-11-02', 'Islam', '081217079948', '3578144211860001', 'Jalan Manukan Subur IV/23 Surabaya', 'Jalan Manukan Subur IV/23 Surabaya', 'D4/S1', 'Belum Menikah', '2020-12-19', 2, NULL, 'BCA', '3630095475', 'Atis Dwi Anita ', '6018c4edcd2b9atis.jpg', 'Aktif'),
(4, 3, 'Malni Daang Saputra', 'Daang', 'Laki-Laki', 'Surabaya', '1982-10-28', 'Islam', '085238009293', '3578092810820003', 'Jalan Klampisngasem V-D / 5 Sby\r\n', 'Jalan Klampisngasem V-D / 5 Sby\r\n', 'SMA/Sederajat', 'Menikah', '2021-01-04', 5, NULL, 'BCA', '0140031968 ', 'Malni Daang Saputra ', '6018d0808d57edaang.jpg', 'Aktif'),
(5, 4, 'Fajar Dedi Pratama', 'Fajar', 'Laki-Laki', 'Gresik', '2000-05-02', 'Islam', '083173388708', '3525020205000001', 'Sambiroto RT 2 RW 1 Balongpanggang Gresik\r\n', 'Sambiroto RT 2 RW 1 Balongpanggang Gresik\r\n', 'SMA/Sederajat', 'Belum Menikah', '2021-01-04', 3, NULL, 'BCA', '7355064425 ', 'Fajar Dedi Pratama', '6018d27968f44fajar.jpg', 'Aktif'),
(6, 5, 'Budi Lestoro', 'Budi', 'Laki-Laki', 'Surabaya', '1987-04-23', 'Islam', '085816080857', '3578302304870004', 'Jalan Pondok Benowo Indah Blok FK No 22 Sby\r\n', 'Jalan Pondok Benowo Indah Blok FK No 22 Sby\r\n', 'SMA/Sederajat', 'Menikah', '2021-01-04', 4, NULL, 'BCA', '3630103273', 'Budi Lestoro ', '6018d3acdb8edbudi.jpg', 'Aktif'),
(7, 7, 'Farenos Ferdian Katamona', 'Faren', 'Laki-Laki', 'Surabaya', '1980-10-18', 'Kristen', '082244762737', '3578231810800001', 'Jalan Pagesangan Timur VI / 34 Surabaya\r\n', 'Jalan Pagesangan Timur VI / 34 Surabaya\r\n', 'SMA/Sederajat', 'Menikah', '2021-01-08', 6, NULL, 'BCA', '6265079338', 'Farenos Ferdian Katamona', '', 'Aktif'),
(8, 8, 'Maria Ulfah', 'Maria', 'Perempuan', 'Surabaya', '1997-10-31', 'Islam', '085645167531', '3578107110970003', 'Jalan Scorpio No 17 Sby\r\n', 'Jalan Scorpio No 17 Sby\r\n', 'D4/S1', 'Belum Menikah', '2021-01-14', 6, NULL, 'BCA', '1011002311', 'Maria Ulfah', '6018d6193b53cmaria.jpg', 'Aktif'),
(9, 9, 'Moh. Aly Mahfud', 'Aly', 'Laki-Laki', ' Lamongan ', '1987-01-08', 'Islam', '083138346015', '3524180801870003', 'Dusun Ngembet RT 1 RW 7 Lamongan\r\n', 'Dusun Ngembet RT 1 RW 7 Lamongan\r\n', 'SMA/Sederajat', 'Menikah', '2021-01-04', 6, NULL, 'BCA', '3300241408', 'Moh. Aly Mahfud', '6018d6ebce976ali.jpg', 'Aktif'),
(10, 13, 'Sugeng Hariadi', 'Sugeng', 'Laki-Laki', 'Surabaya', '1977-09-17', 'Islam', '087760051770', '3578161709770010', 'Jalan Banyu Urip Kidul 7-A / 61 Sby\r\n', 'Jalan Banyu Urip Kidul 7-A / 61 Sby\r\n', 'D4/S1', 'Menikah', '2021-01-04', 6, NULL, 'BCA', '3630091461', 'Sugeng Hariadi', '6018dc5b8b2e2sugeng.jpg', 'Aktif'),
(11, 10, 'Nia Hidayatul Rovitasari', 'Nia', 'Perempuan', 'Surabaya', '1996-03-04', 'Islam', '081334446671', '3578044403960006', 'Jalan Kendangsari 4 / XI-A Surabaya\r\n', 'Jalan Kendangsari 4 / XI-A Surabaya\r\n', 'SMA/Sederajat', 'Menikah', '2021-01-11', 6, NULL, 'BCA', '8221129644', 'Nia Hidayatul Rovitasari', '6018f3e2af758nia.jpg', 'Aktif'),
(12, 11, 'Risza Hanhamdani', 'Risza', 'Laki-Laki', 'Surabaya', '1976-07-15', 'Islam', '082132329911', '3578031507760003', 'Jalan Penjaringan Asri XV / 36 Sby\r\n', 'Jalan Penjaringan Asri XV / 36 Sby\r\n', 'D4/S1', 'Menikah', '2021-01-04', 6, NULL, 'BCA', '6750471810', 'Irfaniah', '6018f5c03a227risza.jpg', 'Aktif'),
(13, 12, 'Rona Emeiliyandari', 'Rona', 'Perempuan', 'Surabaya', '1982-05-13', 'Islam', '085546244639', '3578017005820001', 'Jalan Griya Kebraon Utara IX / AN - 14 Sby\r\n', 'Jalan Griya Kebraon Utara IX / AN - 14 Sby\r\n', 'SMA/Sederajat', 'Cerai', '2021-01-12', 6, NULL, 'BCA', '2710803300', 'Rona Emeiliyandari', '6018f68606e4drona.jpg', 'Aktif'),
(15, 14, 'tes', '', 'Laki-Laki', 'Surabaya', '1998-03-31', '', '0999', '', '', 'sby', '', '', '2021-01-04', 6, NULL, 'BCA', '', '', '', 'Tidak Aktif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `id_offer`
--

CREATE TABLE `id_offer` (
  `id` int(11) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `waktu` time NOT NULL,
  `no_surat` int(11) DEFAULT NULL,
  `perusahaan` int(11) NOT NULL,
  `pic` varchar(100) NOT NULL,
  `top` varchar(100) NOT NULL,
  `pajak` varchar(100) NOT NULL,
  `harga` int(11) DEFAULT NULL,
  `catatan` varchar(1000) NOT NULL,
  `sales` int(11) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `id_offer`
--

INSERT INTO `id_offer` (`id`, `tanggal`, `waktu`, `no_surat`, `perusahaan`, `pic`, `top`, `pajak`, `harga`, `catatan`, `sales`, `status`) VALUES
(12, '2021-02-25', '10:10:38', 1, 9, 'Pembelian', 'Cash On Delivery', 'PPN', 6600, '', 10, 'Proses'),
(13, '2021-02-24', '10:29:48', NULL, 11, 'Purchase', 'Cash On Delivery', 'PPN', 6800, '', 10, 'Batal Kirim'),
(14, '2021-02-28', '10:10:38', 2, 9, 'Pembelian', 'Cash On Delivery', 'PPN', 6600, '', 10, 'Proses'),
(15, '2021-02-27', '10:29:48', NULL, 11, 'Purchase', 'Cash On Delivery', 'PPN', 6800, '', 10, 'Gagal Kirim'),
(17, '2021-03-03', '11:17:29', 4, 12, 'Pembelian', 'Cash On Delivery', 'PPN', 6500, '', 8, 'Terkirim'),
(18, '2021-03-03', '11:17:46', 3, 12, 'Pembelian', 'Tempo 7 Hari', 'PPN', 6700, '', 8, 'Terkirim'),
(20, '2021-03-03', '13:47:10', 5, 12, 'Bu Eva', 'Cash On Delivery', 'PPN', 6200, '', 10, 'Proses'),
(21, '2021-03-04', '13:49:16', 6, 12, 'Pembelian', 'Tempo 14 Hari', 'PPN', 6500, '', 10, 'Proses'),
(22, '2021-03-03', '15:47:01', 7, 14, 'Pembelian', 'Cash On Delivery', 'PPN', 6500, '', 10, 'Terkirim');

-- --------------------------------------------------------

--
-- Struktur dari tabel `id_offer_number`
--

CREATE TABLE `id_offer_number` (
  `id` int(11) NOT NULL,
  `nomor` int(11) DEFAULT NULL,
  `inisial` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `id_offer_number`
--

INSERT INTO `id_offer_number` (`id`, `nomor`, `inisial`) VALUES
(1, 7, 'BJB-SBY');

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
(1, '5', 'dedy', '$2y$13$MdjCzwpzvuQvqvkqKvM14ezHCh.4MKx71DEaZEoI8HX6R8jW.nj1e', '2021-03-03 15:50:55', 'd5fdbe5b16111739a53f6bedc2c29e5c', 'd5fdbe5b16111739a53f6bedc2c29e5c', 'Administrator', ''),
(2, '10', 'sugeng', '$2y$13$0boAOohSI0ofjmPZ05xZbeRR03oOUkfYRQT/PGedqGTi7rJ2Y.gyG', '2021-03-03 15:48:55', '9e28894760bdf11cb2bef7a32c020e3b', '9e28894760bdf11cb2bef7a32c020e3b', 'Marketing', ''),
(3, '3', 'atis', '$2y$13$KVUHfL5rcRvil9nhYjUNJetLhgyb2ptcfJOEVOOWb6YcM4FjKtk8W', '2021-02-16 13:57:23', 'd5455de2f44f740d0e7ae3b97ffaf9ea', 'd5455de2f44f740d0e7ae3b97ffaf9ea', 'Manajemen', ''),
(4, '1', 'alisia', '$2y$13$vqbiCxoDOc3MVNdwa47ALuFYLB2AuFa.10MdhG1JAGVjKK7g5wlwe', '2021-02-20 10:45:18', '3c89bc5dc3c18795e99eaf0f91af12f6', '3c89bc5dc3c18795e99eaf0f91af12f6', 'Marketing', ''),
(5, '8', 'maria', '$2y$13$2vHy.0YdypFZvW6HJKgFpewvcr4reRrXAPRmrfbmO69iEZY6LxjGW', '2021-03-03 11:16:40', '263bce650e68ab4e23f28263760b9fa5', '263bce650e68ab4e23f28263760b9fa5', 'Marketing', '');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `id_city`
--
ALTER TABLE `id_city`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kota` (`kota`);

--
-- Indeks untuk tabel `id_customer`
--
ALTER TABLE `id_customer`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `perusahaan` (`perusahaan`);

--
-- Indeks untuk tabel `id_dailyreport`
--
ALTER TABLE `id_dailyreport`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `id_departemen`
--
ALTER TABLE `id_departemen`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `id_exkaryawan`
--
ALTER TABLE `id_exkaryawan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `badge` (`badge`);

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
-- Indeks untuk tabel `id_offer`
--
ALTER TABLE `id_offer`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `id_offer_number`
--
ALTER TABLE `id_offer_number`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nomor` (`nomor`);

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
-- AUTO_INCREMENT untuk tabel `id_city`
--
ALTER TABLE `id_city`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `id_customer`
--
ALTER TABLE `id_customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `id_dailyreport`
--
ALTER TABLE `id_dailyreport`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `id_departemen`
--
ALTER TABLE `id_departemen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `id_exkaryawan`
--
ALTER TABLE `id_exkaryawan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `id_jobtitle`
--
ALTER TABLE `id_jobtitle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `id_karyawan`
--
ALTER TABLE `id_karyawan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `id_offer`
--
ALTER TABLE `id_offer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `id_offer_number`
--
ALTER TABLE `id_offer_number`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `id_user`
--
ALTER TABLE `id_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
