<?php
require_once __DIR__ . '/mysql_shim.php';

$con = mysql_connect("localhost","root","");

if (!$con)
{
die('Could not connect: ' . mysql_error());
}

mysql_select_db("lat_dbase",$con);

mysql_query("DELETE FROM tbl_mhs WHERE LastName='Kid'");

mysql_close($con);

echo "Data berhasil dihapus!";
?>
