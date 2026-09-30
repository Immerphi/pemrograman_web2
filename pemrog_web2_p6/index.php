<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Praktikum Pemrograman Web 2 - Pertemuan 6</title>
    <style>
        :root {
            --primary: #1e3a8a;
            --primary-light: #3b82f6;
            --secondary: #10b981;
            --bg: #f8fafc;
            --card-bg: #ffffff;
            --text-main: #1e293b;
            --text-muted: #64748b;
            --border: #e2e8f0;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
        }

        body {
            background-color: var(--bg);
            color: var(--text-main);
            padding: 30px 20px;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
        }

        .header {
            background: linear-gradient(135deg, #1e3a8a 0%, #2563eb 100%);
            color: white;
            padding: 28px;
            border-radius: 14px;
            box-shadow: 0 10px 25px -5px rgba(30, 58, 138, 0.25);
            margin-bottom: 30px;
            text-align: center;
        }

        .header h1 {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .header p {
            font-size: 15px;
            opacity: 0.9;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 22px;
        }

        .card {
            background: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 20px -5px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #f1f5f9;
            padding: 16px 20px;
            border-bottom: 1px solid var(--border);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-header h2 {
            font-size: 17px;
            font-weight: 600;
            color: var(--primary);
        }

        .badge {
            font-size: 12px;
            background: #dbeafe;
            color: #1d4ed8;
            padding: 4px 10px;
            border-radius: 9999px;
            font-weight: 500;
        }

        .card-body {
            padding: 20px;
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .code-box {
            background: #0f172a;
            color: #f8fafc;
            padding: 14px;
            border-radius: 8px;
            font-family: Consolas, Monaco, "Courier New", Courier, monospace;
            font-size: 12px;
            overflow-x: auto;
            max-height: 220px;
            line-height: 1.5;
        }

        .result-box {
            background: #f8fafc;
            border: 1px dashed var(--primary-light);
            border-radius: 8px;
            padding: 14px;
        }

        .result-title {
            font-size: 12px;
            font-weight: 600;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 8px;
        }

        .result-content {
            font-size: 14px;
            color: #0f172a;
            line-height: 1.6;
        }

        .btn-view {
            display: inline-block;
            text-align: center;
            padding: 10px 16px;
            background: var(--primary);
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            transition: background 0.2s;
            margin-top: auto;
        }

        .btn-view:hover {
            background: #1d4ed8;
        }

        footer {
            margin-top: 40px;
            text-align: center;
            color: var(--text-muted);
            font-size: 13px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <h1>Praktikum Pemrograman Web 2 - Pertemuan 6</h1>
        <p>Program Studi Teknik Informatika - Universitas Pamulang</p>
        <p style="margin-top: 6px; font-size: 13px; opacity: 0.8;">Materi: Array pada PHP (Indexed Array, Associative Array, dan Foreach)</p>
    </div>

    <div class="grid">
        <!-- Latihan 1 -->
        <div class="card">
            <div class="card-header">
                <h2>Latihan 1</h2>
                <span class="badge">count() & sizeof()</span>
            </div>
            <div class="card-body">
                <div class="code-box">
<pre>&lt;?php
$a[0] = 1;
$a[1] = 3;
$a[2] = 5;
$jumlah = count($a);
print "Jumlah array a = $jumlah &lt;br&gt;";

$b["buah"] = "semangka";
$b["sayur"] = "wortel";
$b["daging"] = "ayam";
$b["utama"] = "nasi";
$jumlah = sizeof($b);
print "Jumlah array b = $jumlah &lt;br&gt;";
?&gt;</pre>
                </div>

                <div class="result-box">
                    <div class="result-title">Hasil Output:</div>
                    <div class="result-content">
                        <?php
                        include 'latihan1.php';
                        ?>
                    </div>
                </div>

                <a href="latihan1.php" target="_blank" class="btn-view">Buka File Latihan 1 &rarr;</a>
            </div>
        </div>

        <!-- Latihan 2 -->
        <div class="card">
            <div class="card-header">
                <h2>Latihan 2</h2>
                <span class="badge">Foreach Array Nilai</span>
            </div>
            <div class="card-body">
                <div class="code-box">
<pre>&lt;?php
$x = array("one", "two", "three");
foreach ($x as $value) {
    echo $value . "&lt;br /&gt;";
}
?&gt;</pre>
                </div>

                <div class="result-box">
                    <div class="result-title">Hasil Output:</div>
                    <div class="result-content">
                        <?php
                        include 'latihan2.php';
                        ?>
                    </div>
                </div>

                <a href="latihan2.php" target="_blank" class="btn-view">Buka File Latihan 2 &rarr;</a>
            </div>
        </div>

        <!-- Latihan 3 -->
        <div class="card">
            <div class="card-header">
                <h2>Latihan 3</h2>
                <span class="badge">Foreach Key & Value</span>
            </div>
            <div class="card-body">
                <div class="code-box">
<pre>&lt;?php
$UsiaKaryawan["Lisa"] = "28";
$UsiaKaryawan["Jack"] = "16";
$UsiaKaryawan["Ryan"] = "35";
$UsiaKaryawan["Rachel"] = "46";
$UsiaKaryawan["Grace"] = "34";

foreach ($UsiaKaryawan as $Nama =&gt; $Umur) {
    echo "Nama Karyawan: $Nama, Usia: $Umur" . " th &lt;br&gt;";
}
?&gt;</pre>
                </div>

                <div class="result-box">
                    <div class="result-title">Hasil Output:</div>
                    <div class="result-content">
                        <?php
                        include 'latihan3.php';
                        ?>
                    </div>
                </div>

                <a href="latihan3.php" target="_blank" class="btn-view">Buka File Latihan 3 &rarr;</a>
            </div>
        </div>
    </div>

    <footer>
        <p>&copy; 2026 - Teknik Informatika Universitas Pamulang</p>
    </footer>
</div>

</body>
</html>
