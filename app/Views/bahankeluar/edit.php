<?= view('_partials/header'); ?>
<?= view('_partials/sidebar'); ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <h1>Edit Bahan Baku Keluar</h1>
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
                    <h3 class="card-title">Form Edit Bahan Baku Keluar</h3>
                </div>

                <?= form_open('bahankeluar/update'); ?>
                <div class="card-body">
                    <?= form_hidden('id_bahankeluar', $bahankeluar['id_bahankeluar']); ?>

                    <div class="form-group">
                        <label>ID Produksi</label>
                        <select name="id_produksi" class="form-control" required>
                            <option value="">Pilih ID Produksi</option>
                            <?php foreach ($produksi_list as $p): ?>
                                <option value="<?= $p['id_produksi']; ?>" <?= $p['id_produksi'] == $bahankeluar['id_produksi'] ? 'selected' : ''; ?>>
                                    <?= esc($p['id_produksi']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Tanggal</label>
                        <input type="date" name="tanggal" class="form-control" value="<?= esc($bahankeluar['tanggal']); ?>" required>
                    </div>

                    <hr>
                    <h5>Detail Bahan Keluar</h5>

                    <?php foreach ($detail as $i => $item): ?>
                        <div class="row mb-3 bahan-row">
                            <div class="col-md-4">
                                <label>Bahan Baku</label>
                                <select name="id_bahan[]" class="form-control bahan-select" data-index="<?= $i ?>" required>
                                    <?php foreach ($bahan_list as $b): ?>
                                        <option value="<?= $b['id_bahan']; ?>"
                                            data-satuan="<?= esc($b['satuan'] ?? '') ?>"
                                            <?= $b['id_bahan'] == $item['id_bahan'] ? 'selected' : '' ?>>
                                            <?= esc($b['nama_bahan']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label>Jumlah</label>
                                <input type="number" name="jumlah[]" class="form-control" value="<?= esc($item['jumlah']); ?>" required>
                            </div>

                            <div class="col-md-3">
                                <label>Satuan</label>
                                <input type="text" class="form-control satuan-display" value="<?= esc($item['satuan']); ?>" readonly>
                                <input type="hidden" name="satuan[]" class="satuan-hidden" value="<?= esc($item['satuan']); ?>">
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="card-footer">
                    <a href="<?= base_url('bahankeluar'); ?>" class="btn btn-outline-info float-right">Kembali</a>
                    <button type="submit" class="btn btn-primary float-right mr-2">Update</button>
                </div>
                <?= form_close(); ?>
            </div>

        </div>
    </div>
</div>

<?= view('_partials/footer'); ?>

<!-- Script untuk mengisi otomatis satuan -->
<script>
    document.querySelectorAll('.bahan-select').forEach(select => {
        select.addEventListener('change', function () {
            const satuan = this.options[this.selectedIndex].getAttribute('data-satuan');
            const row = this.closest('.bahan-row');
            row.querySelector('.satuan-display').value = satuan;
            row.querySelector('.satuan-hidden').value = satuan;
        });
    });
</script>
