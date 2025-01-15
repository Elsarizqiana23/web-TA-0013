<?= $this->include('layout/header'); ?>
<?= $this->include('layout/sidebar'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Tambah User</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" method="POST" action="<?= base_url('petugas/buku/tambah') ?>"
                            enctype="multipart/form-data">
                            <?= csrf_field() ?>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="judul">Judul</label>
                                    <input type="text" class="form-control" id="judul" name="judul"
                                        placeholder="Masukkan judul" required>
                                </div>
                                <div class="form-group">
                                    <label for="penulis">Penulis</label>
                                    <input type="text" class="form-control" id="penulis" name="penulis"
                                        placeholder="Masukkan penulis" required>
                                </div>
                                <div class="form-group">
                                    <label for="tahun">Tahun</label>
                                    <select class="form-control" id="tahun" name="tahun">
                                        <?php for ($i = date('Y'); $i >= 1900; $i--): ?>
                                            <option value="<?= $i ?>"><?= $i ?>
                                            </option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="gambar">gambar</label>
                                    <input type="file" class="form-control" id="gambar" name="gambar"
                                        placeholder="Masukkan gambar" required>
                                </div>
                                <div class="form-group">
                                    <label for="stok">Stok</label>
                                    <input type="number" class="form-control" id="stok" name="stok"
                                        placeholder="Masukkan stok" required>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <a href="<?= base_url('petugas/buku') ?>" class="btn btn-secondary">Kembali</a>
                                <button type="submit" class="btn btn-primary">Tambah</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
</div>

<?= $this->include('layout/footer') ?>