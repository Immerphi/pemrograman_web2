<?php
/**
 * File: index.php (Aplikasi Artikel)
 * Modul: Menambah, mengedit dan menghapus artikel (Bab VIII Pertemuan 12)
 * Universitas Pamulang
 */

require_once __DIR__ . '/koneksi.php';

// Menangkap status feedback aksi
$status = isset($_GET['status']) ? $_GET['status'] : '';
$pesan_alert = '';
$tipe_alert = 'success';

if ($status === 'tambah_sukses') {
    $pesan_alert = '✅ Artikel baru berhasil disimpan ke database!';
} elseif ($status === 'edit_sukses') {
    $pesan_alert = '✅ Data artikel berhasil diperbarui (UPDATE)!';
} elseif ($status === 'hapus_sukses') {
    $pesan_alert = '✅ Artikel berhasil dihapus (DELETE) dari database!';
} elseif ($status === 'error') {
    $pesan_alert = '⚠️ Terjadi kesalahan saat memproses data.';
    $tipe_alert = 'danger';
}

// Fitur Pencarian Artikel
$search = isset($_GET['q']) ? trim($_GET['q']) : '';

if (!empty($search)) {
    $safe_search = addslashes($search);
    $query_str = "SELECT * FROM artikel WHERE `judul` LIKE '%$safe_search%' OR `penulis` LIKE '%$safe_search%' OR `lead` LIKE '%$safe_search%' ORDER BY articleID DESC";
} else {
    $query_str = "SELECT * FROM artikel ORDER BY articleID DESC";
}

$query = mysql_query($query_str);
$total_artikel = mysql_num_rows($query);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Artikel - Pemrograman Web 2 (Pertemuan 12)</title>
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
                <a href="../index.php" class="btn btn-secondary btn-sm">🏠 Dashboard Utama</a>
                <a href="tambah.php" class="btn btn-primary btn-sm">➕ Tambah Artikel</a>
            </div>
        </div>
    </nav>

    <div class="container">
        <!-- Page Header -->
        <div class="page-header">
            <div class="page-title">
                <h1>Daftar Artikel</h1>
                <p>Kelola data artikel: membaca, menambah, mengedit, dan menghapus (CRUD)</p>
            </div>
            <div>
                <a href="tambah.php" class="btn btn-primary">➕ Tambah Artikel Baru</a>
            </div>
        </div>

        <!-- Alert Notifikasi -->
        <?php if (!empty($pesan_alert)): ?>
            <div class="alert alert-<?= $tipe_alert ?>">
                <span><?= htmlspecialchars($pesan_alert) ?></span>
            </div>
        <?php endif; ?>

        <!-- Search Bar -->
        <div class="search-wrapper">
            <form action="index.php" method="GET" style="display:flex; width:100%; gap:12px;">
                <input type="text" name="q" class="search-input" placeholder="Cari berdasarkan judul, penulis, atau kata kunci artikel..." value="<?= htmlspecialchars($search) ?>">
                <button type="submit" class="btn btn-secondary">🔍 Cari</button>
                <?php if (!empty($search)): ?>
                    <a href="index.php" class="btn btn-secondary">Reset</a>
                <?php endif; ?>
            </form>
        </div>

        <!-- Total Artikel Badge -->
        <div style="margin-bottom: 20px; font-size: 14px; color: var(--text-muted); display:flex; justify-content:space-between; align-items:center;">
            <span>Menampilkan <strong><?= $total_artikel ?></strong> artikel<?= !empty($search) ? ' dengan kata kunci "' . htmlspecialchars($search) . '"' : '' ?></span>
            <span style="font-size: 13px;">Database: <code>artikel_db</code> &bull; Tabel: <code>artikel</code></span>
        </div>

        <!-- Grid Artikel -->
        <?php if ($total_artikel > 0): ?>
            <div class="articles-grid">
                <?php while ($row = mysql_fetch_assoc($query)): ?>
                    <div class="article-card">
                        <div class="article-meta">
                            <span class="article-author">✍️ <?= htmlspecialchars($row['penulis']) ?></span>
                            <span>📅 <?= date('d M Y', strtotime($row['waktu'])) ?></span>
                        </div>
                        <h2><?= htmlspecialchars($row['judul']) ?></h2>
                        <p class="article-lead">
                            <?= htmlspecialchars(mb_strimwidth($row['lead'], 0, 140, '...')) ?>
                        </p>
                        <div class="article-footer">
                            <a href="detail.php?id=<?= $row['articleID'] ?>" class="btn btn-secondary btn-sm">Baca Selengkapnya &rarr;</a>
                            <div class="article-actions">
                                <a href="edit.php?id=<?= $row['articleID'] ?>" class="btn btn-secondary btn-sm" title="Edit Artikel">✏️ Edit</a>
                                <a href="hapus.php?id=<?= $row['articleID'] ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus artikel \'<?= htmlspecialchars(addslashes($row['judul'])) ?>\'?');" title="Hapus Artikel">🗑️ Hapus</a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <div class="empty-state">
                <div class="empty-state-icon">📄</div>
                <h3>Belum Ada Artikel Ditemukan</h3>
                <p><?= !empty($search) ? 'Tidak ditemukan artikel yang cocok dengan kata kunci "' . htmlspecialchars($search) . '".' : 'Belum ada data artikel yang tersimpan di dalam database.' ?></p>
                <a href="tambah.php" class="btn btn-primary">➕ Tambah Artikel Sekarang</a>
            </div>
        <?php endif; ?>

        <div class="footer-info">
            <p>Praktikum Pemrograman Web 2 &bull; Pertemuan 12 &bull; Program Studi Teknik Informatika Universitas Pamulang</p>
        </div>
    </div>
</body>
</html>
