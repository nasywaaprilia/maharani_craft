<?php echo view('_partials/header'); ?>
<?php echo view('_partials/sidebar'); ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Show Produk</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Show Produk</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <img src="<?php echo base_url('uploads/' . $product['gambar_produk']); ?>" class="img-fluid">
                                </div>
                                <div class="col-md-8">
                                    <dl class="dl-horizontal">
                                        <dt>ID Produk</dt>
                                        <dd><?php echo $product['id_produk']; ?></dd>
                                        <dt>Kategori Product</dt>
                                        <dd><?php echo $product['nama_kategori']; ?></dd>
                                        <dt>Nama Product</dt>
                                        <dd><?php echo $product['nama_produk']; ?></dd>
                                        <dt>Harga Product</dt>
                                        <dd><?php echo 'Rp. ' . number_format($product['harga_produk']); ?></dd>
                                        <dt>Description Product</dt>
                                        <dd><?php echo $product['deskripsi_produk']; ?></dd>
                                    </dl>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <a href="<?php echo base_url('product'); ?>" class="btn btn-outline-info float-right">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php echo view('_partials/footer'); ?>