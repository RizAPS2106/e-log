-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 08, 2020 at 09:09 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.2.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `elog`
--

-- --------------------------------------------------------

--
-- Table structure for table `jurusan`
--

CREATE TABLE `jurusan` (
  `id_jurusan` int(11) NOT NULL,
  `nama_jurusan` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jurusan`
--

INSERT INTO `jurusan` (`id_jurusan`, `nama_jurusan`) VALUES
(1, 'MEKATRONIKA'),
(2, 'REKAYASA PERANGKAT LUNAK'),
(3, 'MULTIMEDIA'),
(4, 'ANIMASI'),
(5, 'KIMIA INDUSTRI'),
(6, 'TEKNIK PEMESINAN');

-- --------------------------------------------------------

--
-- Table structure for table `kasus`
--

CREATE TABLE `kasus` (
  `id_kasus` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `id_pelanggaran` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `id_pembimbing` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `penanganan` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kasus`
--

INSERT INTO `kasus` (`id_kasus`, `id_siswa`, `id_pelanggaran`, `id_pegawai`, `id_pembimbing`, `tanggal`, `penanganan`) VALUES
(1, 5, 6, 1, 2, '2020-10-25', 'Diberi teguran lisan'),
(2, 6, 5, 1, 2, '2020-10-25', 'Diberi teguran lisan'),
(3, 7, 1, 1, 2, '2020-10-25', 'ditegur'),
(4, 8, 9, 1, 2, '2020-10-25', 'Diberi teguran lisan'),
(5, 5, 1, 1, 2, '2020-11-07', 'ditegur'),
(6, 7, 1, 1, 2, '2020-12-08', 'Diberi teguran lisan'),
(7, 7, 1, 1, 2, '2020-12-08', 'dipanggil ortu');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` enum('Rendah','Sedang','Tinggi') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Rendah'),
(2, 'Sedang'),
(3, 'Tinggi');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(11) NOT NULL,
  `id_jurusan` int(11) NOT NULL,
  `id_pembimbing` int(11) NOT NULL,
  `nama_kelas` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `id_jurusan`, `id_pembimbing`, `nama_kelas`) VALUES
(1, 1, 5, 'X MEKA A'),
(2, 1, 6, 'X MEKA B'),
(3, 1, 7, 'X MEKA C'),
(4, 1, 8, 'X MEKA D'),
(5, 2, 9, 'X RPL A'),
(6, 2, 10, 'X RPL B'),
(7, 3, 11, 'X MULTIMEDIA A'),
(8, 3, 12, 'X MULTIMEDIA B'),
(9, 3, 13, 'X MULTIMEDIA C'),
(10, 4, 14, 'X ANIMASI A'),
(11, 4, 15, 'X ANIMASI B'),
(12, 5, 16, 'X KIMIA A'),
(13, 5, 17, 'X KIMIA B'),
(14, 5, 18, 'X KIMIA C'),
(15, 6, 19, 'X MESIN A'),
(16, 6, 20, 'X MESIN B');

-- --------------------------------------------------------

--
-- Table structure for table `ortu`
--

CREATE TABLE `ortu` (
  `id_ortu` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_pembimbing` int(11) NOT NULL,
  `nama_ortu` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ortu`
--

INSERT INTO `ortu` (`id_ortu`, `id_siswa`, `id_user`, `id_pembimbing`, `nama_ortu`) VALUES
(1, 1, 6, 1, 'Pa Jajang'),
(2, 5, 31, 2, 'Edi'),
(3, 10, 32, 3, 'Retno'),
(4, 15, 33, 4, 'Ika');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id_pegawai` int(11) NOT NULL,
  `bidang` enum('Kurikulum','Kesiswaan') NOT NULL,
  `nip` varchar(15) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `bidang`, `nip`, `id_user`) VALUES
