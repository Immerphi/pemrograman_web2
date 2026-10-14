<?php
// File: latih6.php (Pertemuan 11 - Slide 13: Menampilkan Data dengan mysql_fetch_array)
require_once __DIR__ . '/mysql_shim.php';

mysql_connect("localhost", "root", "");
mysql_select_db("lat_dbase");

$hasil = mysql_query("select * from tbl_mhs");

echo "<h3>Data Mahasiswa (mysql_fetch_array - berbasis nama field):</h3>";
while ($data = mysql_fetch_array($hasil)) {
    echo "$data[FirstName] $data[LastName] $data[Age]<br>";
}
?>
