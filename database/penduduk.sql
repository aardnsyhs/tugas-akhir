-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2024 at 10:33 AM
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
(1, 1, 2, 'Kepala Keluarga'),
(2, 1, 3, 'Istri'),
(3, 1, 1, 'Anak'),
(4, 1, 4, 'Anak'),
(5, 1, 5, 'Anak'),
(6, 2, 6, 'Kepala Keluarga'),
(7, 2, 7, 'Istri'),
(8, 2, 8, 'Anak');

-- --------------------------------------------------------

--
-- Table structure for table `anggota_keluarga_pindah`
--

CREATE TABLE `anggota_keluarga_pindah` (
  `id_anggota_keluarga_pindah` int(11) NOT NULL,
  `id_penduduk` int(11) NOT NULL,
  `id_kk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `anggota_keluarga_pindah`
--

INSERT INTO `anggota_keluarga_pindah` (`id_anggota_keluarga_pindah`, `id_penduduk`, `id_kk`) VALUES
(30, 3, 1),
(31, 1, 1),
(32, 4, 1),
(33, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `anggota_keluarga_pindah_temp`
--

CREATE TABLE `anggota_keluarga_pindah_temp` (
  `id_anggota_keluarga_pindah_temp` int(11) NOT NULL,
  `id_penduduk` int(11) NOT NULL,
  `id_kk` int(11) NOT NULL
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
(1, '3277036654786129', 2, 'Akung'),
(2, '3277035876112385', 6, 'Musnar Karsi');

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
  `status_perkawinan_penduduk` enum('Kawin','Tidak Kawin','Belum Kawin','Cerai') NOT NULL,
  `status` enum('Ada','Meninggal') NOT NULL,
  `status_keluarga` enum('Sudah Berkeluarga','Belum Berkeluarga','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `penduduk`
--

INSERT INTO `penduduk` (`id_penduduk`, `id_user`, `nik_penduduk`, `nama_penduduk`, `tempat_lahir_penduduk`, `tanggal_lahir_penduduk`, `jenis_kelamin_penduduk`, `alamat_penduduk`, `desa_kelurahan_penduduk`, `kecamatan_penduduk`, `kabupaten_kota_penduduk`, `provinsi_penduduk`, `negara_penduduk`, `rt_penduduk`, `rw_penduduk`, `agama_penduduk`, `pendidikan_terakhir_penduduk`, `pekerjaan_penduduk`, `status_perkawinan_penduduk`, `status`, `status_keluarga`) VALUES
(1, 2, '3277032110060001', 'Ardiansyah Sulistyo', 'Cimahi', '2006-10-21', 'Laki-Laki', 'Jl Kolmas', 'Cipageran', 'Cimahi Utara', 'Cimahi', 'Jawa Barat', 'WNI', '5', '7', 'Islam', 'SMK/SMA Sederajat', '-', 'Belum Kawin', 'Ada', 'Sudah Berkeluarga'),
(2, 3, '3277030606790001', 'Akung', 'Cimahi', '1979-06-06', 'Laki-Laki', 'Jl Kolmas', 'Cipageran', 'Cimahi Utara', 'Cimahi', 'Jawa Barat', 'WNI', '5', '7', 'Islam', 'S1', 'Pengusaha', 'Kawin', 'Ada', 'Sudah Berkeluarga'),
(3, 4, '3277030707840001', 'Riska', 'Cimahi', '1984-07-07', 'Perempuan', 'Jl Kolmas', 'Cipageran', 'Cimahi Utara', 'Cimahi', 'Jawa Barat', 'WNI', '5', '7', 'Islam', 'S2', 'Ibu Rumah Tangga', 'Kawin', 'Ada', 'Sudah Berkeluarga'),
(4, 5, '3277031308090001', 'Azka Virzha', 'Cimahi', '2009-08-13', 'Laki-Laki', 'Jl Kolmas', 'Cipageran', 'Cimahi Utara', 'Cimahi', 'Jawa Barat', 'WNI', '5', '7', 'Islam', 'SMP', '-', 'Belum Kawin', 'Ada', 'Sudah Berkeluarga'),
(5, 6, '3277032112140001', 'Nurul Ambiya', 'Cimahi', '2014-12-21', 'Perempuan', 'Jl Kolmas', 'Cipageran', 'Cimahi Utara', 'Cimahi', 'Jawa Barat', 'WNI', '5', '7', 'Islam', 'SD', '-', 'Belum Kawin', 'Ada', 'Sudah Berkeluarga'),
(6, 7, '3277031309800001', 'Musnar Karsi', 'Bandung', '1980-09-13', 'Laki-Laki', 'Jl Cihanjuang', 'Cibabat', 'Cimahi Utara', 'Cimahi', 'Jawa Barat', 'WNI', '2', '6', 'Islam', 'S2', 'Programmer', 'Kawin', 'Ada', 'Sudah Berkeluarga'),
(7, 8, '3277033003800001', 'Vania Manra', 'Jakarta', '1980-03-30', 'Perempuan', 'Jl Cihanjuang', 'Cibabat', 'Cimahi Utara', 'Cimahi', 'Jawa Barat', 'WNI', '2', '6', 'Islam', 'D3', 'Ibu Rumah Tangga', 'Kawin', 'Ada', 'Sudah Berkeluarga'),
(8, 9, '3277031708030001', 'Bagus Ramadhan', 'Cimahi', '2003-08-17', 'Laki-Laki', 'Jl Cihanjuang', 'Cibabat', 'Cimahi Utara', 'Cimahi', 'Jawa Barat', 'WNI', '2', '6', 'Islam', 'D3', 'Programmer', 'Belum Kawin', 'Ada', 'Sudah Berkeluarga'),
(9, 10, '3277030402060001', 'Dimas Aditya Herlambang', 'Bandung', '2006-02-04', 'Laki-Laki', 'Jl Banceuy', 'Cikapundung', 'Sumur Bandung', 'Bandung', 'Jawa Barat', 'WNI', '4', '6', 'Islam', 'SMK/SMA Sederajat', 'COD an Duniawi', 'Belum Kawin', 'Ada', 'Belum Berkeluarga');

-- --------------------------------------------------------

--
-- Table structure for table `riwayat_tinggal`
--

CREATE TABLE `riwayat_tinggal` (
  `id_riwayat_tinggal` int(11) NOT NULL,
  `id_penduduk` int(11) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `rt` int(11) NOT NULL,
  `rw` int(11) NOT NULL,
  `desa_kelurahan` varchar(255) NOT NULL,
  `kecamatan` varchar(255) NOT NULL,
  `kota` varchar(255) NOT NULL,
  `provinsi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `riwayat_tinggal`
--

INSERT INTO `riwayat_tinggal` (`id_riwayat_tinggal`, `id_penduduk`, `alamat`, `rt`, `rw`, `desa_kelurahan`, `kecamatan`, `kota`, `provinsi`) VALUES
(1, 1, 'Jl Cihanjuang', 2, 9, 'Cibabat', 'Cimahi Utara', 'Cimahi', 'Jawa Barat'),
(2, 2, 'Jl Cihanjuang', 2, 9, 'Cibabat', 'Cimahi Utara', 'Cimahi', 'Jawa Barat'),
(3, 3, 'Jl Cihanjuang', 2, 9, 'Cibabat', 'Cimahi Utara', 'Cimahi', 'Jawa Barat'),
(4, 4, 'Jl Cihanjuang', 2, 9, 'Cibabat', 'Cimahi Utara', 'Cimahi', 'Jawa Barat'),
(5, 5, 'Jl Cihanjuang', 2, 9, 'Cibabat', 'Cimahi Utara', 'Cimahi', 'Jawa Barat'),
(6, 6, 'Jl Pesantren', 5, 3, 'Cibabat', 'Cimahi Utara', 'Cimahi', 'Jawa Barat'),
(7, 7, 'Jl Pesantren', 5, 3, 'Cibabat', 'Cimahi Utara', 'Cimahi', 'Jawa Barat'),
(8, 8, 'Jl Pesantren', 5, 3, 'Cibabat', 'Cimahi Utara', 'Cimahi', 'Jawa Barat'),
(9, 9, 'Jl Banceuy', 4, 6, 'Cikapundung', 'Sumur Bandung', 'Bandung', 'Jawa Barat');

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
(2, 'Penduduk');

-- --------------------------------------------------------

--
-- Table structure for table `surat_izin_tinggal`
--

CREATE TABLE `surat_izin_tinggal` (
  `id_surat_izin_tinggal` int(11) NOT NULL,
  `id_penduduk` int(11) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `rt` int(4) NOT NULL,
  `rw` int(4) NOT NULL,
  `kelurahan` varchar(255) NOT NULL,
  `kecamatan` varchar(255) NOT NULL,
  `kota` varchar(255) NOT NULL,
  `provinsi` varchar(255) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `surat_izin_tinggal`
--

INSERT INTO `surat_izin_tinggal` (`id_surat_izin_tinggal`, `id_penduduk`, `alamat`, `rt`, `rw`, `kelurahan`, `kecamatan`, `kota`, `provinsi`, `tanggal`) VALUES
(1, 9, 'Jl Pesantren', 1, 7, 'Cibabat', 'Cimahi Utara', 'Cimahi', 'Jawa Barat', '2024-05-19');

-- --------------------------------------------------------

--
-- Table structure for table `surat_izin_tinggal_temp`
--

CREATE TABLE `surat_izin_tinggal_temp` (
  `id_surat_izin_tinggal_temp` int(11) NOT NULL,
  `id_penduduk` int(11) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `rt` int(4) NOT NULL,
  `rw` int(4) NOT NULL,
  `kelurahan` varchar(255) NOT NULL,
  `kecamatan` varchar(255) NOT NULL,
  `kota` varchar(255) NOT NULL,
  `provinsi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `pelapor` varchar(4) NOT NULL,
  `tanggal` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `alasan_pindah` varchar(255) NOT NULL,
  `tanggal_pindah` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `surat_pindah`
--

INSERT INTO `surat_pindah` (`id_surat_pindah`, `id_penduduk`, `alamat_baru`, `rt_baru`, `rw_baru`, `desa_kelurahan_baru`, `kecamatan_baru`, `kabupaten_kota_baru`, `provinsi_baru`, `alasan_pindah`, `tanggal_pindah`) VALUES
(25, 2, 'Jl Kolmas', 5, 7, 'Cipageran', 'Cimahi Utara', 'Cimahi', 'Jawa Barat', 'Rumah Rubuh', '2024-05-19');

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
  `status_user` enum('Admin','Penduduk') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `id_role`, `nama_user`, `username`, `password`, `password_changed`, `status_user`) VALUES
(1, 1, 'Admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', 0, 'Admin'),
(2, 2, 'Ardiansyah Sulistyo', '3277032110060001', '155711f95548eb248c07bd708484422f', 0, 'Penduduk'),
(3, 2, 'Akung', '3277030606790001', '944fdc2d1e3ee4d425c6e9716a381814', 0, 'Penduduk'),
(4, 2, 'Riska', '3277030707840001', 'edd7150dfc954a8b9f7b2e30c52c4dfd', 0, 'Penduduk'),
(5, 2, 'Azka Virzha', '3277031308090001', 'c09f83193145ff4b7c33bb8aa49c9376', 0, 'Penduduk'),
(6, 2, 'Nurul Ambiya', '3277032112140001', '714d0187752f3b43f59b0024f802b1f2', 0, 'Penduduk'),
(7, 2, 'Musnar Karsi', '3277031309800001', '6a05840a5d9c98a06a31d2adaa0d16fe', 0, 'Penduduk'),
(8, 2, 'Vania Manra', '3277033003800001', 'b8e26a9851c2f908985a17d8122e0cdc', 0, 'Penduduk'),
(9, 2, 'Bagus Ramadhan', '3277031708030001', '965caf02843fc373415907dc205de5a3', 0, 'Penduduk'),
(10, 2, 'Dimas Aditya Herlambang', '3277030402060001', '0c9b3e76959ec4238b624fed0b87609b', 0, 'Penduduk');

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
  ADD KEY `id_penduduk` (`id_penduduk`),
  ADD KEY `id_kk` (`id_kk`);

--
-- Indexes for table `anggota_keluarga_pindah_temp`
--
ALTER TABLE `anggota_keluarga_pindah_temp`
  ADD PRIMARY KEY (`id_anggota_keluarga_pindah_temp`);

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
  ADD UNIQUE KEY `id_user` (`id_user`),
  ADD KEY `id_user_2` (`id_user`);

--
-- Indexes for table `riwayat_tinggal`
--
ALTER TABLE `riwayat_tinggal`
  ADD PRIMARY KEY (`id_riwayat_tinggal`),
  ADD KEY `id_penduduk` (`id_penduduk`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indexes for table `surat_izin_tinggal`
--
ALTER TABLE `surat_izin_tinggal`
  ADD PRIMARY KEY (`id_surat_izin_tinggal`),
  ADD KEY `id_penduduk` (`id_penduduk`);

--
-- Indexes for table `surat_izin_tinggal_temp`
--
ALTER TABLE `surat_izin_tinggal_temp`
  ADD PRIMARY KEY (`id_surat_izin_tinggal_temp`),
  ADD KEY `id_penduduk` (`id_penduduk`);

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
  MODIFY `id_anggota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `anggota_keluarga_pindah`
--
ALTER TABLE `anggota_keluarga_pindah`
  MODIFY `id_anggota_keluarga_pindah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `anggota_keluarga_pindah_temp`
--
ALTER TABLE `anggota_keluarga_pindah_temp`
  MODIFY `id_anggota_keluarga_pindah_temp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `kk`
--
ALTER TABLE `kk`
  MODIFY `id_kk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `penduduk`
--
ALTER TABLE `penduduk`
  MODIFY `id_penduduk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `riwayat_tinggal`
--
ALTER TABLE `riwayat_tinggal`
  MODIFY `id_riwayat_tinggal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `surat_izin_tinggal`
--
ALTER TABLE `surat_izin_tinggal`
  MODIFY `id_surat_izin_tinggal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `surat_izin_tinggal_temp`
--
ALTER TABLE `surat_izin_tinggal_temp`
  MODIFY `id_surat_izin_tinggal_temp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `surat_kematian`
--
ALTER TABLE `surat_kematian`
  MODIFY `id_surat_kematian` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `surat_kematian_temp`
--
ALTER TABLE `surat_kematian_temp`
  MODIFY `id_surat_kematian_temp` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `surat_pindah`
--
ALTER TABLE `surat_pindah`
  MODIFY `id_surat_pindah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `surat_pindah_temp`
--
ALTER TABLE `surat_pindah_temp`
  MODIFY `id_surat_pindah_temp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `anggota_keluarga`
--
ALTER TABLE `anggota_keluarga`
  ADD CONSTRAINT `anggota_keluarga_ibfk_1` FOREIGN KEY (`id_penduduk`) REFERENCES `penduduk` (`id_penduduk`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `anggota_keluarga_ibfk_2` FOREIGN KEY (`id_kk`) REFERENCES `kk` (`id_kk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `anggota_keluarga_pindah`
--
ALTER TABLE `anggota_keluarga_pindah`
  ADD CONSTRAINT `anggota_keluarga_pindah_ibfk_1` FOREIGN KEY (`id_penduduk`) REFERENCES `penduduk` (`id_penduduk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `kk`
--
ALTER TABLE `kk`
  ADD CONSTRAINT `kk_ibfk_1` FOREIGN KEY (`id_penduduk`) REFERENCES `penduduk` (`id_penduduk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `penduduk`
--
ALTER TABLE `penduduk`
  ADD CONSTRAINT `penduduk_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `riwayat_tinggal`
--
ALTER TABLE `riwayat_tinggal`
  ADD CONSTRAINT `riwayat_tinggal_ibfk_1` FOREIGN KEY (`id_penduduk`) REFERENCES `penduduk` (`id_penduduk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `surat_kematian`
--
ALTER TABLE `surat_kematian`
  ADD CONSTRAINT `surat_kematian_ibfk_1` FOREIGN KEY (`id_penduduk`) REFERENCES `penduduk` (`id_penduduk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `surat_kematian_temp`
--
ALTER TABLE `surat_kematian_temp`
  ADD CONSTRAINT `surat_kematian_temp_ibfk_1` FOREIGN KEY (`id_penduduk`) REFERENCES `penduduk` (`id_penduduk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `surat_pindah`
--
ALTER TABLE `surat_pindah`
  ADD CONSTRAINT `surat_pindah_ibfk_1` FOREIGN KEY (`id_penduduk`) REFERENCES `penduduk` (`id_penduduk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `surat_pindah_temp`
--
ALTER TABLE `surat_pindah_temp`
  ADD CONSTRAINT `surat_pindah_temp_ibfk_1` FOREIGN KEY (`id_penduduk`) REFERENCES `penduduk` (`id_penduduk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `role` (`id_role`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
