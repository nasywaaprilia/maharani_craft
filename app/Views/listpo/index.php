<?= view('_partials/header'); ?>
<?= view('_partials/sidebar'); ?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <h1>Data List PO</h1>
        </div>
    </section>

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

            <!-- Filter -->
            <form method="get" action="<?= base_url('listpo') ?>" class="mb-3">
                <div class="d-flex justify-content-between flex-wrap">
                    <div class="flex-fill mr-2 mb-2">
                        <input type="text" name="keyword" class="form-control" placeholder="Cari Nama Customer atau ID PO"
                               value="<?= esc($keyword ?? '') ?>">
                    </div>
                    <div class="col-md-4 mb-2 text-right">
                        <button type="submit" class="btn btn-primary">Filter</button>
                        <a href="<?= base_url('listpo') ?>" class="btn btn-secondary">Reset</a>
                        <a href="<?= base_url('listpo/create') ?>" class="btn btn-success">+ Tambah PO</a>
                    </div>
                </div>
            </form>

            <!-- Tabel List PO -->
            <div class="card">
                <div class="card-body table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>ID PO</th>
                                <th>Nama Customer</th>
                                <th>Tanggal</th>
                                <th>Nama Produk</th>
                                <th>Jumlah</th>
                                <th>No HP</th>
                                <th style="width: 15%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($listpo)): ?>
                                <tr><td colspan="8" class="text-center">Tidak ada data</td></tr>
                            <?php else: ?>
                                <?php foreach ($listpo as $i => $row): ?>
                                    <tr>
                                        <td><?= ($nomor ?? 0) + $i + 1 ?></td>
                                        <td><?= esc($row['id_po']) ?></td>
                                        <td><?= esc($row['nama_customer']) ?></td>
                                        <td><?= esc($row['tanggal']) ?></td>
                                        <td><?= esc($row['nama_produk']) ?></td>
                                        <td><?= esc($row['jumlah']) ?></td>
                                        <td><?= esc($row['no_hp']) ?></td>
                                        <td>
                                            <a href="<?= base_url('listpo/edit/' . $row['id_po']) ?>" class="btn btn-sm btn-warning">Edit</a>
                                            <a href="<?= base_url('listpo/delete/' . $row['id_po']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus data ini?')">Hapus</a>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            <?php endif ?>
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    <div class="mt-3">
                        <?= $pager->links('listpo', 'bootstrap_pagination') ?>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>

<?= view('_partials/footer'); ?>
