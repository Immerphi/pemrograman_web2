<?php
/**
 * File: reset_tbl_mhs.php
 * Helper untuk mereset data tabel tbl_mhs ke kondisi awal
 * Karakter: Honkai: Star Rail, Wuthering Waves, & Zenless Zone Zero
 */

require_once __DIR__ . '/mysql_shim.php';

$con = mysql_connect("localhost", "root", "");
if (!$con) {
    die("Koneksi gagal: " . mysql_error());
}

mysql_select_db("lat_dbase", $con);

// Hapus isi dan masukkan data awal karakter (HSR, WuWa, ZZZ)
mysql_query("TRUNCATE TABLE tbl_mhs");
mysql_query("INSERT INTO tbl_mhs (`mhsID`, `FirstName`, `LastName`, `Age`) VALUES
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
(12, 'Jin', 'Hsi', 21)");

mysql_close($con);

$redirect = isset($_GET['redirect']) ? $_GET['redirect'] : '../index.php';
header("Location: " . $redirect . "?status=reset_ok");
exit;
