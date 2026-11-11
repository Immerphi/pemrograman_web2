<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Latihan form.php - Input Mahasiswa</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin: 40px; background-color: #f1f5f9; color: #334155; }
        .card { background: white; padding: 30px; border-radius: 10px; box-shadow: 0 4px 12px rgba(0,0,0,0.08); max-width: 440px; margin: 0 auto; }
        h3 { margin-top: 0; color: #1e293b; }
        label { display: block; font-weight: 600; font-size: 14px; margin-bottom: 5px; color: #475569; }
        input[type="text"], input[type="number"] { width: 100%; padding: 10px; margin-bottom: 16px; box-sizing: border-box; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 14px; transition: border-color 0.2s; }
        input[type="text"]:focus, input[type="number"]:focus { outline: none; border-color: #4f46e5; box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.15); }
        input[type="submit"] { background: #4f46e5; color: white; padding: 10px 24px; border: none; border-radius: 6px; cursor: pointer; font-weight: 600; font-size: 14px; transition: background 0.2s; width: 100%; }
        input[type="submit"]:hover { background: #4338ca; }
        .back-link { display: inline-block; margin-top: 18px; color: #64748b; text-decoration: none; font-size: 14px; }
        .back-link:hover { color: #4f46e5; }
    </style>
</head>
<body>
    <div class="card">
        <h3>Latihan Form Mahasiswa (form.php)</h3>
        <p style="color: #64748b; font-size: 13px; margin-top: -5px;">Materi Pertemuan 11 - Slide 17</p>
        <form action="insert3.php" method="post">
            <label>Firstname:</label>
            <input type="text" name="firstname" placeholder="Contoh: Budi" required />

            <label>Lastname:</label>
            <input type="text" name="lastname" placeholder="Contoh: Pratama" required />

            <label>Age:</label>
            <input type="number" name="age" placeholder="Contoh: 21" required />

            <input type="submit" value="Submit Data" />
        </form>
        <div style="text-align: center;">
            <a class="back-link" href="index.php">&larr; Kembali ke Dashboard Latihan</a>
        </div>
    </div>
</body>
</html>
