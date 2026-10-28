<?php
// Koneksi Database
$conn = mysqli_connect("localhost", "root", "123456", "db_pmb");
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Logika Kode Pendaftaran sesuai Soal
function parseKode($kode)
{
    $kode = strtoupper(trim($kode));
    $tempat_char = substr($kode, 0, 1);
    $gelombang = substr($kode, 1, 1);

    $tempat = "Gedung Lain";
    if ($tempat_char == 'A')
        $tempat = "Gedung A";
    elseif ($tempat_char == 'B')
        $tempat = "Gedung B";
    elseif ($tempat_char == 'V')
        $tempat = "Viktor";

    $parts = explode('-', $kode);
    $bulan_char = end($parts);
    $bln_map = [
        '1' => 'Januari',
        '2' => 'Februari',
        '3' => 'Maret',
        '4' => 'April',
        '5' => 'Mei',
        '6' => 'Juni',
        '7' => 'Juli',
        '8' => 'Agustus',
        '9' => 'September',
        '10' => 'Oktober',
        '11' => 'November',
        '12' => 'Desember'
    ];
    $bulan = isset($bln_map[$bulan_char]) ? $bln_map[$bulan_char] : "Bulan " . $bulan_char;

    return "$tempat - Gel $gelombang";
}

// Simpan Data
$pesan = "";
if (isset($_POST['simpan'])) {
    $jml = isset($_POST['jml_input']) ? (int) $_POST['jml_input'] : 1;
    for ($i = 0; $i < $jml; $i++) {
        $kode_pendf = mysqli_real_escape_string($conn, $_POST['kode_pendf'][$i]);
        $nama_pendft = mysqli_real_escape_string($conn, $_POST['nama_pendft'][$i]);
        $jns_kel = mysqli_real_escape_string($conn, $_POST['jns_kel'][$i]);
        $ttl = mysqli_real_escape_string($conn, $_POST['ttl'][$i]);
        $asal_sekolah = mysqli_real_escape_string($conn, $_POST['asal_sekolah'][$i]);
        $pek_ortu = mysqli_real_escape_string($conn, $_POST['pek_ortu'][$i]);
        $mat = (float) $_POST['mat'][$i];
        $bing = (float) $_POST['bing'][$i];
        $umum = (float) $_POST['umum'][$i];

        $rata = round(($mat + $bing + $umum) / 3, 2);

        if ($rata >= 70)
            $ket = "Lulus";
        elseif ($rata >= 60)
            $ket = "Cadangan";
        else
            $ket = "Tidak Lulus";

        if (!empty($kode_pendf) && !empty($nama_pendft)) {
            mysqli_query($conn, "INSERT INTO calon_mhs (kode_pendf, nama_pendft, jns_kel, ttl, asal_sekolah, pek_ortu, nilai_mat, nilai_bing, nilai_umum, rata_rata, keterangan) 
                                 VALUES ('$kode_pendf', '$nama_pendft', '$jns_kel', '$ttl', '$asal_sekolah', '$pek_ortu', '$mat', '$bing', '$umum', '$rata', '$ket')");
        }
    }
    $pesan = "Data pendaftar berhasil disimpan ke database!";
}

$jml_form = isset($_POST['jumlah_data']) ? (int) $_POST['jumlah_data'] : 1;
if ($jml_form < 1)
    $jml_form = 1;
?>
<!DOCTYPE html>
<html>

<head>
    <title>UTS Pemrograman Web II - Pendaftaran Mahasiswa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background: #f8f9fa;
        }

        .wrapper {
            background: #fff;
            padding: 25px;
            border-radius: 5px;
            max-width: 1100px;
            margin: auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .kop {
            text-align: center;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .form-box {
            background: #fdfdfd;
            border: 1px solid #ddd;
            padding: 15px;
            margin-bottom: 15px;
        }

        .row {
            margin-bottom: 8px;
            display: flex;
            align-items: center;
        }

        .row label {
            width: 200px;
            font-weight: bold;
            font-size: 13px;
        }

        .row input[type="text"],
        .row input[type="number"] {
            padding: 5px;
            width: 300px;
            border: 1px solid #ccc;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 12px;
        }

        table,
        th,
        td {
            border: 1px solid #666;
        }

        th {
            background: #e9ecef;
            padding: 8px;
        }

        td {
            padding: 6px;
        }

        .btn {
            padding: 7px 15px;
            cursor: pointer;
            border: none;
            font-weight: bold;
        }

        .btn-submit {
            background: #007bff;
            color: white;
        }

        .btn-reset {
            background: #6c757d;
            color: white;
        }

        .btn-set {
            background: #28a745;
            color: white;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="kop">
            <h3>YAYASAN SASMITA JAYA</h3>
            <h2>UNIVERSITAS PAMULANG</h2>
            <h4>FAKULTAS ILMU KOMPUTER - TEKNIK INFORMATIKA S-1</h4>
            <p>UJIAN TENGAH SEMESTER (UTS) - PEMROGRAMAN WEB II</p>
        </div>

        <?php if ($pesan): ?>
            <p style="color: green; font-weight: bold;"><?= $pesan; ?></p>
        <?php endif; ?>

        <!-- PENGATURAN JUMLAH DATA -->
        <form method="POST">
            <div class="row">
                <label>JUMLAH DATA :</label>
                <input type="number" name="jumlah_data" value="<?= $jml_form; ?>" min="1" max="10" style="width: 60px;">
                &nbsp;
                <button type="submit" class="btn btn-set">Set Form</button>
            </div>
        </form>

        <!-- FORM PENDAFTARAN -->
        <form method="POST">
            <input type="hidden" name="jml_input" value="<?= $jml_form; ?>">
            <?php for ($i = 0; $i < $jml_form; $i++): ?>
                <div class="form-box">
                    <h4>INPUT PENDAFTARAN <?= ($jml_form > 1) ? "#" . ($i + 1) : ""; ?></h4>
                    <div class="row">
                        <label>KODE PENDAFTARAN :</label>
                        <input type="text" name="kode_pendf[]" placeholder="Contoh: A2-101-9" required>
                    </div>
                    <div class="row">
                        <label>NAMA PENDAFTAR :</label>
                        <input type="text" name="nama_pendft[]" required>
                    </div>
                    <div class="row">
                        <label>JENIS KELAMIN :</label>
                        <div>
                            <input type="radio" name="jns_kel[<?= $i; ?>]" value="Laki-laki" checked> Laki-laki
                            <input type="radio" name="jns_kel[<?= $i; ?>]" value="Perempuan"> Perempuan
                        </div>
                    </div>
                    <div class="row">
                        <label>TTL :</label>
                        <input type="text" name="ttl[]" required>
                    </div>
                    <div class="row">
                        <label>ASAL SEKOLAH :</label>
                        <input type="text" name="asal_sekolah[]" required>
                    </div>
                    <div class="row">
                        <label>PEKERJAAN ORTU :</label>
                        <input type="text" name="pek_ortu[]" required>
                    </div>
                    <p><b>NILAI TES :</b></p>
                    <div class="row">
                        <label style="padding-left: 20px;">- MATEMATIKA :</label>
                        <input type="number" step="0.01" name="mat[]" min="0" max="100" required>
                    </div>
                    <div class="row">
                        <label style="padding-left: 20px;">- BAHASA INGGRIS :</label>
                        <input type="number" step="0.01" name="bing[]" min="0" max="100" required>
                    </div>
                    <div class="row">
                        <label style="padding-left: 20px;">- UMUM :</label>
                        <input type="number" step="0.01" name="umum[]" min="0" max="100" required>
                    </div>
                </div>
            <?php endfor; ?>

            <button type="submit" name="simpan" class="btn btn-submit">SUBMIT</button>
            <button type="reset" class="btn btn-reset">BATAL</button>
        </form>

        <!-- TABEL DATA -->
        <h3 style="margin-top: 30px;">TABEL DATA (DATABASE: calon_mhs)</h3>
        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Kode</th>
                    <th>Kode Pendf.</th>
                    <th>Nama Pendft.</th>
                    <th>Jns Kel</th>
                    <th>TTL</th>
                    <th>Asal Sekolah</th>
                    <th>Pek. Ortu</th>
                    <th>Mat</th>
                    <th>B. Ingr</th>
                    <th>Umum</th>
                    <th>Rata-Rata</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $q = mysqli_query($conn, "SELECT * FROM calon_mhs ORDER BY id ASC");
                $total = 0;
                $lulus = 0;
                $cadangan = 0;
                $tidak = 0;
                if ($q && mysqli_num_rows($q) > 0) {
                    $no = 1;
                    while ($r = mysqli_fetch_assoc($q)) {
                        $total++;
                        if ($r['keterangan'] == 'Lulus')
                            $lulus++;
                        elseif ($r['keterangan'] == 'Cadangan')
                            $cadangan++;
                        else
                            $tidak++;

                        $kode_ringkas = parseKode($r['kode_pendf']);
                        echo "<tr>
                        <td align='center'>{$no}</td>
                        <td align='center'>{$kode_ringkas}</td>
                        <td align='center'>{$r['kode_pendf']}</td>
                        <td>{$r['nama_pendft']}</td>
                        <td align='center'>{$r['jns_kel']}</td>
                        <td>{$r['ttl']}</td>
                        <td>{$r['asal_sekolah']}</td>
                        <td>{$r['pek_ortu']}</td>
                        <td align='center'>{$r['nilai_mat']}</td>
                        <td align='center'>{$r['nilai_bing']}</td>
                        <td align='center'>{$r['nilai_umum']}</td>
                        <td align='center'>{$r['rata_rata']}</td>
                        <td align='center'><b>{$r['keterangan']}</b></td>
                    </tr>";
                        $no++;
                    }
                } else {
                    echo "<tr><td colspan='13' align='center'>Belum ada data di database.</td></tr>";
                }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="11" align="right"><b>JUMLAH PENDAFTAR</b></td>
                    <td colspan="2" align="center"><b><?= $total; ?></b></td>
                </tr>
                <tr>
                    <td colspan="11" align="right"><b>JUMLAH PESERTA LULUS</b></td>
                    <td colspan="2" align="center"><b><?= $lulus; ?></b></td>
                </tr>
                <tr>
                    <td colspan="11" align="right"><b>JUMLAH PESERTA CADANGAN</b></td>
                    <td colspan="2" align="center"><b><?= $cadangan; ?></b></td>
                </tr>
                <tr>
                    <td colspan="11" align="right"><b>JUMLAH TIDAK PESERTA LULUS</b></td>
                    <td colspan="2" align="center"><b><?= $tidak; ?></b></td>
                </tr>
            </tfoot>
        </table>
    </div>
</body>

</html>