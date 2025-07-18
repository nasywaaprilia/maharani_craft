<?php echo view('_partials/header'); ?>
<?php echo view('_partials/sidebar'); ?>

<div class="content-wrapper">
    <!-- Header Section -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Edit Produk</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Edit Produk</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <?php
                            $inputs = session()->getFlashdata('inputs');
                            $errors = session()->getFlashdata('errors');
                            if (!empty($errors)) : 
                        ?>
                        <div class="alert alert-danger" role="alert">
                            Whoops! Ada kesalahan saat input data, yaitu:
                            <ul>
                                <?php foreach ($errors as $error) : ?>
                                    <li><?= esc($error); ?></li>
                                <?php endforeach ?>
                            </ul>
                        </div>
                        <?php endif; ?>

                        <?php echo form_open_multipart('product/update'); ?>
                        <div class="card-header">Form Edit Produk</div>
                        <div class="card-body">
                            <?php echo form_hidden('id_produk', $product['id_produk']); ?>

                            <!-- Image Input -->
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                    <br>
                                    <br>
                                        <?php echo form_label('Image', 'image'); ?>
                                        <img src="<?php echo base_url('uploads/' . $product['gambar_produk']); ?>" class="img-fluid">
                                        <br>
                                        <br>
                                        <?php echo form_label('Ganti Image', 'Ganti image'); ?>
                                        <?php echo form_upload('gambar_produk', $product['gambar_produk']); ?>
                                    </div>
                                </div>
                                
                                <!-- Product Fields -->
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <?php echo form_label('Category', 'category'); ?>
                                        <?php echo form_dropdown('id_kategori', $kategori, $product['id_kategori'], ['class' => 'form-control', 'placeholder' => 'Select Category']); ?>
                                    </div>
                                    <div class="form-group">
                                        <?php echo form_label('ID Produk', 'ID Produk'); ?>
                                        <?php echo form_input('id_produk', $product['id_produk'], ['class' => 'form-control', 'placeholder' => 'ID Product']); ?>
                                    </div>
                                    <div class="form-group">
                                        <?php echo form_label('Name', 'name'); ?>
                                        <?php echo form_input('nama_produk', $product['nama_produk'], ['class' => 'form-control', 'placeholder' => 'Product Name']); ?>
                                    </div>
                                    <div class="form-group">
                                        <?php echo form_label('Satuan', 'satuan'); ?>
                                        <?php echo form_input('satuan', $product['satuan'], ['class' => 'form-control', 'placeholder' => 'Satuan']); ?>
                                    </div>
                                    <div class="form-group">
                                        <?php echo form_label('Price', 'price'); ?>
                                        <?php echo form_input('harga_produk', $product['harga_produk'], ['class' => 'form-control', 'placeholder' => 'Product Price']); ?>
                                    </div>
                                </div>
                                </div>
                                    <div class="row">
                                    <div class="col-md-12">
                                    <div class="form-group">
                                        <?php echo form_label('Description', 'description'); ?>
                                        <?php echo form_textarea('deskripsi_produk', $product['deskripsi_produk'], ['class' => 'form-control', 'placeholder' => 'Product Description']); ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Footer -->
                        <div class="card-footer">
                            <a href="<?php echo base_url('product'); ?>" class="btn btn-outline-info float-right">Back</a>
                            <button type="submit" class="btn btn-primary float-right mr-2">Update</button>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php echo view('_partials/footer'); ?>