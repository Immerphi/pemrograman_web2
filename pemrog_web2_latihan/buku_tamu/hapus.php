<?php
/**
 * File: hapus.php
 * Menghapus data pesan buku tamu berdasarkan ID
 */

require_once __DIR__ . '/config.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;

if ($id > 0) {
    $stmt = mysqli_prepare($conn, "DELETE FROM buku_tamu WHERE id = ?");
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    } else {
        mysqli_query($conn, "DELETE FROM buku_tamu WHERE id = $id");
    }
}

mysqli_close($conn);
header("Location: tampil.php?halaman=$halaman&status=dihapus");
exit();
?>
