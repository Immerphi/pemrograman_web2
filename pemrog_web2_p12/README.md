# Dokumentasi Praktikum Pemrograman Web 2 (Pertemuan 12)
**Program Studi S1 Teknik Informatika - Universitas Pamulang (UNPAM)**  
**Materi:** BAB VIII Manipulasi Database (UPDATE, DELETE, dan CRUD Artikel)  
**Edisi Karakter:** Honkai: Star Rail (HSR), Wuthering Waves (WuWa), & Zenless Zone Zero (ZZZ)

---

## 📌 Ringkasan Materi Pertemuan 12

Pertemuan 12 membahas tentang **Manipulasi Database** menggunakan perintah DML (*Data Manipulation Language*) pada database MySQL melalui antarmuka skrip PHP.

Materi inti yang terdapat pada slide perkuliahan:
1. **Perintah UPDATE (Slide 2 - 3):** Digunakan untuk memperbarui data / record yang sudah ada di tabel berdasarkan kriteria tertentu (`WHERE`).
2. **Perintah DELETE (Slide 4 - 5):** Digunakan untuk menghapus baris / record dari tabel berdasarkan kriteria tertentu (`WHERE`).
3. **Studi Kasus Artikel (Slide 6):** Membangun sistem **Menambah, Mengedit, dan Menghapus artikel** dengan database `artikel_db`.

---

## 📂 Struktur Direktori Proyek

```text
pemrog_web2_p12/
├── index.php                     # Portal Dashboard Utama praktikum Pertemuan 12
├── database.sql                  # Script SQL untuk database lat_dbase dan artikel_db
├── setup_db.php                  # Script inisialisasi & reset database (CLI & Web)
├── setup_db.bat                  # Shortcut batch untuk menjalankan setup_db
├── jalankan_server.bat           # Shortcut menjalankan PHP Built-in Server di port 8000
├── README.md                     # Dokumentasi panduan lengkap
│
├── latihan_slide/                # File latihan sesuai slide materi perkuliahan
│   ├── mysql_shim.php            # Shim kompatibilitas fungsi mysql_* pada PHP 7/8
│   ├── latih1.php                # Script Slide 3 (UPDATE Age Ellen Joe)
│   ├── latih1_view.php           # Tampilan interaktif demo UPDATE + tabel live
│   ├── latih2.php                # Script Slide 5 (DELETE LastName Kid)
│   ├── latih2_view.php           # Tampilan interaktif demo DELETE + tabel live
│   └── reset_tbl_mhs.php         # Reset tabel tbl_mhs ke kondisi awal
│
└── artikel/                      # Aplikasi CRUD Pengelolaan Artikel (Slide 6)
    ├── koneksi.php               # Script koneksi database artikel_db (sesuai Slide 6)
    ├── index.php                 # Daftar seluruh artikel (Read & Search)
    ├── tambah.php                # Form & proses tambah artikel baru (Create / INSERT)
    ├── edit.php                  # Form & proses ubah artikel (Update / UPDATE)
    ├── hapus.php                 # Proses hapus artikel (Delete / DELETE)
    ├── detail.php                # Tampilan membaca naskah artikel lengkap
    └── style.css                 # Desain antarmuka modern, bersih, dan responsif
```

---

## 📖 Pembahasan Kode Sesuai Slide

### 1. Latih 1: Perintah UPDATE (Slide 2 & 3)
* **Tujuan:** Mengubah data record pada tabel.
* **Bentuk Umum:**
  ```sql
  UPDATE table_name
  SET column1=value, column2=value2,...
  WHERE some_column=some_value
  ```
* **Kode Program (`latihan_slide/latih1.php`):**
  ```php
  <?php
  $con = mysql_connect("localhost","root","");
  if (!$con)
  {
      die('Could not connect: ' . mysql_error());
  }

  mysql_select_db("lat_dbase", $con);

  mysql_query("UPDATE tbl_mhs SET Age = '36'
  WHERE FirstName = 'Ellen' AND LastName = 'Joe'");

  mysql_close($con);
  ?>
  ```
* **Hasil Eksekusi:** Nilai umur (*Age*) pada data karakter dengan nama **Ellen Joe (Zenless Zone Zero)** yang awalnya `18` diperbarui menjadi `36`.

