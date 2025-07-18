<?= view('_partials/header'); ?>
<?= view('_partials/sidebar'); ?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <h1>Tambah Bahan Keluar</h1>
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

            <?= form_open('bahankeluar/store'); ?>

            <div class="card">
                <div class="card-body">

                    <div class="form-group">
                        <label for="id_bahankeluar">ID Bahan Keluar</label>
                        <input type="text" name="id_bahankeluar" class="form-control" placeholder="Contoh: BK001"
                            value="<?= $inputs['id_bahankeluar'] ?? '' ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="id_produksi">ID Produksi</label>
                        <select name="id_produksi" class="form-control" required>
                            <option value="">Pilih Produksi</option>
                            <?php foreach ($produksi_list as $p): ?>
                                <option value="<?= $p['id_produksi'] ?>" <?= old('id_produksi') == $p['id_produksi'] ? 'selected' : '' ?>>
                                    <?= esc($p['id_produksi']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" name="tanggal" class="form-control" value="<?= $inputs['tanggal'] ?? date('Y-m-d') ?>" required>
                    </div>

                    <hr>
                    <h5>Detail Bahan Keluar</h5>
                    <table class="table table-bordered" id="bahanTable">
                        <thead>
                            <tr>
                                <th>Bahan</th>
                                <th>Jumlah</th>
                                <th>Satuan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <select name="id_bahan[]" class="form-control bahan-select" onchange="updateSatuan(this)" required>
                                        <option value="">Pilih Bahan</option>
                                        <?php foreach ($bahanbaku_list as $b): ?>
                                            <option value="<?= $b['id_bahan'] ?>" data-satuan="<?= esc($b['satuan']) ?>">
                                                <?= esc($b['nama_bahan']) ?>
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
                    <button type="button" class="btn btn-secondary btn-sm" onclick="tambahBaris()">+ Tambah Bahan</button>

                </div>

                <div class="card-footer">
                    <a href="<?= base_url('bahankeluar') ?>" class="btn btn-outline-info">Kembali</a>
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
        const table = document.getElementById('bahanTable').getElementsByTagName('tbody')[0];
        const newRow = document.createElement('tr');
        newRow.innerHTML = `
            <td>
                <select name="id_bahan[]" class="form-control bahan-select" onchange="updateSatuan(this)" required>
                    <option value="">Pilih Bahan</option>
                    <?php foreach ($bahanbaku_list as $b): ?>
                        <option value="<?= $b['id_bahan'] ?>" data-satuan="<?= esc($b['satuan']) ?>">
                            <?= esc($b['nama_bahan']) ?>
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

    // Inisialisasi satuan saat halaman pertama kali dibuka
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.bahan-select').forEach(function(select) {
            updateSatuan(select);
        });
    });
</script>
