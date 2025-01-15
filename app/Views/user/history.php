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
                <div class="card-body">
                    <table id="example2" class="table table-bordered table-solid">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul Buku</th>
                                <th>Penulis</th>
                                <th>Tahun</th>
                                <th>Waktu Pinjam</th>
                                <th>Waktu Kembali</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($peminjaman as $index => $pinjam): ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= esc($pinjam['judul']) ?></td>
                                    <td><?= esc($pinjam['penulis']) ?></td>
                                    <td><?= esc($pinjam['tahun']) ?></td>
                                    <td><?= esc($pinjam['waktu_pinjam']) ?></td>
                                    <td><?= esc($pinjam['waktu_kembali']) ?></td>
                                    <td>
                                        <?php
                                        $status = $pinjam['status'];
                                        $waktu_kembali = $pinjam['waktu_kembali'];
                                        $today = date('Y-m-d');

                                        if ($status === 'Masih Dipinjam' && $today > $waktu_kembali) {
                                            $status = 'Terlambat Mengembalikan';
                                        }
                                        ?>
                                        <?= esc($status) ?>
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