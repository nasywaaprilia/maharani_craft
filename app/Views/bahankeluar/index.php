<?= view('_partials/header'); ?>
<?= view('_partials/sidebar'); ?>

<div class="content-wrapper">
    <!-- Header -->
    <section class="content-header">
        <div class="container-fluid">
            <h1>Data Bahan Keluar</h1>
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
            <form method="get" action="<?= base_url('bahankeluar') ?>" class="mb-3">
                <div class="row">
                    <div class="col-md-4 mb-2">
                        <input type="text" name="keyword" class="form-control" placeholder="Cari ID / keterangan / tanggal"
                            value="<?= esc($keyword ?? '') ?>">
                    </div>
                    <div class="col-md-4 mb-2">
                        <select name="produksi" class="form-control">
                            <option value="">Pilih ID Produksi</option>
                            <?php foreach ($produksi_list as $id => $label): ?>
                                <option value="<?= esc($id) ?>" <?= ($produksi ?? '') == $id ? 'selected' : '' ?>>
                                    <?= esc($label) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-4 mb-2 text-right">
                        <button type="submit" class="btn btn-primary">Filter</button>
                        <a href="<?= base_url('bahankeluar') ?>" class="btn btn-secondary">Reset</a>
                        <a href="<?= base_url('bahankeluar/create') ?>" class="btn btn-success">+ Tambah Bahan Keluar</a>
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
                                <th>ID Bahan Keluar</th>
                                <th>Tanggal</th>
                                <th>ID Produksi</th>
                                <th>Bahan (Jumlah + Satuan)</th>
                                <th style="width: 18%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($bahan_keluar)): ?>
                                <tr>
                                    <td colspan="6" class="text-center">Tidak ada data</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($bahan_keluar as $i => $bk): ?>
                                    <tr>
                                        <td><?= ($nomor ?? 0) + $i + 1 ?></td>
                                        <td><?= esc($bk['id_bahankeluar']) ?></td>
                                        <td><?= esc($bk['tanggal']) ?></td>
                                        <td><?= esc($bk['id_produksi']) ?></td>
                                        <td>
                                            <ul class="mb-0 pl-3">
                                                <?php foreach ($detail_bahankeluar as $detail): ?>
                                                    <?php if ($detail['id_bahankeluar'] == $bk['id_bahankeluar']): ?>
                                                        <li><?= esc($detail['nama_bahan']) ?> (<?= esc($detail['jumlah']) ?> <?= esc($detail['satuan']) ?>)</li>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </ul>
                                        </td>
                                        <td>
                                            <a href="<?= base_url('bahankeluar/edit/' . $bk['id_bahankeluar']) ?>" class="btn btn-sm btn-warning">Edit</a>
                                            <a href="<?= base_url('bahankeluar/delete/' . $bk['id_bahankeluar']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    <div class="mt-3">
                        <?= $pager->links('bahankeluar', 'bootstrap_pagination') ?>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>

<?= view('_partials/footer'); ?>
