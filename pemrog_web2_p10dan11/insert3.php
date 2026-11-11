<?php
// File: insert3.php (Pertemuan 11 - Slide 18: Latihan insert3.php)
require_once __DIR__ . '/latihan_slide/mysql_shim.php';

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

echo "<div style='font-family: \"Segoe UI\", Tahoma, Geneva, Verdana, sans-serif; margin: 40px auto; padding: 25px; background: #ecfdf5; border: 1px solid #10b981; border-radius: 8px; max-width: 480px; color: #065f46;'>";
echo "<h3 style='margin-top: 0; color: #047857;'>1 record added</h3>";
echo "<p style='color: #064e3b;'>Data mahasiswa <strong>" . htmlspecialchars($firstname) . " " . htmlspecialchars($lastname) . "</strong> (Usia: " . $age . ") berhasil ditambahkan ke database.</p>";
echo "<hr style='border: none; border-top: 1px solid #a7f3d0; margin: 18px 0;'>";
echo "<a href='form.php' style='color: #047857; text-decoration: none; font-weight: bold;'>&larr; Input Data Lain</a> &nbsp;|&nbsp; ";
echo "<a href='latihan_slide/latih6.php' style='color: #047857; text-decoration: none; font-weight: bold;'>Lihat Data Mahasiswa &rarr;</a> &nbsp;|&nbsp; ";
echo "<a href='index.php' style='color: #6b7280; text-decoration: none;'>Dashboard</a>";
echo "</div>";

mysql_close($con);
?>
