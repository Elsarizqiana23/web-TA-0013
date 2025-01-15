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
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama</th>
                                <th>Username</th>
                                <th>Role</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $user): ?>
                                <tr>
                                    <td><?= $user['id']; ?></td>
                                    <td><?= $user['nama']; ?></td>
                                    <td><?= $user['username']; ?></td>
                                    <td>
                                        <?php if ($user['role'] == 1): ?>
                                            Admin
                                        <?php elseif ($user['role'] == 2): ?>
                                            User
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="<?= base_url('petugas/user/edit/' . $user['id']); ?>"
                                            class="btn btn-warning">Edit</a>
                                        <button class="btn btn-danger deletebtn" data-id="<?= $user['id']; ?>"
                                            data-name="<?= $user['nama']; ?>">Delete</button>
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

<!-- Modal Konfirmasi Hapus -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus user <span id="userName"></span>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <a id="confirmDeleteBtn" href="#" class="btn btn-danger">Hapus</a>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const deleteButtons = document.querySelectorAll(".deletebtn");
        const deleteModal = new bootstrap.Modal(document.getElementById("deleteModal"));
        const userName = document.getElementById("userName");
        const confirmDeleteBtn = document.getElementById("confirmDeleteBtn");

        deleteButtons.forEach(button => {
            button.addEventListener("click", function () {
                const userId = this.getAttribute("data-id");
                const name = this.getAttribute("data-name");

                userName.textContent = name;
                confirmDeleteBtn.href = "<?= base_url('petugas/user/delete/') ?>" + userId;

                deleteModal.show();
            });
        });
    });
</script>
<?= $this->include('layout/footer') ?>