(1, 'Kurikulum', '10238642', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggaran`
--

CREATE TABLE `pelanggaran` (
  `id_pelanggaran` int(11) NOT NULL,
  `nama_pelanggaran` varchar(200) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `point` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pelanggaran`
--

INSERT INTO `pelanggaran` (`id_pelanggaran`, `nama_pelanggaran`, `id_kategori`, `point`) VALUES
(1, 'Keluar kelas tanpa izin', 1, '10'),
(2, 'Memakai seragam tidak sesuai aturan', 1, '10'),
(5, 'Tidak mengikuti upacara Bendera', 1, '10'),
(6, 'Mabal', 1, '10'),
(7, 'Memakai seragam tidak lengkap atribut', 1, '25'),
(8, 'Membawa obat-obatan terlarang ke dalam sekolahan', 3, '100'),
(9, 'Mengotori/Mencorat-coret lingkungan sekolah', 1, '35');

-- --------------------------------------------------------

--
-- Table structure for table `pembimbing`
--

CREATE TABLE `pembimbing` (
  `id_pembimbing` int(11) NOT NULL,
  `bidang` enum('BK','Wali Kelas') NOT NULL,
  `nama` varchar(200) NOT NULL,
  `nip` varchar(15) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pembimbing`
--

INSERT INTO `pembimbing` (`id_pembimbing`, `bidang`, `nama`, `nip`, `id_user`) VALUES
(1, 'BK', 'Bu Diah', '09346328', 1),
(2, 'BK', 'Bu Ida', '9832647', 2),
(3, 'BK', 'Bu Dini', '09348932', 8),
(4, 'BK', 'Pa Dani', '873264', 9),
(5, 'Wali Kelas', 'Pa Anwar', '7826482', 10),
(6, 'Wali Kelas', 'Bu Didin', '7126478', 11),
(7, 'Wali Kelas', 'Pa Agus', '7826478', 12),
(8, 'Wali Kelas', 'Bu Ririn', '8736487', 13),
(9, 'Wali Kelas', 'Bu Dwi', '8246372', 14),
(10, 'Wali Kelas', 'Bu Idhi', '289178', 15),
(11, 'Wali Kelas', 'Bu Dewi', '236478', 16),
(12, 'Wali Kelas', 'Eri', '91387932', 22),
(13, 'Wali Kelas', 'David', '09176', 23),
(14, 'Wali Kelas', 'Idah', '0928739', 24),
(15, 'Wali Kelas', 'Tatang', '0762176', 25),
(16, 'Wali Kelas', 'Indah', '12378', 26),
(17, 'Wali Kelas', 'Isa', '12377284', 27),
(18, 'Wali Kelas', 'Deni', '32478', 28),
(19, 'Wali Kelas', 'Rizki', '438492', 29),
(20, 'Wali Kelas', 'Rianti', '891468', 30);

-- --------------------------------------------------------

--
-- Table structure for table `pemkel`
--

CREATE TABLE `pemkel` (
  `id_pemkel` int(11) NOT NULL,
  `id_pembimbing` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pemkel`
--

INSERT INTO `pemkel` (`id_pemkel`, `id_pembimbing`, `id_kelas`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 2, 5),
(6, 2, 6),
(7, 2, 7),
(8, 2, 8),
(9, 2, 9),
(10, 3, 10),
(11, 3, 11),
(12, 3, 12),
(13, 3, 13),
(14, 3, 14),
(15, 4, 15),
(16, 4, 16);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id_role` int(11) NOT NULL,
  `role` enum('Wali Kelas','BK','Kurikulum','Kesiswaan','Ortu','Siswa','Admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id_role`, `role`) VALUES
(1, 'BK'),
(2, 'Wali Kelas'),
(3, 'Kurikulum'),
(4, 'Kesiswaan'),
(5, 'Siswa'),
(6, 'Ortu'),
(7, 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id_siswa` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama_siswa` varchar(200) NOT NULL,
  `nis` int(11) NOT NULL,
  `sisa_point` varchar(3) NOT NULL,
  `id_kelas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id_siswa`, `id_user`, `nama_siswa`, `nis`, `sisa_point`, `id_kelas`) VALUES
(1, 5, 'Siti', 9967097, '100', 1),
(2, 7, 'Ipeeh', 364873, '100', 2),
(3, 17, 'Ecy', 238732, '100', 3),
(4, 18, 'Iki', 8732648, '100', 4),
(5, 19, 'Ardi', 83748, '80', 5),
(6, 20, 'Ameel', 324678, '90', 6),
(7, 21, 'Nisa', 912648, '70', 7),
(8, 34, 'Dian', 328947324, '55', 8),
(9, 35, 'Reza', 982374, '90', 9),
(10, 36, 'Reni', 324787, '100', 10),
(11, 37, 'Dadah', 8912739, '100', 11),
(12, 38, 'Dina', 8216378, '100', 12),
(13, 39, 'Siska', 286874, '100', 13),
(14, 40, 'Rendi', 28947, '100', 14),
(15, 41, 'Rico', 928748, '100', 15),
(16, 42, 'Safi', 9827324, '100', 16);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `id_role` int(11) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `jk` enum('perempuan','laki-laki') NOT NULL,
  `alamat` varchar(500) NOT NULL,
  `nohp` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `id_role`, `nama`, `username`, `password`, `jk`, `alamat`, `nohp`) VALUES
