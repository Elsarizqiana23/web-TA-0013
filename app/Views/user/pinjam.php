<?= $this->include('layout/header'); ?>
<?= $this->include('layout/sidebar'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Pinjam Buku</h1>
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
                        <div class="card-header">
                            <h3 class="card-title">Pinjam Buku</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" method="POST" action="<?= base_url('buku/pinjam/' . $buku['id']) ?>"
                            enctype="multipart/form-data">
                            <?= csrf_field() ?>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="judul">Judul</label>
                                    <input type="text" class="form-control" id="judul" name="judul"
                                        placeholder="Masukkan judul" value="<?= esc($buku['judul']) ?>" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="penulis">Penulis</label>
                                    <input type="text" class="form-control" id="penulis" name="penulis"
                                        placeholder="Masukkan penulis" value="<?= esc($buku['penulis']) ?>" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="tahun">Tahun</label>
                                    <input type="number" class="form-control" id="tahun" name="tahun"
                                        value="<?= esc($buku['tahun']) ?>" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="gambar">Gambar</label>
                                    <img src="<?= base_url('petugas/buku/gambar/' . $buku['id']) ?>" alt="Gambar Buku"
                                        style="width: 100px; height: auto;">
                                </div>
                                <div class="form-group">
                                    <label for="stok">Stok</label>
                                    <input type="text" class="form-control" id="stok" name="stok"
                                        value="<?= $buku['stok'] > 0 ? esc($buku['stok']) : 'STOK KOSONG' ?>" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="waktu_kembali">Waktu Kembali</label>
                                    <input type="date" class="form-control" id="waktu_kembali" name="waktu_kembali">
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <a href="<?= base_url('buku') ?>" class="btn btn-secondary">Kembali</a>
                                <button type="submit" class="btn btn-info">Pinjam</button>
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