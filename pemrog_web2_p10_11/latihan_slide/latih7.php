<?php
// File: latih7.php (Pertemuan 11 - Slide 15: Menghitung Record dengan mysql_num_rows)
require_once __DIR__ . '/mysql_shim.php';

mysql_connect("localhost", "root", "");
mysql_select_db("lat_dbase");

$hasil = mysql_query("select * from tbl_mhs");
$hit = mysql_num_rows($hasil);

echo "<h3>Menghitung Jumlah Record Mahasiswa:</h3>";
echo "Jumlah record: <strong>$hit</strong> record";
?>
