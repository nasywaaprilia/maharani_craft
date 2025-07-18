<?php echo view('_partials/header'); ?>
<?php echo view('_partials/sidebar'); ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Edit Bahan Baku Masuk</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Edit Bahan Baku Masuk</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <form action="<?php echo base_url('bahanbakumasuk/update'); ?>" method="post">
                        <div class="card">
                            <div class="card-body">
                                <?php
                                $errors = session()->getFlashdata('errors');
                                if (!empty($errors)) { ?>
                                    <div class="alert alert-danger" role="alert">
                                        Whoops! Ada kesalahan saat input data, yaitu:
                                        <ul>
                                            <?php foreach ($errors as $error) : ?>
                                                <li><?= esc($error) ?></li>
                                            <?php endforeach ?>
                                        </ul>
                                    </div>
                                <?php } ?>
                                <input type="hidden" name="id_bahan" value="<?php echo $bahan_baku['id_bahan']; ?>">
                                <div class="form-group">
                                    <label for="">Nama Bahan</label>
                                    <input type="text" name="nama_bahan" value="<?= esc($bahan_baku['nama_bahan'] ?? '') ?>" class="form-control" placeholder="Enter bahan name">
                                </div>
                                <input type="hidden" name="satuan" value="<?php echo $bahan_baku['satuan']; ?>">
                                <div class="form-group">
                                    <label for="">Satuan</label>
                                    <input type="text" value="<?php echo $bahan_baku['satuan']; ?>" class="form-control" name="satuan" placeholder="Enter satuan">
                                </div>
                                <input type="hidden" name="stok" value="<?php echo $bahan_baku['stok']; ?>">
                                <div class="form-group">
                                    <label for="">Stok</label>
                                    <input type="text" value="<?php echo $bahan_baku['stok']; ?>" class="form-control" name="stok" placeholder="Enter stok">
                                </div>
                                <input type="hidden" name="id_supplier" value="<?php echo $bahan_baku['id_supplier']; ?>">
                                <div class="form-group">
                                        <?php echo form_label('Supplier', 'supplier'); ?>
                                        <?php echo form_dropdown('id_supplier', $supplier, $bahan_baku['id_supplier'], ['class' => 'form-control', 'placeholder' => 'Select Supplier']); ?>
                                    </div>
                                <div class="form-group"><?= form_label('Tanggal', 'tanggal'); ?>
                                <input type="date" name="tanggal_masuk" value="<?= esc($bahan_baku['tanggal_masuk'] ?? '2025-05-20') ?>" class="form-control">
                                </div>

                            </div>
                            <div class="card-footer">
                                <a href="<?php echo base_url('bahanbakumasuk'); ?>" class="btn btn-outline-info">Back</a>
                                <button type="submit" class="btn btn-primary float-right">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php echo view('_partials/footer'); ?>