<?php
/**
 * File: simpan.php
 * Memproses penyimpanan data formulir buku tamu ke database MySQL
 */

require_once __DIR__ . '/config.php';

// Pastikan request dikirim melalui metode POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: index.php");
    exit();
}

// Ambil dan bersihkan data input
$nama   = isset($_POST['nama']) ? trim($_POST['nama']) : '';
$email  = isset($_POST['email']) ? trim($_POST['email']) : '';
$alamat = isset($_POST['alamat']) ? trim($_POST['alamat']) : '';
$pesan  = isset($_POST['pesan']) ? trim($_POST['pesan']) : '';

// Validasi input sederhana
if (empty($nama) || empty($email) || empty($pesan)) {
    $pesan_error = urlencode("Semua kolom bertanda bintang (*) wajib diisi.");
    header("Location: index.php?status=gagal&pesan=$pesan_error");
    exit();
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $pesan_error = urlencode("Format alamat email tidak valid.");
    header("Location: index.php?status=gagal&pesan=$pesan_error");
    exit();
}

// Gunakan Prepared Statement untuk keamanan terhadap SQL Injection
$stmt = mysqli_prepare($conn, "INSERT INTO buku_tamu (nama, email, alamat, pesan, tgl_kunjung) VALUES (?, ?, ?, ?, NOW())");

if ($stmt) {
    mysqli_stmt_bind_param($stmt, "ssss", $nama, $email, $alamat, $pesan);
    
    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        // Berhasil disimpan, alihkan ke halaman tampil dengan notifikasi sukses
        header("Location: tampil.php?status=sukses");
        exit();
    } else {
        $error_msg = urlencode("Query Error: " . mysqli_stmt_error($stmt));
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        header("Location: index.php?status=gagal&pesan=$error_msg");
        exit();
    }
} else {
    // Fallback jika prepared statement gagal
    $nama_esc   = mysqli_real_escape_string($conn, $nama);
    $email_esc  = mysqli_real_escape_string($conn, $email);
    $alamat_esc = mysqli_real_escape_string($conn, $alamat);
    $pesan_esc  = mysqli_real_escape_string($conn, $pesan);

    $sql = "INSERT INTO buku_tamu (nama, email, alamat, pesan, tgl_kunjung) 
            VALUES ('$nama_esc', '$email_esc', '$alamat_esc', '$pesan_esc', NOW())";

    if (mysqli_query($conn, $sql)) {
        mysqli_close($conn);
        header("Location: tampil.php?status=sukses");
        exit();
    } else {
        $error_msg = urlencode("Database Error: " . mysqli_error($conn));
        mysqli_close($conn);
        header("Location: index.php?status=gagal&pesan=$error_msg");
        exit();
    }
}
?>
