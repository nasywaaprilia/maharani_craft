<?= view('_partials/header'); ?>
<?= view('_partials/sidebar'); ?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <h1>Tambah Penjualan</h1>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">

            <?php
            $inputs = session()->getFlashdata('inputs') ?? [];
            $errors = session()->getFlashdata('errors') ?? [];

            if (!empty($errors)) : ?>
                <div class="alert alert-danger">
                    <ul>
                        <?php foreach ($errors as $e) : ?>
                            <li><?= esc($e) ?></li>
                        <?php endforeach ?>
                    </ul>
                </div>
            <?php endif; ?>

            <?= form_open('penjualan/store'); ?>

            <div class="card">
                <div class="card-body">

                    <div class="form-group">
                        <label for="id_penjualan">ID Penjualan</label>
                        <input type="text" name="id_penjualan" id="id_penjualan" class="form-control" placeholder="Contoh: PN001"
                               value="<?= $inputs['id_penjualan'] ?? '' ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="tanggal">Tanggal Penjualan</label>
                        <input type="date" name="tanggal" id="tanggal" class="form-control"
                               value="<?= $inputs['tanggal'] ?? date('Y-m-d') ?>" required>
                    </div>

                    <hr>
                    <h5>Detail Produk</h5>
                    <table class="table table-bordered" id="produkTable">
                        <thead>
                        <tr>
                            <th>Produk</th>
                            <th>Jumlah</th>
                            <th>Satuan</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                <select name="id_produk[]" class="form-control produk-select" onchange="updateSatuan(this)" required>
                                    <option value="">Pilih Produk</option>
                                    <?php foreach ($produk as $p): ?>
                                        <option value="<?= $p['id_produk'] ?>" data-satuan="<?= esc($p['satuan']) ?>">
                                            <?= esc($p['nama_produk']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                            <td><input type="number" name="jumlah[]" class="form-control" required></td>
                            <td><input type="text" name="satuan[]" class="form-control satuan-input" readonly></td>
                            <td><button type="button" class="btn btn-danger" onclick="hapusBaris(this)">Hapus</button></td>
                        </tr>
                        </tbody>
                    </table>
                    <button type="button" class="btn btn-secondary btn-sm" onclick="tambahBaris()">+ Tambah Produk</button>

                </div>

                <div class="card-footer">
                    <a href="<?= base_url('penjualan') ?>" class="btn btn-outline-info">Kembali</a>
                    <button type="submit" class="btn btn-primary float-right">Simpan</button>
                </div>
            </div>

            <?= form_close(); ?>

        </div>
    </section>
</div>

<?= view('_partials/footer'); ?>

<script>
    function tambahBaris() {
        const table = document.getElementById('produkTable').getElementsByTagName('tbody')[0];
        const newRow = document.createElement('tr');
        newRow.innerHTML = `
            <td>
                <select name="id_produk[]" class="form-control produk-select" onchange="updateSatuan(this)" required>
                    <option value="">Pilih Produk</option>
                    <?php foreach ($produk as $p): ?>
                        <option value="<?= $p['id_produk'] ?>" data-satuan="<?= esc($p['satuan']) ?>">
                            <?= esc($p['nama_produk']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </td>
            <td><input type="number" name="jumlah[]" class="form-control" required></td>
            <td><input type="text" name="satuan[]" class="form-control satuan-input" readonly></td>
            <td><button type="button" class="btn btn-danger" onclick="hapusBaris(this)">Hapus</button></td>
        `;
        table.appendChild(newRow);
    }

    function hapusBaris(button) {
        const row = button.closest('tr');
        row.remove();
    }

    function updateSatuan(select) {
        const satuanInput = select.closest('tr').querySelector('.satuan-input');
        const satuan = select.options[select.selectedIndex].getAttribute('data-satuan') || '';
        satuanInput.value = satuan;
    }

    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.produk-select').forEach(function(select) {
            updateSatuan(select);
        });
    });
</script>