(1, 1, 'Bu Diah', 'bk', 'bk123', 'perempuan', 'cipageran', '09886888'),
(2, 1, 'Bu Ida', 'bk2', 'bk2', 'perempuan', 'kamarung', '927392189'),
(3, 3, 'Pa Ridwan', 'kurikulum', 'kurikulum123', 'laki-laki', 'kbb', '0985237947'),
(4, 4, 'Pa Asep', 'kesiswaan', 'kesiswaan123', 'laki-laki', 'cibeureum', '0324898'),
(5, 5, 'Siti', 'siswa', 'siswa123', 'laki-laki', 'kbb', '193249374'),
(6, 6, 'Pa Jajang', 'ortu', 'ortu123', 'laki-laki', 'cicaheum', '736498939'),
(7, 5, 'Ipeeh', 'siswa2', 'siswa2', 'perempuan', 'citeureup', '09773534'),
(8, 1, 'Bu Dini', 'bk3', 'bk3', 'perempuan', 'kamarung', '084574'),
(9, 1, 'Pa Dani', 'bk4', 'bk4', 'laki-laki', 'citeureup', '0739987432'),
(10, 2, 'Pa Anwar', 'wk', 'wk', 'laki-laki', 'cipageran', '093274897'),
(11, 2, 'Bu Didin', 'wk2', 'wk2', 'perempuan', 'kamarung', '08073483'),
(12, 2, 'Pa Agus', 'wk3', 'wk3', 'laki-laki', 'kamarung', '098347893'),
(13, 2, 'Bu Ririn', 'wk4', 'wk4', 'laki-laki', 'kbb', '09738939'),
(14, 2, 'Bu Dwi', 'wk5', 'wk5', 'perempuan', 'kbb', '097239092'),
(15, 2, 'Bu Idhi', 'wk6', 'wk6', 'perempuan', 'kbb', '090732'),
(16, 2, 'Bu Dewi', 'wk7', 'wk7', 'laki-laki', 'kbb', '0373394'),
(17, 5, 'ecy', 'ecy', 'ecy123', 'perempuan', 'puri', '03294932'),
(18, 5, 'iki', 'iki', 'iki123', 'laki-laki', 'kbb', '09347832'),
(19, 5, 'ardi', 'ardi', 'ardi123', 'laki-laki', 'cempaka', '092178738'),
(20, 5, 'amel', 'amel', 'amel123', 'perempuan', 'kbb', '09270283'),
(21, 5, 'nisa', 'nisa', 'nisa123', 'perempuan', 'kamarung', '091723872'),
(22, 2, 'Bu Eri', 'eri', 'eri123', 'perempuan', 'kbb', '09079498'),
(23, 2, 'Pa David', 'david', 'david123', 'laki-laki', 'kamarung', '0983247'),
(24, 2, 'Bu Idah', 'idah', 'idah123', 'perempuan', 'cicaheum', '08782136'),
(25, 2, 'Pa Tatang', 'tatang', 'tatang123', 'laki-laki', 'bandung', '0989347'),
(26, 2, 'Bu Indah', 'indah', 'indah123', 'perempuan', 'cipageran', '08885724'),
(27, 2, 'Pa Isa', 'isa', 'isa123', 'laki-laki', 'cibiru', '0988076'),
(28, 2, 'Pa Deni', 'deni', 'deni123', 'laki-laki', 'cicalengka', '009789713'),
(29, 2, 'Pa Rizki', 'rizki', 'rizki123', 'laki-laki', 'cisarua', '0978237'),
(30, 2, 'Bu Rianti', 'rianti', 'rianti123', 'perempuan', 'lembang', '08782123'),
(31, 6, 'Pa Edi', 'edi', 'edi123', 'laki-laki', 'cicalengka', '0912873'),
(32, 6, 'Bu Retno', 'retno', 'retno123', 'perempuan', 'kbb', '087721637'),
(33, 6, 'Bu Ika', 'ika', 'ika123', 'perempuan', 'lembang', '087562173'),
(34, 5, 'Dian', 'dian', 'dian123', 'perempuan', 'kamarung', '08657378'),
(35, 5, 'Reza', 'reza', 'reza123', 'laki-laki', 'lembang', '0875127'),
(36, 5, 'Reni', 'reni', 'reni123', 'perempuan', 'cipageran', '08971263'),
(37, 5, 'Dadah', 'dadah', 'dadah123', 'laki-laki', 'cisurupan', '08754218'),
(38, 5, 'Dina', 'dina', 'dina123', 'perempuan', 'cipageran', '08765213226'),
(39, 5, 'Siska', 'siska', 'siska123', 'perempuan', 'cempaka', '08773243'),
(40, 5, 'Rendi', 'rendi', 'rendi123', 'laki-laki', 'permana', '0862334974'),
(41, 5, 'Rico', 'rico', 'rico123', 'laki-laki', 'permana', '08643348'),
(42, 5, 'Safi', 'safi', 'safi123', 'perempuan', 'bandung', '086324538'),
(43, 7, 'Admin', 'admin', 'admin123', 'laki-laki', 'KBB', '0834736487');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`id_jurusan`);

