-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 08, 2024 at 08:54 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
-- --------------------------------------------------------

--
-- Table structure for table `penduduk`
--

CREATE TABLE `penduduk` (
  `id_penduduk` int(11) NOT NULL,
  `nik_penduduk` varchar(16) NOT NULL,
  `nama_penduduk` varchar(45) NOT NULL,
  `tempat_lahir_penduduk` varchar(30) NOT NULL,
  `tanggal_lahir_penduduk` date NOT NULL,
  `jenis_kelamin_penduduk` enum('Laki-Laki','Perempuan') NOT NULL,
  `alamat_ktp_penduduk` text NOT NULL,
  `alamat_penduduk` text NOT NULL,
  `desa_kelurahan_penduduk` varchar(30) NOT NULL,
  `kecamatan_penduduk` varchar(30) NOT NULL,
  `kabupaten_kota_penduduk` varchar(30) NOT NULL,
  `provinsi_penduduk` varchar(30) NOT NULL,
  `negara_penduduk` varchar(30) NOT NULL,
  `rt_penduduk` varchar(3) NOT NULL,
  `rw_penduduk` varchar(3) NOT NULL,
  `agama_penduduk` enum('Islam','Kristen','Katolik','Hindu','Buddha','Konghucu') NOT NULL,
  `pendidikan_terakhir_penduduk` varchar(20) NOT NULL,
  `pekerjaan_penduduk` varchar(20) NOT NULL,
  `status_perkawinan_penduduk` enum('Kawin','Belum Kawin','Tidak Kawin','Cerai') NOT NULL,
  `status` enum('Ada','Meninggal','Pindah','Izin Tinggal') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `penduduk`
--

INSERT INTO `penduduk` (`id_penduduk`, `nik_penduduk`, `nama_penduduk`, `tempat_lahir_penduduk`, `tanggal_lahir_penduduk`, `jenis_kelamin_penduduk`, `alamat_ktp_penduduk`, `alamat_penduduk`, `desa_kelurahan_penduduk`, `kecamatan_penduduk`, `kabupaten_kota_penduduk`, `provinsi_penduduk`, `negara_penduduk`, `rt_penduduk`, `rw_penduduk`, `agama_penduduk`, `pendidikan_terakhir_penduduk`, `pekerjaan_penduduk`, `status_perkawinan_penduduk`, `status`) VALUES
(6, '3277982345671953', 'Samid', 'Bandung', '2003-07-22', 'Laki-Laki', 'Jl Pesantren', 'Jl Pesantren', 'Cibabat', 'Cimahi Utara', 'Cimahi', 'Jawa Barat', 'WNI', '3', '5', 'Islam', 'SD', 'Programmer', 'Kawin', 'Ada'),
(7, '3277982345671954', 'Bagja', 'Cimahi', '2000-09-07', 'Laki-Laki', 'Jl Pesantren', 'Jl Pesantren', 'Cibabat', 'Cimahi Utara', 'Cimahi', 'Jawa Barat', 'WNI', '3', '5', 'Islam', 'S1', 'Bekerja', 'Tidak Kawin', 'Meninggal'),
(8, '3277982345671955', 'Kusni', 'Cimahi', '2013-09-19', 'Perempuan', 'Jl Pesantren', 'Jl Pesantren', 'Cibabat', 'Cimahi Utara', 'Cimahi', 'Jawa Barat', 'WNI', '3', '5', 'Islam', 'SD', 'Belum Bekerja', 'Tidak Kawin', 'Meninggal'),
(11, '3277030911060001', 'Mantap', 'ghjghj', '2006-11-09', 'Laki-Laki', 'hgjghj', 'ghjgh', 'ghj', 'ghj', 'ghj', 'ghj', 'WNI', '6', '8', 'Islam', 'D2', 'fsg', 'Tidak Kawin', 'Meninggal'),
(12, '3277032104070001', 'Radit Aditya', 'Cimahi', '2007-04-21', 'Laki-Laki', 'Jl. KH Usmandhomiri', 'Jl. KH Usmandhomiri', 'Padasuka', 'Cimahi Tengah', 'Cimahi', 'Jawa Barat', 'WNI', '2', '8', 'Islam', 'SMK/SMA Sederajat', 'Belum Bekerja', 'Tidak Kawin', 'Meninggal');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `penduduk`
--
ALTER TABLE `penduduk`
  ADD PRIMARY KEY (`id_penduduk`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `penduduk`
--
ALTER TABLE `penduduk`
  MODIFY `id_penduduk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;