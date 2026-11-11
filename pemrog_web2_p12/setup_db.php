<?php
/**
 * File: setup_db.php
 * Script Setup & Reset Database Otomatis untuk Pertemuan 12:
 * 1. Database lat_dbase -> Tabel tbl_mhs (100% Karakter HSR, Wuthering Waves, & ZZZ)
 * 2. Database artikel_db -> Tabel artikel (Artikel bertema HSR, Wuthering Waves, & ZZZ)
 * 
 * BISA DIJALANKAN DARI TERMINAL (CLI) MAUPUN DARI WEB BROWSER!
 */

$is_cli = (php_sapi_name() === 'cli');

$host = 'localhost';
$passwords = ['rafi123', '', 'root'];
$user = 'root';

mysqli_report(MYSQLI_REPORT_OFF);

$conn = false;
$used_pass = '';

foreach ($passwords as $p) {
    try {
        $c = @mysqli_connect($host, $user, $p);
        if ($c) {
            $conn = $c;
            $used_pass = $p;
            break;
        }
    } catch (Throwable $e) {}
}

if (!$conn) {
    $err = mysqli_connect_error() ?: "Tidak dapat terhubung ke MySQL Server (Port 3306).";
    if ($is_cli) {
        fwrite(STDERR, "\n======================================================\n");
        fwrite(STDERR, " [PERHATIAN] Belum Terhubung ke MySQL Server!\n");
        fwrite(STDERR, "======================================================\n");
        fwrite(STDERR, "Pesan Error: $err\n\n");
        fwrite(STDERR, "Langkah Solusi:\n");
        fwrite(STDERR, "1. Hidupkan MySQL terlebih dahulu:\n");
        fwrite(STDERR, "   - Jika memakai Laragon: Buka Laragon -> klik [Start All].\n");
        fwrite(STDERR, "   - Jika memakai XAMPP: Buka XAMPP -> klik [Start] MySQL.\n");
        fwrite(STDERR, "   - Jika memakai Windows Service: CMD (Admin) -> 'net start MySQL93'\n");
        fwrite(STDERR, "======================================================\n\n");
        exit(1);
    } else {
        die("<div style='font-family: Arial, sans-serif; padding: 25px; background: #fee2e2; color: #991b1b; border-radius: 8px; margin: 30px auto; max-width: 600px;'>
                <h3 style='margin-top: 0;'>⚠️ Koneksi ke MySQL Gagal</h3>
                <p><strong>Pesan error:</strong> " . htmlspecialchars($err) . "</p>
                <p>Pastikan MySQL server sudah berjalan di port 3306.</p>
             </div>");
    }
}

// Eksekusi Setup
$log = [];

// 1. Setup lat_dbase
mysqli_query($conn, "CREATE DATABASE IF NOT EXISTS `lat_dbase` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci");
mysqli_select_db($conn, 'lat_dbase');

mysqli_query($conn, "DROP TABLE IF EXISTS `tbl_mhs`");
$create_mhs = "CREATE TABLE `tbl_mhs` (
  `mhsID` int(11) NOT NULL AUTO_INCREMENT,
  `FirstName` varchar(50) DEFAULT NULL,
  `LastName` varchar(50) DEFAULT NULL,
  `Age` int(11) DEFAULT NULL,
  PRIMARY KEY (`mhsID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
mysqli_query($conn, $create_mhs);

$insert_mhs = "INSERT INTO `tbl_mhs` (`mhsID`, `FirstName`, `LastName`, `Age`) VALUES
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
(12, 'Jin', 'Hsi', 21)";
mysqli_query($conn, $insert_mhs);
$log[] = "✅ Database 'lat_dbase' & Tabel 'tbl_mhs' berhasil disiapkan (12 Karakter HSR, WuWa, & ZZZ).";

// 2. Setup artikel_db
mysqli_query($conn, "CREATE DATABASE IF NOT EXISTS `artikel_db` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci");
mysqli_select_db($conn, 'artikel_db');

mysqli_query($conn, "DROP TABLE IF EXISTS `artikel`");
$create_artikel = "CREATE TABLE `artikel` (
  `articleID` int(11) NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) NOT NULL,
  `penulis` varchar(100) NOT NULL,
  `lead` text NOT NULL,
  `isi` longtext NOT NULL,
  `waktu` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`articleID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
mysqli_query($conn, $create_artikel);

$insert_artikel = "INSERT INTO `artikel` (`articleID`, `judul`, `penulis`, `lead`, `isi`, `waktu`) VALUES
(1, 'Navigasi Hollow Zero dan Ekstraksi Ether di New Eridu', 'Ellen Joe (Zenless Zone Zero)', 'Catatan taktis Victoria Housekeeping mengenai bahaya distorsi Ether dan cara bertahan hidup di dalam Hollow.', 'Menjelajahi Hollow Zero di New Eridu membutuhkan konsentrasi dan stamina ekstra. Bersama Victoria Housekeeping, kami sering menghadapi Ethereal yang bermutasi akibat gelombang Ether yang tidak stabil. Selayaknya perintah DELETE dalam SQL, data anomali yang korup harus segera disingkirkan agar rute evakuasi tetap aman bagi warga sipil dan agen lapangan.', '2026-10-28 08:30:00'),

(2, 'Filosofi Pengaturan Resonansi dan Strategi Perang Jinzhou', 'Changli (Wuthering Waves)', 'Penasihat Pengadilan Jinzhou membagikan panduan membaca frekuensi data Tacet Discords dan taktik formasi.', 'Di bawah naungan gunung Mt. Firmament dan langit Jinzhou, setiap Resonator wajib menguasai ritme frekuensi musuh. Mengelola formasi perang menuntut ketepatan yang tinggi seperti penggunaan klausa WHERE pada perintah UPDATE, di mana perubahan strategi harus diterapkan secara presisi pada unit yang tepat tanpa mengganggu kesatuan barisan pertahanan Huanglong.', '2026-10-28 09:15:00'),

(3, 'Menembus Batas Bintang: Pengelolaan Arsip Data di Astral Express', 'Kafka (Honkai: Star Rail)', 'Stellaron Hunter mengulas pergerakan benang takdir dan aliran informasi melintasi berbagai galaksi.', 'Dari Stasiun Luar Angkasa Herta hingga gemerlap mimpi di Penacony, arus data memori tersimpan dalam jalinan yang amat rumit. Manipulasi takdir bukanlah hal acak; setiap variabel diubah secara sadar demi mencapai akhir yang telah dirancang oleh Elio, persis seperti manipulasi database terstruktur menggunakan query UPDATE pada sistem penyimpanan galaksi.', '2026-10-28 10:00:00'),

(4, 'Trik Cunning Hares: Mengatur Kontrak Kerja dan Bebas Razia PubSec', 'Nicole Demara (Zenless Zone Zero)', 'Bos Cunning Hares membeberker cara mencatat kontrak komisi Hollow tanpa terlacak polisi Sixth Street.', 'PubSec dan Zhu Yuan selalu mengawasi arus transaksi kami di Sixth Street. Dengan memanfaatkan aplikasi database artikel dan kontrak ini, Cunning Hares dapat mencatat order baru (Create), meninjau rincian biaya (Read), merevisi harga komisi (Update), serta memusnahkan bukti kontrak berisiko (Delete) hanya dengan satu klik!', '2026-10-28 10:45:00'),

(5, 'Sinkronisasi Sistem Tethys dan Misteri Lautan Hitam Solaris-3', 'Shorekeeper (Wuthering Waves)', 'Eksplorasi ilmiah tentang pengolahan data masa lalu dan penjagaan frekuensi waktu di Black Shores.', 'Sistem komputasi Tethys menyimpan miliaran memori dari setiap era di Solaris-3. Mengolah data skala raksasa ini membutuhkan mekanisme pembersihan berkala agar tidak terjadi distorsi gelombang frekuensi yang dapat membahayakan kestabilan realitas waktu di Black Shores.', '2026-10-28 11:15:00')";
mysqli_query($conn, $insert_artikel);
$log[] = "✅ Database 'artikel_db' & Tabel 'artikel' berhasil disiapkan (5 artikel Karakter HSR, WuWa, & ZZZ).";

if ($is_cli) {
    echo "\n======================================================\n";
    echo " SETUP DATABASE PERTEMUAN 12 SELESAI\n";
    echo " (Edisi Karakter HSR, Wuthering Waves, & ZZZ)\n";
    echo "======================================================\n";
    foreach ($log as $l) {
        echo $l . "\n";
    }
    echo "Koneksi berhasil menggunakan user 'root'\n";
    echo "======================================================\n\n";
} else {
    ?>
    <!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8">
        <title>Setup Database Pertemuan 12 Berhasil</title>
        <style>
            body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f0fdf4; padding: 40px; color: #166534; }
            .box { max-width: 600px; margin: 0 auto; background: white; padding: 30px; border-radius: 12px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); border-left: 6px solid #22c55e; }
            h2 { margin-top: 0; color: #15803d; }
            ul { padding-left: 20px; line-height: 1.8; }
            .btn { display: inline-block; padding: 10px 20px; background: #16a34a; color: white; text-decoration: none; border-radius: 6px; font-weight: bold; margin-top: 15px; }
            .btn:hover { background: #15803d; }
        </style>
    </head>
    <body>
        <div class="box">
            <h2>🎉 Inisialisasi Database Sukses!</h2>
            <p>Database 100% edisi karakter Honkai: Star Rail, Wuthering Waves, dan Zenless Zone Zero telah selesai dibuat:</p>
            <ul>
                <?php foreach ($log as $l): ?>
                    <li><?= htmlspecialchars($l) ?></li>
                <?php endforeach; ?>
            </ul>
            <a href="index.php" class="btn">Kembali ke Dashboard Utama</a>
        </div>
    </body>
    </html>
    <?php
}
