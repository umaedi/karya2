<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">

    <!-- Page Heading -->


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col">
                    <a href="/katalog/create" class="btn btn-primary ">Tambah Buku Baru</a>
                    <div class="row float-right mr-1">
                        <form action="" method="post" class="navbar-search">
                            <div class="input-group">
                                <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." name="keyword">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit" name="submit">
                                        <i class="fas fa-search fa-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table align-middle" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Sampul</th>
                            <th>Judul</th>
                            <th>Penulis</th>
                            <th>Penerbit</th>
                            <th>Ditambahkan</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        $i < 100 ?>
                        <?php foreach ($katalog as $k) : ?>
                            <tr>
                                <td><?= $i; ?></td>
                                <td><img src="/img/<?= $k['sampul']; ?>" width="80" </td>
                                <td><?= $k['judul']; ?></td>
                                <td><?= $k['penulis']; ?></td>
                                <td><?= $k['penerbit']; ?></td>
                                <td><?= $k['created_at']; ?></td>
                                <td><a href="/katalog/edit/<?= $k['slug']; ?>" class="btn btn-warning">Edit</a></td>
                                <td>
                                    <form action="/katalog/<?= $k['id']; ?>" method="post">
                                        <?= csrf_field(); ?>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('apakah anda yakin?');">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            <?php $i++ ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
</div>
<?= $this->endSection(); ?>