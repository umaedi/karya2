<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">

    <!-- Page Heading -->


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col">
                    <a href="/katalog/create" class="btn btn-primary ">Tambah Member Baru</a>
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

        <!--serarh-->

        <!--end Of Searh-->
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table align-middle" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Added</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1 + (10 * ($curentPage - 1)) ?>
                        <?php foreach ($member as $m) : ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= $m['name']; ?></td>
                                <td><?= $m['email']; ?></td>
                                <td><?= $m['created_at']; ?></td>
                                <td><a href="#" class="btn btn-warning">Edit</a>
                                    <a href="#" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <div class="row float-right">
                    <div class="col">
                        <?= $pager->links('member', 'member_page') ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
</div>
<?= $this->endSection(); ?>