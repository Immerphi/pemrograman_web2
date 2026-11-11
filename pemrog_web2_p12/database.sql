CREATE DATABASE IF NOT EXISTS `lat_dbase`;
USE `lat_dbase`;

DROP TABLE IF EXISTS `tbl_mhs`;
CREATE TABLE `tbl_mhs` (
  `mhsID` int(11) NOT NULL AUTO_INCREMENT,
  `FirstName` varchar(50) DEFAULT NULL,
  `LastName` varchar(50) DEFAULT NULL,
  `Age` int(11) DEFAULT NULL,
  PRIMARY KEY (`mhsID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `tbl_mhs` (`mhsID`, `FirstName`, `LastName`, `Age`) VALUES
(1, 'Ellen', 'Joe', 18),
(2, 'Jane', 'Doe', 24),
(3, 'Nicole', 'Demara', 22),
(4, 'Billy', 'Kid', 21),
(5, 'Kafka', 'Hunter', 28),
(6, 'Dan', 'Heng', 21),
(7, 'Acheron', 'Raiden', 27),
(8, 'Firefly', 'Glamoth', 20),
(9, 'Chang', 'Li', 25),
(10, 'Yin', 'Lin', 23),
(11, 'Ji', 'Yan', 29),
(12, 'Jin', 'Hsi', 21);


CREATE DATABASE IF NOT EXISTS `artikel_db`;
USE `artikel_db`;

DROP TABLE IF EXISTS `artikel`;
CREATE TABLE `artikel` (
  `articleID` int(11) NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) NOT NULL,
  `penulis` varchar(100) NOT NULL,
  `lead` text NOT NULL,
  `isi` longtext NOT NULL,
  `waktu` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`articleID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `artikel` (`articleID`, `judul`, `penulis`, `lead`, `isi`, `waktu`) VALUES
(1, 'Navigasi Hollow Zero dan Ekstraksi Ether', 'Ellen Joe', 'Catatan taktis mengenai bahaya distorsi Ether dan cara bertahan hidup di dalam Hollow.', 'Menjelajahi Hollow Zero membutuhkan konsentrasi dan stamina ekstra. Selayaknya perintah DELETE dalam SQL, data anomali yang korup harus segera disingkirkan agar rute tetap aman.', '2026-10-28 08:30:00'),
(2, 'Filosofi Pengaturan Resonansi dan Strategi Perang', 'Changli', 'Panduan membaca frekuensi data Tacet Discords dan taktik formasi.', 'Mengelola formasi perang menuntut ketepatan yang tinggi seperti penggunaan klausa WHERE pada perintah UPDATE, di mana perubahan strategi harus diterapkan secara presisi.', '2026-10-28 09:15:00'),
(3, 'Menembus Batas Bintang: Pengelolaan Arsip Data', 'Kafka', 'Catatan pergerakan dan aliran informasi melintasi berbagai ruang.', 'Manipulasi alur peristiwa bukanlah hal acak, melainkan terstruktur layaknya query UPDATE pada sistem penyimpanan basis data.', '2026-10-28 10:00:00'),
(4, 'Trik Cunning Hares: Mengatur Kontrak Kerja', 'Nicole Demara', 'Cara mencatat kontrak komisi pekerjaan secara efisien.', 'Dengan aplikasi database artikel dan kontrak ini, kita dapat mencatat data baru (Create), meninjau rincian (Read), merevisi harga (Update), dan menghapus data (Delete).', '2026-10-28 10:45:00'),
(5, 'Sinkronisasi Sistem Tethys dan Misteri Lautan Hitam', 'Shorekeeper', 'Eksplorasi ilmiah tentang pengolahan data dan penjagaan frekuensi.', 'Sistem komputasi Tethys menyimpan miliaran memori. Mengolah data skala raksasa ini membutuhkan mekanisme pembersihan berkala.', '2026-10-28 11:15:00');
