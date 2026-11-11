<?php
// File: latih1.php (Pertemuan 11 - Slide 3: KONEKSI MYSQL)
require_once __DIR__ . '/mysql_shim.php';

// hostname or ip of server
$servername = 'localhost';
// username and password
$dbusername = 'root';
$dbpassword = '';

$link = mysql_connect("$servername", "$dbusername", "$dbpassword")
    or die(" Not able to connect to server ");

if ($link) {
    echo "ok....koneksi berhasil";
}
?>
