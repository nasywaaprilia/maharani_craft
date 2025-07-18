<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Maharani Batik n' Tenun</title>

    <!-- Bootstrap & Font Awesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('themes/plugins/fontawesome-free/css/all.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('themes/dist/css/adminlte.min.css'); ?>">

    <style>
        body {
            background: #f4f9fb;
            font-family: 'Segoe UI', sans-serif;
        }

        .dashboard-header {
            background: linear-gradient(120deg, #007bff, #00c3ff);
            padding: 2rem;
            color: white;
            border-radius: 0 0 20px 20px;
            text-align: center;
            margin-bottom: 2rem;
        }

        .section-title {
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .feature-card {
            border: none;
            border-radius: 12px;
            transition: 0.3s ease;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.07);
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 25px rgba(0, 0, 0, 0.1);
        }

        .feature-card .btn {
            width: 100%;
            margin-top: 10px;
        }

        .product-card {
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
        }

        .product-card:hover {
            transform: scale(1.02);
        }

        .product-image {
            height: 220px;
            object-fit: cover;
            width: 100%;
        }

        .product-body {
            padding: 1rem;
            background: white;
        }

        .product-title {
            font-weight: 600;
            font-size: 1.1rem;
        }

        .product-desc {
            font-size: 0.95rem;
            color: #666;
        }


        @media (max-width: 768px) {
            .content-wrapper {
                margin-left: 0 !important;
            }
        }
    </style>
</head>

<body class="sidebar-mini layout-fixed hold-transition">
<div class="wrapper">

    <?= view('_partials/header'); ?>
    <?= view('_partials/sidebar'); ?>

    <div class="content-wrapper" style="min-height: 100vh;">
        <section class="content pt-3 px-3">
            <div class="dashboard-header">
                <h3>Manajemen Gudang, Produksi, dan Penjualan</h3>
            </div>

            <div class="container-fluid">

                <!-- Section Fitur -->
                <div class="row mb-3">
                    <!-- Gudang Card -->
<div class="col-md-4">
    <div class="card feature-card">
        <div class="card-body text-center">
            <i class="fas fa-warehouse fa-3x mb-3 text-primary"></i>
            <h5 class="section-title">Gudang</h5>
            <a href="<?= base_url('supplier'); ?>"
               class="btn btn-outline-primary <?= session()->get('level') != 'Gudang' ? 'disabled' : '' ?>"
               onclick="<?= session()->get('level') != 'Gudang' ? 'alert(\'Anda tidak memiliki hak akses ke Gudang!\'); return false;' : '' ?>">
                Data Supplier
            </a>
            <a href="<?= base_url('bahanbakumasuk'); ?>"
               class="btn btn-outline-primary <?= session()->get('level') != 'Gudang' ? 'disabled' : '' ?>"
               onclick="<?= session()->get('level') != 'Gudang' ? 'alert(\'Anda tidak memiliki hak akses ke Gudang!\'); return false;' : '' ?>">
                Bahan Baku Masuk
            </a>
        </div>
    </div>
</div>

                    <div class="col-md-4">
                        <div class="card feature-card">
                            <div class="card-body text-center">
                                <i class="fas fa-industry fa-3x mb-3 text-success"></i>
                                <h5 class="section-title">Produksi</h5>
                                <a href="<?= base_url('hasilproduksi'); ?>"
   class="btn btn-outline-success <?= session()->get('level') != 'Produksi' ? 'disabled' : '' ?>"
   onclick="<?= session()->get('level') != 'Produksi' ? 'alert(\'Tidak ada akses Produksi\'); return false;' : '' ?>">
    Hasil Produksi
</a>
<a href="<?= base_url('bahankeluar'); ?>"
   class="btn btn-outline-success <?= session()->get('level') != 'Produksi' ? 'disabled' : '' ?>"
   onclick="<?= session()->get('level') != 'Produksi' ? 'alert(\'Tidak ada akses Produksi\'); return false;' : '' ?>">
    Bahan Baku Keluar
</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card feature-card">
                            <div class="card-body text-center">
                                <i class="fas fa-shopping-cart fa-3x mb-3 text-warning"></i>
                                <h5 class="section-title">Penjualan</h5>
                                <a href="<?= base_url('listpo'); ?>"
   class="btn btn-outline-warning <?= session()->get('level') != 'Penjualan' ? 'disabled' : '' ?>"
   onclick="<?= session()->get('level') != 'Penjualan' ? 'alert(\'Tidak ada akses Penjualan\'); return false;' : '' ?>">
    List PO
</a>
<a href="<?= base_url('penjualan'); ?>"
   class="btn btn-outline-warning <?= session()->get('level') != 'Penjualan' ? 'disabled' : '' ?>"
   onclick="<?= session()->get('level') != 'Penjualan' ? 'alert(\'Tidak ada akses Penjualan\'); return false;' : '' ?>">
    Transaksi Penjualan
</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Produk -->
                <h4 class="mb-4">Produk Unggulan</h4>
                <div class="row">
                    <?php
                    $produk = [
                        ['img' => 'produk1.jpg', 'nama' => 'Sarung Bantal Floral', 'desc' => 'Motif bunga kuning yang cerah dan desain yang memberi kesan hangat dan nyaman. Cocok untuk ruang tamu.'],
                        ['img' => 'produk2.jpg', 'nama' => 'Sajadah Pesona Nusa', 'desc' => 'Perpaduan motif dan desain modern memberikan rasa nyaman setiap sujud dengan nuansa etnik yang anggun.'],
                        ['img' => 'produk3.jpg', 'nama' => 'Lavender Bloom Cushion', 'desc' => 'Sarung bantal dengan motif bunga yang anggun dan menawan memberikan nuansa elegan.'],
                        ['img' => 'produk4.jpg', 'nama' => 'Rose Patch Harmony', 'desc' => 'Bad Cover dengan perpaduan motif patchwork dan corak bunga mawar memberikan kesan hangat.']
                    ];

                    foreach ($produk as $p) :
                    ?>
                        <div class="col-lg-3 col-md-6 mb-4">
                            <div class="product-card">
                                <img src="<?= base_url('img/' . $p['img']); ?>" class="product-image" alt="<?= $p['nama']; ?>">
                                <div class="product-body text-center">
                                    <div class="product-title"><?= $p['nama']; ?></div>
                                    <p class="product-desc"><?= $p['desc']; ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

            </div>
        </section>
    </div>

    <?= view('_partials/footer'); ?>
</div>

<!-- Scripts -->
<script src="<?= base_url('themes/plugins/jquery/jquery.min.js'); ?>"></script>
<script src="<?= base_url('themes/plugins/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
<script src="<?= base_url('themes/dist/js/adminlte.min.js'); ?>"></script>

</body>
</html>
