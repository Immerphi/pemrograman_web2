<?php
/**
 * File: setup_db.php
 * Script instalasi otomatis database lat_dbase, tabel tbl_mhs, dan tabel buku_tamu
 * beserta sampel data untuk menguji pagination 5 record.
 * 
 * BISA DIJALANKAN DARI TERMINAL MAUPUN DARI WEB BROWSER!
 */

$is_cli = (php_sapi_name() === 'cli');

$host = 'localhost';
$user = 'root';
$pass = 'rafi123';

// Matikan exception otomatis mysqli agar dapat ditangani manual atau via try-catch
mysqli_report(MYSQLI_REPORT_OFF);

try {
    $koneksi = @mysqli_connect($host, $user, $pass);
} catch (Throwable $t) {
    $koneksi = false;
}

if (!$koneksi) {
    $err = mysqli_connect_error() ?: "No connection could be made because the target machine actively refused it (Port 3306).";
    if ($is_cli) {
        fwrite(STDERR, "\n======================================================\n");
        fwrite(STDERR, " [PERHATIAN] Belum Terhubung ke MySQL Server!\n");
        fwrite(STDERR, "======================================================\n");
        fwrite(STDERR, "Pesan Error: $err\n\n");
        fwrite(STDERR, "Langkah Solusi:\n");
        fwrite(STDERR, "1. Hidupkan MySQL terlebih dahulu:\n");
        fwrite(STDERR, "   - Jika memakai XAMPP: Buka XAMPP Control Panel -> klik [Start] MySQL.\n");
        fwrite(STDERR, "   - Jika memakai MySQL Service Windows: Buka Services (services.msc) -> Start 'MySQL93',\n");
        fwrite(STDERR, "     atau di CMD (Run as Admin) ketik: net start MySQL93\n");
        fwrite(STDERR, "2. Setelah MySQL hidup, jalankan kembali skrip ini di terminal:\n");
        fwrite(STDERR, "   .\\setup_db.bat   atau   php setup_db.php\n");
        fwrite(STDERR, "======================================================\n\n");
        exit(1);
    } else {
        die("<div style='font-family: Arial, sans-serif; padding: 25px; background: #fee2e2; color: #991b1b; border-radius: 8px; margin: 30px auto; max-width: 600px;'>
                <h3 style='margin-top: 0;'>⚠️ Koneksi ke MySQL Gagal</h3>
                <p><strong>Pesan error:</strong> " . htmlspecialchars($err) . "</p>
                <p>Pastikan MySQL (di XAMPP atau Windows Service) sudah dalam status <strong>Running / Start</strong>.</p>
             </div>");
    }
}

// 1. Buat Database
mysqli_query($koneksi, "CREATE DATABASE IF NOT EXISTS `lat_dbase` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci");
mysqli_select_db($koneksi, "lat_dbase");

// 2. Buat Tabel tbl_mhs (Latihan Slide)
$sql_mhs = "CREATE TABLE IF NOT EXISTS `tbl_mhs` (
  `mhsID` int(11) NOT NULL AUTO_INCREMENT,
  `FirstName` varchar(15) DEFAULT NULL,
  `LastName` varchar(15) DEFAULT NULL,
  `Age` int(11) DEFAULT NULL,
  PRIMARY KEY (`mhsID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
mysqli_query($koneksi, $sql_mhs);

// Data awal tbl_mhs jika kosong
$cek_mhs = mysqli_query($koneksi, "SELECT COUNT(*) as jml FROM tbl_mhs");
$row_mhs = mysqli_fetch_assoc($cek_mhs);
if ($row_mhs && $row_mhs['jml'] == 0) {
    mysqli_query($koneksi, "INSERT INTO `tbl_mhs` (`FirstName`, `LastName`, `Age`) VALUES
        ('Anjar', 'Prabowo', 25),
        ('Karina', 'Suwandi', 29),
        ('Glenn', 'Gandari', 32)");
}

// 3. Buat Tabel buku_tamu (Soal Latihan Slide 19)
$sql_bt = "CREATE TABLE IF NOT EXISTS `buku_tamu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `pesan` text NOT NULL,
  `tgl_kunjung` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
mysqli_query($koneksi, $sql_bt);

// Data dummy buku tamu jika kosong atau kurang dari 5 (Wuthering Waves Edition)
$cek_bt = mysqli_query($koneksi, "SELECT COUNT(*) as jml FROM buku_tamu");
$row_bt = mysqli_fetch_assoc($cek_bt);
if ($row_bt && $row_bt['jml'] < 5) {
    mysqli_query($koneksi, "INSERT INTO `buku_tamu` (`nama`, `email`, `alamat`, `pesan`, `tgl_kunjung`) VALUES
        ('Cartethyia', 'cartethyia@rinascita.world', 'Rinascita', 'Sebagai Blessed Maiden (Fleurdelys) dari Rinascita, hembusan angin Aero membimbingku ke buku tamu ini. Semoga harmoni senantiasa menyertai kita!', '2026-10-09 10:00:00'),
        ('Jinhsi', 'jinhsi@jinzhou.gov', 'Jinzhou, Huanglong', 'Salam dari Magistrate of Jinzhou. Sistem buku tamu ini berjalan dengan sangat tertib, rapi, dan harmonis.', '2026-10-10 08:30:00'),
        ('Changli', 'changli@counselor.net', 'Mt. Firmament', 'Sebagai penasihat, langkah pembuatan website ini bagaikan bidak catur yang tersusun dengan strategi sempurna.', '2026-10-10 09:15:00'),
        ('Jiyan', 'jiyan@midnightrangers.mil', 'Norfall Barrens', 'Pasukan Midnight Rangers melaporkan bahwa sistem keamanan dan stabilitas database dalam kondisi prima.', '2026-10-11 10:00:00'),
        ('Yinlin', 'yinlin@blackshores.org', 'Guixu Port', 'Zapstring tidak mendeteksi adanya celah keamanan SQL injection. Desain antarmuka web ini cukup menarik.', '2026-10-11 11:20:00'),
        ('Shorekeeper', 'shorekeeper@blackshores.org', 'The Black Shores', 'Data ini telah terarsip rapi dalam sistem Black Shores. Mekanisme pagination 5 record per halaman bekerja sangat presisi.', '2026-10-12 13:45:00'),
        ('Camellya', 'camellya@blackshores.org', 'Tethys Deep', 'Fufufu... takdir mempertemukan kita di buku tamu ini. Semoga kita segera berpetualang bersama lagi, Rover!', '2026-10-12 14:10:00'),
        ('Xiangli Yao', 'xiangli.yao@huaxu.edu', 'Huaxu Academy', 'Algoritma pagination 5 record ini efisien dan sesuai dengan standar komputasi riset laboratorium kami.', '2026-10-13 15:00:00'),
        ('Zhezhi', 'zhezhi@artist.net', 'Jinzhou Crafts', 'Kombinasi warna dan tata letak CSS pada website buku tamu ini sangat artistik dan memanjakan mata!', '2026-10-13 16:30:00'),
        ('Yangyang', 'yangyang@rangers.org', 'Central Plains', 'Semilir angin membawa kabar baik bahwa tugas praktikum Pemrograman Web 2 ini telah diselesaikan dengan sangat baik.', '2026-10-14 07:15:00'),
        ('Chixia', 'chixia@patrol.gov', 'Jinzhou City', 'Pahlawan Jinzhou Chixia siap beraksi! Jangan ragu hubungi aku kalau ada bug atau error di web ini ya!', '2026-10-14 08:00:00'),
        ('Sanhua', 'sanhua@guard.gov', 'Jinzhou City Hall', 'Suhu dan stabilitas sistem berada dalam batas normal. Catatan ini berada di halaman ketiga sistem pagination.', '2026-10-14 09:00:00'),
        ('Calcharo', 'calcharo@ghosthounds.net', 'Tiger Maw', 'Ghost Hounds tidak menemukan kendala teknis. Eksekusi sistem database berjalan tanpa kompromi.', '2026-10-14 09:30:00'),
        ('Encore', 'encore@blackshores.org', 'The Black Shores', 'Cosmos dan Cloudy bilang website buku tamu ini lucu dan seru banget! Ayo kita rayakan!', '2026-10-14 09:45:00'),
        ('Rover', 'rover@solaris3.world', 'Solaris-3', 'Perjalanan melintasi Solaris-3 membawaku ke website ini. Navigasi pagination 5 record terbukti dinamis dan lancar!', '2026-10-14 10:00:00')");
}


// JIKA DIJALANKAN DARI TERMINAL (CLI)
if ($is_cli) {
    echo "\n";
    echo "========================================================\n";
    echo "  SETUP DATABASE PEMROGRAMAN WEB 2 BERHASIL! (CLI MODE) \n";
    echo "========================================================\n";
    echo " [OK] Database: lat_dbase siap digunakan.\n";
    echo " [OK] Tabel   : tbl_mhs (Latihan Slide Pertemuan 11).\n";
    echo " [OK] Tabel   : buku_tamu (Soal Latihan Slide 19).\n";
    echo " [OK] Data    : 15 sampel data buku tamu (Wuthering Waves)\n";

    echo "                membuktikan pagination 5 record per halaman.\n";
    echo "--------------------------------------------------------\n";
    echo " Untuk menjalankan web server lokal dari terminal:\n";
    echo " php -S localhost:8000   (atau jalankan .\\jalankan_server.bat)\n";
    echo " Lalu buka di browser: http://localhost:8000\n";
    echo "========================================================\n\n";
    exit(0);
}

// JIKA DIJALANKAN DARI WEB BROWSER
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inisialisasi Database Sukses</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f8fafc; padding: 40px 20px; }
        .box { max-width: 550px; margin: 0 auto; background: white; padding: 30px; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.08); border-top: 5px solid #10b981; }
        h2 { color: #065f46; margin-top: 0; }
        ul { line-height: 1.8; color: #334155; }
        .btn { display: inline-block; padding: 10px 18px; background: #4f46e5; color: white; text-decoration: none; border-radius: 6px; font-weight: 600; font-size: 14px; margin-top: 15px; }
        .btn:hover { background: #4338ca; }
    </style>
</head>
<body>
    <div class="box">
        <h2>✅ Setup Database Berhasil!</h2>
        <p>Database dan seluruh tabel telah berhasil dikonfigurasi:</p>
        <ul>
            <li><strong>Database:</strong> <code>lat_dbase</code> siap digunakan.</li>
            <li><strong>Tabel:</strong> <code>tbl_mhs</code> (Materi Slide Pertemuan 11).</li>
            <li><strong>Tabel:</strong> <code>buku_tamu</code> (Soal Latihan Slide 19).</li>
            <li><strong>Sampel Data:</strong> 12 data buku tamu siap diuji untuk membuktikan <strong>Pagination 5 record / halaman</strong> (3 halaman total).</li>
        </ul>
        <div style="display: flex; gap: 10px; margin-top: 20px;">
            <a href="buku_tamu/tampil.php" class="btn">📋 Buka Daftar Buku Tamu</a>
            <a href="index.php" class="btn" style="background: #64748b;">🏠 Menu Utama</a>
        </div>
    </div>
</body>
</html>
