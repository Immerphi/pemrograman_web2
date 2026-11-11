<?php
/**
 * File: edit.php (Aplikasi Artikel)
 * Modul: Mengedit Artikel (Update / UPDATE)
 * Pertemuan 12 - Universitas Pamulang
 */

require_once __DIR__ . '/koneksi.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id <= 0) {
    header("Location: index.php");
    exit;
}

// Ambil data artikel yang akan diedit
$query_ambil = mysql_query("SELECT * FROM artikel WHERE articleID = $id");
if (!$query_ambil || mysql_num_rows($query_ambil) === 0) {
    header("Location: index.php?status=error");
    exit;
}

$artikel = mysql_fetch_assoc($query_ambil);
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul   = trim($_POST['judul'] ?? '');
    $penulis = trim($_POST['penulis'] ?? '');
    $lead    = trim($_POST['lead'] ?? '');
    $isi     = trim($_POST['isi'] ?? '');

    if (empty($judul) || empty($penulis) || empty($lead) || empty($isi)) {
        $error = 'Semua kolom formulir wajib diisi!';
    } else {
        $safe_judul   = addslashes($judul);
        $safe_penulis = addslashes($penulis);
        $safe_lead    = addslashes($lead);
        $safe_isi     = addslashes($isi);

        $sql = "UPDATE artikel 
                SET `judul` = '$safe_judul', 
                    `penulis` = '$safe_penulis', 
                    `lead` = '$safe_lead', 
                    `isi` = '$safe_isi' 
                WHERE articleID = $id";

        $update_res = mysql_query($sql);

        if ($update_res) {
            header("Location: index.php?status=edit_sukses");
            exit;
        } else {
            $error = "Gagal memperbarui artikel: " . mysql_error();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Artikel #<?= $id ?> - Pemrograman Web 2</title>
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
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="page-header" style="max-width: 800px; margin: 0 auto 25px auto;">
            <div class="page-title">
                <h1>Edit Artikel</h1>
                <p>Perbarui informasi artikel ID: <strong>#<?= $id ?></strong> menggunakan perintah SQL <code>UPDATE</code></p>
            </div>
        </div>

        <?php if (!empty($error)): ?>
            <div class="alert alert-danger" style="max-width: 800px; margin: 0 auto 25px auto;">
                <span>⚠️ <?= htmlspecialchars($error) ?></span>
            </div>
        <?php endif; ?>

        <div class="form-card">
            <form action="edit.php?id=<?= $id ?>" method="POST">
                <div class="form-group">
                    <label class="form-label" for="judul">Judul Artikel <span class="req">*</span></label>
                    <input type="text" id="judul" name="judul" class="form-control" required value="<?= htmlspecialchars($_POST['judul'] ?? $artikel['judul']) ?>">
                </div>

                <div class="form-group">
                    <label class="form-label" for="penulis">Nama Penulis <span class="req">*</span></label>
                    <input type="text" id="penulis" name="penulis" class="form-control" required value="<?= htmlspecialchars($_POST['penulis'] ?? $artikel['penulis']) ?>">
                </div>

                <div class="form-group">
                    <label class="form-label" for="lead">Lead / Ringkasan Paragraf Pembuka <span class="req">*</span></label>
                    <textarea id="lead" name="lead" class="form-control" rows="3" required><?= htmlspecialchars($_POST['lead'] ?? $artikel['lead']) ?></textarea>
                </div>

                <div class="form-group">
                    <label class="form-label" for="isi">Isi Artikel Lengkap <span class="req">*</span></label>
                    <textarea id="isi" name="isi" class="form-control" rows="8" required><?= htmlspecialchars($_POST['isi'] ?? $artikel['isi']) ?></textarea>
                </div>

                <div class="form-actions">
                    <a href="index.php" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">💾 Simpan Perubahan (UPDATE)</button>
                </div>
            </form>
        </div>

        <div class="footer-info">
            <p>Praktikum Pemrograman Web 2 &bull; Pertemuan 12 &bull; Universitas Pamulang</p>
        </div>
    </div>
</body>
</html>
