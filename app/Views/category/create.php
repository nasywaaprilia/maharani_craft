<?= view('_partials/header'); ?>
<?= view('_partials/sidebar'); ?>

<div class="content-wrapper">
<div class="content-header">
<div class="container-fluid">
<div class="row mb-2">
<div class="col-sm-6">
<h1 class="m-0 text-dark">Create Category</h1>
</div>
<div class="col-sm-6">
<ol class="breadcrumb float-sm-right">
<li class="breadcrumb-item"><a href="#">Home</a></li>
<li class="breadcrumb-item active">Create Category</li>
</ol>
</div>
</div>
</div>
</div>
<div class="content">
<div class="container-fluid">
<div class="row">
<div class="col-md-12">
<form action="<?php echo base_url('category/store'); ?>"
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
<label for="">Id Kategori</label>
<input type="text" class="form-control"
name="id_kategori" placeholder="Enter id kategori" value="<?php //echo$inputs['nama_kategori']; }?>">
</div>

<div class="form-group">
<label for="">Nama Kategori</label>
<input type="text" class="form-control"
name="nama_kategori" placeholder="Enter nama kategori" value="<?php //echo$inputs['nama_kategori']; }?>">
</div>
</div>
<div class="card-footer">
<a href="<?php echo base_url('category'); ?>"
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