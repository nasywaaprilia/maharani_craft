<?= view('_partials/header'); ?>
<?= view('_partials/sidebar'); ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <h1 class="m-0 text-dark">Bahan Baku Masuk</h1>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">

            <!-- Flash Message -->
            <?php if (session()->getFlashdata('success')) : ?>
                <div class="alert alert-success"><?= session()->getFlashdata('success'); ?></div>
            <?php elseif (session()->getFlashdata('info')) : ?>
                <div class="alert alert-info"><?= session()->getFlashdata('info'); ?></div>
            <?php elseif (session()->getFlashdata('warning')) : ?>
                <div class="alert alert-warning"><?= session()->getFlashdata('warning'); ?></div>
            <?php endif; ?>

            <!-- Filter -->
            <form method="get" action="<?= base_url('bahanbakumasuk') ?>" class="mb-3">
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <input type="text" name="keyword" class="form-control" placeholder="Cari Id / Nama / Supplier" value="<?= esc($keyword ?? '') ?>">
                    </div>
                    <div class="col-md-6 mb-2 text-right">
                        <button type="submit" class="btn btn-primary">Filter</button>
                        <a href="<?= base_url('bahanbakumasuk') ?>" class="btn btn-secondary">Reset</a>
                        <a href="<?= base_url('bahanbakumasuk/create') ?>" class="btn btn-success">+ Tambah</a>
                    </div>
                </div>
            </form>

            <!-- Data Table -->
            <div class="card">
                <div class="card-body table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th>No</th>
                                <th>Id Bahan</th>
                                <th>Nama Bahan</th>
                                <th>Satuan</th>
                                <th>Stok</th>
                                <th>Id Supplier</th>
                                <th>Tanggal Masuk</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($bahan_baku)) : ?>
                                <tr>
                                    <td colspan="8" class="text-center">Tidak ada data</td>
                                </tr>
                            <?php else : ?>
                                <?php foreach ($bahan_baku as $i => $row) : ?>
                                    <tr>
                                        <td><?= ($nomor ?? 0) + $i + 1; ?></td>
                                        <td><?= esc($row['id_bahan']); ?></td>
                                        <td><?= esc($row['nama_bahan']); ?></td>
                                        <td><?= esc($row['satuan']); ?></td>
                                        <td><?= esc($row['stok']); ?></td>
                                        <td><?= esc($row['id_supplier']); ?></td>
                                        <td><?= \IntlDateFormatter::formatObject(new DateTime($row['tanggal_masuk']), 'd MMMM yyyy', 'id_ID'); ?></td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="<?= base_url('bahanbakumasuk/edit/' . $row['id_bahan']); ?>" class="btn btn-sm btn-success"><i class="fa fa-edit"></i></a>
                                                <a href="<?= base_url('bahanbakumasuk/delete/' . $row['id_bahan']); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus bahan baku ini?');"><i class="fa fa-trash-alt"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    <div class="mt-3">
                        <?= $pager->links('bahanbakumasuk', 'bootstrap_pagination') ?>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

<?= view('_partials/footer'); ?>
