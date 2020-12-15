<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <div class="row mt-5 justify-content-center">
        <div class="col-12 mt-5">
            <h2 class="text-center">Form Ubah Produk</h2>
        </div>
        <div class="col-8">
            <form action="/admin/update/<?= $admin['id']; ?>" method="POST" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <input type="hidden" name="slug" value="<?= $admin['slug']; ?>">
                <input type="hidden" name="gambarLama" value="<?= $admin['image']; ?>">
                <div class="form-group row">
                    <label for="brand" class="col-sm-2 col-form-label">Brand</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="brand" name="brand" value="<?= (old('brand')) ? old('brand') : $admin['brand'] ?>" placeholder="Samsung">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="type" class="col-sm-2 col-form-label">Tipe</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('type')) ? 'is-invalid' : ''; ?>" id="type" name="type" value="<?= (old('type')) ? old('type') : $admin['type'] ?>" placeholder="iPhone 12 Pro">
                        <div id="invalidCheck3Feedback" class="invalid-feedback">
                            <?= $validation->getError('type'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="price" class="col-sm-2 col-form-label">Harga</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="price" name="price" value="<?= (old('price')) ? old('price') : $admin['price'] ?>" placeholder="15000000">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="os" class="col-sm-2 col-form-label">OS</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="os" name="os" value="<?= (old('os')) ? old('os') : $admin['os'] ?>" placeholder="Android 11">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="storage" class="col-sm-2 col-form-label">Storage</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="storage" name="storage" value="<?= (old('storage')) ? old('storage') : $admin['storage'] ?>" placeholder="256GB">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="cpu" class="col-sm-2 col-form-label">CPU</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="cpu" name="cpu" value="<?= (old('cpu')) ? old('cpu') : $admin['cpu'] ?>" placeholder="Snapdragon 865">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="ram" class="col-sm-2 col-form-label">RAM</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="ram" name="ram" value="<?= (old('ram')) ? old('ram') : $admin['ram'] ?>" placeholder="12GB">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="image" class="col-sm-2 col-form-label">Gambar</label>
                    <div class="col-sm-2">
                        <img src="/img/<?= $admin['image']; ?>"" class=" img-thumbnail img-preview">
                    </div>
                    <div class="col-sm-8">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input <?= ($validation->hasError('image')) ? 'is-invalid' : ''; ?>" id="image" name="image" onchange="previewImg()">
                            <div id="invalidCheck3Feedback" class="invalid-feedback">
                                <?= $validation->getError('image'); ?>
                            </div>
                            <label class="custom-file-label" for="image"><?= $admin['image']; ?></label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                            </svg> Ubah</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>