--
-- Indexes for table `kasus`
--
ALTER TABLE `kasus`
  ADD PRIMARY KEY (`id_kasus`),
  ADD KEY `id_pelanggaran` (`id_pelanggaran`),
  ADD KEY `id_pegawai` (`id_pegawai`),
  ADD KEY `id_pembimbing` (`id_pembimbing`),
  ADD KEY `id_siswa2` (`id_siswa`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`),
  ADD KEY `id_pembimbing` (`id_pembimbing`),
  ADD KEY `id_pembimbing_2` (`id_pembimbing`),
  ADD KEY `id_jurusan` (`id_jurusan`);

--
-- Indexes for table `ortu`
--
ALTER TABLE `ortu`
  ADD PRIMARY KEY (`id_ortu`),
  ADD KEY `id_siswa` (`id_siswa`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_pembimbing` (`id_pembimbing`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id_pegawai`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `pelanggaran`
--
ALTER TABLE `pelanggaran`
  ADD PRIMARY KEY (`id_pelanggaran`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indexes for table `pembimbing`
--
ALTER TABLE `pembimbing`
  ADD PRIMARY KEY (`id_pembimbing`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `pemkel`
--
ALTER TABLE `pemkel`
  ADD PRIMARY KEY (`id_pemkel`),
  ADD KEY `id_pembimbing` (`id_pembimbing`),
  ADD KEY `id_kelas` (`id_kelas`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id_siswa`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_kelas` (`id_kelas`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_role` (`id_role`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kasus`
--
ALTER TABLE `kasus`
  ADD CONSTRAINT `kasus_ibfk_2` FOREIGN KEY (`id_pembimbing`) REFERENCES `pembimbing` (`id_pembimbing`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kasus_ibfk_3` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kasus_ibfk_4` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id_siswa`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kasus_ibfk_5` FOREIGN KEY (`id_pelanggaran`) REFERENCES `pelanggaran` (`id_pelanggaran`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kelas`
--
ALTER TABLE `kelas`
  ADD CONSTRAINT `kelas_ibfk_1` FOREIGN KEY (`id_pembimbing`) REFERENCES `pembimbing` (`id_pembimbing`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kelas_ibfk_2` FOREIGN KEY (`id_jurusan`) REFERENCES `jurusan` (`id_jurusan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ortu`
--
ALTER TABLE `ortu`
  ADD CONSTRAINT `ortu_ibfk_1` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id_siswa`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ortu_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ortu_ibfk_3` FOREIGN KEY (`id_pembimbing`) REFERENCES `pembimbing` (`id_pembimbing`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD CONSTRAINT `pegawai_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pelanggaran`
--
ALTER TABLE `pelanggaran`
  ADD CONSTRAINT `pelanggaran_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pembimbing`
--
ALTER TABLE `pembimbing`
  ADD CONSTRAINT `pembimbing_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pemkel`
--
ALTER TABLE `pemkel`
  ADD CONSTRAINT `pemkel_ibfk_1` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pemkel_ibfk_2` FOREIGN KEY (`id_pembimbing`) REFERENCES `pembimbing` (`id_pembimbing`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `siswa_ibfk_1` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `siswa_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `role` (`id_role`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
