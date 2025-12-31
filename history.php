<?php
include 'koneksi.php';

// KONFIGURASI PAGINATION
$limit = 5; // Jumlah data per halaman
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// HITUNG TOTAL DATA
$sql_count = "SELECT COUNT(*) as total FROM pengumuman";
$result_count = mysqli_query($koneksi, $sql_count);
$row_count = mysqli_fetch_assoc($result_count);
$total_data = $row_count['total'];
$total_pages = ceil($total_data / $limit);

// AMBIL DATA DENGAN PAGINATION
$sql = "SELECT * FROM pengumuman ORDER BY tanggal DESC LIMIT $offset, $limit";
$result = mysqli_query($koneksi, $sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History Pengumuman - Portal Lingkungan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --accent-color: #e74c3c;
            --light-color: #ecf0f1;
            --dark-color: #2c3e50;
            --success-color: #27ae60;
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
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 10px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
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

        .history-card {
            border: none;
            border-radius: 15px;
            margin-bottom: 25px;
            transition: all 0.3s ease;
            background: white;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .history-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .history-card .card-header {
            background: linear-gradient(135deg, var(--primary-color), #34495e);
            color: white;
            border-bottom: none;
            padding: 20px;
        }

        .history-card .card-body {
            padding: 25px;
        }

        .history-title {
            font-weight: 700;
            font-size: 1.3rem;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .history-content {
            color: #555;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .history-meta {
            background: var(--light-color);
            padding: 15px;
            border-radius: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 10px;
        }

        .meta-info {
            display: flex;
            align-items: center;
            gap: 15px;
            flex-wrap: wrap;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 5px;
            color: #666;
            font-size: 0.9rem;
        }

        .pagination-modern .page-link {
            border: none;
            border-radius: 10px;
            margin: 0 5px;
            color: var(--primary-color);
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .pagination-modern .page-item.active .page-link {
            background: linear-gradient(45deg, var(--secondary-color), #2980b9);
            color: white;
        }

        .pagination-modern .page-link:hover {
            background: var(--light-color);
            transform: translateY(-2px);
        }

        .stats-badge {
            background: linear-gradient(45deg, #e74c3c, #c0392b);
            color: white;
            padding: 8px 15px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #666;
        }

        .empty-icon {
            font-size: 4rem;
            color: #bdc3c7;
            margin-bottom: 20px;
        }

        .footer {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            color: white;
            padding: 30px 0;
            margin-top: 50px;
            border-top: 1px solid rgba(255, 255, 255, 0.2);
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
            
            .history-title {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }
            
            .meta-info {
                flex-direction: column;
                align-items: flex-start;
                gap: 8px;
            }
            
            .action-buttons {
                width: 100%;
                justify-content: flex-end;
            }

            .history-meta {
                flex-direction: column;
                gap: 15px;
                align-items: flex-start;
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
            <h1><i class="fas fa-history me-3"></i>History Pengumuman</h1>
            <p class="lead">Arsip lengkap semua pengumuman lingkungan</p>
        </div>
    </div>

    <!-- MAIN CONTENT -->
    <div class="container">
        <!-- HEADER CARD -->
        <div class="glass-card p-4 mb-4">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="d-flex align-items-center gap-3">
                        <div class="stats-badge">
                            <i class="fas fa-newspaper me-2"></i>
                            <?= $total_data ?> Pengumuman
                        </div>
                        <div class="text-muted">
                            Halaman <?= $page ?> dari <?= $total_pages ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 text-md-end">
                    <div class="action-buttons justify-content-md-end">
                        <a href="buat_pengumuman.php" class="btn btn-modern">
                            <i class="fas fa-plus me-2"></i>Buat Baru
                        </a>
                        <a href="index.php" class="btn btn-outline-modern">
                            <i class="fas fa-home me-2"></i>Beranda
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- DAFTAR PENGUMUMAN -->
        <div id="daftar-pengumuman">
            <?php if (mysqli_num_rows($result) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <div class="history-card">
                        <div class="card-header">
                            <div class="history-title">
                                <span><i class="fas fa-bullhorn me-2"></i><?= $row['judul'] ?></span>
                                <div class="action-buttons">
                                    <!-- TOMBOL PDF - SUDAH DIPERBAIKI -->
                                    <a href="export_pdf_simple.php?id=<?= $row['id'] ?>" 
                                       class="btn btn-success-modern" 
                                       target="_blank">
                                        <i class="fas fa-file-pdf me-1"></i>PDF
                                    </a>
                                    <a href="hapus_pengumuman.php?id=<?= $row['id'] ?>" 
                                       class="btn btn-danger-modern" 
                                       onclick="return confirmDelete()">
                                        <i class="fas fa-trash me-1"></i>Hapus
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="history-content">
                                <?= nl2br($row['isi']) ?>
                            </div>
                            <div class="history-meta">
                                <div class="meta-info">
                                    <div class="meta-item">
                                        <i class="fas fa-user text-primary"></i>
                                        <strong>Penulis:</strong> <?= $row['penulis'] ?>
                                    </div>
                                    <div class="meta-item">
                                        <i class="fas fa-clock text-success"></i>
                                        <strong>Dibuat:</strong> <?= date('d-m-Y H:i', strtotime($row['tanggal'])) ?>
                                    </div>
                                    <div class="meta-item">
                                        <i class="fas fa-calendar text-info"></i>
                                        <strong>Hari:</strong> <?= date('l', strtotime($row['tanggal'])) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="glass-card">
                    <div class="empty-state">
                        <div class="empty-icon">
                            <i class="fas fa-inbox"></i>
                        </div>
                        <h3 style="color: var(--primary-color);">Belum Ada Pengumuman</h3>
                        <p class="text-muted mb-4">Mulai buat pengumuman pertama untuk mengisi history</p>
                        <a href="buat_pengumuman.php" class="btn btn-modern">
                            <i class="fas fa-plus me-2"></i>Buat Pengumuman Pertama
                        </a>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- PAGINATION -->
        <?php if ($total_pages > 1): ?>
        <div class="glass-card p-4 mt-4">
            <nav aria-label="Page navigation">
                <ul class="pagination pagination-modern justify-content-center">
                    <!-- Tombol Previous -->
                    <?php if ($page > 1): ?>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?= $page - 1 ?>" aria-label="Previous">
                                <i class="fas fa-chevron-left me-1"></i> Sebelumnya
                            </a>
                        </li>
                    <?php endif; ?>

                    <!-- Nomor Halaman -->
                    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                        <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                            <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                        </li>
                    <?php endfor; ?>

                    <!-- Tombol Next -->
                    <?php if ($page < $total_pages): ?>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?= $page + 1 ?>" aria-label="Next">
                                Selanjutnya <i class="fas fa-chevron-right ms-1"></i>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>
            
            <!-- Info Pagination -->
            <div class="text-center mt-3">
                <small class="text-muted">
                    Menampilkan <?= min($limit, mysqli_num_rows($result)) ?> dari <?= $total_data ?> pengumuman
                </small>
            </div>
        </div>
        <?php endif; ?>

        <!-- BACK TO TOP -->
        <div class="text-center mt-4">
            <a href="index.php" class="btn btn-outline-modern">
                <i class="fas fa-arrow-left me-2"></i>Kembali ke Beranda
            </a>
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