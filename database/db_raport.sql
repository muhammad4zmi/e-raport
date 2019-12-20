-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 21, 2018 at 11:32 PM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_raport`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `username` varchar(40) NOT NULL,
  `pass1` varchar(40) NOT NULL,
  `pass2` varchar(40) NOT NULL,
  `email` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `pass1`, `pass2`, `email`) VALUES
('admin', 'admin', 'admin', 'muhammad.azmi@students.amikom.ac.id');

-- --------------------------------------------------------

--
-- Table structure for table `akun`
--

CREATE TABLE IF NOT EXISTS `akun` (
  `username` varchar(15) NOT NULL,
  `password` varchar(50) NOT NULL,
  `password2` varchar(50) NOT NULL,
  `email` text NOT NULL,
  `nis` varchar(10) NOT NULL,
  `status` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=ascii;

--
-- Dumping data for table `akun`
--

INSERT INTO `akun` (`username`, `password`, `password2`, `email`, `nis`, `status`) VALUES
('111', 'cb0f60f353a03b04ec5993e52457345b', '81KFFvBXFqg=', 'anandaghea27@gmail.com', '111', 1),
('123', 'eb1e08840f1a582c0f0d8c3d0957ae97', 'DJyvTrVFvEc=', 'haekal@gmail.com', '123', 0),
('133', '1d4e51c76611c9c019dcfc4e54a93fea', 'j5/MM3qVIs8=', 'muhammad4zmi@gmail.com', '133', 1);

-- --------------------------------------------------------

--
-- Table structure for table `bantuan`
--

CREATE TABLE IF NOT EXISTS `bantuan` (
  `nis` int(11) NOT NULL,
  `nama_siswa` varchar(30) NOT NULL,
  `gender` char(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bantuan`
--

INSERT INTO `bantuan` (`nis`, `nama_siswa`, `gender`) VALUES
(111, 'Siti Hijratul Jihadah', 'P'),
(123, 'Arif', 'P'),
(133, 'Muhammad Azmi', 'L');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

