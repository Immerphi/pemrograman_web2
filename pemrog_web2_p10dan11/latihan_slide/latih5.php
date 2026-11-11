<?php
// File: latih5.php (Pertemuan 11 - Slide 11: Menampilkan Data dengan mysql_fetch_row)
require_once __DIR__ . '/mysql_shim.php';

mysql_connect("localhost", "root", "");
// mysql_select_db("lat_dbase");
$hasil = mysql_db_query("lat_dbase", "select * from tbl_mhs");

echo "<h3>Data Mahasiswa (mysql_fetch_row - berbasis index angka):</h3>";
while ($data = mysql_fetch_row($hasil)) {
    // $data[0] = mhsID, $data[1] = FirstName, $data[2] = LastName, $data[3] = Age
    echo "$data[0] $data[1] $data[2]<br>";
}
?>
