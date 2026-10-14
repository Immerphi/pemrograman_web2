# Dokumentasi Praktikum Pemrograman Web 2 (Pertemuan 10 & 11)

Repositori / folder ini berisi implementasi seluruh tugas latihan yang terdapat pada materi perkuliahan **Pemrograman Web 2 (Bab VII - Database & Database Lanjutan)**:
- `PEMROGRAMAN WEB 2 PERTEMUAN 10.pptx` (Teori Database, DDL, DML, JOIN)
- `PEMROGRAMAN WEB 2 PERTEMUAN 11.pptx` (PHP MySQL, Latihan Praktik, Form Mahasiswa, dan Soal Latihan Buku Tamu)

---

## 📌 Deskripsi Tugas Latihan

### 1. Tugas Utama: Soal Latihan Slide 19 (Buku Tamu)
> **Soal Latihan:**
> 1. Buatlah form buku tamu, tentukan field-fieldnya dan simpanlah dalam database.
> 2. Tampilkanlah buku tamu tersebut. **Cobalah tampilkan setiap halaman 5 record.**

**Implementasi:**
- **Field Tabel `buku_tamu`:**
  - `id`: INT AUTO_INCREMENT PRIMARY KEY
  - `nama`: VARCHAR(100) NOT NULL (Nama Pengunjung)
  - `email`: VARCHAR(100) NOT NULL (Email Pengunjung)
  - `alamat`: VARCHAR(255) (Kota / Asal Instansi)
  - `pesan`: TEXT NOT NULL (Komentar / Pesan)
  - `tgl_kunjung`: DATETIME DEFAULT CURRENT_TIMESTAMP (Waktu Berkunjung)
- **Aplikasi Buku Tamu (`/buku_tamu/`):**
  - `index.php`: Formulir input buku tamu dengan validasi input, feedback notifikasi, dan desain modern responsif.
  - `simpan.php`: Memvalidasi, melakukan sanitasi input, dan menyimpan data secara aman ke database dengan prepared statement.
  - `tampil.php`: Menampilkan daftar tamu dengan **Pagination 5 Record per Halaman**, informasi nomor halaman aktif, tombol *Pertama*, *Sebelumnya*, nomor halaman dinamis, *Selanjutnya*, dan *Terakhir*.
  - `hapus.php`: Fitur tambahan untuk menghapus pesan pengujian.
  - `style.css`: Desain antarmuka modern, bersih, dan profesional.

---

### 2. Latihan Praktik Materi Slide Pertemuan 11
Selain tugas buku tamu, seluruh latihan kode program yang diajarkan pada slide pertemuan 11 juga telah dibuat dan disiapkan:

| File | Slide | Deskripsi |
|---|---|---|
| `latihan_slide/latih1.php` | Slide 3 | Koneksi ke server MySQL (`mysql_connect()`) |
| `latihan_slide/latih2.php` | Slide 5 | Membuat database `lat_dbase` (`CREATE DATABASE`) |
| `latihan_slide/latih3.php` | Slide 7 | Membuat tabel `tbl_mhs` & insert data awal 'Anjar Prabowo' |
| `latihan_slide/latih4.php` | Slide 8 | Menyisipkan data baru ('Karina Suwandi' & 'Glenn Gandari') |
| `latihan_slide/latih5.php` | Slide 11 | Menampilkan data menggunakan `mysql_fetch_row()` (index angka) |
| `latihan_slide/latih6.php` | Slide 13 | Menampilkan data menggunakan `mysql_fetch_array()` (nama kolom) |
| `latihan_slide/latih7.php` | Slide 15 | Menghitung jumlah record dalam tabel (`mysql_num_rows()`) |
| `form.php` & `insert3.php` | Slide 17-18 | Form input data mahasiswa dan skrip penyimpanan ke tabel |

> **Catatan Kompatibilitas:** Disediakan file `latihan_slide/mysql_shim.php` yang memungkinkan fungsi lama `mysql_*` tetap dapat dieksekusi dengan baik di PHP versi modern (PHP 7.x dan PHP 8.x) tanpa error `undefined function`.

---

## 📁 Struktur Direktori