CREATE TABLE IF NOT EXISTS `jadwal` (
  `id` int(11) NOT NULL,
  `nip` int(11) DEFAULT NULL,
  `kd_mapel` char(10) DEFAULT NULL,
  `id_kelas` char(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `presensi`
--

CREATE TABLE IF NOT EXISTS `presensi` (
  `id` int(11) NOT NULL,
  `alfa` int(11) DEFAULT NULL,
  `izin` int(11) DEFAULT NULL,
  `sakit` int(11) DEFAULT NULL,
  `akhlak` char(2) DEFAULT NULL,
  `pribadi` char(2) DEFAULT NULL,
  `id_kelas` char(10) DEFAULT NULL,
  `semester` varchar(50) DEFAULT NULL,
  `nis` int(11) DEFAULT NULL,
  `pesan_wali` varchar(300) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `presensi`
--

INSERT INTO `presensi` (`id`, `alfa`, `izin`, `sakit`, `akhlak`, `pribadi`, `id_kelas`, `semester`, `nis`, `pesan_wali`) VALUES
(1, 1, 1, 1, '1', '1', '8A', 'Ganjil', 111, 'Rajin-rajin supaya pintar dan jangan lupa makan daging kambing dengan sayur kol !!');

-- --------------------------------------------------------

--
-- Table structure for table `rapot`
--

CREATE TABLE IF NOT EXISTS `rapot` (
  `id_raport` int(11) NOT NULL,
  `nis` int(11) DEFAULT NULL,
  `kd_mapel` char(10) DEFAULT NULL,
  `nilai` decimal(10,0) DEFAULT NULL,
  `keterangan` varchar(50) NOT NULL,
  `ket_nilai` text,
  `deskripsi` text,
  `semester` char(10) DEFAULT NULL,
  `id_kelas` char(10) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rapot`
--

INSERT INTO `rapot` (`id_raport`, `nis`, `kd_mapel`, `nilai`, `keterangan`, `ket_nilai`, `deskripsi`, `semester`, `id_kelas`) VALUES
(1, 111, 'MP001', '88', '', 'delapan puluh delapan', 'Sangat Memuaskan dan Memenuhi KKM', 'Ganjil', '8A'),
(2, 111, 'MP002', '83', '', 'delapan puluh tiga', 'Sangat Memuaskan dan Memenuhi KKM', 'Ganjil', '8A'),
(3, 111, 'MP003', '89', '', 'delapan puluh sembilan', 'Sangat Memuaskan dan Memenuhi KKM', 'Ganjil', '8A'),
(4, 111, 'MP004', '90', '', 'sembilan puluh', 'Sangat Memuaskan dan Memenuhi KKM', 'Ganjil', '8A');

-- --------------------------------------------------------

--
-- Table structure for table `rekap_nilai`
--

CREATE TABLE IF NOT EXISTS `rekap_nilai` (
  `id_rekap` int(11) NOT NULL,
  `nis` int(11) DEFAULT NULL,
  `kd_mapel` char(10) DEFAULT NULL,
  `nip` int(11) DEFAULT NULL,
  `nilai_harian` int(11) DEFAULT NULL,
  `nilai_mid` int(11) DEFAULT NULL,
  `nilai_uas` int(11) DEFAULT NULL,
  `id_kelas` char(10) DEFAULT NULL,
  `semester` char(10) DEFAULT NULL,
  `kkm` decimal(10,0) DEFAULT NULL,
  `nilai_akhir` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rekap_nilai`
--

INSERT INTO `rekap_nilai` (`id_rekap`, `nis`, `kd_mapel`, `nip`, `nilai_harian`, `nilai_mid`, `nilai_uas`, `id_kelas`, `semester`, `kkm`, `nilai_akhir`) VALUES
(23, 111, 'MP001', 8988, 90, 90, 85, '8A', 'Ganjil', '75', '88'),
(24, 133, 'MP001', 8988, 90, 75, 89, '8A', 'Ganjil', '75', '85'),
(25, 111, 'MP002', 77878, 90, 90, 70, '8A', 'Ganjil', '70', '83'),
(26, 133, 'MP002', 77878, 70, 89, 65, '8A', 'Ganjil', '70', '75'),
(27, 111, 'MP003', 8988, 90, 98, 79, '8A', 'Ganjil', '65', '89'),
(28, 133, 'MP003', 8988, 80, 90, 89, '8A', 'Ganjil', '65', '86'),
(29, 111, 'MP004', 8988, 90, 90, 90, '8A', 'Ganjil', '70', '90'),
(30, 133, 'MP004', 8988, 90, 90, 90, '8A', 'Ganjil', '70', '90');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_guru`
--

CREATE TABLE IF NOT EXISTS `tbl_guru` (
  `nip` int(11) NOT NULL,
  `nama_guru` varchar(45) DEFAULT NULL,
  `jk` varchar(10) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `agama` varchar(10) DEFAULT NULL,
  `alamat` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_guru`
--

INSERT INTO `tbl_guru` (`nip`, `nama_guru`, `jk`, `tgl_lahir`, `agama`, `alamat`) VALUES
(8988, 'Muhammad Azmi, S.Kom', 'Laki-Laki', '2016-02-10', 'Islam', 'Mataram'),
(77878, 'DindaQ', 'Laki-Laki', '2016-02-10', 'Islam', 'erewr'),
(123456, 'Test', 'Laki-Laki', '2016-02-11', 'Islam', 'Mataram'),
(445456, 'tfytryrty', 'Laki-Laki', '2017-04-18', 'Islam', 'fthfghfghfgh'),
(1213445, 'Udin', 'Laki-Laki', '2016-02-09', 'Islam', 'Sakra'),
(123456789, 'Coba Coba', 'Laki-Laki', '2016-02-09', 'Islam', 'Selong');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_help`
--

CREATE TABLE IF NOT EXISTS `tbl_help` (
  `id` int(11) NOT NULL,
  `id_kelas` char(50) DEFAULT NULL,
  `kd_kelas` char(50) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_help`
--

INSERT INTO `tbl_help` (`id`, `id_kelas`, `kd_kelas`) VALUES
(1, '7A', 'VII'),
(2, '7B', 'VII'),
(3, '7C', 'VII'),
(4, '7D', 'VII'),
(5, '7E', 'VII'),
(6, '7F', 'VII'),
(7, '8A', 'VIII'),
(8, '8B', 'VIII'),
(9, '8C', 'VIII'),
(10, '8D', 'VIII'),
(11, '8E', 'VIII'),
(12, '8F', 'VIII'),
(13, '8G', 'VIII'),
(14, '7G', 'VII'),
(15, '9A', 'IX'),
(16, '9B', 'IX'),
(17, '9C', 'IX'),
(18, '9D', 'IX'),
(19, '9E', 'IX'),
(20, '9F', 'IX'),
(21, '9G', 'IX');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_info`
--

CREATE TABLE IF NOT EXISTS `tbl_info` (
  `id_info` int(11) NOT NULL,
  `judul` varchar(50) DEFAULT '0',
  `isi` text,
  `tgl_post` date DEFAULT NULL,
  `tipe` varchar(50) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_info`
--

INSERT INTO `tbl_info` (`id_info`, `judul`, `isi`, `tgl_post`, `tipe`) VALUES
(16, 'sadasdsd', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2017-04-19', 'Pengumuman'),
(18, 'Sambutan', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum\r\n', '2017-05-04', 'Sambutan'),
(19, 'Info Naik Kelas', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\n', '2017-05-04', 'Pengumuman'),
(20, 'Tesr', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\n', '2017-05-04', 'Pengumuman');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kelas`
--

CREATE TABLE IF NOT EXISTS `tbl_kelas` (
  `id` int(11) NOT NULL,
  `id_kelas` char(10) NOT NULL,
  `kd_kelas` char(50) DEFAULT NULL,
  `kelas` varchar(45) DEFAULT NULL,
  `nis` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_kelas`
--

INSERT INTO `tbl_kelas` (`id`, `id_kelas`, `kd_kelas`, `kelas`, `nis`) VALUES
(2, '8A', 'VIII', 'VIIIA', 111),
(3, '8A', 'VIII', 'VIIIA', 133),
(4, '7A', 'VII', 'VIIA', 123),
(5, '7A', 'VII', 'VIIA', 112);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_mapel`
--

CREATE TABLE IF NOT EXISTS `tbl_mapel` (
  `kd_mapel` char(10) NOT NULL,
  `nama_mapel` varchar(45) DEFAULT NULL,
  `nip` int(11) DEFAULT NULL,
  `id_kelas` char(10) DEFAULT NULL,
  `kkm` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_mapel`
--

INSERT INTO `tbl_mapel` (`kd_mapel`, `nama_mapel`, `nip`, `id_kelas`, `kkm`) VALUES
('MP001', 'Biologi Peminatan', 8988, '8A', 75),
('MP002', 'Matematika', 77878, '8A', 70),
('MP003', 'Fisika', 8988, '8A', 65),
('MP004', 'Terpadu', 8988, '8A', 70),
('MP005', 'BIologi', 123456, '7A', 80),
('MP006', 'Matematika', 8988, '7A', 65);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_nilai`
--

CREATE TABLE IF NOT EXISTS `tbl_nilai` (
  `id_nilai` int(11) NOT NULL,
  `nis` int(11) DEFAULT NULL,
  `id_kelas` char(10) DEFAULT NULL,
  `semester` varchar(50) DEFAULT NULL,
  `total_nilai` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_nilai`
--

INSERT INTO `tbl_nilai` (`id_nilai`, `nis`, `id_kelas`, `semester`, `total_nilai`) VALUES
(6, 111, '8A', 'Genap', '95'),
(8, 133, '8A', 'Genap', '350'),
(12, 133, '8A', 'Ganjil', '255'),
(13, 111, '8A', 'Ganjil', '0');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_prestasi`
--

CREATE TABLE IF NOT EXISTS `tbl_prestasi` (
  `id_prestasi` int(11) NOT NULL,
  `nama_prestasi` varchar(45) DEFAULT NULL,
  `jenis` varchar(45) DEFAULT NULL,
  `tingkat` varchar(45) DEFAULT NULL,
  `waktu` date NOT NULL,
  `lokasi` text NOT NULL,
  `nis` int(11) DEFAULT NULL,
  `id_kelas` char(10) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_prestasi`
--

INSERT INTO `tbl_prestasi` (`id_prestasi`, `nama_prestasi`, `jenis`, `tingkat`, `waktu`, `lokasi`, `nis`, `id_kelas`) VALUES
(1, 'asdasd dgdsgdfgdfhgdg dfgdfgdfgdfg fdgfdgdfg', 'asdasd', 'adad', '2016-02-16', 'zczxvxzcxzcvxv', 111, '8A');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_siswa`
--

CREATE TABLE IF NOT EXISTS `tbl_siswa` (
  `nis` int(11) NOT NULL,
  `nama_lengkap` varchar(45) DEFAULT NULL,
  `jk` enum('L','P') DEFAULT NULL,
  `nisn` int(11) DEFAULT NULL,
  `tempat_lahir` varchar(45) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `agama` varchar(45) DEFAULT NULL,
  `alamat` varchar(45) DEFAULT NULL,
  `desa` varchar(45) DEFAULT NULL,
  `kecamatan` varchar(45) DEFAULT NULL,
  `kabupaten` varchar(45) DEFAULT NULL,
  `provinsi` varchar(45) DEFAULT NULL,
  `alat_transportasi` varchar(45) DEFAULT NULL,
  `telpon` varchar(12) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `skhun_sd` varchar(45) DEFAULT NULL,
  `kps` enum('Ya','Tidak') DEFAULT NULL,
  `nama_ayah` varchar(45) DEFAULT NULL,
  `thn_lahir` year(4) DEFAULT NULL,
  `pekerjaan_ayah` varchar(45) DEFAULT NULL,
  `pendidikan_ayah` varchar(45) DEFAULT NULL,
  `penghasilan` varchar(12) DEFAULT NULL,
  `nama_ibu` varchar(45) DEFAULT NULL,
  `thnlahir` year(4) DEFAULT NULL,
  `pekerjaan_ibu` varchar(45) DEFAULT NULL,
  `pendidikan_ibu` varchar(45) DEFAULT NULL,
  `penghasilan_ibu` varchar(12) DEFAULT NULL,
  `tinggi_badan` int(11) DEFAULT NULL,
  `berat_badan` int(11) DEFAULT NULL,
  `jml_saudara` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_siswa`
--

INSERT INTO `tbl_siswa` (`nis`, `nama_lengkap`, `jk`, `nisn`, `tempat_lahir`, `tgl_lahir`, `agama`, `alamat`, `desa`, `kecamatan`, `kabupaten`, `provinsi`, `alat_transportasi`, `telpon`, `email`, `skhun_sd`, `kps`, `nama_ayah`, `thn_lahir`, `pekerjaan_ayah`, `pendidikan_ayah`, `penghasilan`, `nama_ibu`, `thnlahir`, `pekerjaan_ibu`, `pendidikan_ibu`, `penghasilan_ibu`, `tinggi_badan`, `berat_badan`, `jml_saudara`) VALUES
(111, 'Siti Hijratul Jihadah', 'P', 113, 'Dasan Baru', '1992-06-27', 'Islam', 'Sepit', '52.03.01.2004', '01&amp;kec=03&amp;prop=52', '03&amp;prop=52', '52', 'Kendaraan Umum', '0819121212', 'anandaghea27@gmail.com', '123456', 'Ya', 'Drs Marzuki Adami, M.Ap', 1960, 'PNS', 'Sarjana', 'Lebih 5 Juta', 'Dra Nurul Hidayah', 1970, 'Wiraswasta', 'Sarjana', 'Lebih 5 Juta', 160, 50, '3'),
(112, 'Erwin Indrawan', 'P', 1123, 'Jeneper', '2016-03-28', 'Islam', 'Jl.Amir Hamzah Gg.Actor No.1A Karang Sukun Ma', '5202040009', '5202040', '5202', '52', 'Kendaraan Pribadi', '081999999', 'erwin.jnefer@gmail.com', '9000', 'Ya', 'Yun', 1970, 'Petani', 'SMA', 'Lebih 1 Juta', 'SU', 1969, 'Petani', 'SMP', 'Kurang 1 Jut', 150, 50, '3'),
(123, 'Arif', 'P', 1234, 'Sepit', '2016-02-23', 'Islam', 'selong', '52.03.04.2004', '04&amp;kec=03&amp;prop=52', '03&amp;prop=52', '52', 'Kendaraan Pribadi', '0819121212', 'haekal@gmail.com', '456', 'Ya', 'H Ramli', 1950, 'Petani', 'SD', 'Kurang 1 Jut', 'Inak Ruminep', 1950, 'IRT', 'SD', 'Kurang 1 Jut', 179, 100, '3'),
(133, 'Muhammad Azmi', 'L', 1332, 'Tengeh', '1992-02-12', 'Islam', 'Mataram', '5203010008', '5203010', '5203', '52', 'Kendaraan Pribadi', '099121212', 'muhammad4zmi@gmail.com', '122121', 'Ya', 'H Hamdi', 1960, 'Petani', 'SD', 'Kurang 1 Jut', 'HJ Isnaini', 1967, 'IRT', 'SD', 'Lebih 1 Juta', 165, 62, '5');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE IF NOT EXISTS `tbl_user` (
  `id` int(11) NOT NULL,
  `nip` int(11) NOT NULL,
  `nama_lengkap` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `jabatan` varchar(50) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `nip`, `nama_lengkap`, `password`, `jabatan`) VALUES
(1, 8988, 'Muhammad Azmi, S.Kom', '123', '1'),
(2, 77878, 'DindaQ', '123', '2'),
(3, 8988, 'Muhammad Azmi, S.Kom', '2016', '2'),
(4, 123456, 'Test', '123', '2');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_walikelas`
--

CREATE TABLE IF NOT EXISTS `tbl_walikelas` (
  `id_wali` int(11) NOT NULL,
  `id_kelas` char(10) NOT NULL,
  `kelas` char(10) NOT NULL,
  `nip` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_walikelas`
--

INSERT INTO `tbl_walikelas` (`id_wali`, `id_kelas`, `kelas`, `nip`) VALUES
(2, '8A', 'VIIIA', 8988),
(3, '7A', 'VIIA', 77878);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`username`), ADD KEY `fk_akun_mhs_idx` (`nis`);

--
-- Indexes for table `bantuan`
--
ALTER TABLE `bantuan`
  ADD PRIMARY KEY (`nis`);

--
-- Indexes for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id`), ADD KEY `FK_jadwal_tbl_guru` (`nip`), ADD KEY `FK_jadwal_tbl_mapel` (`kd_mapel`), ADD KEY `FK_jadwal_tbl_kelas` (`id_kelas`);

--
-- Indexes for table `presensi`
--
ALTER TABLE `presensi`
  ADD PRIMARY KEY (`id`), ADD KEY `FK__tbl_siswa` (`nis`), ADD KEY `FK_presensi_tbl_kelas` (`id_kelas`);

--
-- Indexes for table `rapot`
--
ALTER TABLE `rapot`
  ADD PRIMARY KEY (`id_raport`), ADD KEY `fk_rapot_1_idx` (`nis`), ADD KEY `FK_rapot_tbl_kelas` (`id_kelas`), ADD KEY `fk_rapot_3` (`kd_mapel`);

--
-- Indexes for table `rekap_nilai`
--
ALTER TABLE `rekap_nilai`
  ADD PRIMARY KEY (`id_rekap`), ADD KEY `FK__tbl_kelas` (`id_kelas`), ADD KEY `FK__tbl_mapel` (`kd_mapel`), ADD KEY `FK__tbl_mapel_2` (`nip`), ADD KEY `FK_rekap_nilai_tbl_siswa` (`nis`);

--
-- Indexes for table `tbl_guru`
--
ALTER TABLE `tbl_guru`
  ADD PRIMARY KEY (`nip`);

--
-- Indexes for table `tbl_help`
--
ALTER TABLE `tbl_help`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_info`
--
ALTER TABLE `tbl_info`
  ADD PRIMARY KEY (`id_info`);

--
-- Indexes for table `tbl_kelas`
--
ALTER TABLE `tbl_kelas`
  ADD PRIMARY KEY (`id`), ADD KEY `fk_kelas` (`nis`), ADD KEY `id_kelas` (`id_kelas`);

--
-- Indexes for table `tbl_mapel`
--
ALTER TABLE `tbl_mapel`
  ADD PRIMARY KEY (`kd_mapel`), ADD KEY `fk_tbl_mapel_1_idx` (`nip`), ADD KEY `FK_tbl_mapel_tbl_kelas` (`id_kelas`);

--
-- Indexes for table `tbl_nilai`
--
ALTER TABLE `tbl_nilai`
  ADD PRIMARY KEY (`id_nilai`), ADD KEY `FK_tbl_nilai_tbl_kelas` (`nis`), ADD KEY `FK_tbl_nilai_tbl_kelas_2` (`id_kelas`);

--
-- Indexes for table `tbl_prestasi`
--
ALTER TABLE `tbl_prestasi`
  ADD PRIMARY KEY (`id_prestasi`), ADD KEY `fk_tbl_prestasi_2_idx` (`nis`), ADD KEY `FK_tbl_prestasi_tbl_kelas` (`id_kelas`);

--
-- Indexes for table `tbl_siswa`
--
ALTER TABLE `tbl_siswa`
  ADD PRIMARY KEY (`nis`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`,`nip`);

--
-- Indexes for table `tbl_walikelas`
--
ALTER TABLE `tbl_walikelas`
  ADD PRIMARY KEY (`id_wali`), ADD KEY `nip` (`nip`), ADD KEY `FK_tbl_walikelas_tbl_kelas` (`id_kelas`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `presensi`
--
ALTER TABLE `presensi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `rapot`
--
ALTER TABLE `rapot`
  MODIFY `id_raport` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `rekap_nilai`
--
ALTER TABLE `rekap_nilai`
  MODIFY `id_rekap` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `tbl_help`
--
ALTER TABLE `tbl_help`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `tbl_info`
--
ALTER TABLE `tbl_info`
  MODIFY `id_info` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `tbl_kelas`
--
ALTER TABLE `tbl_kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tbl_nilai`
--
ALTER TABLE `tbl_nilai`
  MODIFY `id_nilai` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `tbl_prestasi`
--
ALTER TABLE `tbl_prestasi`
  MODIFY `id_prestasi` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_walikelas`
--
ALTER TABLE `tbl_walikelas`
  MODIFY `id_wali` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `jadwal`
--
ALTER TABLE `jadwal`
ADD CONSTRAINT `FK_jadwal_tbl_guru` FOREIGN KEY (`nip`) REFERENCES `tbl_guru` (`nip`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `FK_jadwal_tbl_kelas` FOREIGN KEY (`id_kelas`) REFERENCES `tbl_kelas` (`id_kelas`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `FK_jadwal_tbl_mapel` FOREIGN KEY (`kd_mapel`) REFERENCES `tbl_mapel` (`kd_mapel`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `presensi`
--
ALTER TABLE `presensi`
ADD CONSTRAINT `FK__tbl_siswa` FOREIGN KEY (`nis`) REFERENCES `tbl_siswa` (`nis`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `FK_presensi_tbl_kelas` FOREIGN KEY (`id_kelas`) REFERENCES `tbl_kelas` (`id_kelas`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rapot`
--
ALTER TABLE `rapot`
ADD CONSTRAINT `FK_rapot_tbl_kelas` FOREIGN KEY (`id_kelas`) REFERENCES `tbl_kelas` (`id_kelas`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `fk_rapot_1` FOREIGN KEY (`nis`) REFERENCES `tbl_siswa` (`nis`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `fk_rapot_3` FOREIGN KEY (`kd_mapel`) REFERENCES `tbl_mapel` (`kd_mapel`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rekap_nilai`
--
ALTER TABLE `rekap_nilai`
ADD CONSTRAINT `FK__tbl_kelas` FOREIGN KEY (`id_kelas`) REFERENCES `tbl_kelas` (`id_kelas`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `FK__tbl_mapel` FOREIGN KEY (`kd_mapel`) REFERENCES `tbl_mapel` (`kd_mapel`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `FK__tbl_mapel_2` FOREIGN KEY (`nip`) REFERENCES `tbl_guru` (`nip`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `FK_rekap_nilai_tbl_siswa` FOREIGN KEY (`nis`) REFERENCES `tbl_siswa` (`nis`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_kelas`
--
ALTER TABLE `tbl_kelas`
ADD CONSTRAINT `tbl_kelas_ibfk_1` FOREIGN KEY (`nis`) REFERENCES `tbl_siswa` (`nis`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_mapel`
--
ALTER TABLE `tbl_mapel`
ADD CONSTRAINT `FK_tbl_mapel_tbl_kelas` FOREIGN KEY (`id_kelas`) REFERENCES `tbl_kelas` (`id_kelas`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `fk_tbl_mapel_1` FOREIGN KEY (`nip`) REFERENCES `tbl_guru` (`nip`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_nilai`
--
ALTER TABLE `tbl_nilai`
ADD CONSTRAINT `FK_tbl_nilai_tbl_kelas` FOREIGN KEY (`nis`) REFERENCES `tbl_siswa` (`nis`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `FK_tbl_nilai_tbl_kelas_2` FOREIGN KEY (`id_kelas`) REFERENCES `tbl_kelas` (`id_kelas`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_prestasi`
--
ALTER TABLE `tbl_prestasi`
ADD CONSTRAINT `FK_tbl_prestasi_tbl_kelas` FOREIGN KEY (`id_kelas`) REFERENCES `tbl_kelas` (`id_kelas`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `fk_tbl_prestasi_2` FOREIGN KEY (`nis`) REFERENCES `tbl_siswa` (`nis`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_walikelas`
--
ALTER TABLE `tbl_walikelas`
ADD CONSTRAINT `FK_tbl_walikelas_tbl_kelas` FOREIGN KEY (`id_kelas`) REFERENCES `tbl_kelas` (`id_kelas`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `fk_wali2` FOREIGN KEY (`nip`) REFERENCES `tbl_guru` (`nip`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
