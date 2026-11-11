<?php
// File: latih3.php (Pertemuan 11 - Slide 7: Membuat Tabel)
require_once __DIR__ . '/mysql_shim.php';

mysql_connect("localhost", "root", ""); // koneksi
mysql_select_db("lat_dbase"); // mengaktifkan database

// membuat tabel jika belum ada
$sql = "CREATE TABLE IF NOT EXISTS tbl_mhs
(
mhsID int NOT NULL AUTO_INCREMENT,
PRIMARY KEY(mhsID),
FirstName varchar(15),
LastName varchar(15),
Age int
)";
mysql_query($sql);

// input data awal
$input = mysql_query("insert into tbl_mhs(FirstName,LastName,Age) values('Anjar','Prabowo',25)");

if ($input) {
    echo "Tabel tbl_mhs berhasil dibuat dan data awal (Anjar Prabowo) berhasil dimasukkan.";
} else {
    echo "Tabel tbl_mhs diproses. " . mysql_error();
}
?>
