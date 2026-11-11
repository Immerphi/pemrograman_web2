<?php
/**
 * File: config.php
 * Konfigurasi koneksi database MySQL untuk Aplikasi Buku Tamu
 */

mysqli_report(MYSQLI_REPORT_OFF);

$host = 'localhost';
$user = 'root';
$pass = 'rafi123';
$db   = 'lat_dbase';

// 1. Hubungkan ke MySQL Server
try {
    $conn = @mysqli_connect($host, $user, $pass);
} catch (Throwable $e) {
    $conn = false;
}

if (!$conn) {
    die("<div style='font-family: Arial, sans-serif; padding: 20px; background: #fee2e2; color: #991b1b; border-radius: 8px; margin: 20px; max-width: 600px;'>
            <strong>Koneksi Gagal:</strong> Tidak dapat terhubung ke MySQL Server.<br>
            Pastikan MySQL (XAMPP / MySQL Service) sudah aktif (Running).<br>
            Pesan error: " . (mysqli_connect_error() ?: 'Target machine actively refused connection.') . "
         </div>");
}

// 2. Buat database lat_dbase jika belum ada
mysqli_query($conn, "CREATE DATABASE IF NOT EXISTS `$db` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci");

// 3. Pilih database
mysqli_select_db($conn, $db);

// 4. Pastikan tabel buku_tamu sudah ada secara otomatis
$create_table_sql = "CREATE TABLE IF NOT EXISTS `buku_tamu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `pesan` text NOT NULL,
  `tgl_kunjung` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

mysqli_query($conn, $create_table_sql);
?>
