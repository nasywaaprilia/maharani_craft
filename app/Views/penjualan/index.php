<?= view('_partials/header'); ?>
<?= view('_partials/sidebar'); ?>

<div class="content-wrapper">
    <!-- Header -->
    <section class="content-header">
        <div class="container-fluid">
            <h1>Data Penjualan</h1>
        </div>
    </section>

    <!-- Main Content -->
    <section class="content">
        <div class="container-fluid">

            <!-- Flash Messages -->
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
            <?php elseif (session()->getFlashdata('info')): ?>
                <div class="alert alert-info"><?= session()->getFlashdata('info') ?></div>
            <?php elseif (session()->getFlashdata('warning')): ?>
                <div class="alert alert-warning"><?= session()->getFlashdata('warning') ?></div>
            <?php endif; ?>

            <!-- Filter Form -->
            <form method="get" action="<?= base_url('penjualan') ?>" class="mb-3">
                <div class="row">
                    <div class="col-md-4 mb-2">
                        <input type="text" name="keyword" class="form-control" placeholder="Cari ID penjualan / tanggal" value="<?= esc($keyword ?? '') ?>">
                    </div>
                    <div class="col-md-4 mb-2">
                        <select name="produk" class="form-control">
                            <?php foreach ($produk_list as $id => $nama): ?>
                                <option value="<?= esc($id) ?>" <?= ($produk ?? '') == $id ? 'selected' : '' ?>>
                                    <?= esc($nama) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-4 mb-2 text-right">
                        <button type="submit" class="btn btn-primary">Filter</button>
                        <a href="<?= base_url('penjualan') ?>" class="btn btn-secondary">Reset</a>
                        <a href="<?= base_url('penjualan/create') ?>" class="btn btn-success">+ Tambah Penjualan</a>
                    </div>
                </div>
            </form>

            <!-- Data Table -->
            <div class="card">
                <div class="card-body table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th style="width: 5%;">#</th>
                                <th>ID Penjualan</th>
                                <th>Tanggal</th>
                                <th>Produk (Jumlah + Satuan)</th>
                                <th style="width: 18%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($penjualan)): ?>
                                <tr>
                                    <td colspan="5" class="text-center">Tidak ada data</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($penjualan as $i => $row): ?>
                                    <tr>
                                        <td><?= ($nomor ?? 0) + $i + 1 ?></td>
                                        <td><?= esc($row['id_penjualan']) ?></td>
                                        <td><?= esc($row['tanggal']) ?></td>
                                        <td>
                                            <ul class="mb-0 pl-3">
                                                <?php foreach ($detail_penjualan as $detail): ?>
                                                    <?php if ($detail['id_penjualan'] == $row['id_penjualan']): ?>
                                                        <li><?= esc($detail['nama_produk']) ?> (<?= esc($detail['jumlah']) ?> <?= esc($detail['satuan']) ?>)</li>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </ul>
                                        </td>
                                        <td>
                                            <a href="<?= base_url('penjualan/edit/' . $row['id_penjualan']) ?>" class="btn btn-sm btn-warning">Edit</a>
                                            <a href="<?= base_url('penjualan/delete/' . $row['id_penjualan']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    <div class="mt-3">
                        <?= $pager->links('penjualan', 'bootstrap_pagination') ?>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>

<?= view('_partials/footer'); ?>
