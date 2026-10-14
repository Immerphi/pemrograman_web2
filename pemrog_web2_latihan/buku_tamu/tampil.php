<?php
/**
 * File: tampil.php
 * Menampilkan daftar buku tamu dengan PAGINATION 5 record per halaman
 * Sesuai instruksi Slide 19 Pertemuan 11:
 * "2. Tampilkanlah buku tamu tersebut. Cobalah tampilkan setiap halaman 5 record"
 */

require_once __DIR__ . '/config.php';

// 1. Tentukan jumlah data per halaman (5 record sesuai instruksi soal)
$batas = 5;

// 2. Ambil parameter halaman saat ini dari URL, default ke halaman 1
$halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
if ($halaman < 1) {
    $halaman = 1;
}

// 3. Hitung total data buku tamu yang ada di database
$hitung_query = mysqli_query($conn, "SELECT COUNT(*) AS total FROM buku_tamu");
$hitung_data  = mysqli_fetch_assoc($hitung_query);
$total_data   = $hitung_data ? (int)$hitung_data['total'] : 0;

// 4. Hitung total halaman yang dibutuhkan
$total_halaman = ($total_data > 0) ? (int)ceil($total_data / $batas) : 1;

// Cegah nomor halaman melebihi total halaman yang tersedia
if ($halaman > $total_halaman) {
    $halaman = $total_halaman;
}

// 5. Tentukan offset (posisi awal record yang akan diambil dari database)
$offset = ($halaman - 1) * $batas;

// 6. Ambil data dengan pembatasan LIMIT sesuai pagination (5 record per halaman)
$query = mysqli_query($conn, "SELECT * FROM buku_tamu ORDER BY id DESC LIMIT $offset, $batas");

