<?= $this->extend('layout/template'); ?>

<!-- Content -->
<?= $this->section('content'); ?>
<div class="container-fluid">
    <h2><?= $title; ?></h2>
    <div class="row">
        <div class="col-5">
            <form action="/katalog/save" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="judul">Judul</label>
                    <input type="judul" class="form-control <?= ($validation->hasError('judul')) ? 'is-invalid' : ''; ?> " id="judul" name="judul">
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?= $validation->getError('judul'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="penulis">Penulis</label>
                    <input type="penulis" class="form-control" id="penulis" name="penulis" value="<?= old('penulis'); ?>">
                </div>
                <div class=" form-group">
                    <label for="penerbit">Penerbit</label>
                    <input type="penerbit" class="form-control" id="penerbit" name="penerbit" value="<?= old('penerbit'); ?>">
                </div>
                <div class="custom-file">
                    <input type="file" class="custom-file-input <?= $validation->hasError('sampul') ? 'is-invalid' : ''; ?>" id="customFile" name="sampul" onchange="previewImg()">
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?= $validation->getError('sampul'); ?>
                    </div>
                    <label class="custom-file-label" for="customFile">Pilih file</label>
                </div>
                <div class="my-3">
                    <img src="/img/unnamed.png" class="img-thumbnail img-preview" width="78">
                </div>
                <button type=" submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<?= $this->endSection(); ?>