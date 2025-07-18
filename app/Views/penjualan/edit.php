<?= view('_partials/header'); ?>
<?= view('_partials/sidebar'); ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <h1>Edit Penjualan</h1>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">

            <?php if (session()->getFlashdata('errors')): ?>
                <div class="alert alert-danger">
                    <ul>
                        <?php foreach (session()->getFlashdata('errors') as $error): ?>
                            <li><?= esc($error); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Form Edit Penjualan</h3>
                </div>

                <?= form_open('penjualan/update'); ?>
                <div class="card-body">
                    <?= form_hidden('id_penjualan', $penjualan['id_penjualan']); ?>

                    <div class="form-group">
                        <label>Tanggal Penjualan</label>
                        <input type="date" name="tanggal" class="form-control" value="<?= esc($penjualan['tanggal']) ?>" required>
                    </div>

                    <hr>
                    <h5>Detail Produk</h5>

                    <?php foreach ($detail as $i => $item): ?>
                        <div class="row mb-3 produk-row">
                            <div class="col-md-4">
                                <label>Produk</label>
                                <select name="id_produk[]" class="form-control produk-select" data-index="<?= $i ?>" required>
                                    <?php foreach ($produk_list as $p): ?>
                                        <option value="<?= $p['id_produk'] ?>" 
                                            data-satuan="<?= esc($p['satuan']) ?>"
                                            <?= $p['id_produk'] == $item['id_produk'] ? 'selected' : '' ?>>
                                            <?= esc($p['nama_produk']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label>Jumlah</label>
                                <input type="number" name="jumlah[]" class="form-control" value="<?= esc($item['jumlah']) ?>" required>
                            </div>

                            <div class="col-md-3">
                                <label>Satuan</label>
                                <input type="text" class="form-control satuan-display" value="<?= esc($item['satuan']) ?>" readonly>
                                <input type="hidden" name="satuan[]" value="<?= esc($item['satuan']) ?>" class="satuan-hidden">
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="card-footer">
                    <a href="<?= base_url('penjualan'); ?>" class="btn btn-outline-info float-right">Kembali</a>
                    <button type="submit" class="btn btn-primary float-right mr-2">Update</button>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>

<?= view('_partials/footer'); ?>

<script>
    document.querySelectorAll('.produk-select').forEach(select => {
        select.addEventListener('change', function () {
            const satuan = this.options[this.selectedIndex].getAttribute('data-satuan');
            const row = this.closest('.produk-row');
            row.querySelector('.satuan-display').value = satuan;
            row.querySelector('.satuan-hidden').value = satuan;
        });
    });
</script>
