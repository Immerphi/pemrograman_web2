<?php
/**
 * File: detail.php (Aplikasi Artikel)
 * Modul: Menampilkan Isi Detail Artikel
 * Pertemuan 12 - Universitas Pamulang
 */

require_once __DIR__ . '/koneksi.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id <= 0) {
    header("Location: index.php");
    exit;
}

$query = mysql_query("SELECT * FROM artikel WHERE articleID = $id");
if (!$query || mysql_num_rows($query) === 0) {
    header("Location: index.php?status=error");
    exit;
}

$artikel = mysql_fetch_assoc($query);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($artikel['judul']) ?> - Manajemen Artikel</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="nav-container">
            <a href="index.php" class="nav-brand">
                <span>📰 Manajemen Artikel</span>
                <span class="nav-brand-badge">Pertemuan 12</span>
            </a>
            <div class="nav-links">
                <a href="index.php" class="btn btn-secondary btn-sm">&larr; Kembali ke Daftar</a>
                <a href="tambah.php" class="btn btn-primary btn-sm">➕ Tambah Baru</a>
            </div>
        </div>
    </nav>

    <div class="container" style="max-width: 860px;">
        <div class="detail-card">
            <div class="detail-header">
                <h1 class="detail-title"><?= htmlspecialchars($artikel['judul']) ?></h1>
                <div class="detail-meta">
                    <span>✍️ Ditulis oleh: <strong><?= htmlspecialchars($artikel['penulis']) ?></strong></span>
                    <span>📅 Tanggal: <strong><?= date('d F Y, H:i', strtotime($artikel['waktu'])) ?> WIB</strong></span>
                    <span>🆔 ID: <strong>#<?= $artikel['articleID'] ?></strong></span>
                </div>
            </div>

            <div class="detail-lead">
                <?= nl2br(htmlspecialchars($artikel['lead'])) ?>
            </div>

            <div class="detail-content">
                <?= nl2br(htmlspecialchars($artikel['isi'])) ?>
            </div>

            <div class="form-actions" style="margin-top: 40px;">
                <a href="index.php" class="btn btn-secondary">&larr; Kembali ke Daftar</a>
                <div style="display:flex; gap:10px;">
                    <a href="edit.php?id=<?= $artikel['articleID'] ?>" class="btn btn-primary">✏️ Edit Artikel</a>
                    <a href="hapus.php?id=<?= $artikel['articleID'] ?>" class="btn btn-outline-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus artikel ini?');">🗑️ Hapus</a>
                </div>
            </div>
        </div>

        <div class="footer-info">
            <p>Praktikum Pemrograman Web 2 &bull; Pertemuan 12 &bull; Universitas Pamulang</p>
        </div>
    </div>
</body>
</html>
