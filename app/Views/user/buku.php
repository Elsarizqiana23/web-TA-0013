<?= $this->include('layout/header'); ?>
<?= $this->include('layout/sidebar'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Buku</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-warning"></i>Peringatan!</h5>
                        <?= session()->getFlashdata('error') ?>
                    </div>
                <?php endif; ?>
                <div class="card-body">
                    <table id="example2" class="table table-bordered table-solid">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Judul</th>
                                <th>Penulis</th>
                                <th>Tahun</th>
                                <th>Gambar</th>
                                <th>Stok</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($buku as $b): ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $b['judul']; ?></td>
                                    <td><?= $b['penulis']; ?></td>
                                    <td><?= $b['tahun']; ?></td>
                                    <td><img src="<?= base_url('petugas/buku/gambar/' . $b['id']) ?>" alt="Gambar Buku"
                                            style="width: 100px; height: auto;"></td>
                                    <td><?= $b['stok']; ?></td>
                                    <td>
                                        <?php if ($b['stok'] >= 1): ?>
                                            <a href="<?= base_url('buku/pinjam/' . $b['id']); ?>"
                                                class="btn btn-warning">Pinjam</a>
                                        <?php else: ?>
                                            <button class="btn btn-danger" disabled>Stok Habis</button>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
</div>
<?= $this->include('layout/footer') ?>