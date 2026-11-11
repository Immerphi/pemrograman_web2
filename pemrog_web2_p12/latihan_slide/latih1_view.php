<?php
require_once __DIR__ . '/mysql_shim.php';

$con = mysql_connect("localhost", "root", "");
if (!$con) {
    die("Koneksi gagal: " . mysql_error());
}
mysql_select_db("lat_dbase", $con);

$msg = '';

if (isset($_POST['run_update'])) {
    $res = mysql_query("UPDATE tbl_mhs SET Age = '36' WHERE FirstName = 'Ellen' AND LastName = 'Joe'");
    if ($res) {
        $msg = "Data Ellen Joe berhasil diupdate (Age = 36).";
    } else {
        $msg = "Error: " . mysql_error();
    }
}

$result = mysql_query("SELECT * FROM tbl_mhs ORDER BY mhsID ASC");
$data_mhs = [];
while ($row = mysql_fetch_assoc($result)) {
    $data_mhs[] = $row;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Latih 1 - UPDATE</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 30px; background: #f8fafc; color: #1e293b; }
        .card { background: white; padding: 25px; border-radius: 8px; border: 1px solid #cbd5e1; max-width: 700px; margin: 0 auto 20px; }
        pre { background: #0f172a; color: #38bdf8; padding: 12px; border-radius: 6px; font-size: 13px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #cbd5e1; padding: 8px 12px; text-align: left; }
        th { background: #f1f5f9; }
        .btn { padding: 8px 16px; background: #2563eb; color: white; border: none; border-radius: 4px; cursor: pointer; text-decoration: none; font-size: 14px; }
        .btn-outline { background: transparent; color: #475569; border: 1px solid #cbd5e1; margin-left: 8px; }
        .alert { padding: 10px; background: #dcfce7; color: #15803d; border-radius: 4px; margin-bottom: 15px; }
    </style>
</head>
<body>
    <div class="card">
        <h2>Latih 1: UPDATE Data</h2>
        <?php if (!empty($msg)): ?>
            <div class="alert"><?= htmlspecialchars($msg) ?></div>
        <?php endif; ?>

        <pre><code>UPDATE tbl_mhs SET Age = '36'
WHERE FirstName = 'Ellen' AND LastName = 'Joe';</code></pre>

        <form method="POST" style="margin-top: 15px;">
            <button type="submit" name="run_update" class="btn">Jalankan UPDATE</button>
            <a href="reset_tbl_mhs.php?redirect=latih1_view.php" class="btn btn-outline">Reset Data</a>
            <a href="../index.php" class="btn btn-outline">Kembali ke Dashboard</a>
        </form>
    </div>

    <div class="card">
        <h3>Tabel tbl_mhs</h3>
        <table>
            <thead>
                <tr>
                    <th>mhsID</th>
                    <th>FirstName</th>
                    <th>LastName</th>
                    <th>Age</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data_mhs as $row): ?>
                    <tr <?= ($row['FirstName'] === 'Ellen' && $row['LastName'] === 'Joe' && (int)$row['Age'] === 36) ? 'style="background:#f0fdf4; font-weight:bold;"' : '' ?>>
                        <td><?= htmlspecialchars($row['mhsID']) ?></td>
                        <td><?= htmlspecialchars($row['FirstName']) ?></td>
                        <td><?= htmlspecialchars($row['LastName']) ?></td>
                        <td><?= htmlspecialchars($row['Age']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
