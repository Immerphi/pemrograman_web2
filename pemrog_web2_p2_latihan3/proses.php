<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nilai1 = isset($_POST['nilai1']) ? trim($_POST['nilai1']) : '';
    $nilai2 = isset($_POST['nilai2']) ? trim($_POST['nilai2']) : '';
    $operator = isset($_POST['operator']) ? $_POST['operator'] : '+';

    if ($nilai1 === '' || $nilai2 === '') {
        $error = 'Harap isi Nilai I dan Nilai II!';
    } elseif (!is_numeric($nilai1) || !is_numeric($nilai2)) {
        $error = 'Nilai I dan Nilai II harus berupa angka!';
    } else {
        $n1 = (float) $nilai1;
        $n2 = (float) $nilai2;

        switch ($operator) {
            case '+':
                $hasil = $n1 + $n2;
                break;
            case '-':
                $hasil = $n1 - $n2;
                break;
            case '*':
                $hasil = $n1 * $n2;
                break;
            case '/':
                if ($n2 == 0) {
                    $error = 'Kesalahan: Pembagian dengan angka 0 tidak diperbolehkan!';
                } else {
                    $hasil = $n1 / $n2;
                }
                break;
            default:
                $error = 'Operator tidak valid!';
                break;
        }
    }
} else {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Perhitungan - Latihan 3</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f9;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        .container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 500px;
            width: 100%;
        }

        .result {
            background-color: #e9f7ef;
            border: 1px solid #c3e6cb;
            color: #155724;
            padding: 15px;
            border-radius: 6px;
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .error {
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            color: #721c24;
            padding: 15px;
            border-radius: 6px;
            margin-bottom: 20px;
        }

        .btn-back {
            display: inline-block;
            padding: 8px 16px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            font-size: 14px;
        }

        .btn-back:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Hasil Perhitungan</h2>
        <?php if (isset($error)): ?>
            <div class="error"><?= htmlspecialchars($error) ?></div>
        <?php else: ?>
            <div class="result">
                Hasil: <?= htmlspecialchars($nilai1) ?>     <?= htmlspecialchars($operator) ?>
                <?= htmlspecialchars($nilai2) ?> = <?= htmlspecialchars((string) $hasil) ?>
            </div>
    <?php endif; ?>
    <a href="index.php" class="btn-back">Kembali ke Form</a>
</div>
</body>
</html>