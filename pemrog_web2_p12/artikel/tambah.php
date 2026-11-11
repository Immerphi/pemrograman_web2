<?php
/**
 * File: tambah.php (Aplikasi Artikel)
 * Modul: Menambah Artikel Baru (Create / INSERT)
 * Pertemuan 12 - Universitas Pamulang
 */

require_once __DIR__ . '/koneksi.php';

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
        $waktu_now    = date('Y-m-d H:i:s');

        $sql = "INSERT INTO artikel (`judul`, `penulis`, `lead`, `isi`, `waktu`) 
                VALUES ('$safe_judul', '$safe_penulis', '$safe_lead', '$safe_isi', '$waktu_now')";
        
        $query = mysql_query($sql);

        if ($query) {
            header("Location: index.php?status=tambah_sukses");
            exit;
        } else {
            $error = "Gagal menyimpan artikel: " . mysql_error();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Artikel Baru - Pemrograman Web 2</title>
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
                <h1>Tambah Artikel Baru</h1>
                <p>Masukkan informasi judul, penulis, ringkasan (lead), dan isi konten artikel</p>
            </div>
        </div>

        <?php if (!empty($error)): ?>
            <div class="alert alert-danger" style="max-width: 800px; margin: 0 auto 25px auto;">
                <span>⚠️ <?= htmlspecialchars($error) ?></span>
            </div>
        <?php endif; ?>

        <div class="form-card">
            <form action="tambah.php" method="POST">
                <div class="form-group">
                    <label class="form-label" for="judul">Judul Artikel <span class="req">*</span></label>
                    <input type="text" id="judul" name="judul" class="form-control" placeholder="Contoh: Mengungkap Rahasia Hollow Zero di New Eridu" required value="<?= htmlspecialchars($_POST['judul'] ?? '') ?>">
                    <div class="form-hint">Buat judul yang menarik dan jelas merefleksikan isi artikel.</div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="penulis">Nama Penulis <span class="req">*</span></label>
                    <input type="text" id="penulis" name="penulis" class="form-control" placeholder="Contoh: Ellen Joe / Kafka / Changli" required value="<?= htmlspecialchars($_POST['penulis'] ?? '') ?>">
                </div>

                <div class="form-group">
                    <label class="form-label" for="lead">Lead / Ringkasan Paragraf Pembuka <span class="req">*</span></label>
                    <textarea id="lead" name="lead" class="form-control" rows="3" placeholder="Tuliskan 1-2 kalimat ringkasan artikel..." required><?= htmlspecialchars($_POST['lead'] ?? '') ?></textarea>
                    <div class="form-hint">Lead akan ditampilkan pada kartu daftar artikel dan pembuka halaman detail.</div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="isi">Isi Artikel Lengkap <span class="req">*</span></label>
                    <textarea id="isi" name="isi" class="form-control" rows="8" placeholder="Tuliskan seluruh isi naskah artikel secara lengkap di sini..." required><?= htmlspecialchars($_POST['isi'] ?? '') ?></textarea>
                </div>

                <div class="form-actions">
                    <a href="index.php" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">💾 Simpan Artikel Baru</button>
                </div>
            </form>
        </div>

        <div class="footer-info">
            <p>Praktikum Pemrograman Web 2 &bull; Pertemuan 12 &bull; Universitas Pamulang</p>
        </div>
    </div>
</body>
</html>