// Hitung rentang data yang sedang ditampilkan
$data_dari = ($total_data > 0) ? ($offset + 1) : 0;
$data_sampai = min($offset + $batas, $total_data);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Buku Tamu (Pagination 5 Record) - Latihan Pertemuan 11</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <!-- Navigation Header -->
        <header class="header-nav">
            <div class="brand-title">
                <div class="brand-icon">📋</div>
                <div>
                    <h1>Daftar Buku Tamu</h1>
                    <p>Menampilkan <strong>5 record per halaman</strong> (Sesuai Soal Latihan Slide 19)</p>
                </div>
            </div>
            <div class="nav-actions">
                <a href="index.php" class="btn btn-primary btn-sm">
                    ✏️ Isi Buku Tamu
                </a>
                <a href="../index.php" class="btn btn-secondary btn-sm">
                    🏠 Dashboard
                </a>
            </div>
        </header>

        <!-- Feedback Alert Messages -->
        <?php if (isset($_GET['status']) && $_GET['status'] == 'sukses'): ?>
            <div class="alert alert-success">
                <span>✅</span>
                <div><strong>Berhasil!</strong> Pesan buku tamu baru berhasil ditambahkan.</div>
            </div>
        <?php elseif (isset($_GET['status']) && $_GET['status'] == 'dihapus'): ?>
            <div class="alert alert-success">
                <span>🗑️</span>
                <div>Data pesan buku tamu berhasil dihapus.</div>
            </div>
        <?php endif; ?>

        <!-- Main Card Content -->
        <div class="card">
            <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px; margin-bottom: 20px;">
                <div>
                    <h2 class="card-title" style="margin-bottom: 4px;">Riwayat Pesan Pengunjung</h2>
                    <p style="color: var(--text-secondary); font-size: 0.875rem;">
                        Total data tersimpan: <strong><?= $total_data ?></strong> tamu &bull;
                        Halaman <strong><?= $halaman ?></strong> dari <strong><?= $total_halaman ?></strong>
                    </p>
                </div>
                <div>
                    <span style="display: inline-block; background: var(--primary-light); color: var(--primary); font-weight: 600; font-size: 0.8rem; padding: 6px 12px; border-radius: 20px;">
                        📌 Limit: 5 Record / Halaman
                    </span>
                </div>
            </div>

            <?php if ($total_data > 0 && mysqli_num_rows($query) > 0): ?>
                <!-- Table View -->
                <div class="table-responsive">
                    <table class="table-custom">
                        <thead>
                            <tr>
                                <th style="width: 50px; text-align: center;">No</th>
                                <th style="width: 220px;">Pengunjung</th>
                                <th style="width: 140px;">Kota / Instansi</th>
                                <th>Pesan / Komentar</th>
                                <th style="width: 140px;">Waktu</th>
                                <th style="width: 70px; text-align: center;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $no = $offset + 1;
                            while ($row = mysqli_fetch_assoc($query)): 
                                // Inisial avatar
                                $inisial = strtoupper(substr($row['nama'], 0, 1));
                                $waktu = !empty($row['tgl_kunjung']) ? date('d M Y, H:i', strtotime($row['tgl_kunjung'])) : '-';
                            ?>
                                <tr>
                                    <td style="text-align: center; font-weight: 600; color: var(--text-muted);">
                                        <?= $no++ ?>
                                    </td>
                                    <td>
                                        <div class="user-badge">
                                            <div class="avatar-circle"><?= $inisial ?></div>
                                            <div>
                                                <div class="user-meta-name"><?= htmlspecialchars($row['nama']) ?></div>
                                                <div class="user-meta-email"><?= htmlspecialchars($row['email']) ?></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <?php if (!empty($row['alamat'])): ?>
                                            <span class="location-tag">📍 <?= htmlspecialchars($row['alamat']) ?></span>
                                        <?php else: ?>
                                            <span style="color: var(--text-muted); font-size: 0.8rem;">-</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <div class="message-box">
                                            <?= nl2br(htmlspecialchars($row['pesan'])) ?>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="date-text">🕒 <?= $waktu ?></span>
                                    </td>
                                    <td style="text-align: center;">
                                        <a 
                                            href="hapus.php?id=<?= $row['id'] ?>&halaman=<?= $halaman ?>" 
                                            class="btn-danger" 
                                            title="Hapus Pesan" 
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus pesan dari <?= htmlspecialchars(addslashes($row['nama'])) ?>?');"
                                        >
                                            Hapus
                                        </a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination Navigation Wrapper -->
                <div class="pagination-wrapper">
                    <div class="pagination-info">
                        Menampilkan data ke-<strong><?= $data_dari ?></strong> sampai ke-<strong><?= $data_sampai ?></strong> dari total <strong><?= $total_data ?></strong> data
                    </div>

                    <div class="pagination-nav">
                        <!-- Tombol Pertama -->
                        <?php if ($halaman > 1): ?>
                            <a href="?halaman=1" class="page-btn" title="Halaman Pertama">&laquo; Pertama</a>
                            <a href="?halaman=<?= $halaman - 1 ?>" class="page-btn" title="Halaman Sebelumnya">&lsaquo; Sebelumnya</a>
                        <?php else: ?>
                            <span class="page-btn disabled">&laquo; Pertama</span>
                            <span class="page-btn disabled">&lsaquo; Sebelumnya</span>
                        <?php endif; ?>

                        <!-- Nomor Halaman -->
                        <?php for ($i = 1; $i <= $total_halaman; $i++): ?>
                            <?php if ($i == $halaman): ?>
                                <span class="page-btn active"><?= $i ?></span>
                            <?php else: ?>
                                <a href="?halaman=<?= $i ?>" class="page-btn"><?= $i ?></a>
                            <?php endif; ?>
                        <?php endfor; ?>

                        <!-- Tombol Selanjutnya & Terakhir -->
                        <?php if ($halaman < $total_halaman): ?>
                            <a href="?halaman=<?= $halaman + 1 ?>" class="page-btn" title="Halaman Selanjutnya">Selanjutnya &rsaquo;</a>
                            <a href="?halaman=<?= $total_halaman ?>" class="page-btn" title="Halaman Terakhir">Terakhir &raquo;</a>
                        <?php else: ?>
                            <span class="page-btn disabled">Selanjutnya &rsaquo;</span>
                            <span class="page-btn disabled">Terakhir &raquo;</span>
                        <?php endif; ?>
                    </div>
                </div>

            <?php else: ?>
                <!-- Empty State -->
                <div class="empty-state">
                    <div class="empty-state-icon">📭</div>
                    <h3 style="color: var(--text-primary); margin-bottom: 6px;">Belum Ada Data Buku Tamu</h3>
                    <p style="margin-bottom: 20px;">Jadilah orang pertama yang mengisi buku tamu ini atau generate data contoh!</p>
                    <div style="display: flex; gap: 10px; justify-content: center;">
                        <a href="index.php" class="btn btn-primary">✏️ Isi Buku Tamu Sekarang</a>
                        <a href="../setup_db.php" class="btn btn-secondary">⚡ Muat Data Contoh (12 Data)</a>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- Footnote / Penjelasan Teknis Soal Latihan -->
        <div class="card" style="background: #fafafa; border-style: dashed;">
            <h4 style="font-size: 0.95rem; margin-bottom: 8px; color: var(--text-primary);">
                💡 Penjelasan Logika Pagination (5 Record per Halaman):
            </h4>
            <ol style="margin-left: 20px; font-size: 0.85rem; color: var(--text-secondary); line-height: 1.7;">
                <li>Batas record ditentukan: <code>$batas = 5;</code></li>
                <li>Halaman aktif diambil dari parameter URL: <code>$_GET['halaman']</code> (default = 1).</li>
                <li>Offset/posisi awal SQL dihitung: <code>$offset = ($halaman - 1) * $batas;</code></li>
                <li>Total data dihitung dengan: <code>SELECT COUNT(*) FROM buku_tamu</code></li>
                <li>Total halaman dihitung dengan pembulatan ke atas: <code>$total_halaman = ceil($total_data / $batas);</code></li>
                <li>Data diambil per halaman menggunakan query: <code>SELECT * FROM buku_tamu ORDER BY id DESC LIMIT $offset, $batas</code></li>
            </ol>
        </div>

        <p class="footer-text">
            Praktikum Pemrograman Web 2 &bull; Soal Latihan Slide 19: Buku Tamu &bull; Tahun 2026
        </p>
    </div>
</body>
</html>
