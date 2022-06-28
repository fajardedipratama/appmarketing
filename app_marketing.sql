-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 28 Jun 2022 pada 11.28
-- Versi server: 10.4.17-MariaDB
-- Versi PHP: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `app_marketing`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `id_calculator`
--

CREATE TABLE `id_calculator` (
  `id` int(11) NOT NULL,
  `komponen` varchar(100) NOT NULL,
  `persentase` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(5, 'TRENGGALEK', 'Jawa Timur', 300),
(6, 'BOJONEGORO', 'Jawa Timur', 250),
(7, 'BONDOWOSO', 'Jawa Timur', 100),
(8, 'GRESIK', 'Jawa Timur', 100),
(9, 'JEMBER', 'Jawa Timur', 100),
(10, 'JOMBANG', 'Jawa Timur', 200),
(11, 'KEDIRI', 'Jawa Timur', 250),
(12, 'LAMONGAN', 'Jawa Timur', 200),
(13, 'LUMAJANG', 'Jawa Timur', 100),
(14, 'MADIUN', 'Jawa Timur', 250),
(15, 'MAGETAN', 'Jawa Timur', 300),
(16, 'MALANG', 'Jawa Timur', 100),
(17, 'MOJOKERTO', 'Jawa Timur', 100),
(18, 'NGANJUK', 'Jawa Timur', 200),
(19, 'NGAWI', 'Jawa Timur', 300),
(20, 'PACITAN', 'Jawa Timur', 300),
(21, 'PAMEKASAN', 'Jawa Timur', 250),
(22, 'PASURUAN', 'Jawa Timur', 0),
(23, 'PONOROGO', 'Jawa Timur', 300),
(24, 'PROBOLINGGO', 'Jawa Timur', 0),
(25, 'SAMPANG', 'Jawa Timur', 200),
(26, 'SIDOARJO', 'Jawa Timur', 100),
(27, 'SITUBONDO', 'Jawa Timur', 100),
(28, 'SUMENEP', 'Jawa Timur', 300),
(29, 'SURABAYA', 'Jawa Timur', 100),
(30, 'TUBAN', 'Jawa Timur', 300),
(31, 'TULUNGAGUNG', 'Jawa Timur', 250);

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
  `expired_pusat` date DEFAULT NULL,
  `expired_pending` date DEFAULT NULL,
  `long_expired` varchar(100) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_time` datetime DEFAULT NULL,
  `verified` varchar(100) NOT NULL,
  `entrusted` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `catatan` varchar(1000) NOT NULL,
  `pengingat` date DEFAULT NULL,
  `con_used` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `id_dashboard`
--

CREATE TABLE `id_dashboard` (
  `id` int(11) NOT NULL,
  `user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `posisi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `id_jobtitle`
--

INSERT INTO `id_jobtitle` (`id`, `posisi`) VALUES
(1, 'Manager Area'),
(2, 'Finance'),
(3, 'IT'),
(4, 'Operasional'),
(5, 'Analyst & Collection'),
(6, 'Telemarketing');

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
  `tipe_gaji` varchar(100) NOT NULL,
  `foto_karyawan` varchar(100) NOT NULL,
  `status_aktif` varchar(100) NOT NULL,
  `alasan_resign` varchar(1000) NOT NULL,
  `tgl_resign` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `id_karyawan`
--

INSERT INTO `id_karyawan` (`id`, `badge`, `nama`, `nama_pendek`, `gender`, `tempat_lahir`, `tanggal_lahir`, `agama`, `no_hp`, `no_ktp`, `alamat_ktp`, `alamat_rumah`, `pendidikan`, `status_kawin`, `tanggal_masuk`, `posisi`, `departemen`, `bank`, `no_rekening`, `nama_rekening`, `tipe_gaji`, `foto_karyawan`, `status_aktif`, `alasan_resign`, `tgl_resign`) VALUES
(1, 6, 'Alisiaodha Qurnia Y.', 'Alisia', 'Perempuan', 'Surabaya', '1998-03-31', 'Islam', '081244285595', '3578087103980001', 'Jalan Lebak Rejo Utara 3/59 Sby', ' Jalan Lebak Rejo Utara 3/59 Sby', 'D4/S1', 'Belum Menikah', '2021-01-04', 6, 2, 'BCA', '6750617407', 'Alisiaodha Qurnia Yaasintya', '2', '6102683598342alisia.jpg', 'Aktif', '', NULL),
(2, 1, 'Daniel Posuma', 'Daniel', 'Laki-Laki', 'Surabaya', '1966-06-26', 'Kristen', '082330410329', '3578092606660001', 'Jalan Semolowaru Selatan 6/5 Sby', 'Jalan Semolowaru Selatan 6/5 Sby', 'D4/S1', 'Menikah', '2020-12-02', 1, 1, 'BCA', '7880199701', 'Wiyana ', '1', '6018c4038fb8cdaniel.jpg', 'Aktif', '', NULL),
(3, 2, 'Atis Dwi Anita', 'Atis', 'Perempuan', 'Surabaya', '1986-11-02', 'Islam', '081217079948', '3578144211860001', 'Jalan Manukan Subur IV/23 Surabaya', 'Jalan Manukan Subur IV/23 Surabaya', 'D4/S1', 'Belum Menikah', '2020-12-19', 2, 1, 'BCA', '3630095475', 'Atis Dwi Anita ', '1', '6018c4edcd2b9atis.jpg', 'Tidak Aktif', 'terminate', '2021-12-10'),
(4, 3, 'Malni Daang Saputra', 'Daang', 'Laki-Laki', 'Surabaya', '1982-10-28', 'Islam', '081331226931', '3578092810820003', 'Jalan Klampisngasem V-D / 5 Sby\r\n', 'Jalan Klampisngasem V-D / 5 Sby\r\n', 'SMA/Sederajat', 'Menikah', '2021-01-04', 5, 1, 'BCA', '0140031968 ', 'Malni Daang Saputra ', '1', '6018d0808d57edaang.jpg', 'Tidak Aktif', 'resign', '2022-01-27'),
(5, 4, 'Fajar Dedi Pratama', 'Fajar', 'Laki-Laki', 'Gresik', '2000-05-02', 'Islam', '083173388708', '3525020205000001', 'Sambiroto RT 2 RW 1 Balongpanggang Gresik\r\n', 'Sambiroto RT 3RW 1 Balongpanggang Gresik\r\n', 'SMA/Sederajat', 'Belum Menikah', '2021-01-04', 3, 1, 'BCA', '7355064425 ', 'Fajar Dedi Pratama', '1', '60934a68970e4fajar(3).jpg', 'Aktif', '', NULL),
(6, 5, 'Budi Lestoro', 'Budi', 'Laki-Laki', 'Surabaya', '1987-04-23', 'Islam', '085816080857', '3578302304870004', 'Jalan Pondok Benowo Indah Blok FK No 22 Sby\r\n', 'Jalan Pondok Benowo Indah Blok FK No 22 Sby\r\n', 'SMA/Sederajat', 'Menikah', '2021-01-04', 4, 1, 'BCA', '3630103273', 'Budi Lestoro ', '1', '6018d3acdb8edbudi.jpg', 'Aktif', '', NULL),
(7, 7, 'Farenos Ferdian Katamona', 'Faren', 'Laki-Laki', 'Surabaya', '1980-10-18', 'Kristen', '082244762737', '3578231810800001', 'Jalan Pagesangan Timur VI / 34 Surabaya\r\n', 'Jalan Pagesangan Timur VI / 34 Surabaya\r\n', 'SMA/Sederajat', 'Menikah', '2021-01-08', 6, 2, 'BCA', '6265079338', 'Farenos Ferdian Katamona', '', '', 'Tidak Aktif', 'tidak dapat melanjutkan kerja karena urusan keluarga', '2021-04-10'),
(8, 8, 'Maria Ulfah', 'Maria', 'Perempuan', 'Surabaya', '1997-10-31', 'Islam', '085645167531', '3578107110970003', 'Jalan Scorpio No 17 Sby\r\n', 'Jalan Scorpio No 17 Sby\r\n', 'D4/S1', 'Belum Menikah', '2021-01-14', 6, 2, 'BCA', '1011002311', 'Maria Ulfah', '2', '6018d6193b53cmaria.jpg', 'Tidak Aktif', 'mengundurkan diri/resign', '2021-08-09'),
(9, 9, 'Moh. Aly Mahfud', 'Aly', 'Laki-Laki', ' Lamongan ', '1987-01-08', 'Islam', '085855732600', '3524180801870003', 'Dusun Ngembet RT 1 RW 7 Lamongan\r\n', 'Dusun Ngembet RT 1 RW 7 Lamongan\r\n', 'SMA/Sederajat', 'Menikah', '2021-01-04', 6, 2, 'BCA', '3300241408', 'Moh. Aly Mahfud', '2', '6018d6ebce976ali.jpg', 'Aktif', '', NULL),
(10, 13, 'Sugeng Hariadi', 'Sugeng', 'Laki-Laki', 'Surabaya', '1977-09-17', 'Islam', '087760051770', '3578161709770010', 'Jalan Banyu Urip Kidul 7-A / 61 Sby\r\n', 'Jalan Banyu Urip Kidul 7-A / 61 Sby\r\n', 'D4/S1', 'Menikah', '2021-01-04', 6, 2, 'BCA', '3630091461', 'Sugeng Hariadi', '2', '6018dc5b8b2e2sugeng.jpg', 'Tidak Aktif', 'resign', '2022-01-17'),
(11, 10, 'Nia Hidayatul Rovitasari', 'Nia', 'Perempuan', 'Surabaya', '1996-03-04', 'Islam', '081334446671', '3578044403960006', 'Jalan Kendangsari 4 / XI-A Surabaya\r\n', 'Jalan Kendangsari 4 / XI-A Surabaya\r\n', 'SMA/Sederajat', 'Menikah', '2021-01-11', 6, 2, 'BCA', '8221129644', 'Nia Hidayatul Rovitasari', '', '6018f3e2af758nia.jpg', 'Tidak Aktif', 'terminate (absensi, po, report minus)', '2021-04-29'),
(12, 11, 'Risza Hanhamdani', 'Risza', 'Laki-Laki', 'Surabaya', '1976-07-15', 'Islam', '082132329911', '3578031507760003', 'Jalan Penjaringan Asri XV / 36 Sby\r\n', 'Jalan Penjaringan Asri XV / 36 Sby\r\n', 'D4/S1', 'Menikah', '2021-01-04', 6, 2, 'BCA', '6750471810', 'Irfaniah', '2', '6018f5c03a227risza.jpg', 'Tidak Aktif', 'resign', '2021-09-27'),
(13, 12, 'Rona Emeiliyandari', 'Rona', 'Perempuan', 'Surabaya', '1982-05-30', 'Islam', '081231831011', '3578017005820001', 'Jalan Griya Kebraon Utara IX / AN - 14 Sby\r\n', 'Jalan Griya Kebraon Utara IX / AN - 14 Sby\r\n', 'SMA/Sederajat', 'Cerai', '2021-01-12', 6, 2, 'BCA', '2710803300', 'Rona Emeiliyandari', '', '6018f68606e4drona.jpg', 'Tidak Aktif', 'resign, mencari pekerjaan lain', '2021-06-16'),
(16, 14, 'Andri Wibisono', 'Andri', 'Laki-Laki', 'Balikpapan', '1986-06-19', 'Islam', '08218622313', '3402101907860002', 'Gaten/pelemadu 002/000 Sriharjo, Imogiri, Yogyakarta', 'Jl. Raya Lontar, Gg.Hikmah 1, Surabaya', 'SMA/Sederajat', 'Menikah', '2021-04-05', 6, 2, 'BCA', '2581787946', 'Andri Wibisono', '', '606a6e68d0b2auser-profile-default.png', 'Tidak Aktif', 'terminate (absensi, po, report minus)', '2021-04-29'),
(17, 15, 'Ebet Budiono', 'Ebet', 'Laki-Laki', 'Surabaya', '1977-03-25', 'Islam', '081232676358', '3578122503770006', 'Stasiun Kota 34-A RT 01 RW 03 Bongkaran, Pabean Cantian, Surabaya', 'Stasiun Kota 34-A RT 01 RW 03 Bongkaran, Pabean Cantian, Surabaya', 'D4/S1', 'Belum Menikah', '2021-05-01', 6, 2, 'BCA', '5060158608', 'Ebet Budiono', '2', '60b87995af200ebet.jpg', 'Aktif', '', NULL),
(18, 16, 'Hendra Sunoto', 'Hendra', 'Laki-Laki', 'Surabaya', '1979-03-07', 'Islam', '082141080879', '3578040703790006', 'Pulosari 18 RT 02 RW 09 Sawunggaling Wonokromo Surabaya', 'Gunungsari 3 Gg.1 No.38 RT 1 RW 9 Sawunggaling Wonokromo Surabaya', 'D4/S1', 'Cerai', '2021-06-03', 6, 2, 'BCA', '2581711940', 'HENDRA SUNOTO', '2', '60d01b7fcc66ehendra.jpeg', 'Tidak Aktif', 'pindah kerja tempat lain', '2021-08-06'),
(19, 17, 'Dewi Ragil Kuning', 'Dewi', 'Perempuan', 'Bangkalan', '1974-12-12', 'Kristen', '081216210674', '3578265212740002', 'Jl. Manyar 1/5 RT 1 RW 8 Manyar Sabrangan Mulyorejo Surabaya', 'Jl. Manyar 1/5 RT 1 RW 8 Manyar Sabrangan Mulyorejo Surabaya', 'D4/S1', 'Menikah', '2021-06-03', 6, 2, 'BCA', '7880274851', 'Dewi Ragil Kuning', '2', '60d01bb851cfbdewi.jpeg', 'Tidak Aktif', '	ikut suami pindah ke gresik', '2021-07-31'),
(20, 23, 'Bre Cahya Kumara', 'Bre', 'Laki-Laki', 'Surabaya', '1975-08-15', 'Islam', '081232934410', '3578141508750001', 'Manukan Dono1 Blok I/31-1 RT 5 RW 13 Manukan Kulon, Tandes, Surabaya', 'Perum Alam Pesona 1, Blok X no.11. Sidorejo Krian Sidoarjo', 'D4/S1', 'Menikah', '2021-08-01', 6, 2, 'BCA', '4290388291', 'Bre Cahya Kumara', '', '617cd8e103394bre.jpg', 'Aktif', '', NULL),
(24, 19, 'Sundari', 'Sundari', 'Perempuan', 'Surabaya', '1980-03-07', 'Islam', '085231622781', '3578244703800001', 'Pandugo 2/P 2 K-10, RT 6 RW 9, Penjaringan Sari, Rungkut, Surabaya', 'Pandugo 2/P 2 K-10, RT 6 RW 9, Penjaringan Sari, Rungkut, Surabaya', 'SMA/Sederajat', 'Menikah', '2021-09-01', 6, 2, 'BCA', '6730455184', 'Sundari', '', '', 'Tidak Aktif', 'resign', '2021-10-02'),
(25, 25, 'Reza Aprilia', 'Reza', 'Perempuan', 'Surabaya', '1998-05-14', 'Islam', '085839918828', '3578175405980003', 'Sidotopo Wetan 2/17 RT 5 RW 1, Sidotopo Wetan, Kenjeran, Surabaya', 'Sidotopo Wetan 2/17 RT 5 RW 1, Sidotopo Wetan, Kenjeran, Surabaya', 'SMA/Sederajat', 'Belum Menikah', '2021-10-01', 6, 2, 'BCA', '1011307057', 'Reza Aprilia', '', '617cd8f717685reza.jpg', 'Tidak Aktif', 'resign', '2021-11-29'),
(26, 24, 'Elfa Vebriana', 'Elfa', 'Perempuan', 'Tulungagung', '1991-02-01', 'Islam', '082131631199', '3504014102910001', 'Jl. Basuki Rahmat no.55 RT 3 RW 3, Kampungdalem, Tulungagung', 'Jl. Pulo Wonokromo no.96, Surabaya (Optik Turi Jaya)', 'D4/S1', 'Menikah', '2021-10-04', 6, 2, 'BCA', '0481237890', 'Elfa Vebriana', '', '617cd8ed2ab12elfa.jpg', 'Tidak Aktif', 'resign', '2022-03-01'),
(27, 26, 'Rosa Kusuma Dewi', 'Rosa', 'Perempuan', 'Nganjuk', '1997-03-23', 'Islam', '082234766282', '3518096303970001', 'Dusun Gareman, RT 01 RW 03, Babadan, Patianrowo, Nganjuk', 'Lebakrejo Utara 5 no.10 Surabaya', 'D4/S1', 'Belum Menikah', '2021-11-01', 6, 2, 'BCA', '3880776745', 'Rosa Kusuma Dewi A', '', '', 'Tidak Aktif', 'resign', '2021-11-13'),
(28, 27, 'M. Fais Ditya Pranata', 'Fais', 'Laki-Laki', 'Sidoarjo', '1991-05-15', 'Islam', '0895395393964', '3515141505910004', 'Perum Suko Mandiri II/2, RT 23 RW 4, Suko, Sukodono, Sidoarjo', 'Perum Suko Mandiri II/2, RT 23 RW 4, Suko, Sukodono, Sidoarjo', 'D4/S1', 'Belum Menikah', '2021-11-01', 6, 2, 'BCA', '0182438004', 'M Fais Ditya Pranata', '', '', 'Tidak Aktif', 'resign', '2021-11-30'),
(29, 28, 'Chindy Syahputri A.B.', 'Chindy', 'Perempuan', 'Malang', '1999-01-26', 'Islam', '081331344448', '3515156601990001', 'Perum Tridasa Windu Asri B-19, RT 15 RW 05, Wadungasih, Buduran, Sidoarjo', 'Perum Tridasa Windu Asri B-19, RT 15 RW 05, Wadungasih, Buduran, Sidoarjo', 'D1/D2/D3', 'Belum Menikah', '2021-11-01', 6, 2, 'BCA', '0182266262', 'Chindy Syahputri Ari Basuki', '', '', 'Tidak Aktif', 'resign', '2022-01-11'),
(30, 29, 'Hermin Widyastuti', 'Widya', 'Perempuan', 'Surabaya', '1980-04-24', 'Islam', '082332759212', '3578046404800007', 'Jangkungan I D / 5-A RT 5 RW 8 Nginden Jangkungan, Sukolilo, Surabaya', 'Nginden 2 no.48, Surabaya', 'D4/S1', 'Menikah', '2021-12-01', 6, 2, 'BCA', '5120551266', 'Hermin Widyastuti', '', '', 'Tidak Aktif', 'resign', '2021-12-07'),
(31, 30, 'Titik Harsani', 'Vera', 'Perempuan', 'Surabaya', '1980-09-19', 'Kristen', '083830561019', '3578045909800011', 'Ngagelrejo Pipo 27 RT 9 RW 2, Ngagel Rejo, Wonokromo, Surabaya', 'Penjaringan Asri 1 Blok J 33, Surabaya', 'SMA/Sederajat', 'Menikah', '2021-12-01', 6, 2, 'BCA', '', '', '', '', 'Tidak Aktif', 'resign', '2021-12-06'),
(32, 31, 'Irvan Yahya', 'Irvan', 'Laki-Laki', 'Gresik', '2000-11-06', 'Islam', '089620020059', '3578100611000013', 'Kapas Gading Madya 2-B/28 RT 3 RW 1, Dukuh Setro, Tambaksari, Surabaya', 'Kapas Gading Madya 2-B/28 RT 3 RW 1, Dukuh Setro, Tambaksari, Surabaya', 'SMA/Sederajat', 'Belum Menikah', '2021-12-06', 6, 2, 'BCA', '1011697386', 'Irvan Yahya', '', '62b077e9bf057user-profile-default.png', 'Aktif', '', NULL),
(33, 32, 'Zainul Safa\'at', 'Zainul', 'Laki-Laki', 'Surabaya', '1985-03-30', 'Islam', '081339034236', '3578153103850001', 'Krembangan Jaya Utara 8/48-A RT 14 RW 5 Kemayoran, Krembangan, Surabaya', 'Krembangan Jaya Utara 8/48-A RT 14 RW 5 Kemayoran, Krembangan, Surabaya', 'D4/S1', 'Menikah', '2021-12-13', 5, 1, 'BCA', '3630105152', 'Zainul Safa\'at', '', '', 'Aktif', '', NULL),
(34, 33, 'Retno Sajektiningtyas', 'Titiek', 'Perempuan', 'Surabaya', '1963-12-11', 'Kristen', '082233175563', '3578105112630006', 'Bronggalan Sawah 5-C/2 RT 4 RW 9 Pacar Kembang, Tambak Sari, Surabaya', 'Bronggalan Sawah 5-C/2 RT 4 RW 9 Pacar Kembang, Tambak Sari, Surabaya', 'D1/D2/D3', 'Menikah', '2022-02-02', 6, 2, 'BCA', '5075202587', 'Retno Sajektiningtyas', '', '', 'Tidak Aktif', '-', '2022-02-03'),
(35, 34, 'Rensy Armahwati', 'Rensy', 'Perempuan', 'Surabaya', '1983-05-10', 'Islam', '08113310051', '3578085005830005', 'Petemon Sidomulyo 4/3 RT 9 RW 18, Petemon, Sawahan, Surabaya', 'Medokan Sawah Timur 4C no.19, Surabaya', 'D1/D2/D3', 'Menikah', '2022-02-02', 6, 2, 'BCA', '1030523021', 'Rensy Armahwati', '', '62a309bba5b33rensy.jpeg', 'Aktif', '', NULL),
(36, 35, 'Angela Daselva', 'Angel', 'Perempuan', 'Surabaya', '1983-12-01', 'Islam', '082296620221', '3578044112830004', 'Mundu No.14 RT 3 RW 1, Tambaksari, Tambaksari, Surabaya', 'Mundu No.14 RT 3 RW 1, Tambaksari, Tambaksari, Surabaya', 'SMA/Sederajat', 'Menikah', '2022-02-02', 6, 2, 'BCA', '5550125325', 'Angela Daselva', '', '', 'Tidak Aktif', 'resign', '2022-05-21'),
(37, 36, 'Muhammad Dhabit Hanafi', 'Fio', 'Laki-Laki', 'Surabaya', '1998-11-04', 'Islam', '085760911902', '3524190411980003', 'Lembeyan RT 1 RW 2 Doyomulyo Kembangbahu, Lamongan', 'Sambiarum 55A no.22, Surabaya', 'SMA/Sederajat', 'Belum Menikah', '2022-02-02', 6, 2, 'BCA', '-', '-', '', '', 'Tidak Aktif', 'resign', '2022-02-07'),
(38, 37, 'Nurlita Hayati', 'Lita', 'Perempuan', 'Gresik', '1985-09-06', 'Islam', '087862015639', '3525144609850001', 'Awioken Madya Utara no.18, RT 6 RW 2, Gending, Kebomas, Gresik', 'Awioken Madya Utara no.18, RT 6 RW 2, Gending, Kebomas, Gresik', 'D4/S1', 'Menikah', '2022-03-21', 6, 2, 'BCA', '7901129014', 'Nurlita Hayati', '', '6238168cbea1cLita.jpeg', 'Aktif', '', NULL),
(39, 38, 'S. Rachmawati', 'Rachma', 'Perempuan', 'Surabaya', '1971-09-18', 'Islam', '08123592150', '3578155809710002', 'Tanjung Redep 12 RT 7 RW 7 Perak Barat, Krembangan, Surabaya', 'Tanjung Redep 12 RT 7 RW 7 Perak Barat, Krembangan, Surabaya', 'SMA/Sederajat', 'Menikah', '2022-03-21', 6, 2, 'BCA', '4680089405', 'S. Rachmawati', '', '62397d6d39a94rachma.jpeg', 'Aktif', '', NULL),
(40, 39, 'Bryan Allen, S.Pd.', 'Bryan', 'Laki-Laki', 'Tulungagung', '1991-01-18', 'Kristen', '081330540011', '3504011801910001', 'Jl. P. Diponegoro IV/87 RT 2 RW 1 Tamanan Tulungagung', 'Perum Graha Penta Blok AJ 7, Bluru, Sidoarjo', 'D4/S1', 'Menikah', '2022-05-11', 6, 2, 'BCA', '5600374267', 'Bryan Allen SPD', '', '', 'Aktif', '', NULL);

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
  `status` varchar(100) NOT NULL,
  `is_new` varchar(100) NOT NULL,
  `send_wa` int(11) DEFAULT NULL,
  `show_tax` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `id_offer_number`
--

CREATE TABLE `id_offer_number` (
  `id` int(11) NOT NULL,
  `nomor` int(11) DEFAULT NULL,
  `inisial` varchar(100) NOT NULL,
  `periode` varchar(100) NOT NULL,
  `min_price` int(11) DEFAULT NULL,
  `max_price` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `id_offer_number`
--

INSERT INTO `id_offer_number` (`id`, `nomor`, `inisial`, `periode`, `min_price`, `max_price`) VALUES
(1, 916, 'BJB-SBY / VI', '15-30 Juni 2022', 10800, 20000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `id_purchase_order`
--

CREATE TABLE `id_purchase_order` (
  `id` int(11) NOT NULL,
  `perusahaan` int(11) NOT NULL,
  `sales` int(11) NOT NULL,
  `broker` int(11) DEFAULT NULL,
  `no_po` varchar(100) NOT NULL,
  `tgl_po` date NOT NULL,
  `tgl_kirim` date NOT NULL,
  `alamat` varchar(1000) NOT NULL,
  `kota_kirim` int(11) DEFAULT NULL,
  `alamat_kirim` varchar(1000) NOT NULL,
  `purchasing` varchar(100) NOT NULL,
  `no_purchasing` varchar(100) NOT NULL,
  `keuangan` varchar(100) NOT NULL,
  `no_keuangan` varchar(100) NOT NULL,
  `volume` int(11) NOT NULL,
  `termin` varchar(100) NOT NULL,
  `harga` int(11) NOT NULL,
  `cashback` int(11) DEFAULT NULL,
  `pajak` varchar(100) NOT NULL,
  `pembayaran` varchar(100) NOT NULL,
  `bilyet_giro` int(11) DEFAULT NULL,
  `status` varchar(100) NOT NULL,
  `catatan` varchar(1000) NOT NULL,
  `alasan_tolak` varchar(1000) NOT NULL,
  `penerima` varchar(100) NOT NULL,
  `eksternal` varchar(100) DEFAULT NULL,
  `penalti` int(11) DEFAULT NULL,
  `jatuh_tempo` date DEFAULT NULL,
  `tgl_lunas` date DEFAULT NULL,
  `range_paid` int(11) DEFAULT NULL,
  `driver_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `id_purchase_order_paid`
--

CREATE TABLE `id_purchase_order_paid` (
  `id` int(11) NOT NULL,
  `purchase_order_id` int(11) NOT NULL,
  `paid_date` date NOT NULL,
  `amount` int(11) NOT NULL,
  `bank` varchar(200) NOT NULL,
  `note` varchar(100) NOT NULL
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
(1, '5', 'dedy', '$2y$13$.d2C0.bHMWLqkIT0k6Dd3.7xNwLBUey3mvzOwx/v.6fiDSOEzn/2e', '2022-06-28 16:19:29', 'd5fdbe5b16111739a53f6bedc2c29e5c', 'd5fdbe5b16111739a53f6bedc2c29e5c', 'Administrator', ''),
(7, '1', 'alisiachintya', '$2y$13$SMiUO/xBwZvGKMEKtfXe7.wG3qXPcUjCCkKcxHFSxfP11OzriM.s2', '2022-06-20 08:46:55', '60532c4e119ce506036cf74f655259dd', '60532c4e119ce506036cf74f655259dd', 'Marketing', ''),
(12, '9', 'aly', '$2y$13$.7fwCl3DSo3.Gk4UjknlWOKflN.xU77CfRkZftCQ6Xp/6J.D.47ny', '2022-06-20 08:55:36', '33fb5fa89f84d0a48397f693a7c7c242', '33fb5fa89f84d0a48397f693a7c7c242', 'Marketing', ''),
(16, '2', 'daniel', '$2y$13$1rUsrEDMK47J/WMIqVFFHO8Jz.eHFnxN4z7xq/31JaxlOy7WXwYHC', '2022-06-28 15:24:45', 'aa47f8215c6f30a0dcdb2a36a9f4168e', 'aa47f8215c6f30a0dcdb2a36a9f4168e', 'Manajemen', ''),
(17, '6', 'budi', '$2y$13$CswxJJBZ1QWKtmx28ohWBu9NfpJblNH3I1YFsditqRPjSGDiuU73a', '2022-06-17 09:56:41', '00dfc53ee86af02e742515cdcf075ed3', '00dfc53ee86af02e742515cdcf075ed3', 'Marketing', ''),
(19, '17', 'ebet', '$2y$13$B/BSK305sYm0CE.K.0.E6.EYtDlG3526lH/tznlqlIDb1unUGkv.W', '2022-06-20 14:40:34', 'bc52c57a755cb90b05a8aab1142094d4', 'bc52c57a755cb90b05a8aab1142094d4', 'Marketing', ''),
(22, '20', 'bre', '$2y$13$LWoLA.E0CTnzZsTUAybCg.j5qWYFKR/nxKtAMGjgOzlvxURr6Q0Py', '2022-06-20 08:51:30', '0cd00ec14f1d05d419375d6a37d183a6', '0cd00ec14f1d05d419375d6a37d183a6', 'Marketing', ''),
(31, '32', 'irvan', '$2y$13$Rewy41tOoJ6NzxpAvNX1mOozR/ZccaiojYSmeamIVKc7lfI0N.z6u', '2022-06-28 15:22:29', '4c8e0251c853de2172b5e138075c7b3f', '4c8e0251c853de2172b5e138075c7b3f', 'Marketing', ''),
(32, '33', 'zainul', '$2y$13$ziLFaA8JpuWPutpQGgZt8u2k8tl9s6nNkmpXrwdLzKZQBIL.fvwCS', '2022-06-17 16:03:02', '2072b90bc63f596b8908791f47617a7c', '2072b90bc63f596b8908791f47617a7c', 'Manajemen', ''),
(33, '37', 'fio', '$2y$13$Aj2LNO1CbixvCXW.YqltbuVUoh0pg.kuAHyMReofFm9O3VsWUHOMq', '2022-02-03 08:37:47', 'f003984af6466a03625ae1b386ad8977', 'f003984af6466a03625ae1b386ad8977', 'Marketing', ''),
(35, '35', 'rensy', '$2y$13$YLZ2jZXV7.chgPgQUEjFT.FfA7qqIcy2KH7rOBKYjcKY8Ta3PGJsa', '2022-06-20 08:44:38', '4210185c0564aaf8037de7b94c43a7a8', '4210185c0564aaf8037de7b94c43a7a8', 'Marketing', ''),
(37, '38', 'lita', '$2y$13$emfJHV4q8l89X92Em.rFsuSYexnlMaoq6/gRN/8yv4.Psg9hgVf36', '2022-06-20 08:46:50', '49412fd636fd83443f647ac65665c1d8', '49412fd636fd83443f647ac65665c1d8', 'Marketing', ''),
(38, '39', 'rachma', '$2y$13$FAoS8iKBVucOmn8y8RyPtOCK3vaTFyxrbnhHYQBTuLo6w3R4nEWHa', '2022-06-20 08:45:41', '2277f9f951eee414306e16a33591fa95', '2277f9f951eee414306e16a33591fa95', 'Marketing', ''),
(39, '40', 'bryan', '$2y$13$sAWfJ9yt/c2BwH.IZW2pPOuZNB0rf/CR1dRzt8pLY4POD6R0BVw82', '2022-06-20 09:03:17', '7d4ef62de50874a4db33e6da3ff79f75', '7d4ef62de50874a4db33e6da3ff79f75', 'Marketing', '');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `id_calculator`
--
ALTER TABLE `id_calculator`
  ADD PRIMARY KEY (`id`);

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
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `id_dailyreport`
--
ALTER TABLE `id_dailyreport`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `id_dashboard`
--
ALTER TABLE `id_dashboard`
  ADD PRIMARY KEY (`id`);

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
-- Indeks untuk tabel `id_purchase_order`
--
ALTER TABLE `id_purchase_order`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `id_purchase_order_paid`
--
ALTER TABLE `id_purchase_order_paid`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT untuk tabel `id_calculator`
--
ALTER TABLE `id_calculator`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `id_city`
--
ALTER TABLE `id_city`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT untuk tabel `id_customer`
--
ALTER TABLE `id_customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `id_dailyreport`
--
ALTER TABLE `id_dailyreport`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `id_dashboard`
--
ALTER TABLE `id_dashboard`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT untuk tabel `id_offer`
--
ALTER TABLE `id_offer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `id_offer_number`
--
ALTER TABLE `id_offer_number`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `id_purchase_order`
--
ALTER TABLE `id_purchase_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `id_purchase_order_paid`
--
ALTER TABLE `id_purchase_order_paid`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `id_user`
--
ALTER TABLE `id_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
