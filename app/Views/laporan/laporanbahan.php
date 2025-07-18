<?= view('_partials/header'); ?>
<?= view('_partials/sidebar'); ?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <h1 class="text-dark">Laporan Bahan Baku</h1>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <form method="get" action="<?= base_url('laporan/laporanBahan'); ?>" class="row mb-3">
                <div class="col-md-3">
                    <select name="bulan" class="form-control">
                        <option value="">Semua Bulan</option>
                        <?php for ($m = 1; $m <= 12; $m++): ?>
                            <option value="<?= $m ?>" <?= ($m == ($bulan ?? '')) ? 'selected' : '' ?>>
                                <?= date('F', mktime(0, 0, 0, $m, 1)); ?>
                            </option>
                        <?php endfor; ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="tahun" class="form-control">
                        <option value="">Semua Tahun</option>
                        <?php for ($y = date('Y'); $y >= date('Y') - 10; $y--): ?>
                            <option value="<?= $y ?>" <?= ($y == ($tahun ?? '')) ? 'selected' : '' ?>>
                                <?= $y ?>
                            </option>
                        <?php endfor; ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </form>

            <div class="card">
                <div class="card-header bg-success text-white">Laporan Bahan Baku</div>
                <div class="card-body p-0">
                    <table class="table table-bordered table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Nama Bahan</th>
                                <th>Jumlah Masuk</th>
                                <th>Jumlah Keluar</th>
                                <th>Stok Tersedia</th>
                                <th>Satuan</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if (!empty($laporan)): ?>
                            <?php $no = 1; foreach ($laporan as $row): ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= esc($row->nama_bahan); ?></td>
                                    <td><?= esc($row->stok_awal); ?></td>
                                    <td><?= esc($row->jumlah_keluar); ?></td>
                                    <td><strong><?= esc($row->stok_tersedia); ?></strong></td>
                                    <td><?= esc($row->satuan); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center">Tidak ada data</td>
                            </tr>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-3">
                <button onclick="window.print()" class="btn btn-dark"><i class="fa fa-print"></i> Cetak</button>
            </div>
        </div>
    </section>
</div>

<?= view('_partials/footer'); ?>
