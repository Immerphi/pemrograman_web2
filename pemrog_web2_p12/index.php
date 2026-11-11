<?php
/**
 * File: index.php
 * Portal Dashboard Praktikum Pemrograman Web 2 (Pertemuan 12)
 * Bab VIII: Manipulasi Database
 * Universitas Pamulang (UNPAM)
 */

require_once __DIR__ . '/latihan_slide/mysql_shim.php';

// Cek koneksi MySQL
$host = 'localhost';
$user = 'root';
$passwords = ['rafi123', '', 'root'];

$db_connected = false;
$lat_dbase_exists = false;
$artikel_db_exists = false;
$active_conn = null;

foreach ($passwords as $p) {
    try {
        $c = @mysqli_connect($host, $user, $p);
        if ($c) {
            $db_connected = true;
            $active_conn = $c;
            $lat_dbase_exists = @mysqli_select_db($c, 'lat_dbase');
            $artikel_db_exists = @mysqli_select_db($c, 'artikel_db');
            break;
        }
    } catch (Throwable $e) {}
}

// Data preview jika terkoneksi
$total_mhs = 0;
$total_artikel = 0;

if ($lat_dbase_exists) {
    $q = @mysqli_query($active_conn, "SELECT COUNT(*) as jml FROM tbl_mhs");
    if ($q) {
        $row = mysqli_fetch_assoc($q);
        $total_mhs = $row['jml'];
    }
}

