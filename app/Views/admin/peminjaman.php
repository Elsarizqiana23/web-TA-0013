<?= $this->include('layout/header'); ?>
<?= $this->include('layout/sidebar'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Users</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <a href="<?= base_url('petugas/user/tambah') ?>" class="btn btn-info float-sm-right">Tambah
                        User</a>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-check"></i> Berhasil!</h5>
                        <?= session()->getFlashdata('success') ?>
                    </div>
                <?php elseif (session()->getFlashdata('errors')): ?>
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-warning"></i> Peringatan!</h5>
                        <ul>
                            <?php foreach (session()->getFlashdata('errors') as $error): ?>
                                <li><?= esc($error) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama</th>
                                <th>Judul</th>
                                <th>Waktu Pinjam</th>
                                <th>Waktu Kembali</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($data as $p): ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $p['nama']; ?></td>
                                    <td><?= $p['judul']; ?></td>
                                    <td><?= $p['waktu_pinjam']; ?></td>
                                    <td><?= $p['waktu_kembali']; ?></td>
                                    <td><?= $p['status'] ?></td>
                                    <td>
                                        <?php if ($p['status'] === 'Masih Dipinjam'): ?>
                                            <button class="btn btn-danger" id="btnkembali" data-toggle="modal"
                                                data-target="#modal-kembali<?= $p['id'] ?>">Kembalikan</button>
                                        <?php endif ?>
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

<!-- Modal -->
<?php foreach ($data as $p): ?>
    <div class="modal fade" id="modal-kembali<?= $p['id'] ?>" tabindex="-1" aria-labelledby="modalLabel<?= $p['id'] ?>"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel<?= $p['id'] ?>">Konfirmasi Pengembalian</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin mengembalikan buku <strong><?= esc($p['judul']) ?></strong> yang dipinjam
                        oleh <strong><?= esc($p['nama']) ?></strong>?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <form action="<?= base_url('petugas/peminjaman/kembali/' . $p['id']) ?>" method="post">
                        <?= csrf_field() ?>
                        <button type="submit" class="btn btn-danger">Kembalikan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<?= $this->include('layout/footer') ?>