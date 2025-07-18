<?= view('_partials/header'); ?>
<?= view('_partials/sidebar'); ?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <h1 class="text-dark">Laporan</h1>
            <p class="text-muted">Silakan pilih jenis laporan yang ingin dilihat</p>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">

                <?php
                $laporans = [
                    ['title' => 'Laporan Produk', 'color' => 'info', 'icon' => 'fa-cubes', 'url' => 'laporan/produk'],
                    ['title' => 'Laporan Bahan Baku', 'color' => 'success', 'icon' => 'fa-boxes', 'url' => 'laporan/laporanbahan'],
                ];
                ?>

                <?php foreach ($laporans as $laporan) : ?>
                    <div class="col-md-6 mb-6">
                        <a href="<?= base_url($laporan['url']); ?>" class="text-decoration-none">
                            <div class="card text-white bg-<?= $laporan['color']; ?> shadow h-100">
                                <div class="card-body d-flex align-items-center">
                                    <i class="fas <?= $laporan['icon']; ?> fa-2x mr-3"></i>
                                    <div>
                                        <h5 class="card-title mb-0"><?= $laporan['title']; ?></h5>
                                    </div>
                                </div>
                                <div class="card-footer text-white-50 small">
                                    Klik untuk lihat detail
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>

            </div>
        </div>
    </section>
</div>

<?= view('_partials/footer'); ?>
