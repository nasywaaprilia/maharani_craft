<?= view('_partials/header'); ?>
<?= view('_partials/sidebar'); ?>

<div class="content-wrapper">
    <!-- Header -->
    <section class="content-header">
        <div class="container-fluid">
            <h1>Data Hasil Produksi</h1>
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
            <form method="get" action="<?= base_url('hasilproduksi') ?>" class="mb-3">
                <div class="row">
                    <div class="col-md-4 mb-2">
                        <input type="text" name="keyword" class="form-control" placeholder="Cari nama produk / keterangan" value="<?= esc($keyword ?? '') ?>">
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
                        <a href="<?= base_url('hasilproduksi') ?>" class="btn btn-secondary">Reset</a>
                        <a href="<?= base_url('hasilproduksi/create') ?>" class="btn btn-success">+ Tambah Produksi</a>
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
                                <th>ID Produksi</th>
                                <th>Tanggal</th>
                                <th>Produk (Stok + Satuan)</th>
                                <th>Keterangan</th>
                                <th style="width: 18%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($hasilproduksi)): ?>
                                <tr>
                                    <td colspan="6" class="text-center">Tidak ada data</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($hasilproduksi as $i => $row): ?>
                                    <tr>
                                        <td><?= ($nomor ?? 0) + $i + 1 ?></td>
                                        <td><?= esc($row['id_produksi']) ?></td>
                                        <td><?= esc($row['tanggal_produksi']) ?></td>
                                        <td>
                                            <ul class="mb-0 pl-3">
                                                <?php foreach ($detail_produksi as $detail): ?>
                                                    <?php if ($detail['id_produksi'] == $row['id_produksi']): ?>
                                                        <li><?= esc($detail['nama_produk']) ?> (<?= esc($detail['stok_produk']) ?> <?= esc($detail['satuan']) ?>)</li>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </ul>
                                        </td>
                                        <td><?= esc($row['keterangan']) ?></td>
                                        <td>
                                            <a href="<?= base_url('hasilproduksi/edit/' . $row['id_produksi']) ?>" class="btn btn-sm btn-warning">Edit</a>
                                            <a href="<?= base_url('hasilproduksi/delete/' . $row['id_produksi']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    <div class="mt-3">
                        <?= $pager->links('hasilproduksi', 'bootstrap_pagination') ?>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>

<?= view('_partials/footer'); ?>
