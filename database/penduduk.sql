-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 15, 2024 at 04:22 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `penduduk`
--

-- --------------------------------------------------------

--
-- Table structure for table `anggota_keluarga`
--

CREATE TABLE `anggota_keluarga` (
  `id_anggota` int(11) NOT NULL,
  `id_kk` int(11) NOT NULL,
  `id_penduduk` int(11) NOT NULL,
  `hub_keluarga` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `anggota_keluarga`
--

INSERT INTO `anggota_keluarga` (`id_anggota`, `id_kk`, `id_penduduk`, `hub_keluarga`) VALUES
(19, 1, 7, 'Anak'),
(21, 2, 8, 'Anak'),
(22, 1, 11, 'Anak'),
(23, 1, 9, 'Famili Lain'),
(25, 2, 13, 'Kepala Keluarga');

-- --------------------------------------------------------

--
-- Table structure for table `anggota_keluarga_pindah`
--

CREATE TABLE `anggota_keluarga_pindah` (
  `id_anggota_keluarga_pindah` int(11) NOT NULL,
  `id_penduduk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kk`
--

CREATE TABLE `kk` (
  `id_kk` int(11) NOT NULL,
  `no_kk` varchar(16) NOT NULL,
  `id_penduduk` int(11) NOT NULL,
  `k_keluarga` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kk`
--

INSERT INTO `kk` (`id_kk`, `no_kk`, `id_penduduk`, `k_keluarga`) VALUES
(1, '3277098734467891', 6, 'Samid'),
(2, '3277098734467892', 13, 'Abdul');

-- --------------------------------------------------------

--
-- Table structure for table `penduduk`
--

CREATE TABLE `penduduk` (
  `id_penduduk` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nik_penduduk` varchar(16) NOT NULL,
  `nama_penduduk` varchar(45) NOT NULL,
  `tempat_lahir_penduduk` varchar(30) NOT NULL,
  `tanggal_lahir_penduduk` date NOT NULL,
  `jenis_kelamin_penduduk` enum('Laki-Laki','Perempuan') NOT NULL,
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
  `status_perkawinan_penduduk` enum('Kawin','Tidak Kawin') NOT NULL,
  `status` enum('Ada','Meninggal','Pindah','Izin Tinggal') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `penduduk`
--

INSERT INTO `penduduk` (`id_penduduk`, `id_user`, `nik_penduduk`, `nama_penduduk`, `tempat_lahir_penduduk`, `tanggal_lahir_penduduk`, `jenis_kelamin_penduduk`, `alamat_penduduk`, `desa_kelurahan_penduduk`, `kecamatan_penduduk`, `kabupaten_kota_penduduk`, `provinsi_penduduk`, `negara_penduduk`, `rt_penduduk`, `rw_penduduk`, `agama_penduduk`, `pendidikan_terakhir_penduduk`, `pekerjaan_penduduk`, `status_perkawinan_penduduk`, `status`) VALUES
(6, 2, '3277982345671953', 'Samid', 'Bandung', '2003-07-22', 'Laki-Laki', 'Jl Pesantren', 'Cibabat', 'Cimahi Utara', 'Cimahi', 'Jawa Barat', 'WNI', '3', '5', 'Islam', 'SD', 'Programmer', 'Kawin', 'Ada'),
(7, 3, '3277982345671954', 'Bagja', 'Cimahi', '2000-09-07', 'Laki-Laki', 'Jl Kolmas', 'Cipageran', 'Cimahi Utara', 'Cimahi', 'Jawa Barat', 'WNI', '6', '4', 'Islam', 'S1', 'Bekerja', 'Tidak Kawin', 'Ada'),
(8, 4, '3277982345671955', 'Kusni', 'Cimahi', '2013-09-19', 'Perempuan', 'Jl Pesantren', 'Cibabat', 'Cimahi Utara', 'Cimahi', 'Jawa Barat', 'WNI', '3', '5', 'Islam', 'SD', 'Belum Bekerja', 'Tidak Kawin', 'Ada'),
(9, 8, '3277982345671955', 'Tes', 'Cimahi', '2004-05-06', 'Laki-Laki', 'tes', 'tes', 'tes', 'tes', 'tes', 'WNI', '6', '9', 'Konghucu', 'D1', 'tes', 'Tidak Kawin', 'Meninggal'),
(11, 7, '3277030911060001', 'Mantap', 'ghjghj', '2006-11-09', 'Laki-Laki', 'ghjgh', 'ghj', 'ghj', 'ghj', 'ghj', 'WNI', '6', '8', 'Islam', 'D2', 'fsg', 'Tidak Kawin', 'Meninggal'),
(12, 0, '3277031105240001', 'dhdvfh', 'jhsvah', '2024-05-11', 'Laki-Laki', 'zsddfb', 'dfbfd', 'dfbfd', 'dfbfdb', 'dfbdfbfdb', 'WNI', '4', '5', 'Islam', 'Tidak Sekolah', '-', 'Tidak Kawin', 'Ada'),
(13, 9, '3277031707150001', 'Abdul', 'Cimahi', '2015-07-17', 'Perempuan', 'Jl Cihanjuang', 'Cibabat', 'Cimahi Utara', 'Cimahi', 'Jawa Barat', 'WNI', '2', '3', 'Islam', 'SD', '-', '', 'Ada'),
(14, 0, '3277031105240001', 'jfajfquvu', 'hwefvwejhfv', '2024-05-11', 'Perempuan', 'aregesr', 'thrth', 'w4teerg', 'gfnfgn', 'wefwrg', 'WNI', '6', '3', '', 'Tidak Sekolah', '-', '', 'Ada'),
(15, 0, '3277030205240001', 'arhdfbgjk', 'hdbgksjbg', '2024-05-02', 'Perempuan', 'adhvahjf', 'whjegbwejg', 'jhwbgw', 'hwegbwegb', 'jehgbwheg', 'WNI', '6', '3', '', 'Tidak Sekolah', '-', 'Tidak Kawin', 'Ada');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id_role` int(11) NOT NULL,
  `nama_role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id_role`, `nama_role`) VALUES
(1, 'Admin'),
(4, 'Penduduk');

-- --------------------------------------------------------

--
-- Table structure for table `surat_kematian`
--

CREATE TABLE `surat_kematian` (
  `id_surat_kematian` int(11) NOT NULL,
  `id_penduduk` int(11) NOT NULL,
  `tanggal_kematian` date NOT NULL,
  `jam_kematian` time NOT NULL,
  `penyebab_kematian` varchar(255) NOT NULL,
  `tempat_kematian` varchar(255) NOT NULL,
  `usia_kematian` int(11) NOT NULL,
  `bin_binti` varchar(255) NOT NULL,
  `pelapor` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `surat_kematian`
--

INSERT INTO `surat_kematian` (`id_surat_kematian`, `id_penduduk`, `tanggal_kematian`, `jam_kematian`, `penyebab_kematian`, `tempat_kematian`, `usia_kematian`, `bin_binti`, `pelapor`) VALUES
(7, 11, '2024-05-14', '16:05:00', 'Serangan Jantung', 'Serangan Jantung', 17, 'Kusnandar', '11');

-- --------------------------------------------------------

--
-- Table structure for table `surat_kematian_temp`
--

CREATE TABLE `surat_kematian_temp` (
  `id_surat_kematian_temp` int(11) NOT NULL,
  `id_penduduk` int(11) NOT NULL,
  `tanggal_kematian` date NOT NULL,
  `jam_kematian` time NOT NULL,
  `penyebab_kematian` varchar(255) NOT NULL,
  `tempat_kematian` varchar(255) NOT NULL,
  `usia_kematian` int(11) NOT NULL,
  `bin_binti` varchar(255) NOT NULL,
  `pelapor` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `surat_pindah`
--

CREATE TABLE `surat_pindah` (
  `id_surat_pindah` int(11) NOT NULL,
  `id_penduduk` int(11) NOT NULL,
  `alamat_baru` varchar(255) NOT NULL,
  `rt_baru` int(11) NOT NULL,
  `rw_baru` int(11) NOT NULL,
  `desa_kelurahan_baru` varchar(255) NOT NULL,
  `kecamatan_baru` varchar(255) NOT NULL,
  `kabupaten_kota_baru` varchar(255) NOT NULL,
  `provinsi_baru` varchar(255) NOT NULL,
  `alasan_pindah` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `surat_pindah`
--

INSERT INTO `surat_pindah` (`id_surat_pindah`, `id_penduduk`, `alamat_baru`, `rt_baru`, `rw_baru`, `desa_kelurahan_baru`, `kecamatan_baru`, `kabupaten_kota_baru`, `provinsi_baru`, `alasan_pindah`) VALUES
(2, 7, 'Jl Kolmas', 6, 4, 'Cipageran', 'Cimahi Utara', 'Cimahi', 'Jawa Barat', 'Kerja');

-- --------------------------------------------------------

--
-- Table structure for table `surat_pindah_temp`
--

CREATE TABLE `surat_pindah_temp` (
  `id_surat_pindah_temp` int(11) NOT NULL,
  `id_penduduk` int(11) NOT NULL,
  `alamat_baru` varchar(255) NOT NULL,
  `rt_baru` int(11) NOT NULL,
  `rw_baru` int(11) NOT NULL,
  `desa_kelurahan_baru` varchar(255) NOT NULL,
  `kecamatan_baru` varchar(255) NOT NULL,
  `kabupaten_kota_baru` varchar(255) NOT NULL,
  `provinsi_baru` varchar(255) NOT NULL,
  `alasan_pindah` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `id_role` int(11) NOT NULL,
  `nama_user` varchar(45) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(32) NOT NULL,
  `password_changed` int(1) NOT NULL,
  `status_user` enum('RT','RW','Penduduk','Kecamatan','Admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `id_role`, `nama_user`, `username`, `password`, `password_changed`, `status_user`) VALUES
(1, 1, 'Admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', 0, 'Admin'),
(2, 4, 'Samid', '3277982345671953', 'c5e8401594a6c0dc5fc98a783db70f69', 0, 'Penduduk'),
(3, 4, 'Bagja', '3277982345671954', 'b93939873fd4923043b9dec975811f66', 1, 'Penduduk'),
(4, 4, 'Kusni', '3277982345671955', 'a19ea7dff6ced87d8cb9c62cc7922497', 1, 'Penduduk'),
(6, 4, 'arhdfbgjk', '3277030205240001', 'ddd58e02f656d557cf1c8323843d4bc2', 0, 'Penduduk'),
(7, 4, 'Mantap', '3277030911060001', 'b93939873fd4923043b9dec975811f66', 1, 'Penduduk'),
(8, 4, 'Tes', '3277982345671955', '5aed8989405524470a2bddaadf3c04aa', 0, 'Penduduk'),
(9, 4, 'Abdul', '3277031707150001', '6fe77ab9e7338d309d55d364f92b1ae1', 0, 'Penduduk');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anggota_keluarga`
--
ALTER TABLE `anggota_keluarga`
  ADD PRIMARY KEY (`id_anggota`),
  ADD KEY `id_kk` (`id_kk`,`id_penduduk`),
  ADD KEY `id_penduduk` (`id_penduduk`);

--
-- Indexes for table `anggota_keluarga_pindah`
--
ALTER TABLE `anggota_keluarga_pindah`
  ADD PRIMARY KEY (`id_anggota_keluarga_pindah`),
  ADD KEY `id_penduduk` (`id_penduduk`);

--
-- Indexes for table `kk`
--
ALTER TABLE `kk`
  ADD PRIMARY KEY (`id_kk`),
  ADD KEY `id_penduduk` (`id_penduduk`);

--
-- Indexes for table `penduduk`
--
ALTER TABLE `penduduk`
  ADD PRIMARY KEY (`id_penduduk`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indexes for table `surat_kematian`
--
ALTER TABLE `surat_kematian`
  ADD PRIMARY KEY (`id_surat_kematian`),
  ADD KEY `id_penduduk` (`id_penduduk`);

--
-- Indexes for table `surat_kematian_temp`
--
ALTER TABLE `surat_kematian_temp`
  ADD PRIMARY KEY (`id_surat_kematian_temp`),
  ADD KEY `id_penduduk` (`id_penduduk`);

--
-- Indexes for table `surat_pindah`
--
ALTER TABLE `surat_pindah`
  ADD PRIMARY KEY (`id_surat_pindah`),
  ADD KEY `id_penduduk` (`id_penduduk`);

--
-- Indexes for table `surat_pindah_temp`
--
ALTER TABLE `surat_pindah_temp`
  ADD PRIMARY KEY (`id_surat_pindah_temp`),
  ADD KEY `id_penduduk` (`id_penduduk`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_role` (`id_role`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anggota_keluarga`
--
ALTER TABLE `anggota_keluarga`
  MODIFY `id_anggota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `anggota_keluarga_pindah`
--
ALTER TABLE `anggota_keluarga_pindah`
  MODIFY `id_anggota_keluarga_pindah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `kk`
--
ALTER TABLE `kk`
  MODIFY `id_kk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `penduduk`
--
ALTER TABLE `penduduk`
  MODIFY `id_penduduk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `surat_kematian`
--
ALTER TABLE `surat_kematian`
  MODIFY `id_surat_kematian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `surat_kematian_temp`
--
ALTER TABLE `surat_kematian_temp`
  MODIFY `id_surat_kematian_temp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `surat_pindah`
--
ALTER TABLE `surat_pindah`
  MODIFY `id_surat_pindah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `surat_pindah_temp`
--
ALTER TABLE `surat_pindah_temp`
  MODIFY `id_surat_pindah_temp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `anggota_keluarga`
--
ALTER TABLE `anggota_keluarga`
  ADD CONSTRAINT `anggota_keluarga_ibfk_1` FOREIGN KEY (`id_penduduk`) REFERENCES `penduduk` (`id_penduduk`) ON UPDATE CASCADE,
  ADD CONSTRAINT `anggota_keluarga_ibfk_2` FOREIGN KEY (`id_kk`) REFERENCES `kk` (`id_kk`) ON UPDATE CASCADE;

--
-- Constraints for table `anggota_keluarga_pindah`
--
ALTER TABLE `anggota_keluarga_pindah`
  ADD CONSTRAINT `anggota_keluarga_pindah_ibfk_1` FOREIGN KEY (`id_penduduk`) REFERENCES `penduduk` (`id_penduduk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `kk`
--
ALTER TABLE `kk`
  ADD CONSTRAINT `kk_ibfk_1` FOREIGN KEY (`id_penduduk`) REFERENCES `penduduk` (`id_penduduk`) ON UPDATE CASCADE;

--
-- Constraints for table `surat_kematian`
--
ALTER TABLE `surat_kematian`
  ADD CONSTRAINT `surat_kematian_ibfk_1` FOREIGN KEY (`id_penduduk`) REFERENCES `penduduk` (`id_penduduk`) ON UPDATE CASCADE;

--
-- Constraints for table `surat_kematian_temp`
--
ALTER TABLE `surat_kematian_temp`
  ADD CONSTRAINT `surat_kematian_temp_ibfk_1` FOREIGN KEY (`id_penduduk`) REFERENCES `penduduk` (`id_penduduk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `surat_pindah`
--
ALTER TABLE `surat_pindah`
  ADD CONSTRAINT `surat_pindah_ibfk_1` FOREIGN KEY (`id_penduduk`) REFERENCES `penduduk` (`id_penduduk`) ON UPDATE CASCADE;

--
-- Constraints for table `surat_pindah_temp`
--
ALTER TABLE `surat_pindah_temp`
  ADD CONSTRAINT `surat_pindah_temp_ibfk_1` FOREIGN KEY (`id_penduduk`) REFERENCES `penduduk` (`id_penduduk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `role` (`id_role`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
