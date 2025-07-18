<?php echo view('_partials/header'); ?>
<?php echo view('_partials/sidebar'); ?>

<div class="content-wrapper">
    <!-- Header Section -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Edit List PO</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">List PO</li>
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

                        <?php echo form_open_multipart('listpo/update'); ?>
                        <div class="card-header">Form Edit List PO</div>
                        <div class="card-body">
                            <?php echo form_hidden('id_po', $listpo['id_po']); ?>

                                
                                <!-- Product Fields -->
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <?php echo form_label('Produk', 'produk'); ?>
                                        <?php echo form_dropdown('id_produk', $produk, $listpo['id_produk'], ['class' => 'form-control', 'placeholder' => 'Select Product']); ?>
                                    </div>
                                    <div class="form-group">
                                        <?php echo form_label('Name', 'name'); ?>
                                        <?php echo form_input('nama_customer', $listpo['nama_customer'], ['class' => 'form-control', 'placeholder' => 'Customer Name']); ?>
                                    </div>
                                    <div class="form-group">
                                        <?php echo form_label('Tanggal', 'tanggal'); ?>
                                        <?php echo form_input('tanggal', $listpo['tanggal'], ['class' => 'form-control', 'placeholder' => 'Tanggal']); ?>
                                    </div>
                                    <div class="form-group">
                                        <?php echo form_label('Jumlah', 'jumlah'); ?>
                                        <?php echo form_input('jumlah', $listpo['jumlah'], ['class' => 'form-control', 'placeholder' => 'Jumlah']); ?>
                                    </div>
                                    <div class="form-group">
                                        <?php echo form_label('No_HP', 'no_hp'); ?>
                                        <?php echo form_input('no_hp', $listpo['no_hp'], ['class' => 'form-control', 'placeholder' => 'No Hp']); ?>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>

                        <!-- Footer -->
                        <div class="card-footer">
                            <a href="<?php echo base_url('listpo'); ?>" class="btn btn-outline-info float-right">Back</a>
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