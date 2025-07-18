<?php echo view('_partials/header'); ?>
<?php echo view('_partials/sidebar'); ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Create Produk</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Create Product</li>
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

                    <?php echo form_open_multipart('product/store'); ?>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <!-- Form bagian kiri -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?php
                                        echo form_label('Category', 'category');
                                        echo form_dropdown(
                                            'id_kategori',
                                            $kategori,
                                            $inputs['id_kategori'] ?? '',
                                            ['class' => 'form-control']
                                        );
                                        ?>
                                    </div>

                                    <div class="form-group">
                                        <?php
                                        echo form_label('ID Produk');
                                        $id_produk = [
                                            'type' => 'text',
                                            'name' => 'id_produk',
                                            'id' => 'id_produk',
                                            'class' => 'form-control',
                                            //'value' => $inputs['product_name'] ?? '',
                                            'placeholder' => 'ID Produk',
                                        ];
                                        echo form_input($id_produk);
                                        ?>
                                    </div>

                                    <div class="form-group">
                                        <?php
                                        echo form_label('Name');
                                        $product_name = [
                                            'type' => 'text',
                                            'name' => 'nama_produk',
                                            'id' => 'nama_produk',
                                            'class' => 'form-control',
                                            //'value' => $inputs['product_name'] ?? '',
                                            'placeholder' => 'Product Name',
                                        ];
                                        echo form_input($product_name);
                                        ?>
                                        
                                    </div>
                                    
                                </div>

                                <!-- Form bagian kanan -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?php
                                        echo form_label('Image', 'gambar_produk');
                                        echo form_upload('gambar_produk', '', ['class' => 'form-control']);
                                        ?>
                                    </div>

                                    <div class="form-group">
                                        <?php
                                        echo form_label('Price');
                                        $product_price = [
                                            'type' => 'number',
                                            'name' => 'harga_produk',
                                            'id' => 'harga_produk',
                                            'class' => 'form-control',
                                            //'value' => $inputs['product_price'] ?? '',
                                            'placeholder' => '0',
                                        ];
                                        echo form_input($product_price);
                                        ?>
                                    </div>

                                    <div class="form-group">
                                        <?php
                                        echo form_label('Satuan');
                                        $satuan = [
                                            'type' => 'text',
                                            'name' => 'satuan',
                                            'id' => 'satuan',
                                            'class' => 'form-control',
                                            //'value' => $inputs['product_name'] ?? '',
                                            'placeholder' => 'Satuan',
                                        ];
                                        echo form_input($satuan);
                                        ?>
                                        
                                    </div>
                                </div>
                            </div>

                            <!-- Description -->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <?php
                                        echo form_label('Description', 'product_description');
                                        echo form_textarea([
                                            'name' => 'deskripsi_produk',
                                            'id' => 'deksripsi_produk',
                                            'class' => 'form-control',
                                            'value' => $inputs['deskripsi_produk'] ?? '',
                                            'placeholder' => 'Product Description',
                                            
                                        ]);
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tombol aksi -->
                        <div class="card-footer">
                            <a href="<?php echo base_url('product'); ?>" class="btn btn-outline-info">Back</a>
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

