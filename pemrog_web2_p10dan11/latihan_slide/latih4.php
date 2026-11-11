<?php
// File: latih4.php (Pertemuan 11 - Slide 8: Menyisipkan Data)
require_once __DIR__ . '/mysql_shim.php';

$con = mysql_connect("localhost", "root", "");
if (!$con) {
    die('Could not connect: ' . mysql_error());
}

mysql_select_db("lat_dbase", $con);

$q1 = mysql_query("INSERT INTO tbl_mhs (FirstName, LastName, Age)
VALUES ('Karina', 'Suwandi', '29')");

$q2 = mysql_query("INSERT INTO tbl_mhs (FirstName, LastName, Age)
VALUES ('Glenn', 'Gandari', '32')");

if ($q1 && $q2) {
    echo "Data Karina Suwandi dan Glenn Gandari berhasil disisipkan!";
} else {
    echo "Gagal menyisipkan data: " . mysql_error();
}

mysql_close($con);
?>
