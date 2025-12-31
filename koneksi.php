<?php
$host = "localhost";
$user = "root";  // default XAMPP
$pass = "";      // default XAMPP (kosong)
$db   = "db_pengumuman";

$koneksi = mysqli_connect($host, $user, $pass, $db);

// Cek koneksi
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
// echo "Koneksi berhasil!"; // bisa di-comment setelah testing
?>