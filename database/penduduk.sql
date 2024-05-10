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
-- Struktur dari tabel `anggota_keluarga`
--

CREATE TABLE `anggota_keluarga` (
  `id_anggota` int(11) NOT NULL,
  `id_kk` int(11) NOT NULL,
  `id_penduduk` int(11) NOT NULL,
  `hub_keluarga` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `anggota_keluarga`
--

INSERT INTO `anggota_keluarga` (`id_anggota`, `id_kk`, `id_penduduk`, `hub_keluarga`) VALUES
(3, 1, 7, 'Anak'),
(18, 1, 7, 'Anak');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kk`
--

CREATE TABLE `kk` (
  `id_kk` int(11) NOT NULL,
  `no_kk` varchar(16) NOT NULL,
  `id_penduduk` int(11) NOT NULL,
  `k_keluarga` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kk`
--

INSERT INTO `kk` (`id_kk`, `no_kk`, `id_penduduk`, `k_keluarga`) VALUES
(1, '3277098734467891', 6, 'Samid');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penduduk`
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
  `status_perkawinan_penduduk` enum('Kawin','Tidak Kawin') NOT NULL,
  `status` enum('Ada','Meninggal','Pindah','Izin Tinggal') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `penduduk`
--

INSERT INTO `penduduk` (`id_penduduk`, `nik_penduduk`, `nama_penduduk`, `tempat_lahir_penduduk`, `tanggal_lahir_penduduk`, `jenis_kelamin_penduduk`, `alamat_ktp_penduduk`, `alamat_penduduk`, `desa_kelurahan_penduduk`, `kecamatan_penduduk`, `kabupaten_kota_penduduk`, `provinsi_penduduk`, `negara_penduduk`, `rt_penduduk`, `rw_penduduk`, `agama_penduduk`, `pendidikan_terakhir_penduduk`, `pekerjaan_penduduk`, `status_perkawinan_penduduk`, `status`) VALUES
(6, '3277982345671953', 'Samid', 'Bandung', '2003-07-22', 'Laki-Laki', 'Jl Pesantren', 'Jl Pesantren', 'Cibabat', 'Cimahi Utara', 'Cimahi', 'Jawa Barat', 'WNI', '3', '5', 'Islam', 'SD', 'Programmer', 'Kawin', 'Ada'),
(7, '3277982345671954', 'Bagja', 'Cimahi', '2000-09-07', 'Laki-Laki', 'Jl Pesantren', 'Jl Pesantren', 'Cibabat', 'Cimahi Utara', 'Cimahi', 'Jawa Barat', 'WNI', '3', '5', 'Islam', 'S1', 'Bekerja', 'Tidak Kawin', 'Ada'),
(8, '3277982345671955', 'Kusni', 'Cimahi', '2013-09-19', 'Perempuan', 'Jl Pesantren', 'Jl Pesantren', 'Cibabat', 'Cimahi Utara', 'Cimahi', 'Jawa Barat', 'WNI', '3', '5', 'Islam', 'SD', 'Belum Bekerja', 'Tidak Kawin', 'Ada'),
(9, '3277982345671955', 'Tes', 'Cimahi', '2004-05-06', 'Laki-Laki', 'tes', 'tes', 'tes', 'tes', 'tes', 'tes', 'WNI', '6', '9', 'Konghucu', 'D1', 'tes', 'Tidak Kawin', 'Ada'),
(11, '3277030911060001', 'Mantap', 'ghjghj', '2006-11-09', 'Laki-Laki', 'hgjghj', 'ghjgh', 'ghj', 'ghj', 'ghj', 'ghj', 'WNI', '6', '8', 'Islam', 'D2', 'fsg', 'Tidak Kawin', 'Meninggal');

-- --------------------------------------------------------

--
-- Struktur dari tabel `role`
--

CREATE TABLE `role` (
  `id_role` int(11) NOT NULL,
  `nama_role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `role`
--

INSERT INTO `role` (`id_role`, `nama_role`) VALUES
(1, 'Admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `surat_kematian`
--

CREATE TABLE `surat_kematian` (
  `id_surat_kematian` int(11) NOT NULL,
  `id_penduduk` int(11) NOT NULL,
  `tanggal_kematian` date NOT NULL,
  `jam_kematian` time NOT NULL,
  `penyebab_kematian` varchar(255) NOT NULL,
  `tempat_kematian` varchar(255) NOT NULL,
  `usia_kematian` int(11) NOT NULL,
  `bin_binti` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `surat_kematian`
--

INSERT INTO `surat_kematian` (`id_surat_kematian`, `id_penduduk`, `tanggal_kematian`, `jam_kematian`, `penyebab_kematian`, `tempat_kematian`, `usia_kematian`, `bin_binti`) VALUES
(5, 11, '2024-03-05', '14:03:00', 'Penyakitt', 'Rumahh', 18, 'Kadunn');

-- --------------------------------------------------------

--
-- Struktur dari tabel `surat_pindah`
--

CREATE TABLE `surat_pindah` (
  `id_surat_pindah` int(11) NOT NULL,
  `id_penduduk` int(11) NOT NULL,
  `alamat_asal` varchar(255) NOT NULL,
  `alamat_tujuan` varchar(255) NOT NULL,
  `alasan_pindah` varchar(255) NOT NULL,
  `keluarga_pindah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `id_role` int(11) NOT NULL,
  `nama_user` varchar(45) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(32) NOT NULL,
  `status_user` enum('RT','RW','Penduduk','Kecamatan','Admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `id_role`, `nama_user`, `username`, `password`, `status_user`) VALUES
(1, 1, 'Admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `anggota_keluarga`
--
ALTER TABLE `anggota_keluarga`
  ADD PRIMARY KEY (`id_anggota`),
  ADD KEY `id_kk` (`id_kk`,`id_penduduk`),
  ADD KEY `id_penduduk` (`id_penduduk`);

--
-- Indeks untuk tabel `kk`
--
ALTER TABLE `kk`
  ADD PRIMARY KEY (`id_kk`),
  ADD KEY `id_penduduk` (`id_penduduk`);

--
-- Indeks untuk tabel `penduduk`
--
ALTER TABLE `penduduk`
  ADD PRIMARY KEY (`id_penduduk`);

--
-- Indeks untuk tabel `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indeks untuk tabel `surat_kematian`
--
ALTER TABLE `surat_kematian`
  ADD PRIMARY KEY (`id_surat_kematian`),
  ADD KEY `id_penduduk` (`id_penduduk`);

--
-- Indeks untuk tabel `surat_pindah`
--
ALTER TABLE `surat_pindah`
  ADD PRIMARY KEY (`id_surat_pindah`),
  ADD KEY `id_penduduk` (`id_penduduk`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_role` (`id_role`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `anggota_keluarga`
--
ALTER TABLE `anggota_keluarga`
  MODIFY `id_anggota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `kk`
--
ALTER TABLE `kk`
  MODIFY `id_kk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `penduduk`
--
ALTER TABLE `penduduk`
  MODIFY `id_penduduk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `role`
--
ALTER TABLE `role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `surat_kematian`
--
ALTER TABLE `surat_kematian`
  MODIFY `id_surat_kematian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `surat_pindah`
--
ALTER TABLE `surat_pindah`
  MODIFY `id_surat_pindah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `anggota_keluarga`
--
ALTER TABLE `anggota_keluarga`
  ADD CONSTRAINT `anggota_keluarga_ibfk_1` FOREIGN KEY (`id_penduduk`) REFERENCES `penduduk` (`id_penduduk`) ON UPDATE CASCADE,
  ADD CONSTRAINT `anggota_keluarga_ibfk_2` FOREIGN KEY (`id_kk`) REFERENCES `kk` (`id_kk`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `kk`
--
ALTER TABLE `kk`
  ADD CONSTRAINT `kk_ibfk_1` FOREIGN KEY (`id_penduduk`) REFERENCES `penduduk` (`id_penduduk`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `surat_kematian`
--
ALTER TABLE `surat_kematian`
  ADD CONSTRAINT `surat_kematian_ibfk_1` FOREIGN KEY (`id_penduduk`) REFERENCES `penduduk` (`id_penduduk`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `surat_pindah`
--
ALTER TABLE `surat_pindah`
  ADD CONSTRAINT `surat_pindah_ibfk_1` FOREIGN KEY (`id_penduduk`) REFERENCES `penduduk` (`id_penduduk`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `role` (`id_role`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;