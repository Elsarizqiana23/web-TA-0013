<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>
</nav>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= base_url() ?>" class="brand-link">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <!-- <div class="image">
                <img src="assets/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div> -->
            <div class="info">
                <a href="#" class="d-block"><?= session()->get('nama') ?></a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <?php if (session()->get('role') === '1'): ?>
                    <li class="nav-item">
                        <a href="<?= base_url('petugas/user') ?>" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                User
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('petugas/buku') ?>" class="nav-link">
                            <i class="nav-icon fas fa-book"></i>
                            <p>
                                Buku
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('petugas/peminjaman') ?>" class="nav-link">
                            <i class="nav-icon fas fa-house-user"></i>
                            <p>
                                Peminjaman
                            </p>
                        </a>
                    </li>
                <?php elseif (session()->get('role') === '2'): ?>
                    <li class="nav-item">
                        <a href="<?= base_url('buku') ?>" class="nav-link">
                            <i class="nav-icon fas fa-book"></i>
                            <p>
                                Buku
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('peminjaman') ?>" class="nav-link">
                            <i class="nav-icon fas fa-history "></i>
                            <p>
                                History Pinjam
                            </p>
                        </a>
                    </li>
                <?php endif; ?>
                <li class="nav-item mt-3">
                    <a href="<?= base_url('logout') ?>" class="nav-link">
                        <i class="nav-icon fas fa-power-off text-danger"></i>
                        <p class="text-danger">Logout</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>