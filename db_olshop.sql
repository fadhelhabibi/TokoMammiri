-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 01, 2021 at 10:41 AM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_olshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_barang`
--

DROP TABLE IF EXISTS `tbl_barang`;
CREATE TABLE IF NOT EXISTS `tbl_barang` (
  `id_barang` int(11) NOT NULL AUTO_INCREMENT,
  `nama_barang` varchar(255) DEFAULT NULL,
  `id_kategori` int(11) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `deskripsi` mediumtext,
  `gambar` text,
  PRIMARY KEY (`id_barang`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_barang`
--

INSERT INTO `tbl_barang` (`id_barang`, `nama_barang`, `id_kategori`, `harga`, `deskripsi`, `gambar`) VALUES
(1, 'Pizza Keju', 1, 50000, 'deskripsi logo Indi Pizza', 'appetizer1.jpg'),
(11, 'Nasi Goreng Seafood', 14, 80000, 'asi goreng dengan aneka toping seafood', 'appetizer2.jpg'),
(12, 'Sandwitch', 17, 50000, 'roti lapis isi daging sayur dan lainnya', 'sendwitch.jpg'),
(13, 'Coffee', 15, 10000, 'kopi hitam dengan teste yang manis ', 'sendwitch1.jpg'),
(14, 'Teh Panas', 16, 12333, 'teh manis dengan aroma melati yang membuat anda lebih rilex', 'sendwitch3.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_gambar`
--

DROP TABLE IF EXISTS `tbl_gambar`;
CREATE TABLE IF NOT EXISTS `tbl_gambar` (
  `id_gambar` int(11) NOT NULL AUTO_INCREMENT,
  `id_barang` int(11) NOT NULL,
  `ket` varchar(255) DEFAULT NULL,
  `gambar` text,
  PRIMARY KEY (`id_gambar`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_gambar`
--

INSERT INTO `tbl_gambar` (`id_gambar`, `id_barang`, `ket`, `gambar`) VALUES
(1, 1, 'gambar 1', 'gambar (1).png'),
(2, 1, 'gambar 2', 'gambar (2).png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kategori`
--

DROP TABLE IF EXISTS `tbl_kategori`;
CREATE TABLE IF NOT EXISTS `tbl_kategori` (
  `id_kategori` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_kategori`
--

INSERT INTO `tbl_kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Pizza'),
(14, 'Makanan'),
(15, 'Minuman dingin'),
(16, 'Minuman panas'),
(17, 'Cemilan');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pelanggan`
--

DROP TABLE IF EXISTS `tbl_pelanggan`;
CREATE TABLE IF NOT EXISTS `tbl_pelanggan` (
  `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT,
  `nama_pelanggan` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` text,
  `foto` text,
  PRIMARY KEY (`id_pelanggan`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_pelanggan`
--

INSERT INTO `tbl_pelanggan` (`id_pelanggan`, `nama_pelanggan`, `email`, `password`, `foto`) VALUES
(1, 'fadhel', 'fadhel@okok.com', '1234', 'foto.jpg'),
(2, 'draken', 'draken@okok.com', '1234', 'foto1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rekening`
--

DROP TABLE IF EXISTS `tbl_rekening`;
CREATE TABLE IF NOT EXISTS `tbl_rekening` (
  `id_rekening` int(11) NOT NULL AUTO_INCREMENT,
  `nama_bank` varchar(25) DEFAULT NULL,
  `no_rek` varchar(25) DEFAULT NULL,
  `atas_nama` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id_rekening`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_rekening`
--

INSERT INTO `tbl_rekening` (`id_rekening`, `nama_bank`, `no_rek`, `atas_nama`) VALUES
(1, 'BRI', '1234-4321-1234-4321', 'Indi Pizza'),
(2, 'OVO', '0812345678910', 'Indi Pizza');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rinci_transaksi`
--

DROP TABLE IF EXISTS `tbl_rinci_transaksi`;
CREATE TABLE IF NOT EXISTS `tbl_rinci_transaksi` (
  `id_rinci` int(11) NOT NULL AUTO_INCREMENT,
  `no_order` varchar(25) DEFAULT NULL,
  `id_barang` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_rinci`)
) ENGINE=MyISAM AUTO_INCREMENT=54 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_rinci_transaksi`
--

INSERT INTO `tbl_rinci_transaksi` (`id_rinci`, `no_order`, `id_barang`, `qty`) VALUES
(53, '20210801TG40H78W', 1, 1),
(52, '20210730HNJUKQAD', 14, 5),
(51, '20210730U5S2X1YM', 1, 1),
(50, '20210729HE0GMCUC', 1, 10),
(49, '20210729HE0GMCUC', 11, 10),
(48, '20210729SHY8IKOF', 1, 10),
(47, '20210729SHY8IKOF', 11, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transaksi`
--

DROP TABLE IF EXISTS `tbl_transaksi`;
CREATE TABLE IF NOT EXISTS `tbl_transaksi` (
  `id_transaksi` int(11) NOT NULL AUTO_INCREMENT,
  `id_pelanggan` int(11) DEFAULT NULL,
  `no_order` varchar(255) NOT NULL,
  `tgl_order` date DEFAULT NULL,
  `nama_penerima` varchar(25) DEFAULT NULL,
  `nohp_penerima` varchar(25) DEFAULT NULL,
  `alamat` text,
  `grand_total` int(11) DEFAULT NULL,
  `total_bayar` int(11) DEFAULT NULL,
  `status_bayar` int(1) DEFAULT NULL,
  `bukti_bayar` text,
  `atas_nama` varchar(25) DEFAULT NULL,
  `nama_bank` varchar(25) DEFAULT NULL,
  `no_rek` varchar(25) DEFAULT NULL,
  `status_order` int(1) DEFAULT NULL,
  `no_resi` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id_transaksi`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=latin1 COMMENT='1';

--
-- Dumping data for table `tbl_transaksi`
--

INSERT INTO `tbl_transaksi` (`id_transaksi`, `id_pelanggan`, `no_order`, `tgl_order`, `nama_penerima`, `nohp_penerima`, `alamat`, `grand_total`, `total_bayar`, `status_bayar`, `bukti_bayar`, `atas_nama`, `nama_bank`, `no_rek`, `status_order`, `no_resi`) VALUES
(22, 1, '20210729SHY8IKOF', '2021-07-29', 'fadhel', '821123321', 'jl. vida view', 580000, NULL, 1, 'Bukti-Bayar2.jpeg', 'fadhel', 'BRI', '111111111111111111111', 3, NULL),
(23, 1, '20210729HE0GMCUC', '2021-07-29', 'ahmad', '0895805257422', 'jl. pangkep', 1300000, NULL, 1, 'Bukti-Bayar.jpeg', 'fadhel', 'BRI', '111111111111111111111', 1, NULL),
(24, 2, '20210730U5S2X1YM', '2021-07-30', 'draken', '089123332123123', 'jl. vida view', 50000, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL),
(25, 2, '20210730HNJUKQAD', '2021-07-30', 'fadhel', '0821123321', 'jl. vida view', 61665, NULL, 1, 'Bukti-Bayar1.jpeg', 'fadhel', 'asdasd', '111111111111111111111', 3, NULL),
(26, 1, '20210801TG40H78W', '2021-08-01', 'fadhel', '0821123321', 'jl. vida view', 50000, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

DROP TABLE IF EXISTS `tbl_user`;
CREATE TABLE IF NOT EXISTS `tbl_user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `nama_user` varchar(25) DEFAULT NULL,
  `username` varchar(25) DEFAULT NULL,
  `password` varchar(25) DEFAULT NULL,
  `level_user` int(1) DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `nama_user`, `username`, `password`, `level_user`) VALUES
(5, 'fadhel', 'fadhel', 'fadhel', 1),
(2, 'riyad', 'user', 'user', 2);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
