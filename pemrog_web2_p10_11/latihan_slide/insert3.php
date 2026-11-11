<?php
// File: insert3.php (Pertemuan 11 - Slide 18: Latihan insert3.php)
require_once __DIR__ . '/mysql_shim.php';

$con = mysql_connect("localhost", "root", "");
if (!$con) {
    die('Could not connect: ' . mysql_error());
}

mysql_select_db("lat_dbase", $con);

$firstname = isset($_POST['firstname']) ? addslashes($_POST['firstname']) : '';
$lastname  = isset($_POST['lastname']) ? addslashes($_POST['lastname']) : '';
$age       = isset($_POST['age']) ? (int)$_POST['age'] : 0;

$sql = "INSERT INTO tbl_mhs (FirstName, LastName, Age)
VALUES ('$firstname', '$lastname', '$age')";

if (!mysql_query($sql, $con)) {
    die('Error: ' . mysql_error());
}

echo "<div style='font-family: Arial, sans-serif; margin: 40px; padding: 20px; background: #e8f5e9; border: 1px solid #4caf50; border-radius: 6px; max-width: 500px;'>";
echo "<h3 style='color: #2e7d32; margin-top: 0;'>1 record added</h3>";
echo "<p>Data mahasiswa <strong>$firstname $lastname</strong> (Usia: $age) berhasil disimpan ke tabel tbl_mhs.</p>";
echo "<hr style='border: none; border-top: 1px solid #c8e6c9;'>";
echo "<a href='form.php' style='color: #1976d2; text-decoration: none; font-weight: bold;'>&larr; Input Data Lain</a> &nbsp;|&nbsp; ";
echo "<a href='latih6.php' style='color: #1976d2; text-decoration: none; font-weight: bold;'>Lihat Semua Data (Latih 6) &rarr;</a> &nbsp;|&nbsp; ";
echo "<a href='../index.php' style='color: #555; text-decoration: none;'>Menu Utama</a>";
echo "</div>";

mysql_close($con);
?>
