<?php
/**
 * File: index.php
 * Portal Dashboard Latihan Pemrograman Web 2 (Pertemuan 10 & 11)
 */

$host = 'localhost';
$user = 'root';
$pass = 'rafi123';

$db_connected = false;
$conn = @mysqli_connect($host, $user, $pass);
if ($conn) {
    $db_connected = true;
    $db_exists = @mysqli_select_db($conn, 'lat_dbase');
} else {
    $db_exists = false;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Praktikum Pemrograman Web 2 - Pertemuan 10 & 11</title>
    <style>
        :root {
            --primary: #4f46e5;
            --primary-hover: #4338ca;
            --secondary: #0ea5e9;
            --bg-page: #f8fafc;
            --surface: #ffffff;
            --text-title: #0f172a;
            --text-body: #334155;
            --text-muted: #64748b;
            --border: #e2e8f0;
            --success: #10b981;
            --warning: #f59e0b;
            --radius: 12px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }

        body {
            background-color: var(--bg-page);
            color: var(--text-body);
            line-height: 1.6;
            padding: 40px 20px;
        }

        .container {
            max-width: 960px;
            margin: 0 auto;
        }

        .hero {
            background: linear-gradient(135deg, #1e1b4b 0%, #312e81 50%, #4338ca 100%);
            color: white;
            padding: 36px 32px;
            border-radius: var(--radius);
            box-shadow: 0 10px 25px -5px rgba(49, 46, 129, 0.3);
            margin-bottom: 28px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
        }

        .hero h1 {
            font-size: 1.75rem;
            font-weight: 800;
            margin-bottom: 6px;
            letter-spacing: -0.02em;
        }

        .hero p {
            color: #c7d2fe;
            font-size: 0.95rem;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            border-radius: 30px;
            font-size: 0.85rem;
            font-weight: 600;
            background: rgba(255, 255, 255, 0.12);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .status-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
        }

        .dot-green { background: #34d399; box-shadow: 0 0 8px #34d399; }
        .dot-yellow { background: #fbbf24; box-shadow: 0 0 8px #fbbf24; }

        .section-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--text-title);
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .grid-2 {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
            margin-bottom: 32px;
        }

        .card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 24px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.04);
            transition: all 0.2s ease;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 18px rgba(0, 0, 0, 0.08);
            border-color: #cbd5e1;
        }

        .card.featured {
            border: 2px solid var(--primary);
            background: #ffffff;
            position: relative;
            overflow: hidden;
        }

        .card.featured::before {
            content: 'TUGAS UTAMA';
            position: absolute;
            top: 12px;
            right: -32px;
            background: var(--primary);
            color: white;
            font-size: 10px;
            font-weight: 700;
            padding: 3px 35px;
            transform: rotate(45deg);
            letter-spacing: 0.05em;
        }

        .card-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 14px;
        }

        .icon-box {
            width: 44px;
            height: 44px;
            border-radius: 10px;
            background: #eff6ff;
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .card h3 {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--text-title);
        }

        .card p {
            color: var(--text-muted);
            font-size: 0.875rem;
            margin-bottom: 20px;
            line-height: 1.5;
        }

        .btn-group {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 9px 16px;
            border-radius: 7px;
            font-size: 0.85rem;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            border: none;
            transition: all 0.2s;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
        }

        .btn-primary:hover {
            background: var(--primary-hover);
        }

        .btn-outline {
            background: transparent;
            color: var(--text-title);
            border: 1px solid var(--border);
        }

        .btn-outline:hover {
            background: #f1f5f9;
        }

        .exercise-list {
            list-style: none;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 12px;
            margin-bottom: 32px;
        }

        .exercise-item {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 14px 18px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            transition: all 0.2s ease;
        }

        .exercise-item:hover {
            border-color: var(--primary);
            background: #faf5ff;
        }

        .exercise-info {
            display: flex;
            flex-direction: column;
        }

        .exercise-title {
            font-weight: 600;
            font-size: 0.9rem;
            color: var(--text-title);
        }

        .exercise-desc {
            font-size: 0.75rem;
            color: var(--text-muted);
        }

        .action-link {
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--primary);
            text-decoration: none;
            padding: 4px 10px;
            border-radius: 4px;
            background: #eef2ff;
        }

        .action-link:hover {
            background: var(--primary);
            color: white;
        }

        .banner-db {
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            border-radius: var(--radius);
            padding: 20px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 16px;
            margin-bottom: 32px;
        }

        .banner-db-text h4 {
            color: #166534;
            font-size: 1rem;
            margin-bottom: 4px;
        }

        .banner-db-text p {
            color: #15803d;
            font-size: 0.85rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Hero Header -->
        <div class="hero">
            <div>
                <h1>Praktikum Pemrograman Web 2</h1>
                <p>Kompilasi Latihan Praktikum Pertemuan 10 & 11 (Database & PHP MySQL)</p>
            </div>
            <div>
                <?php if ($db_connected && $db_exists): ?>
                    <div class="status-badge">
                        <span class="status-dot dot-green"></span>
                        <span>MySQL Aktif (lat_dbase siap)</span>
                    </div>
                <?php else: ?>
                    <div class="status-badge">
                        <span class="status-dot dot-yellow"></span>
                        <span>Database Belum Diinisialisasi</span>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Quick Setup Banner -->
        <div class="banner-db">
            <div class="banner-db-text">
                <h4>⚡ Inisialisasi Database Otomatis (1-Klik)</h4>
                <p>Klik tombol di samping untuk langsung membuat database <code>lat_dbase</code>, tabel <code>tbl_mhs</code>, tabel <code>buku_tamu</code>, dan data uji pagination 5 record.</p>
            </div>
            <div>
                <a href="setup_db.php" class="btn btn-primary" style="background: #16a34a;">
                    🚀 Jalankan Setup Database
                </a>
            </div>
        </div>

        <!-- Main Task: Soal Latihan Slide 19 -->
        <h2 class="section-title">🌟 Tugas Utama: Soal Latihan Slide 19 (Buku Tamu)</h2>
        <div class="grid-2">
            <!-- Card 1: Form Buku Tamu -->
            <div class="card featured">
                <div>
                    <div class="card-header">
                        <div class="icon-box">✏️</div>
                        <div>
                            <h3>Form Buku Tamu</h3>
                            <span style="font-size: 12px; color: var(--primary); font-weight: 600;">Soal Latihan Poin 1</span>
                        </div>
                    </div>
                    <p>Formulir entri buku tamu dengan field <code>Nama</code>, <code>Email</code>, <code>Kota / Instansi</code>, dan <code>Pesan</code> yang divalidasi dan disimpan ke database MySQL.</p>
                </div>
                <div class="btn-group">
                    <a href="buku_tamu/index.php" class="btn btn-primary">Buka Form Tamu &rarr;</a>
                </div>
            </div>

            <!-- Card 2: Tampil Buku Tamu (Pagination 5 Record) -->
            <div class="card featured">
                <div>
                    <div class="card-header">
                        <div class="icon-box">📋</div>
                        <div>
                            <h3>Tampil Buku Tamu (Pagination)</h3>
                            <span style="font-size: 12px; color: var(--primary); font-weight: 600;">Soal Latihan Poin 2 (5 Record/Halaman)</span>
                        </div>
                    </div>
                    <p>Menampilkan seluruh data buku tamu dengan <strong>Pagination 5 record per halaman</strong> lengkap dengan navigasi halaman pertama, sebelumnya, nomor halaman, dan selanjutnya.</p>
                </div>
                <div class="btn-group">
                    <a href="buku_tamu/tampil.php" class="btn btn-primary">Lihat Daftar Tamu &rarr;</a>
                    <a href="buku_tamu/buku_tamu.sql" class="btn btn-outline" download>Unduh SQL</a>
                </div>
            </div>
        </div>

        <!-- Material Exercises: Pertemuan 11 Slides -->
        <h2 class="section-title">📚 Latihan Praktik Materi (Slide Pertemuan 11)</h2>
        <div class="exercise-list">
            <div class="exercise-item">
                <div class="exercise-info">
                    <span class="exercise-title">Latih 1: Koneksi MySQL</span>
                    <span class="exercise-desc">Slide 3 &bull; mysql_connect()</span>
                </div>
                <a href="latihan_slide/latih1.php" class="action-link" target="_blank">Jalankan &rarr;</a>
            </div>

            <div class="exercise-item">
                <div class="exercise-info">
                    <span class="exercise-title">Latih 2: Membuat Database</span>
                    <span class="exercise-desc">Slide 5 &bull; CREATE DATABASE lat_dbase</span>
                </div>
                <a href="latihan_slide/latih2.php" class="action-link" target="_blank">Jalankan &rarr;</a>
            </div>

            <div class="exercise-item">
                <div class="exercise-info">
                    <span class="exercise-title">Latih 3: Membuat Tabel tbl_mhs</span>
                    <span class="exercise-desc">Slide 7 &bull; CREATE TABLE & Insert Anjar</span>
                </div>
                <a href="latihan_slide/latih3.php" class="action-link" target="_blank">Jalankan &rarr;</a>
            </div>

            <div class="exercise-item">
                <div class="exercise-info">
                    <span class="exercise-title">Latih 4: Menyisipkan Data</span>
                    <span class="exercise-desc">Slide 8 &bull; Insert Karina & Glenn</span>
                </div>
                <a href="latihan_slide/latih4.php" class="action-link" target="_blank">Jalankan &rarr;</a>
            </div>

            <div class="exercise-item">
                <div class="exercise-info">
                    <span class="exercise-title">Latih 5: Menampilkan Data (Row)</span>
                    <span class="exercise-desc">Slide 11 &bull; mysql_fetch_row()</span>
                </div>
                <a href="latihan_slide/latih5.php" class="action-link" target="_blank">Jalankan &rarr;</a>
            </div>

            <div class="exercise-item">
                <div class="exercise-info">
                    <span class="exercise-title">Latih 6: Menampilkan Data (Array)</span>
                    <span class="exercise-desc">Slide 13 &bull; mysql_fetch_array()</span>
                </div>
                <a href="latihan_slide/latih6.php" class="action-link" target="_blank">Jalankan &rarr;</a>
            </div>

            <div class="exercise-item">
                <div class="exercise-info">
                    <span class="exercise-title">Latih 7: Menghitung Record</span>
                    <span class="exercise-desc">Slide 15 &bull; mysql_num_rows()</span>
                </div>
                <a href="latihan_slide/latih7.php" class="action-link" target="_blank">Jalankan &rarr;</a>
            </div>

            <div class="exercise-item">
                <div class="exercise-info">
                    <span class="exercise-title">Form Mahasiswa (form.php)</span>
                    <span class="exercise-desc">Slide 17 & 18 &bull; form.php & insert3.php</span>
                </div>
                <a href="form.php" class="action-link">Buka Form &rarr;</a>
            </div>
        </div>

        <!-- Documentation & Information -->
        <div class="card" style="margin-top: 20px;">
            <h3 style="margin-bottom: 10px;">📖 Petunjuk & Catatan Penggunaan</h3>
            <p style="margin-bottom: 12px;">Seluruh latihan telah dikonfigurasi agar siap dijalankan pada server XAMPP / Laragon:</p>
            <ul style="margin-left: 20px; font-size: 0.85rem; color: var(--text-muted); line-height: 1.8;">
                <li>Folder ini dapat langsung ditempatkan di <code>C:\xampp\htdocs\pemrog_web2_latihan</code>.</li>
                <li>Akses melalui browser di: <code>http://localhost/pemrog_web2_latihan/</code></li>
                <li>Tugas Utama Buku Tamu ada pada direktori: <code>buku_tamu/</code> dengan pagination <strong>5 record per halaman</strong>.</li>
                <li>Seluruh skrip kompatibel dengan PHP versi 5.x hingga PHP versi 7.x dan 8.x modern melalui wrapper shim.</li>
            </ul>
        </div>
    </div>
</body>
</html>
