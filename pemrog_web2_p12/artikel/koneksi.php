<?php
/**
 * File: koneksi.php
 * Sesuai Slide 6 Pertemuan 12: "Menambah, mengedit dan menghapus artikel - Membuat Koneksi"
 */

require_once __DIR__ . '/../latihan_slide/mysql_shim.php';

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "artikel_db";

// Lakukan koneksi dengan mysql (syntax klasik sesuai slide)
$connection = mysql_connect($dbhost, $dbuser, $dbpass);
if (!$connection) {
    echo "Tidak dapat terhubung dengan database";
    exit;
}

// Pilih database
$pilih_db = mysql_select_db($dbname);
if (!$pilih_db) {
    echo "Tidak dapat memilih database";
    exit;
}

// Menyediakan juga handle koneksi mysqli $conn untuk fleksibilitas kode modern
global $__mysql_global_connection;
$conn = $__mysql_global_connection ?: $connection;
?>