```text
pemrog_web2_latihan/
│
├── index.php                 # Dashboard portal navigasi semua latihan
├── form.php                  # Form input mahasiswa (Slide 17)
├── insert3.php               # Skrip simpan data mahasiswa (Slide 18)
├── setup_db.php              # Inisialisasi otomatis database & 12 data dummy uji
├── database.sql              # Script SQL lengkap (Database lat_dbase, tbl_mhs & buku_tamu)
├── README.md                 # Dokumentasi proyek
│
├── buku_tamu/                # DIREKTORI TUGAS UTAMA (SOAL LATIHAN SLIDE 19)
│   ├── index.php             # Form input data buku tamu
│   ├── simpan.php            # Proses simpan data tamu ke database
│   ├── tampil.php            # Menampilkan data tamu dengan PAGINATION 5 RECORD
│   ├── hapus.php             # Hapus data tamu (opsional)
│   ├── config.php            # Konfigurasi koneksi & auto-setup tabel
│   ├── style.css             # Desain antarmuka (UI/UX) modern
│   └── buku_tamu.sql         # Script SQL mandiri untuk tabel buku_tamu & data uji
│
└── latihan_slide/            # DIREKTORI LATIHAN KODE SLIDE PERTEMUAN 11
    ├── mysql_shim.php        # Compatibility wrapper untuk PHP 7 / 8
    ├── latih1.php            # Latih 1 (Koneksi)
    ├── latih2.php            # Latih 2 (Create DB)
    ├── latih3.php            # Latih 3 (Create Table)
    ├── latih4.php            # Latih 4 (Insert Data)
    ├── latih5.php            # Latih 5 (Fetch Row)
    ├── latih6.php            # Latih 6 (Fetch Array)
    ├── latih7.php            # Latih 7 (Num Rows)
    ├── form.php              # Form Mahasiswa
    └── insert3.php           # Insert Mahasiswa
```

---

## 🚀 Cara Menjalankan di XAMPP / Laragon

1. **Pastikan Web Server dan MySQL Berjalan:**
   - Buka XAMPP Control Panel, lalu klik **Start** pada modul **Apache** dan **MySQL**.

2. **Salin / Tempatkan Folder ke Web Root:**
   - Salin folder `pemrog_web2_latihan` ke direktori `htdocs` XAMPP, contoh:
     `C:\xampp\htdocs\pemrog_web2_latihan`

3. **Inisialisasi Database (Pilih salah satu cara):**
   - **Cara 1 (Sangat Mudah - 1 Klik):**
     Buka browser dan akses `http://localhost/pemrog_web2_latihan/setup_db.php`. Skrip akan otomatis membuat database `lat_dbase`, seluruh tabel, dan mengisikan 12 data dummy untuk pengujian pagination 5 data per halaman.
   - **Cara 2 (Import Manual via phpMyAdmin):**
     Buka `http://localhost/phpmyadmin/`, klik tab **Import**, pilih file `database.sql`, lalu klik **Go**.

4. **Akses Aplikasi Melalui Browser:**
   - Dashboard Utama: `http://localhost/pemrog_web2_latihan/`
   - Form Buku Tamu: `http://localhost/pemrog_web2_latihan/buku_tamu/index.php`
   - Tampil Buku Tamu (Pagination): `http://localhost/pemrog_web2_latihan/buku_tamu/tampil.php`
   - Latihan Form Mahasiswa: `http://localhost/pemrog_web2_latihan/form.php`

---

## 🔍 Penjelasan Logika Pagination 5 Record per Halaman

Sesuai instruksi slide: *"Cobalah tampilkan setiap halaman 5 record"*, logika yang diterapkan pada `buku_tamu/tampil.php` adalah sebagai berikut:

```php
// 1. Tentukan batas data per halaman
$batas = 5;

// 2. Ambil nomor halaman dari parameter URL (misal: ?halaman=2), default = 1
$halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
if ($halaman < 1) { $halaman = 1; }

// 3. Hitung total data yang tersimpan di tabel
$query_total = mysqli_query($conn, "SELECT COUNT(*) AS total FROM buku_tamu");
$data_total  = mysqli_fetch_assoc($query_total);
$total_data  = (int)$data_total['total'];

// 4. Hitung total halaman yang dibutuhkan
$total_halaman = ceil($total_data / $batas);

// 5. Hitung offset / posisi awal record untuk klausa LIMIT pada query SQL
$offset = ($halaman - 1) * $batas;

// 6. Query data dengan LIMIT sesuai halaman aktif
$query_data = mysqli_query($conn, "SELECT * FROM buku_tamu ORDER BY id DESC LIMIT $offset, $batas");
```

Dengan data contoh sebanyak 12 data:
- **Halaman 1:** Menampilkan data ke-1 s/d 5
- **Halaman 2:** Menampilkan data ke-6 s/d 10
- **Halaman 3:** Menampilkan data ke-11 s/d 12
