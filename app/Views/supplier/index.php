<?= view('_partials/header'); ?>
<?= view('_partials/sidebar'); ?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <h1>Data Supplier</h1>
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
            <form method="get" action="<?= base_url('supplier') ?>" class="mb-3">
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <input type="text" name="keyword" class="form-control" placeholder="Cari Nama Supplier"
                               value="<?= esc($keyword ?? '') ?>">
                    </div>
                    <div class="col-md-6 mb-2 text-right">
                        <button type="submit" class="btn btn-primary">Filter</button>
                        <a href="<?= base_url('supplier') ?>" class="btn btn-secondary">Reset</a>
                        <a href="<?= base_url('supplier/create') ?>" class="btn btn-success">+ Tambah Supplier</a>
                    </div>
                </div>
            </form>

            <div class="card">
                <div class="card-body table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th style="width: 5%;">#</th>
                                <th>ID Supplier</th>
                                <th>Nama Supplier</th>
                                <th>Alamat</th>
                                <th>No HP</th>
                                <th style="width: 15%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($supplier)): ?>
                                <tr><td colspan="6" class="text-center">Tidak ada data</td></tr>
                            <?php else: ?>
                                <?php foreach ($supplier as $i => $row): ?>
                                    <tr>
                                        <td><?= ($nomor ?? 0) + $i + 1 ?></td>
                                        <td><?= esc($row['id_supplier']) ?></td>
                                        <td><?= esc($row['nama_supplier']) ?></td>
                                        <td><?= esc($row['alamat']) ?></td>
                                        <td><?= esc($row['no_hp']) ?></td>
                                        <td>
                                            <a href="<?= base_url('supplier/edit/' . $row['id_supplier']) ?>" class="btn btn-sm btn-warning">Edit</a>
                                            <a href="<?= base_url('supplier/delete/' . $row['id_supplier']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus supplier ini?')">Hapus</a>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            <?php endif ?>
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    <div class="mt-3">
                        <?= $pager->links('supplier', 'bootstrap_pagination') ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?= view('_partials/footer'); ?>
