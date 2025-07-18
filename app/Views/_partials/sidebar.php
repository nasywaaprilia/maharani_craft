<aside class="main-sidebar sidebar-light-pink elevation-4">
        <a href="https://t.me/maharanicraft" class="brand-link">
        <img src="<?php echo base_url('themes/dist'); ?>/img/logo.png" alt="AdminLTE Logo"  
class="brand-image img-circle elevation-3"
    style="opacity: .8">
    <span class="brand-text font-weight-light">MAHARANI STORE</span>
</a>

    <div class="sidebar">
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
data-accordion="false">
        <li class="nav-item">
            <a href="<?php echo base_url('/'); ?>" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>DASHBOARD</p>
        </a>
        </li>
        <li class="nav-item">
            <a href="<?php echo base_url('category'); ?>" class="nav-link">
            <i class="nav-icon fas fa-tags"></i>
            <p>KATEGORI</p>
        </a>
        </li>
        <li class="nav-item">
            <a href="<?php echo base_url('product'); ?>" class="nav-link">
            <i class="nav-icon fas fa-cart-plus"></i>
            <p>DATA PRODUK</p>
        </a>
        </li>
        <li class="nav-item">
            <a href="<?php echo base_url('laporan'); ?>" class="nav-link">
            <i class="nav-icon fas fa-book"></i>
            <p>LAPORAN</p>
        </a>
        </li>
        <li class="nav-header">ACCOUNT</li>
        <li class="nav-item">
           <a href="<?php echo base_url('auth/logout'); ?>" class="nav-link">
            <i class="nav-icon far fa-circle text-danger"></i>
            <p class="text">Logout</p>
            </a>
        </li>
</ul>
</nav>
</div>
</aside>