if ($artikel_db_exists) {
    $q = @mysqli_query($active_conn, "SELECT COUNT(*) as jml FROM artikel");
    if ($q) {
        $row = mysqli_fetch_assoc($q);
        $total_artikel = $row['jml'];
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Praktikum Pemrograman Web 2 - Pertemuan 12 | Universitas Pamulang</title>
    <style>
        :root {
            --primary: #2563eb;
            --primary-hover: #1d4ed8;
            --secondary: #0ea5e9;
            --bg-page: #f8fafc;
            --surface: #ffffff;
            --text-title: #0f172a;
            --text-body: #334155;
            --text-muted: #64748b;
            --border: #e2e8f0;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
            --radius-md: 12px;
            --radius-lg: 16px;
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
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
            max-width: 1040px;
            margin: 0 auto;
        }

        /* Hero Header */
        .hero {
            background: linear-gradient(135deg, #1e3a8a 0%, #2563eb 100%);
            color: white;
            border-radius: var(--radius-lg);
            padding: 35px 40px;
            margin-bottom: 30px;
            box-shadow: 0 10px 25px -5px rgba(37, 99, 235, 0.25);
            position: relative;
            overflow: hidden;
        }

        .hero-badge {
            display: inline-block;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(8px);
            color: #dbeafe;
            font-size: 12px;
            font-weight: 700;
            padding: 5px 12px;
            border-radius: 999px;
            letter-spacing: 0.5px;
            margin-bottom: 12px;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .hero h1 {
            font-size: 30px;
            font-weight: 800;
            letter-spacing: -0.5px;
            margin-bottom: 8px;
        }

        .hero p {
            font-size: 15px;
            color: #bfdbfe;
            max-width: 720px;
        }

        /* Status Bar */
        .status-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-md);
            padding: 18px 24px;
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
            box-shadow: var(--shadow-sm);
        }

        .status-indicators {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }

        .status-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            font-weight: 500;
        }

        .dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
        }

        .dot-green { background-color: var(--success); box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.2); }
        .dot-red { background-color: var(--danger); box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.2); }

        /* Grid Cards */
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(310px, 1fr));
            gap: 24px;
            margin-bottom: 35px;
        }

        .card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            padding: 26px;
            box-shadow: var(--shadow-sm);
            transition: all 0.25s ease;
            display: flex;
            flex-direction: column;
        }

        .card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-md);
            border-color: #cbd5e1;
        }

        .card-tag {
            display: inline-block;
            font-size: 11px;
            font-weight: 700;
            padding: 3px 8px;
            border-radius: 4px;
            margin-bottom: 12px;
            text-transform: uppercase;
        }

        .tag-blue { background: #dbeafe; color: #1e40af; }
        .tag-red { background: #fee2e2; color: #991b1b; }
        .tag-emerald { background: #dcfce7; color: #166534; }

        .card h2 {
            font-size: 20px;
            font-weight: 700;
            color: var(--text-title);
            margin-bottom: 10px;
        }

        .card p {
            font-size: 14px;
            color: var(--text-muted);
            margin-bottom: 18px;
            flex-grow: 1;
        }

        .card-code {
            background: #0f172a;
            color: #38bdf8;
            padding: 12px 14px;
            border-radius: 8px;
            font-family: Consolas, monospace;
            font-size: 12px;
            margin-bottom: 20px;
            overflow-x: auto;
        }

        /* Buttons */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 10px 18px;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            border: 1px solid transparent;
            transition: all 0.2s;
        }

        .btn-primary { background: var(--primary); color: white; }
        .btn-primary:hover { background: var(--primary-hover); }
        .btn-danger { background: var(--danger); color: white; }
        .btn-danger:hover { background: #dc2626; }
        .btn-success { background: #059669; color: white; }
        .btn-success:hover { background: #047857; }
        .btn-secondary { background: #f1f5f9; color: var(--text-body); border-color: var(--border); }
        .btn-secondary:hover { background: #e2e8f0; }

        /* Section Table */
        .section-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            padding: 28px;
            box-shadow: var(--shadow-sm);
            margin-bottom: 30px;
        }

        .section-card h3 {
            font-size: 18px;
            color: var(--text-title);
            margin-bottom: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            text-align: left;
            padding: 12px 16px;
            border-bottom: 1px solid var(--border);
            font-size: 14px;
        }

        th {
            background: #f8fafc;
            color: var(--text-muted);
            font-weight: 600;
        }

        tr:last-child td { border-bottom: none; }

        .footer {
            text-align: center;
            margin-top: 40px;
            color: var(--text-muted);
            font-size: 13px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Hero Header -->
        <div class="hero">
            <span class="hero-badge">PROGRAM STUDI S1 TEKNIK INFORMATIKA &bull; UNIVERSITAS PAMULANG</span>
            <h1>Pemrograman Web 2 &bull; Pertemuan 12</h1>
            <p>BAB VIII MANIPULASI DATABASE: Pembelajaran dan Implementasi Perintah UPDATE, DELETE, serta Aplikasi CRUD Artikel dengan PHP & MySQL <strong>(Edisi Karakter: Honkai: Star Rail, Wuthering Waves, &amp; Zenless Zone Zero)</strong>.</p>
        </div>

        <!-- Status Database Bar -->
        <div class="status-card">
            <div class="status-indicators">
                <div class="status-item">
                    <span class="dot <?= $db_connected ? 'dot-green' : 'dot-red' ?>"></span>
                    <span>MySQL Server: <strong><?= $db_connected ? 'Terhubung (3306)' : 'Tidak Terhubung' ?></strong></span>
                </div>
                <div class="status-item">
                    <span class="dot <?= $lat_dbase_exists ? 'dot-green' : 'dot-red' ?>"></span>
                    <span>Database <code>lat_dbase</code>: <strong><?= $lat_dbase_exists ? "$total_mhs Mahasiswa" : 'Belum Ada' ?></strong></span>
                </div>
                <div class="status-item">
                    <span class="dot <?= $artikel_db_exists ? 'dot-green' : 'dot-red' ?>"></span>
                    <span>Database <code>artikel_db</code>: <strong><?= $artikel_db_exists ? "$total_artikel Artikel" : 'Belum Ada' ?></strong></span>
                </div>
            </div>
            <div>
                <a href="setup_db.php" class="btn btn-secondary" title="Inisialisasi ulang seluruh database dan sampel data">🔄 Reset / Setup Database</a>
            </div>
        </div>

        <!-- Main Exercises Grid -->
        <div class="grid">
            <!-- Card 1: Latih 1 (UPDATE) -->
            <div class="card">
                <div>
                    <span class="card-tag tag-blue">Slide 2 & 3 &bull; Latih 1</span>
                    <h2>Perintah UPDATE</h2>
                </div>
                <p>Mengubah record data pada tabel dengan sintaks <code>UPDATE table_name SET ... WHERE ...</code>. Pada latihan ini, umur karakter 'Ellen Joe' (ZZZ) diubah menjadi 36.</p>
                <div class="card-code">
UPDATE tbl_mhs SET Age = '36'<br>
WHERE FirstName = 'Ellen'<br>
  AND LastName = 'Joe';
                </div>
                <div style="display:flex; gap:8px;">
                    <a href="latihan_slide/latih1_view.php" class="btn btn-primary" style="flex:1;">⚡ Live Demo UPDATE</a>
                    <a href="latihan_slide/latih1.php" target="_blank" class="btn btn-secondary" title="Buka script asli slide">File Asli</a>
                </div>
            </div>

            <!-- Card 2: Latih 2 (DELETE) -->
            <div class="card">
                <div>
                    <span class="card-tag tag-red">Slide 4 & 5 &bull; Latih 2</span>
                    <h2>Perintah DELETE</h2>
                </div>
                <p>Menghapus record dengan kriteria tertentu menggunakan sintaks <code>DELETE FROM table_name WHERE ...</code>. Pada latihan ini, record dengan <code>LastName='Kid'</code> (Billy Kid) dihapus.</p>
                <div class="card-code">
DELETE FROM tbl_mhs<br>
WHERE LastName='Kid';
                </div>
                <div style="display:flex; gap:8px;">
                    <a href="latihan_slide/latih2_view.php" class="btn btn-danger" style="flex:1;">🗑️ Live Demo DELETE</a>
                    <a href="latihan_slide/latih2.php" target="_blank" class="btn btn-secondary" title="Buka script asli slide">File Asli</a>
                </div>
            </div>

            <!-- Card 3: Aplikasi Artikel CRUD -->
            <div class="card">
                <div>
                    <span class="card-tag tag-emerald">Slide 6 &bull; CRUD Artikel</span>
                    <h2>Manajemen Artikel</h2>
                </div>
                <p>Aplikasi lengkap untuk <strong>Menambah, Mengedit, dan Menghapus artikel</strong> menggunakan koneksi database <code>artikel_db</code> sesuai instruksi slide 6.</p>
                <div class="card-code">
// artikel_db -> artikel<br>
- Create (tambah.php)<br>
- Read (index.php)<br>
- Update (edit.php)<br>
- Delete (hapus.php)
                </div>
                <div style="display:flex; gap:8px;">
                    <a href="artikel/index.php" class="btn btn-success" style="flex:1;">📰 Buka Aplikasi Artikel</a>
                    <a href="artikel/tambah.php" class="btn btn-secondary" title="Tambah artikel baru langsung">➕ Tambah</a>
                </div>
            </div>
        </div>

        <!-- Section Struktur File -->
        <div class="section-card">
            <h3>📁 Struktur File dan Direktori Proyek</h3>
            <table>
                <thead>
                    <tr>
                        <th>Path File</th>
                        <th>Slide / Modul</th>
                        <th>Keterangan / Fungsi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><code>latihan_slide/latih1.php</code></td>
                        <td>Slide 3</td>
                        <td>Script PHP asli eksekusi query UPDATE pada tabel <code>tbl_mhs</code></td>
                    </tr>
                    <tr>
                        <td><code>latihan_slide/latih2.php</code></td>
                        <td>Slide 5</td>
                        <td>Script PHP asli eksekusi query DELETE pada tabel <code>tbl_mhs</code></td>
                    </tr>
                    <tr>
                        <td><code>latihan_slide/mysql_shim.php</code></td>
                        <td>Compatibility</td>
                        <td>Wrapper kompatibilitas agar sintaks lama <code>mysql_*</code> berjalan di PHP 8 modern</td>
                    </tr>
                    <tr>
                        <td><code>artikel/koneksi.php</code></td>
                        <td>Slide 6</td>
                        <td>Konfigurasi dan koneksi ke database <code>artikel_db</code></td>
                    </tr>
                    <tr>
                        <td><code>artikel/index.php</code></td>
                        <td>CRUD: Read</td>
                        <td>Halaman utama katalog artikel, pencarian, dan tombol aksi</td>
                    </tr>
                    <tr>
                        <td><code>artikel/tambah.php</code></td>
                        <td>CRUD: Create</td>
                        <td>Formulir dan pemrosesan penambahan artikel baru (INSERT)</td>
                    </tr>
                    <tr>
                        <td><code>artikel/edit.php</code></td>
                        <td>CRUD: Update</td>
                        <td>Formulir dan pemrosesan pengubahan artikel yang sudah ada (UPDATE)</td>
                    </tr>
                    <tr>
                        <td><code>artikel/hapus.php</code></td>
                        <td>CRUD: Delete</td>
                        <td>Eksekusi penghapusan artikel dari database (DELETE)</td>
                    </tr>
                    <tr>
                        <td><code>artikel/detail.php</code></td>
                        <td>Detail View</td>
                        <td>Halaman membaca artikel lengkap</td>
                    </tr>
                    <tr>
                        <td><code>database.sql</code></td>
                        <td>Database Schema</td>
                        <td>Script SQL untuk membuat database <code>lat_dbase</code> dan <code>artikel_db</code></td>
                    </tr>
                    <tr>
                        <td><code>setup_db.bat</code> &amp; <code>setup_db.php</code></td>
                        <td>Setup Utility</td>
                        <td>Menyiapkan tabel dan data awal mahasiswa dan artikel secara otomatis</td>
                    </tr>
                    <tr>
                        <td><code>jalankan_server.bat</code></td>
                        <td>Web Server</td>
                        <td>Menjalankan server lokal PHP di port 8000 dan membuka browser otomatis</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>&copy; 2026 Pemrograman Web 2 &bull; Program Studi Teknik Informatika &bull; Universitas Pamulang</p>
        </div>
    </div>
</body>
</html>
