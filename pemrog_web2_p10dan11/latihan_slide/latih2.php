<?php
// File: latih2.php (Pertemuan 11 - Slide 5: Membuat Database)
require_once __DIR__ . '/mysql_shim.php';

mysql_connect("localhost", "root", "");
$dbname = "lat_dbase";

$cek = mysql_query("CREATE DATABASE IF NOT EXISTS $dbname") or die("Couldn't Create Database: $dbname");

if ($cek) {
    echo "Database $dbname berhasil dibuat";
}
?>
