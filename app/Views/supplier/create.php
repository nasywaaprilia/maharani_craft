<?= view('_partials/header'); ?>
<?= view('_partials/sidebar'); ?>

<div class="content-wrapper">
<div class="content-header">
<div class="container-fluid">
<div class="row mb-2">
<div class="col-sm-6">
<h1 class="m-0 text-dark">Create Supplier</h1>
</div>
<div class="col-sm-6">
<ol class="breadcrumb float-sm-right">
<li class="breadcrumb-item"><a href="#">Home</a></li>
<li class="breadcrumb-item active">Create Supplier</li>
</ol>
</div>
</div>
</div>
</div>
<div class="content">
<div class="container-fluid">
<div class="row">
<div class="col-md-12">
<form action="<?php echo base_url('supplier/store'); ?>"
method="post">
<div class="card">
<div class="card-body">
<?php
// if (!empty($inputs)){
// $inputs =
session()->getFlashdata('inputs');
//}
$errors = session()->getFlashdata('errors');
if (!empty($errors)) { ?>
<div class="alert alert-danger" role="alert">
Whoops! Ada kesalahan saat input data,
yaitu:
<ul>
<?php foreach ($errors as $error) :
?>
<li><?= esc($error) ?></li>
<?php endforeach ?>
</ul>
</div>
<?php } ?>

<div class="form-group">
<label for="">Id Supplier</label>
<input type="text" class="form-control"
name="id_supplier" placeholder="Enter id supplier" value="<?php //echo$inputs['nama_supplier']; }?>">
</div>

<div class="form-group">
<label for="">Nama Supplier</label>
<input type="text" class="form-control"
name="nama_supplier" placeholder="Enter nama supplier" value="<?php //echo$inputs['nama_supplier']; }?>">
</div>
<div class="form-group">
<label for="">Alamat</label>
<input type="text" class="form-control"
name="alamat" placeholder="Enter alamat" value="<?php //echo$inputs['nama_supplier']; }?>">
</div>
<div class="form-group">
<label for="">No Hp</label>
<input type="text" class="form-control"
name="no_hp" placeholder="Enter no_hp" value="<?php //echo$inputs['nama_supplier']; }?>">
</div>
</select>
</div>
</div>
<div class="card-footer">
<a href="<?php echo base_url('supplier'); ?>"
class="btn btn-outline-info">Back</a>
<button type="submit" class="btn btn-primary
float-right">Simpan</button>
</div>
</div>
</form>
</div>
</div>
</div>
</div>
</div>

<?php echo view('_partials/footer'); ?>