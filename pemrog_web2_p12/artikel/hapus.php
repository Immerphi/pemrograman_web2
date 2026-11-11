<?php
/**
 * File: hapus.php (Aplikasi Artikel)
 * Modul: Menghapus Artikel (Delete / DELETE)
 * Pertemuan 12 - Universitas Pamulang
 */

require_once __DIR__ . '/koneksi.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id > 0) {
    $sql = "DELETE FROM artikel WHERE articleID = $id";
    $query = mysql_query($sql);

    if ($query) {
        header("Location: index.php?status=hapus_sukses");
        exit;
    } else {
        header("Location: index.php?status=error");
        exit;
    }
} else {
    header("Location: index.php");
    exit;
}
