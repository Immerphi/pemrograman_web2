<?php
// Inisialisasi variabel
$nilai1 = '';
$nilai2 = '';
$operator = '+';
$hasil = null;
$error = '';

// Cek apakah form telah disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nilai1 = isset($_POST['nilai1']) ? trim($_POST['nilai1']) : '';
    $nilai2 = isset($_POST['nilai2']) ? trim($_POST['nilai2']) : '';
    $operator = isset($_POST['operator']) ? $_POST['operator'] : '+';

    // Validasi input
    if ($nilai1 === '' || $nilai2 === '') {
        $error = 'Harap isi Nilai I dan Nilai II!';
    } elseif (!is_numeric($nilai1) || !is_numeric($nilai2)) {
        $error = 'Nilai I dan Nilai II harus berupa angka!';
    } else {
        $n1 = (float)$nilai1;
        $n2 = (float)$nilai2;

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
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Latihan 3 - Pemrograman Web 2</title>
    <style>
        * {
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }
        body {
            background-color: #f4f6f9;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
        }
        .container {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            padding: 40px;
            max-width: 650px;
            width: 100%;
            text-align: center;
        }
        h2 {
            color: #333;
            margin-bottom: 25px;
        }
        .calculator-form {
            margin: 30px 0;
        }
        .labels-row {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            max-width: 500px;
            margin: 0 auto 8px auto;
        }
        .label-col {
            flex: 1;
            text-align: center;
        }
        .label-red {
            color: #b30000;
            font-weight: bold;
            font-size: 16px;
        }
        .form-row {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            max-width: 500px;
            margin: 0 auto;
        }
        .input-field {
            flex: 1;
            padding: 8px 12px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
            outline: none;
        }
        .input-field:focus {
            border-color: #007bff;
        }
        .select-operator {
            padding: 8px 10px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #fff;
            cursor: pointer;
            outline: none;
        }
        .btn-submit {
            padding: 8px 16px;
            font-size: 14px;
            background-color: #e0e0e0;
            border: 1px solid #999;
            border-radius: 4px;
            cursor: pointer;
            font-weight: 500;
            transition: background-color 0.2s;
        }
        .btn-submit:hover {
            background-color: #d0d0d0;
        }
        .result-box {
            margin-top: 30px;
            padding: 15px;
            border-radius: 6px;
            background-color: #e9f7ef;
            border: 1px solid #c3e6cb;
            color: #155724;
            font-size: 18px;
            font-weight: bold;
        }
        .error-box {
            margin-top: 30px;
            padding: 15px;
            border-radius: 6px;
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            color: #721c24;
            font-size: 15px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Latihan 3.</h2>
    <p>Buatlah tampilan dibawah ini</p>

    <form method="POST" action="" class="calculator-form">
        <!-- Label Nilai I dan Nilai II (Teks Merah) -->
        <div class="labels-row">
            <div class="label-col"><span class="label-red">Nilai I</span></div>
            <div style="width: 45px;"></div> <!-- Area penyeimbang dropdown operator -->
            <div class="label-col"><span class="label-red">Nilai II</span></div>
            <div style="width: 70px;"></div> <!-- Area penyeimbang tombol submit -->
        </div>

        <!-- Form Input -->
        <div class="form-row">
            <input type="number" step="any" name="nilai1" class="input-field" value="<?= htmlspecialchars($nilai1) ?>" required placeholder="Masukkan Nilai I">
            
            <select name="operator" class="select-operator">
                <option value="+" <?= $operator === '+' ? 'selected' : '' ?>>+</option>
                <option value="-" <?= $operator === '-' ? 'selected' : '' ?>>-</option>
                <option value="*" <?= $operator === '*' ? 'selected' : '' ?>>*</option>
                <option value="/" <?= $operator === '/' ? 'selected' : '' ?>>/</option>
            </select>
            
            <input type="number" step="any" name="nilai2" class="input-field" value="<?= htmlspecialchars($nilai2) ?>" required placeholder="Masukkan Nilai II">
            
            <button type="submit" class="btn-submit">submit</button>
        </div>
    </form>

    <!-- Menampilkan Hasil Perhitungan di Halaman yang Sama -->
    <?php if ($error !== ''): ?>
        <div class="error-box">
            <?= htmlspecialchars($error) ?>
        </div>
    <?php elseif ($hasil !== null): ?>
        <div class="result-box">
            Hasil Perhitungan: <?= htmlspecialchars($nilai1) ?> <?= htmlspecialchars($operator) ?> <?= htmlspecialchars($nilai2) ?> = <?= htmlspecialchars((string)$hasil) ?>
        </div>
    <?php endif; ?>
</div>

</body>
</html>
