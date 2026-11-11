<?php
require_once __DIR__ . '/mysql_shim.php';

$con = mysql_connect("localhost", "root", "");
if (!$con) {
    die("Koneksi gagal: " . mysql_error());
}
mysql_select_db("lat_dbase", $con);

$msg = '';

if (isset($_POST['run_delete'])) {
    $res = mysql_query("DELETE FROM tbl_mhs WHERE LastName='Kid'");
    if ($res) {
        $msg = "Data dengan LastName = 'Kid' (Billy Kid) berhasil dihapus.";
    } else {
        $msg = "Error: " . mysql_error();
    }
}

$result = mysql_query("SELECT * FROM tbl_mhs ORDER BY mhsID ASC");
$data_mhs = [];
$has_billy = false;
while ($row = mysql_fetch_assoc($result)) {
    $data_mhs[] = $row;
    if ($row['LastName'] === 'Kid') $has_billy = true;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Latih 2 - DELETE</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 30px; background: #f8fafc; color: #1e293b; }
        .card { background: white; padding: 25px; border-radius: 8px; border: 1px solid #cbd5e1; max-width: 700px; margin: 0 auto 20px; }
        pre { background: #0f172a; color: #f87171; padding: 12px; border-radius: 6px; font-size: 13px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #cbd5e1; padding: 8px 12px; text-align: left; }
        th { background: #f1f5f9; }
        .btn { padding: 8px 16px; background: #dc2626; color: white; border: none; border-radius: 4px; cursor: pointer; text-decoration: none; font-size: 14px; }
        .btn-outline { background: transparent; color: #475569; border: 1px solid #cbd5e1; margin-left: 8px; }
        .alert { padding: 10px; background: #fee2e2; color: #991b1b; border-radius: 4px; margin-bottom: 15px; }
    </style>
</head>
<body>
    <div class="card">
        <h2>Latih 2: DELETE Data</h2>
        <?php if (!empty($msg)): ?>
            <div class="alert"><?= htmlspecialchars($msg) ?></div>
        <?php endif; ?>

        <pre><code>DELETE FROM tbl_mhs WHERE LastName='Kid';</code></pre>

        <form method="POST" style="margin-top: 15px;">
            <button type="submit" name="run_delete" class="btn" <?= !$has_billy ? 'disabled' : '' ?>>Jalankan DELETE</button>
            <a href="reset_tbl_mhs.php?redirect=latih2_view.php" class="btn btn-outline">Reset Data</a>
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
                    <tr>
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
