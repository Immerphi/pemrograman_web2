-- ========================================================
-- Script SQL: Pemrograman Web 2 - Pertemuan 10 & 11
-- Database: lat_dbase
-- Folder: pemrog_web2_latihan
-- ========================================================

CREATE DATABASE IF NOT EXISTS `lat_dbase` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `lat_dbase`;

-- --------------------------------------------------------
-- 1. Tabel untuk Latihan Slide Pertemuan 11 (tbl_mhs)
-- --------------------------------------------------------
DROP TABLE IF EXISTS `tbl_mhs`;
CREATE TABLE `tbl_mhs` (
  `mhsID` int(11) NOT NULL AUTO_INCREMENT,
  `FirstName` varchar(15) DEFAULT NULL,
  `LastName` varchar(15) DEFAULT NULL,
  `Age` int(11) DEFAULT NULL,
  PRIMARY KEY (`mhsID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Data Awal Latihan Slide (Latih 3 & Latih 4)
INSERT INTO `tbl_mhs` (`mhsID`, `FirstName`, `LastName`, `Age`) VALUES
(1, 'Anjar', 'Prabowo', 25),
(2, 'Karina', 'Suwandi', 29),
(3, 'Glenn', 'Gandari', 32);

-- --------------------------------------------------------
-- 2. Tabel untuk Soal Latihan Slide 19: Buku Tamu (buku_tamu)
-- --------------------------------------------------------
DROP TABLE IF EXISTS `buku_tamu`;
CREATE TABLE `buku_tamu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `pesan` text NOT NULL,
  `tgl_kunjung` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Data Contoh (15 Records) untuk Membuktikan Pagination 5 Record per Halaman (Wuthering Waves Edition)
INSERT INTO `buku_tamu` (`id`, `nama`, `email`, `alamat`, `pesan`, `tgl_kunjung`) VALUES
(1, 'Cartethyia', 'cartethyia@rinascita.world', 'Rinascita', 'Sebagai Blessed Maiden (Fleurdelys) dari Rinascita, hembusan angin Aero membimbingku ke buku tamu ini. Semoga harmoni senantiasa menyertai kita!', '2026-10-09 10:00:00'),
(2, 'Jinhsi', 'jinhsi@jinzhou.gov', 'Jinzhou, Huanglong', 'Salam dari Magistrate of Jinzhou. Sistem buku tamu ini berjalan dengan sangat tertib, rapi, dan harmonis.', '2026-10-10 08:30:00'),
(3, 'Changli', 'changli@counselor.net', 'Mt. Firmament', 'Sebagai penasihat, langkah pembuatan website ini bagaikan bidak catur yang tersusun dengan strategi sempurna.', '2026-10-10 09:15:00'),
(4, 'Jiyan', 'jiyan@midnightrangers.mil', 'Norfall Barrens', 'Pasukan Midnight Rangers melaporkan bahwa sistem keamanan dan stabilitas database dalam kondisi prima.', '2026-10-11 10:00:00'),
(5, 'Yinlin', 'yinlin@blackshores.org', 'Guixu Port', 'Zapstring tidak mendeteksi adanya celah keamanan SQL injection. Desain antarmuka web ini cukup menarik.', '2026-10-11 11:20:00'),
(6, 'Shorekeeper', 'shorekeeper@blackshores.org', 'The Black Shores', 'Data ini telah terarsip rapi dalam sistem Black Shores. Mekanisme pagination 5 record per halaman bekerja sangat presisi.', '2026-10-12 13:45:00'),
(7, 'Camellya', 'camellya@blackshores.org', 'Tethys Deep', 'Fufufu... takdir mempertemukan kita di buku tamu ini. Semoga kita segera berpetualang bersama lagi, Rover!', '2026-10-12 14:10:00'),
(8, 'Xiangli Yao', 'xiangli.yao@huaxu.edu', 'Huaxu Academy', 'Algoritma pagination 5 record ini efisien dan sesuai dengan standar komputasi riset laboratorium kami.', '2026-10-13 15:00:00'),
(9, 'Zhezhi', 'zhezhi@artist.net', 'Jinzhou Crafts', 'Kombinasi warna dan tata letak CSS pada website buku tamu ini sangat artistik dan memanjakan mata!', '2026-10-13 16:30:00'),
(10, 'Yangyang', 'yangyang@rangers.org', 'Central Plains', 'Semilir angin membawa kabar baik bahwa tugas praktikum Pemrograman Web 2 ini telah diselesaikan dengan sangat baik.', '2026-10-14 07:15:00'),
(11, 'Chixia', 'chixia@patrol.gov', 'Jinzhou City', 'Pahlawan Jinzhou Chixia siap beraksi! Jangan ragu hubungi aku kalau ada bug atau error di web ini ya!', '2026-10-14 08:00:00'),
(12, 'Sanhua', 'sanhua@guard.gov', 'Jinzhou City Hall', 'Suhu dan stabilitas sistem berada dalam batas normal. Catatan ini berada di halaman ketiga sistem pagination.', '2026-10-14 09:00:00'),
(13, 'Calcharo', 'calcharo@ghosthounds.net', 'Tiger Maw', 'Ghost Hounds tidak menemukan kendala teknis. Eksekusi sistem database berjalan tanpa kompromi.', '2026-10-14 09:30:00'),
(14, 'Encore', 'encore@blackshores.org', 'The Black Shores', 'Cosmos dan Cloudy bilang website buku tamu ini lucu dan seru banget! Ayo kita rayakan!', '2026-10-14 09:45:00'),
(15, 'Rover', 'rover@solaris3.world', 'Solaris-3', 'Perjalanan melintasi Solaris-3 membawaku ke website ini. Navigasi pagination 5 record terbukti dinamis dan lancar!', '2026-10-14 10:00:00');


