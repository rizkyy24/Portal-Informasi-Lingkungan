<?php
include 'koneksi.php';

// CEK APAKAH ADA PARAMETER ID
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // HAPUS DATA
    $sql = "DELETE FROM pengumuman WHERE id = '$id'";
    
    if (mysqli_query($koneksi, $sql)) {
        // Redirect kembali ke halaman sebelumnya
        echo "<script>alert('Pengumuman berhasil dihapus!'); window.history.back();</script>";
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
} else {
    echo "ID tidak valid!";
}
?>