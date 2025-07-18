<?php echo view('_partials/header'); ?>
<?php echo view('_partials/sidebar'); ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">List Po</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">List Po</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <?php
                    $inputs = session()->getFlashdata('inputs') ?? [];
                    $errors = session()->getFlashdata('errors') ?? [];
                    if (!empty($errors)) : ?>
                        <div class="alert alert-danger" role="alert">
                            <strong>Whoops!</strong> Ada kesalahan saat input data:
                            <ul>
                                <?php foreach ($errors as $error) : ?>
                                    <li><?= esc($error) ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <?php echo form_open_multipart('listpo/store'); ?>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <!-- Form bagian kiri -->
                                <div class="col-md-6">
                                    
                                    <div class="form-group">
                                        <?php
                                        echo form_label('ID Po');
                                        $id_po = [
                                            'type' => 'text',
                                            'name' => 'id_po',
                                            'id' => 'id_po',
                                            'class' => 'form-control',
                                            //'value' => $inputs['product_name'] ?? '',
                                            'placeholder' => 'ID Po',
                                        ];
                                        echo form_input($id_po);
                                        ?>
                                    </div>

                                    <div class="form-group">
                                        <?php
                                        echo form_label('Product', 'product');
                                        echo form_dropdown(
                                            'id_produk',
                                            $produk,
                                            $inputs['id_produk'] ?? '',
                                            ['class' => 'form-control']
                                        );
                                        ?>
                                    </div>

                                    <div class="form-group">
                                        <?php
                                        echo form_label('nama_customer');
                                        $nama_customer = [
                                            'type' => 'text',
                                            'name' => 'nama_customer',
                                            'id' => 'nama_customer',
                                            'class' => 'form-control',
                                            //'value' => $inputs['product_name'] ?? '',
                                            'placeholder' => 'Nama Customer',
                                        ];
                                        echo form_input($nama_customer);
                                        ?>
                                    </div>
                                    <div class="form-group">
                                        <?php
                                        echo form_label('Tanggal');
                                        $tanggal = [
                                            'type' => 'date',
                                            'name' => 'tanggal',
                                            'id' => 'tanggal',
                                            'class' => 'form-control',
                                            //'value' => $inputs['product_price'] ?? '',
                                            'placeholder' => '0',
                                        ];
                                        echo form_input($tanggal);
                                        ?>
                                    </div>
                                    
                                    <div class="form-group">
                                        <?php
                                        echo form_label('Jumlah');
                                        $jumlah = [
                                            'type' => 'number',
                                            'name' => 'jumlah',
                                            'id' => 'jumlah',
                                            'class' => 'form-control',
                                            //'value' => $inputs['product_price'] ?? '',
                                            'placeholder' => '0',
                                        ];
                                        echo form_input($jumlah);
                                        ?>
                                    </div>

                                    <div class="form-group">
                                        <?php
                                        echo form_label('no_hp');
                                        $no_hp = [
                                            'type' => 'text',
                                            'name' => 'no_hp',
                                            'id' => 'no_hp',
                                            'class' => 'form-control',
                                            //'value' => $inputs['product_name'] ?? '',
                                            'placeholder' => 'No HP',
                                        ];
                                        echo form_input($no_hp);
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tombol aksi -->
                        <div class="card-footer">
                            <a href="<?php echo base_url('listpo'); ?>" class="btn btn-outline-info">Back</a>
                            <button type="submit" class="btn btn-primary float-right">Simpan</button>
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php echo view('_partials/footer'); ?>

