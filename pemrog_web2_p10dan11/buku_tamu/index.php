<?php
require_once __DIR__ . '/config.php';

// Ambil total data buku tamu saat ini untuk badge
$count_query = mysqli_query($conn, "SELECT COUNT(*) as total FROM buku_tamu");
$count_data = mysqli_fetch_assoc($count_query);
$total_tamu = $count_data ? $count_data['total'] : 0;
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Buku Tamu - Latihan Pertemuan 11</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <!-- Navigation Header -->
        <header class="header-nav">
            <div class="brand-title">
                <div class="brand-icon">📖</div>
                <div>
                    <h1>Buku Tamu Pengunjung</h1>
                    <p>Pemrograman Web 2 &bull; Latihan Pertemuan 11 (Slide 19)</p>
                </div>
            </div>
            <div class="nav-actions">
                <a href="tampil.php" class="btn btn-secondary btn-sm">
                    📋 Lihat Daftar Tamu 
                    <span style="background: var(--primary); color: white; padding: 2px 7px; border-radius: 10px; font-size: 11px; margin-left: 4px;">
                        <?= $total_tamu ?>
                    </span>
                </a>
                <a href="../index.php" class="btn btn-secondary btn-sm">🏠 Dashboard</a>
            </div>
        </header>

        <!-- Feedback Alert Messages -->
        <?php if (isset($_GET['status']) && $_GET['status'] == 'sukses'): ?>
            <div class="alert alert-success">
                <span>✅</span>
                <div>
                    <strong>Berhasil!</strong> Terima kasih, pesan buku tamu Anda telah tersimpan ke dalam database.
                </div>
            </div>
        <?php elseif (isset($_GET['status']) && $_GET['status'] == 'gagal'): ?>
            <div class="alert alert-danger">
                <span>⚠️</span>
                <div>
                    <strong>Gagal Menyimpan!</strong> 
                    <?= isset($_GET['pesan']) ? htmlspecialchars($_GET['pesan']) : 'Terjadi kesalahan saat memproses data.' ?>
                </div>
            </div>
        <?php endif; ?>

        <!-- Main Form Card -->
        <div class="card">
            <h2 class="card-title">Formulir Buku Tamu</h2>
            <p class="card-subtitle">Silakan isi formulir di bawah ini untuk mencatatkan kunjungan atau memberikan komentar Anda.</p>

            <form action="simpan.php" method="POST" id="formBukuTamu">
                <div class="form-group">
                    <label class="form-label" for="nama">
                        Nama Lengkap <span class="required">*</span>
                    </label>
                    <input 
                        type="text" 
                        id="nama" 
                        name="nama" 
                        class="form-control" 
                        placeholder="Contoh: Muhammad Farhan" 
                        required 
                        autocomplete="name"
                    >
                </div>

                <div class="form-group">
                    <label class="form-label" for="email">
                        Alamat Email <span class="required">*</span>
                    </label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        class="form-control" 
                        placeholder="Contoh: farhan@example.com" 
                        required 
                        autocomplete="email"
                    >
                    <div class="form-hint">Email Anda aman dan tidak akan disebarluaskan.</div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="alamat">
                        Kota Asal / Instansi
                    </label>
                    <input 
                        type="text" 
                        id="alamat" 
                        name="alamat" 
                        class="form-control" 
                        placeholder="Contoh: Jakarta Selatan / Universitas Pamulang"
                    >
                </div>

                <div class="form-group">
                    <label class="form-label" for="pesan">
                        Pesan atau Komentar <span class="required">*</span>
                    </label>
                    <textarea 
                        id="pesan" 
                        name="pesan" 
                        class="form-control" 
                        placeholder="Tuliskan kesan, pesan, saran, atau komentar Anda di sini..." 
                        rows="4" 
                        required
                    ></textarea>
                </div>

                <div class="form-buttons">
                    <button type="submit" name="submit" class="btn btn-primary">
                        💾 Simpan Buku Tamu
                    </button>
                    <button type="reset" class="btn btn-secondary">
                        🔄 Reset Form
                    </button>
                    <a href="tampil.php" class="btn btn-secondary" style="margin-left: auto;">
                        Lihat Data Buku Tamu &rarr;
                    </a>
                </div>
            </form>
        </div>

        <p class="footer-text">
            Praktikum Pemrograman Web 2 &bull; Soal Latihan Slide 19: Buku Tamu &bull; Tahun 2026
        </p>
    </div>
</body>
</html>
