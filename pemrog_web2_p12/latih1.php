<?php
require_once __DIR__ . '/mysql_shim.php';

$con = mysql_connect("localhost","root","");
if (!$con)
{
die('Could not connect: ' . mysql_error());
}

mysql_select_db("lat_dbase", $con);

mysql_query("UPDATE tbl_mhs SET Age = '36'
WHERE FirstName = 'Ellen' AND LastName = 'Joe'");

mysql_close($con);

echo "Data berhasil diupdate!";
?>
