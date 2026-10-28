-- ====================================================================
-- DATABASE & TABEL CALON MAHASISWA (UTS PEMROGRAMAN WEB II)
-- Data Sampel: Jinhsi, Yinlin, Phoenix
-- ====================================================================

CREATE DATABASE IF NOT EXISTS db_pmb;
USE db_pmb;

-- Hapus dan buat ulang tabel agar bersih
DROP TABLE IF EXISTS calon_mhs;

CREATE TABLE calon_mhs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    kode_pendf VARCHAR(25) NOT NULL,
    nama_pendft VARCHAR(100) NOT NULL,
    jns_kel ENUM('Laki-laki', 'Perempuan') NOT NULL,
    ttl VARCHAR(100) NOT NULL,
    asal_sekolah VARCHAR(100) NOT NULL,
    pek_ortu VARCHAR(100) NOT NULL,
    nilai_mat DECIMAL(5,2) NOT NULL,
    nilai_bing DECIMAL(5,2) NOT NULL,
    nilai_umum DECIMAL(5,2) NOT NULL,
    rata_rata DECIMAL(5,2) NOT NULL,
    keterangan VARCHAR(20) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert data sampel sesuai nama yang diminta:
INSERT INTO calon_mhs 
(kode_pendf, nama_pendft, jns_kel, ttl, asal_sekolah, pek_ortu, nilai_mat, nilai_bing, nilai_umum, rata_rata, keterangan) 
VALUES
-- 1. Jinhsi (Kategori: Lulus - Nilai Rata-rata >= 70)
('A1-101-9', 'Jinhsi', 'Perempuan', 'Jakarta, 15 Juli 2004', 'SMAN 1 Tangerang', 'Magistrate / PNS', 95.00, 92.00, 98.00, 95.00, 'Lulus'),

-- 2. Yinlin (Kategori: Cadangan - Nilai Rata-rata 60 - 70)
('B2-102-8', 'Yinlin', 'Perempuan', 'Bandung, 24 April 2004', 'SMKN 2 Depok', 'Penyelidik Swasta', 68.00, 65.00, 62.00, 65.00, 'Cadangan'),

-- 3. Phoenix (Kategori: Tidak Lulus - Nilai Rata-rata < 60)
('V3-103-7', 'Phoenix', 'Laki-laki', 'Tangerang, 10 November 2003', 'SMA Harapan Bangsa', 'Wiraswasta', 55.00, 52.00, 56.00, 54.33, 'Tidak Lulus');

-- Cek hasil input data
SELECT * FROM calon_mhs;