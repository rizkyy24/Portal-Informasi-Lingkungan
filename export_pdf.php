<?php
include 'koneksi.php';

// CEK APAKAH ADA PARAMETER ID
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = mysqli_real_escape_string($koneksi, $_GET['id']);
    
    // AMBIL DATA PENGUMUMAN
    $sql = "SELECT * FROM pengumuman WHERE id = '$id'";
    $result = mysqli_query($koneksi, $sql);
    
    if (mysqli_num_rows($result) > 0) {
        $pengumuman = mysqli_fetch_assoc($result);
        
        // GUNAKAN MPDF
        require_once __DIR__ . '/vendor/autoload.php';
        
        $mpdf = new \Mpdf\Mpdf();
        
        // HTML CONTENT
        $html = '
        <!DOCTYPE html>
        <html>
        <head>
            <style>
                body { font-family: Arial, sans-serif; margin: 20px; line-height: 1.6; }
                .header { text-align: center; border-bottom: 2px solid #2c3e50; padding-bottom: 15px; margin-bottom: 25px; }
                .title { font-size: 20px; font-weight: bold; color: #2c3e50; margin-bottom: 10px; }
                .subtitle { font-size: 14px; color: #7f8c8d; }
                .content { font-size: 12px; margin-bottom: 25px; white-space: pre-line; }
                .meta-info { background: #ecf0f1; padding: 15px; border-radius: 5px; font-size: 11px; margin-top: 20px; }
                .footer { text-align: center; margin-top: 40px; font-size: 10px; color: #95a5a6; border-top: 1px solid #bdc3c7; padding-top: 10px; }
            </style>
        </head>
        <body>
            <div class="header">
                <div class="title">PORTAL INFORMASI LINGKUNGAN</div>
                <div class="subtitle">Desa Tajur Halang</div>
            </div>
            
            <div style="text-align: center; margin-bottom: 20px;">
                <h2>' . $pengumuman['judul'] . '</h2>
            </div>
            
            <div class="content">' . $pengumuman['isi'] . '</div>
            
            <div class="meta-info">
                <strong>Informasi Pengumuman:</strong><br>
                • Ditulis oleh: ' . $pengumuman['penulis'] . '<br>
                • Tanggal dibuat: ' . date('d-m-Y H:i', strtotime($pengumuman['tanggal'])) . '<br>
                • Diunduh pada: ' . date('d-m-Y H:i') . '
            </div>
            
            <div class="footer">
                Portal Informasi Lingkungan - Create by Mohamad Rizky Awaludin<br>
                Halaman 1 dari 1
            </div>
        </body>
        </html>';
        
        $mpdf->WriteHTML($html);
        $mpdf->Output($pengumuman['judul'] . '.pdf', 'D');
        
    } else {
        echo "<script>alert('Pengumuman tidak ditemukan!'); window.history.back();</script>";
    }
} else {
    echo "<script>alert('ID tidak valid!'); window.history.back();</script>";
}
?>