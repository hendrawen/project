-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 20, 2018 at 09:58 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `brajamarketindo`
--

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'members', 'General User');

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `login_attempts`
--

INSERT INTO `login_attempts` (`id`, `ip_address`, `login`, `time`) VALUES
(1, '127.0.0.1', 'admin@admin.com', 1521427063),
(2, '127.0.0.1', 'admin@admin.com', 1521427124);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(254) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES
(1, '127.0.0.1', 'administrator', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', 'admin@admin.com', '', NULL, NULL, NULL, 1268889823, 2018, 1, 'Admin', 'istrator', 'ADMIN', '0');

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE `users_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(2, 1, 2);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_piutang`
-- (See below for the actual view)
--
CREATE TABLE `v_piutang` (
`id` int(11)
,`id_pelanggan` varchar(45)
,`nama_pelanggan` varchar(125)
,`utang` varchar(45)
,`bayar` varchar(25)
,`id_transaksi` varchar(45)
,`tgl_transaksi` date
,`jatuh_tempo` date
,`sisa` double
,`selisih` int(7)
);

-- --------------------------------------------------------

--
-- Table structure for table `wp_asis_debt`
--

CREATE TABLE `wp_asis_debt` (
  `id` int(11) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `jam` time DEFAULT NULL,
  `turun_krat` int(11) DEFAULT NULL,
  `turun_btl` int(11) DEFAULT NULL,
  `naik_krat` int(11) DEFAULT NULL,
  `naik_btl` int(11) DEFAULT NULL,
  `aset_krat` int(11) DEFAULT NULL,
  `aset_btl` int(11) DEFAULT NULL,
  `bayar` int(11) DEFAULT NULL,
  `keterangan` text,
  `username` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `wp_barang`
--

CREATE TABLE `wp_barang` (
  `id` int(11) NOT NULL,
  `id_barang` varchar(45) DEFAULT NULL,
  `nama_barang` varchar(115) DEFAULT NULL,
  `harga_beli` varchar(25) DEFAULT NULL,
  `harga_jual` varchar(25) DEFAULT NULL,
  `wp_suplier_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wp_barang`
--

INSERT INTO `wp_barang` (`id`, `id_barang`, `nama_barang`, `harga_beli`, `harga_jual`, `wp_suplier_id`, `created_at`, `updated_at`) VALUES
(1, 'BR001', 'Saos 58', '60000', '65000', 30, '2018-03-08 04:28:14', '2018-03-15 06:07:30'),
(2, 'BR002', 'Kecap Manis', '50000', '60000', 33, '2018-03-08 07:45:53', '2018-03-15 06:07:53');

-- --------------------------------------------------------

--
-- Table structure for table `wp_debt_muat`
--

CREATE TABLE `wp_debt_muat` (
  `id` int(11) NOT NULL,
  `muat_krat` int(11) DEFAULT NULL,
  `muat_dust` int(11) DEFAULT NULL,
  `terkirim_krat` int(11) DEFAULT NULL,
  `terkirim_btl` int(11) DEFAULT NULL,
  `kembali_krat` int(11) DEFAULT NULL,
  `kembali_btl` int(11) DEFAULT NULL,
  `retur_krat` int(11) DEFAULT NULL,
  `keterangan` text,
  `created_at` date DEFAULT NULL,
  `username` varchar(45) DEFAULT NULL,
  `wp_barang_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `wp_debt_turun`
--

CREATE TABLE `wp_debt_turun` (
  `id` int(11) NOT NULL,
  `wp_barang_id` int(11) NOT NULL,
  `turun_krat` int(11) DEFAULT NULL,
  `turun_btl` int(11) DEFAULT NULL,
  `naik_krat` int(11) DEFAULT NULL,
  `naik_btl` int(11) DEFAULT NULL,
  `aset_krat` int(11) DEFAULT NULL,
  `aset_btl` int(11) DEFAULT NULL,
  `keterangan` text,
  `username` varchar(45) DEFAULT NULL,
  `wp_pelanggan_id` int(11) NOT NULL,
  `created_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `wp_detail_transaksi`
--

CREATE TABLE `wp_detail_transaksi` (
  `id` int(11) NOT NULL,
  `bayar` varchar(25) DEFAULT NULL,
  `utang` varchar(45) DEFAULT NULL,
  `id_transaksi` varchar(45) DEFAULT NULL,
  `created_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wp_detail_transaksi`
--

INSERT INTO `wp_detail_transaksi` (`id`, `bayar`, `utang`, `id_transaksi`, `created_at`) VALUES
(3, '20000', '65000', 'BM-2018-0011', '2018-03-18'),
(4, '0', '125000', 'BM-2018-0012', '2018-03-20'),
(5, '0', '65000', 'BM-2018-0013', '2018-03-20'),
(6, NULL, '60000', 'BM-2018-0014', '2018-03-20'),
(7, NULL, '325000', 'BM-2018-0015', '2018-03-20'),
(8, NULL, '195000', 'BM-2018-0017', '2018-03-20');

-- --------------------------------------------------------

--
-- Table structure for table `wp_faktur`
--

CREATE TABLE `wp_faktur` (
  `id` int(11) NOT NULL,
  `no_faktur` varchar(45) DEFAULT NULL,
  `tgl_faktur` date DEFAULT NULL,
  `jatuh_tempo` date DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `wp_detail_transaksi_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `wp_groups`
--

CREATE TABLE `wp_groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `wp_jabatan`
--

CREATE TABLE `wp_jabatan` (
  `id` int(11) NOT NULL,
  `nama_jabatan` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wp_jabatan`
--

INSERT INTO `wp_jabatan` (`id`, `nama_jabatan`) VALUES
(1, 'IT');

-- --------------------------------------------------------

--
-- Table structure for table `wp_jadwal`
--

CREATE TABLE `wp_jadwal` (
  `id` int(11) NOT NULL,
  `id_jadwal` varchar(45) DEFAULT NULL,
  `wp_barang_id` int(11) NOT NULL,
  `qty` int(11) DEFAULT NULL,
  `tgl_kirim` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `wp_jkebutuhan`
--

CREATE TABLE `wp_jkebutuhan` (
  `id` int(11) NOT NULL,
  `jenis` varchar(45) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wp_jkebutuhan`
--

INSERT INTO `wp_jkebutuhan` (`id`, `jenis`, `created_at`, `updated_at`) VALUES
(1, 'Kecap Pedas', '2018-03-03', '2018-03-03'),
(2, 'Kecap Manis', '2018-03-08', '2018-03-08'),
(3, 'Daging', '2018-03-11', NULL),
(4, 'Sayur', '2018-03-11', NULL),
(5, 'Manis', '2018-03-19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `wp_karyawan`
--

CREATE TABLE `wp_karyawan` (
  `id_karyawan` varchar(45) NOT NULL,
  `nama` varchar(115) DEFAULT NULL,
  `alamat` text,
  `no_telp` int(11) DEFAULT NULL,
  `photo` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `wp_jabatan_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wp_karyawan`
--

INSERT INTO `wp_karyawan` (`id_karyawan`, `nama`, `alamat`, `no_telp`, `photo`, `status`, `wp_jabatan_id`) VALUES
('KR001', 'Purjayadi', 'Beleka, Praya Timur', 8231212, 'default.jpg', 'Entah', 1);

-- --------------------------------------------------------

--
-- Table structure for table `wp_kebutuhan`
--

CREATE TABLE `wp_kebutuhan` (
  `id` int(11) NOT NULL,
  `wp_pelanggan_id` int(11) NOT NULL,
  `wp_jkebutuhan_id` int(11) NOT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `tgl` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wp_kebutuhan`
--

INSERT INTO `wp_kebutuhan` (`id`, `wp_pelanggan_id`, `wp_jkebutuhan_id`, `jumlah`, `tgl`) VALUES
(1, 1, 1, 100, '2018-03-03'),
(2, 5, 1, 12, '2018-03-08'),
(3, 4, 1, 40, '2018-04-11'),
(4, 5, 1, 12, '2018-03-08'),
(5, 5, 1, 60, '2018-03-09'),
(6, 4, 2, 50, '2018-03-09'),
(7, 4, 3, 70, '2018-03-11'),
(8, 4, 4, 100, '2018-03-11'),
(9, 4, 4, 3, '2018-03-16'),
(10, 5, 2, 6, '2018-03-16'),
(11, 5, 4, 100, '2018-03-19'),
(12, 5, 5, 1, '2018-03-19');

-- --------------------------------------------------------

--
-- Table structure for table `wp_krat_kosong`
--

CREATE TABLE `wp_krat_kosong` (
  `id` int(11) NOT NULL COMMENT '	',
  `krat` int(11) DEFAULT NULL,
  `botol` int(11) DEFAULT NULL,
  `keterangan` text,
  `username` varchar(45) DEFAULT NULL,
  `created_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `wp_laporan_arus`
--

CREATE TABLE `wp_laporan_arus` (
  `id` int(11) NOT NULL,
  `pendapatan` int(11) DEFAULT NULL,
  `pengeluaran` int(11) DEFAULT NULL,
  `setor_tunai` int(11) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `username` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `wp_list_effectif`
--

CREATE TABLE `wp_list_effectif` (
  `id` int(11) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `tgl_kirim` date DEFAULT NULL,
  `keterangan` text,
  `wp_status_effectif_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `wp_barang_id` int(11) NOT NULL,
  `wp_pelanggan_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `wp_pelanggan`
--

CREATE TABLE `wp_pelanggan` (
  `id` int(11) NOT NULL,
  `id_pelanggan` varchar(45) DEFAULT NULL,
  `nama_pelanggan` varchar(125) DEFAULT NULL,
  `no_telp` varchar(25) DEFAULT NULL,
  `nama_dagang` varchar(115) DEFAULT NULL,
  `alamat` text,
  `photo` varchar(115) DEFAULT NULL,
  `photo_toko` varchar(115) DEFAULT NULL,
  `kota` varchar(115) DEFAULT NULL,
  `kelurahan` varchar(115) DEFAULT NULL,
  `kecamatan` varchar(115) DEFAULT NULL,
  `lat` varchar(200) DEFAULT NULL,
  `long` varchar(45) DEFAULT NULL,
  `keterangan` text,
  `status` enum('Responden','Pelanggan') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `wp_karyawan_id_karyawan` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wp_pelanggan`
--

INSERT INTO `wp_pelanggan` (`id`, `id_pelanggan`, `nama_pelanggan`, `no_telp`, `nama_dagang`, `alamat`, `photo`, `photo_toko`, `kota`, `kelurahan`, `kecamatan`, `lat`, `long`, `keterangan`, `status`, `created_at`, `updated_at`, `wp_karyawan_id_karyawan`) VALUES
(1, 'PL-2018-0001', 'Ihsan', '082341901641', 'Bakso Keluarga', 'Jl. Panji Tilar No. 16', NULL, NULL, 'Mataram', 'Pagesangan', 'Pagesangan', '-7.025253', '107.519760', 'sasda', 'Responden', '2018-04-03 17:00:00', '2018-03-15 08:31:34', 'KR001'),
(4, 'PL-2018-0003', 'Hendro', '1424', 'Bakso Ceker DUA', 'asdasd', NULL, NULL, 'asdas', 'asdas', 'dasda', '-7.550676', '110.828316', 'asdasd', 'Responden', '2018-01-09 17:00:00', NULL, 'KR001'),
(5, 'PL-2018-0004', 'Pung', 'eqweq', 'PT. Sejahtera Abadi', 'eqweqwe', '8631824.jpg', 'hipwee-hipwee-kantung-1-750x422.jpg', 'qweqw', 'eqwe', 'qweqw', '-8.086410', '111.713127', 'qweqwe', 'Pelanggan', '2018-04-04 17:00:00', NULL, 'KR001'),
(6, 'PL-2018-0005', 'Ahmad', '082', 'Ahmad Sejahtera', 'Kuningan Selatan', '605726_620.jpg', 'download.jpeg', 'Bekasi', 'Depok', 'Kuningan', '-876182763', '231234434', 'qweqweqw', 'Pelanggan', '2018-03-12 04:11:06', NULL, 'KR001'),
(7, 'PL-2018-0006', 'Hidayah', '082', 'Bakso Hidayatullah', 'Jl. Bina Asih II', NULL, NULL, 'Bekasi', 'Jati Asih', 'Komesen', '10001', '-120982', 'asdasd', 'Responden', '2018-03-20 02:46:58', NULL, 'KR001');

-- --------------------------------------------------------

--
-- Table structure for table `wp_profile`
--

CREATE TABLE `wp_profile` (
  `id` int(11) NOT NULL,
  `nama_perusahaan` varchar(45) DEFAULT NULL,
  `alamat` text,
  `no_telp` varchar(25) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `website` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wp_profile`
--

INSERT INTO `wp_profile` (`id`, `nama_perusahaan`, `alamat`, `no_telp`, `email`, `website`) VALUES
(1, 'Braja Marketindo', 'Jl. Lotus timur, RSO 12 Blok D', '082341901641', 'info@brajamarketindo.com', 'http://brajamarketindo.id');

-- --------------------------------------------------------

--
-- Table structure for table `wp_rekapfaktur`
--

CREATE TABLE `wp_rekapfaktur` (
  `id` int(11) NOT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `bayar` int(11) DEFAULT NULL,
  `keterangan` varchar(115) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `wp_faktur_id` int(11) NOT NULL,
  `wp_pelanggan_id` int(11) NOT NULL,
  `wp_barang_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `wp_status`
--

CREATE TABLE `wp_status` (
  `id` int(11) NOT NULL,
  `nama_status` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wp_status`
--

INSERT INTO `wp_status` (`id`, `nama_status`) VALUES
(1, 'Lunas'),
(2, 'Hutang');

-- --------------------------------------------------------

--
-- Table structure for table `wp_status_effectif`
--

CREATE TABLE `wp_status_effectif` (
  `id` int(11) NOT NULL,
  `status` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `wp_stok`
--

CREATE TABLE `wp_stok` (
  `id` int(11) NOT NULL,
  `wp_barang_id` int(11) NOT NULL,
  `stok` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wp_stok`
--

INSERT INTO `wp_stok` (`id`, `wp_barang_id`, `stok`, `updated_at`) VALUES
(1, 2, 100, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `wp_suplier`
--

CREATE TABLE `wp_suplier` (
  `id` int(11) NOT NULL,
  `id_suplier` varchar(45) DEFAULT NULL,
  `nama_suplier` varchar(115) DEFAULT NULL,
  `alamat` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wp_suplier`
--

INSERT INTO `wp_suplier` (`id`, `id_suplier`, `nama_suplier`, `alamat`) VALUES
(1, 'SP0000', 'Cinta', 'Antara Dian dan Hendra'),
(2, 'SP0000', 'Cinta', 'Antara Dian dan Hendra'),
(3, 'SP0000', 'Cinta', 'Antara Dian dan Hendra'),
(4, 'SP0000', 'Cinta', 'Antara Dian dan Hendra'),
(5, 'SP0000', 'Cinta', 'Antara Dian dan Hendra'),
(6, 'SP0000', 'Cinta', 'Antara Dian dan Hendra'),
(7, 'SP0000', 'Cinta', 'Antara Dian dan Hendra'),
(8, 'SP0000', 'Cinta', 'Antara Dian dan Hendra'),
(9, 'SP0000', 'Cinta', 'Antara Dian dan Hendra'),
(10, 'SP0000', 'Cinta', 'Antara Dian dan Hendra'),
(11, 'SP0000', 'Cinta', 'Antara Dian dan Hendra'),
(12, 'SP0000', 'Cinta', 'Antara Dian dan Hendra'),
(13, 'SP0000', 'Cinta', 'Antara Dian dan Hendra'),
(14, 'SP0000', 'Cinta', 'Antara Dian dan Hendra'),
(15, 'SP0000', 'Cinta', 'Antara Dian dan Hendra'),
(16, 'SP0000', 'Cinta', 'Antara Dian dan Hendra'),
(17, 'SP001', 'asdsa', 'dasdasd'),
(18, 'SP002', 'asdas', 'dasdsd'),
(19, 'SP003', NULL, 'asdasd'),
(20, 'SP004', NULL, 'asda'),
(21, 'SP005', NULL, 'sdasdas'),
(22, 'SP006', NULL, 'asdasd'),
(23, 'SP007', NULL, 'dasdasd'),
(24, 'SP008', NULL, 'asdas'),
(25, 'SP009', NULL, 'dasd'),
(26, 'SP010', NULL, 'asddasda'),
(27, 'SP011', NULL, 'asdasd'),
(28, 'SP012', NULL, 'dasda'),
(29, 'SP013', NULL, 'sdasd'),
(30, 'SP014', 'asda', 'sdasd'),
(31, 'SP015', 'asdas', 'dasdasdasd'),
(32, 'SP016', 'asdas', 'dasdasd'),
(33, 'SP017', 'asdas', 'dasdasd');

-- --------------------------------------------------------

--
-- Table structure for table `wp_transaksi`
--

CREATE TABLE `wp_transaksi` (
  `id` int(11) NOT NULL,
  `id_transaksi` varchar(45) DEFAULT NULL,
  `wp_barang_id` int(11) NOT NULL,
  `harga` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `subtotal` int(11) NOT NULL,
  `tgl_transaksi` date DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `wp_pelanggan_id` int(11) NOT NULL,
  `username` varchar(45) DEFAULT NULL,
  `wp_status_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wp_transaksi`
--

INSERT INTO `wp_transaksi` (`id`, `id_transaksi`, `wp_barang_id`, `harga`, `qty`, `subtotal`, `tgl_transaksi`, `updated_at`, `wp_pelanggan_id`, `username`, `wp_status_id`) VALUES
(7, 'BM-2018-0001', 1, 65000, 1, 65000, '2018-03-20', NULL, 5, NULL, 1),
(8, 'BM-2018-0001', 1, 65000, 1, 60000, '2018-03-20', NULL, 5, NULL, 1),
(9, 'BM-2018-0002', 2, 60000, 1, 60000, '2018-03-20', NULL, 5, NULL, 2),
(10, 'BM-2018-0002', 2, 60000, 7, 455000, '2018-03-20', NULL, 5, NULL, 2),
(11, 'BM-2018-0003', 2, 60000, 2, 120000, '2018-03-20', NULL, 5, NULL, 2),
(12, 'BM-2018-0003', 2, 60000, 1, 65000, '2018-03-20', NULL, 5, NULL, 2),
(13, 'BM-2018-0004', 1, 65000, 1, 65000, '2018-03-20', NULL, 1, NULL, 1),
(14, 'BM-2018-0004', 1, 65000, 100, 6000000, '2018-03-20', NULL, 1, NULL, 1),
(15, 'BM-2018-0005', 2, 60000, 1, 60000, '2018-03-20', NULL, 5, NULL, 1),
(16, 'BM-2018-0005', 1, 60000, 1, 65000, '2018-03-20', NULL, 5, NULL, 1),
(17, 'BM-2018-0006', 1, 65000, 1, 65000, '2018-03-20', NULL, 4, NULL, 1),
(18, 'BM-2018-0006', 2, 65000, 1, 60000, '2018-03-20', NULL, 4, NULL, 1),
(19, 'BM-2018-0007', 1, 65000, 1, 65000, '2018-03-20', NULL, 6, NULL, 1),
(20, 'BM-2018-0008', 1, 65000, 1, 65000, '2018-03-20', NULL, 5, NULL, 1),
(21, 'BM-2018-0009', 1, 65000, 1, 65000, '2018-03-20', NULL, 1, NULL, 2),
(22, 'BM-2018-0009', 2, 65000, 1, 60000, '2018-03-20', NULL, 1, NULL, 2),
(23, 'BM-2018-0010', 2, 60000, 1, 60000, '2018-03-20', NULL, 4, NULL, 1),
(24, 'BM-2018-0011', 1, 65000, 1, 65000, '2018-03-20', NULL, 4, NULL, 2),
(25, 'BM-2018-0012', 1, 65000, 1, 65000, '2018-03-20', NULL, 4, NULL, 2),
(26, 'BM-2018-0012', 2, 65000, 1, 60000, '2018-03-20', NULL, 4, NULL, 2),
(27, 'BM-2018-0013', 1, 65000, 1, 65000, '2018-03-20', NULL, 4, NULL, 2),
(28, 'BM-2018-0014', 2, 60000, 1, 60000, '2018-03-20', NULL, 6, NULL, 2),
(29, 'BM-2018-0015', 1, 65000, 5, 325000, '2018-03-20', NULL, 4, NULL, 2),
(30, 'BM-2018-0016', 2, 60000, 3, 180000, '2018-03-20', NULL, 4, NULL, 1),
(31, 'BM-2018-0016', 1, 60000, 1, 65000, '2018-03-20', NULL, 4, NULL, 1),
(32, 'BM-2018-0017', 1, 65000, 3, 195000, '2018-03-20', NULL, 6, NULL, 2);

-- --------------------------------------------------------

--
-- Stand-in structure for view `wp_vkebutuhan`
-- (See below for the actual view)
--
CREATE TABLE `wp_vkebutuhan` (
`id_pelanggan` varchar(45)
,`nama_pelanggan` varchar(125)
,`no_telp` varchar(25)
,`jenis` varchar(45)
,`jumlah` int(11)
,`tgl` date
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `wp_vpelanggan`
-- (See below for the actual view)
--
CREATE TABLE `wp_vpelanggan` (
`id` int(11)
,`id_pelanggan` varchar(45)
,`nama_pelanggan` varchar(125)
,`no_telp` varchar(25)
,`nama_dagang` varchar(115)
,`alamat` text
,`photo` varchar(115)
,`photo_toko` varchar(115)
,`kota` varchar(115)
,`kelurahan` varchar(115)
,`kecamatan` varchar(115)
,`lat` varchar(200)
,`long` varchar(45)
,`keterangan` text
,`status` enum('Responden','Pelanggan')
,`nama` varchar(115)
,`created_at` timestamp
);

-- --------------------------------------------------------

--
-- Structure for view `v_piutang`
--
DROP TABLE IF EXISTS `v_piutang`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_piutang`  AS  select `wp_detail_transaksi`.`id` AS `id`,`wp_pelanggan`.`id_pelanggan` AS `id_pelanggan`,`wp_pelanggan`.`nama_pelanggan` AS `nama_pelanggan`,`wp_detail_transaksi`.`utang` AS `utang`,`wp_detail_transaksi`.`bayar` AS `bayar`,`wp_transaksi`.`id_transaksi` AS `id_transaksi`,`wp_detail_transaksi`.`created_at` AS `tgl_transaksi`,(`wp_detail_transaksi`.`created_at` + interval 14 day) AS `jatuh_tempo`,(`wp_detail_transaksi`.`utang` - `wp_detail_transaksi`.`bayar`) AS `sisa`,(to_days((`wp_detail_transaksi`.`created_at` + interval 14 day)) - to_days(curdate())) AS `selisih` from ((`wp_detail_transaksi` join `wp_transaksi`) join `wp_pelanggan`) where ((convert(`wp_detail_transaksi`.`id_transaksi` using utf8) = `wp_transaksi`.`id_transaksi`) and (`wp_transaksi`.`wp_pelanggan_id` = `wp_pelanggan`.`id`)) group by `wp_detail_transaksi`.`id_transaksi` ;

-- --------------------------------------------------------

--
-- Structure for view `wp_vkebutuhan`
--
DROP TABLE IF EXISTS `wp_vkebutuhan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `wp_vkebutuhan`  AS  select `wp_pelanggan`.`id_pelanggan` AS `id_pelanggan`,`wp_pelanggan`.`nama_pelanggan` AS `nama_pelanggan`,`wp_pelanggan`.`no_telp` AS `no_telp`,`wp_jkebutuhan`.`jenis` AS `jenis`,`wp_kebutuhan`.`jumlah` AS `jumlah`,`wp_kebutuhan`.`tgl` AS `tgl` from ((`wp_pelanggan` join `wp_jkebutuhan`) join `wp_kebutuhan`) where ((`wp_kebutuhan`.`wp_pelanggan_id` = `wp_pelanggan`.`id`) and (`wp_kebutuhan`.`wp_jkebutuhan_id` = `wp_jkebutuhan`.`id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `wp_vpelanggan`
--
DROP TABLE IF EXISTS `wp_vpelanggan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `wp_vpelanggan`  AS  select `wp_pelanggan`.`id` AS `id`,`wp_pelanggan`.`id_pelanggan` AS `id_pelanggan`,`wp_pelanggan`.`nama_pelanggan` AS `nama_pelanggan`,`wp_pelanggan`.`no_telp` AS `no_telp`,`wp_pelanggan`.`nama_dagang` AS `nama_dagang`,`wp_pelanggan`.`alamat` AS `alamat`,`wp_pelanggan`.`photo` AS `photo`,`wp_pelanggan`.`photo_toko` AS `photo_toko`,`wp_pelanggan`.`kota` AS `kota`,`wp_pelanggan`.`kelurahan` AS `kelurahan`,`wp_pelanggan`.`kecamatan` AS `kecamatan`,`wp_pelanggan`.`lat` AS `lat`,`wp_pelanggan`.`long` AS `long`,`wp_pelanggan`.`keterangan` AS `keterangan`,`wp_pelanggan`.`status` AS `status`,`wp_karyawan`.`nama` AS `nama`,`wp_pelanggan`.`created_at` AS `created_at` from (`wp_pelanggan` join `wp_karyawan`) where (`wp_karyawan`.`id_karyawan` = `wp_pelanggan`.`wp_karyawan_id_karyawan`) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  ADD KEY `fk_users_groups_users1_idx` (`user_id`),
  ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- Indexes for table `wp_asis_debt`
--
ALTER TABLE `wp_asis_debt`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wp_barang`
--
ALTER TABLE `wp_barang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_wp_barang_wp_suplier1_idx` (`wp_suplier_id`);

--
-- Indexes for table `wp_debt_muat`
--
ALTER TABLE `wp_debt_muat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_wp_debt_muat_wp_barang1_idx` (`wp_barang_id`);

--
-- Indexes for table `wp_debt_turun`
--
ALTER TABLE `wp_debt_turun`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_wp_aset_wp_barang1_idx` (`wp_barang_id`),
  ADD KEY `fk_wp_debt_turun_wp_pelanggan1_idx` (`wp_pelanggan_id`);

--
-- Indexes for table `wp_detail_transaksi`
--
ALTER TABLE `wp_detail_transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wp_faktur`
--
ALTER TABLE `wp_faktur`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_wp_faktur_wp_detail_transaksi1_idx` (`wp_detail_transaksi_id`);

--
-- Indexes for table `wp_groups`
--
ALTER TABLE `wp_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wp_jabatan`
--
ALTER TABLE `wp_jabatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wp_jadwal`
--
ALTER TABLE `wp_jadwal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_wp_jadwal_wp_barang1_idx` (`wp_barang_id`);

--
-- Indexes for table `wp_jkebutuhan`
--
ALTER TABLE `wp_jkebutuhan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wp_karyawan`
--
ALTER TABLE `wp_karyawan`
  ADD PRIMARY KEY (`id_karyawan`),
  ADD KEY `fk_wp_karyawan_wp_jabatan1_idx` (`wp_jabatan_id`);

--
-- Indexes for table `wp_kebutuhan`
--
ALTER TABLE `wp_kebutuhan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_wp_kebutuhan_wp_pelanggan1_idx` (`wp_pelanggan_id`),
  ADD KEY `fk_wp_kebutuhan_wp_jkebutuhan1_idx` (`wp_jkebutuhan_id`);

--
-- Indexes for table `wp_krat_kosong`
--
ALTER TABLE `wp_krat_kosong`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wp_laporan_arus`
--
ALTER TABLE `wp_laporan_arus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wp_list_effectif`
--
ALTER TABLE `wp_list_effectif`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_wp_list_effectif_wp_barang1_idx` (`wp_barang_id`),
  ADD KEY `fk_wp_list_effectif_wp_pelanggan1_idx` (`wp_pelanggan_id`),
  ADD KEY `fk_wp_list_effectif_wp_status_effectif1_idx` (`wp_status_effectif_id`);

--
-- Indexes for table `wp_pelanggan`
--
ALTER TABLE `wp_pelanggan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_wp_pelanggan_wp_karyawan1_idx` (`wp_karyawan_id_karyawan`);

--
-- Indexes for table `wp_profile`
--
ALTER TABLE `wp_profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wp_rekapfaktur`
--
ALTER TABLE `wp_rekapfaktur`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_wp_rekapfaktur_wp_faktur1_idx` (`wp_faktur_id`),
  ADD KEY `fk_wp_rekapfaktur_wp_pelanggan1_idx` (`wp_pelanggan_id`),
  ADD KEY `fk_wp_rekapfaktur_wp_barang1_idx` (`wp_barang_id`);

--
-- Indexes for table `wp_status`
--
ALTER TABLE `wp_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wp_status_effectif`
--
ALTER TABLE `wp_status_effectif`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wp_stok`
--
ALTER TABLE `wp_stok`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_wp_stok_wp_barang1_idx` (`wp_barang_id`);

--
-- Indexes for table `wp_suplier`
--
ALTER TABLE `wp_suplier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wp_transaksi`
--
ALTER TABLE `wp_transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_wp_transaksi_wp_barang1_idx` (`wp_barang_id`),
  ADD KEY `fk_wp_transaksi_wp_pelanggan1_idx` (`wp_pelanggan_id`),
  ADD KEY `fk_wp_transaksi_wp_status1_idx` (`wp_status_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `wp_asis_debt`
--
ALTER TABLE `wp_asis_debt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wp_barang`
--
ALTER TABLE `wp_barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `wp_debt_muat`
--
ALTER TABLE `wp_debt_muat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wp_debt_turun`
--
ALTER TABLE `wp_debt_turun`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wp_detail_transaksi`
--
ALTER TABLE `wp_detail_transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `wp_faktur`
--
ALTER TABLE `wp_faktur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wp_groups`
--
ALTER TABLE `wp_groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wp_jabatan`
--
ALTER TABLE `wp_jabatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `wp_jadwal`
--
ALTER TABLE `wp_jadwal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wp_jkebutuhan`
--
ALTER TABLE `wp_jkebutuhan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `wp_kebutuhan`
--
ALTER TABLE `wp_kebutuhan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `wp_krat_kosong`
--
ALTER TABLE `wp_krat_kosong`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '	';

--
-- AUTO_INCREMENT for table `wp_laporan_arus`
--
ALTER TABLE `wp_laporan_arus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wp_list_effectif`
--
ALTER TABLE `wp_list_effectif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wp_pelanggan`
--
ALTER TABLE `wp_pelanggan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `wp_profile`
--
ALTER TABLE `wp_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `wp_rekapfaktur`
--
ALTER TABLE `wp_rekapfaktur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wp_status`
--
ALTER TABLE `wp_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `wp_stok`
--
ALTER TABLE `wp_stok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `wp_suplier`
--
ALTER TABLE `wp_suplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `wp_transaksi`
--
ALTER TABLE `wp_transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `wp_barang`
--
ALTER TABLE `wp_barang`
  ADD CONSTRAINT `fk_wp_barang_wp_suplier1` FOREIGN KEY (`wp_suplier_id`) REFERENCES `wp_suplier` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `wp_debt_muat`
--
ALTER TABLE `wp_debt_muat`
  ADD CONSTRAINT `fk_wp_debt_muat_wp_barang1` FOREIGN KEY (`wp_barang_id`) REFERENCES `wp_barang` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `wp_debt_turun`
--
ALTER TABLE `wp_debt_turun`
  ADD CONSTRAINT `fk_wp_aset_wp_barang1` FOREIGN KEY (`wp_barang_id`) REFERENCES `wp_barang` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_wp_debt_turun_wp_pelanggan1` FOREIGN KEY (`wp_pelanggan_id`) REFERENCES `wp_pelanggan` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `wp_faktur`
--
ALTER TABLE `wp_faktur`
  ADD CONSTRAINT `fk_wp_faktur_wp_detail_transaksi1` FOREIGN KEY (`wp_detail_transaksi_id`) REFERENCES `wp_detail_transaksi` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `wp_jadwal`
--
ALTER TABLE `wp_jadwal`
  ADD CONSTRAINT `fk_wp_jadwal_wp_barang1` FOREIGN KEY (`wp_barang_id`) REFERENCES `wp_barang` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `wp_karyawan`
--
ALTER TABLE `wp_karyawan`
  ADD CONSTRAINT `fk_wp_karyawan_wp_jabatan1` FOREIGN KEY (`wp_jabatan_id`) REFERENCES `wp_jabatan` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `wp_kebutuhan`
--
ALTER TABLE `wp_kebutuhan`
  ADD CONSTRAINT `fk_wp_kebutuhan_wp_jkebutuhan1` FOREIGN KEY (`wp_jkebutuhan_id`) REFERENCES `wp_jkebutuhan` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_wp_kebutuhan_wp_pelanggan1` FOREIGN KEY (`wp_pelanggan_id`) REFERENCES `wp_pelanggan` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `wp_list_effectif`
--
ALTER TABLE `wp_list_effectif`
  ADD CONSTRAINT `fk_wp_list_effectif_wp_barang1` FOREIGN KEY (`wp_barang_id`) REFERENCES `wp_barang` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_wp_list_effectif_wp_pelanggan1` FOREIGN KEY (`wp_pelanggan_id`) REFERENCES `wp_pelanggan` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_wp_list_effectif_wp_status_effectif1` FOREIGN KEY (`wp_status_effectif_id`) REFERENCES `wp_status_effectif` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `wp_pelanggan`
--
ALTER TABLE `wp_pelanggan`
  ADD CONSTRAINT `fk_wp_pelanggan_wp_karyawan1` FOREIGN KEY (`wp_karyawan_id_karyawan`) REFERENCES `wp_karyawan` (`id_karyawan`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `wp_rekapfaktur`
--
ALTER TABLE `wp_rekapfaktur`
  ADD CONSTRAINT `fk_wp_rekapfaktur_wp_barang1` FOREIGN KEY (`wp_barang_id`) REFERENCES `wp_barang` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_wp_rekapfaktur_wp_faktur1` FOREIGN KEY (`wp_faktur_id`) REFERENCES `wp_faktur` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_wp_rekapfaktur_wp_pelanggan1` FOREIGN KEY (`wp_pelanggan_id`) REFERENCES `wp_pelanggan` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `wp_stok`
--
ALTER TABLE `wp_stok`
  ADD CONSTRAINT `fk_wp_stok_wp_barang1` FOREIGN KEY (`wp_barang_id`) REFERENCES `wp_barang` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `wp_transaksi`
--
ALTER TABLE `wp_transaksi`
  ADD CONSTRAINT `fk_wp_transaksi_wp_barang1` FOREIGN KEY (`wp_barang_id`) REFERENCES `wp_barang` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_wp_transaksi_wp_pelanggan1` FOREIGN KEY (`wp_pelanggan_id`) REFERENCES `wp_pelanggan` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_wp_transaksi_wp_status1` FOREIGN KEY (`wp_status_id`) REFERENCES `wp_status` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
