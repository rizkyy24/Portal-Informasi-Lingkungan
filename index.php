<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Info Lingkungan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --accent-color: #e74c3c;
            --light-color: #ecf0f1;
            --dark-color: #2c3e50;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .glass-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
        }

        .header-section {
            padding: 40px 0;
            text-align: center;
            color: white;
        }

        .header-section h1 {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 10px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .header-section p {
            font-size: 1.2rem;
            opacity: 0.9;
        }

        .btn-modern {
            background: linear-gradient(45deg, var(--secondary-color), #2980b9);
            border: none;
            border-radius: 50px;
            padding: 12px 30px;
            font-weight: 600;
            color: white;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(52, 152, 219, 0.3);
        }

        .btn-modern:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(52, 152, 219, 0.4);
            color: white;
        }

        .btn-outline-modern {
            border: 2px solid white;
            border-radius: 50px;
            padding: 10px 25px;
            font-weight: 600;
            color: white;
            background: transparent;
            transition: all 0.3s ease;
        }

        .btn-outline-modern:hover {
            background: white;
            color: var(--primary-color);
            transform: translateY(-2px);
        }

        .stats-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 15px;
            padding: 20px;
            text-align: center;
            margin-bottom: 20px;
        }

        .stats-number {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .stats-label {
            font-size: 0.9rem;
            opacity: 0.9;
        }

        .pengumuman-card {
            border: none;
            border-radius: 15px;
            margin-bottom: 20px;
            transition: all 0.3s ease;
            background: white;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .pengumuman-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .pengumuman-card .card-body {
            padding: 25px;
        }

        .pengumuman-title {
            color: var(--primary-color);
            font-weight: 700;
            font-size: 1.3rem;
            margin-bottom: 15px;
        }

        .pengumuman-meta {
            background: var(--light-color);
            padding: 15px;
            border-radius: 10px;
            margin-top: 15px;
        }

        .feature-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(45deg, var(--secondary-color), #2980b9);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            color: white;
            font-size: 1.5rem;
        }

        .footer {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            color: white;
            padding: 30px 0;
            margin-top: 50px;
            border-top: 1px solid rgba(255, 255, 255, 0.2);
        }

        .quick-actions {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin: 30px 0;
            flex-wrap: wrap;
        }

        /* TOMBOL PDF & HAPUS */
        .btn-success-modern {
            background: linear-gradient(45deg, #27ae60, #219653);
            border: none;
            border-radius: 8px;
            padding: 8px 15px;
            color: white;
            font-weight: 600;
            transition: all 0.3s ease;
            font-size: 0.875rem;
        }

        .btn-success-modern:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(39, 174, 96, 0.3);
            color: white;
        }

        .btn-danger-modern {
            background: linear-gradient(45deg, #e74c3c, #c0392b);
            border: none;
            border-radius: 8px;
            padding: 8px 15px;
            color: white;
            font-weight: 600;
            transition: all 0.3s ease;
            font-size: 0.875rem;
        }

        .btn-danger-modern:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(231, 76, 60, 0.3);
            color: white;
        }

        .action-buttons {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        @media (max-width: 768px) {
            .header-section h1 {
                font-size: 2rem;
            }
            
            .quick-actions {
                flex-direction: column;
                align-items: center;
            }
            
            .quick-actions .btn {
                width: 200px;
            }

            .pengumuman-meta {
                flex-direction: column;
                gap: 10px;
                align-items: flex-start;
            }

            .action-buttons {
                width: 100%;
                justify-content: flex-end;
            }
        }
    </style>
    <script>
    function confirmDelete() {
        return confirm('Yakin ingin menghapus pengumuman ini?');
    }
    </script>
</head>
<body>
    <!-- HEADER SECTION -->
    <div class="header-section">
        <div class="container">
            <h1><i class="fas fa-tree me-3"></i>Portal Informasi Lingkungan</h1>
            <p>Selamat datang di pusat informasi lingkungan Desa Tajur Halang</p>
        </div>
    </div>

    <!-- MAIN CONTENT -->
    <div class="container">
        <!-- QUICK ACTIONS -->
        <div class="quick-actions">
            <a href="buat_pengumuman.php" class="btn btn-modern">
                <i class="fas fa-plus me-2"></i>Buat Pengumuman Baru
            </a>
            <a href="history.php" class="btn btn-outline-modern">
                <i class="fas fa-history me-2"></i>Lihat History
            </a>
        </div>

        <!-- STATISTICS -->
        <div class="row mb-5">
            <div class="col-md-4">
                <div class="stats-card glass-card">
                    <div class="stats-number">
                        <?php
                        include 'koneksi.php';
                        $sql_count = "SELECT COUNT(*) as total FROM pengumuman";
                        $result_count = mysqli_query($koneksi, $sql_count);
                        $row_count = mysqli_fetch_assoc($result_count);
                        echo $row_count['total'];
                        ?>
                    </div>
                    <div class="stats-label">Total Pengumuman</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stats-card glass-card" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                    <div class="stats-number">
                        <?php
                        $sql_today = "SELECT COUNT(*) as today FROM pengumuman WHERE DATE(tanggal) = CURDATE()";
                        $result_today = mysqli_query($koneksi, $sql_today);
                        $row_today = mysqli_fetch_assoc($result_today);
                        echo $row_today['today'];
                        ?>
                    </div>
                    <div class="stats-label">Pengumuman Hari Ini</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stats-card glass-card" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                    <div class="stats-number">
                        <?php
                        $sql_month = "SELECT COUNT(*) as month FROM pengumuman WHERE MONTH(tanggal) = MONTH(CURDATE())";
                        $result_month = mysqli_query($koneksi, $sql_month);
                        $row_month = mysqli_fetch_assoc($result_month);
                        echo $row_month['month'];
                        ?>
                    </div>
                    <div class="stats-label">Pengumuman Bulan Ini</div>
                </div>
            </div>
        </div>

        <!-- PENGUMUMAN TERBARU -->
        <div class="glass-card p-4 mb-4">
            <h3 class="text-center mb-4" style="color: var(--primary-color);">
                <i class="fas fa-bullhorn me-2"></i>Pengumuman Terbaru
            </h3>
            
            <div id="daftar-pengumuman">
                <?php
                $sql = "SELECT * FROM pengumuman ORDER BY tanggal DESC LIMIT 3";
                $result = mysqli_query($koneksi, $sql);
                
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<div class="pengumuman-card">';
                        echo '<div class="card-body">';
                        echo '<h5 class="pengumuman-title"><i class="fas fa-newspaper me-2"></i>' . $row['judul'] . '</h5>';
                        echo '<p class="card-text">' . nl2br($row['isi']) . '</p>';
                        echo '<div class="pengumuman-meta d-flex justify-content-between align-items-center">';
                        echo '<small class="text-muted"><i class="fas fa-user me-1"></i>' . $row['penulis'] . 
                             ' | <i class="fas fa-clock me-1"></i>' . date('d-m-Y H:i', strtotime($row['tanggal'])) . '</small>';
                        
                        // TOMBOL AKSI (PDF + HAPUS) - SUDAH DIPERBAIKI
                        echo '<div class="action-buttons">';
                        echo '<a href="export_pdf_simple.php?id=' . $row['id'] . '" class="btn btn-success-modern" target="_blank">';
                        echo '<i class="fas fa-file-pdf me-1"></i>PDF</a>';
                        echo '<a href="hapus_pengumuman.php?id=' . $row['id'] . '" class="btn btn-danger-modern" onclick="return confirmDelete()">';
                        echo '<i class="fas fa-trash me-1"></i>Hapus</a>';
                        echo '</div>';
                        
                        echo '</div>';
                        echo '</div></div>';
                    }
                    
                    // TOMBOL LIHAT SEMUA
                    $sql_count = "SELECT COUNT(*) as total FROM pengumuman";
                    $result_count = mysqli_query($koneksi, $sql_count);
                    $row_count = mysqli_fetch_assoc($result_count);
                    
                    if ($row_count['total'] > 3) {
                        echo '<div class="text-center mt-4">';
                        echo '<a href="history.php" class="btn btn-modern">';
                        echo '<i class="fas fa-list me-2"></i>Lihat Semua Pengumuman (' . $row_count['total'] . ')</a>';
                        echo '</div>';
                    }
                    
                } else {
                    echo '<div class="text-center py-5">';
                    echo '<div class="feature-icon">';
                    echo '<i class="fas fa-inbox"></i>';
                    echo '</div>';
                    echo '<h4 style="color: var(--primary-color);">Belum ada pengumuman</h4>';
                    echo '<p class="text-muted">Silakan buat pengumuman pertama untuk memulai</p>';
                    echo '<a href="buat_pengumuman.php" class="btn btn-modern mt-3">';
                    echo '<i class="fas fa-plus me-2"></i>Buat Pengumuman Pertama</a>';
                    echo '</div>';
                }
                ?>
            </div>
        </div>
    </div>

    <!-- FOOTER -->
    <footer class="footer">
        <div class="container text-center">
            <p class="mb-0">&copy; 2025 Portal Informasi Lingkungan. Create by Mohamad Rizky Awaludin</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>