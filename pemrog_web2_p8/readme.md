NOTE

Catatan untuk Latihan 2 pada PHP modern (PHP 7 & 8): Kode asli di slide dibuat pada era PHP lama (PHP 4/5) yang memiliki beberapa kendala saat dijalankan di PHP modern:

1. $_post ditulis huruf kecil (pada PHP harus huruf besar: $_POST).
2. Variabel diambil sebagai $a dan $b, namun pada perhitungan yang dipanggil adalah $A dan $B.
3. Tag <form> belum memiliki atribut method="post".
4. Saat halaman pertama kali dibuka (belum klik tombol submit), $A dan $B masih kosong sehingga bagi($A, $B) akan memicu error DivisionByZeroError.

Jadi padafile  latihan2  revisi dibuat agar kode nya bisa berjalan lancar.