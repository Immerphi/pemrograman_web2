<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Latihan form.php - Input Mahasiswa</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background-color: #f4f6f9; }
        .card { background: white; padding: 25px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); max-width: 400px; }
        input[type="text"], input[type="number"] { width: 100%; padding: 8px; margin: 6px 0 15px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px; }
        input[type="submit"] { background: #007bff; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; font-weight: bold; }
        input[type="submit"]:hover { background: #0056b3; }
        a { color: #007bff; text-decoration: none; }
    </style>
</head>
<body>
    <div class="card">
        <h3>Latihan Form Mahasiswa (form.php)</h3>
        <p><small>Sesuai materi Slide 17</small></p>
        <form action="insert3.php" method="post">
            <label>Firstname:</label>
            <input type="text" name="firstname" required />

            <label>Lastname:</label>
            <input type="text" name="lastname" required />

            <label>Age:</label>
            <input type="text" name="age" required />

            <input type="submit" value="Submit Data" />
        </form>
        <p style="margin-top: 20px;"><a href="../index.php">&larr; Kembali ke Menu Utama</a></p>
    </div>
</body>
</html>
