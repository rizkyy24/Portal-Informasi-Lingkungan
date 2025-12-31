<?php
include 'koneksi.php';

// PROSES SIMPAN DATA
if (isset($_POST['submit'])) {
    $judul = mysqli_real_escape_string($koneksi, $_POST['judul']);
    $isi = mysqli_real_escape_string($koneksi, $_POST['isi']);
    $penulis = mysqli_real_escape_string($koneksi, $_POST['penulis']);
    
    $sql = "INSERT INTO pengumuman (judul, isi, penulis) 
            VALUES ('$judul', '$isi', '$penulis')";
    
    if (mysqli_query($koneksi, $sql)) {
        header("Location: index.php"); // Redirect ke halaman utama
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Buat Pengumuman Baru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2 class="text-center">Buat Pengumuman Baru</h2>
        
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form method="POST" action="">
                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul Pengumuman</label>
                        <input type="text" class="form-control" id="judul" name="judul" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="isi" class="form-label">Isi Pengumuman</label>
                        <textarea class="form-control" id="isi" name="isi" rows="5" required></textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label for="penulis" class="form-label">Penulis</label>
                        <input type="text" class="form-control" id="penulis" name="penulis" value="Admin" required>
                    </div>
                    
                    <div class="d-grid gap-2">
                        <button type="submit" name="submit" class="btn btn-primary">Simpan Pengumuman</button>
                        <a href="index.php" class="btn btn-secondary">Kembali ke Beranda</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>