---

### 2. Latih 2: Perintah DELETE (Slide 4 & 5)
* **Tujuan:** Menghapus record pada tabel berdasarkan kriteria tertentu.
* **Bentuk Umum:**
  ```sql
  DELETE FROM table_name
  WHERE some_column = some_value
  ```
* **Kode Program (`latihan_slide/latih2.php`):**
  ```php
  <?php
  $con = mysql_connect("localhost","root","");
  if (!$con)
  {
      die('Could not connect: ' . mysql_error());
  }

  mysql_select_db("lat_dbase",$con);

  mysql_query("DELETE FROM tbl_mhs WHERE LastName='Kid'");
  ?>
  ```
* **Hasil Eksekusi:** Baris data karakter yang memiliki nilai `LastName = 'Kid'` (**Billy Kid - Zenless Zone Zero**) dihapus dari tabel `tbl_mhs`.

---

### 3. Aplikasi Artikel: Menambah, Mengedit, dan Menghapus Artikel (Slide 6)
Slide 6 memulai proyek manajemen artikel dengan membuat koneksi ke database `artikel_db`:
```php
<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "artikel_db";

// Melakukan koneksi dengan mysql
$connection = mysql_connect($dbhost,$dbuser,$dbpass);
if(!$connection)
{
    echo "Tidak dapat terhubung dengan database";
    exit;
}

// Memilih database
$pilih_db = mysql_select_db($dbname);
if(!$pilih_db)
{
    echo "Tidak dapat memilih database";
    exit;
}
?>
```

Aplikasi CRUD ini diimplementasikan secara lengkap pada folder `artikel/`:
- **`artikel/koneksi.php`**: Berisi script koneksi sesuai slide 6.
- **`artikel/tambah.php`**: Menambah artikel baru dengan formulir input `judul`, `penulis`, `lead` (ringkasan), dan `isi` konten artikel.
- **`artikel/index.php`**: Menampilkan seluruh artikel dalam bentuk kartu modern disertai kolom pencarian kata kunci.
- **`artikel/edit.php`**: Mengambil data artikel berdasarkan `articleID` dan melakukan perintah `UPDATE` setelah diedit.
- **`artikel/hapus.php`**: Mengeksekusi perintah `DELETE FROM artikel WHERE articleID = ...` disertai konfirmasi agar data tidak terhapus tanpa sengaja.
- **`artikel/detail.php`**: Menampilkan naskah artikel secara menyeluruh dan rapi.

---

## 🚀 Cara Menjalankan Proyek

### Langkah 1: Pastikan MySQL Server Aktif
Pastikan MySQL sudah berjalan (Running) di komputer Anda:
- Melalui **Laragon**: Klik tombol **Start All**.
- Melalui **XAMPP**: Klik **Start** pada modul MySQL.
- Melalui **Windows Service**: Buka CMD (Run as Administrator) dan ketik:
  ```cmd
  net start MySQL93
  ```

### Langkah 2: Setup Database Otomatis
Jalankan file batch:
```cmd
setup_db.bat
```
Atau melalui terminal:
```bash
php setup_db.php
```
*Script ini otomatis membuat database `lat_dbase` (tabel `tbl_mhs`) dan database `artikel_db` (tabel `artikel`) beserta sampel data awal.*

### Langkah 3: Menjalankan Server Web Lokal
Cukup klik dua kali file:
```cmd
jalankan_server.bat
```
Browser akan otomatis terbuka dan menampilkan Dashboard Utama di:
**`http://localhost:8000`**

---

## 💡 Catatan Kompatibilitas PHP Modern
Fungsi `mysql_*` (seperti `mysql_connect`, `mysql_select_db`, `mysql_query`) pada modul asli perkuliahan adalah ekstensi lama yang sudah dihapus sejak PHP 7.0.

Agar script pada slide tetap dapat dieksekusi persis seperti modul tanpa error *`Call to undefined function`* pada versi PHP modern (PHP 7.x dan PHP 8.x yang ada di Laragon), proyek ini dilengkapi dengan **`latihan_slide/mysql_shim.php`** yang bertindak sebagai jembatan kompatibilitas ke fungsi `mysqli_*`.
