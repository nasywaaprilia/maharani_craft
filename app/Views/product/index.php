<?php echo view('_partials/header'); ?>
<?php echo view('_partials/sidebar'); ?>

<div class="content-wrapper">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Produk</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Produk</li>
                </ol>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            List Produk
                            <a href="<?php echo base_url('product/create'); ?>" class="btn btn-primary float-right">Tambah</a>
                        </div>
                        <div class="card-body">
                            <!-- Menampilkan pesan sukses -->
                            <?php if (!empty(session()->getFlashdata('success'))) { ?>
                                <div class="alert alert-success">
                                    <?php echo session()->getFlashdata('success'); ?>
                                </div>
                            <?php } ?>

                            <!-- Menampilkan pesan info -->
                            <?php if (!empty(session()->getFlashdata('info'))) { ?>
                                <div class="alert alert-info">
                                    <?php echo session()->getFlashdata('info'); ?>
                                </div>
                            <?php } ?>

                            <!-- Menampilkan pesan warning -->
                            <?php if (!empty(session()->getFlashdata('warning'))) { ?>
                                <div class="alert alert-warning">
                                    <?php echo session()->getFlashdata('warning'); ?>
                                </div>
                            <?php } ?>
                            <?php echo form_open('product', ['method' => 'get']); ?>
                            <div class="row">
    <!-- Kolom Dropdown Category -->
    <div class="col-md-6">
        <div class="form-group">
            <?php
            echo form_label('Category');
            echo form_dropdown(
                'category',
                $kategori, // Array kategori dari controller
                $category,   // Kategori terpilih (jika ada)
                [
                    'class' => 'form-control',
                    'id'    => 'category'
                ]
            );
            ?>
        </div>
    </div>

    <!-- Kolom Input Search -->
    <div class="col-md-6">
        <div class="form-group">
            <?php
            echo form_label('Search');
            $form_keyword = [
                'type'        => 'text',
                'name'        => 'keyword',
                'id'          => 'keyword',
                'value'       => $keyword ?? '', // Nilai default keyword jika ada
                'class'       => 'form-control',
                'placeholder' => 'Enter keyword ...'
            ];
            echo form_input($form_keyword);
            ?>
        </div>
    </div>
    <?php echo form_close(); ?>
</div>
                                
                            <!-- Tabel Produk -->
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th width="10px" class="text-center">No</th>
                                            <th>Thumbnail</th>
                                            <th>ID Produk</th>
                                            <th>Nama</th>
                                            <th>Category</th>
                                            <th>Satuan</th>
                                            <th>Price</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $nomor = 0; ?>
                                        <?php foreach ($produk as $key => $row) { ?>
                                            <tr>
                                                <td class="text-center"><?php echo ++$nomor; ?></td>
                                                <td>
                                                    <img src="<?php echo base_url('uploads/' . $row['gambar_produk']); ?>" class="rounded-circle" width="50" height="50">
                                                </td>
                                                <td><?php echo esc($row['id_produk']); ?></td>
                                                <td><?php echo esc($row['nama_produk']); ?></td>
                                                <td><?php echo esc($row['nama_kategori']); ?></td>
                                                <td><?php echo esc($row['satuan']); ?></td>
                                                <td>Rp. <?php echo number_format($row['harga_produk'], 0, ',', '.'); ?></td>
                                                <td class="text-center">
                                                    <div class="btn-group">
                                                        <a href="<?php echo base_url('product/show/' . $row['id_produk']); ?>" class="btn btn-sm btn-info">
                                                            <i class="fa fa-eye"></i>
                                                        </a>
                                                        <a href="<?php echo base_url('product/edit/' . $row['id_produk']); ?>" class="btn btn-sm btn-success">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        <a href="<?php echo base_url('product/delete/' . $row['id_produk']); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?');">
                                                            <i class="fa fa-trash-alt"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                        <?php if (empty($produk)) { ?>
                                            <tr>
                                                <td colspan="10" class="text-center">Tidak ada produk tersedia.</td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row mt-3 float-right" >
                                <div class="col-md-12">
                                            <?php echo $pager->links('product','bootstrap_pagination') ?>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php echo view('_partials/footer'); ?>
